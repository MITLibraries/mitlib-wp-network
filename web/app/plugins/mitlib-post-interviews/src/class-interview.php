<?php
/**
 * Class that defines the Interview custom post type, including fields.
 *
 * @package MITlib Post Interviews
 * @since 1.0.0
 */

namespace Mitlib\PostTypes;

/**
 * Defines the Interview post type, used to record information about oral
 * history interviews hosted by the Libraries' website.
 */
class Interview extends Base {
	/**
	 * Define the Interview post type itself.
	 */
	public static function define() {
		$labels = array(
			'name' => __( 'Interviews', 'custom-post-type-ui' ),
			'singular_name' => __( 'Interview', 'custom-post-type-ui' ),
		);

		$args = array(
			'label' => __( 'Interviews', 'custom-post-type-ui' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'publicly_queryable' => true,
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
			'menu_icon' => 'dashicons-format-chat',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'can_export' => true,
			'rewrite' => true,
			'query_var' => true,
			'supports' => array( 'title', 'custom-fields', 'revisions' ),
			'show_in_graphql' => false,
		);

		register_post_type( 'interview', $args );
	}
}
