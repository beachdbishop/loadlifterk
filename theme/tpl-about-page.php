<?php
/*
 * Template Name: About Page
 * This is the template that displays a page in the About section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

get_header();

$page_id = get_the_ID();
if ( get_field('ll_page_title_override' ) ) {
	$page_title = get_field( 'll_page_title_override' );
} else {
	$page_title = get_the_title();
}
// $page_icon = ( get_field( 'll_page_icon' ) ) ? get_field( 'll_page_icon' ) : false;
$page_message = get_field( 'll_brand_message' );
$page_excerpt = get_the_excerpt();
$page_featimg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
if ( $page_featimg == true ) {
	$page_featimg_url = $page_featimg[0];
} else {
	$page_featimg_url = '';
}
?>

	<main id="primary" class="about-page  |  bg-white  |  dark:bg-neutral-900">

		<?php
		while ( have_posts() ) :
			the_post();
			// get_template_part( 'template-parts/content/content', 'page-about' );
			?>

			<?php echo ll_better_page_hero( $page_title, $page_message ); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="px-2 container  |  lg:px-[16px]">

					<div class="ll-page-grid  |  mt-4  |  md:gap-8 md:mt-8 md:grid md:auto-rows-auto lg:mt-16 lg:gap-16">

						<div <?php ll_content_class( 'll-page-grid-area-a  |  entry-content flow  |  md:col-span-2' ); ?>>

							<?php the_content(); ?>

						</div>

						<div class="ll-page-grid-area-b  |  my-16  |  md:my-0 md:col-span-3">

							<?php
							$qargs = [
								'post_type' => 'testimonial',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'posts_per_archive_page'=> -1,
								'order' => 'ASC',
								'meta_query' => [
									[
										'key' => 'll_testim_type',
										'value' => 'client',
										'compare' => '='
									]
								]
							];
							$testimonialQuery = new WP_Query( $qargs );
							?>

							<?php
							// if ( $testimonialQuery->have_posts() ) :
							// 	get_template_part(
							// 		'template-parts/layout/chunk-slider', 'testimonials',
							// 		$args = [
							// 			'class' => 'slider-part',
							// 			'part_data' => [
							// 				'heading' => 'Why clients choose us',
							// 			]
							// 		]
							// 	);
							// endif;
							?>

						</div>

						<div class="ll-page-grid-area-c">
							<div id="contact" class="container-contact-form not-prose">
								<?php get_template_part( 'template-parts/form/form', 'contact-sidebar' ); ?>
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
