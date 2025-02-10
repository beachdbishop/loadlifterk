<?php
/**
 * The template for displaying the FRONT page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

get_header();

// $page_id_industries             = ( wp_get_environment_type() == 'local' ) ? '3196' : '31923';
if ( get_field( 'll_page_title_override' ) ) {
	$page_title                 	= get_field( 'll_page_title_override' );
} else {
	$page_title                 	= get_the_title();
}
$featimg                        = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
$featvideo                      = get_field( 'll_page_hero_video' );
$brand_message                  = get_field( 'll_brand_message' );
// $page_excerpt                   = get_the_excerpt();
// $trending                       = get_field( 'll_front_trending_items' );
$video_heading                  = 'Nearshore Outsourced Accounting and Staffing';
$video_subheading               = 'Enhance operational efficiency with our talent.';
$hero_cta1_text									= get_field( 'll_hero_cta1_text' );
$hero_cta1_url									= get_field( 'll_hero_cta1_url' );
$hero_cta2_text									= get_field( 'll_hero_cta2_text' );
$hero_cta2_url									= get_field( 'll_hero_cta2_url' );
?>

	<main id="primary" class="front-page | bg-white dark:bg-neutral-900">

		<?php
		while ( have_posts() ) :
			the_post();
			// get_template_part( 'template-parts/content/content', 'page-front' );
			?>

			<?php if ( $featvideo ) { ?>
				<div class="page-hero | wp-block-cover bg-white min-h-min  |  print:py-8">
					<span aria-hidden="true" class="page-hero-overlay  |  z-[1] absolute top-0 right-0 bottom-0 left-0"></span>

					<video playsinline autoplay muted loop poster="<?php echo $featimg[0]; ?>" class="wp-block-cover__video-background print:hidden" data-object-fit="cover">
						<source src="<?php echo $featvideo; ?>">
						Your browser does not support the video tag.
					</video>

					<!-- <div class="overlay | absolute top-0 left-0 w-full h-[1080px] bg-neutral-800/70 lg:bg-transparent lg:bg-hero-gradient"></div> -->

					<!-- <div class="relative flex flex-col justify-center px-2 min-h-[240px] md:container lg:px-[16px] md:min-h-hero text-left"> -->
					<div class="wp-block-cover__inner-container p-2 container flex flex-col gap-0  |  lg:p-4">

						<div class="text-neutral-900 flex flex-col justify-center space-y-6  |  md:min-h-(--height-hero) print:min-h-min">
							<h1 class="text-neutral-900 max-w-[20ch] leading-none tracking-light text-pretty shadow-neutral-50 drop-shadow-lg  |  lg:text-6xl lg:print:!text-xl print:text-black">
								<?php echo $video_heading; ?>
							</h1>

							<h2 class="text-2xl leading-none text-pretty !text-neutral-800 shadow-neutral-50 drop-shadow-lg  |  md:max-w-5xl lg:text-4xl lg:print:!text-base print:!text-black"><?php echo $video_subheading; ?></h2>

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
						<nav class="breadcrumbs | grow-0 font-head text-neutral-800 | print:hidden">&nbsp;</nav>
					</div>
				</div><?php
			} else {

				echo ll_better_page_hero( $page_title, $brand_message, $hero_cta1_text, $hero_cta1_url, $hero_cta2_text, $hero_cta2_url );

			}
			?>

			<article id="post-<?php the_ID(); ?>" class="py-4 md:py-6 lg:py-8">
				<div class="px-2 container lg:px-[16px]">
					<?php the_title( '<h1 class="entry-title | hidden ">', '</h1>' ); ?>

					<div <?php ll_content_class( 'entry-content flow' ); ?>>

						<?php the_content(); ?>

					</div>

				</div>
			</article>

			<!-- <section class="full-bleed ll-equal-vert-padding bg-white">
				<div class="px-2 md:container lg:px-[16px] flex flex-col gap-4 justify-between place-items-center lg:flex-row">
					<div class="hidden"><img src="https://picsum.photos/640/400" alt="placeholder image" width="640" height="400" /></div>
					<div class=" md:max-w-4xl dark:text-neutral-800">
						<p class="text-shadow shadow-white my-2">Kuadra Support offers outsourced solutions to accommodate the needs of U.S.-based companies and their owners, CFOs, and controllers. Our outsourced bookkeeping and back-office support solutions provide the needed boost to flourish during accelerated growth or other changes. We can assist with employee leasing agreements or staffing arrangements for those with more comprehensive needs. For many, we are the support behind the scenes that gives management a renewed sense of confidence in their accounting function.</p>
						<h3 class="text-shadow shadow-white">Why Kuadra?</h3>
						<p class="text-shadow shadow-white my-2">Our focus on client service and geographical proximity allows us to quickly become an extension of your team. Unlike other outsourced companies that have resources halfway around the globe, we are located within a similar time zone and available to meet during your business hours. In addition, our bilingual professionals are well-versed in American culture and business acumen, which translates into a seamless service experience. </p>
					</div>
				</div>
			</section> -->

			<!-- <section class="full-bleed ll-equal-vert-padding not-prose">
				<div class="px-2 lg:px-[16px]">
					<h2>Our solutions</h2>
					<ul class="service-items | mt-4 px-2 list-none grid gap-4 md:grid-cols-2 md:gap-0 lg:mb-8 lg:px-[16px] ">
						<?php
						// foreach ( LL_KUADRA_SERVICES as $service ) {
						// 	echo '<li class="card-ic | group flex flex-col gap-4 relative border-2 border-transparent shadow-aqua-700 focus-within:shadow-lg focus-within:border-neutral-500 dark:shadow-aqua-500"><div class="card-text | flex flex-col text grow order-1 dark:text-neutral-300"><h3 class="text-center"><a class="block font-head font-semibold text-2xl leading-none group-hover:text-atlantis-800 group-hover:decoration-aqua-200 focus:underline group-hover:underline dark:group-hover:text-atlantis-500" href="' . $service['url'] . '">' . $service['label'] . '</a></h3></div><div class="card-img | text-center"><div class="size-32 lg:size-48 inline-flex items-center justify-center shrink-0 rounded-full bg-brand-gray dark:bg-brand-gray-dark shadow-service group-hover:bg-atlantis-500"><i class="fa-solid ' . $service['icon'] . ' fa-4x fa-fw text-atlantis-500 group-hover:text-atlantis-800"></i></div></div></li>';
						// }
						?>
					</ul>
				</div>
			</section> -->

			<!-- <div class="px-2 container lg:px-[16px] ll-equal-vert-padding prose lg:prose-xl"> -->
			<?php // the_content(); ?>
			<!-- </div> -->

			<section class="full-bleed ll-equal-vert-padding not-prose bg-atlantis-400 text-atlantis-950 break-inside-avoid print:bg-transparent">
				<div class="px-2 container lg:px-[16px]">
					<div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center md:justify-between lg:gap-8">
						<div class="">
							<h2 class="mb-2">Let's get started</h2>
							<p class="">Interested in learning more about our solutions? Connect with us today.</p>
							<p class="hidden print:mt-8 print:block">Email info@kuadrasupport.com</p>
						</div>
						<div class="w-full md:max-w-fit print:hidden">
							<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Contact Us</a></div>
						</div>
					</div>
				</div>
			</section>

		<?php endwhile; ?>

	</main><!-- #main -->

<?php
get_footer();
