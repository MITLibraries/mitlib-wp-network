<?php
/**
 * Plugin Name: MITlib Analytics
 * Description: This plugin provides a thin implementation of Google Analytics tracking for use across domains.
 * Version: 1.1.0-beta2
 * Author: MIT Libraries
 * License: GPL2
 *
 * @package MITlib Analytics
 * @author MIT Libraries
 */

namespace mitlib;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Creates plugin options and settings
 */
function mitlib_analytics_init() {
	// Register a new setting for the Matomo property.
	register_setting( 'mitlib_analytics', 'mitlib_matomo_url' );

	// Register a section for libraries settings on the mitlib-analytics page.
	add_settings_section(
		'mitlib_analytics_general',
		__( 'Libraries settings', 'mitlib_analytics' ),
		'mitlib\mitlib_analytics_section_libraries',
		'mitlib-analytics'
	);

	// Register the domain list field in the "mitlib_analytics_general" section, inside the "mitlib-analytics" page.
	add_settings_field(
		'mitlib_matomo_url',
		__( 'Matomo Tag Manager URL', 'mitlib_analytics' ),
		'mitlib\mitlib_analytics_url_callback',
		'mitlib-analytics',
		'mitlib_analytics_general',
		array(
			'label_for' => 'mitlib_matomo_url',
			'class' => 'mitlib_analytics_row',
		)
	);
}
add_action( 'admin_init', 'mitlib\mitlib_analytics_init' );

/**
 * Create network admin settings page
 */
function mitlib_analytics_menu() {
	add_menu_page(
		'MITlib Analytics Options',
		'MITlib Analytics',
		'manage_options',
		'mitlib-analytics',
		'mitlib\mitlib_analytics_page_html'
	);
}
add_action( 'network_admin_menu', 'mitlib\mitlib_analytics_menu' );

/**
 * Section rendering callback
 */
function mitlib_analytics_section_libraries() {
	?>
	<p>These settings control the Libraries-level analytics information. They implement a Matomo Tag Manager container across all network sites.</p>
	<?php
}

/**
 * Field rendering callback: Matomo URL
 */
function mitlib_analytics_url_callback() {
	// Get the settings value.
	$options = get_site_option( 'mitlib_matomo_url' );
	?>
	<input
		type="text"
		name="<?php echo esc_attr( 'mitlib_matomo_url' ); ?>"
		value="<?php echo esc_attr( $options ); ?>"
		id="<?php echo esc_attr( 'mitlib_matomo_url' ); ?>"
		size="60">
	<p>The base URL for the Matomo Tag Manager instance to which analytics will be reported. The URL must contain the container id.</p>
  <p>E.g., <pre>https://matomo.mitlibrary.net/js/container_12345678.js</pre></p>
	<?php
}

/**
 * Options page for settings form
 */
function mitlib_analytics_page_html() {
	// Check user capabilities.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Maybe handle post actions here?
	$action = filter_input( INPUT_POST, 'action' );
	if ( ! empty( $action ) ) {
		// Check for validity.
		echo '<div class="updated"><p>Analytics settings updated.</p></div>';
		check_admin_referer( 'custom_nonce_action', 'custom_nonce_field' );

		// Update settings.
		if ( 'update' == filter_input( INPUT_POST, 'action' ) ) {
			// Set default values.
			$mitlib_matomo_url = '';
			// Matomo URL.
			if ( filter_input( INPUT_POST, 'mitlib_matomo_url' ) ) {
				$mitlib_matomo_url = sanitize_text_field(
					wp_unslash( filter_input( INPUT_POST, 'mitlib_matomo_url' ) )
				);
			}
			update_site_option( 'mitlib_matomo_url', $mitlib_matomo_url );
		}
	}

	// Build the form.
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form method="post" action="admin.php?page=mitlib-analytics">
			<?php
			// Nonce field, because Wordpress can't manage to do this itself.
			wp_nonce_field( 'custom_nonce_action', 'custom_nonce_field' );
			// Output security fields for this form.
			settings_fields( 'mitlib_analytics' );
			// Output settings sections and their fields.
			do_settings_sections( 'mitlib-analytics' );
			// Output the form submit button.
			submit_button( 'Save Settings' );
			?>
		</form>
	</div>
	<?php
}

/**
 * View function that outputs the Matomo Tag Manager code into the header of all pages
 */
function mitlib_analytics_tag_manager_view() {
	echo "
	<!-- Matomo Tag Manager -->
<script>
  var _mtm = window._mtm = window._mtm || [];
  _mtm.push({'mtm.startTime': (new Date().getTime()), 'event': 'mtm.Start'});
  (function() {
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src='" . esc_html( get_site_option( 'mitlib_matomo_url' ) ) . "'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Tag Manager -->";
}
add_action( 'wp_head', 'mitlib\mitlib_analytics_tag_manager_view' );
