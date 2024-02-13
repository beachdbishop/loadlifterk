<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Load_Lifter
 */

get_header();
?>

	<main id="primary" class="py-4 bg-amber-50 md:py-6 lg:py-8 dark:bg-neutral-700">

		<section class="px-2 md:container lg:px-[16px]">
			<header>
				<h1 class="entry-title | text-amber-800 dark:text-amber-300"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'loadlifter' ); ?></h1>
			</header>

			<div <?php ll_content_class( 'entry-content' ); ?>>
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'loadlifter' ); ?></p>

				<?php get_search_form(); ?>

				<div class="">&nbsp;</div>

			</div>
		</section>

	</main><!-- #main -->

<?php
get_footer();
