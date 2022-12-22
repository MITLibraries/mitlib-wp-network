<?php
/**
 * Plugin Name: MITlib Post
 * Description: Defines a foundation for custom post types
 * Version: 1.0.0
 * Author: MIT Libraries
 * License: GPL2
 *
 * @package MITlib Post
 * @author MIT Libraries
 */

namespace Mitlib\PostTypes;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Require the necessary classes.
require_once( plugin_dir_path( __FILE__ ) . 'src/class-base.php' );
