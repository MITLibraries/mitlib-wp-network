# How to work with custom post types

This document provides specific instructions for how to accomplish certain tasks
relating to the custom post types which this web application needs.

## Creating a new post type

Creating a new custom post type has two components: defining the post type, and
defining the fields which it contains.

### The post type

To make a new custom post type, first copy one of the existing `mitlib-post-*`
plugins in `/web/app/plugins/`. Your new plugin will need:

* A readme markdown file describing the post type in general terms
* A PHP file, with the same name as the containing folder, that will hold the
  plugin metadata, load the post type's class file, and define the hooks which
  enable its needed functionality.
* A PHP class file, in a `src/` directory, which has at a minimum `define`
  method which will define the post type as an empty shell.
  * The `$args` array contains a `supports` key, which is where you define the
    core WordPress functionality which should be included in your post type.
  * If your post type will need additional functionality, such as a relationship
    to a taxonomy, this will be defined in separate methods (see Locations as an
    example).

See the WordPress documentation on [register_post_type()](https://developer.wordpress.org/reference/functions/register_post_type/) for more
information about this step.

### The fields within the post type

The above steps will create your post type as an empty shell, with only the
features defined in the `support` value in the post type arguments. Your post
type will very likely need additional custom fields.

Groups of custom fields can be created interactively using the Advanced Custom
Fields plugin at a path such as `/wp-admin/edit.php?post_type=acf-field-group`.
When you have created the needed fields, you can export this information in JSON
format, and place the file within `/web/app/mu-plugins/mitlib-post/data/`. There
you fill find a JSON file for each custom post type defined across the
application.

_We recommend that you not attempt to author this JSON file yourself. Let the
ACF plugin do it for you._

These JSON files are loaded by `add_filter` calls in your plugin's base PHP
script. They will look something like the following:

```php
add_filter( 'acf/settings/load_json', array( 'Mitlib\PostTypes\Exhibit', 'load_point' ) );
add_filter( 'acf/settings/save_json', array( 'Mitlib\PostTypes\Exhibit', 'save_point' ) );
```

See the documentation for the [Advanced Custom Fields plugin](https://www.advancedcustomfields.com/resources/) for more information
about defining custom fields.

## Updating an existing post type

When changing an existing post type you may need to alter either the PHP class
for that post type, and/or the JSON representation of the post type's custom
fields.

Simple updates may be achieved by editing these files directly, but more complex
changes - especially to the custom fields within a post type - may best be
managed by [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/resources/).

**Please note**

The custom post types within this application may be used on multiple sites
across the network - so please consider how your changes will impact each site
which has activated that post type.

### Navigating existing custom fields

The contents of the `/web/app/mu-plugins/mitlib-post/data/` folder can be
challenging to navigate, with filenames like `group_5668669a86e5c-2.json`.
Unfortunately these filenames appear to be semantically valuable, and should
not be changed at this time. You may need to search within the folder using
your IDE to identify the field you are looking for in order to identify the
needed file.

## Adding support for a post type to a new site

Enabling an existing post type on a new site within the network can be done by
activating that plugin within the WordPress dashboard. The path to do so will
be something like `/SITE-SLUG/wp-admin/plugins.php`.
