<?php
/**
 * Template part for displaying a Person (single view)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

$peepsep                        = ' <span class="sep opacity-60">|</span> ';
$peepauthor                     = get_field( 'll_people_user' );
$peep_thumbnail                 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
if ( $peep_thumbnail ) {
	$headshot                   = esc_url( $peep_thumbnail[0] );
} else {
	$headshot                   = esc_url( get_template_directory_uri() . '/img/headshot__empty.svg' );
}

if ( get_field( 'll_people_organization' ) === 'Kuadra Support' ) {
	$peep_class                 = 'internal';
} else {
	$peep_class                 = 'external';
}

$peep_level                     = get_field( 'll_people_level' );

if ( $peepauthor ) {
	$peepid                     = $peepauthor['ID'];
	$peepname                   = $peepauthor['display_name'];
	$peepnicename               = $peepauthor['user_nicename'];
	// $peepfirstname           = $peepauthor['user_firstname'];
	$person_archivelink         = sprintf( '<a href="/author/%1$s/">%2$s</a>', $peepnicename, $peepname );
	$peeppostcount              = ( $peepauthor ) ? count_user_posts( $peepid, 'post', true ) : 0;
	$recent_year_barrier        = date( "Y", strtotime( "-1 year" ) );
} else {
	// $peepfirstname           = '';
	$peeppostcount              = 0;
}
?>

<article <?php post_class( 'py-4 md:py-6 lg:py-8' ); ?>>
	<div class="px-2 container lg:px-[16px]">

		<?php get_template_part( 'template-parts/layout/chunk', 'breadcrumbs' ); ?>

		<div class="peepgrid peep-<?php echo $peep_class; ?> peep-<?php echo esc_attr( $peep_level['value'] ); ?> | md:grid md:grid-cols-3 gap-4 lg:grid-cols-4 lg:gap-16">

			<div class="peepgrid-a | pb-8 md:pt-2 md:pb-0 md:order-2">
				<div class="headshot-wrapper | relative before:content-[''] before:absolute before:top-2 before:left-2 before:w-full before:h-full before:bg-aqua-200 dark:before:bg-aqua-700 print:before:bg-none">
					<?php ll_people_headshot(); ?>
				</div>
			</div>

			<div class="peepgrid-b |  md:col-span-2 md:row-span-2 md:order-1 lg:col-span-3">
				<header class="mb-4 flex flex-col items-center sm:flex-row sm:justify-between">
					<div>
					<?php
					if ( $peep_class === 'internal' ) {
						the_title( '<h1 class="entry-titl | mb-0 ">', '</h1>' );

						if( get_field( 'll_people_designations' ) ) {
							echo sprintf( '<h2 class="leading-normal tracking-tight text-aqua-700 dark:text-aqua-300">%1$s</h2>', get_field( 'll_people_designations' ) );
						}

						if( get_field( 'll_people_title' ) ) {
							echo sprintf( '<h2 class="text-neutral-700 dark:text-neutral-400">%1$s</h2>', get_field( 'll_people_title' ) );
						}
					} else {
						the_title( '<h1 class="entry-title | mb-0 ">', '</h1>' );

						if( get_field( 'll_people_title' ) ) {
							echo sprintf( '<h2 class="text-neutral-900">%1$s</h2>', get_field( 'll_people_title' ) );
						}

						if ( get_field( 'll_people_organization' ) ) {
							echo sprintf( '<h2 class="text-neutral-600">%1$s</h2>', get_field( 'll_people_organization' ) );
						}
					}
					?>
					</div>
					<div class="pl-2 md:pl-4">
						<?php if ( get_field('ll_people_soc_linkedin') ) {
							echo '<a class="text-aqua-700 hover:text-aqua-500" href="' . get_field('ll_people_soc_linkedin') . '" aria-label="View LinkedIn profile"><i class="fa-brands fa-linkedin fa-2x"></i></a>';
						} ?>
					</div>
				</header>

				<div <?php ll_content_class( 'entry-content' ); ?>>
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span> "%s"</span>', 'loadlifter' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						)
					);
					?>

					<div class="clear-both">&nbsp;</div>

				</div>
			</div>

			<aside class="peepgrid-c |  md:mt-0 md:order-3">

				<?php get_template_part( 'template-parts/form/form-contact', 'sidebar' ); ?>

			</aside>
		</div>

	</div>

</article>

<?php // if ( $peeppostcount > 0 ) : ?>
	<!-- <section id="posts-by-<?php // the_ID(); ?>" <?php // post_class( 'bg-neutral-100 md:py-6 lg:py-8 dark:bg-neutral-950' ); ?>>
		<div class="px-2 container lg:px-[16px]">
			<h3 id="posts" class="mt-2 mb-4 text-4xl md:mb-8 text-brand-blue head-last-bold dark:text-neutral-300">Recent Insights by <strong><?php // echo $person_archivelink; ?></strong></h3>
			<?php // echo do_shortcode( '[display-posts wrapper="ul" wrapper_class="dps-grid-4max cards-ic" layout="card-ic" author="'.$peepnicename.'" date_query_after="' .$recent_year_barrier. '-01-01" posts_per_page="3" orderby="modified"	no_posts_message="No recent posts found by this author." /]' ); ?>
		</div>
	</section> -->
<?php // endif; ?>

<section class="full-bleed bg-aqua-50 ll-equal-vert-padding  |  dark:bg-atlantis-800 dark:text-neutral-200">
	<div class="px-2 lg:px-[16px]">
		<h3>On a personal note...</h3>
		<?php if ( get_field( 'll_people_personal' ) ) { ?>
			<blockquote class="peepquote | font-head italic text-xl text-aqua-800  |  dark:text-atlantis-200">&quot;<?php echo esc_html( get_field( 'll_people_personal' ) ); ?>&quot;</blockquote>
		<?php } ?>
		<p>&hellip;</p>
		<p>pictures?</p>
		<p>Q&A?</p>
	</div>
</section>
