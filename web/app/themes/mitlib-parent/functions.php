<?php
/**
 * Theme functions and definitions.
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

/**
 * We use Navwalker to render custom secondary menus in a mobile-friendly way,
 * via the menu-secondary.php partial.
 *
 * TODO: Refactor this. We were told that Navwalker needs to be at the theme
 * root for it to function, which I'm skeptical of. Options include:
 * - Leave as is, at theme root, with explicit loading
 * - Move into the lib/ directory, alongside the bespoke news library
 * - Load via Packagist, if version 2.0.4 is available and we can access it from
 *   there.
 */
require_once( 'navwalker.php' );

/**
 * We use lib/news.php to render a selection of news articles on the front page,
 * and also for debugging this feature on a Featured News template.
 */
require_once( 'lib/news.php' );

/**
 * Define custom query params. Right now this is just the `v` parameter used by
 * the map template.
 */
function register_params() {
	global $wp;
	$wp->add_query_var( 'v' );
}
add_action( 'init', 'Mitlib\Parent\register_params' );

/**
 * Sets up theme defaults and registers the various WordPress features that it
 * supports. This was function was borrowed from Twenty Twelve.
 *
 * @uses add_editor_style() To add a visual editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 0.2.0
 */
function theme_setup() {
	/**
	 * If this theme were to support translation, we would call
	 * load_theme_textdomain here.
	 */

	/**
	 * This theme styles the visual editor with editor-style.css to match the
	 * theme style.
	 */
	add_editor_style();

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', 'Primary Menu' );
	register_nav_menu( 'secondary', 'Secondary Menu' );
	register_nav_menu( 'footer', 'Footer Menu' );

	/**
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop.
}
add_action( 'after_setup_theme', 'Mitlib\Parent\theme_setup' );

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

	/**
	 * Register stylesheets.
	 */

	wp_register_style( 'font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,600,600italic,700,700italic', false, $theme_version, 'all' );

	wp_register_style( 'parent-styles', get_stylesheet_uri(), array(), $theme_version );

	wp_register_style( 'parent-global', get_template_directory_uri() . '/css/build/global.css', array( 'parent-styles', 'font-open-sans' ), $theme_version );

	wp_register_style( 'parent-forms', get_template_directory_uri() . '/css/build/forms.css', array( 'parent-global' ), $theme_version );

	wp_register_style( 'hours-mobile', get_template_directory_uri() . '/css/hours-mobile.css', array(), $theme_version, 'all' );
	wp_register_style( 'hours-gldatepicker', get_template_directory_uri() . '/libs/datepicker/styles/glDatePicker.default.css', array(), $theme_version, 'all' );
	wp_register_style( 'parent-hours', get_template_directory_uri() . '/css/build/hours.css', array( 'parent-global', 'hours-mobile', 'hours-gldatepicker' ), $theme_version );

	wp_register_style( 'bootstrapCSS', get_stylesheet_directory_uri() . '/css/bootstrap.css', array(), $theme_version, false );

	wp_register_style( 'super-admin', get_template_directory_uri() . '/css/super-admin.css', array(), $theme_version, false );

	/**
	 * Register javascript.
	 */

	// Deregister WP Core jQuery, load our own.
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '1.11.1-local', false );

	// Register other third-party libraries that will be loaded.
	wp_register_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array( 'jquery' ), '3.0.0' );

	wp_register_script( 'gldatepickerJS', get_template_directory_uri() . '/libs/datepicker/glDatePicker.min.js', array(), '2.0', true );

	wp_register_script( 'googleMapsAPI', '//maps.googleapis.com/maps/api/js?key=AIzaSyDJg6fTKm3Pa_NfKEVAdyeRUbVs7zZm5Nw', array(), '1.7.0', true );

	wp_register_script( 'jquery-cookie', get_template_directory_uri() . '/js/libs/jquery.cookie/jquery.cookie.js', array(), '1.3', true );

	wp_register_script( 'jquery-sticky', get_template_directory_uri() . '/js/libs/jquery.sticky/jquery.sticky.js', array(), '1.0.0', true );

	wp_register_script( 'infobox', get_template_directory_uri() . '/libs/infobox/infobox.js', array( 'googleMapsAPI' ), '1.1.12', true );

	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr.min.js', array(), '2.8.3', false );

	// Register javascript that we've written.
	wp_register_script( 'dev', get_template_directory_uri() . '/js/dev.js', array(), $theme_version, true );
	wp_register_script( 'fonts', get_template_directory_uri() . '/js/fonts.js', array(), $theme_version, false );
	wp_register_script( 'libchat', get_template_directory_uri() . '/js/libchat.js', array( 'jquery' ), $theme_version, true );
	wp_register_script( 'menu-toggle', get_template_directory_uri() . '/js/menu.toggle.js', array(), $theme_version, true );
	wp_register_script( 'parent-production', get_template_directory_uri() . '/js/alerts.js', array( 'dev', 'fonts', 'jquery', 'libchat', 'menu-toggle' ), $theme_version, true );

	// Interior bundle.
	wp_register_script( 'parent-interior', get_template_directory_uri() . '/js/core.js', array(), $theme_version, true );

	// Homepage bundle.
	wp_register_script( 'parent-experts-home', get_template_directory_uri() . '/js/experts-home.js', array( 'jquery' ), $theme_version, true );
	wp_register_script( 'parent-guides-home', get_template_directory_uri() . '/js/guides-home.js', array( 'jquery' ), $theme_version, true );
	wp_register_script( 'parent-hours-home', get_template_directory_uri() . '/js/hours-home.js', array( 'jquery' ), $theme_version, true );

	// Hours bundle.
	wp_register_script( 'hours-scrollStick', get_template_directory_uri() . '/js/hours.scrollStick.js', array( 'jquery-cookie' ), $theme_version, true );
	wp_register_script( 'hours-stickyMenu', get_template_directory_uri() . '/js/sticky-hours.menu.js', array( 'jquery-sticky' ), $theme_version, true );
	wp_register_script( 'moment', get_template_directory_uri() . '/js/libs/moment.min.js', array(), $theme_version, true );
	wp_register_script( 'underscore', get_template_directory_uri() . '/js/libs/underscore.min.js', array(), $theme_version, true );
	wp_register_script( 'hours-loader-theme', get_template_directory_uri() . '../../../plugins/mitlib-pull-hours/js/hours-loader.js', array(), $theme_version, true );
	wp_register_script( 'parent-hours', get_template_directory_uri() . '/js/make.datepicker.js', array( 'jquery', 'gldatepickerJS', 'hours-scrollStick', 'hours-stickyMenu', 'underscore', 'moment', 'hours-loader-theme' ), $theme_version, true );

	// Search bundle.
	wp_register_script( 'search-ie', get_template_directory_uri() . '/js/search-ie.js', array(), $theme_version, false );
	wp_register_script( 'parent-search', get_template_directory_uri() . '/js/search.js', array( 'jquery', 'modernizr', 'search-ie' ), $theme_version, false );

	// Map bundle.
	wp_register_script( 'parent-map', get_template_directory_uri() . '/js/map.js', array( 'googleMapsAPI', 'infobox', 'jquery' ), $theme_version, true );

	/* All-site JS */
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'parent-production' );
	wp_add_inline_script( 'fonts', 'const THEME_ROOT = "' . esc_js( get_template_directory_uri() ) . '";', 'before' );

	/* Page-specific JS & CSS */

	// Everything other than the site homepage.
	if ( ! is_front_page() || is_child_theme() ) {
		wp_enqueue_script( 'parent-interior' );
	}

	// The site homepage (but not sub-site homepages).
	if ( is_front_page() && ! is_child_theme() ) {
		wp_enqueue_script( 'parent-experts-home' );
		wp_enqueue_script( 'parent-guides-home' );
		wp_enqueue_script( 'parent-hours-home' );
		wp_enqueue_script( 'parent-search' );
		wp_enqueue_script( 'parent-hours' );
	}

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
	if ( is_super_admin() ) {
		wp_enqueue_style( 'super-admin' );
	}

	if ( is_page_template( 'page-authenticate.php' ) || is_page_template( 'page-forms.php' ) || is_page_template( 'templates/page.php' ) ) {
		wp_enqueue_style( 'parent-forms' );
		wp_enqueue_script( 'formsJS' );
	}

	// While some parts of the site load hours via widgets (which enqueue the
	// hours loader and its dependencies on their own), other parts of the site
	// load hours via templates. For the templates, we enqueue the hours loader
	// via these conditionals.
	if ( is_page( 'hours' ) ) {
		wp_enqueue_style( 'parent-hours' ); // This hours styles are focused on the datepicker, which is specific to this one page.
		wp_enqueue_script( 'parent-hours' );
	}

	if ( is_page_template( 'templates/page-location-2021.php' ) || is_page_template( 'templates/page-location.php' ) || is_page_template( 'templates/page-study-spaces.php' ) ) {
		wp_enqueue_script( 'parent-hours' );
	}

	if ( is_page( 'locations' ) ) {
		wp_enqueue_script( 'parent-map' );
	}

	if ( is_page( 'search' ) ) {
		wp_enqueue_script( 'parent-search' );
	}

	if ( in_category( 'has-menu' ) ) {
		wp_enqueue_style( 'bootstrapCSS' );
		wp_enqueue_script( 'bootstrap-js' );
	}
}
add_action( 'wp_enqueue_scripts', 'Mitlib\Parent\setup_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function customize_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title; }

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( 'Page %s', max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'Mitlib\Parent\customize_title', 10, 2 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function customize_preview_js() {
	// This allows us to cache-bust these assets without needing to remember to
	// increment the theme version here.
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_register_script( 'customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview', 'jquery' ), $theme_version, true );

	wp_enqueue_script( 'customizer' );
}
add_action( 'customize_preview_init', 'Mitlib\Parent\customize_preview_js' );

/**
 * Adds custom fields to 'post' and 'experts' API endpoints
 *
 * @link http://v2.wp-api.org/extending/modifying/
 * @link https://gist.github.com/rileypaulsen/9b4505cdd0ac88d5ef51#gistcomment-1622466
 */
function api_alter() {
	// Add custom fields to posts endpoint.
	register_rest_field(
		'post',
		'meta',
		array(
			'get_callback'    => function( $data, $field, $request, $type ) {
				if ( function_exists( 'get_fields' ) ) {
					return get_fields( $data['id'] );
				}
				return array();
			},
			'update_callback' => null,
			'schema'          => null,
		)
	);

	// Switch featured_media field from media ID to URL of the image.
	register_rest_field(
		'experts',
		'featured_media',
		array(
			'get_callback'    => 'Mitlib\Parent\api_get_image',
			'update_callback' => null,
			'schema'          => null,
		)
	);
}
add_action( 'rest_api_init', 'Mitlib\Parent\api_alter' );

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

	register_sidebar( array(
		'name'          => __( 'Location Hours Area', 'twentytwelve' ),
		'id'            => 'sidebar-location-hours',
		'description'   => __( 'Appears on library location pages, displaying a widget which displays the current hours for arbitrary locations. This enables a single location to display multiple sets of hours.', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Below Hours Grid Area', 'twentytwelve' ),
		'id'            => 'sidebar-below-hours-grid',
		'description'   => __( 'Appears below the grid of library hours, allowing for widgets to describe locations that do not appear on the grid.', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s locations-more" role="complementary">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'Mitlib\Parent\mitlib_sidebars_init' );

/**
 * This changes the name of the always-present Default Template to something
 * more descriptive, since this theme has edited index.php to return no
 * response.
 *
 * @uses default_page_template_title Overrides the usual name for index.php
 */
function update_default_template_name() {
	return __( 'Blank template - do not use', 'mitlib' );
}
add_filter( 'default_page_template_title', 'Mitlib\Parent\update_default_template_name' );

/**
 * Extends the default WordPress body class to denote:
 * 1. The post type and name (useful for contexts like the network homepage).
 * 2. Use of a full-width layout when the primary sidebar is not present.
 * 3. Adding a class to identify when a child theme is active.
 * 4. Adding a class for the various location page templates.
 * 3. Noting when a page has a single author (which corresponds to a handful of
 *    CSS rules being activated).
 * These conditions correspond to various styling rules found across the
 * stylesheets.
 *
 * @uses body_class Filters the list of classes on the body tag.
 * @param array $classes Existing class values.
 * @return array $classes Filtered class values.
 */
function customize_body_class( $classes ) {
	global $post;

	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'full-width'; }

	if ( is_child_theme() ) {
		$classes[] = 'childTheme';
	}

	if ( is_page_template( 'templates/page-location.php' ) || is_page_template( 'templates/page-location-2021.php' ) ) {
		$classes[] = 'locationPage';
	}

	if ( ! is_multi_author() ) {
		$classes[] = 'single-author'; }

	return $classes;
}
add_filter( 'body_class', 'Mitlib\Parent\customize_body_class' );

/**
 * Defines a new value for the length of the excerpt.
 *
 * @param int $length Number of words to include in the excerpt.
 * @return int The maximum number of words to include from the excerpt.
 */
function custom_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'Mitlib\Parent\custom_excerpt_length', 999 );

/**
 * ============================================================================
 * ============================================================================
 * These functions are defined here, without adding them via add_action. They
 * may be called by the templates within the theme.
 */

/**
 * Get the value of a specified field for use in the API. This function is
 * called by api_alter above
 *
 * @param array  $object Details of current post.
 * @param string $field_name Name of field.
 *
 * @return mixed
 */
function api_get_image( $object, $field_name ) {
	$link = wp_get_attachment_image_src( $object[ $field_name ], 'thumbnail-size' );
	return $link[0];
}

/**
 * Provides an alternative way for building a breadcrumb.
 */
function better_breadcrumbs() {

	global $post;

	if ( is_search() ) {
		echo '<span>Search</span>';
	}

	if ( ! is_child_page() && is_page() || is_category() || is_single() ) {
		echo '<span>' . esc_html( the_title() ) . '</span>';
		return;
	}

	if ( is_child_page() ) {
		$hide_parent = get_field( 'hide_parent_breadcrumb' );
		$parent_link = get_permalink( $post->post_parent );
		$parent_title = get_the_title( $post->post_parent );
		$start_link = '<a href="';
		$end_link = '">';
		$close_link = '</a>';
		$parent_breadcrumb = $start_link . $parent_link . $end_link . $parent_title . $close_link;
		$page_title = get_the_title( $post );
		$page_link = get_permalink( $post );
		$child_breadcrumb = $start_link . $page_link . $end_link . $page_title . $close_link;

		$allowed_html = array(
			'a' => array(
				'href' => array(),
			),
		);
		if ( '' != $parent_breadcrumb && 1 != $hide_parent ) {
			echo '<span>' . wp_kses( $parent_breadcrumb, $allowed_html ) . '</span>';
		}
		if ( '' != $child_breadcrumb ) {
			echo '<span>' . esc_html( $page_title ) . '</span>';
		}
	}
}

/**
 * The cf function is a thin wrapper around the get_post_meta function, allowing
 * simpler references to custom fields within page templates.
 *
 * This could potentially be removed by converting page templates to use the
 * get_field function provided by ACF.
 *
 * @param String $name The name of the custom field being loaded.
 * @uses get_post_meta Retrieves a post meta field for a given post ID.
 */
function cf( $name ) {
	return get_post_meta( get_the_ID(), $name, true );
}

/**
 * The content_nav function displays navigation to next/previous pages when
 * applicable.
 *
 * @param string $html_id The value to use for the ID attribute of the nav
 *                        element.
 */
function content_nav( $html_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr( $html_id ); ?>" class="navigation" role="navigation">
			<h3 class="assistive-text">Post navigation</h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo esc_attr( $html_id ); ?> .navigation -->
		<?php
	endif;
}

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
 * The is_child_page function determines whether a piece of content is a Page
 * record, and whether it has an assigned parent. If these are the case, it
 * returns the parent.
 *
 * If either is not the case, it returns false.
 */
function is_child_page() {
	global $post;     // If outside the loop.

	if ( is_page() && $post->post_parent ) {
		return $post->post_parent;
	} else {
		return false;
	}
}
