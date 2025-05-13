<?php
/**
 * Plugin Name: MITlib Security
 * Plugin URI: https://github.com/MITLibraries/mitlib-wp-network/tree/master/web/app/mu-plugins/mitlib-security/
 * Description: A plugin to extend the security headers across the WordPress network.
 * Version: 0.0.1
 * Author: Matt Bernhardt
 * Author URI: https://github.com/matt-bernhardt
 * License: GPL2
 *
 * @package MITlib Security
 * @author Matt Bernhardt
 * @link https://github.com/MITLibraries/mitlib-wp-network/tree/master/web/app/mu-plugins/mitlib-security/
 */

/**
 * MITlib Security is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * MITlib Security is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MITlib Security. If not, see {URI to Plugin License}.
 */

namespace Mitlib\Security;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Additional_security_headers should be self-explanatory. It extends the
 * $headers array to include some additional security-related parameters that
 * are not included by default by Pantheon or WordPress.
 *
 * @param array $headers Associative array of headers to be sent.
 * @link https://docs.pantheon.io/guides/wordpress-developer/wordpress-best-practices#security-headers
 */
function additional_security_headers( $headers ) {
	$headers['X-Frame-Options']             = 'SAMEORIGIN';

	return $headers;
}
add_filter( 'wp_headers', 'Mitlib\Security\additional_security_headers' );
