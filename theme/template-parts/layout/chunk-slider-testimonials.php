<?php
/**
 * This is the partial for testimonial sliders
 *
 * @package: Load_Lifter
 * @since: 0.6.0
 *
 */

wp_enqueue_style(
	'keen-slider',
	'https://cdn.jsdelivr.net/npm/keen-slider@6.8.6/keen-slider.min.css',
	[],
	LL_VERSION
);

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

		</div>

		<div class="mt-6 flex items-center justify-center gap-4">
			<button aria-label="Previous slide" id="keen-slider-previous" class="">
				<i class="fa-regular fa-angle-left"></i>
			</button>

			<p class="w-16 text-center text-sm">
				<span id="keen-slider-active"></span>
				/
				<span id="keen-slider-count"></span>
			</p>

			<button aria-label="Next slide" id="keen-slider-next" class="">
				<i class="fa-regular fa-angle-right"></i>
			</button>
		</div>
	</div>
</div>

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
