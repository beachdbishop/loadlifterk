<?php

add_filter( 'gform_disable_css', '__return_true' );


//-- this snippet only applies when Orbital is the selected GF default form theme.
// add_filter( 'gform_default_styles', function( $styles ) {

// 	$theme_json = json_decode( file_get_contents( get_template_directory() . '/theme.json' ), JSON_OBJECT_AS_ARRAY );

// 	$styles['buttonPrimaryBackgroundColor'] = rgars( $theme_json, 'styles/elements/button/color/background' );
// 	$styles['buttonPrimaryColor'] = rgars( $theme_json, 'styles/elements/button/color/text' );

// 	return $styles;

// } );


// Remove jQuery migrate
function ll_remove_jquery_migrate( $scripts ) {
	if ( !is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, [ 'jquery-migrate' ] );
		}
	}
}
add_action('wp_default_scripts', 'll_remove_jquery_migrate');
