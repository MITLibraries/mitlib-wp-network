<?php
/**
 * Header template for all pages.
 *
 * This constructs both the <head> element, as well as everything in the body tag through the close of the <header>
 * tags.
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="The libraries of the Massachusetts Institute of Technology - Search, Visit, Research, Explore" />
	<link rel="icon" type="image/png" href="<?php echo esc_attr( get_template_directory_uri() ); ?>/favicon.ico">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php get_template_part( 'inc/header', 'opengraph' ); ?>
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
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
			<a class="link-logo-mit" href="http://www.mit.edu" alt="Massaschusetts Institute of Technology logo"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="54" height="28" viewBox="0 0 54 28" enable-background="new 0 0 54 28" xml:space="preserve" class="logo-mit"><rect x="28.9" y="8.9" width="5.8" height="19.1" class="color"/><rect width="5.8" height="28"/><rect x="9.6" width="5.8" height="18.8"/><rect x="19.3" width="5.8" height="28"/><rect x="38.5" y="8.9" width="5.8" height="19.1"/><rect x="38.8" width="15.2" height="5.6"/><rect x="28.9" width="5.8" height="5.6"/></svg>
				<span class="sr">MIT Logo</span>
			</a><!-- End MIT Logo -->
			<?php get_template_part( 'inc/nav', 'smalldisplays' ); ?>
		</header>
		<?php
			$page_root = get_root( $post );
			$section = get_post( $page_root );
		?>
