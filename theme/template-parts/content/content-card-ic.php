<?php
/**
 * Template part for displaying cards (adapted from Inclusive Components' design)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 *
 * @see https://inclusive-components.design/cards/
 */

?>

<li <?php post_class( 'card-ic | group flex flex-col relative border-neutral-100 border-2 shadow-aqua-700 focus-within:shadow-lg focus-within:border-neutral-500 dark:border-neutral-700 dark:shadow-aqua-500' ); ?>>

	<div class="card-text | flex flex-col text grow order-1 bg-white dark:bg-neutral-800 dark:text-neutral-300">
		<?php the_title( '<h3 class="my-2 overflow-hidden tracking-wide text-aqua-600 dark:text-aqua-200 text-ellipsis"><a href="' . esc_url( get_permalink() ) . '" class="group-hover:decoration-aqua-200 focus:underline group-hover:underline">', '</a></h3>' ); ?>

		<?php if ( has_excerpt() ) { ?>
			<p class="mt-2 mb-4 text-sm lg:text-base"><?php echo get_the_excerpt(); ?></p>
		<?php } ?>

		<p class="card-meta | mt-auto mb-3 text-sm lg:text-base">
			<?php if ( 'post' === get_post_type() ) {
				echo '<span>' . esc_html( get_the_date() ) . '</span>';
				echo " | ";
				ll_posted_by();
			} ?>
		</p>
	</div>

	<div class="card-img | ">
		<?php
		// echo wp_get_attachment_image( get_post_thumbnail_id(), 'medium' );
		ll_featured_image( array( 'size' => 'card' ) );
		?>
	</div>

</li>
