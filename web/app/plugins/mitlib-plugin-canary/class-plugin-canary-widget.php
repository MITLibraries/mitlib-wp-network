<?php
/**
 * Class that defines a dashboard widget.
 *
 * @package MITlib Plugin Canary
 * @since 0.1.0
 */

namespace mitlib;

/**
 * Defines base widget
 */
class Plugin_Canary_Widget {

	/**
	 * The id of this widget.
	 */
	const WID = 'plugin_canary';

	/**
	 * Hook to wp_dashboard_setup to add the widget.
	 */
	public static function init() {
		if ( current_user_can( 'activate_plugins' ) ) {
			wp_add_dashboard_widget(
				self::WID, // A unique slug/ID
				'Plugin canary', // Visible name for the widget.
				array( 'mitlib\Plugin_Canary_Widget', 'widget' )  // Callback for the main widget content.
			);
		}
	}

	/**
	 * Load the widget code
	 */
	public static function widget() {
		// Get list of available plugins.
		$plugin_data = get_plugins();

		// Get available update data from site transient.
		$update_data = get_site_transient( 'update_plugins' );

		if ( false === $update_data ) {
			$update_data = 'No update data available.';
		}

		// Use the template to render widget output.
		require_once( 'widget.php' );

		// Clean up.
		$plugin_data = null;
		$update_data = null;

	}
}
