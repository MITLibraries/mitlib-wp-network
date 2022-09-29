<?php
/**
 * This is where you should at your configuration customizations. It will work out of the box on Pantheon
 * but you may find there are a lot of neat tricks to be used here.'
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
# define( 'DOMAIN_CURRENT_SITE', 'dev-mitlib-wp-network.sites.presalesexamples.com' );
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
      define( 'DOMAIN_CURRENT_SITE', 'test-mitlib-wp-network.sites.presalesexamples.com' );
      break;
    case 'dev':
      define( 'DOMAIN_CURRENT_SITE', 'dev-mitlib-wp-network.sites.presalesexamples.com' );
      break;
    case 'lando':
      define( 'DOMAIN_CURRENT_SITE', 'mitlib-wp-network.lndo.site' );
      break;
    default:
      # Catch-all to accommodate default naming for multi-dev environments.
      define( 'DOMAIN_CURRENT_SITE', $_ENV['PANTHEON_ENVIRONMENT'] . '-' . $_ENV['PANTHEON_SITE_NAME'] . '.sites.presalesexamples.com' );
      break;
    }
}

/**
 * Pantheon platform settings. Everything you need should already be set.
 */
if (file_exists(dirname(__FILE__) . '/wp-config-pantheon.php') && isset($_ENV['PANTHEON_ENVIRONMENT']) && ('lando' !== $_ENV['PANTHEON_ENVIRONMENT'])) {
	require_once(dirname(__FILE__) . '/wp-config-pantheon.php');
}

require_once dirname(__DIR__) . '/config/application.php';

require_once ABSPATH . 'wp-settings.php';
