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
$trending                       = get_field( 'll_front_trending_items' );
$video_heading                  = 'Partners who value your vision';
$video_subheading               = 'Work with our advisors and experience the power of collaboration and what it can accomplish.';
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
				<div class="page-hero | ll-equal-vert-padding bg-no-repeat overflow-hidden flex items-center justify-center print:py-8">

					<video playsinline autoplay muted loop poster="<?php echo $featimg[0]; ?>" class="absolute top-[-200px] left-0 object-cover w-full h-[1080px] print:hidden">
						<source src="<?php echo $featvideo; ?>">
						Your browser does not support the video tag.
					</video>

					<div class="overlay | absolute top-0 left-0 w-full h-[1080px] bg-neutral-800/70 lg:bg-transparent lg:bg-hero-gradient"></div>

					<div class="relative flex flex-col justify-center px-2 min-h-[240px] md:container lg:px-[16px] md:min-h-hero text-left">
						<h1 class="leading-none text-white tracking-light text-shadow shadow-neutral-950 lg:text-6xl">
							<?php echo $video_heading; ?>
						</h1>

						<p class="my-6 text-2xl leading-normal font-head max-w-[44ch] text-brand-blue-pale text-shadow shadow-neutral-950 lg:text-4xl">
							<?php echo $video_subheading; ?>
						</p>

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
				</div><?php
			} else {

				echo ll_page_hero( $page_title, $brand_message['label'], $hero_cta1_text, $hero_cta1_url, $hero_cta2_text, $hero_cta2_url );

			}
			?>

			<article id="post-<?php the_ID(); ?>" <?php if ( !is_front_page() ) { post_class( 'py-4 md:py-6 lg:py-8' ); } ?>>
				<div class="px-2 md:container lg:px-[16px]">
					<header>
						<?php the_title( '<h1 class="entry-title | hidden ">', '</h1>' ); ?>
					</header>
				</div>
			</article>

			<!-- <section class="full-bleed ll-equal-vert-padding not-prose">
				<div class="ind-grid | px-2 lg:px-[16px]">
					<h2 class="">Our services</h2>
					<?php // echo do_shortcode( '[display-posts post_type="page" post_parent="' . $page_id_industries . '" orderby="title" order="ASC" posts_per_page="-1" wrapper="div" wrapper_class="ind-card-flips is-style-default mx-auto max-w-6xl" layout="card-flip-sm" /]' ); ?>

					<div class="service-items | px-2 grid gap-4 md:grid-cols-4 md:gap-0 lg:px-[16px] lg:text-xl">
						<?php
						// foreach ( LL_KUADRA_SERVICES as $service ) {
							// echo '<div class="service-item | flex flex-col gap-4 p-4 md:px-8 lg:flex-row lg:items-start lg:px-12 lg:gap-10"><div class="item-icon | text-center group lg:min-w-56"><a class="block mb-4" href="' . $service['url'] . '"><div class="size-32 lg:size-48 inline-flex items-center justify-center shrink-0 rounded-full bg-brand-gray dark:bg-brand-gray-dark shadow-service group-hover:bg-atlantis-500"><i class="fa-solid ' . $service['icon'] . ' fa-4x fa-fw text-atlantis-500 group-hover:text-atlantis-700"></i></div></a><a class="block font-head font-semibold text-2xl leading-none group-hover:text-atlantis-700 dark:group-hover:text-atlantis-500 lg:text-4xl" href="' . $service['url'] . '">' . $service['label'] . '</a></div></div>'; } ?>
					</div>
				</div>
			</section> -->

			<section class="full-bleed ll-equal-vert-padding not-prose">
				<div class="px-2 lg:px-[16px]">
					<h2>Our services</h2>
					<ul class="service-items | mt-2 px-2 list-none grid gap-4 md:grid-cols-4 md:gap-0 lg:px-[16px] lg:text-xl">
						<?php
						foreach ( LL_KUADRA_SERVICES as $service ) {
							echo '<li class="card-ic | group flex flex-col gap-4 relative border-2 border-transparent shadow-aqua-700 focus-within:shadow-lg focus-within:border-neutral-500 dark:border-neutral-700 dark:shadow-aqua-500">

							<div class="card-text | flex flex-col text grow order-1 dark:text-neutral-300">
								<h3 class="text-center"><a class="block font-head font-semibold text-2xl leading-none group-hover:text-atlantis-800 dark:group-hover:text-atlantis-500 lg:text-4xl" href="' . $service['url'] . '" class="group-hover:decoration-aqua-200 focus:underline group-hover:underline">' . $service['label'] . '</a></h3>
							</div>

							<div class="card-img | text-center">
								<div class="size-32 lg:size-48 inline-flex items-center justify-center shrink-0 rounded-full bg-brand-gray dark:bg-brand-gray-dark shadow-service group-hover:bg-atlantis-500">
									<i class="fa-solid ' . $service['icon'] . ' fa-4x fa-fw text-atlantis-500 group-hover:text-atlantis-800"></i>
								</div>
							</div>

						</li>';
						}
						?>
					</ul>
				</div>
			</section>

			<div class="md:container bg-aqua-100 text-aqua-900 dark:bg-aqua-900 dark:text-aqua-200">
				<div class="p-4 md:p-8 lg:p-12 relative">
					<div class="lg:max-w-2xl">
						<h3>Reduce your payroll with remote teams</h3>
						<p class="my-2 lg:text-xl">Kuadra Support provides outsourced bookkeeping, back-office support, staffing, and employee leasing services to businesses across the U.S. Located just south of the border in Mexico, we provide access to bilingual, university-educated professionals familiar with U.S. compliance and regulatory requirements. Our services are scalable, so we can adjust to meet your changing needs.</p>
					</div>
					<div class="lg:overflow-visible lg:absolute lg:-top-24 lg:-right-12 lg:z-10 lg:w-[768px]">
						<?php get_template_part( 'template-parts/svg/svg', 'mexico' ); ?>
					</div>
				</div>
			</div>

			<section class="full-bleed ll-equal-vert-padding mt-8 bg-no-repeat bg-cover lg:mt-16" style="background-image: linear-gradient(to right, rgb(255 255 255 / 0.1) 0%, rgb(255 255 255 / 0.75) 45%, rgb(255 255 255 / 0.95) 100%), url('/wp-content/uploads/2024/01/feat__about.jpg')">
				<div class="p-2 md:container lg:p-[16px] flex justify-between place-items-center md:min-h-hero print:min-h-fit">
					<div class="hidden md:block">&nbsp;</div>
					<div class=" md:max-w-2xl dark:text-neutral-800">
						<h3 class="text-shadow shadow-white">Why Kuadra?</h3>
						<p class="text-shadow shadow-white my-2 lg:text-xl">Our focus on client service and geographical proximity allows us to quickly become an extension of your team. Unlike other outsourced companies that have resources halfway around the globe, we are located within a similar time zone and available to meet during your business hours. In addition, our bilingual professionals are well-versed in American culture and business acumen, which translates into a seamless service experience. </p>
					</div>
				</div>
			</section>

			<div class="px-2 md:container lg:px-[16px] ll-equal-vert-padding">
				<h3>Our Process</h3>
				<img class="mx-auto mt-4" src="<?php echo get_stylesheet_directory_uri(); ?>/img/kuadra-process.png" width="1203" height="572" alt="infographic illustrating the following process: Tell us what you need. We prepare an action plan for you. We sign contracts and formalize our business relationship. The recruiting process starts. You decide who to hire. We do all the paperwork. Welcome to your staff.">
			</div>

			<!-- <div class="px-2 md:container lg:px-[16px] ll-equal-vert-padding ">
				<?php // the_content(); ?>
			</div> -->

			<section class="full-bleed ll-equal-vert-padding not-prose bg-atlantis-500 break-inside-avoid print:animate-none print:bg-transparent">
				<div class="px-2 md:container lg:px-[16px]">
					<div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center md:justify-between lg:gap-8">
						<div class="prose lg:prose-xl ">
							<h2 class="mb-2">Let's get started</h2>
							<p class="">Interested in learning more about our bookkeeping and accounting solutions? Contact us and a team member will reach out to you shortly.</p>
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
