<?php
/**
 * Class that defines the Interviewee custom post type, including fields.
 *
 * @package MITlib Post Interviewees
 * @since 1.0.0
 */

namespace Mitlib\PostTypes;

/**
 * Defines the Interviewee post type, used to record information about people
 * who are the subject of Interviews.
 */
class Interviewee extends Base {
	/**
	 * Define the Interviewee post type itself.
	 */
	public static function define() {
		$labels = array(
			'name' => __( 'Interviewees', 'custom-post-type-ui' ),
			'singular_name' => __( 'Interviewee', 'custom-post-type-ui' ),
		);

		$args = array(
			'label' => __( 'Interviewees', 'custom-post-type-ui' ),
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
			'menu_icon' => 'dashicons-admin-users',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'can_export' => true,
			'rewrite' => true,
			'query_var' => true,
			'supports' => array( 'title', 'editor', 'custom-fields', 'revisions', 'thumbnail' ),
			'taxonomies' => array( 'category', 'post_tag' ),
			'show_in_graphql' => false,
		);

		register_post_type( 'interviewee', $args );
	}
}
