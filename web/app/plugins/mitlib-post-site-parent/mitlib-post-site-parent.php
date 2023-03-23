<?php
/**
 * Plugin Name: MITlib Post Site (Parent site)
 * Description: Extends the built-in content types for the Parent site
 * Version: 1.0.0
 * Author: MIT Libraries
 * License: GPL2
 *
 * @package MITlib Post Site Parent
 * @author MIT Libraries
 */

namespace Mitlib\PostTypes;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Require the necessary classes.
require_once( plugin_dir_path( __FILE__ ) . 'src/class-siteparent.php' );

// Register class methods with the WordPress hooks which will call them.
add_filter( 'acf/settings/load_json', array( 'Mitlib\PostTypes\SiteParent', 'load_point' ) );
add_filter( 'acf/settings/save_json', array( 'Mitlib\PostTypes\SiteParent', 'save_point' ) );
