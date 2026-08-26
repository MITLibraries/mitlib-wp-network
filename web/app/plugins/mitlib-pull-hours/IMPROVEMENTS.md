# Known improvement areas

This document tracks known issues and improvement opportunities identified
during a modernization review of this plugin. The focus is on error handling,
user feedback, and silent failure modes.

The broader context for this work is a shift toward using the WordPress
Settings Errors API (`add_settings_error()` / `settings_errors()`) to collect
and display status messages after operations complete, rather than scattering
`echo()` calls throughout the business logic. That pattern is already in place
in `class-harvester.php` and `class-dashboard.php` as of the `skunkworks`
branch.

---

## 1. `set_properties()` does not stop `harvest()` on failure

**File:** `src/class-harvester.php` — `set_properties()` and `harvest()`

There are two silent failure modes in `set_properties()`:

### 1a. `wp_upload_dir()` error is ignored

`wp_upload_dir()` returns an array that includes an `['error']` key, set to a
non-empty string if the upload directory cannot be determined. The current code
reads `['basedir']` unconditionally without checking whether `['error']` is
set. If `wp_upload_dir()` fails, `$this->path` will be set to a wrong or empty
value, and subsequent file writes will fail silently.

**Suggested fix:** Check `wp_upload_dir()['error']` before using `['basedir']`.
If it is non-empty, queue an error via `add_settings_error()` and return
`false` to signal failure to `harvest()`.

### 1b. `wp_mkdir_p()` failure does not propagate to `harvest()`

If the cache directory cannot be created, `set_properties()` queues an error
message but returns nothing, so `harvest()` has no way of knowing that the
directory step failed. Execution continues into the try/catch block, the
Google Sheets API is contacted successfully, and then `write()` silently fails
when it tries to put files into a non-existent directory. The final result
reported to the admin will be `true` (success), which is incorrect.

**Suggested fix:** Have `set_properties()` return a boolean, and have
`harvest()` check that return value before proceeding. If `set_properties()`
returns `false`, `harvest()` should queue an error and return `false` without
contacting the API.

---

## 2. `write()` silently discards failures

**File:** `src/class-harvester.php` — `write()`

`file_put_contents()` returns `false` on failure (wrong permissions, disk
full, etc.), but the return value is currently discarded. If a file cannot be
written, the harvest will complete and report success even though some or all
cache files are stale or missing.

This is probably the most operationally dangerous silent failure in the plugin,
because it is the kind of thing that could happen subtly in a production
environment — a permissions change, a full disk — without producing any visible
error.

**Suggested fix:** Check the return value of `file_put_contents()`. On
failure, queue an error via `add_settings_error()`. Consider whether a single
failed file write should abort the entire harvest or continue and report a
partial success. The simplest approach is to track a `$write_errors` counter
in `fetch()` and have `fetch()` return a boolean that `harvest()` can include
in its own success/failure determination.

---

## 3. Per-sheet fetch errors are indistinguishable from step-3 errors

**File:** `src/class-harvester.php` — `fetch()`

Inside `fetch()`, `$service->spreadsheets_values->get()` can throw a
`\Google\Service\Exception` — for example if permissions allow reading the
spreadsheet index but not the individual sheet contents, or if a sheet name
is somehow invalid. This is caught by the existing try/catch block in
`harvest()`, but the error message won't identify which sheet caused the
problem, making it harder to diagnose.

**Suggested fix:** This is a lower-priority improvement. Options include
wrapping the inner call in its own try/catch within `fetch()` to capture
per-sheet errors with the sheet name included in the message, or having
`fetch()` return a list of per-sheet results. The current broad catch is
acceptable for now.

---

## 4. `Admin_Widget` never calls the Harvester

**File:** `src/class-admin-widget.php` — `widget()`

The `widget()` method handles a POST action by updating the `cache_timestamp`
option and queuing a message saying "Harvester activated..." — but it never
actually instantiates or calls the `Harvester` class. The timestamp is updated
to the current time without any data being fetched, which means the admin
dashboard widget can display a recent "last updated" timestamp even though the
cache content has not changed.

This appears to be either a stub left over from an earlier design, or an
incomplete implementation of a planned feature to trigger harvesting from the
dashboard widget.

**Suggested fix:** Either complete the implementation by calling
`$harvester->harvest()` (and handling the return value as `Dashboard::update()`
already does), or remove the POST-handling block entirely from `Admin_Widget`
if the intent is that harvesting should only be triggered from the settings
page.

---

## 5. `admin-widget.php` template is fragile with an unset timestamp

**File:** `templates/admin-widget.php`

On a fresh install, or if the `cache_timestamp` option is deleted, `get_option(
'cache_timestamp' )` returns `false`. This is passed to `gmdate()`, which
treats it as `0` (the Unix epoch, January 1 1970), producing a misleading but
non-fatal timestamp display.

Additionally, the `switch` block that calculates the human-readable "X ago"
string compares a `DateInterval` object against boolean expressions in each
`case`. This works due to PHP's type coercion rules in switch statements, but
it is a fragile antipattern that could behave unexpectedly across PHP version
changes.

**Suggested fix:** Guard the timestamp block with a check for a falsy
`cache_timestamp` value, and display a "never harvested" message in that case.
Replace the `switch` on the `DateInterval` object with explicit `if/elseif`
comparisons on its properties (`$ago->y`, `$ago->m`, etc.).

---

## Summary table

| # | File | Issue | Risk |
|---|---|---|---|
| 1a | `class-harvester.php` | `wp_upload_dir()` error key ignored | Wrong path used silently |
| 1b | `class-harvester.php` | `wp_mkdir_p()` failure doesn't stop `harvest()` | False success reported |
| 2 | `class-harvester.php` | `file_put_contents()` return value ignored | Cache silently not written |
| 3 | `class-harvester.php` | Per-sheet errors indistinguishable from index errors | Unhelpful error messages |
| 4 | `class-admin-widget.php` | `Harvester` never called | Timestamp updated, cache stale |
| 5 | `templates/admin-widget.php` | Unguarded timestamp and fragile switch | Misleading display on fresh install |
