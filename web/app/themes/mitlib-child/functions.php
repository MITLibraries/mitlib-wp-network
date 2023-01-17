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
	// First we register stylesheet libraries.
	wp_register_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css', array(), '3.0.0' );
	wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css', array(), '4.6.0' );

	// Then we register javascript libraries.
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array(), '1.9.1', true );
	wp_register_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array( 'jquery' ), '3.0.0' );

	// Finally we enqueue those libraries - the child theme just always enqueues everything.
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap-js' );
}
add_action( 'wp_enqueue_scripts', 'Mitlib\Child\child_scripts_styles' );

/**
 * ============================================================================
 * ============================================================================
 * These functions are defined here, without adding them via add_action. They
 * may be called by the templates within the theme.
 */

/**
 * Allows for custom excerpt lengths
 *
 * @param int    $new_length The new length of the excerpt.
 * @param scalar $new_more The string to append when trimming the excerpt.
 */
function custom_excerpt( $new_length = 20, $new_more = '...' ) {
	add_filter(
		'excerpt_length',
		function () use ( $new_length ) {
			return $new_length;
		},
		999
	);
	add_filter(
		'excerpt_more',
		function () use ( $new_more ) {
			return $new_more;
		}
	);
	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- This could have a wide variety of markup from rich text fields.
	echo '<p>' . $output . '</p>';
	// phpcs:enable -- Start scanning again.
}

/**
 * Get URL of first image in a post
 */
function get_first_post_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = $matches [1] [0];

	// Defines a default image.
	if ( empty( $first_img ) ) {
		$first_img = '';
	}
	return $first_img;
}
