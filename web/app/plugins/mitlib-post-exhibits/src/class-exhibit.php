<?php
/**
 * Class that defines the Exhibits custom post type, including fields.
 *
 * @package MITlib Post Exhibits
 * @since 0.0.1
 */

namespace Mitlib\PostTypes;

/**
 * Defines the Exhibit post type, used to record information about exhibits
 * hosted by the Libraries.
 */
class Exhibit extends Base {
	/**
	 * Called during 'init', this defines the shell of the post type.
	 */
	public static function define() {
		$labels = array(
			'name'                => _x( 'Exhibits', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Exhibit', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Exhibits', 'text_domain' ),
			'name_admin_bar'      => __( 'Exhibit', 'text_domain' ),
			'parent_item_colon'   => __( 'Maihaugen', 'text_domain' ),
			'all_items'           => __( 'All Exhibits', 'text_domain' ),
			'add_new_item'        => __( 'Add Exhibit', 'text_domain' ),
			'add_new'             => __( 'New Exhibit', 'text_domain' ),
			'new_item'            => __( 'New Exhibit', 'text_domain' ),
			'edit_item'           => __( 'Edit Exhibit', 'text_domain' ),
			'update_item'         => __( 'Update Exhibit', 'text_domain' ),
			'view_item'           => __( 'View Exhibit', 'text_domain' ),
			'search_items'        => __( 'Search Exhibits', 'text_domain' ),
			'not_found'           => __( 'No Exhibits found', 'text_domain' ),
			'not_found_in_trash'  => __( 'No Exhibits found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'Exhibit', 'text_domain' ),
			'description'         => __( 'Exhibit', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'page-attributes', 'thumbnail' ),
			'taxonomies'          => array( 'category', 'post_tag', 'exhibit' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-format-gallery',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'             => array(
				'slug' => 'exhibit',
			),
		);
		register_post_type( 'exhibits', $args );
	}
}
