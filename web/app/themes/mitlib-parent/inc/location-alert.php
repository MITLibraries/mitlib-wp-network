<?php
/**
 * Template for alerts displayed on an individual location page.
 *
 * @package MITlib_Parent
 * @since 0.2.1
 */

namespace Mitlib\Parent;

$alert_title   = cf( 'alert_title' );
$alert_content = cf( 'alert_content' );

$no_html = array();

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
	'em' => array(),
	'strong' => array(),
);

?>
<aside class="mitlib-alert">
	<i></i>
	<div>
	<h3><?php echo wp_kses( $alert_title, $no_html ); ?></h3>
	<p><?php echo wp_kses( $alert_content, $allowed_html ); ?></p>
	</div>
</aside>
