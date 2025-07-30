<?php
/*
 * Template Name: Full-width Page
 * This is the template that displays a full-width page (no automatic sidebar).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

get_header();

$page_id                        = get_the_ID();
// $page_id_industries             = ( wp_get_environment_type() == 'local' ) ? '3196' : '31923';

if (get_field('ll_page_title_override')) {
	$page_title                 = get_field('ll_page_title_override');
} else {
	$page_title                 = get_the_title();
}

$page_icon											= (get_field('ll_page_icon')) ? get_field('ll_page_icon') : false;
$page_message 									= get_field('ll_brand_message');
// $page_excerpt 									= get_the_excerpt();
// $page_post_category							= get_field( 'll_ind_category' );
$page_cta_standard 							= get_field('ll_ind_show_standard_cta');
$page_cta_heading 							= get_field('ll_ind_cta_heading');
$page_cta_body 									= get_field('ll_ind_cta_body');
$page_cta_button_text 					= get_field('ll_ind_cta_button_text');
$page_cta_html 									= get_field('ll_ind_cta_html');
$page_groups_html 							= get_field('ll_ind_groups_html');
$page_people 										= get_field('ll_ind_people');
$page_people_display 						= get_field('ll_ind_people_display_style');
$page_form 											= get_field('ls_hs_form_html');
$hero_cta1_text 								= get_field('ll_hero_cta1_text');
$hero_cta1_url 									= get_field('ll_hero_cta1_url');
$hero_cta2_text									= get_field('ll_hero_cta2_text');
$hero_cta2_url 									= get_field('ll_hero_cta2_url');
?>

<main id="primary" class="bg-white relative z-10 shadow-xl  |  lg:shadow-2xl dark:bg-neutral-900">

	<?php
	while (have_posts()) :
		the_post();
		// get_template_part( 'template-parts/content/content', 'page' );
	?>

		<?php if (get_field('ll_hide_featured_image') === false) :
			echo ll_page_hero($page_title, $page_message['label']);
		endif; ?>

		<article id="post-<?php the_ID(); ?>" <?php if (!is_front_page()) {
																						post_class('pt-4 md:pt-6 lg:pt-8');
																					} ?>>
			<div class="px-2 container xl:px-4">

				<?php if (get_field('ll_hide_featured_image') === true) { ?>
					<?php if (function_exists('bcn_display')) { ?>
						<div class="breadcrumbs | font-head text-neutral-600 pb-4 md:pb-6 lg:pb-8 dark:text-neutral-400"
							typeof="BreadcrumbList" vocab="https://schema.org"><?php bcn_display(); ?></div>
					<?php } ?>

					<header class="mb-4">
						<?php the_title('<h1 class="entry-title | text-aqua-700">', '</h1>'); ?>
					</header>
				<?php } ?>

				<div <?php ll_content_class('entry-content'); ?>>

					<?php the_content(); ?>

					<?php
					// wp_link_pages(
					// 	array(
					// 		'before' => '<div>' . esc_html__( 'Pages:', 'loadlifter' ),
					// 		'after'  => '</div>',
					// 	)
					// );
					?>
				</div>

				<?php if (get_field('ll_normal_contact_form_location') == 1) : ?>
					<div id="contact" class="not-prose">
						<?php get_template_part('template-parts/form/form', 'contact-sidebar'); ?>
					</div>
				<?php endif; ?>

			</div>
		</article>

	<?php
	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
