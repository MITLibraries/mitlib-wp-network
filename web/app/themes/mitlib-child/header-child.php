<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till div#breadcrumb
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

?>
<?php
if ( get_option( 'menu_style_setting' ) === 'slim' ) {
	get_header( 'slim' );
} else {
	get_header();
}
