# How to confirm plugins are working

This page describes specific tests that a site builder can perform to confirm
that any plugin is working as expected.

The plugins on this list should be cross-checked with two other sources:
* The list of available plugins reported by the WordPress network dashboard
(please note that some plugins on this list may be "must-use" plugins, which are
only visible on the network dashboard, and not on a site dashboard).
* The [MIT Libraries WordPress Network](https://docs.google.com/spreadsheets/d/1LZUIjZv_X3h1TZCfxOsqCcm3GYdEZorY/edit#gid=115011708) documentation spreadsheet, which is the
clearest window we have into which plugins are active on which sites.

## Add Categories to Pages

Look under the Pages area of the Parent site's dashboard. If you see menu
entries for Categories and Tags, the plugin is working (without this plugin,
these entries are only visible under Posts).

## Advanced Custom Fields PRO

1. Look for the Custom Fields entry at the bottom of the site dashboard (for any
   site on the network).
2. Load the site homepage, and note whether Experts appear. Additionally note
   whether experts appear with academic fields associated with them.
3. Load a library location page like Barker or Rotch, and check to make sure a
   phone number and campus location are visible.

## ACF: Image Crop Add-On

_This plugin is only used on the News site._

## ACF: Location Field

**Removal candidate**

This plugin is likely unused. It had been part of the Location record, but we
have started recording locations in lat/long coordinates as strings.

## Advanced Editor Tools (previously TinyMCE Advanced)

Edit any page record on the Parent site. In the "visual" editor, you should see
a menu bar for "File ... Edit ... View ... Insert ... " etc.

When this plugin is inactive (for example, on the Giving site), that menu bar
will not be visible in the page editor.

## Advanced Post Types Order

On any site on the network, look in the sub-menu for any post type for the
"Re-order" entry. Loading this page should confirm that the plugin is working.

(It is not clear at the moment whether we have used this plugin to do any work).

## Akismet Anti-Spam

_This plugin is only used on the News site._

## AntiVirus

_This plugin is only used on the News site._

## Black Studio TinyMCE Widget

On the Parent site, look in the Widgets area for any instance of a Visual Editor
widget (there should be a large number of these). Additionally, check to see
whether any of these widgets are appearing as expected on the public interface.

## CF7 to Webhook

This is used by forms for Distinctive Collections. In the form edit screen,
confirm that the Webhook tab exists, and has details including the Webhook URL.

Further testing can be done via test submissions, or logging into the Zapier
account for DDC. There are debugging tools within Zapier that can confirm
messages are being sent.

## Classic Editor

Edit any page record, and confirm that a traditional WYSIWYG editing interface
is visible.

## Classic Widgets

Make sure that there is a Widgets option under the Appearance sidebar.

## CMS Tree Page View

1. For any site with this plugin enabled, check that there is a widget on the
admin dashboard named "Pages Tree".
2. Under the Pages group on the admin interface, confirm that a "Tree view" item
is included.

## Conditional Fields for Contact Form 7

Load the Ask Us email form (/forms-private/ask-us/). Select different topics,
particularly the ILB and Technical options, and confirm that field groups appear
and disappear.

## Contact Form 7

Confirm that the "Contact" option is listed on the admin dashboard menu.

Other functionality will be tested when confirming that other plugins (like the
Conditional Fields add-on) are working.

## CPT-onomies

_This plugin is only used on the Music Oral History site._

## Custom Post Type UI

Confirm that the "CPT UI" option is listed on the admin dashboard menu in the
Parent site.

## Dynamic Menu Manager

1. Confirm that the "DuoGeek" option is listed on the admin dashboard menu.
2. There should be a number of entries listed under DuoGeek -> Menu Manager.
3. Edit the About Barker page record. In the sidebar, there should be a Menu
Manager metabox which places the Barker Menu in the Secondary Menu spot.
4. When viewing the About Barker page record, you should see the entries for the
Barker above the page content.

## Enable Media Replace

Within the Scholarly site, go to the Media Library and click on any image. You
should see a "Replace media" section with an "Upload a new file" button.
Clicking the button should take you to a Replace Media Upload screen.

## Filter Page by Template

Load the All Pages screen in any site dashboard. There should be a Template
column on the display, and a filter option to show only pages which use a given
template file.

## Google XML Sitemaps

Confirm that the sitemap is visible at `/sitemap.xml` on any site.

## Media Libary Assistant

Under the "Media" area of the admin dashboard, you should see links for "Att. 
Category" and "Att. Tag". Additionally, in the search / filter panel above the
images, you shoul see a Terms Search button and a more complex search interface
than a simple search box.

There should be an "Assistant" item under the Media area, showing a list of
images in the library and where they are used.

## MITlib Analytics

There should be a "MITlib Analytics" option on the network dashboard.

## MITlib CF7 Elements

On the public view of the Forms Demonstration page, you should see an input for
"Your DLC (required)".
When editing this form, you should see a `[select_dlc* department]` entry.

## MITlib Home Page News

_This plugin is only used on the News site._

## MITlib Multisearch Widget

1. On the network home page, you should see the black tabbed multisearch widget.
2. Within the parent site's widget dashboard, you should see a MultiSearch
widget placed on the Masthead Search Bar area.

## MITlib Pending Posts

_This plugin is only used on the News site._

## MITlib Plugin Canary

On the admin dashboard for any site on the network, there should be a widget
named "Plugin canary"

## MITlib Post Events

On the Exhibits site's admin dashboard, you should see an Events item on the
sidebar.

## MITlib Post Exhibits

On the Exhibits site's admin dashboard, you should see an Exhibits item on the
sidebar. Loading the "All Exhibits" page should show a list of Exhibit records.

## MITlib Post Experts

On the Parent site's admin dashboard, you should see an Experts item on the
sidebar. Loading the "All Experts" page should show a list of Expert records.

## MITlib Post Locations

On the Parent site's admin dashboard, you should see a Locations item on the
sidebar. Loading the "All Locations" page should show a list of Location
records.

## MITlib Pull Events

_This plugin is only used on the News site._

## MITlib Pull Hours

1. On the Parent site's admin dashboard, you should see a widget named "Library
hours information".
2. There should be a page for "Library hours" under the Settings item on the
dashboard.
3. Clicking the "Update hours cache" button on the settings page will update the
local hours cache, and the "Last harvested" value on the above to areas should
be updated.
4. There should be entries on the Widgets dashboard for "Location Hours", 
"Location Hours - Frontpage", and "Location Hours - Slim".

## MITlib Secrets Widget

On the admin dashboard for any site, you should see an "Available Secrets"
widget that lists the names of the available secrets.

## Notification

_This plugin is only used on the News site._

## Page Links To

Within the list of All Locations, you should see soe with a link icon next to
their title (for example, the "Building 9 book drop" location). On the edit
screen for this record, at the bottom of the main column you should see a "Page
Links To" metabox specifying a URL on the WhereIs resource.

## ReCaptcha v2 for Contact Form 7

**Removal candidate**

At the bottom of the Request a Class Session form at `/distinctive-collections/request-class/`,
there should be an "I'm not a robot" form field.

Please note, though, that we are in the process of removing this plugin from the
network.

## Redirection

On the Parent site, you should see a "Redirection" dashboard under the Tools
area. There should be several hundred redirections listed.

Clicking the "Check Redirect" context item that appears when you hover over any
of these entries should report success (when working locally, this may not be
the case).

Following a known redirect, like `/apis`, should result in your browser being
redirected to a page on LibGuides.

## Seamless Sticky Custom Post Types

On the Exhibis site, edit any Exhibit record. In the right sidebar of the edit
screen, in the "Publish" metabox, click the "Edit" link on the visibility line.
You should see an option to make the record sticky.

## Share Buttons by AddThis

_This plugin is only used on the News site._

## Slug Trimmer

_This plugin is only used on the News site._

## Snippet Shortcodes

1. On the Parent site's admin dashboard, you should see a "Snippet Shortcodes"
item on the sidebar.
2. On the "Authenticate to online resources" page at `/research-support/connect/`,
near the bottom of the page, you should see a "Reload via MIT Libs" link.

## TablePress

_This plugin is only used on the Music Oral History site._

## Ultimate Posts Widget

1. On the AKDC site, load the Widgets dashboard. You should see an "Ultimate
Posts" widget in the list of available widgets.
2. Within the "Below Content Widget Area" of the AKDC site, there should be a
number of these Ultimate Posts widgets placed.
3. On the "About Archnet" page at `/akdc/archnet/` within the AKDC site, you
should see a list of Archnet news posts.

## Widget Context

1. On the Parent site, within the Widgets dashboard, any of the widgets in any
sidebar should include, when expanded, a Widget Context area of the
configuration form.
2. In the Migrated Content Notice sidebar, expanding either widget should
indicate that the widget is only visible in certain URL paths (such as the
`/archives` path or `/2016-election-posters` path).
3. You should thus see different content when visiting different known-invalid
paths, like `/archives/fooasdf` and `/fooasdf`.

## Widget CSS Classes

1. On the About site's Widget dashboard, the "Access to the Libraries" widget
(or any widget) should include, when expanded, a "CSS Classes" text box. Within
this, there should be a "callout" class defined.
2. When visiting the "Policies" page within the About site at `/about/policies/`
the top widget about "Access to the Libraries" should appear with a gray
background and top orange border (the "callout" style in our theme).

## Widget Importer & Exporter

On any site on the network, under the Tools area of the sidebar, there should be
a page for "Widget Importer & Exporter"

## WordPress Importer

On any site on the network, under the Tools area of the sidebar, there should be
a page for "Import". On this page there should be an option to import content
from a different WordPress site.

## WordPress Sentry

On the network dashboard, under the Tools group, there should be a WP Sentry
Test page. Clicking the "Send PHP test event" on this page should cause a test
message to appear within the Sentry profile for this application.

## WP Activity Log

There should be a "WP Activity Log" item on the sidebar of any admin dashboard
across the network. This should display a list of recent activity on the site
which can be sorted, or filtered to a specific site.

## WP Mail SMTP

1. There should be a "WP Mail SMTP" item on the sidebar of any admin dashboard.
This should display a configuration form for sending mail.
2. The SMTP Username and SMTP Password should be filled in, but grayed out, as
they are defined by site secrets and are not changeable here.
3. There should be an "Email Test" page within the plugin's navigation, which
allows you to send a test email to confirm that everything is working as
expected.

## WP-SCSS

1. The public display of any page on the Parent site should look as expected.
2. There should be a "WP-SCSS" page under the Settings group in the admin
sidebar. The form on this page should be submittable at any point, and should
do so successfully. 