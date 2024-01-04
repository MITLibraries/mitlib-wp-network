<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till div#breadcrumb
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

?><!DOCTYPE html>
<!--[if lte IE 9]><html class="no-js lte-ie9" lang="en"><![endif]-->
<!--[if !(IE 8) | !(IE 9) ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- <meta name="format-detection" content="telephone=no"> -->
	<!--<meta name="viewport" content="width=device-width" />-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="The libraries of the Massachusetts Institute of Technology - Search, Visit, Research, Explore" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php get_template_part( 'inc/header', 'opengraph' ); ?>
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="icon" href="https://cdn.libraries.mit.edu/files/branding/favicons/favicon.ico" sizes="32x32">
	<link rel="icon" href="https://cdn.libraries.mit.edu/files/branding/favicons/favicon.svg" type="image/svg+xml">
	<link rel="apple-touch-icon" href="https://cdn.libraries.mit.edu/files/branding/favicons/apple-touch-icon.png"><!-- 180×180 -->
	<link rel="manifest" href="https://cdn.libraries.mit.edu/files/branding/favicons/manifest.json">
	<?php wp_head(); ?>
	<script>
		todayDate="";
	</script>
</head>

<body <?php body_class(); ?>>
	<div id="skip"><a href="#content">Skip to Main Content</a></div>
	<div class="wrap-page">
		<header class="header-main flex-container flex-end">
			<?php get_template_part( 'inc/nav', 'hamburger' ); ?>
			<?php get_template_part( 'inc/liblogo' ); ?>
			<?php get_template_part( 'inc/nav', 'main' ); ?>
			<a class="link-logo-mit" href="http://www.mit.edu"><img src="https://cdn.libraries.mit.edu/files/branding/local/mit_logo_std_rgb_white.svg" height="32" alt="MIT logo" >
			</a><!-- End MIT Logo -->
			<?php get_template_part( 'inc/nav', 'smalldisplays' ); ?>
		</header>
