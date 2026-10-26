<?php
/**
 * Plugin Name:       Mitlib - Blocks
 * Description:       Registers the custom MIT Libraries editor blocks.
 * Version:           1.1.0
 * Requires at least: 6.8
 * Requires PHP:      7.4
 * Author:            MIT Libraries
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mitlib-blocks
 *
 * @package MITlib Blocks
 */

namespace Mitlib\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers external assets for use by blocks defined in this plugin.
 */
function register_assets() {
	$plugin_version = get_file_data( __FILE__, array( 'Version' => 'Version' ) )['Version'];
	wp_register_style(
		'fontawesome',
		'//cdn.libraries.mit.edu/files/fontawesome/7.1.0/css/all.min.css',
		array(),
		$plugin_version
	);
}
add_action( 'init', 'Mitlib\Blocks\register_assets' );

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
add_action( 'init', 'Mitlib\Blocks\register_blocks' );

/**
 * Registers a new category that will contain the Libraries' custom blocks.
 *
 * @param array $categories Array of categories for block types.
 */
function register_category( $categories ) {
	return array_merge(
		array(
			array(
				'slug' => 'mitlib',
				'title' => 'MIT Libraries',
				'icon' => null,
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'Mitlib\Blocks\register_category' );
