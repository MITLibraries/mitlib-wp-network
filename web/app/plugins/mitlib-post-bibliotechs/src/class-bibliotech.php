<?php
/**
 * Class that defines the Bibliotechs custom post type, including fields.
 *
 * @package MITlib Post Bibliotechs
 * @since 1.0.0
 */

namespace Mitlib\PostTypes;

/**
 * Defines the Bibliotech post type, used to record information about articles
 * in issues of the Bibliotech publication.
 */
class Bibliotech extends Base {
	/**
	 * Called during 'init', this defines the shell of the post type.
	 */
	public static function define() {
		$labels = array(
			'name'                => _x( 'Bibliotechs', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Bibliotech', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Bibliotechs', 'text_domain' ),
			'name_admin_bar'      => __( 'Bibliotech', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Bibliotech', 'text_domain' ),
			'all_items'           => __( 'All Bibliotechs', 'text_domain' ),
			'add_new_item'        => __( 'Add New Bibliotech', 'text_domain' ),
			'add_new'             => __( 'New Bibliotech', 'text_domain' ),
			'new_item'            => __( 'New Bibliotech', 'text_domain' ),
			'edit_item'           => __( 'Edit Bibliotech', 'text_domain' ),
			'update_item'         => __( 'Update Bibliotech', 'text_domain' ),
			'view_item'           => __( 'View Bibliotech', 'text_domain' ),
			'search_items'        => __( 'Search Bibliotechs', 'text_domain' ),
			'not_found'           => __( 'No Bibliotechs found', 'text_domain' ),
			'not_found_in_trash'  => __( 'No Bibliotechs found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'Bibliotech', 'text_domain' ),
			'description'         => __( 'Bibliotech', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'          => array( 'category' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-media-document',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'bibliotech', $args );
	}

	/**
	 * Define the Bibliotech Issues custom taxonomy, which is used to group
	 * articles according to the issue in which they originally appeared.
	 */
	public static function taxonomies() {
		$labels = array(
			'name'                       => _x( 'Bibliotechs', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Bibliotech', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Issues', 'text_domain' ),
			'all_items'                  => __( 'All Issues', 'text_domain' ),
			'parent_item'                => __( 'Parent Issue', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Issue:', 'text_domain' ),
			'new_item_name'              => __( 'New Issue', 'text_domain' ),
			'add_new_item'               => __( 'Add New Issue', 'text_domain' ),
			'edit_item'                  => __( 'Edit Issue', 'text_domain' ),
			'update_item'                => __( 'Update Issue', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate Issues with commas', 'text_domain' ),
			'search_items'               => __( 'Search Issues', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or Remove Issues', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used Issues', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'bibliotech_issues', array( 'bibliotech' ), $args );
	}
}
