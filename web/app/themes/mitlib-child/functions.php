<?php
/**
 * Child themes functions and definitions.
 *
 * @package MITlib_Child
 * @since 0.0.1
 */

namespace Mitlib\Child;

/**
 * Add theme-specific stylesheets.
 *
 * PLEASE NOTE: Unlike the MOH and News themes, this Child theme does NOT
 * load the parent theme's style.css (although it does end up loading the
 * compiled global.css).
 */
function child_scripts_styles() {
	// First we enqueue style libraries.
	wp_register_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css', array(), '3.0.0' );
	wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css', array(), '4.6.0' );

	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'font-awesome' );
}
add_action( 'wp_enqueue_scripts', 'Mitlib\Child\child_scripts_styles' );
