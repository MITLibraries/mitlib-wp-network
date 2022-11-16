<?php
/**
 * News theme functions and definitions
 *
 * @package MITlib_News
 * @since 0.0.1
 */

namespace Mitlib\News;

/**
 * Add Bootstrap and mobile CSS for non-admin users
 */
function not_admin() {
	wp_enqueue_style( 'bootstrapCSS', get_stylesheet_directory_uri() . '/css/bootstrap.css', 'false', '', false );
	wp_enqueue_style( 'newsmobile', get_stylesheet_directory_uri() . '/css/newsmobile.css', 'false', '', false );
}
if ( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'Mitlib\News\not_admin' );
}

/**
 * Add stylesheets for all users.
 */
function add_styles() {
	// Load FontAwesome via CDN.
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'Mitlib\News\add_styles' );

/**
 * Hide addthis widget from non-admins on dashboard
 */
function hide_addthis() {
	global $user_level;
	if ( '10' != $user_level ) {
	   echo '<style type="text/css">
		   #at_widget,
		   .metabox-prefs label:nth-child(13) {
			   display: none;
			   }
		 </style>';
	}
}
add_action( 'admin_head', 'hide_addthis' );

/**
 * Registers custom css file for admin dashboard
 */
function registerCustomAdminCss() {
$src = '/wp-content/themes/mit-libraries-news/custom-admin-css.css';
$handle = 'customAdminCss';
wp_register_script( $handle, $src );
wp_enqueue_style( $handle, $src, array(), false, false );
	}
	add_action( 'admin_head', 'registerCustomAdminCss' );
