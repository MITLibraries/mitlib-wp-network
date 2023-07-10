<?php
/**
 * Plugin Name: MITlib Post Experts
 * Description: Defines the custom Experts post type
 * Version: 1.0.0
 * Author: MIT Libraries
 * License: GPL2
 *
 * @package MITlib Post Experts
 * @author MIT Libraries
 */

namespace Mitlib\PostTypes;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Require the necessary classes.
require_once( plugin_dir_path( __FILE__ ) . 'src/class-expert.php' );

// Register class methods with the WordPress hooks which will call them.
add_action( 'init', array( 'Mitlib\PostTypes\Expert', 'define' ) );
add_action( 'rest_api_init', array( 'Mitlib\PostTypes\Expert', 'api_enable' ) );
add_filter( 'acf/settings/load_json', array( 'Mitlib\PostTypes\Expert', 'load_point' ) );
add_filter( 'acf/settings/save_json', array( 'Mitlib\PostTypes\Expert', 'save_point' ) );
