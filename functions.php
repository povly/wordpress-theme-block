<?php

$wp_get_theme = wp_get_theme();
define('ST_THEME_TEXTDOMAIN', $wp_get_theme->get('TextDomain'));
define('ST_THEME_VERSION', $wp_get_theme->get('Version'));

// Add supports
if ( ! function_exists( 'start_theme_support' ) ) :
	function start_theme_support() {

		add_theme_support( 'wp-block-styles' );
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'start_theme_support' );

// Add styles
if ( ! function_exists( 'start_theme_styles' ) ) :

	function start_theme_styles() {
		$theme_version = ST_THEME_VERSION;

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'start-theme-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'start-theme-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'start_theme_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';
