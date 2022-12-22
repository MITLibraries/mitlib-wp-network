<?php
/**
 * Class that defines the Base custom post type.
 *
 * @package MITlib Post
 * @since 0.0.1
 */

namespace Mitlib\PostTypes;

/**
 * Defines the Base class for custom post types.
 */
class Base {
	/**
	 * Called during acf/settings/load_json
	 *
	 * @param Array $paths An array of paths where JSON files describing field
	 * information can be loaded.
	 */
	public static function load_point( $paths ) {
		// Remove any previously-set paths (could be removed).
		unset( $paths[0] );

		// Append the desired location to the array.
		$paths[] = plugin_dir_path( __FILE__ ) . '../data';

		// Return the array.
		return $paths;
	}

	/**
	 * Called during acf?settings/save_json
	 *
	 * @param String $path A local path where field information will be saved.
	 */
	public static function save_point( $path ) {
		return plugin_dir_path( __FILE__ ) . '../data';
	}
}
