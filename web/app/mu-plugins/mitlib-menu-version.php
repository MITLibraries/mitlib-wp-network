<?php
/**
 * Plugin Name: MITlib Menu Version
 * Description: Network setting for the site navigation version.
 * Version: 1.0.0
 * Author: MIT Libraries
 *
 * @package Mitlib\MenuVersion
 */

namespace Mitlib\MenuVersion;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const OPTION_NAME = 'mitlib_menu_version';

/**
 * Get the header and footer variant selected for the network.
 *
 * @return string The template suffix, or an empty string for the old templates.
 */
function get_header_footer_variant() {
	return 'new' === get_site_option( OPTION_NAME, 'old' ) ? 'v2' : '';
}

/**
 * Render the Menu Version field in Network Settings.
 */
function render_network_setting() {
	$current_version = get_site_option( OPTION_NAME, 'old' );
	?>
	<h2>Menu Version</h2>
	<table class="form-table" role="presentation">
		<tr>
			<th scope="row">Menu Version</th>
			<td>
				<fieldset>
					<legend class="screen-reader-text"><span>Menu Version</span></legend>
					<label>
						<input type="radio" name="<?php echo esc_attr( OPTION_NAME ); ?>" value="old" <?php checked( $current_version, 'old' ); ?>>
						Old Navigation
					</label><br>
					<label>
						<input type="radio" name="<?php echo esc_attr( OPTION_NAME ); ?>" value="new" <?php checked( $current_version, 'new' ); ?>>
						New Navigation
					</label>
				</fieldset>
			</td>
		</tr>
	</table>
	<?php
}
add_action( 'wpmu_options', __NAMESPACE__ . '\\render_network_setting' );

/**
 * Validate and save the network-level setting from Network Settings.
 */
function save_network_setting() {
	if ( ! current_user_can( 'manage_network_options' ) ) {
		return;
	}
	check_admin_referer( 'siteoptions' );

	if ( ! isset( $_POST[ OPTION_NAME ] ) || ! is_string( $_POST[ OPTION_NAME ] ) ) {
		return;
	}

	$menu_version = sanitize_key( wp_unslash( $_POST[ OPTION_NAME ] ) );
	if ( in_array( $menu_version, array( 'old', 'new' ), true ) ) {
		update_site_option( OPTION_NAME, $menu_version );
	}
}
add_action( 'update_wpmu_options', __NAMESPACE__ . '\\save_network_setting' );