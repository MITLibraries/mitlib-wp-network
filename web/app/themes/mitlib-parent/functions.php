<?php
/**
 * Theme functions and definitions.
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

/**
 * Ensure that the directories expected by SCSS compiler exist.
 *
 * The WP-SCSS plugin that we rely on to compile theme stylesheets requires that
 * some directories exist within the uploads directory. This function makes
 * sure that those directories have been created.
 *
 * PLEASE NOTE: This function gets called by child themes as well, so those
 * folders will be created as well.
 */
function setup_scss_folders() {
	// Look up information to build local path!
	$upload_dir = WP_CONTENT_DIR . '/uploads';
	$theme = get_option( 'stylesheet' );

	// Create the build directory, if needed.
	$build_dir = $upload_dir . '/wp-scss/' . $theme . '-build';
	if ( ! wp_mkdir_p( $build_dir ) ) {
		error_log( 'Failed to create build directory: ' . $build_dir );
	}

	// Create the cache directory, if needed.
	$cache_dir = $upload_dir . '/wp-scss/' . $theme . '-cache';
	if ( ! wp_mkdir_p( $cache_dir ) ) {
		error_log( 'Failed to create cache directory: ' . $cache_dir );
	}
}
add_action( 'after_setup_theme', 'Mitlib\Parent\setup_scss_folders' );

/**
 * Recompile SCSS stylesheets on dev and multidev tiers, but not test or live
 */
if ( isset( $_ENV['PANTHEON_ENVIRONMENT'] ) && 'test' !== $_ENV['PANTHEON_ENVIRONMENT'] && 'live' !== $_ENV['PANTHEON_ENVIRONMENT'] ) {
	define( 'WP_SCSS_ALWAYS_RECOMPILE', true );
}

/**
 * Register and selectively enqueue the scripts and stylesheets needed for this
 * page.
 */
function setup_scripts_styles() {
	// This allows us to cache-bust these assets without needing to remember to
	// increment the theme version here.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register the various stylesheets we expect to load.
	wp_register_style( 'font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,600,600italic,700,700italic', false, $theme_version, 'all' );

	wp_register_style( 'parent-styles', get_stylesheet_uri(), array(), $theme_version );

	wp_register_style( 'parent-global', get_template_directory_uri() . '/css/build/global.css', array( 'parent-styles', 'font-open-sans' ), $theme_version );

	wp_register_style( 'parent-forms', get_template_directory_uri() . '/css/build/forms.css', array( 'parent-global' ), $theme_version );

	wp_register_style( 'hours-mobile', get_template_directory_uri() . '/css/hours-mobile.css', array(), $theme_version, 'all' );
	wp_register_style( 'hours-gldatepicker', get_template_directory_uri() . '/libs/datepicker/styles/glDatePicker.default.css', array(), $theme_version, 'all' );
	wp_register_style( 'parent-hours', get_template_directory_uri() . '/css/build/hours.css', array( 'parent-global', 'hours-mobile', 'hours-gldatepicker' ), $theme_version );

	wp_register_style( 'bootstrapCSS', get_stylesheet_directory_uri() . '/css/bootstrap.css', array(), $theme_version, false );

	/**
	 * Deal with scripts (this section coming in the next ticket).
	 */

	/**
	 * The global compiled styles, and dependencies (fonts and the exception
	 * sheet) should always be loaded. The IE styles should also be loaded
	 * (in their own conditional) on every page.
	 */
	wp_enqueue_style( 'parent-global' );
	wp_enqueue_style( 'parent-ie', get_template_directory_uri() . '/css/ie.css', array( 'parent-styles' ), '20121010' );
	wp_style_add_data( 'parent-ie', 'conditional', 'lt IE 9' );

	/**
	 * Conditionally enqueue assets.
	 */
	if ( is_page_template( 'page-authenticate.php' ) || is_page_template( 'page-forms.php' ) || is_page_template( 'templates/page.php' ) ) {
		wp_enqueue_style( 'parent-forms' );
	}

	if ( is_page( 'hours' ) ) {
		wp_enqueue_style( 'parent-hours' );
	}

	if ( in_category( 'has-menu' ) ) {
		wp_enqueue_style( 'bootstrapCSS' );
	}
}
add_action( 'wp_enqueue_scripts', 'Mitlib\Parent\setup_scripts_styles' );

/**
 * The following functions get called in various places by theme templates.
 */

/**
 * The get_root function finds the post at the root of a content tree below a
 * specified leaf post.
 *
 * @param WP_Post $post The post we are starting from.
 */
function get_root( $post ) {
	$ar = get_post_ancestors( $post );

	$is_section = get_post_meta( $post->ID, 'is_section', 1 );

	$count_ar = count( $ar );

	for ( $i = 0; $i < $count_ar; $i++ ) {
		$pid = $ar[ $i ];
		$is_section = get_post_meta( $pid, 'is_section', 1 );
		if ( 1 == $is_section ) {
			return $pid;
		}
	}

	$max = count( $ar ) - 1;

	if ( -1 == $max ) {
		return $post->ID;
	} else {
		return $ar[ $max ];
	}
}

/**
 * Registers our main widget areas.
 */
function mitlib_sidebars_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'mitlib' ),
			'id' => 'sidebar-1',
			'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'mitlib' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name' => __( 'First Front Page Widget Area', 'mitlib' ),
			'id' => 'sidebar-2',
			'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'mitlib' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name' => __( 'Second Front Page Widget Area', 'mitlib' ),
			'id' => 'sidebar-3',
			'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'mitlib' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name' => __( 'Masthead Search Bar', 'mitlib' ),
			'id' => 'sidebar-search',
			'description' => __( 'Appears under the MIT Libraries masthead, and houses the search interface', 'mitlib' ),
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			'class' => '',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Front Page Hours Area', 'mitlib' ),
			'id'            => 'sidebar-hours',
			'description'   => __( 'Appears on the front page template to display hours information', 'mitlib' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Migrated Content Notice', 'mitlib' ),
			'id'            => 'sidebar-404',
			'description'   => __( 'Appears on the 404 page, allowing individual sites to post notices about migrated content', 'mitlib' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'Mitlib\Parent\mitlib_sidebars_init' );
