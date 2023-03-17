<?php
/**
 * Plugin Name: MITlib Post Notebooks
 * Description: Defines the custom Notebooks post type
 * Version: 1.0.0
 * Author: MIT Libraries
 * License: GPL2
 *
 * @package MITlib Post Notebooks
 * @author MIT Libraries
 */

namespace Mitlib\PostTypes;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Require the necessary classes.
require_once( plugin_dir_path( __FILE__ ) . 'src/class-notebook.php' );

// Register class methods with the WordPress hooks which will call them.
add_action( 'init', array( 'Mitlib\PostTypes\Notebook', 'generic' ) );
add_filter( 'acf/settings/load_json', array( 'Mitlib\PostTypes\Notebook', 'load_point' ) );
add_filter( 'acf/settings/save_json', array( 'Mitlib\PostTypes\Notebook', 'save_point' ) );
