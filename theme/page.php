<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter_K
 */

get_header();

$page_id                        = get_the_ID();
if (get_field('ll_page_title_override')) {
	$page_title                		= get_field('ll_page_title_override');
} else {
	$page_title                		= get_the_title();
}
$page_message                   = get_field('ll_brand_message');
$page_excerpt                   = get_the_excerpt();

?>

<main id="primary" class="bg-white relative z-10 shadow-xl  |  lg:shadow-2xl dark:bg-neutral-900">

	<?php
	while (have_posts()) :
		the_post();
		// get_template_part( 'template-parts/content/content', 'page' );
	?>

		<?php if (get_field('ll_hide_featured_image') === false) :
			echo ll_better_page_hero($page_title, $page_message);
		endif; ?>

		<article id="post-<?php the_ID(); ?>" <?php if (!is_front_page()) {
																						post_class('pt-4 md:pt-6 lg:pt-8');
																					} ?>>
			<div class="px-2 container lg:px-[16px]">

				<?php if (get_field('ll_hide_featured_image') === true) { ?>
					<?php get_template_part('template-parts/layout/chunk', 'breadcrumbs'); ?>

					<header class="mb-4">
						<?php the_title('<h1 class="entry-title | text-aqua-700">', '</h1>'); ?>
					</header>
				<?php } ?>

				<div <?php ll_content_class('entry-content'); ?>>

					<?php the_content(); ?>

				</div>

				<?php // if ( get_field( 'll_normal_contact_form_location' ) == 1 ) :
				?>
				<!-- <div id="contact" class="not-prose"> -->
				<?php // get_template_part( 'template-parts/form/form', 'contact-sidebar' );
				?>
				<!-- </div> -->
				<?php // endif;
				?>

			</div>
		</article>

	<?php
	endwhile; // End of the loop.
	?>

</main>

<?php
get_footer();
