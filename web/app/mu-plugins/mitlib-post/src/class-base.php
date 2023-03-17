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
	 * Generic define function that relies on constants defined in descendant
	 * classes.
	 */
	public static function generic() {
		$labels = array(
			'name'                => _x( static::PLURAL, 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( static::SINGULAR, 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( static::PLURAL, 'text_domain' ),
			'name_admin_bar'      => __( static::SINGULAR, 'text_domain' ),
			'parent_item_colon'   => __( static::SINGULAR, 'text_domain' ),
			'all_items'           => __( 'All ' . static::PLURAL, 'text_domain' ),
			'add_new_item'        => __( 'Add New ' . static::SINGULAR, 'text_domain' ),
			'add_new'             => __( 'New ' . static::SINGULAR, 'text_domain' ),
			'new_item'            => __( 'New ' . static::SINGULAR, 'text_domain' ),
			'edit_item'           => __( 'Edit ' . static::SINGULAR, 'text_domain' ),
			'update_item'         => __( 'Update ' . static::SINGULAR, 'text_domain' ),
			'view_item'           => __( 'View ' . static::SINGULAR, 'text_domain' ),
			'search_items'        => __( 'Search ' . static::PLURAL, 'text_domain' ),
			'not_found'           => __( 'No ' . static::PLURAL . ' found', 'text_domain' ),
			'not_found_in_trash'  => __( 'No ' . static::PLURAL . ' found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'               => __( static::SINGULAR, 'text_domain' ),
			'description'         => __( static::SINGULAR, 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'page-attributes', 'thumbnail' ),
			'taxonomies'          => array( 'category', 'post_tag', 'event' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 6,
			'menu_icon'           => 'dashicons-calendar-alt',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( strtolower( static::SINGULAR ), $args );
	}

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
