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
 * Remove widget areas inherited from the Parent theme.
 */
function remove_parent_widgets() {
	unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
}
add_action( 'widgets_init', 'Mitlib\Child\remove_parent_widgets', 11 );

/**
 * Registers the Widgetized Area Below the Content.
 */
function sidebars_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'twentytwelve' ),
			'id' => 'sidebar',
			'description' => __( 'Appears on posts and pages', 'twentytwelve' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name' => __( 'Below Content Widget Area', 'twentytwelve' ),
			'id' => 'sidebar-two',
			'description' => __( 'Appears when using the Front Page or Widgetized Page templates', 'twentytwelve' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s" role="complementary">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'Mitlib\Child\sidebars_init' );

/**
 * Define register_child_nav function.
 */
function register_child_nav() {
	register_nav_menu( 'child-nav', 'Child Nav' );
}
add_action( 'init', 'Mitlib\Child\register_child_nav' );

/**
 * Remove parent theme page templates.
 *
 * The Parent theme includes a number of page templates which are meant for only
 * one page, and which are not relevant to any site rendered by the Child theme.
 * This function removes those irrelevant templates from the list of available
 * options shown to page editors within the Child theme.
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
add_filter( 'theme_page_templates', 'Mitlib\Child\prune_inherited_templates' );

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
