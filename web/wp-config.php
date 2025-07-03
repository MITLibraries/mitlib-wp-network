<?php
/**
 * FORKED VERSION
 *
 * This is where you should at your configuration customizations. It will work out of the box on Pantheon
 * but you may find there are a lot of neat tricks to be used here.
 * 
 * For local development, see .env.local-sample.
 *
 * See our documentation for more details:
 *
 * https://pantheon.io/docs
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Multisite settings
 */
define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
$base = '/';
# define( 'DOMAIN_CURRENT_SITE', 'dev-mitlib-wp-network.pantheonsite.io' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

/**
 * Define DOMAIN_CURRENT_SITE conditionally.
 */
if ( ! empty( $_ENV['PANTHEON_ENVIRONMENT'] ) ) {
  switch( $_ENV['PANTHEON_ENVIRONMENT'] ) {
    case 'live':
      // Value should be the primary domain for the Site Network.
      define( 'DOMAIN_CURRENT_SITE', $_SERVER['HTTP_HOST'] );
      // Once you map a domain to Live, you can change DOMAIN_CURRENT_SITE
      // define( 'DOMAIN_CURRENT_SITE', 'example-network.com' );
      break;
    case 'test':
      define( 'DOMAIN_CURRENT_SITE', 'www-test.libraries.mit.edu' );
      break;
    case 'dev':
      define( 'DOMAIN_CURRENT_SITE', 'www-dev.libraries.mit.edu' );
      break;
    case 'www-ux':
      define( 'DOMAIN_CURRENT_SITE', 'www-ux.libraries.mit.edu' );
      break;
    case 'lando':
      define( 'DOMAIN_CURRENT_SITE', 'mitlib-wp-network.lndo.site' );
      break;
    default:
      # Catch-all to accommodate default naming for multi-dev environments.
      define( 'DOMAIN_CURRENT_SITE', $_ENV['PANTHEON_ENVIRONMENT'] . '-' . $_ENV['PANTHEON_SITE_NAME'] . '.pantheonsite.io' );
      break;
  }

  // Load and apply secrets. As more secrets are defined, their processing needs to be added here.
  if ( file_exists( $_SERVER['HOME'] . '/files/private/secrets.json' ) ) {
    $secrets_file = $_SERVER['HOME'] . '/files/private/secrets.json';
    $secrets = json_decode( file_get_contents( $secrets_file ), 1 );

    // WP Mail SMTP configuration is required.
    define( 'WPMS_ON', true );
    define( 'WPMS_SMTP_USER', $secrets['WPMS_SMTP_USER'] );
    define( 'WPMS_SMTP_PASS', $secrets['WPMS_SMTP_PASS'] );

    // Sentry configuration is optional.
    if ( array_key_exists( 'SENTRY_DSN', $secrets ) && $_ENV['PANTHEON_ENVIRONMENT'] != 'lando' ) {
      define( 'WP_SENTRY_DSN', $secrets['SENTRY_DSN'] );
      define( 'WP_SENTRY_ERROR_TYPES', E_ERROR & E_CORE_ERROR & E_COMPILE_ERROR );
      define( 'WP_SENTRY_VERSION', 'v1' );
      define( 'WP_SENTRY_ENV', $_ENV['PANTHEON_ENVIRONMENT'] );
    }

    // Blocked IP address handling - defined as a space-separated string in secrets, and
    // parsed to an array.
    if ( array_key_exists( 'BLOCKED_IPS', $secrets ) ) {
      define( 'BLOCKED_IPS', $secrets['BLOCKED_IPS'] );
    }
  }
}

/**
 * Respond with a 403 error message if the user IP address is on our block list.
 *
 * This assumes that BLOCKED_IPS is a string that can be exploded to an array of values.
 * It also assumes that the block list consists of individual IP addresses, and not
 * ranges that need to be calculated.
 */
if ( defined( 'BLOCKED_IPS' ) ) {
  $array_blocked_ips = explode( " ", BLOCKED_IPS );
  $request_remote_addr = $_SERVER['REMOTE_ADDR'];

  if ( in_array($request_remote_addr, $array_blocked_ips) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    exit;
  }
}


/**
 * Pantheon platform settings. Everything you need should already be set.
 */
if (file_exists(dirname(__FILE__) . '/wp-config-pantheon.php') && isset($_ENV['PANTHEON_ENVIRONMENT'])) {
	require_once(dirname(__FILE__) . '/wp-config-pantheon.php');
}

require_once dirname(__DIR__) . '/config/application.php';

require_once ABSPATH . 'wp-settings.php';
