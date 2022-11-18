<?php
/**
 * News theme functions and definitions
 *
 * @package MITlib_News
 * @since 0.0.1
 */

namespace Mitlib\News;

/**
 * Register and selectively enqueue stylesheets needed for the current page.
 */
function news_scripts_styles() {
	/**
	 * This allows us to cache-bust these assets without needing to remember to
	 * increment the theme version here.
	 */
	$theme_version = wp_get_theme()->get( 'Version' );
	$parent_version = wp_get_theme()->parent()->get( 'Version' );

	// Load FontAwesome via CDN.
	wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css', array(), '4.6.0' );
	wp_enqueue_style( 'font-awesome' );

	// Load local bootstrap and mobile styles.
	wp_register_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), $parent_version );
	wp_register_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.css', array(), $theme_version );
	wp_register_style( 'newsmobile', get_stylesheet_directory_uri() . '/css/newsmobile.css', array(), $theme_version );
	wp_enqueue_style( 'parent-style' );
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'newsmobile' );
}
add_action( 'wp_enqueue_scripts', 'Mitlib\News\news_scripts_styles' );

/**
 * Registers custom css files for admin dashboard
 */
function admin_styles() {
	/**
	 * This allows us to cache-bust these assets without needing to remember to
	 * increment the theme version here.
	 */
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_register_style( 'custom-admin', get_stylesheet_directory_uri() . '/css/custom-admin.css', array(), $theme_version );
	wp_enqueue_style( 'custom-admin' );

	// Users who cannot edit theme options (i.e. non-administrators) are not shown the AddThis panel.
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_register_style( 'hide-addthis', get_stylesheet_directory_uri() . '/css/hide-addthis.css', array(), $theme_version );
		wp_enqueue_style( 'hide-addthis' );
	}
}
add_action( 'admin_head', 'Mitlib\News\admin_styles' );
