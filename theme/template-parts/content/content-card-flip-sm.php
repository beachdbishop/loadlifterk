<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */

$title                          = get_the_title();
// $title_attr                     = the_title_attribute( 'echo=0' );
$title_is_long                  = ( ( iconv_strlen( get_the_title(), 'UTF-8' ) > 30 ) ? 'text-lg' : '' );
$icon                           = get_field( 'll_page_icon' );
$message                        = get_field( 'll_brand_message', $post->ID );
// $feat_image_url                 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
$feat_image_url                 = wp_get_attachment_image_src( get_post_thumbnail_id(), ['675', '220'] );
?>

<div class="card-<?php echo $icon; ?>">
	<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
		<div class="card  |  group relative inline-block float-left w-[180px] h-[180px] perspective-normal  |  md:w-[190px] md:h-[190px] lg:w-[200px] lg:h-[200px]">
			<div class="card-content | absolute w-full h-full rounded-lg shadow-lg shadow-neutral-300 transition-transform ease-out duration-700 transform-3d  |  dark:shadow-none">
				<div class="card-front | text-center bg-(--card-front-bg) text-(--card-front-text) absolute w-full h-full flex flex-col items-center justify-center rounded-lg px-4 backface-hidden">
					<?php if ( $icon ) : ?>
					<div class="card-icon  |  text-(--card-front-icon)">
						<span class="fa-stack fa-2x">
							<i class="text-white fa-solid fa-circle fa-stack-2x  |  dark:text-neutral-900"></i>
							<i class="fa-duotone <?php echo $icon; ?> fa-stack-1x "></i>
						</span>
					</div>
					<?php endif; ?>
					<h4 class="mt-2 font-light leading-none text-current <?php echo $title_is_long; ?>"><?php echo $title; ?></h4>
				</div>
				<div class="card-back  |  absolute w-full h-full flex flex-col items-center justify-center rounded-lg px-4 bg-(--card-back-bg) text-(--card-back-text) bg-no-repeat bg-cover bg-blend-overlay shadow-neutral-900/50 backface-hidden rotate-y-180" style="background-image: url('<?php echo $feat_image_url[0]; ?>')">
					<?php
					echo '<h5 class="my-2 leading-none tracking-wide text-center text-current uppercase text-shadow">' . $title . '</h5>';
					echo '<p class="text-center text-shadow">' . ll_no_widows( $message['label'] ) . '</p>';
					?>
				</div>
			</div>
		</div>
	</a>
</div>
