<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

$peepauthor                     = get_field( 'll_people_user' );
$peep_thumbnail                 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
if ( $peep_thumbnail ) {
	$headshot                       = esc_url( $peep_thumbnail[0] );
} else {
	$headshot                       = esc_url( get_template_directory_uri() . '/img/headshot__empty.svg' );
}
$peep_level                     = get_field( 'll_people_level' );
?>

<article <?php post_class( 'person-card | p-4 mb-4 group' ); ?>>
	<div class="card-headshot | mx-auto mb-2 md:mb-4 bg-brand-red-faint border-2 border-white bg-no-repeat bg-top bg-cover group-hover:border-brand-red dark:border-neutral-700" style="background-image: url('<?php echo $headshot; ?>');">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" aria-label="<?php echo get_the_title(); ?>">
			<div class="w-[200px] aspect-square">&nbsp;</div>
		</a>
	</div>

	<header>
		<?php
		$title_classes = ( $peep_level['value'] === '800' ) ? 'group-hover:text-brand-gray-dark' : 'group-hover:text-brand-red';
		echo sprintf( '<h3 class="font-bold leading-none text-center text-brand-gray %1$s dark:text-neutral-200"><a href="%3$s" rel="bookmark">%2$s</a></h3>', $title_classes, get_the_title(), esc_url( get_permalink() ) );
		?>
	</header>

	<?php
	// Only show designations for non-subsidiary entries
	if ( ( $peep_level['value'] != 800 ) && ( get_field( 'll_people_designations' ) ) ) {
		echo sprintf( '<p class="italic font-bold leading-tight tracking-tighter text-center font-head text-neutral-500 ">%1$s</p>', get_field( 'll_people_designations' ) );
	}

	if( get_field( 'll_people_title' ) ) {
		echo sprintf( '<p class="text-lg leading-tight text-center font-head">%1$s</p>', get_field( 'll_people_title' ) );
	}

	if ( $peep_level['value'] != 800 ) {
		if ( ( get_field_object( 'll_people_department' ) ) || ( get_field_object( 'll_people_location' ) ) ) {
			echo '<footer class="mt-2 text-sm text-center text-neutral-400 children:block children:px-2 lg:mt-4">';
				$peep_department = get_field_object( 'll_people_department' );
				$peep_dept_value = $peep_department['value'];
				if ( $peep_dept_value ) {
					ll_people_show_dept_list( $peep_dept_value );
				}

				$peep_location = get_field_object( 'll_people_location' );
				$peep_loc_value = $peep_location['value'];
				$peep_loc = $peep_loc_value['label'];
				if ( $peep_loc ) {
					ll_people_show_location( $peep_loc );
				}
			echo '</footer>';
		}
	}
	?>
</article>
