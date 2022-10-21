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
function setup_scss_folders()
{
    // Look up information to build local path.
    $upload_dir = WP_CONTENT_DIR . '/uploads';
    $theme = get_option('stylesheet');

    // Create the build directory, if needed.
    $build_dir = $upload_dir . '/wp-scss/' . $theme . '-build';
    if (!wp_mkdir_p($build_dir)) {
        error_log('Failed to create build directory: ' . $build_dir);
    }

    // Create the cache directory, if needed.
    $cache_dir = $upload_dir . '/wp-scss/' . $theme . '-cache';
    if (!wp_mkdir_p($cache_dir)) {
        error_log('Failed to create cache directory: ' . $cache_dir);
    }
}
add_action('after_setup_theme', 'Mitlib\Parent\setup_scss_folders');

// TODO: Make this happen on multidevs and dev tier, not test or live
define('WP_SCSS_ALWAYS_RECOMPILE', true);

/**
 * Register and selectively enqueue the scripts and stylesheets needed for this
 * page.
 */
function setup_scripts_styles()
{
    // This allows us to cache-bust these assets without needing to remember to
    // increment the theme version here.
    $theme_version = wp_get_theme()->get('Version');

    // Deal with stylesheets.
    wp_register_style('font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,600,600italic,700,700italic', false, null, 'all');

    wp_enqueue_style('parent-styles', get_stylesheet_uri());

    wp_register_style('parent-global', get_template_directory_uri().'/css/build/global.css', array('parent-styles', 'font-open-sans'), $theme_version);

    wp_enqueue_style('parent-global');

    wp_register_style('parent-forms', get_template_directory_uri() . '/css/build/forms.css', array('parent-global'), $theme_version);

    wp_register_style('parent-getit', get_template_directory_uri() . '/css/build/get-it.css', array('parent-global'), $theme_version);

    wp_register_style('hours-mobile', get_template_directory_uri() . '/css/hours-mobile.css', false, null, 'all');

    wp_register_style('hours-gldatepicker', get_template_directory_uri() . '/libs/datepicker/styles/glDatePicker.default.css', false, null, 'all');

    wp_register_style('parent-hours', get_template_directory_uri() . '/css/build/hours.css', array('parent-global', 'hours-mobile', 'hours-gldatepicker'), $theme_version);

    wp_register_style('bootstrapCSS', get_stylesheet_directory_uri() . '/css/bootstrap.css', 'false', '', false);

    wp_register_style('jquery.smartmenus.bootstrap', '/css/bootstrap-css/jquery.smartmenus.bootstrap.js', false, false);

    // Load the Internet Explorer-specific stylesheet
    wp_enqueue_style('parent-ie', get_template_directory_uri() . '/css/ie.css', array('parent-style'), '20121010');
    wp_style_add_data('parent-ie', 'conditional', 'lt IE 9');

    // Deal with scripts.

    // Deregister WP Core jQuery, load Google's.
    wp_deregister_script( 'jquery' );

    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '1.11.1-local', false );

    wp_register_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array( 'jquery' ), true ); // All the bootstrap javascript goodness.

    wp_register_script( 'jquery.smartmenus', '/js/bootstrap-js/jquery.smartmenus.js', array( 'jquery' ), true ); // All the bootstrap javascript goodness.

    wp_register_script( 'bootstrap-min', '/js/bootstrap-js/bootstrap.min.js', array( 'jquery' ), true ); // All the bootstrap javascript goodness.

    wp_register_script( 'jquery.smartmenus.bootstrap.min', '/js/bootstrap-js/jquery.smartmenus.bootstrap.min.js', array( 'jquery' ), true ); // All the bootstrap javascript goodness.

    wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.8.1', false );

    wp_register_script( 'moment', get_template_directory_uri() . '/js/libs/moment.min.js', array(), '2.9.0', true );

    wp_register_script( 'underscore', get_template_directory_uri() . '/js/libs/underscore.js', array(), '1.7.0', true );

    wp_register_script( 'homeJS', get_template_directory_uri() . '/js/build/home.min.js', array( 'jquery', 'modernizr', 'moment', 'underscore' ), '1.10.0', true );

    wp_register_script( 'productionJS', get_template_directory_uri() . '/js/build/production.min.js', array( 'jquery', 'moment', 'underscore' ), '1.10.0', true );

    wp_register_script( 'polyfill', '//polyfill.io/v3/polyfill.js?version=3.52.1', array(), '3.52.1', true );

    wp_register_script( 'hours-loader', get_template_directory_uri() . '/js/hours-loader.js', array( 'moment', 'underscore', 'polyfill' ), '1.10.0', true );

    wp_register_script( 'hours-gldatepickerJS', get_template_directory_uri() . '/libs/datepicker/glDatePicker.min.js', false, null, true );

    wp_register_script( 'hoursJS', get_template_directory_uri() . '/js/build/hours.min.js', array( 'jquery', 'productionJS', 'hours-gldatepickerJS' ), '1.10.0', true );

    wp_register_script( 'searchJS', get_template_directory_uri() . '/js/build/search.min.js', array( 'jquery', 'modernizr' ), '1.5.5', false );

    wp_register_script( 'mapJS', get_template_directory_uri() . '/js/build/map.min.js', array( 'jquery' ), '1.5.5', true );

    wp_register_script( 'googleMapsAPI', '//maps.googleapis.com/maps/api/js?key=AIzaSyDJg6fTKm3Pa_NfKEVAdyeRUbVs7zZm5Nw', array(), '1.7.0', true );

    wp_register_script( 'infobox', get_template_directory_uri() . '/libs/infobox/infobox.js', array( 'googleMapsAPI' ), '1.1.12', true );

    wp_register_script( 'privacyJS', get_template_directory_uri() . '/js/privacy-notice.js' , array(), $theme_version, false );

    /* All-site JS */

    wp_enqueue_script( 'hours-loader' );

    wp_enqueue_script( 'modernizr' );

    wp_enqueue_script( 'privacyJS' );

    /* Page-specific JS & CSS */

    if ( ! is_front_page() || is_child_theme() ) {
        wp_enqueue_script( 'productionJS' );
    }

    if ( is_front_page() && ! is_child_theme() ) {
        wp_enqueue_script( 'homeJS' );
    }

    if ( is_page_template( 'page-authenticate.php' ) || is_page_template( 'page-forms.php' ) || is_page_template( 'page.php' ) ) {
        wp_enqueue_style( 'mitlib-forms' );
        wp_enqueue_script( 'formsJS' );
    }

    if ( is_page( 'hours' ) ) {
        wp_enqueue_style( 'hours' );
        wp_enqueue_script( 'hoursJS' );
    }

    if ( is_page( 'locations' ) ) {
        wp_enqueue_script( 'googleMapsAPI' );
        wp_enqueue_script( 'mapJS' );
        wp_enqueue_script( 'infobox' );
    }

    if ( is_page( 'search' ) ) {
        wp_enqueue_script( 'searchJS' );
    }

    if ( is_page_template( 'nav-maine' ) ) {
        wp_enqueue_style( 'jquery.smartmenus.bootstrap' );
        wp_enqueue_script( 'bootstrap.min' );
        wp_enqueue_script( 'jquery.smartmenus.bootstrap.min' );
        wp_enqueue_script( 'jquery.smartmenus' );
    }

    if ( in_category( 'has-menu' ) ) {
        wp_enqueue_style( 'libraries-global' );
        wp_enqueue_style( 'bootstrapCSS' );
        wp_enqueue_script( 'bootstrap-js' );
    }

}
add_action('wp_enqueue_scripts', 'Mitlib\Parent\setup_scripts_styles');

/**
 * The following functions get called in various places by theme templates.
 */

function get_root($post)
{
    $ar = get_post_ancestors($post);

    $is_section = get_post_meta($post->ID, 'is_section', 1);

    $count_ar = count($ar);

    for ($i = 0; $i < $count_ar; $i++) {
        $pid = $ar[ $i ];
        $is_section = get_post_meta($pid, 'is_section', 1);
        if ($is_section == 1) {
            return $pid;
        }
    }

    $max = count($ar) - 1;

    if ($max == -1) {
        return $post->ID;
    } else {
        return $ar[$max];
    }
}
