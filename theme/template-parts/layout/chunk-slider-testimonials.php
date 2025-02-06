<?php
/**
 * This is the partial for testimonial sliders
 *
 * @package: Load_Lifter
 * @since: 0.6.0
 *
 */

global $testimonialQuery;

// Set defaults.
$args = wp_parse_args(
	$args,
	[
		'class' => 'slides',
		'part_data' => [
			'heading' => 'Testimonials',
		]
	]
)
?>

<div class="testimonials <?php echo esc_attr( $args['class'] ); ?>  |  not-prose py-12  |  lg:py-16">
	<h2 class="tracking-tight"><?php echo $args['part_data']['heading']; ?></h2>

	<div class="mt-8">
		<div id="keen-slider" class="keen-slider">

			<?php
			while ( $testimonialQuery->have_posts() ) :
				$testimonialQuery->the_post();
				global $post;
				get_template_part( 'template-parts/content/content', 'slide-testimonial' );
			endwhile;
			?>

			<?php
			// $counter = 0;
			// foreach ( LL_CLIENT_TESTOMONIALS as $clienttest ) {
			?>
				<!-- div class="service-<?php // echo $clienttest['service']; ?> | keen-slider__slide flex flex-col opacity-40 transition-opacity duration-500">
					<div class="flex-grow rounded-lg bg-neutral-50 p-6 shadow-sm sm:p-8">
						<div class="flex items-center gap-4">
							<div class="fa-4x">
								<span class="fa-layers fa-fw">
									<i class="fa-solid fa-circle text-aqua-300"></i>
									<i class="fa-inverse fa-sharp fa-solid fa-book" data-fa-transform="shrink-8"></i>
								</span>
							</div>

							<div class="prose prose-neutral lg:prose-xl dark:prose-invert">
								<div class="flex justify-start gap-0.5 text-atlantis-500">
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
									<i class="fa-solid fa-star"></i>
								</div>

								<p class="mt-0.5 font-bold"><?php // echo $clienttest['company']; ?></p>
							</div>
						</div>

						<div class="">
							<p class="mt-4 text-neutral-700">
								<?php // echo $clienttest['text']; ?>
							</p>
						</div>
					</div>
				</div --><?php
			// }
			?>
		</div>

		<div class="mt-6 flex items-center justify-center gap-4">
			<button aria-label="Previous slide" id="keen-slider-previous" class="text-neutral-600 transition-colors hover:text-neutral-900">
				<i class="fa-regular fa-angle-left"></i>
			</button>

			<p class="w-16 text-center text-sm text-neutral-700">
				<span id="keen-slider-active"></span>
				/
				<span id="keen-slider-count"></span>
			</p>

			<button aria-label="Next slide" id="keen-slider-next" class="text-neutral-600 transition-colors hover:text-neutral-900">
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
						spacing: 32,
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
</script>
