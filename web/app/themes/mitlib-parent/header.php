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
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The libraries of the Massachusetts Institute of Technology - Search, Visit, Research, Explore" />
    <link rel="icon" type="image/png" href="<?php echo esc_attr(get_template_directory_uri()); ?>/favicon.ico">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="wrap-page">
