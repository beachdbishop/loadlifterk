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
// add_shortcode( 'count_clients', 'll_count_clients_shortcode' );

// Shareholder count shortcode
function ll_count_principals_shortcode() {
	$acfout = get_field( 'count_shareholders', 'option' );
	return number_format( $acfout );
}
// add_shortcode( 'count_shareholders', 'll_count_principals_shortcode' );
// add_shortcode( 'count_principals', 'll_count_principals_shortcode' );

// CPA count shortcode
function ll_count_cpas_shortcode() {
	$acfout = get_field( 'count_cpas', 'option' );
	return number_format( $acfout );
}
// add_shortcode( 'count_cpas', 'll_count_cpas_shortcode' );

// Employee count shortcode
function ll_count_employees_shortcode() {
	$acfout = get_field( 'count_employees', 'option' );
	return number_format( $acfout );
}
// add_shortcode( 'count_employees', 'll_count_employees_shortcode' );


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


function ll_litevimeoembed_shortcode( $atts ) {
	extract( shortcode_atts( [
		'id' => '',
		'style' => '',
	], $atts ) );

	$html_out = sprintf( '<script type="module" src="https://cdn.jsdelivr.net/npm/lite-vimeo-embed/+esm"></script><lite-vimeo videoid="%1$s" style="%2$s"></lite-vimeo>', $id, $style );

	return $html_out;
}
add_shortcode( 'litevimeo', 'll_litevimeoembed_shortcode' );


function ll_designrough_plain_shortcode() {
	$html = '
	<div class="flex items-start gap-4 md:gap-6">
		<div class="mt-2 block">
			<span class="fa-stack fa-2x">
				<i class="text-neutral-200 fa-solid fa-circle fa-stack-2x"></i>
				<i class="fa-sharp fa-light fa-users fa-stack-1x text-atlantis-800"></i>
			</span>
		</div>
		<div>
			<h3 class="text-lg font-semibold">Qualified remote professionals</h3>
			<p class="mt-0.5 ">
				Recruiting, hiring, and retaining qualified accounting talent is often time-consuming and costly. Through our trusted network in Mexico, we connect you with highly educated and experienced professionals at a significantly lower cost than traditional U.S. salaries.
			</p>
		</div>
	</div>

	<div class="flex items-start gap-4 md:gap-6">
		<div class="mt-2 block">
			<span class="fa-stack fa-2x">
				<i class="text-neutral-200 fa-solid fa-circle fa-stack-2x"></i>
				<i class="fa-sharp fa-light fa-flag fa-stack-1x text-atlantis-800"></i>
			</span>
		</div>
		<div>
			<h3 class="text-lg font-semibold">Cultural alignment</h3>
			<p class="mt-0.5 ">
				Our sourced professionals are fluent in English and understand U.S. business standards and practices. This cultural alignment enables them to integrate quickly and function as an extension of your team.
			</p>
		</div>
	</div>

	<div class="flex items-start gap-4 md:gap-6">
		<div class="mt-2 block">
			<span class="fa-stack fa-2x">
				<i class="text-neutral-200 fa-solid fa-circle fa-stack-2x"></i>
				<i class="fa-sharp fa-light fa-business-time fa-stack-1x text-atlantis-800"></i>
			</span>
		</div>
		<div>
			<h3 class="text-lg font-semibold">Real-time collaboration</h3>
			<p class="mt-0.5 ">
				Our location in Mexico allows us to operate in sync with your business. Unlike offshore providers with teams based across the globe, we work within U.S. time zones and are available to collaborate during your business hours.
			</p>
		</div>
	</div>
	';

	return $html;
}
add_shortcode( 'designrough_plain', 'll_designrough_plain_shortcode' );


function ll_designrough_dressy_shortcode() {
	$html = '
		<div class="offset-box offset-box-aqua  |  text-orient-950 grid gap-y-3 mb-12 p-8 relative z-[1]">
			<h3 class="text-lg font-semibold">Qualified remote professionals</h3>
			<p>Recruiting, hiring, and retaining qualified accounting talent is often time-consuming and costly. Through our trusted network in Mexico, we connect you with highly educated and experienced accountants, auditors, tax, and finance professionals at a significantly lower cost than traditional U.S. salaries.</p>

			<h3 class="text-lg font-semibold">Cultural alignment</h3>
			<p>Our sourced professionals are fluent in English and understand U.S. business standards and practices. This cultural alignment enables them to integrate quickly and function as an extension of your team.</p>

			<h3 class="text-lg font-semibold">Real-time collaboration</h3>
			<p>Our location in Mexico allows us to operate in sync with your business. Unlike offshore providers with teams based across the globe, we work within U.S. time zones and are available to collaborate during your business hours.</p>
		</div>

		<hr />

		<div class="offset-box offset-box-atlantis  |  text-orient-950 grid gap-y-3 mb-12 p-8 relative z-[1]">
			<h3 class="text-sm font-semibold">Qualified remote professionals</h3>
			<p>Recruiting, hiring, and retaining qualified accounting talent is often time-consuming and costly. Through our trusted network in Mexico, we connect you with highly educated and experienced accountants, auditors, tax, and finance professionals at a significantly lower cost than traditional U.S. salaries.</p>
		</div>

		<div class="offset-box offset-box-atlantis  |  text-orient-950 grid gap-y-3 mb-12 p-8 relative z-[1]">
			<h3 class="text-sm font-semibold">Cultural alignment</h3>
			<p>Our sourced professionals are fluent in English and understand U.S. business standards and practices. This cultural alignment enables them to integrate quickly and function as an extension of your team.</p>
		</div>

		<div class="offset-box offset-box-atlantis  |  text-orient-950 grid gap-y-3 mb-12 p-8 relative z-[1]">
		  <h3 class="text-sm font-semibold">Real-time collaboration</h3>
			<!-- p class="font-head text-xl font-semibold">Real-time collaboration</p -->
			<p>Our location in Mexico allows us to operate in sync with your business. Unlike offshore providers with teams based across the globe, we work within U.S. time zones and are available to collaborate during your business hours.</p>
		</div>
	';

	return $html;
}
add_shortcode( 'designrough_dressy', 'll_designrough_dressy_shortcode' );


function ll_designrough_flipcards_shortcode( $atts, $content = null ) {
	extract(
		shortcode_atts(
			[
				'style' => 'default',
			],
			$atts
		)
	);
	$items = [
		[
			'icon' => 'fa-users',
			'title' => 'Qualified remote professionals',
			'text' => 'Recruiting, hiring, and retaining qualified accounting talent is often time-consuming and costly. Through our trusted network in Mexico, we connect you with highly educated and experienced professionals at a significantly lower cost than traditional U.S. salaries.',
		],
		[
			'icon' => 'fa-flag',
			'title' => 'Cultural alignment',
			'text' => 'Our sourced professionals are fluent in English and understand U.S. business standards and practices. This cultural alignment enables them to integrate quickly and function as an extension of your team.',
		],
		[
			'icon' => 'fa-business-time',
			'title' => 'Real-time collaboration',
			'text' => 'Our location in Mexico allows us to operate in sync with your business. Unlike offshore providers with teams based across the globe, we work within U.S. time zones and are available to collaborate during your business hours.',
		],
	];

	$html_out = '<ul class="ind-card-flips is-style-' . $style . ' mx-auto">';
	foreach ( $items as $item ) {
		$html_out .= '<li>
			<div class="card card-ic card-ic-flip  | group relative inline-block float-left w-(--card-size) h-(--card-size)" style="--card-size: 288px">
				<div class="card-content | absolute w-full h-full rounded-lg shadow-lg shadow-neutral-300 transition-transform ease-out duration-700 [transform-style:preserve-3d] dark:shadow-none">
					<div class="card-front | text-center bg-(--_card-front-bg) text-(--_card-front-text) absolute w-full h-full flex flex-col items-center justify-center rounded-lg px-4 [backface-visibility:hidden]">
						<div class="card-icon | text-(--_card-front-icon)">
							<span class="fa-stack fa-2x">
								<i class="text-white fa-solid fa-circle fa-stack-2x dark:text-neutral-700"></i>
								<i class="fa-sharp fa-light ' . $item['icon'] . ' fa-stack-1x "></i>
							</span>
						</div>
						<p class="mt-2 font-head font-semibold text-lg leading-none text-current">' . $item['title'] . '</p>
					</div>
					<div class="card-back | absolute w-full h-full flex flex-col items-center justify-center rounded-lg px-4 bg-(--_card-back-bg) text-(--_card-back-text) bg-no-repeat bg-cover bg-blend-multiply shadow-neutral-900/50 [backface-visibility:hidden]  [transform:rotateY(180deg)]">
						<p class="font-head font-semibold my-2 !text-lg leading-none text-center text-white text-shadow">' . $item['title'] . '</p>
						<p class="text-white text-shadow">' . $item['text'] . '</p>
					</div>
				</div>
			</div>
		</li>';
	}
	$html_out .= '</ul>';

	return $html_out;
}
add_shortcode( 'designrough_flipcards', 'll_designrough_flipcards_shortcode' );
