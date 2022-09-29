<?php
/**
 * Plugin Name:   MITlib Plugin Canary
 * Plugin URI:    https://github.com/MITLibraries/mitlib-plugin-canary
 * Description:   A WordPress plugin that detects when a site is using plugins that are not listed in the official directory.
 * Version:       1.1.0
 * Author:        MIT Libraries
 * Author URI:    https://github.com/MITLibraries
 * Licence:       GPL2
 *
 * @package MITlib Plugin Canary
 * @author MIT Libraries
 * @link https://github.com/MITLibraries/mitlib-plugin-canary
 */

namespace mitlib;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the necesary classes.
include_once( 'class-plugin-canary-widget.php' );

// Call the class' init method as part of dashboard setup.
add_action( 'wp_dashboard_setup', array( 'mitlib\Plugin_Canary_Widget', 'init' ) );
