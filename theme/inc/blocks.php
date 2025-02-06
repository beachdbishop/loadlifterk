<?php
/**
 * Blocks
 *
 * inspired by Bill Erickson
 */

namespace Loadlifter\Blocks;

/**
 * Load Blocks
 */
function load_blocks() {
	$theme  = wp_get_theme();
	$blocks = get_blocks();
	foreach( $blocks as $block ) {
		if ( file_exists( get_template_directory() . '/blocks/' . $block . '/block.json' ) ) {
			register_block_type( get_template_directory() . '/blocks/' . $block . '/block.json' );
			/* Do not register and enqueue style.css files */
			/* Instead put their classes in the global tailwind components.css file */
			// wp_register_style( 'block-' . $block, get_template_directory_uri() . '/blocks/' . $block . '/style.css', null, $theme->get( 'Version' ) );

			if ( file_exists( get_template_directory() . '/blocks/' . $block . '/init.php' ) ) {
				include_once get_template_directory() . '/blocks/' . $block . '/init.php';
			}
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\load_blocks', 5 );

/**
 * Load ACF field groups for blocks
 */
function load_acf_field_group( $paths ) {
	$blocks = get_blocks();
	foreach( $blocks as $block ) {
		$paths[] = get_template_directory() . '/blocks/' . $block;
	}
	return $paths;
}
add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\load_acf_field_group' );

/**
 * Get Blocks
 */
function get_blocks() {
	$theme   = wp_get_theme();
	$blocks  = get_option( 'll_blocks' );
	$version = get_option( 'll_blocks_version' );
	if ( empty( $blocks ) || version_compare( $theme->get( 'Version' ), $version ) || ( function_exists( 'wp_get_environment_type' ) && 'production' !== wp_get_environment_type() ) ) {
		$blocks = scandir( get_template_directory() . '/blocks/' );
		$blocks = array_values( array_diff( $blocks, array( '..', '.', '.DS_Store', '_base-block' ) ) );

		update_option( 'll_blocks', $blocks );
		update_option( 'll_blocks_version', $theme->get( 'Version' ) );
	}
	return $blocks;
}
