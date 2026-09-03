<?php
/**
 * Plugin Name:   MITlib Pull Hours
 * Plugin URI:    https://github.com/MITLibraries/mitlib-pull-hours
 * Description:   A WordPress plugin that populates a local JSON cache from a Google Spreadsheet.
 * Version:       1.2
 * Author:        MIT Libraries
 * Author URI:    https://github.com/MITLibraries
 * Licence:       GPL2
 *
 * @package MITlib Pull Hours
 * @author MIT Libraries
 * @link https://github.com/MITLibraries/mitlib-pull-hours
 */

namespace Mitlib\PullHours;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the necesary classes.
require_once( plugin_dir_path( __FILE__ ) . 'src/class-admin-widget.php' );
require_once( plugin_dir_path( __FILE__ ) . 'src/class-dashboard.php' );
require_once( plugin_dir_path( __FILE__ ) . 'src/class-display-widget.php' );
require_once( plugin_dir_path( __FILE__ ) . 'src/class-display-widget-frontpage.php' );
require_once( plugin_dir_path( __FILE__ ) . 'src/class-display-widget-slim.php' );
require_once( plugin_dir_path( __FILE__ ) . 'src/class-harvester.php' );
require_once( plugin_dir_path( __FILE__ ) . 'src/class-settings.php' );

/**
 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
 * based on the registered block metadata. Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function register_blocks() {
	wp_register_block_types_from_metadata_collection(
		__DIR__ . '/build',
		__DIR__ . '/build/blocks-manifest.php'
	);
}
add_action( 'init', 'Mitlib\PullHours\register_blocks' );

// Register classes with their hooks.
// The settings fields themselves as the admin side initializes...
add_action( 'admin_init', array( 'Mitlib\PullHours\Settings', 'init' ) );
// The settings dashboard gets included with the admin menu...
add_action( 'admin_menu', array( 'Mitlib\PullHours\Dashboard', 'init' ) );
// The admin widget gets included with the dashboard setup...
add_action( 'wp_dashboard_setup', array( 'Mitlib\PullHours\Admin_Widget', 'init' ) );
// The rest of the user-facing widgets get included with those widgets.
add_action( 'widgets_init', array( 'Mitlib\PullHours\Display_Widget', 'init' ) );
add_action( 'widgets_init', array( 'Mitlib\PullHours\Display_Widget_Slim', 'init' ) );
add_action( 'widgets_init', array( 'Mitlib\PullHours\Display_Widget_Frontpage', 'init' ) );
