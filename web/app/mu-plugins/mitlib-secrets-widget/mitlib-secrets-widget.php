<?php
/**
 * Plugin Name: MITlib Secrets Widget
 * Plugin URI: https://github.com/mitlibraries/mitlib-secrets-widget
 * Description: A plugin to list the defined secrets (keys, not their values) coming from Pantheon's Terminus Secrets plugin
 * Version: 0.1.2
 * Author: Matt Bernhardt
 * Author URI: https://github.com/matt-bernhardt
 * License: GPL2
 *
 * @package MITlib Secrets Widget
 * @author Matt Bernhardt
 * @link https://github.com/mitlibraries/mitlib-secrets-widget
 */

/**
 * MITlib Secrets Widget is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * MITlib Secrets Widget is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MITlib Secrets Widget. If not, see {URI to Plugin License}.
 */

namespace Mitlib\SecretsWidget;

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the necessary classes.
require_once 'class-mitlib-secrets-widget.php';

// Call the class' init method as part of dashboard setup.
add_action( 'wp_dashboard_setup', array( 'Mitlib\SecretsWidget\Mitlib_Secrets_Widget', 'init' ) );
