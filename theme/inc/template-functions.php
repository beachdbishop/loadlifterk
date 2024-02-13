<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Load_Lifter
 */


function r( $var ) {
	echo '<pre>';
	print_r( $var );
	echo '</pre>';
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ll_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'll_pingback_header' );


/**
 * Filter the except length to 16 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function ll_custom_excerpt_length( $length ) {
	return 16;
}
add_filter( 'excerpt_length', 'll_custom_excerpt_length', 999 );


/**
 * Test to see if current page is a specific page or child of that specific page.
 * @author Chris Coyier
 * @link
 */
function ll_is_tree( $pid ) { // $pid = The ID of the page we're looking for pages underneath
	global $post; // load details about this page
	if ( is_page() && ( $post->post_parent==$pid || is_page( $pid ) ) )
		return true; // we're at the page or at a sub page
	else
		return false; // we're elsewhere
}


/**
 * Exclude archived events from Posts loop
 */
function ll_exclude_categories( $wp_query ) {
	if ( wp_get_environment_type() == 'production' ) {
		$catid = '1732';
	}

	if ( wp_get_environment_type() == 'staging' ) {
		$catid = '1732';
	}

	if ( wp_get_environment_type() == 'local' ) {
		$catid = '257';
	}

	if( is_home() || is_feed() || ( is_archive() && !is_category() ) ) {
		set_query_var( 'cat', '-' . $catid );
	}
}
// add_action( 'pre_get_posts', 'll_exclude_categories' );


/**
 * Display post id column in posts list
 */
function ll_add_id_column( $columns ) {
	$columns['ll_id'] = 'ID';
	return $columns;
}

function ll_id_column_content( $column, $id ) {
	if ( 'll_id' == $column ) {
		echo '<code>'.$id.'</code>';
	}
}

add_filter( 'manage_posts_columns', 'll_add_id_column', 5 );
add_filter( 'manage_pages_columns', 'll_add_id_column', 5 );
add_action( 'manage_posts_custom_column', 'll_id_column_content', 5, 2 );
add_action( 'manage_pages_custom_column', 'll_id_column_content', 5, 2 );


/**
 * Show Content Source in Post List Table
 */
function ll_add_post_source_column( $columns ) {
	unset( $columns['tags'] );
	unset( $columns['comments'] );

	$columns['ll_source'] = 'Source';

	return $columns;
}
add_filter( 'manage_posts_columns', 'll_add_post_source_column' );

function ll_posts_columns_custom_order( $columns ) {
	$custom_col_order = [
		'cb' => $columns['cb'],
		'title' => $columns['title'],
		'll_id' => $columns['ll_id'],
		'll_source' => $columns['ll_source'],
		'categories' => $columns['categories'],
		'date' => $columns['date'],
	];

	return $custom_col_order;
}
add_filter( 'manage_post_posts_columns', 'll_posts_columns_custom_order', 10 );

function ll_show_post_source( $column, $post_id ) {

	// Source column
	if ( 'll_source' === $column ) {
		$source = get_post_meta( $post_id, 'll_content_source', true );

		if ( $source != true )
			echo '<span style="background-color: #ececec; color: #333; border-radius: 4px; padding: 2px 8px;"><em>Unknown</em></span>';

		if ( $source === 'original' )
			echo '<span style="background-color: #ce182d; color: #fff1f2; border-radius: 8px 0 8px 0; padding: 2px 8px; font-weight: bold">Original Content</span>';

		if ( $source === 'checkpoint' )
			echo '<span style="color: #047cba; border: 1px solid #047cba; border-radius: 4px; padding: 2px 8px; font-weight: bold">TopLine (Checkpoint)</span>';

		if ( $source === 'other' )
			echo '<span style="background-color: #f3e8ff; color: #7e22ce; border-radius: 4px; padding: 2px 8px; font-weight: bold">Other</span>';
	}
}
add_action( 'manage_posts_custom_column', 'll_show_post_source', 10, 2 );






/**
 * Custom body classes
 */
function ll_body_class( $classes ) {
	global $post;

	if ( wp_get_environment_type() == 'production' ) {
		$classes[] = 'env-prod';
	}

	if ( wp_get_environment_type() == 'staging' ) {
		$classes[] = 'env-staging';
	}

	if ( wp_get_environment_type() == 'local' ) {
		$classes[] = 'env-dev';
	}

	return $classes;
}
add_filter( 'body_class', 'll_body_class' );


/**
 * Social Links
 * Uses Social URLs specified in Site Meta
 *
 * based on: https://www.billerickson.net/code/displaying-social-links-from-yoast-seo/
 */
add_shortcode( 'social_links', 'll_show_social_links' );


/**
 * Template Parts with Display Posts Shortcode
 * @author Bill Erickson
 * @see https://www.billerickson.net/template-parts-with-display-posts-shortcode
 *
 * @param string $output, current output of post
 * @param array $original_atts, original attributes passed to shortcode
 * @return string $output
 */
function ll_dps_template_part( $output, $original_atts ) {

	// Return early if our "layout" attribute is not specified
	if( empty( $original_atts['layout'] ) )
		return $output;
	ob_start();
	get_template_part( 'template-parts/dps/dps', $original_atts['layout'] );
	$new_output = ob_get_clean();
	if( !empty( $new_output ) )
		$output = $new_output;
	return $output;
}
add_action( 'display_posts_shortcode_output', 'll_dps_template_part', 10, 2 );

/**
 * Display Posts, span wrapper open
 * @see https://displayposts.com/2019/01/23/display-inline-link-with-most-recent-post/
 */
function ll_dps_span_wrapper_open( $wrapper, $atts ) {
	if( !empty( $atts['wrapper'] ) && 'span' == $atts['wrapper'] )
		$wrapper = '<span class="dps-inline">';
	return $wrapper;
}
add_filter( 'display_posts_shortcode_wrapper_open', 'll_dps_span_wrapper_open', 10, 2 );

/**
 * Display Posts, pan wrapper close
 * @see https://displayposts.com/2019/01/23/display-inline-link-with-most-recent-post/
 */
function ll_dps_span_wrapper_close( $wrapper, $atts ) {
	if( !empty( $atts['wrapper'] ) && 'span' == $atts['wrapper'] )
		$wrapper = '</span>';
	return $wrapper;
}
add_filter( 'display_posts_shortcode_wrapper_close', 'll_dps_span_wrapper_close', 10, 2 );

/**
 * Display Posts, span in output
 * @see https://displayposts.com/2019/01/23/display-inline-link-with-most-recent-post/
 */
function ll_dps_span_output( $output, $atts ) {
	if( !empty( $atts['wrapper'] ) && 'span' == $atts['wrapper'] ) {
		$output = str_replace( array( '<div', '<li' ), '<span', $output );
		$output = str_replace( array( '</div>', '</li>' ), '</span>', $output );
	}
	return $output;
}
add_filter( 'display_posts_shortcode_output', 'll_dps_span_output', 10, 2 );

/**
 * Exclude displayed posts from Display Posts
 * @see https://displayposts.com/2019/01/03/exclude-posts-already-displayed/
 */
function ll_dps_exclude_displayed_posts( $args ) {
	global $dps_excluded_posts;
	$args['post__not_in'] = !empty( $args['post__not_in'] ) ? array_merge( $args['post__not_in'], $dps_excluded_posts ) : $dps_excluded_posts;
	return $args;
}
// add_filter( 'display_posts_shortcode_args', 'll_dps_exclude_displayed_posts' );

/**
 * Add DPS posts to exclusion list
 * @see https://displayposts.com/2019/01/03/exclude-posts-already-displayed/
 */
function ll_dps_add_posts_to_exclusion_list( $output ) {
	global $dps_excluded_posts;
	$dps_excluded_posts[] = get_the_ID();
	return $output;
}
// add_filter( 'display_posts_shortcode_output', 'll_dps_add_posts_to_exclusion_list' );

/**
 * DPS People query w/ Dept filter
 */
function ll_dps_filter_people_query( $args, $atts ) {
	// Only run on People queries
	if( empty( $atts['deptlist'] ) )
		return $args;

	$args['orderby'] 	= 'meta_value_num title';
	$args['meta_key'] 	= 'll_people_level';
	$args['order'] 		= 'ASC';

	$meta_query = array(
		array(
			'key' => 'll_people_department',
			'value' => $atts['deptlist'],
			'compare' => 'LIKE',
		)
	);

	$args['meta_query'] = $meta_query;
	return $args;
}
add_filter( 'display_posts_shortcode_args', 'll_dps_filter_people_query', 10, 2 );


/**
 * Customizations to Display Posts
 *
 * @author     Bill Erickson <bill@billerickson.net>
 * @copyright  Copyright (c) 2018, Bill Erickson
 * @license    GPL-2.0+
 *
 * Adapted for loadlifter
 * To use w/ date queries to generate a table of URLs when culling old content.
 */

class LL_DPS_Customizations {

	public function __construct() {

		// Layout = editors-choice
		add_filter( 'display_posts_shortcode_wrapper_open', array( $this, 'layout_editors_choice_open' ), 10, 2 );
		add_filter( 'display_posts_shortcode_output', array( $this, 'layout_editors_choice_item' ), 10, 2 );
		add_filter( 'display_posts_shortcode_wrapper_close', array( $this, 'layout_editors_choice_close' ), 10, 2 );

	}

	/**
	 * Layout = editors choice, open
	 * @author Bill Erickson
	 */
	function layout_editors_choice_open( $output, $atts ) {
		if( empty( $atts['layout'] ) || 'table-urls' !== $atts['layout'] )
			return $output;

		$classes = array( 'display-posts-listing', 'min-w-full', 'divide-y-2', 'divide-neutral-200', 'bg-white', 'text-sm' );
		if( !empty( $atts['wrapper_class'] ) )
			$classes[] = $atts['wrapper_class'];

		$output = '<table class="' . join( ' ', $classes ) . '">';
		$output .= '<thead><tr role="row" class="text-left row-1">';
			$output .= '<th class="px-4 py-2 whitespace-nowrap text-neutral-900">Title</th>';
			$output .= '<th class="px-4 py-2 whitespace-nowrap text-neutral-900">URL</th>';
			$output .= '<th class="px-4 py-2 whitespace-nowrap text-neutral-900">Date</th>';
			$output .= '</tr></thead>';
		$output .= '<tbody class="divide-y divide-neutral-200">';
		return $output;
	}
	/**
	 * Layout = editors chocie, single item
	 * @author Bill Erickson
	 */
	function layout_editors_choice_item( $output, $atts ) {
		if( empty( $atts['layout'] ) || 'table-urls' !== $atts['layout'] )
			return $output;

			$output = '<tr class="odd:bg-neutral-50">';
			$output .= '<td class="px-4 py-2 text-neutral-800">' . get_the_title() . '</td>';
			$output .= '<td class="px-4 py-2 font-mono text-neutral-700">' . get_permalink() . '</td>';
			$output .= '<td class="px-4 py-2 text-neutral-800">' . get_the_date('c') . '</td>';
			$output .= '</tr>';

		return $output;
	}

	/**
	 * Layout = editors choice, close
	 * @author Bill Erickson
	 */
	function layout_editors_choice_close( $output, $atts ) {
		if( empty( $atts['layout'] ) || 'table-urls' !== $atts['layout'] )
			return $output;

		$output = '</tbody></table>';
		return $output;
	}

}
new LL_DPS_Customizations();


/**
 * Display Reusable Blocks in Menu
 */
function ll_show_reusable_blocks_menu() {
	add_menu_page(
		__( 'Reusable Blocks', 'loadlifter' ),
		'Reusable Blocks',
		'manage_options',
		'edit.php?post_type=wp_block',
		'',
		'dashicons-insert',
		31
	);
}
// add_action( 'admin_menu', 'll_show_reusable_blocks_menu' );
// ^^^ Temporarily turning this off

/**
 * Prevent Widows for headlines and such
 *
 * @via https://davidwalsh.name/word-wrap-mootools-php
 */
function ll_no_widows( $text, $minWords = 3) {
	$return = $text;
	$arr = explode(' ', $text);
	if(count($arr) >= $minWords) {
		$arr[count($arr) - 2].= '&nbsp;'.$arr[count($arr) - 1];
		array_pop($arr);
		$return = implode(' ',$arr);
	}
	return $return;
}


function ll_is_plural( $target ) {
	if ( count( $target ) > 1) {
		return true;
	}
}


/**
 * Wrap last word with span
 * @author: Elron
 * https://stackoverflow.com/questions/18612872/get-the-last-word-of-a-string
 */
function ll_wrap_last_word( $string ) {
	// Breaks string to pieces
	$pieces = explode(" ", $string);
	// Modifies the last word
	$pieces[count($pieces)-1] = '<span class="font-bold">' . $pieces[count($pieces)-1] . '</span>';
	// Returns the glued pieces
	return implode(" ", $pieces);
}


function ll_format_phone_number( $number, $output = null ) {
	$number = preg_replace( "/[^0-9]/", "", $number );

	switch( $output ) {
		case 'us':
			return preg_replace( "/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1 ($2) $3-$4", $number );
			break;
		case 'beach':
			return preg_replace( "/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$2.$3.$4", $number );
			break;
		default:
			return $number;
			break;
	}
}
