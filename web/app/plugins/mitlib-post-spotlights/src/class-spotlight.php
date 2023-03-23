<?php
/**
 * Class that defines the Spotlights custom post type, including fields.
 *
 * @package MITlib Post Spotlights
 * @since 1.0.0
 */

namespace Mitlib\PostTypes;

/**
 * Defines the Spotlight post type, used for short pointers to external
 * resources (MIT News articles, calendar entries, or non-news pages).
 */
class Spotlight extends Base {
	/**
	 * Called during 'init', this defines the shell of the post type.
	 */
	public static function define() {
		$labels = array(
			'name'                => _x( 'Spotlights', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Spotlight', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Spotlights', 'text_domain' ),
			'name_admin_bar'      => __( 'Spotlight', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Spotlight', 'text_domain' ),
			'all_items'           => __( 'All Spotlights', 'text_domain' ),
			'add_new_item'        => __( 'Add New Spotlight - should be about 60 characters', 'text_domain' ),
			'add_new'             => __( 'New Spotlight', 'text_domain' ),
			'new_item'            => __( 'New Spotlight', 'text_domain' ),
			'edit_item'           => __( 'Edit Spotlight', 'text_domain' ),
			'update_item'         => __( 'Update Spotlight', 'text_domain' ),
			'view_item'           => __( 'View Spotlight', 'text_domain' ),
			'search_items'        => __( 'Search Spotlights', 'text_domain' ),
			'not_found'           => __( 'No Spotlights found', 'text_domain' ),
			'not_found_in_trash'  => __( 'No Spotlights found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'Spotlight', 'text_domain' ),
			'description'         => __( 'Spotlight', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title' ),
			'taxonomies'          => array( 'category' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-megaphone',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'spotlights', $args );
	}
}
