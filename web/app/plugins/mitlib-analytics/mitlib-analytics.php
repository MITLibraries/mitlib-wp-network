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
	register_setting( 'mitlib_analytics', 'mitlib_matomo_property_id' );
	register_setting( 'mitlib_analytics', 'mitlib_matomo_url' );

	// Register a section for libraries settings on the mitlib-analytics page.
	add_settings_section(
		'mitlib_analytics_general',
		__( 'Libraries settings', 'mitlib_analytics' ),
		'mitlib\mitlib_analytics_section_libraries',
		'mitlib-analytics'
	);

	// Register a new field in the "mitlib_analytics_general" section, inside the "mitlib-analytics" page.
	add_settings_field(
		'mitlib_matomo_property_id',
		__( 'Matomo Analytics Property ID', 'mitlib_analytics' ),
		'mitlib\mitlib_analytics_property_callback',
		'mitlib-analytics',
		'mitlib_analytics_general',
		array(
			'label_for' => 'mitlib_matomo_property_id',
			'class' => 'mitlib_analytics_row',
		)
	);

	// Register the domain list field in the "mitlib_analytics_general" section, inside the "mitlib-analytics" page.
	add_settings_field(
		'mitlib_matomo_url',
		__( 'Matomo URL', 'mitlib_analytics' ),
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
	<p>These settings control the Libraries-level analytics information.</p>
	<?php
}

/**
 * Field rendering callback: Matomo property
 */
function mitlib_analytics_property_callback() {
	// Get the settings value.
	$options = get_site_option( 'mitlib_matomo_property_id' );
	?>
	<input
		type="text"
		name="<?php echo esc_attr( 'mitlib_matomo_property_id' ); ?>"
		value="<?php echo esc_attr( $options ); ?>"
		id="<?php echo esc_attr( 'mitlib_matomo_property_id' ); ?>"
		size="20">
	<p>If you aren't sure what value to use, please contact UX/Web Services.</p>
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
	<p>The base URL for the Matomo instance to which analytics will be reported, including trailing forward-slash.</p>
  <p>E.g., <pre>https://matomo.example.org/</pre></p>
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
			$mitlib_matomo_property_id = '';
			$mitlib_matomo_url = '';
			// Matomo property ID.
			if ( filter_input( INPUT_POST, 'mitlib_matomo_property_id' ) ) {
				$mitlib_matomo_property_id = sanitize_text_field(
					wp_unslash( filter_input( INPUT_POST, 'mitlib_matomo_property_id' ) )
				);
			}
			// Matomo URL.
			if ( filter_input( INPUT_POST, 'mitlib_matomo_url' ) ) {
				$mitlib_matomo_url = sanitize_text_field(
					wp_unslash( filter_input( INPUT_POST, 'mitlib_matomo_url' ) )
				);
			}
			update_site_option( 'mitlib_matomo_property_id', $mitlib_matomo_property_id );
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
 * View function that outputs the Matomo code on public pages.
 */
function mitlib_analytics_view() {
	echo "<!-- Matomo -->
  <script>
    var _paq = window._paq = window._paq || [];
    /* tracker methods like 'setCustomDimension' should be called before 'trackPageView' */
    _paq.push(['setDocumentTitle', document.domain + '/'' + document.title]);
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
      var u='" . esc_html( get_site_option( 'mitlib_matomo_url' ) ) . "';
      _paq.push(['setTrackerUrl', u+'matomo.php']);
      _paq.push(['setSiteId', '" . esc_html( get_site_option( 'mitlib_matomo_property_id' ) ) . "']);
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
      g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <!-- End Matomo Code -->";
}
add_action( 'wp_footer', 'mitlib\mitlib_analytics_view' );
