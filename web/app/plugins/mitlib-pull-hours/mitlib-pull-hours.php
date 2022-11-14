<?php
/**
 * Plugin Name:   MITlib Pull Hours
 * Plugin URI:    https://github.com/MITLibraries/mitlib-pull-hours
 * Description:   A WordPress plugin that populates a local JSON cache from a Google Spreadsheet.
 * Version:       1.0.0
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
require( plugin_dir_path( __FILE__ ) . 'src/class-admin-widget.php' );
require( plugin_dir_path( __FILE__ ) . 'src/class-dashboard.php' );
require( plugin_dir_path( __FILE__ ) . 'src/class-display-widget.php' );
require( plugin_dir_path( __FILE__ ) . 'src/class-display-widget-frontpage.php' );
require( plugin_dir_path( __FILE__ ) . 'src/class-display-widget-slim.php' );
require( plugin_dir_path( __FILE__ ) . 'src/class-harvester.php' );
require( plugin_dir_path( __FILE__ ) . 'src/class-settings.php' );

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
