<?php
/**
 * Child themes functions and definitions.
 *
 * @package MITlib_Child
 * @since 0.0.1
 */

namespace Mitlib\Child;

/**
 * Add theme-specific stylesheets
 *
 * @link http://mor10.com/challenges-new-method-inheriting-parent-styles-wordpress-child-themes/
 */
function setup_styles() {
	// First we enqueue style libraries.
	wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css' );
	// Then enqueues the child stylesheet with a dependency on the parent style, which _should_ enforce correct load order.
	wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'libraries-global' ), '2.2.3' );
}
add_action( 'wp_enqueue_scripts', 'Mitlib\Child\setup_styles' );
