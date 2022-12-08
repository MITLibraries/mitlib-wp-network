<?php
/**
 * Functions and definitions for the Music Oral History theme.
 *
 * @package Mitlib-moh
 * @since 0.0.1
 */

namespace Mitlib\Moh;

/**
 * Register and selectively enqueue the scripts and stylesheets needed for this
 * page.
 */
function moh_scripts_styles() {
	// This allows us to cache-bust these assets without needing to remember to
	// increment the theme version here.
	$theme_version = wp_get_theme()->get( 'Version' );
	$parent_version = wp_get_theme()->parent()->get( 'Version' );

	/* Register JS & CSS */
	wp_register_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), $parent_version );
	wp_register_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css', array(), '3.0.0' );
	wp_register_style( 'moh-global', get_stylesheet_directory_uri() . '/css/build/global.css', array( 'parent-style', 'bootstrap' ), $theme_version );

	wp_register_script( 'easyXDM', get_stylesheet_directory_uri() . '/js/libs/easyXDM.min.js', array( 'jquery' ), $theme_version, false );
	wp_register_script( '3play', get_stylesheet_directory_uri() . '/js/libs/3playmedia.js', array( 'jquery' ), '3.0', true, true );
	wp_register_script( '3play-player', get_stylesheet_directory_uri() . '/js/libs/3play.player.js', array( 'jquery' ), $theme_version, true );
	wp_register_script( '3play-hack', get_stylesheet_directory_uri() . '/js/3play.hack.js', array( 'jquery', '3play', '3play-player' ), $theme_version, true );
	wp_register_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array( 'jquery' ), true ); // All the bootstrap javascript goodness.

	/* Queue scripts and styles */
	wp_enqueue_script( 'bootstrap-js' );
	wp_enqueue_style( 'moh-global' );

	/* Page-specific JS */
	if ( is_page( 'search-all-interviews' ) ) {
			wp_enqueue_script( 'easyXDM' );
			wp_enqueue_script( '3play' );
			wp_enqueue_script( '3play-player' );
			wp_enqueue_script( '3play-hack' );
	}

	if ( is_single() ) {
		wp_enqueue_script( 'easyXDM' );
		wp_enqueue_script( '3play' );
	}
}

add_action( 'wp_enqueue_scripts', 'Mitlib\Moh\moh_scripts_styles' );
