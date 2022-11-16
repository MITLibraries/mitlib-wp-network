<?php
/**
 * Plugin Name:   MITlib Home Page News
 * Description:   Displays news selected for the home page in the dashboard
 * Version:       2.0.0
 * Author:        MIT Libraries
 * Licence:       GPL2
 *
 * @package MITlib Home Page News
 * @author MIT Libraries
 */

namespace mitlib;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the necesary classes.
include_once( 'class-home-page-news-widget.php' );

// Call the class' init method as part of dashboard setup.
add_action( 'wp_dashboard_setup', array( 'mitlib\Home_Page_News_Widget', 'init' ) );
