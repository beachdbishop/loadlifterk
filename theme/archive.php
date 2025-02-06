<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

get_header();
?>

	<main id="primary" class="py-4 bg-white dark:bg-neutral-800 md:py-6 lg:py-8">
		<div class="px-2 container lg:px-[16px]">
			<?php if ( function_exists( 'bcn_display' ) ) { ?>
				<div class="breadcrumbs | font-head text-neutral-600 pb-4 md:pb-6 lg:pb-8 dark:text-neutral-400" typeof="BreadcrumbList" vocab="https://schema.org"><?php bcn_display(); ?></div>
			<?php } ?>

			<?php if ( have_posts() ) : ?>

				<header>
					<?php
					the_archive_title( '<h2 class="entry-title dark:text-neutral-200">', '</h2>' );
					the_archive_description( '<div class="font-head">', '</div>' );
					?>
				</header>


				<div class="grid grid-cols-1 gap-8 -mx-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
					<?php /* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content/content', 'card' );

					endwhile;
					?>
				</div>

        <div class="mt-8">
					<?php // ll_paging_nav();
					if ( function_exists( 'wpgb_render_facet' ) ) {
							wpgb_render_facet( ['id' => 11, 'grid' => 'wpgb-content' ] );
					} ?>
				</div>

      <?php

			else :

				get_template_part( 'template-parts/content/content', 'none' );

			endif;
			?>

		</div>
	</main><!-- #main -->

<?php
get_footer();
