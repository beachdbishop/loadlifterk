<?php
/*
 * Template Name: Service Page
 * This is the template that displays Services pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
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
// $page_excerpt 									= get_the_excerpt();
// $page_post_category							= get_field( 'll_ind_category' );
$page_cta_standard 							= get_field( 'll_ind_show_standard_cta' );
$page_cta_heading 							= get_field( 'll_ind_cta_heading' );
$page_cta_body 									= get_field( 'll_ind_cta_body' );
$page_cta_button_text 					= get_field( 'll_ind_cta_button_text' );
$page_cta_html 									= get_field( 'll_ind_cta_html' );
$page_groups_html 							= get_field( 'll_ind_groups_html' );
$page_people 										= get_field( 'll_ind_people' );
$page_people_display 						= get_field( 'll_ind_people_display_style' );
$page_form 											= get_field( 'ls_hs_form_html' );
$hero_cta1_text 								= get_field( 'll_hero_cta1_text' );
$hero_cta1_url 									= get_field( 'll_hero_cta1_url' );
$hero_cta2_text									= get_field( 'll_hero_cta2_text' );
$hero_cta2_url 									= get_field( 'll_hero_cta2_url' );
?>

	<main id="primary" class="bg-white dark:bg-neutral-900">

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php echo ll_better_page_hero( $page_title, $page_message['label'], $hero_cta1_text, $hero_cta1_url, $hero_cta2_text, $hero_cta2_url ); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="px-2 container lg:px-[16px]">
					<div class="mt-4 ll-page-grid md:gap-8 md:mt-8 md:grid md:auto-rows-auto lg:mt-16 lg:gap-16">

						<div <?php ll_content_class( 'entry-content ll-page-grid-area-a md:col-span-2' ); ?>>
							<?php the_content(); ?>

							<!-- <div class="testimonials | not-prose border-8 border-solid border-atlantis-500 p-4 lg:p-8">
								<h3 class="text-center ">What people say about us</h3>
								<div class="mt-4 md:mt-8 md:flex md:gap-4 lg:gap-8">
								<?php
								// foreach ( LL_FAKE_TESTOMONIALS as $test ) {
								// 	if ( $test['service'] == 'book' ) {
								// 		echo '<div class="testimonial | ">
								// 			<div class="bg-aqua-100 text-aqua-900 pt-4 px-4 pb-12 text-center">
								// 				<p class="leading-snug">&quot;' . $test['text'] . '&quot;</p>
								// 			</div>
								// 			<div class="mx-auto -mt-8 aspect-square size-16 bg-pink-200 border-2 border-solid border-aqua-700 rounded-full ">
								// 				<img src="avatar.png" alt="Logo or headshot?" class="size-16 text-pink-600 text-center text-xs">
								// 			</div>
								// 			<div class="text-center mt-2 font-head"><span class="font-bold">' . $test['name'] . '</span>, <span>' . $test['company'] . '</span></div>
								// 		</div>';
								// 	}
								// }
								?>
								</div>
							</div> -->
						</div>

						<div class="my-16 ll-page-grid-area-b md:my-0 md:col-span-3">

							<?php /* CTA
							* TODO: Should this get maybe turned into a template part?
							*/
							if ( $page_cta_standard ) :
								echo '<section class="full-bleed ll-equal-vert-padding not-prose bg-atlantis-400 text-atlantis-950 break-inside-avoid print:animate-none print:bg-transparent">

									<div class="px-2 container lg:px-[16px]">
										<div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center md:justify-between lg:gap-8">
											<div class="prose lg:prose-xl ">
												<h2 class="mb-2">' . $page_cta_heading . '</h2>
												<p class="max-w-main">' . $page_cta_body . '</p>
												<p class="hidden print:mt-8 print:block">Email info@kuadrasupport.com</p>
											</div>
											<div class="w-full md:max-w-fit print:hidden">
												<div class="wp-block-button"><a class="border-2 wp-block-button__link wp-element-button has-aqua-600-background-color has-background-color border-aqua-600 hover:border-aqua-800 hover:bg-atlantis-500 hover:text-aqua-800" href="#contact">' . $page_cta_button_text . '</a></div>
											</div>
										</div>
									</div>

								</section>';
							elseif ( ( $page_cta_standard == false ) && ( !empty( $page_cta_html ) ) ) :
									echo do_shortcode( $page_cta_html );
							endif;
							?>

							<?php // SERVICE PROFESSIONALS AND INVOLVEMENT   ?>
							<?php if ( ( $page_people_display != 'hide' ) || ( !empty( $page_groups_html ) ) ) : ?>
							<section class="full-bleed not-prose ll-equal-vert-padding">
								<div class="px-2 container lg:px-[16px]">
									<?php if ( ( $page_people ) && ( $page_people_display != 'hide' ) ) : ?>

										<h2>Our Team</h2>

										<?php
										if ( $page_people_display === 'slider' ) :
											echo do_shortcode( '[display-posts post_type="people" id="' . implode( ', ', $page_people ) . '" posts_per_page="-1" meta_key="ll_people_last_name" orderby="meta_value" order="ASC" wrapper="div" wrapper_class="slider slider-people mx-auto max-w-5xl" layout="slide-people" /]' );
										endif;

										if ( $page_people_display === 'grid' ) :
											$grid_class = (count( $page_people ) == 3) ? 'dps-grid-3max' : 'dps-grid-4max';
											echo do_shortcode( '[display-posts post_type="people" id="' . implode( ', ', $page_people ) . '" posts_per_page="-1" meta_key="ll_people_last_name" orderby="meta_value" order="ASC" wrapper="div" wrapper_class="mt-4 ' . $grid_class . ' " layout="card-people-md" /]' );
										endif; ?>

									<?php endif; ?>

									<?php if ( $page_groups_html ) :
										echo do_shortcode( $page_groups_html );
									endif; ?>

								</div>
							</section>
							<?php endif; ?>

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

			<?php if ( $page_people_display === 'slider' ) : ?>
				<script>
					const slider = new A11YSlider(document.querySelector(".slider"), {
						arrows: false,
						autoplay: true,
						autoplaySpeed: 5000,
						dots: true
					});
				</script>
			<?php endif; ?>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
