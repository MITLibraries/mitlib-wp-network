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
	wp_register_style(
		'mitlib-blocks-global',
		plugins_url( 'css/global.css', __FILE__ ),
		array( 'v2-color', 'v2-corners', 'v2-spacing' ),
		$plugin_version
	);
}
add_action( 'init', 'Mitlib\Blocks\register_assets' );

/**
 * Registers theme v2 style handles when they are not already available.
 */
function register_v2_style_fallbacks() {
	$theme_version = wp_get_theme()->get( 'Version' );
	$styles        = array(
		'v2-color'      => 'color',
		'v2-corners'    => 'corners',
		'v2-spacing'    => 'spacing',
	);

	foreach ( $styles as $handle => $file ) {
		if ( ! wp_style_is( $handle, 'registered' ) ) {
			wp_register_style(
				$handle,
				get_template_directory_uri() . '/css/v2/variables/' . $file . '.css',
				array(),
				$theme_version
			);
		}
	}
}

/**
 * Loads global block styles in the editor and on the front end.
 */
function enqueue_block_styles() {
	register_v2_style_fallbacks();
	wp_enqueue_style( 'mitlib-blocks-global' );
}
add_action( 'enqueue_block_assets', 'Mitlib\Blocks\enqueue_block_styles' );

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
 * Replaces the core button styles with MIT Libraries button styles.
 *
 * @param array  $args      Block registration arguments.
 * @param string $block_name Block type name.
 * @return array
 */
function filter_button_styles( $args, $block_name ) {
	if ( 'core/button' !== $block_name ) {
		return $args;
	}

	$args['styles'] = array(
		array(
			'name'      => 'primary',
			'label'     => __( 'Primary', 'mitlib-blocks' ),
			'isDefault' => true,
		),
		array(
			'name'  => 'secondary',
			'label' => __( 'Secondary', 'mitlib-blocks' ),
		),
	);

	return $args;
}
add_filter( 'register_block_type_args', 'Mitlib\Blocks\filter_button_styles', 10, 2 );

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
