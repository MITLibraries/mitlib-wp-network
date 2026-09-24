<?php
/**
 * Plugin Name: MITlib Post Hero Images
 * Description: Defines the custom Hero Images post type
 * Version: 1.0.0
 * Author: MIT Libraries
 * License: GPL2
 *
 * @package MITlib Post Hero Images
 * @author MIT Libraries
 */

namespace Mitlib\PostTypes;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Require the necessary classes.
require_once( plugin_dir_path( __FILE__ ) . 'src/class-heroimage.php' );

// Register class methods with the WordPress hooks which will call them.
add_action( 'init', array( 'Mitlib\PostTypes\HeroImage', 'define' ) );
add_action( 'rest_api_init', array( 'Mitlib\PostTypes\HeroImage', 'api_enable' ) );
add_filter( 'acf/settings/load_json', array( 'Mitlib\PostTypes\HeroImage', 'load_point' ) );
add_filter( 'acf/settings/save_json', array( 'Mitlib\PostTypes\HeroImage', 'save_point' ) );

/**
 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
 * based on the registered block metadata. Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function register_blocks() {
	wp_register_block_types_from_metadata_collection(
		__DIR__ . '/build',
		__DIR__ . '/build/blocks-manifest.php'
	);
}
add_action( 'init', 'Mitlib\PostTypes\register_blocks' );
