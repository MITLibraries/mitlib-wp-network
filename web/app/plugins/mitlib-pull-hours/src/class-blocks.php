<?php
/**
 * Class that defines block metadata.
 *
 * @package MITlib Pull Hours
 * @since 1.2
 */

namespace Mitlib\PullHours;

/**
 * Defines the class for block metadata.
 */
class Blocks {
	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
	 * based on the registered block metadata. Behind the scenes, it registers also all assets so they can be enqueued
	 * through the block editor in the corresponding context.
	 *
	 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
	 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
	 */
	public static function init() {
		wp_register_block_types_from_metadata_collection(
			plugin_dir_path( __DIR__ ) . '/build',
			plugin_dir_path( __DIR__ ) . '/build/blocks-manifest.php'
		);
	}
}
