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

/**
 * Register and enqueue build stylesheets
 */
function load_styles()
{
    // Load the theme version from WordPress for use in cache busting.
    $theme_version = wp_get_theme()->get('Version');

    wp_register_style('styles', get_template_directory_uri() . '/css/build/global.css', array(), $theme_version, 'all');

    wp_enqueue_style('styles');
}
add_action('wp_enqueue_scripts', 'Mitlib\Parent\load_styles');
