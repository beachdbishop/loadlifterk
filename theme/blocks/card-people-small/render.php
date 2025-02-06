<?php
/**
 * Small People Card
 *
 * @param			array $block The block settings and attributes
 * @param			string $content The block inner HTML (empty).
 * @param			bool $is_preview True during backend preview render.
 * @param 		int $post_id The post ID the block is rendering content against.
 * 						This is either the post ID currently being displayed inside a
 * 						query loop, or the post ID of the post hosting this block.
 * @param			array $context The context provided to the block by the post or
 * 						its parent block.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'll-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}


$person = get_field( 'll_person' );
$person_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $person ), 'medium' );
if ( $person_thumbnail ) {
	$headshot = esc_url( $person_thumbnail[0] );
} else {
	$headshot = esc_url( get_template_directory_uri() . '/img/headshot__empty.svg' );
}
$person_title = get_field( 'll_people_title', $person );
$person_level = get_field( 'll_people_level', $person );
?>


<div <?php post_class( 'person-card card | ' ); ?>>
	<div class="flex items-center h-full p-4 border rounded-lg border-neutral-200">

		<div class="card-text | flex-grow order-1">
			<?php
			if ($person_level['value'] !== '900') {
				$title_classes = '';

				echo sprintf( '<h3 class="leading-none text-brand-gray-dark %1$s"><a href="%3$s">%2$s</a></h3>', $title_classes, get_the_title( $person ), esc_url( get_permalink( $person ) ) );
			} else {
				$title_classes = '';

				echo sprintf( '<h3 class="leading-none text-brand-gray-dark %1$s">%2$s</h3>', $title_classes, get_the_title( $person ) );
			}

			if( $person_title ) {
				echo sprintf( '<p class="text-lg leading-tight text-neutral-600 font-head">%1$s</p>', $person_title );
			}
			?>
		</div>

		<div class="card-img | flex-shrink-0 object-cover object-center mr-4 rounded-full bg-neutral-100 bg-no-repeat" style="background-image: url('<?php echo $headshot; ?>'); background-size: 64px 86px; background-position: center top;" aria-label="">
			<div class="size-16 aspect-square">&nbsp;</div>
		</div>

	</div>
</div>
