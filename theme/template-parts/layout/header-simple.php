<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */
?>


<?php //   P R E H E A D E R   A R E A   ?>
<?php get_template_part( 'template-parts/siteblocks/pre', 'header' ); ?>

<header id="masthead" class="nav-header  |  bg-white sticky top-0 z-39  |  dark:bg-neutral-900 dark:text-neutral-100 dark:shadow-none md:shadow-neutral-400/50 md:shadow-md print:bg-white print:shadow-none">
	<div class="flex items-center justify-between px-2 py-3  |  md:container lg:px-[16px]">

		<div class="w-40 order-1  |  sm:w-50 lg:w-80">
			<a href="<?php bloginfo('url'); ?>" aria-label="<?php echo bloginfo('name'); ?>" title="Go to Kuadra's front page">
				<?php get_template_part('template-parts/svg/svg', 'logo-color'); ?>
			</a>
		</div>

		<div class="nav-ctrls  |  flex flex-row justify-end order-3  |  print:hidden">
			<button class="toggle-mobile-nav  |  ml-2 p-2 border-2 border-neutral-500 rounded-sm cursor-pointer  |  sm:rounded-lg md:hidden focus:bg-brand-blue-faint dark:focus:bg-neutral-800 dark:focus:text-brand-blue-pale" aria-controls="primary-navigation" aria-expanded="false" tabindex="0">
				<span class="">Menu</span>
			</button>
		</div>

		<nav class="menus-container  |  md:flex md:flex-col md:grow md:order-1 print:hidden" id="primary-navigation" aria-label="Main Navigation">
			<!-- ul class="disclosure-nav  |  list-none font-head font-semibold order-1  |  md:flex md:gap-x-2 md:justify-end md:order-last lg:gap-x-6 " -->
				<?php
				// foreach ( LL_NAV_PRIMARY as $primary ) {
				// 	if ( $primary['hasChildren'] === true ) {
				// 		// $isMega = ( $primary['label'] === 'Services' ) ? ' mega' : '';
				// 		$isMega = '';
				// 		echo sprintf( '<li>
				// 				<a class="main-link  |  text-lg underline-offset-2  |  " href="%1$s" data-menu="%3$s">%2$s</a>
				// 				<button type="button" aria-expanded="false" aria-controls="id_%3$s_menu" aria-label="%2$s menu"></button>
				// 				<div id="id_%3$s_menu" class="dropmenu %5$s" style="display:none">%4$s</div>
				// 			</li>',
				// 			$primary['url'],
				// 			$primary['label'],
				// 			str_replace( ' ', '_', strtolower( $primary['label'] ) ),
				// 			do_shortcode( $primary['submenuContent'] ),
				// 			$isMega,
				// 		);
				// 	} else {
				// 		echo '<li><a class="main-link  |  text-lg underline-offset-2  |  " href="' . $primary['url'] . '">' . $primary['label'] . '</a></li>';
				// 	}
				// }
				?>
			<!-- /ul -->

			<?php
			wp_nav_menu( array(
				'menu_class'				=> "disclosure-nav  |  list-none font-head font-semibold order-1  |  md:text-lg md:flex md:gap-x-2 md:justify-end md:order-last lg:gap-x-6", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
				'container' 				=> "", // (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
				'theme_location'		=> "ll_menu_simple", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
				'walker' 						=> new WPDocs_Walker_Nav_Menu(), // (object) Custom walker to use instead of the default one.
			) );
			?>

			<ul class="secondary-nav  |  font-head text-neutral-700 flex flex-col  |  md:order-1 md:justify-end md:items-center md:gap-x-1 md:flex-row md:pb-1 lg:gap-x-4 dark:text-neutral-300 print:hidden">
				<?php
				// foreach ( LL_NAV_SECONDARY as $secondary ) {
				// 	echo '<li class="p-2 md:py-0"><a class="underline-offset-2 decoration-dotted decoration-from-font hover:underline hover:text-brand-blue hover:decoration-neutral-400 dark:hover:text-neutral-100" href="' . $secondary['url'] . '">' . $secondary['label'] . '</a></li>';
				// }
				?>
				<li class="md:max-w-[200px] lg:max-w-fit"><?php get_search_form(); ?></li>
			</ul>
		</nav>

	</div>
</header>
