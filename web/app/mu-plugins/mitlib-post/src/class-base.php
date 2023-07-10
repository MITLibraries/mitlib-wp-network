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
	 * This determines the appropriate subfolder to load based on which child
	 * class is being called.
	 *
	 * For example, the Mitlib\PostTypes\Exhibit class would end up loading the
	 * files located in data\exhibit, while Mitlib\PostTypes\Location would load
	 * from data\location.
	 */
	public static function identify_subfolder() {
		$class = get_called_class();
		$arr_class = explode( '\\', $class );
		$last_class = end( $arr_class );
		return strtolower( $last_class );
	}

	/**
	 * Called during acf/settings/load_json. This attempts to load field groups
	 * defined within a subfolder named after the class name which called this
	 * method.
	 *
	 * @param Array $paths An array of paths where JSON files describing field
	 * information can be loaded.
	 */
	public static function load_point( $paths ) {
		// Identify, from context, which subfolder needs to be loaded.
		$subfolder = self::identify_subfolder();

		// Remove any previously-set paths (could be removed).
		unset( $paths[0] );

		// Append the desired location to the array of searched paths.
		$paths[] = plugin_dir_path( __FILE__ ) . "../data/{$subfolder}";

		// Return the array.
		return $paths;
	}

	/**
	 * Called during acf/settings/save_json
	 *
	 * @param String $path A local path where field information will be saved.
	 */
	public static function save_point( $path ) {
		// Identify, from context, which subfolder needs to be loaded.
		$subfolder = self::identify_subfolder();

		return plugin_dir_path( __FILE__ ) . "../data/{$subfolder}";
	}
}
