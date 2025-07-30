<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Load_Lifter
 */



get_header();
?>

<main id="primary" class="bg-white relative z-10 shadow-xl  |  lg:shadow-2xl dark:bg-neutral-900">

	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content/content', get_post_type());

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
