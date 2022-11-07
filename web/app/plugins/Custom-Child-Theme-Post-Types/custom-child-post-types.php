<?php
/**
 * Plugin Name: MITlib Custom Child Theme Post Types
 * Plugin URI: https://github.com/MITLibraries/Custom-Child-Theme-Post-Types
 * Description: A plugin that adds custom post types for Exhibits theme
 * Version: 1.1.0
 * Author: Phillip Bruk for MIT Libraries
 * License: GPL2
 *
 * @package Custom Child Theme Post types
 * @author Phillip Bruk for MIT Libraries
 * @link https://github.com/MITLibraries/Custom-Child-Theme-Post-Types
 */

if ( ! function_exists( 'exhibit_post_type' ) ) {
	/**
	 * Register the Exhibit custom post type
	 */
	function exhibit_post_type() {
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
	add_action( 'init', 'exhibit_post_type', 0 );
} // End if().

if ( ! function_exists( 'event_post_type' ) ) {
	/**
	 * Register the Event custom post type
	 */
	function event_post_type() {

		$labels = array(
			'name'                => _x( 'Events', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Events', 'text_domain' ),
			'name_admin_bar'      => __( 'Event', 'text_domain' ),
			'parent_item_colon'   => __( 'Event', 'text_domain' ),
			'all_items'           => __( 'All Events', 'text_domain' ),
			'add_new_item'        => __( 'Add New Event', 'text_domain' ),
			'add_new'             => __( 'New Event', 'text_domain' ),
			'new_item'            => __( 'New Event', 'text_domain' ),
			'edit_item'           => __( 'Edit Event', 'text_domain' ),
			'update_item'         => __( 'Update Event', 'text_domain' ),
			'view_item'           => __( 'View Event', 'text_domain' ),
			'search_items'        => __( 'Search Events', 'text_domain' ),
			'not_found'           => __( 'No Events found', 'text_domain' ),
			'not_found_in_trash'  => __( 'No Events found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'Event', 'text_domain' ),
			'description'         => __( 'Event', 'text_domain' ),
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
		register_post_type( 'events', $args );
	}
	add_action( 'init', 'event_post_type', 0 );
} // End if().

/**
 * Flush rewrite rules to add post_types as permalink slugs
 */
function my_rewrite_flush() {
	exhibit_post_type();
	event_post_type();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );
