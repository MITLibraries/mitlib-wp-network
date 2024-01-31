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
 * PLEASE NOTE:
 * - Unlike the MOH and News themes, this Child theme does NOT load the parent
 *   theme's style.css (although it does end up loading the compiled
 *   global.css).
 *
 * - The child theme's main stylesheet is loaded automatically by WordPress, but
 *   we explicitly register and enqueue it here in order to preserve the desired
 *   load order, which has an impact on how style specifity is calculated for
 *   some pages.
 */
function child_scripts_styles() {
	// This allows us to cache-bust these assets without needing to remember to
	// increment the theme version here.
	$theme_version = wp_get_theme()->get( 'Version' );

	// First we register stylesheet libraries.
	wp_register_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css', array(), '3.0.0' );
	wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css', array(), '4.6.0' );
	wp_register_style( 'interviews', get_stylesheet_directory_uri() . '/css/build/interviews.css', array(), $theme_version );
	wp_register_style( 'interviewees', get_stylesheet_directory_uri() . '/css/build/interviewees.css', array(), $theme_version );
	wp_register_style( 'child-style', get_stylesheet_uri(), array( 'parent-global', 'dashicons' ), $theme_version );

	// Then we register javascript libraries.
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array(), '1.9.1', true );
	wp_register_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array( 'jquery' ), '3.0.0' );
	wp_register_script( 'moment', get_template_directory_uri() . '/js/libs/moment.min.js', array(), $theme_version, true );
	wp_register_script( 'underscore', get_template_directory_uri() . '/js/libs/underscore.min.js', array(), $theme_version, true );
	wp_register_script( 'youtube-iframe-api', 'https://www.youtube.com/iframe_api', array(), $theme_version, true );

	// Finally we enqueue those libraries - the child theme just always enqueues everything.
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'child-style' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap-js' );
	wp_enqueue_script( 'moment' );
	wp_enqueue_script( 'underscore' );

	if ( 'interview' == get_post_type() ) {
		wp_enqueue_style( 'interviews' );
		wp_enqueue_script( 'youtube-iframe-api' );
	}

	// Load the styles for the index of interviewees only on that archive.
	if ( is_post_type_archive( 'interviewee' ) ) {
		wp_enqueue_style( 'interviewees' );
	}
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
 * Sets up theme defaults and registers the various WordPress features that it
 * supports. This was function was borrowed from Twenty Twelve.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 * @uses add_theme_support() To enable the theme's support for custom header
 *                           images.
 */
function theme_setup() {
	$args = array(
		'width' => 1250,
		'height' => 800,
		'uploads' => true,
	);
	add_theme_support( 'custom-header', $args );

	add_image_size( 'small', 100, 100, true );
}
add_action( 'after_setup_theme', 'Mitlib\Child\theme_setup' );

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
 * Remove native gallery styling.
 *
 * By default, WordPress includes some inline CSS rules when using a gallery
 * shorttag. This filter removes that, as we have our own rules in the child
 * theme for these styles.
 */
add_filter( 'use_default_gallery_style', '__return_false' );

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
 * Function to look up exhibit location information
 *
 * Multiple templates in this theme need to display information about the
 * location of an Exhibit record. This can be a bit more complex than might be
 * expected, so we have this helper function to assist.
 *
 * Exhibit locations are recorded using Categories, but they can also be placed
 * in a "Featured" category (which is not a location, and must be ignored).
 *
 * Additionally, there is a catchall category of "Uncategorized", for exhibits
 * in non-standard locations. For these Exhibits, the name to be displayed is
 * found in a custom "uncategorized_location" field.
 *
 * This function:
 * 1. Looks up all categories for the current Exhibit post ID.
 * 2. Rebuilds this list without a "Featured" item, if found. In the process it
 *    extracts only the name and slug for these categories, removing the WP_Term
 *    in favor of a simple Array.
 * 3. Calculates the displayed name for the location, along with a link and
 *    initial which the theme templates expect.
 * 4. Returns these three values (name, link, and initial) in an array.
 */
function get_exhibit_location() {
	// 1. Look up all categories for the current post ID.
	$locations_array = get_the_category();

	// 2. Rebuilt the array without a "Featured" category entry, if found.
	$locations_rebuild = array();
	foreach ( $locations_array as $term ) {
		if ( 'Featured' === $term->name ) {
			continue;
		}
		array_push(
			$locations_rebuild,
			array(
				'name' => $term->name,
				'slug' => $term->slug,
			)
		);
	}

	// 3. Calculate the name, link, and initial from the rebuilt array.
	$location_name = 'Multiple Locations';
	if ( 1 === count( $locations_rebuild ) ) {
		$location_name = $locations_rebuild[0]['name'];
		if ( 'Uncategorized' === $location_name ) {
			$location_name = get_field( 'uncategorized_location' );
		}
	}
	$location_initial = substr( $location_name, 0, 1 );

	// 4. Return those calculated values in an array.
	return array(
		'name'    => $location_name,
		'initial' => $location_initial,
	);
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
