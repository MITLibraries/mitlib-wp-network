<?php
/**
 * Class that defines the Locations custom post type, including fields and API
 * visibility.
 *
 * @package MITlib Post Locations
 * @since 0.0.1
 */

namespace Mitlib\PostTypes;

/**
 * Defines the Location post type, used to record information about library
 * locations around campus.
 */
class Location extends Base {
	/**
	 * Define the Location post type itself (code generated with the help of
	 * Custom Post Type UI)
	 */
	public static function define() {
		$labels = array(
			'name' => __( 'Locations', 'custom-post-type-ui' ),
			'singular_name' => __( 'Location', 'custom-post-type-ui' ),
		);

		$args = array(
			'label' => __( 'Locations', 'custom-post-type-ui' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rest_namespace' => 'wp/v2',
			'has_archive' => false,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'delete_with_user' => false,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'menu_icon' => 'dashicons-location',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'can_export' => true,
			'rewrite' => true,
			'query_var' => true,
			'supports' => array( 'title', 'editor', 'custom-fields', 'revisions', 'thumbnail', 'page-attributes' ),
			'show_in_graphql' => false,
		);

		register_post_type( 'location', $args );
	}

	/**
	 * Define the Location Types custom taxonomy, which is used to classify
	 * different location records.
	 */
	public static function taxonomies() {
		$labels = array(
			'name' => __( 'Location Types', 'custom-post-type-ui' ),
			'singular_name' => __( 'Location Type', 'custom-post-type-ui' ),
		);
		$args = array(
			'label' => __( 'Location Types', 'custom-post-type-ui' ),
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => false,
			'hierarchical' => 0,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'location-types',
				'with_front' => false,
			),
			'show_admin_column' => true,
			'show_in_rest' => false,
			'show_tagcloud' => true,
			'rest_base' => 'location-types',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
			'rest_namespace' => 'wp/v2',
			'show_in_quick_edit' => true,
			'sort' => false,
			'show_in_graphql' => false,
		);
		register_taxonomy( 'location-types', array( 'location' ), $args );
	}
}
