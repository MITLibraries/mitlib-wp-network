# How we manage and load library hours

This page will describe how we manage library hours - across multiple locations,
on multiple pages, and over timeframes that accommodate both an underlying
standard calendar as well as during exceptional circumstances (which may last
from a few hours to several days).

## Summary

* The UX staff manages a Google spreadsheet with multiple data sheets.
* Library staff who manage a library location then maintain, along with UX
  staff, the contents of those data sheets.
* This WordPress application provides a plugin, `MITlib Pull Hours`, which is
  capable of harvesting the contents of that spreadsheet into a set of JSON
  documents on the webserver.
* The plugin also provides a javascript library, `hours-loader.js`, which looks
  for data attributes in the client-facing markup which indicate that library
  hours need to be displayed. The hours loader compares the contents of the
  various JSON documents, determines the relevant hours information, and places
  that information into the DOM.
* The hours loader can be enqueued either via widgets provided by the plugin,
  or by templates provided by the theme. These widgets and templates include the
  data attributes necessary for the hours loader to function.

## Technical requirements for displaying hours in a location

In order for library hours to be displayed on a page, two things must be true:

1. The page must load `hours-loader.js`.
2. The element on the page which will contain the hours must have the necessary
   data attribute and values attached to it. There are two ways to satisfy this
   condition:
   a. For most uses, the element must have an attribute of
      `data-location-hours`, with a value that exactly matches the location to
      be displayed (as recorded in the Google spreadsheet).
   b. The only exception to the above is the main grid of hours, which is also
      the only way to display hours for a date other than today. For the hours
      grid, there must be a table with the class `hrList`, with data attributes
      of `data-location` assigned to each row and `data-day` assigned to each
      cell that shows hours. The `data-location` value must match the name of a
      location, while `data-day` should be the integer value for the day of the
      week being displayed (the week itself is loaded from the querystring of
      the page).

## References

* [UX wiki documentation](https://wikis.mit.edu/confluence/display/UXWS/Hours)
* [MITlib Pull Hours plugin](https://github.com/MITLibraries/mitlib-wp-network/tree/master/web/app/plugins/mitlib-pull-hours)
* [Parent theme hours template](https://github.com/MITLibraries/mitlib-wp-network/blob/master/web/app/themes/mitlib-parent/templates/page-hours.php)
* [Parent theme study spaces template](https://github.com/MITLibraries/mitlib-wp-network/blob/master/web/app/themes/mitlib-parent/templates/page-study-spaces.php)
