<?php
/**
 * Template part for Keen Slider slides - testimonial version
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

$posttype_class = 'slide-' . get_post_type();

$type = get_field( 'll_testim_type' );
$title = get_field( 'll_testim_title' ); // Staff
$photo = get_field( 'll_testim_photo' ); // Staff
$rating = get_field( 'll_testim_rating' ); // Client


if ( ( $type === 'client' ) && ( get_field( 'll_testim_solution' ) === 'https://kuadradev.local/solutions/bookkeeping/' ) ) {
	$icon = get_field( 'll_testim_icon' ); // Client
	$solution = 'Bookkeeping and Back-Office Support';
	$solution_url = '/solutions/bookkeeping/';
} elseif ( ( $type === 'client' ) && ( get_field( 'll_testim_solution' ) === 'https://kuadradev.local/solutions/employee-leasing-staffing/' ) ) {
	$icon = 'fa-users';
	$solution = 'Employee Leasing and Staffing';
	$solution_url = '/solutions/employee-leasing-staffing/';
} else {
	$icon = 'fa-user';
}


?>

<div class="<?php echo $posttype_class; ?> testimonial-<?php echo $type; ?>  |  keen-slider__slide flex flex-col opacity-40 transition-opacity duration-500">
	<div class="grow rounded-lg bg-neutral-50 p-6 shadow-xs  |  sm:p-8">
		<div class="flex items-center gap-4">
			<div class="fa-4x">
				<span class="fa-layers fa-fw">
					<i class="fa-solid fa-circle text-aqua-300"></i>
					<i class="fa-inverse fa-sharp fa-regular <?php echo $icon; ?>" data-fa-transform="shrink-8"></i>
				</span>
			</div>

			<div class="prose prose-neutral  |  dark:prose-invert lg:prose-xl">
				<?php if ( $type === 'client' ) : ?>
					<div class="slide-rating flex justify-start gap-0.5 text-atlantis-500">
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
					</div>
					<p class="mt-0.5 font-bold"><?php echo get_the_title(); ?></p>
				<?php endif; ?>

				<?php if ( $type === 'staff' ) : ?>
					<p class="mt-0.5 font-bold text-lg"><?php echo get_the_title(); ?></p>
					<p><?php echo $title; ?></p>
				<?php endif; ?>

			</div>
		</div>

		<div class="mt-4">
			<?php the_content(); ?>
		</div>
	</div>
</div>
