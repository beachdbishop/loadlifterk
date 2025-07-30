<?php
/*
 * Template Name: Careers Page
 * This is the template that displays a page in the Careers section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

get_header();

$page_id = get_the_ID();
if (get_field('ll_page_title_override')) {
	$page_title = get_field('ll_page_title_override');
} else {
	$page_title = get_the_title();
}
// $page_icon = ( get_field( 'll_page_icon' ) ) ? get_field( 'll_page_icon' ) : false;
$page_message = get_field('ll_brand_message');
$page_excerpt = get_the_excerpt();
$page_featimg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
if ($page_featimg == true) {
	$page_featimg_url = $page_featimg[0];
} else {
	$page_featimg_url = '';
}
?>

<main id="primary" class="careers-page  |  bg-white relative z-10 shadow-xl  |  lg:shadow-2xl dark:bg-neutral-900">

	<?php
	while (have_posts()) :
		the_post();
		// get_template_part( 'template-parts/content/content', 'page-about' );
	?>

		<?php echo ll_better_page_hero($page_title, $page_message); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="px-2 container  |  lg:px-[16px]">

				<div class="ll-page-grid  |  mt-4  |  md:gap-8 md:mt-8 md:grid md:auto-rows-auto lg:mt-16 lg:gap-16">

					<div <?php ll_content_class('ll-page-grid-area-a  |  entry-content flow  |  md:col-span-2'); ?>>

						<?php the_content(); ?>

					</div>

					<div class="ll-page-grid-area-b  |  my-16  |  md:my-0 md:col-span-3">

						<?php
						$qargs = [
							'post_type' => 'testimonial',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'posts_per_archive_page' => -1,
							'order' => 'ASC',
							'meta_query' => [
								[
									'key' => 'll_testim_type',
									'value' => 'staff',
									'compare' => '='
								]
							]
						];
						$testimonialQuery = new WP_Query($qargs);
						?>

						<?php
						if ($testimonialQuery->have_posts()) :
							get_template_part(
								'template-parts/layout/chunk-slider',
								'testimonials',
								$args = [
									'class' => 'slider-part',
									'part_data' => [
										'heading' => 'Staff testimonials',
									]
								]
							);
						endif;
						?>

						<!-- div class="testimonials | not-prose py-12 lg:py-16">
								<h2 class="tracking-tight">Staff testimonials</h2>

								<div class="mt-8">
									<div id="keen-slider" class="keen-slider">
										<?php
										// $counter = 0;
										// foreach ( LL_STAFF_TESTOMONIALS as $stafftest ) {
										?>
											<div class="keen-slider__slide flex flex-col opacity-40 transition-opacity duration-500">
												<div class="grow rounded-lg bg-neutral-50 p-6 shadow-xs sm:p-8">
													<div class="flex items-center gap-4">
														<div class="fa-4x">
															<span class="fa-layers fa-fw">
																<i class="fa-solid fa-circle text-aqua-300"></i>
																<i class="fa-inverse fa-sharp fa-solid fa-user" data-fa-transform="shrink-8"></i>
															</span>
														</div>

														<div class="prose prose-neutral lg:prose-xl dark:prose-invert">
															<p class="mt-0.5 font-bold text-lg"><?php // echo $stafftest['name'];
																																	?></p>
															<p><?php // echo $stafftest['title'];
																	?></p>
														</div>
													</div>

													<div class="">
														<p class="mt-4 text-neutral-700">
															<?php // echo $stafftest['text'];
															?>
														</p>
													</div>
												</div>
											</div><?php
														// }
														?>
									</div>

									<div class="mt-6 flex items-center justify-center gap-4">
										<button
											aria-label="Previous slide"
											id="keen-slider-previous"
											class="text-neutral-600 transition-colors hover:text-neutral-900"
										>
											<i class="fa-regular fa-angle-left"></i>
										</button>

										<p class="w-16 text-center text-sm text-neutral-700">
											<span id="keen-slider-active"></span>
											/
											<span id="keen-slider-count"></span>
										</p>

										<button
											aria-label="Next slide"
											id="keen-slider-next"
											class="text-neutral-600 transition-colors hover:text-neutral-900"
										>
											<i class="fa-regular fa-angle-right"></i>
										</button>
									</div>
								</div>
							</div>

							<link href="https://cdn.jsdelivr.net/npm/keen-slider@6.8.6/keen-slider.min.css" rel="stylesheet" />
							<script type="module">
								import KeenSlider from 'https://cdn.jsdelivr.net/npm/keen-slider@6.8.6/+esm'

								const keenSliderActive = document.getElementById('keen-slider-active')
								const keenSliderCount = document.getElementById('keen-slider-count')

								const keenSlider = new KeenSlider(
									'#keen-slider',
									{
										loop: true,
										defaultAnimation: {
											duration: 750,
										},
										slides: {
											origin: 'center',
											perView: 1,
											spacing: 16,
										},
										breakpoints: {
											'(min-width: 640px)': {
												slides: {
													origin: 'center',
													perView: 1.5,
													spacing: 16,
												},
											},
											'(min-width: 768px)': {
												slides: {
													origin: 'center',
													perView: 1.75,
													spacing: 16,
												},
											},
											'(min-width: 1024px)': {
												slides: {
													origin: 'center',
													perView: 3,
													spacing: 16,
												},
											},
										},
										created(slider) {
											slider.slides[slider.track.details.rel].classList.remove('opacity-40')

											keenSliderActive.innerText = slider.track.details.rel + 1
											keenSliderCount.innerText = slider.slides.length
										},
										slideChanged(slider) {
											slider.slides.forEach((slide) => slide.classList.add('opacity-40'))

											slider.slides[slider.track.details.rel].classList.remove('opacity-40')

											keenSliderActive.innerText = slider.track.details.rel + 1
										},
									},
									[
										(keenSlider) => {
											let timeout
											let mouseOver = false
											function clearNextTimeout() {
												clearTimeout(timeout)
											}
											function nextTimeout() {
												clearTimeout(timeout)
												if (mouseOver) return
												timeout = setTimeout(() => {
													keenSlider.next()
												}, 8000)
											}
											keenSlider.on("created", () => {
												keenSlider.container.addEventListener("mouseover", () => {
													mouseOver = true
													clearNextTimeout()
												})
												keenSlider.container.addEventListener("mouseout", () => {
													mouseOver = false
													nextTimeout()
												})
												nextTimeout()
											})
											keenSlider.on("dragStarted", clearNextTimeout)
											keenSlider.on("animationEnded", nextTimeout)
											keenSlider.on("updated", nextTimeout)
										},
									]
								)

								const keenSliderPrevious = document.getElementById('keen-slider-previous')
								const keenSliderNext = document.getElementById('keen-slider-next')

								keenSliderPrevious.addEventListener('click', () => keenSlider.prev())
								keenSliderNext.addEventListener('click', () => keenSlider.next())
							</script -->

					</div>

					<div class="ll-page-grid-area-c">
						<div id="contact" class="container-contact-form not-prose">
							<?php get_template_part('template-parts/form/form', 'contact-sidebar'); ?>
						</div>
					</div>

				</div>
			</div>
		</article><?php
						endwhile; // End of the loop.
							?>

</main><!-- #main -->

<?php
get_footer();
