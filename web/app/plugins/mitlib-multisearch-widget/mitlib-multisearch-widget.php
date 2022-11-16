<?php
/**
 * Plugin Name: MITlib Multisearch Widget
 * Description: This plugin provides a widget that provides searches against multiple targets.
 * Version: 1.6.0
 * Author: MIT Libraries
 * License: GPL2
 *
 * @package Multisearch Widget
 * @author MIT Libraries
 */

namespace mitlib;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the necessary classes.
include_once( 'class-multisearch-widget.php' );

/**
 * Registers base widget.
 */
function register_multisearch_widget() {
	register_widget( 'mitlib\Multisearch_Widget' );
}
add_action( 'widgets_init', 'mitlib\register_multisearch_widget' );
