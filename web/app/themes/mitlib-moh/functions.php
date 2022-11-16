<?php
/**
 * music-oral-history functions and definitions.
 *
 * @package Mitlib-moh
 * @since 0.0.1
 */

namespace Mitlib\Moh;

function moh_scripts_styles() {

    /* Register JS & CSS */
    wp_register_style( 'bootstrapCSS', get_stylesheet_directory_uri() . '/css/bootstrap.css', 'false', '', false );
    wp_register_style( 'global.css', get_stylesheet_directory_uri().'/css/build/minified/global.css', array( 'libraries-global' ), '20140423' );

    /* Queue scripts and styles */
    wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css' );
    wp_enqueue_style( 'global.css' );
    wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri(), array(), '20140328' );

    /* Page-specific JS */

    if ( is_page( 'search-all-interviews' ) ) {
            wp_enqueue_style( 'p3' );
    }
}

add_action( 'wp_enqueue_scripts', 'Mitlib\Moh\moh_scripts_styles' );
