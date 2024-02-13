<?php
/**
 * The template for displaying the Services page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter_K
 */

get_header();

$page_id                        = get_the_ID();
// $page_id_industries             = ( wp_get_environment_type() == 'local' ) ? '3196' : '31923';

if ( get_field( 'll_page_title_override' ) ) {
	$page_title                 = get_field( 'll_page_title_override' );
} else {
	$page_title                 = get_the_title();
}

$page_icon											= ( get_field( 'll_page_icon' ) ) ? get_field( 'll_page_icon' ) : false;
$page_message 									= get_field( 'll_brand_message' );
$page_form 											= get_field( 'ls_hs_form_html' );
$hero_cta1_text 								= get_field( 'll_hero_cta1_text' );
$hero_cta1_url 									= get_field( 'll_hero_cta1_url' );
$hero_cta2_text									= get_field( 'll_hero_cta2_text' );
$hero_cta2_url 									= get_field( 'll_hero_cta2_url' );
?>

	<main id="primary" class="page-services | bg-white dark:bg-neutral-900">

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php echo ll_page_hero( $page_title, $page_message['label'], $hero_cta1_text, $hero_cta1_url, $hero_cta2_text, $hero_cta2_url ); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="px-2 md:container lg:px-[16px]">
					<div class="mt-4 ll-page-grid md:gap-8 md:mt-8 md:grid md:auto-rows-auto lg:mt-16 lg:gap-16">

						<div <?php ll_content_class( 'entry-content ll-page-grid-area-a md:col-span-2' ); ?>>
							<?php the_content(); ?>
						</div>

						<div class="my-16 ll-page-grid-area-b md:my-0 md:col-span-3">

							<section class="full-bleed ll-equal-vert-padding not-prose bg-aqua-100 text-brand-gray-dark dark:bg-aqua-800 dark:text-neutral-200">
								<div class="service-items | px-2 grid gap-4 md:grid-cols-2 md:gap-0 lg:px-[16px] lg:text-xl">

									<?php
									foreach ( LL_KUADRA_SERVICES as $service ) {
										echo '<div class="service-item | flex flex-col gap-4 p-4 md:p-8 lg:flex-row lg:items-start lg:p-12 lg:gap-10">
											<div class="item-icon | text-center group lg:min-w-48">
												<a class="block mb-4" href="' . $service['url'] . '">
													<div class="size-32 inline-flex items-center justify-center shrink-0 rounded-full bg-brand-gray dark:bg-brand-gray-dark shadow-service group-hover:bg-atlantis-500">
														<i class="fa-solid ' . $service['icon'] . ' fa-3x fa-fw text-atlantis-500 group-hover:text-atlantis-700"></i>
													</div>
												</a>
												<a class="block font-head font-semibold text-xl leading-none group-hover:text-atlantis-700 dark:group-hover:text-atlantis-500 lg:text-2xl" href="' . $service['url'] . '">' . $service['label'] . '</a>
											</div>
											<div class="item-text | space-y-4">
												<p>' . $service['desc'] . '</p>
												<p class="font-bold text-base"><a class="text-aqua-700 hover:text-aqua-500 dark:text-aqua-200" href="' . $service['url'] . '">Learn more about ' . $service['label'] . '</a></p>
											</div>
										</div>';
									}
									?>

								</div>
							</section>

							<section class="full-bleed ll-equal-vert-padding not-prose bg-atlantis-500 break-inside-avoid print:animate-none print:bg-transparent">
								<div class="px-2 lg:px-[16px]">
									<div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center lg:gap-8">
										<div class="prose lg:prose-xl">
											<h2 class="mb-2">Let's get started</h2>
											<p class="">Interested in learning about our bookkeeping and accounting solutions? Complete the form on this page and a team member will reach out to you shortly.</p>
											<p class="hidden print:mt-8 print:block">Email info@kuadrasupport.com</p>
										</div>
										<div class="w-full md:max-w-fit print:hidden">
											<div class="wp-block-button"><a class="border-2 wp-block-button__link wp-element-button has-aqua-600-background-color has-background-color border-aqua-600 hover:border-aqua-800 hover:bg-atlantis-500 hover:text-aqua-800" href="#contact">Contact Us</a></div>
										</div>
									</div>
								</div>
							</section>

						</div>

						<div class="ll-page-grid-area-c">
							<?php if ( get_field( 'll_normal_contact_form_location' ) == 1 ) : ?>
								<div id="contact" class="container-contact-form not-prose">
									<?php get_template_part( 'template-parts/form/form', 'contact-sidebar' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( $page_form ) :
								echo '<div id="contact" class="container-contact-form not-prose">';
								echo do_shortcode( $page_form );
								echo '</div>';
							endif; ?>

							<?php // get_template_part( 'template-parts/form/form', 'webshare' ); ?>

						</div>

					</div>
				</div>
			</article>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
