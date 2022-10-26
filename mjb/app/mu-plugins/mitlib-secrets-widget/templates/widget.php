<?php
/**
 * The template for the secrets widget.
 *
 * @package MITlib Secrets Widget
 * @since 0.1.0
 */

?>

<p>The following secrets have been defined for this environment:</p>
<ul>
<?php
foreach ( array_keys( $data ) as $key ) {
	echo( '<li>' . esc_html( $key ) . '</li>' );
}
?>
</ul>
<p>For more information about secrets, consult the documentation for the <a href="https://github.com/pantheon-systems/terminus-secrets-plugin">Terminus Secrets Plugin</a>.</p>
