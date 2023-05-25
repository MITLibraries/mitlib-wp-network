# How to make CSS changes with minimal pain

This document describes the best workflow for promoting changes to CSS styles
to the Live tier in Pantheon, in such a way that they take effect relatively
quickly and without confusion about whether things worked.

## Why this is necessary

Promoting changes to CSS stylesheets can be a tricky proposition, because the
files involved can be cached in many different places. Additionally, many of
our stylesheets are compiled via SCSS - but this does not happen on every page
load on the Test and Live tiers, because it raises performance problems.

As a result, there can at times be a significant delay between deploying a new
set of styles and seeing those changes reflected in users' browsers.

Following the steps below may not eliminate that delay entirely, but should help
reduce it.

## When to follow these steps

Follow this procedure whenever a change in being promoted on Pantheon which
affects any stylesheet in the themes.

These steps should be followed when making the change to either the Live or Test
tiers.

## During development

**If your change involves updates to any theme stylesheet, make sure that you
increment the theme version.**

The theme version can be found in the block comment at the top of the theme's
`style.css` file. This string is used as a cache-busting technique when loading
stylesheets, prompting users' browsers to download a fresh copy of the file
when warranted.

## The procedure

1. Deploy the change via the Code tab on the Pantheon dashboard.
2. Clear the caches within Pantheon (via either the web UI or Terminus).
3. In your browser, load a page which should be impacted by the new CSS styles.

If your change is visible at this point, you can skip the rest of this workflow.
If the change is not yet visible, the following steps may help:

4. Using the developer tools in your browser, identify and directly load the
   compiled stylesheet which holds the updated rules. For the parent theme, this
   will likely be `global.css`, which is compiled using the WP-SCSS plugin.
5. Within that stylesheet, identify whether the style change can be identified.
   If the new styles are not yet visible, continue with this procedure (if the
   styles have been updated and the rendering is still incorrect, there may be a
   bug which requires further development).
6. Log into WordPress, go to the WP-SCSS settings page, and turn on the "Always
   Recompile" option. This setting is off by default on the Test and Live tiers
   for performance reasons.
7. Clear the caches within Pantheon again.
8. Wait for a minute or two, to give the caches time to fully clear. This can be
   monitored using the "Workflows" modal on the Pantheon dashboard.
9. Force-reload the compiled stylesheet opened in step 3. Confirm that the
   updated styles are now included.
10. Force-reload the reference page again (from step 2), and check that the
    intended change is now visible.
11. Once you have seen the change in action, turn off the "Always Recompile"
    setting from step 5.

## For more information

Please see the reference article [How our themes use stylesheets](https://github.com/MITLibraries/mitlib-wp-network/blob/master/docs/reference/theme-styles.md) for an overview of our approach to
styling WordPress.
