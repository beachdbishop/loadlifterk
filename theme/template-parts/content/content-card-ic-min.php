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

<li <?php post_class( 'card-ic card | group flex flex-col relative border-transparent border-2 shadow-orient-700 focus-within:shadow-lg focus-within:border-neutral-500 dark:border-neutral-700 dark:shadow-orient-500' ); ?>>

	<div class="card-text | flex flex-col text grow order-1">
		<h3 class="my-2 overflow-hidden tracking-wide text-current text-ellipsis"><a href="' . esc_url( get_permalink() ) . '" class="group-hover:decoration-brand-blue-pale focus:underline group-hover:underline"><?php echo $page_title; ?></a></h3>
	</div>

	<div class="card-img | ">
		<?php
		// echo wp_get_attachment_image( get_post_thumbnail_id(), 'medium' );
		ll_featured_image( array( 'size' => 'card' ) );
		?>
	</div>

</li>
