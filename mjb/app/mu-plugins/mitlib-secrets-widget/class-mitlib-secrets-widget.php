<?php
/**
 * Class that defines a dashboard widget.
 *
 * @package MITlib Secrets Widget
 * @since 0.1.0
 */

namespace Mitlib\SecretsWidget;

/**
 * Defines base widget
 */
class Mitlib_Secrets_Widget {

	/**
	 * The id of this widget.
	 */
	const WID = 'mitlib_secrets';

	/**
	 * The required permission to access this page - network admins only.
	 */
	const PERMS = 'manage_network';

	/**
	 * Hook to wp_dashboard_setup to add the widget.
	 */
	public static function init() {
		// Check user capabilities.
		if ( ! current_user_can( self::PERMS ) ) {
			return;
		}

		wp_add_dashboard_widget(
			self::WID, // A unique slug/ID
			'Available Secrets', // Visible name for the widget.
			array( 'Mitlib\SecretsWidget\Mitlib_Secrets_Widget', 'widget' )  // Callback for the main widget content.
		);
	}

	/**
	 * Load the widget code
	 */
	public static function widget() {
		// Check user capabilities.
		if ( ! current_user_can( self::PERMS ) ) {
			return;
		}

		// Define the list of required fields that we expect.
		$required = array();

		// Define the default values.
		$defaults = array();

		// Load the secrets.
		$data = self::get_secrets( $required, $defaults );

		// Use the template to render widget output.
		require_once 'templates/widget.php';

	}

	/**
	 * Load the available secrets
	 *
	 * @param array $required_keys List of keys in secrets file that must exist.
	 * @param array $defaults      The default values to use in case something isn't defined.
	 * @link https://github.com/pantheon-systems/quicksilver-examples/blob/master/slack_notification/slack_notification.php
	 */
	private static function get_secrets( $required_keys, $defaults ) {
		// Check user capabilities.
		if ( ! current_user_can( self::PERMS ) ) {
			return;
		}

		$secrets_file = $_SERVER['HOME'] . '/files/private/secrets.json';
		if ( ! file_exists( $secrets_file ) ) {
			die( '<p>No secrets file found. in ' . $secrets_file . ' Aborting...</p>' );
		}
		$secrets_contents = file_get_contents( $secrets_file );
		$secrets          = json_decode( $secrets_contents, 1 );
		if ( false === $secrets ) {
			die( '<p>Could not parse json in secrets file. Aborting...</p>' );
		}
		$secrets = array_merge( $defaults, $secrets );
		$missing = array_diff( $required_keys, array_keys( $secrets ) );
		if ( ! empty( $missing ) ) {
			die( '<p>Missing required keys in json secrets file: ' . esc_html( implode( ',', $missing ) ) . '. Aborting...</p>' );
		}
		return $secrets;

	}

}
