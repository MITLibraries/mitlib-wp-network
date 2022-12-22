<?php
/**
 * Class that defines the Experts custom post type, including fields and API
 * visibility.
 *
 * @package MITlib Post Experts
 * @since 0.0.1
 */

namespace Mitlib\PostTypes;

/**
 * Defines the Expert post type, used to record information about subject matter
 * experts.
 */
class Expert extends Base {
	/**
	 * Called during 'rest_api_init', this ensures that expert posts are
	 * available via the REST API.
	 */
	public static function api_enable() {
		register_rest_field(
			'experts',
			'meta',
			array(
				'get_callback'    => function( $data, $field, $request, $type ) {
					if ( function_exists( 'get_fields' ) ) {
						return get_fields( $data['id'] );
					}
					return array();
				},
				'update_callback' => null,
				'schema'          => null,
			)
		);
	}

	/**
	 * Called during 'init', this defines the shell of the post type.
	 */
	public static function define() {
		$labels = array(
			'name' => __( 'Experts', 'custom-post-type-ui' ),
			'singular_name' => __( 'Expert', 'custom-post-type-ui' ),
			'add_new_item'        => __( 'Add Expert', 'custom-post-type-ui' ),
			'add_new' => __( 'New Expert', 'custom-post-type-ui' ),
		);

		$args = array(
			'label' => __( 'Experts', 'custom-post-type-ui' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_rest' => true,
			'rest_base' => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rest_namespace' => 'wp/v2',
			'has_archive' => false,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'delete_with_user' => false,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'menu_icon' => 'dashicons-id',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'can_export' => true,
			'rewrite' => array(
				'slug' => 'experts',
				'with_front' => true,
			),
			'query_var' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'author', 'page-attributes' ),
			'show_in_graphql' => false,
		);

		register_post_type( 'experts', $args );
	}
}
