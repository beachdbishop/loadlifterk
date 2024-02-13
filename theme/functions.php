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
	define( 'LL_VERSION', '0.1.1' );
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
		'prose prose-neutral prose-headings:font-light prose-h4:font-light max-w-none prose-blockquote:font-serif lg:prose-xl dark:prose-invert'
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
			"backoffice" => [
				"label" => 'Back-Office Support Solutions',
				"url" => '/services/back-office-support-solutions/',
				"icon" => 'fa-id-badge',
				"desc" => 'Our seasoned professionals provide assistance with a variety of back-office functions, including payroll, financial reporting, accounting, and human resources. ',
			],
			"book" => [
				"label" => 'Bookkeeping',
				"url" => '/services/bookkeeping/',
				"icon" => 'fa-laptop-file',
				"desc" => 'Rely on our professionals to manage the bookkeeping function for your company. We can assist with data entry, payroll, account reconciliation, and producing monthly reports and financial statements. ',
			],
			"lease" => [
				"label" => 'Employee Leasing',
				"url" => '/services/employee-leasing/',
				"icon" => 'fa-person-walking-arrow-right',
				"desc" => 'Rely on our professionals to manage the bookkeeping function for your company. We can assist with data entry, payroll, account reconciliation, and producing monthly reports and financial statements.',
			],
			"staffing" => [
				"label" => 'Staffing',
				"url" => '/services/staffing/',
				"icon" => 'fa-people-roof',
				"desc" => 'Finding the right people for your organization with refined skills can be a challenging process. Forego the expense and time commitment involved in the process and turn to us for assistance with staffing. Get the right people in the right seat faster with Kuadra Support.',
			],
		]
	);
}

if ( ! defined( 'LL_FAKE_TESTOMONIALS' ) ) {
	define(
		'LL_FAKE_TESTOMONIALS',
		[
			"test00" => [
				"service" => "book",
				"name" => "Jane Doe",
				"company" => "Widget Makers United",
				"text" => "A quote about how great our bookkeeping services would go here. They were super helpful!"
			],
			"test01" => [
				"service" => "staffing",
				"name" => "Rick Springfield",
				"company" => "Jessie's Girl Flowers",
				"text" => "It would be great if another quote could go here so we have more than one. Very professional!"
			],
			"test02" => [
				"service" => "book",
				"name" => "Lisa Simpson",
				"company" => "Another Co.",
				"text" => "It would be great if another quote could go here so we have more than one. Very professional!"
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

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
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
				'll_submenu_services' => __( 'Services submenu', 'loadlifter' ),
				'll_submenu_about' => __( 'About submenu', 'loadlifter' ),
				'll_submenu_careers' => __( 'Careers submenu', 'loadlifter' ),
				'll_menu_footer' => __( 'Footer menu', 'loadlifter' ),
			)
		);

		// Add theme support for selective refresh for widgets.
		// add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'disable-custom-font-sizes' );


		add_filter( 'feed_links_show_comments_feed', '__return_false' );

		// Remove support for block templates.
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
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
// function ll_widgets_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => __( 'Footer', 'loadlifter' ),
// 			'id'            => 'sidebar-1',
// 			'description'   => __( 'Add widgets here to appear in your footer.', 'loadlifter' ),
// 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
// 			'after_widget'  => '</section>',
// 			'before_title'  => '<h2 class="widget-title">',
// 			'after_title'   => '</h2>',
// 		)
// 	);
// }
// add_action( 'widgets_init', 'll_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ll_scripts() {
	wp_enqueue_style( 'loadlifter-style', get_stylesheet_uri(), array(), LL_VERSION );
	if ( get_field( 'll_postpage_css' ) ) {
		$inline_css = get_field( 'll_postpage_css' );
		wp_add_inline_style( 'loadlifter-style', $inline_css );
	}

	wp_enqueue_script( 'loadlifter-script', get_template_directory_uri() . '/js/script.min.js', array(), LL_VERSION, true );

	// wp_enqueue_script( 'hubspot-forms', 'https://js.hsforms.net/forms/v2.js', [], LL_VERSION, false );
	wp_enqueue_script( 'fa-kit', 'https://kit.fontawesome.com/a2c7d80c94.js' );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'll_scripts' );

function ll_preload_assets() {
	// echo '<link rel="preload" as="image" href="/wp-content/themes/loadlifter/img/phx-desert-color-no-crop-small.jpg" media="(max-width: 767px)" />
	// <link rel="preload" as="image" href="/wp-content/themes/loadlifter/img/phx-desert-color-no-crop.jpg" media="(min-width: 768px)" />';
	// echo '<link rel="preload" as="script" href="https://js.hsforms.net/forms/v2.js?ver=' . wp_get_theme()->get('Version') . '" />';
}

/**
 * Enqueue the block editor script.
 */
function ll_enqueue_block_editor_script() {
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
}
add_action( 'enqueue_block_editor_assets', 'll_enqueue_block_editor_script' );

/**
 * Enqueue the script necessary to support Tailwind Typography in the block
 * editor, using an inline script to create a JavaScript array containing the
 * Tailwind Typography classes from LL_TYPOGRAPHY_CLASSES.
 */
function ll_enqueue_typography_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'loadlifter-typography',
			get_template_directory_uri() . '/js/tailwind-typography-classes.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			LL_VERSION,
			true
		);
		wp_add_inline_script( 'loadlifter-typography', "tailwindTypographyClasses = '" . esc_attr( LL_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'll_enqueue_typography_script' );

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


function ll_disable_wp_links_menu() {
	remove_menu_page( 'link-manager.php' );
}

function ll_disable_wp57_menu_hover() {
	echo '<style>#adminmenu a:focus, #adminmenu a:hover, .folded #adminmenu .wp-submenu-head:hover { box-shadow: none !important; }</style>';
}

function ll_enable_monospace_acf_textarea() {
	echo '<style>.acf-input textarea { font-family: "Fira Code", monospace; background-color: #171717; color: #a3e635; line-height: 1.2; }</style>';
}


switch( wp_get_environment_type() ) {
	case 'local':
		add_action( 'admin_head', 'll_disable_wp57_menu_hover' );
		add_action( 'admin_head', 'll_enable_monospace_acf_textarea' );
		break;

	case 'staging':
		add_action( 'admin_head', 'll_disable_wp57_menu_hover' );
		add_action( 'admin_head', 'll_enable_monospace_acf_textarea' );
		break;

	default:
		add_action( 'admin_menu', 'll_disable_wp_links_menu' );
		add_action( 'admin_head', 'll_disable_wp57_menu_hover' );
		add_action( 'admin_head', 'll_enable_monospace_acf_textarea' );
		/* Hide Jetpack upsell ads */
		add_filter( 'jetpack_just_in_time_msgs', '__return_false', 99 );
		break;
}


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

/**
 * Register block categories, patterns, and styles
 */
remove_theme_support( 'core-block-patterns' );
require get_template_directory() . '/inc/block-categories.php';
require get_template_directory() . '/inc/block-styles.php';

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
