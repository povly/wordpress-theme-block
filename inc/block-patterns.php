<?php

function start_theme_register_block_patterns() {
	$block_pattern_categories = array(
		'hero' => array( 'label' => __( 'Hero', ST_THEME_TEXTDOMAIN ) ),
	);

	$block_pattern_categories = apply_filters( 'start_theme_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}

	$block_patterns = array(
		'hero-text'
	);

	/**
	 * Filters the theme block patterns.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @param array $block_patterns List of block patterns by name.
	 */
	$block_patterns = apply_filters( 'start_theme_block_patterns', $block_patterns );

	foreach ( $block_patterns as $block_pattern ) {
		$pattern_file = get_theme_file_path( '/inc/patterns/' . $block_pattern . '.php' );

		register_block_pattern(
			'start_theme/' . $block_pattern,
			require $pattern_file
		);
	}
}
add_action( 'init', 'start_theme_register_block_patterns', 25 );
