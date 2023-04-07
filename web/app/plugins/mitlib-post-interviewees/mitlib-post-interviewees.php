<?php
/**
 * Plugin Name: MITlib Post Interviewees
 * Description: Defines the custom Interviewees post type
 * Version: 1.0.0
 * Author: MIT Libraries
 * License: GPL2
 *
 * @package MITlib Post Interviewees
 * @author MIT Libraries
 */

namespace Mitlib\PostTypes;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Require the necessary classes.
require_once( plugin_dir_path( __FILE__ ) . 'src/class-interviewee.php' );

// Register class methods with the WordPress hooks which will call them.
add_action( 'init', array( 'Mitlib\PostTypes\Interviewee', 'define' ) );
add_filter( 'acf/settings/load_json', array( 'Mitlib\PostTypes\Interviewee', 'load_point' ) );
add_filter( 'acf/settings/save_json', array( 'Mitlib\PostTypes\Interviewee', 'save_point' ) );
