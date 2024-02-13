<?php

// SEO Footer Shortcode --> [seo_about /]
function ll_seo_about_shortcode() {
	$acfout = get_field( 'seo_footer_text', 'option' );
	ob_start();

	echo $acfout;

	return ob_get_clean();
}
add_shortcode( 'seoabout', 'll_seo_about_shortcode' );
add_shortcode( 'seo_about', 'll_seo_about_shortcode' );


// Menu Shortcode
function ll_listmenu_shortcode($atts, $content = null) {
	extract(
		shortcode_atts(
			[
				'menu' => '',
				'container' => 'div',
				'container_class' => '',
				'container_id' => '',
				'menu_class' => 'menu',
				'menu_id' => '',
				'echo' => true,
				'fallback_cb' => 'wp_page_menu',
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'depth' => 1,
				'theme_location' => '',
			],
			$atts
		)
	);

	return wp_nav_menu([
		'menu' => $menu,
		'container' => $container,
		'container_class' => $container_class,
		'container_id' => $container_id,
		'menu_class' => $menu_class,
		'menu_id' => $menu_id,
		'echo' => false,
		'fallback_cb' => $fallback_cb,
		'before' => $before,
		'after' => $after,
		'link_before' => $link_before,
		'link_after' => $link_after,
		'depth' => $depth,
		'walker' => new LL_Menu_Walker(),
		'theme_location' => $theme_location,
	]);
}
add_shortcode( 'listmenu', 'll_listmenu_shortcode' );


/**
 * Using a shortcode to conditionally enqueue the a11y-slider js
 */
function ll_a11y_slider_shortcode() {
	return '';
}
add_shortcode( 'a11yslider', 'll_a11y_slider_shortcode' );

/* * * * C O U N T S * * * */

// Client count shortcode
function ll_count_clients_shortcode() {
	$acfout = get_field( 'count_clients', 'option' );
	return number_format( $acfout );
}
add_shortcode( 'count_clients', 'll_count_clients_shortcode' );

// Shareholder count shortcode
function ll_count_principals_shortcode() {
	$acfout = get_field( 'count_shareholders', 'option' );
	return number_format( $acfout );
}
add_shortcode( 'count_shareholders', 'll_count_principals_shortcode' );
add_shortcode( 'count_principals', 'll_count_principals_shortcode' );

// CPA count shortcode
function ll_count_cpas_shortcode() {
	$acfout = get_field( 'count_cpas', 'option' );
	return number_format( $acfout );
}
add_shortcode( 'count_cpas', 'll_count_cpas_shortcode' );

// Employee count shortcode
function ll_count_employees_shortcode() {
	$acfout = get_field( 'count_employees', 'option' );
	return number_format( $acfout );
}
add_shortcode( 'count_employees', 'll_count_employees_shortcode' );


/* * * * O T H E R * * * */

function ll_svgpart_shortcode( $atts ) {
	extract( shortcode_atts( [
		'part' => '',
	], $atts ) );
	$file = locate_template( 'template-parts/svg/svg-' . $part . '.php' );

	if( ! empty( $file ) ) {
		ob_start();
		include $file;
		$svgout = ob_get_contents();
		ob_end_clean();

		return $svgout;
	}
}
add_shortcode( 'svg', 'll_svgpart_shortcode' );
