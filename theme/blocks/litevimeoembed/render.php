<?php
/**
 * Lite Vimeo Embed
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

$video_id = get_field( 'll_litevimeo_id' );
$inline_styles = get_field( 'll_litevimeo_styles' );
?>

<lite-vimeo	id="<?php echo esc_attr($id); ?>"	videoid="<?php echo esc_attr($video_id); ?>" style="<?php echo esc_attr($inline_styles); ?>"></lite-vimeo>
