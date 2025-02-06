<?php
/**
 * Load Lifter K functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Load_Lifter_K
 */

if ( ! defined( 'LL_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'LL_VERSION', '0.6.0' );
}

if ( ! defined( 'LL_COMPANY_LEGAL_NAME' ) ) {
	define( 'LL_COMPANY_LEGAL_NAME', 'Kuadra Support' );
}
if ( ! defined( 'LL_COMPANY_NICE_NAME' ) ) {
	define( 'LL_COMPANY_NICE_NAME', 'Kuadra' );
}

if ( ! defined( 'LL_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `ll_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'LL_TYPOGRAPHY_CLASSES',
		'prose'
		// 'prose prose-neutral prose-headings:font-light prose-h4:font-light max-w-none prose-blockquote:font-serif prose-a:text-primary lg:prose-xl dark:prose-invert'
	);
}

if ( ! defined( 'LL_LP_TEMPLATES' ) ) {
	define(
		'LL_LP_TEMPLATES',
		[
			'tpl-landing-page.php'
		]
	);
}

if ( ! defined( 'LL_KUADRA_SERVICES' ) ) {
	define(
		'LL_KUADRA_SERVICES',
		[
			// "backoffice" => [
			// 	"label" => 'Back-Office Support',
			// 	"url" => '/services/back-office-support/',
			// 	"icon" => 'fa-id-badge',
			// 	"desc" => 'Our seasoned professionals assist with a variety of back-office functions, including accounting, administrative, and financial reporting. ',
			// ],
			"book" => [
				"label" => 'Bookkeeping and Back-Office Solutions',
				"url" => '/services/bookkeeping/',
				"icon" => 'fa-laptop-file',
				"desc" => 'Rely on our professionals to manage the day-to-day financial and administrative functions for your company. We can assist with tasks such as data entry, bank reconciliations, payroll, and financial statement preparation. We are proficient in QuickBooks Online, isolved, bill.com, and Oracle software platforms. ',
			],
			"lease" => [
				"label" => 'Employee Leasing and Staffing',
				"url" => '/services/employee-leasing/',
				"icon" => 'fa-person-walking-arrow-right',
				"desc" => 'Need assistance for a short-term project or ongoing accounting support to optimize day-to-day operations? Our skilled professionals work remotely as an extension of your internal team to provide support and help increase productivity.',
			],
			// "staffing" => [
			// 	"label" => 'Staffing',
			// 	"url" => '/services/staffing/',
			// 	"icon" => 'fa-people-roof',
			// 	"desc" => 'Finding the right people with refined skills for your internal accounting department can be challenging. Outsourcing the recruiting process to Kuadra Support saves time and reduces labor costs. We accelerate the placement of qualified individuals in positions while helping you grow your talent pool.',
			// ],
		]
	);
}

if ( ! defined( 'LL_CLIENT_TESTOMONIALS' ) ) {
	define(
		'LL_CLIENT_TESTOMONIALS',
		[
			"test00" => [
				"service" => "book",
				"name" => null,
				"company" => "Enilso, Inc.",
				"text" => "Kuadra has provided integral support with our bookkeeping needs from the start. They go above and beyond to meet their clients' needs. Their personnel are professional, reliable, and flexible. Without a doubt, Kuadra continues to play an essential role in helping our business run efficiently, and we are thankful for it."
			],
			"test01" => [
				"service" => "book",
				"name" => null,
				"company" => "Latitudes Furniture",
				"text" => "As small business owners, we must focus on running our business while ensuring our financial records are accurate and up-to-date. Kuadra has made that possible. Their bookkeeping services are consistently reliable, timely, and accurate, allowing us to execute financial and fiscal planning while keeping our day-to-day operations running smoothly."
			],
			"test03" => [
				"service" => "book",
				"name" => null,
				"company" => "Arencor Properties",
				"text" => "Luis Garayzar with Kuadra is top-notch and a pleasure to work with! He is very professional, courteous, and patient and gets things done right away. Kuadra has saved me so much time, and I no longer worry about our accounting process. Kuadra is the best! Keep up the great work!"
			],
			"test04" => [
				"service" => "book",
				"name" => "Omar",
				"company" => "Mining Valbest",
				"text" => "With Kuadra's help over the past three years, we've been able to make progress. Their technical support and accounting guidance have given us better control over our finances."
			],
		]
	);
}

// if ( ! defined( 'LL_FAKE_STAFF_TESTOMONIALS' ) ) {
// 	define(
// 		'LL_FAKE_STAFF_TESTOMONIALS',
// 		[
// 			[
// 				"name" => "Jane Doe",
// 				"title" => "Accountant",
// 				"text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Non pulvinar neque laoreet suspendisse interdum consectetur libero id."
// 			],
// 			[
// 				"name" => "Rick Springfield",
// 				"title" => "Accountant",
// 				"text" => "Viverra justo nec ultrices dui sapien eget mi proin sed. Cursus euismod quis viverra nibh cras pulvinar mattis. Consectetur adipiscing elit duis tristique sollicitudin nibh sit amet. Proin nibh nisl condimentum id. Suspendisse interdum consectetur libero id faucibus."
// 			],
// 			[
// 				"name" => "Lisa Simpson",
// 				"title" => "Tax Associate",
// 				"text" => "Justo laoreet sit amet cursus sit amet dictum sit. Amet commodo nulla facilisi nullam vehicula ipsum a. Etiam non quam lacus suspendisse. Tortor at risus viverra adipiscing at in tellus integer. Et sollicitudin ac orci phasellus egestas tellus rutrum tellus pellentesque. Sagittis aliquam malesuada bibendum arcu vitae elementum."
// 			],
// 			[
// 				"name" => "Bart Simpson",
// 				"title" => "Audit Associate",
// 				"text" => "Ultrices mi tempus imperdiet nulla. Id diam vel quam elementum pulvinar etiam non."
// 			],
// 		]
// 	);
// }

if ( ! defined( 'LL_STAFF_TESTOMONIALS' ) ) {
	define(
		'LL_STAFF_TESTOMONIALS',
		[
			[
				"name" => "Marian Michel",
				"title" => "Tax Project Manager",
				"text" => "The continuous opportunities for learning and development are what I value most about working for Kuadra."
			],
			[
				"name" => "Abraham Monroy",
				"title" => "Audit Associate",
				"text" => "I appreciate the focus on professional and personal development that Kuadra offers to help team members reach their full potential."
			],
			[
				"name" => "Alba Flores",
				"title" => "Jr. Administrative Assistant",
				"text" => "Kuadra offers a rewarding work environment where I can continue developing my skills, grow professionally, and advance in my career."
			],
			[
				"name" => "Hiram Padilla",
				"title" => "Tax Associate",
				"text" => "I enjoy Kuadra's supportive work environment where collaboration and continuous learning are encouraged."
			],
		]
	);
}

if ( ! function_exists( 'll_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ll_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Load Lifter K, use a find and replace
		 * to change 'loadlifter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'loadlifter', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		register_nav_menus(
			array(
				'll_menu_services' => __( 'Services menu', 'loadlifter' ),
				'll_menu_about' => __( 'About menu', 'loadlifter' ),
				'll_menu_col_1' => __( 'Footer Left', 'loadlifter' ),
				'll_menu_below_disclaimers' => __( 'Footer Below Disclaimers', 'loadlifter' ),
			)
		);

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'disable-custom-font-sizes' );
		// add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		add_filter( 'feed_links_show_comments_feed', '__return_false' );

		remove_theme_support( 'block-templates' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7);
		remove_action( 'wp_print_styles', 'print_emoji_styles');
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}
endif;
add_action( 'after_setup_theme', 'll_setup' );


/**
 * Enqueue scripts and styles.
 */
function ll_scripts() {
	// wp_register_style( 'a11y-slider-base', 'https://unpkg.com/a11y-slider@latest/dist/a11y-slider.css', [], '' );
	wp_enqueue_style( 'loadlifter-style', get_stylesheet_uri(), array(), LL_VERSION );
	if ( get_field( 'll_postpage_css' ) ) {
		$inline_css = get_field( 'll_postpage_css' );
		wp_add_inline_style( 'loadlifter-style', $inline_css );
	}

	// wp_register_script( 'a11y-slider', 'https://unpkg.com/a11y-slider@latest/dist/a11y-slider.js', [], '', false );
	wp_register_script( 'a11y-slider', get_template_directory_uri() . '/js/a11y-slider.min.js', [], LL_VERSION, false );
	wp_register_script( 'block-litevimeoembed', 'https://cdn.jsdelivr.net/npm/lite-vimeo-embed/+esm', [], false, false );
	wp_enqueue_script( 'fa-kit', 'https://kit.fontawesome.com/a2c7d80c94.js' );

	if ( !is_page_template( LL_LP_TEMPLATES ) ) {
		wp_enqueue_script( 'loadlifter-script', get_template_directory_uri() . '/js/script.min.js', [ 'wp-blocks' ], LL_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'll_scripts' );


// function ll_preload_assets() {
// 	global $wp_scripts;
// 	echo "\n";

	// echo '<link rel="preload" as="image" href="/wp-content/themes/loadlifter/img/phx-desert-color-no-crop-small.jpg" media="(max-width: 767px)" />
	// <link rel="preload" as="image" href="/wp-content/themes/loadlifter/img/phx-desert-color-no-crop.jpg" media="(min-width: 768px)" />';
	// echo '<link rel="preload" as="script" href="https://js.hsforms.net/forms/v2.js?ver=' . wp_get_theme()->get('Version') . '" />';

	// foreach ($wp_scripts->queue as $handle) {
	// 	$script = $wp_scripts->registered[$handle];

	// 	//-- If version is set, append to end of source.
	// 	$source = $script->src . ($script->ver ? "?ver={$script->ver}" : "");

	// 	//-- Spit out the tag.
	// 	echo "<link rel='preload' href='{$source}' as='script'/>\n";
	// }

// 	echo '<link rel="preload" href="' . get_stylesheet_directory_uri() . '/fonts/serenity-light-webfont.woff2" as="font" type="font/woff2">' . "\r\n";
// 	echo '<link rel="preload" href="' . get_stylesheet_directory_uri() . '/fonts/serenity-bold-webfont.woff2" as="font" type="font/woff2">' . "\r\n";
// }


add_filter( 'flying_press_exclude_from_minify:css' , function ($exclude_keywords) {
	$exclude_keywords = ['loadlifter'];
	return $exclude_keywords;
});


function ll_disable_wp_links_menu() {
	remove_menu_page( 'link-manager.php' );
}


function ll_load_admin_styles() {
	wp_register_style( 'rsms-inter', 'https://rsms.me/inter/inter.css' );
	wp_enqueue_style( 'rsms-inter' );

	wp_enqueue_style( 'll-admin', get_template_directory_uri().'/admin.css' );
}


/**
 * Disable automatic creation of YARPP thumbnail sizes
 * ... and disable yarpp stylesheets
 */
// add_filter( 'yarpp_add_image_size', '__return_false' );
// add_filter( 'yarpp_enqueue_related_style', '__return_false' );
// add_filter( 'yarpp_enqueue_thumbnails_style', '__return_false' );
// ^^^ If they ever add blog posts and need related posts, install YARPP and uncomment these lines


switch( wp_get_environment_type() ) {
	case 'local':
		add_action( 'admin_enqueue_scripts', 'll_load_admin_styles' );
		// add_action( 'wp_head', 'll_preload_assets', -1 );
		break;

	case 'staging':
		add_action( 'admin_enqueue_scripts', 'll_load_admin_styles' );
		break;

	default:
		add_action( 'admin_menu', 'll_disable_wp_links_menu' );
		add_action( 'admin_enqueue_scripts', 'll_load_admin_styles' );
		/* Hide Jetpack upsell ads */
		add_filter( 'jetpack_just_in_time_msgs', '__return_false', 99 );
		break;
}


/**
 * Enqueue CSS and JS for A11y Slider when shortcode is present
 */
function ll_enq_a11y_slider_assets() {
	global $post;
	if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'a11yslider' ) ) {
		// wp_enqueue_style( 'a11y-slider-base' );
		wp_enqueue_script( 'a11y-slider' );
	}
}
add_action( 'wp_enqueue_scripts', 'll_enq_a11y_slider_assets' );

/**
 * Enqueue the block editor script.
 */
function ll_enqueue_block_editor_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'loadlifter-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			LL_VERSION,
			true
		);
		wp_add_inline_script( 'loadlifter-editor', "tailwindTypographyClasses = '" . esc_attr( LL_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'll_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function ll_tinymce_add_class( $settings ) {
	$settings['body_class'] = LL_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'll_tinymce_add_class' );


/**
 * ACF Pro settings
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/cpt-people.php';
require get_template_directory() . '/inc/cpt-job-openings.php';
require get_template_directory() . '/inc/cpt-testimonials.php';

/**
 * Register block categories, patterns, and styles
 */
remove_theme_support( 'core-block-patterns' );
require get_template_directory() . '/inc/block-categories.php';
require get_template_directory() . '/inc/block-styles.php';
require get_template_directory() . '/inc/blocks.php';

/**
 * Register shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Custom menu walkers
 */
require get_template_directory() . '/inc/menu-walker.php';

/**
 * Gravity Forms customization
 */
require get_template_directory() . '/inc/gravity-forms-tweaks.php';

/**
 * Include ACF field content in search results
 */
require get_template_directory() . '/inc/search-mods.php';
