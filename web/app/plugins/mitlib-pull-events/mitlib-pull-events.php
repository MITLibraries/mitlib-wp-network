<?php
/**
 * Plugin Name: MITlib Pull Events
 * Description: Pulls Events from calendar.mit.edu for the Libraries news site
 * Author: MIT Libraries
 * Version: 1.1.0
 *
 * @package MITLib Pull Events
 * @since 1.1.0
 */

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 Fetch only library events and exclude exhibits.
If no days specified, only current day returned.
If no  record count specified, only 10 records returned.
See https://developer.localist.com/doc/api
*/
define( 'EVENTS_URL', get_option( 'pull_url_field' ) );

include_once( 'class-pull-events-plugin.php' );

new Pull_Events_Plugin();
