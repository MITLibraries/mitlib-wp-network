<?php
/**
 * The template for the plugin canary widget.
 *
 * @package MITlib Plugin Canary
 * @since 0.1.0
 */

?>

<style type="text/css">
.canary {
	padding: 5px;
	margin: 0;
	color: #000;
}

.canary a {
	color: #000;
}

.canary .symbol {
	font-weight: bold;
	min-width: 1em;
	display: inline-block;
}

#dashboard-widgets .canary a:hover,
#dashboard-widgets .canary a:focus {
	text-decoration: underline;
}

.listed {
	background-color: #5CB85C;
}

.updated {
	background-color: #f0ad43;
}

.ghosted {
	background-color: #d9534f;
}
</style>
<p>The list below should include every registered plugin under this Wordpress site. Entries are color-coded according to the following key:</p>
<p class="canary listed"><span class="symbol">&check;</span> Listed in the plugin directory, no update available</p>
<p class="canary updated"><span class="symbol">&excl;</span> Update available in plugin directory</p>
<p class="canary ghosted"><span class="symbol">&quest;</span> Not listed in plugin directory</p>
<hr>
<h3>Plugin status</h3>
<?php
$allowed = Array( '&quest;', '', '' );
foreach ( $plugin_data as $plugin => $value ) {
	// Each loop through this code is for a single registered plugin.
	$class = 'ghosted';
	$symbol = '&quest;';

	// Does plugin have an update?
	if ( array_key_exists( $plugin, $update_data->response ) ) {
		$class = 'updated';
		$symbol = '&excl;';
	}

	// Does plugin appear under no_updates?
	if ( array_key_exists( $plugin, $update_data->no_update ) ) {
		$class = 'listed';
		$symbol = '&check;';
	}

	echo '<p class="canary ' . esc_attr( $class ) . '">';
	echo '    <span class="symbol">' . wp_kses( $symbol, $allowed ) . '</span>';
	echo '    <a href="' . esc_url( $value['PluginURI'] ) . '">' . esc_html( $value['Name'] ) . '</a>';
	echo '</p>';
}
?>
<p><strong>Please note</strong> that there are many reasons why a plugin might not be listed in the directory. Site builders should review each such plugin and make an informed decision for themselves.</p>
