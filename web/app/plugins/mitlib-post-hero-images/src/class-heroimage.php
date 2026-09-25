<?php
/**
 * Class that defines the Hero Image custom post type, including fields and
 * API visibility.
 *
 * @package MITlib Post Hero Images
 * @since 1.0.0
 */

namespace Mitlib\PostTypes;

/**
 * Defines the HeroImage post type, used to record a featured image along with
 * its citation and citation link for use in hero sections.
 */
class HeroImage extends Base {
	/**
	 * Called during 'rest_api_init', this ensures that hero image posts are
	 * available via the REST API.
	 */
	public static function api_enable() {
		register_rest_field(
			'hero_images',
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
			'name'               => _x( 'Hero Images', 'Post Type General Name', 'text_domain' ),
			'singular_name'      => _x( 'Hero Image', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'          => __( 'Hero Images', 'text_domain' ),
			'name_admin_bar'     => __( 'Hero Image', 'text_domain' ),
			'all_items'          => __( 'All Hero Images', 'text_domain' ),
			'add_new_item'       => __( 'Add Hero Image', 'text_domain' ),
			'add_new'            => __( 'New Hero Image', 'text_domain' ),
			'new_item'           => __( 'New Hero Image', 'text_domain' ),
			'edit_item'          => __( 'Edit Hero Image', 'text_domain' ),
			'update_item'        => __( 'Update Hero Image', 'text_domain' ),
			'view_item'          => __( 'View Hero Image', 'text_domain' ),
			'search_items'       => __( 'Search Hero Images', 'text_domain' ),
			'not_found'          => __( 'No Hero Images found', 'text_domain' ),
			'not_found_in_trash' => __( 'No Hero Images found in Trash', 'text_domain' ),
		);

		$args = array(
			'label'                 => __( 'Hero Images', 'text_domain' ),
			'labels'                => $labels,
			'description'           => '',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rest_namespace'        => 'wp/v2',
			'has_archive'           => false,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => false,
			'delete_with_user'      => false,
			'exclude_from_search'   => true,
			'capability_type'       => 'post',
			'menu_icon'             => 'dashicons-format-image',
			'map_meta_cap'          => true,
			'hierarchical'          => false,
			'can_export'            => true,
			'rewrite'               => array(
				'slug'       => 'hero-images',
				'with_front' => true,
			),
			'query_var'             => true,
			'supports'              => array( 'title', 'thumbnail', 'custom-fields', 'revisions' ),
			'show_in_graphql'       => false,
		);

		register_post_type( 'hero_images', $args );
	}
}
