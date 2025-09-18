<?php
/**
 * Class that defines a theme settings dashboard for a Google Maps integration.
 * This includes both the page and individual setting field.
 *
 * @package MITlib_Parent
 * @since 0.8
 */

namespace Mitlib\Parent;

/**
 * Defines settings dashboard for maps integration. This class gets loaded and
 * hooked into from the theme's functions.php file.
 */
class Maps {
	/**
	 * The required permission to access the admin page.
	 */
	const PERMS = 'manage_options';

	/**
	 * This defines the admin page which holds the settings management form.
	 */
	public static function init() {
		if ( current_user_can( self::PERMS ) ) {
			add_options_page(
				'Maps',
				'Map',
				self::PERMS,
				'mitlib-maps-dashboard',
				array( 'Mitlib\Parent\Maps', 'dashboard' )
			);
		}
	}

	/**
	 * This defines the content displayed on the admin page. It also receives the
	 * submission of the web form on that page, and calls the update action when
	 * needed.
	 */
	public static function dashboard() {
		// Confirm user capabilities before doing anything.
		if ( ! current_user_can( self::PERMS ) ) {
			return;
		}

		// If the form has been posted, the update method handles that.
		$action = filter_input( INPUT_POST, 'action' );
		if ( ! empty( $action ) ) {
			self::update();
		}

		// Finally, we render the form itself.
		echo '<div class="wrap">';
		echo '<h1>Maps settings</h1>';
		echo '<p>This form will update the Google Maps API key which grants us access to use their map assets on our locations page.</p>';
		echo '<p>This key is managed by the web-lib@mit.edu user as part of the <a href="https://console.cloud.google.com/apis/credentials?project=api-project-260287310852">Google Cloud Platform</a>.</p>';
		echo '<form method="post" action="">';
		wp_nonce_field( 'custom_nonce_action', 'custom_nonce_field' );
		settings_fields( 'mitlib_parent_maps' );
		do_settings_sections( 'mitlib-maps-dashboard' );
		submit_button( 'Update maps settings' );
		echo '</form>';
		echo '</div>';
	}

	/**
	 * This is the general descriptive statement at the top of the settings form.
	 * We don't use this, but the method needs to exist.
	 */
	public static function general() {
		echo '';
	}

	/**
	 * Field rendering callback for the Google Maps key setting.
	 */
	public static function google_maps_key_callback() {
		$google_maps_key = get_option( 'google_maps_key' );
		echo '<input type="text" name="google_maps_key" value="' . esc_attr( $google_maps_key ) . '" id="google_maps_key" size="60">';
	}

	/**
	 * Register the setting field which holds the Google maps key. This includes
	 * creating a section, which is a bit overkill for only one setting, but here
	 * we are.
	 */
	public static function settings() {
		register_setting( 'mitlib_parent_maps', 'google_maps_key' );

		add_settings_section(
			'mitlib_parent_maps_general',
			'General settings',
			array( 'Mitlib\Parent\Maps', 'general' ),
			'mitlib-maps-dashboard'
		);

		add_settings_field(
			'google_maps_key',
			'Google Maps API key',
			array( 'Mitlib\Parent\Maps', 'google_maps_key_callback' ),
			'mitlib-maps-dashboard',
			'mitlib_parent_maps_general',
			array(
				'label_for' => 'google_maps_key',
				'class' => 'mitlib_maps_row',
			)
		);
	}

	/**
	 * Update setting based on posted form information.
	 */
	public static function update() {
		check_admin_referer( 'custom_nonce_action', 'custom_nonce_field' );

		if ( 'update' == filter_input( INPUT_POST, 'action' ) ) {
			$google_maps_key = '';

			if ( filter_input( INPUT_POST, 'google_maps_key' ) ) {
				$google_maps_key = sanitize_text_field(
					wp_unslash( filter_input( INPUT_POST, 'google_maps_key' ) )
				);
			}

			update_option( 'google_maps_key', $google_maps_key );
		}

		echo( '<div class="updated"><p>The maps settings have been updated.</p></div>' );
	}
}
