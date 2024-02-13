<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter_K
 */


$page_seo_footer = get_field( 'll_seo_footer', get_queried_object_id(), false );
$site_seo_footer = get_field( 'seo_footer_text', 'option' );

if ( !is_page_template( 'tpl-landing-page-bare.php' ) ) {
	//   P R E F O O T E R   A R E A
	get_template_part( 'template-parts/siteblocks/pre', 'footer' );
	?>

	<footer id="colophon" class="site-footer bg-neutral-800 dark:bg-neutral-900">

		<div class="text-white on-darkbg print:text-neutral-700">
		<?php /* <div class="on-darkbg bg-neutral-500 bg-phoenix-desert-small md:bg-phoenix-desert3 bg-fixed bg-no-repeat bg-cover text-white bg-blend-multiply lg:bg-[center_top_5rem] print:bg-none print:text-neutral-700"> */ ?>

			<div class="px-2 py-16 md:container lg:px-[16px]">
				<div class="grid grid-cols-1 gap-y-8 lg:grid-cols-3 lg:gap-x-8">
					<div class="space-y-4">
						<div class="max-w-64 mb-4 fill-current">
							<a href="<?php bloginfo( 'url' ); ?>" aria-label="<?php echo bloginfo( 'name' );?>">
								<?php get_template_part( 'template-parts/svg/svg', 'logo-mono' ); ?>
							</a>
						</div>
						<?php echo ll_show_social_links(); ?>
						<p class="font-semibold lg:text-xl">T: 520.908.7702</p>
					</div>
					<div class="py-4 lg:py-12 lg:col-span-2">
						<?php wp_nav_menu( [
							'theme_location' => 'll_menu_footer',
							'container_class' => 'footer-menu',
							'fallback_cb' => false
						] ); ?>
					</div>
				</div>

				<p class="mt-8 text-xs lg:text-sm">
					<?php
					if ( ( is_page() ) && ( get_field( 'll_seo_footer' ) ) ) {
						// if this is a page and special footer text is set...
						$footer_markup = sprintf( '%1$s &copy;%3$s %2$s. All rights reserved.', get_field( 'll_seo_footer', get_queried_object_id(), false ), LL_COMPANY_LEGAL_NAME, date('Y') );
					} else {
						// this isn't a page or special footer text isn't set...
						$footer_markup = sprintf( 'Mexico Nearshoring | Outsourcing | Accounting | Back office support :: %1$s &copy;%3$s %2$s. All rights reserved.', get_field( 'seo_footer_text', 'option' ), LL_COMPANY_LEGAL_NAME, date('Y') );
					}
					echo $footer_markup;
					?>
				</p>

				<p class="pt-4 pb-0 text-sm text-center uppercase print:hidden">
					<a class="hover:text-atlantis-200" href="#top" title="Back to top"><i class="fa-regular fa-arrow-up-to-dotted-line"></i></a>
				</p>
			</div>
		</div>
	</footer>

<?php } ?>
