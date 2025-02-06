<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 *
 * @see https://inclusive-components.design/cards/
 */

 if ( get_field( 'll_page_title_override' ) ) {
	$page_title = get_field( 'll_page_title_override' );
} else {
	$page_title = get_the_title();
}
?>

<li <?php post_class( 'card-ic card | group flex flex-col relative border-neutral-100 border-2 shadow-orient-700 focus-within:shadow-lg focus-within:border-neutral-500 dark:border-neutral-700 dark:shadow-orient-500' ); ?>>

	<div class="card-text | flex flex-col text grow order-1 bg-white dark:bg-neutral-800 dark:text-neutral-300">
		<h3 class="my-2 overflow-hidden tracking-wide text-brand-blue dark:text-brand-blue-pale text-ellipsis"><a href="<?php echo esc_url( get_permalink() ); ?>" class="group-hover:decoration-brand-blue-pale focus:underline group-hover:underline"><?php echo $page_title; ?></a></h3>

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
		<?php ll_featured_image( array( 'size' => 'card' ) );	?>
	</div>

</li>
