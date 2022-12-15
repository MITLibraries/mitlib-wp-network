<?php
/**
 * Class that defines the Events custom post type, including fields.
 *
 * @package MITlib Post Events
 * @since 0.0.1
 */

namespace Mitlib\PostTypes;

/**
 * Defines the Event post type, used to record information about Exhibit-related
 * events.
 */
class Event extends Base {
	/**
	 * Called during 'init', this defines the shell of the post type.
	 */
	public static function define() {
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
}
