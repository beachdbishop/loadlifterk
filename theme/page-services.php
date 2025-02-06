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

			<?php echo ll_better_page_hero( $page_title, $page_message, $hero_cta1_text, $hero_cta1_url, $hero_cta2_text, $hero_cta2_url ); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="px-2 container lg:px-[16px]">

					<div <?php ll_content_class( 'entry-content py-4 lg:py-8' ); ?>>

						<?php the_content(); ?>

						<section class="not-prose bg-aqua-100 text-brand-gray-dark dark:bg-aqua-800 dark:text-neutral-200">
							<div class="service-items | px-2 grid gap-4 md:grid-cols-2 md:gap-0 lg:px-[16px]">

								<?php
								foreach ( LL_KUADRA_SERVICES as $service ) {
									echo '<div class="service-item | flex flex-col gap-2 p-4 md:p-8 lg:flex-row lg:items-start lg:gap-8">
										<div class="item-icon | text-center group lg:min-w-48">
											<a class="block mb-4" href="' . $service['url'] . '" aria-label="' . $service['label'] . '">
												<div class="size-32 inline-flex items-center justify-center shrink-0 rounded-full bg-brand-gray dark:bg-brand-gray-dark shadow-service group-hover:bg-atlantis-500">
													<i class="fa-solid ' . $service['icon'] . ' fa-3x fa-fw text-atlantis-500 group-hover:text-atlantis-700"></i>
												</div>
											</a>
											<a class="block font-head font-semibold text-xl leading-none group-hover:text-atlantis-700 dark:group-hover:text-atlantis-500" href="' . $service['url'] . '">' . $service['label'] . '</a>
										</div>
										<div class="item-text | space-y-4">
											<p>' . $service['desc'] . '</p>
										</div>
									</div>';
								}
								?>

							</div>
						</section>

					</div>



					<!-- <section class="full-bleed ll-equal-vert-padding not-prose bg-atlantis-500 text-black break-inside-avoid print:animate-none print:bg-transparent">
						<div class="px-2 lg:px-[16px]">
							<div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center lg:gap-12">
								<div class="">
									<h3 class="mb-2">Let's get started</h3>
									<p class="">Interested in learning about our bookkeeping and accounting solutions? Complete the form on this page and a team member will reach out to you shortly.</p>
									<p class="hidden print:mt-8 print:block">Email info@kuadrasupport.com</p>
								</div>
								<div class="w-full md:max-w-fit print:hidden">
									<div class="wp-block-button"><a class="border-2 wp-block-button__link wp-element-button has-aqua-800-background-color has-background-color border-transparent hover:border-aqua-800 hover:bg-atlantis-500 hover:text-aqua-800" href="#contact">Contact Us</a></div>
								</div>
							</div>
						</div>
					</section> -->

				</div>
			</article>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
