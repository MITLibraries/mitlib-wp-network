# How our themes use stylesheets

## Types of stylesheets

The themes we maintain have multiple sets of stylesheets.

1. The main static stylesheet
2. Component stylesheets
3. Any compiled stylesheets

### Main stylesheet

A theme's main stylesheet is named `style.css`, and is found in the root of the
theme folder.

#### Theme Metadata

This stylesheet, in addition to whatever CSS rules it defines, includes a
comment block at the top of the file. This block is used by WordPress itself to
define certain information about theme as a whole - including the current
version of the theme.

Full documentation about this feature can be found in the Theme Handbook at:
https://developer.wordpress.org/themes/basics/main-stylesheet-style-css/

### Component stylesheets

Some stylesheets may only need to be loaded in certain conditions (by specific
templates, or when certain content conditions are met). These component-based
stylesheets can be found in the `css/` folder within each theme.

An example of this approach was the `super-admin.css` stylesheet, which was used
in the Parent theme to load certain styles that would only be seen by super
admin users (this stylesheet has been retired).

### Compiled stylesheets

Some component stylesheets end up being complex enough that we leverage SASS to
compile them. These SCSS files, if used, can be found under the `css/scss/`
folder within each theme.

The tool we use to compile these stylesheets is the [WP-SCSS plugin](https://wordpress.org/plugins/wp-scss/).

## Registering and enqueuing

Stylesheets, of any type, are attached to a page via a block of code in the
theme's `functions.php` file. This code should be found in a function called by
the `wp_enqueue_scripts` action.

The structure of this function should be structured like this:

```php
function scripts_styles() {
	// Look up theme version
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register all known stylesheets
	wp_register_style( 'parent-styles', get_stylesheet_uri(), array(), $theme_version );
	wp_register_style( 'parent-global', get_template_directory_uri() . '/css/build/global.css', array( 'parent-styles' ), $theme_version );

	wp_register_style( 'super-admin', get_template_directory_uri() . '/css/super-admin.css', array(), $theme_version, false );

	// Globally enqueue the base styles
	wp_enqueue_style( 'parent-global' );

	// Conditionally enqueue stylesheets as needed
	if ( is_super_admin() ) {
		wp_enqueue_style( 'super-admin' );
	}
}
add_action( 'wp_enqueue_scripts', 'Name\Space\scripts_styles' );
```

Please refer to the [WordPress code reference](https://developer.wordpress.org/reference/) for more information about the
functions used in the above example, especially:
* [wp_enqueue_style](https://developer.wordpress.org/reference/functions/wp_enqueue_style/)
* [wp_register_style](https://developer.wordpress.org/reference/functions/wp_register_style/)
