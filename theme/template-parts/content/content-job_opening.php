<?php
/**
 * Template part for displaying a single Job Opening
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

$f_timestatus                   = get_field( 'time_status' );
$f_location                     = get_field( 'location' );
$f_location_str                 = implode( ', ', $f_location);
$f_openclosed                   = get_field( 'opening_status' );
$f_opening                      = get_the_title(); // for form field population
$f_openingid                    = get_the_ID(); // for form field population
$f_applylink                    = get_field( 'apply_link' );

$job_openings_form = 2;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'py-4 md:py-6 lg:py-8' ); ?>>
	<div class="px-2 container xl:px-4">

		<?php if ( function_exists( 'bcn_display' ) ) { ?>
			<div class="breadcrumbs  |  font-head text-neutral-600 pb-4  |  md:pb-6 lg:pb-8" typeof="BreadcrumbList" vocab="https://schema.org"><?php bcn_display(); ?></div>
		<?php } ?>

		<div class="mt-4 ll-page-grid md:gap-8 md:grid md:auto-rows-auto lg:gap-16">

			<div class="ll-page-grid-area-a  |  md:col-span-2">
				<header class="mb-8 pb-4 border-b-4 border-atlantis-400  |  dark:border-atlantis-600">
					<?php the_title( '<h1 class="entry-title  |  mb-0 font-semibold">', '</h1>' ); ?>
				</header>

				<div <?php ll_content_class( 'entry-content' ); ?>>

					<?php the_content(); ?>

				</div>

			</div>

			<div class="my-16 ll-page-grid-area-b  |  md:my-0 md:col-span-3">

				<?php
					if ( ( $f_openclosed == '1' ) && ( $f_applylink ) ) {
						// Now, include the sharing display
						get_template_part( 'template-parts/form/form', 'webshare' );
					}
				?>

			</div>

			<div class="ll-page-grid-area-c">

				<p class="mt-20"><a name="apply"></a>&nbsp;</p>

				<?php if ( ( $f_openclosed == '1' ) && ( $f_applylink ) ) { ?>
					<div id="contact" class="container-contact-form not-prose">
						<h3 class="mb-4 lg:mb-8">Apply</h3>
						<?php
							gravity_form(
								$job_openings_form,
								false,
								false,
								false,
								array(
									'location' => $f_location_str,
									'opening' => $f_opening,
									'openingid' => $f_openingid
								),
								false
							);
							gravity_form_enqueue_scripts( $job_openings_form );
						?>
					</div>

					<p class="my-32 text-center todo"> ... or ... </p>

					<p class="text-xl"><a href="<?php echo $f_applylink; ?>"  rel="noreferrer" target="_blank"><i class="mr-1 fa-solid fa-edit"></i> Apply at LinkedIn</a> <span class="text-neutral-300 dark:text-neutral-700"> | </span> <a href="/careers/"><i class="mr-1 fa-regular fa-angle-left"></i> Back</a></p>

				<?php } else { ?>

					<p class="text-brand-red-dark"><em>Thank you for your interest but we are not accepting applications for this opening at this time.</em></p>

					<div class="my-8 wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
						<div class="wp-block-button is-style-outline"><a href="/careers/" class="wp-block-button__link has-aqua-800-color has-text-color wp-element-button"><i class="mr-1 fa-regular fa-angle-left"></i> Back</a></div>
					</div>

				<?php } ?>

			</div>
		</div>

	</div>

</article>
