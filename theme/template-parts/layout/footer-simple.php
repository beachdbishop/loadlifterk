<?php

/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

$show_expanded_menus = true;

$page_seo_footer = get_field('ll_seo_footer', get_queried_object_id(), false);
$site_seo_footer = get_field('seo_footer_text', 'option');

if ((!is_page_template(LL_LP_TEMPLATES)) && ($show_expanded_menus)) {
	$hidden_menus_class = '';
} else {
	$hidden_menus_class = 'hidden';
}


//   P R E F O O T E R   A R E A
get_template_part('template-parts/siteblocks/pre', 'footer');
?>

<footer id="colophon" class="site-footer  |  wp-block-cover alignfull ll-equal-vert-padding !px-0 bg-aqua-700  |  lg:sticky lg:bottom-0 dark:bg-aqua-950 print:bg-white">
	<span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim print:hidden"></span>
	<div role="img" aria-label="The city lights of Torre Latino, CDMX, Mexico at night" class="deferred wp-block-cover__image-background bg-center bg-cover bg-no-repeat  |  lg:bg-position-center print:hidden" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/feat__nacho-monge-unsplash.jpg')"></div>

	<div class="wp-block-cover__inner-container is-layout-flow wp-block-cover-is-layout-flow px-2  |  lg:px-4">
		<div class="footer-grid  |  grid grid-cols-1 gap-x-8 gap-y-12 text-neutral-100  |  md:grid-cols-2 md:items-center lg:grid-cols-5 print:hidden print:text-neutral-700">

			<nav aria-label="Footer menu" class="col-span-1 lg:col-span-4">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'll_menu_col_1',
					'container_class' => 'footermenu mt-4 text-base font-head font-semibold  |  md:text-lg',
					'walker' => new WPDocs_Walker_Nav_Menu()
				));
				?>
			</nav>

			<div class="space-y-6"><? // Logo, Social, and Phone number
															?>
				<div class="max-w-xs fill-current print:max-w-60 print:mb-1">
					<a href="<?php bloginfo('url'); ?>" aria-label="<?php echo bloginfo('name'); ?>">
						<?php
						get_template_part('template-parts/svg/svg', 'logo-mono');
						?>
					</a>
				</div>
				<?php echo ll_show_social_links(); ?>
				<p class="font-head text-lg leading-tight"><a href="tel:<?php echo ll_format_phone_number(15209087702); ?>" rel="nofollow" onclick="ga('send', 'event', 'Phone Call Tracking', 'Click to Call', '<?php echo ll_format_phone_number(15209087702, 'us'); ?>', 0);"><?php echo  ll_format_phone_number(15209087702, 'beach'); ?></a></p>
			</div>

		</div>

		<p class="mt-8 text-sm  |  md:mt-12 print:break-inside-avoid-page print:mt-2">
			<?php
			if ((is_page()) && (get_field('ll_seo_footer'))) {
				// if this is a page and special footer text is set...
				$footer_markup = sprintf('%1$s &copy;%3$s %2$s. All rights reserved.', get_field('ll_seo_footer', get_queried_object_id(), false), LL_COMPANY_LEGAL_NAME, date('Y'));
			} else {
				// this isn't a page or special footer text isn't set...
				$footer_markup = sprintf('Mexico Nearshoring | Outsourcing | Employee Leasing | Staffing :: %1$s &copy;%3$s %2$s. All rights reserved.', get_field('seo_footer_text', 'option'), LL_COMPANY_LEGAL_NAME, date('Y'));
			}
			echo $footer_markup;
			?>
		</p>

		<?php if (is_local_environment()) { ?>
			<!-- nav aria-label="Legal submenu" class="menu-legal  |  ">
				<?php
				// wp_nav_menu(array(
				// 	'theme_location' => 'll_menu_below_disclaimers',
				// 	'container' => "",
				// 	'menu_class' => 'list-none text-xs  |  md:text-sm md:flex md:gap-x-2 lg:gap-x-6',
				// 	'walker' => new WPDocs_Walker_Nav_Menu()
				// ));
				?>
			</nav -->
		<?php } ?>

		<p class="pt-4 pb-0 text-sm text-center uppercase  |  print:hidden">
			<a class="hover:text-atlantis-300" href="#page" aria-label="Back to top"><i class="fa-regular fa-arrow-up-to-dotted-line"></i></a>
		</p>

	</div>

</footer>