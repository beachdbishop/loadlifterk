<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

$peepauthor                     = get_field( 'll_people_user' );
$peep_thumbnail                 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
if ( $peep_thumbnail ) {
	$headshot                       = esc_url( $peep_thumbnail[0] );
} else {
	$headshot                       = esc_url( get_template_directory_uri() . '/img/headshot__empty.svg' );
}
$peep_level                     = get_field( 'll_people_level' );
?>

<li <?php post_class( 'person-card card | group' ); ?>>
	<div class="flex items-center h-full p-4 border rounded-lg border-neutral-200">

		<div class="card-text | flex-grow order-1">
			<?php
			if ($peep_level['value'] !== '900') {
				$title_classes = 'group-hover:text-brand-red';
				echo sprintf( '<h3 class="leading-none text-brand-gray-dark %1$s"><a href="%3$s" rel="bookmark">%2$s </a></h3>', $title_classes, get_the_title(), esc_url( get_permalink() ) );
			} else {
				$title_classes = 'group-hover:text-brand-gray-dark';
				echo sprintf( '<h3 class="leading-none text-brand-gray-dark %1$s">%2$s</h3>', $title_classes, get_the_title() );
			}

			if( get_field( 'll_people_title' ) ) {
				echo sprintf( '<p class="text-lg leading-tight text-neutral-600 font-head">%1$s</p>', get_field( 'll_people_title' ) );
			}
			?>
		</div>

		<div class="card-img | shrink-0 object-cover object-center mr-4 rounded-full bg-neutral-100 bg-no-repeat group-hover:border-brand-red" style="background-image: url('<?php echo $headshot; ?>'); background-size: 64px 86px; background-position: center top;" aria-label="">
			<div class="size-16 aspect-square">&nbsp;</div>
		</div>

	</div>
</li>
