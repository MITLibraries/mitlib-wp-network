<?php
/**
 * Plugin Name: MITlib Post Bibliotechs
 * Description: Defines the custom Bibliotechs post type
 * Version: 1.0.0
 * Author: MIT Libraries
 * License: GPL2
 *
 * @package MITlib Post Bibliotechs
 * @author MIT Libraries
 */

namespace Mitlib\PostTypes;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Require the necessary classes.
require_once( plugin_dir_path( __FILE__ ) . 'src/class-bibliotech.php' );

// Register class methods with the WordPress hooks which will call them.
add_action( 'init', array( 'Mitlib\PostTypes\Bibliotech', 'define' ) );
add_action( 'init', array( 'Mitlib\PostTypes\Bibliotech', 'taxonomies' ) );
add_filter( 'acf/settings/load_json', array( 'Mitlib\PostTypes\Bibliotech', 'load_point' ) );
add_filter( 'acf/settings/save_json', array( 'Mitlib\PostTypes\Bibliotech', 'save_point' ) );
