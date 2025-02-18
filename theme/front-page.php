<?php
/**
 * The template for displaying the FRONT page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

get_header();

if ( get_field( 'll_page_title_override' ) ) {
	$page_title                 	= get_field( 'll_page_title_override' );
} else {
	$page_title                 	= get_the_title();
}
$featimg                        = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
$featvideo                      = get_field( 'll_page_hero_video' );
$brand_message                  = get_field( 'll_brand_message' );
$hero_cta1_text									= get_field( 'll_hero_cta1_text' );
$hero_cta1_url									= get_field( 'll_hero_cta1_url' );
$hero_cta2_text									= get_field( 'll_hero_cta2_text' );
$hero_cta2_url									= get_field( 'll_hero_cta2_url' );
?>

	<main id="primary" class="front-page  |  bg-white dark:bg-neutral-900">

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php if ( $featvideo ) { ?>
				<div class="page-hero | wp-block-cover bg-white min-h-min  |  print:py-8">
					<span aria-hidden="true" class="page-hero-overlay  |  z-[1] absolute top-0 right-0 bottom-0 left-0"></span>

					<video playsinline autoplay muted loop poster="<?php echo $featimg[0]; ?>" class="wp-block-cover__video-background print:hidden" data-object-fit="cover">
						<source src="<?php echo $featvideo; ?>">
						Your browser does not support the video tag.
					</video>

					<div class="wp-block-cover__inner-container p-2 container flex flex-col gap-0  |  lg:p-4">

						<div class="text-neutral-900 flex flex-col justify-center space-y-6  |  md:min-h-(--height-hero) print:min-h-min">
							<h1 class="text-neutral-900 max-w-[20ch] leading-none tracking-light text-pretty shadow-neutral-50 drop-shadow-lg  |  lg:print:!text-xl print:text-black">
								<?php echo $page_title; ?>
							</h1>

							<h2 class="leading-none text-pretty !text-neutral-700 shadow-neutral-50 drop-shadow-lg  |  md:max-w-5xl lg:print:!text-base print:!text-black"><?php echo $brand_message; ?></h2>

							<?php if ( ( !empty( $hero_cta1_text ) ) && ( !empty( $hero_cta1_url ) ) ) : ?>
							<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
								<div class="inline-block m-0">
									<a class="border-2 inline-flex items-center justify-center px-5 py-3 font-head font-semibold no-underline rounded-lg text-neutral-100 !bg-brand-red-dark border-brand-red-dark shadow-md shadow-neutral-950 hover:border-white hover:text-white" href="<?php echo $hero_cta1_url; ?>">
										<?php echo $hero_cta1_text; ?>
									</a>
								</div>
								<?php if ( ( !empty( $hero_cta2_text ) ) && ( !empty( $hero_cta2_url ) ) ) { ?>
									<div class="inline-block m-0">
										<a class="border-2 inline-flex items-center justify-center px-5 py-3 font-head font-semibold no-underline rounded-lg bg-transparent border-neutral-200 text-neutral-200 shadow-md shadow-neutral-950 hover:bg-transparent hover:border-brand-blue-pale hover:text-brand-blue-pale" href="<?php echo $hero_cta2_url; ?>">
											<?php echo $hero_cta2_text; ?>
										</a>
									</div>
								<?php } ?>
							</div>
							<?php endif; ?>
						</div>
						<ol class="breadcrumbs | grow-0 font-head text-neutral-800 | print:hidden">&nbsp;</ol>
					</div>
				</div><?php
			} else {

				echo ll_better_page_hero( $page_title, $brand_message, $hero_cta1_text, $hero_cta1_url, $hero_cta2_text, $hero_cta2_url );

			}
			?>


			<article id="post-<?php the_ID(); ?>" class="pt-4 md:pt-6 lg:pt-8">
				<div class="px-2 container lg:px-[16px]">
					<?php the_title( '<h1 class="entry-title | hidden ">', '</h1>' ); ?>

					<div <?php ll_content_class( 'entry-content flow' ); ?>>

						<?php the_content(); ?>

					</div>

				</div>
			</article>


			<!-- section class="full-bleed ll-equal-vert-padding not-prose bg-atlantis-400 text-atlantis-950 break-inside-avoid print:bg-transparent">
				<div class="px-2 container lg:px-[16px]">
					<div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center md:justify-between lg:gap-8">
						<div class="">
							<h2 class="mb-2">Let's get started</h2>
							<p class="">Static code... Interested in learning more about our solutions? Connect with us today.</p>
							<p class="hidden print:mt-8 print:block">Email info@kuadrasupport.com</p>
						</div>
						<div class="w-full md:max-w-fit print:hidden">
							<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Contact Us</a></div>
						</div>
					</div>
				</div>
			</section -->

		<?php endwhile; ?>

	</main><!-- #main -->

<?php
get_footer();
