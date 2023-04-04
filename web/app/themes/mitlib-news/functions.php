<?php
/**
 * News theme functions and definitions
 *
 * @package MITlib_News
 * @since 0.0.1
 */

namespace Mitlib\News;

/**
 * We use lib/cards.php to define a handful of functions which together
 * render content in this theme in card format.
 */
require_once( 'lib/cards.php' );

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

	// Register stylesheets.
	wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css', array(), '4.6.0' );
	wp_register_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), $parent_version );
	wp_register_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.css', array(), $theme_version );
	wp_register_style( 'newsmobile', get_stylesheet_directory_uri() . '/css/newsmobile.css', array(), $theme_version );

	// Register javascript libraries.
	wp_register_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js', array( 'jquery' ), '3.3.1', false );
	wp_register_script( 'lazyload', get_stylesheet_directory_uri() . '/js/libs/lazyload.min.js', array( 'jquery' ), $theme_version, false );
	wp_register_script( 'myScripts', get_stylesheet_directory_uri() . '/js/myScripts.js', array( 'lazyload' ), $theme_version, false );

	// Enqueue libraries - these files are always loaded.
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'parent-style' );
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'newsmobile' );
	wp_enqueue_script( 'bootstrap' );
	wp_enqueue_script( 'myScripts' );

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

/**
 * Add custom images for the news.
 *
 * @uses add_theme_support() To enable the theme's support for custom header
 *                           images.
 * @uses add_image_size() Registers a new image size for use by the theme.
 */
add_theme_support( 'post-thumbnails' );
add_image_size( 'news-home', 111, 206, true ); // Hard Crop Mode.
add_image_size( 'news-listing', 323, 111, true ); // Hard Crop Mode.
add_image_size( 'news-feature', 657, 256, true ); // Hard Crop Mode.
add_image_size( 'news-single', 451, 651, true ); // Hard Crop Mode.

/**
 * Remove parent theme page templates.
 *
 * The Parent theme includes a number of page templates which are meant for only
 * one page, and which are not relevant to the News theme. This function removes
 * those irrelevant templates from the list of available options shown to page
 * editors within the News theme.
 *
 * @param array $page_templates The list of available page templates in the theme.
 */
function prune_inherited_templates( $page_templates ) {
	unset( $page_templates['templates/page-featured-news.php'] );
	unset( $page_templates['templates/page-home.php'] );
	unset( $page_templates['templates/page-hours.php'] );
	unset( $page_templates['templates/page-location-2021.php'] );
	unset( $page_templates['templates/page-location.php'] );
	unset( $page_templates['templates/page-map-locations.php'] );
	unset( $page_templates['templates/page-study-spaces.php'] );

	return $page_templates;
}
add_filter( 'theme_page_templates', 'Mitlib\News\prune_inherited_templates' );

/**
 * Remove unwanted widget areas inherited from the Parent theme.
 */
function remove_parent_widgets() {
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
	unregister_sidebar( 'sidebar-search' );
	unregister_sidebar( 'sidebar-hours' );
}
add_action( 'widgets_init', 'Mitlib\News\remove_parent_widgets', 11 );

/**
 * ============================================================================
 * ============================================================================
 * These functions are defined here, without adding them via add_action. They
 * may be called by the templates within the theme.
 */

/**
 * This function trims a WP excerpt at a word limit defined by $limit. If no
 * limit (or a negative number) is received, the entire excerpt is returned.
 *
 * @param int $limit The number of words requested.
 */
function excerpt( $limit = 0 ) {
	$excerpt = get_the_excerpt();
	if ( $limit > 0 ) {
		$excerpt = explode( ' ', get_the_excerpt(), $limit );
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$excerpt = implode( ' ', $excerpt ) . '...';
		} else {
			$excerpt = implode( ' ', $excerpt );
		}
	}
	$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
	return $excerpt;
}
