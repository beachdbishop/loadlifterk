<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Load_Lifter
 */


$menuItemsPrimary = [
	"services" => [
		"label" => 'Solutions',
		"url" => '/solutions/',
		"hasChildren" => true,
			"submenuContent" => '[listmenu menu="Services menu" /]',
	],
	"about" => [
		"label" => 'About Us',
		"url" => '/about/',
		"hasChildren" => true,
			"submenuContent" => '[listmenu menu="About menu" /]',
	],
	"careers" => [
		"label" => 'Careers',
		"url" => '/careers/',
		"hasChildren" => false,
	],
	"contact" => [
		"label" => 'Contact Us',
		"url" => '/contact/',
		"hasChildren" => false,
	],
];
$menuItemsSecondary = [
	"clients" => [
		"label" => 'Client Center',
		"url" => '/client-center/',
	],
	"insights" => [
		"label" => 'Insights',
		"url" => '/blog/',
	],
	"events" => [
		"label" => 'Events',
		"url" => '/category/events/',
	],
];

?>



<?php //   P R E H E A D E R   A R E A   ?>
<?php get_template_part( 'template-parts/siteblocks/pre', 'header' ); ?>

<header id="masthead" class="nav-header | bg-white dark:bg-neutral-900 dark:text-neutral-100 print:bg-white print:shadow-none sticky top-0 z-[39] ">
	<div role="navigation" class="flex items-center justify-between px-2 py-3 md:container lg:px-[16px]">

		<div class="w-40 sm:w-60 lg:w-80 order-first">
			<a href="<?php bloginfo('url'); ?>" aria-label="<?php echo bloginfo('name'); ?>" title="Go to Kuadra's front page">
				<?php get_template_part('template-parts/svg/svg', 'logo-color'); ?>
			</a>
		</div>

		<div class="nav-ctrls | flex flex-row justify-end order-last print:hidden">
			<button class="toggle-mobile-nav | ml-2 p-2 border-2 border-neutral-500 rounded sm:rounded-lg cursor-pointer md:hidden focus:bg-brand-blue-faint dark:focus:bg-neutral-800 dark:focus:text-brand-blue-pale" aria-controls="primary-navigation" aria-expanded="false" tabindex="0">
				<span class="">Menu</span>
			</button>
		</div>

		<nav class="menus-container | md:flex md:flex-col md:grow md:order-1  print:hidden" id="primary-navigation" aria-label="Main Navigation">
			<ul class="disclosure-nav | list-none font-head font-semibold order-first md:flex md:gap-x-2 md:justify-end md:order-last lg:gap-x-6 ">
				<?php
				foreach ( $menuItemsPrimary as $primary ) {
					if ( $primary['hasChildren'] === true ) {
						// $isMega = ( $primary['label'] === 'Services' ) ? ' mega' : '';
						$isMega = '';
						echo sprintf( '<li>
								<a class="main-link text-lg underline-offset-2" href="%1$s">%2$s</a>
								<button type="button" aria-expanded="false" aria-controls="id_%3$s_menu" aria-label="%2$s menu"></button>
								<div id="id_%3$s_menu" class="dropmenu %5$s" style="display:none">%4$s</div>
							</li>',
							$primary['url'],
							$primary['label'],
							strtolower( $primary['label'] ),
							do_shortcode( $primary['submenuContent'] ),
							$isMega,
						);
					} else {
						echo '<li><a class="main-link text-lg underline-offset-2" href="' . $primary['url'] . '">' . $primary['label'] . '</a></li>';
					}
				}
				?>
			</ul>

			<ul class="secondary-nav | font-head  text-neutral-700 md:order-first md:justify-end flex flex-col md:items-center md:gap-x-1 md:flex-row md:pb-1 lg:gap-x-4 dark:text-neutral-300 print:hidden">
				<?php
				// foreach ( $menuItemsSecondary as $secondary ) {
				// 	echo '<li class="p-2 md:py-0"><a class="underline-offset-2 decoration-dotted decoration-from-font hover:underline hover:text-brand-blue hover:decoration-neutral-400 dark:hover:text-neutral-100" href="' . $secondary['url'] . '">' . $secondary['label'] . '</a></li>';
				// }
				?>
				<li class="md:max-w-[200px] lg:max-w-fit"><?php get_search_form(); ?></li>
			</ul>
		</nav>

	</div>
</header>
