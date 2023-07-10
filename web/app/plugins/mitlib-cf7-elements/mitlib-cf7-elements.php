<?php
/**
 * Plugin Name: MITlib CF7 Elements
 * Description: Adds custom form controls for CF7 needed by the MIT Libraries.
 * Version: 1.2.0-beta1
 * Author: MIT Libraries
 * License: GPL2
 *
 * @package MITlib CF7 Elements
 * @author MIT Libraries
 */

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers extended widget.
 */
function add_custom_elements() {
	wpcf7_add_form_tag( 'authenticate', 'authenticate_handler' );
	wpcf7_add_form_tag( array( 'select_dlc', 'select_dlc*' ), 'dlc_handler', array( 'name-attr' => true ) );
	wpcf7_add_form_tag( 'thank_you', 'thank_you_handler', array( 'path-attr' => true ) );
}
add_action( 'wpcf7_init', 'add_custom_elements' );

/**
 * Implements custom validation for DLC selection.
 *
 * @param object $result A WPCF7_Validation object.
 * @param object $tag    A WPCF7_FormTag object.
 * @link https://contactform7.com/2015/03/28/custom-validation/
 */
function identify_required( $result, $tag ) {
	// Check if the field is marked as required.
	if ( 'select_dlc*' == $tag->type ) {
		$result = validate_dlc_filter( $result, $tag );
	}
	return $result;
}
add_filter( 'wpcf7_validate_select_dlc*', 'identify_required', 20, 2 );


/**
 * Implements custom validation for DLC selection.
 *
 * Please note that this function does not check for nonces due to a design
 * decision by CF7 not to use them by default.
 *
 * @param object $result A WPCF7_Validation object.
 * @param object $tag    A WPCF7_FormTag object.
 * @link https://contactform7.com/2015/03/28/custom-validation/
 * @link https://wordpress.org/support/topic/dealing-with-nonces-inside-a-custom-validation-function/
 */
function validate_dlc_filter( $result, $tag ) {
	// Has the DLC name been set?
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- CF7 does not use nonces by default.
	if ( empty( $_POST['department'] ) || '' == sanitize_text_field( wp_unslash( $_POST['department'] ) ) ) {
		// phpcs:enable -- Begin scanning again.
		$result->invalidate( $tag, 'Please specify your department, lab, or center.' );
	}
	return $result;
}

/**
 * Implements custom validation for radio fields.
 *
 * Please note that this function does not check for nonces due to a design
 * decision by CF7 not to use them by default.
 *
 * @param object $result A WPCF7_Validation object.
 * @param object $tag    A WPCF7_FormTag object.
 * @link https://contactform7.com/2015/03/28/custom-validation/
 * @link https://wordpress.org/support/topic/protection-against-form-hijacking/
 * @link https://wordpress.org/support/topic/dealing-with-nonces-inside-a-custom-validation-function/
 */
function validate_options( $result, $tag ) {
	// Check if the field value is not empty.
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- CF7 does not use nonces by default.
	if ( ! empty( $_POST[ $tag->name ] ) ) {
		// Look up the received value in the array of expected values.
		$value = sanitize_text_field( wp_unslash( $_POST[ $tag->name ] ) );
		// phpcs:enable -- Begin scanning again.
		if ( ! in_array( $value, $tag->values ) ) {
			$result->invalidate( $tag, 'Unexpected value received' );
		}
	}
	return $result;
}
add_filter( 'wpcf7_validate_radio', 'validate_options', 20, 2 );
add_filter( 'wpcf7_validate_select', 'validate_options', 20, 2 );
add_filter( 'wpcf7_validate_select*', 'validate_options', 20, 2 );

/**
 * Authenticate button handler.
 *
 * @param object $tag A WPCF7_FormTag object.
 */
function authenticate_handler( $tag ) {
	// We don't need the WPCF7_FormTag object here.
	unset( $tag );
	return '<button name="authenticate" onClick="loginFunctions.doLoginAndRedirect(location.pathname);">Auto-fill form (MIT only)</button>';
}

/**
 * DLC selection handler.
 *
 * This returns a select element of MIT departments, labs, and centers.
 *
 * @param object $tag A WPCF7_FormTag object.
 */
function dlc_handler( $tag ) {
	$select = '<select name="department" class="wpcf7-form-control wpcf7-select">';
	if ( 'select_dlc*' == $tag->type ) {
		// Required fields need additional attributes.
		$select = '<select name="department" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">';
	}

	$field = '<span class="wpcf7-form-control-wrap department">';
	$field .= $select;
	$field .= file_get_contents( plugin_dir_path( __FILE__ ) . 'templates/select_dlc.html' );
	$field .= '</select>';
	$field .= '</span>';
	return $field;
}

/**
 * Thank you page handler.
 *
 * This implements the redirect to a specified thank you page when present.
 *
 * @param object $tag A WPCF7_FormTag object.
 */
function thank_you_handler( $tag ) {
	$field = '<script type="text/javascript">';
	$field .= "  document.addEventListener( 'wpcf7mailsent', function( event ) {";
	$field .= "    location = '" . $tag['values'][0] . "';";
	$field .= '  }, false );';
	$field .= '</script>';
	return $field;
}
