<?php

function ll_json_save_point( $path ) {
	$path = get_stylesheet_directory() . '/acf-json';
	return $path;
}
add_filter('acf/settings/save_json', 'll_json_save_point');

function ll_json_load_point( $paths ) {
	unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
}
add_filter('acf/settings/load_json', 'll_json_load_point');

/**
 * Site Meta Options Page
 */
if( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(array(
		'page_title'	=> 'Site General Settings',
		'menu_title'	=> 'Site Meta',
		'menu_slug'		=> 'theme-general-settings',
		'capability'	=> 'manage_options',
		'icon_url'		=> 'dashicons-building',
	));
}

