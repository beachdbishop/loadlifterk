<?php
/**
 * CPT Job Openings - Kuadra
 *
 * This module relies on ACF PRO and integrates with Display Posts Shortcode.
 *
 * @package Load_Lifter
 */


// BACKEND  BACKEND  BACKEND  BACKEND  BACKEND  BACKEND  BACKEND  BACKEND  BACKEND

if ( ! function_exists( 'll_make_kuadra_job_opening' ) ) {
	// Register Custom Post Type
	function ll_make_kuadra_job_opening() {

		$labels = array(
			'name'                  => _x( 'Job Openings', 'Post Type General Name', 'loadlifter' ),
			'singular_name'         => _x( 'Job Opening', 'Post Type Singular Name', 'loadlifter' ),
			'menu_name'             => __( 'Job Openings', 'loadlifter' ),
			'name_admin_bar'        => __( 'Job Opening', 'loadlifter' ),
			'archives'              => __( 'Opening Archives', 'loadlifter' ),
			'parent_item_colon'     => __( 'Parent Opening:', 'loadlifter' ),
			'all_items'             => __( 'All Openings', 'loadlifter' ),
			'add_new_item'          => __( 'Add New Opening', 'loadlifter' ),
			'add_new'               => __( 'Add New', 'loadlifter' ),
			'new_item'              => __( 'New Opening', 'loadlifter' ),
			'edit_item'             => __( 'Edit Opening', 'loadlifter' ),
			'update_item'           => __( 'Update Opening', 'loadlifter' ),
			'view_item'             => __( 'View Item', 'loadlifter' ),
			'search_items'          => __( 'Search Item', 'loadlifter' ),
			'not_found'             => __( 'Not found', 'loadlifter' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'loadlifter' ),
			'featured_image'        => __( 'Featured Image', 'loadlifter' ),
			'set_featured_image'    => __( 'Set featured image', 'loadlifter' ),
			'remove_featured_image' => __( 'Remove featured image', 'loadlifter' ),
			'use_featured_image'    => __( 'Use as featured image', 'loadlifter' ),
			'insert_into_item'      => __( 'Insert into opening', 'loadlifter' ),
			'uploaded_to_this_item' => __( 'Uploaded to this opening', 'loadlifter' ),
			'items_list'            => __( 'Openings list', 'loadlifter' ),
			'items_list_navigation' => __( 'Openings list navigation', 'loadlifter' ),
			'filter_items_list'     => __( 'Filter openings list', 'loadlifter' ),
		);
		$rewrite = array(
			'slug'                  => 'careers',
			'with_front'            => true,
			'pages'                 => false,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Job Opening', 'loadlifter' ),
			'description'           => __( 'BFCO Job Opening', 'loadlifter' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'revisions' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 20,
			'menu_icon'             => 'dashicons-businesswoman',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'show_in_rest'			=> true,
			'template'				=> array(
				array( 'core/heading', array(
					'level' 			=> 3,
					'content'			=> 'Company Description'
				) ),
				array( 'core/paragraph' ),
				array( 'core/heading', array(
					'level' 			=> 3,
					'content'			=> 'Job Description'
				) ),
				array( 'core/list' ),
				array( 'core/heading', array(
					'level' 			=> 3,
					'content'			=> 'Main Responsibilities'
				) ),
				array( 'core/list' ),
				array( 'core/heading', array(
					'level' 			=> 3,
					'content'			=> 'Required Qualifications'
				) ),
				array( 'core/list' ),
				array( 'core/heading', array(
					'level' 			=> 3,
					'content'			=> 'Required Skills'
				) ),
				array( 'core/list' ),
				array( 'core/heading', array(
					'level' 			=> 3,
					'content'			=> 'Compensation'
				) ),
				array( 'core/list' ),
			),
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'post',
		);
		register_post_type( 'job_opening', $args );
	}
}
add_action( 'init', 'll_make_kuadra_job_opening', 0 );


// Set active ADMIN COLUMNS for Job Openings
function ll_edit_job_opening_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Opening' ),
		'opening_status' => __( 'Status' ),
		'apply_link' => __( 'Apply Link' ),
		'time_status' => __( 'Time/Status' ),
		'location' => __( 'Location(s)' ),
		'date' => __( 'Date' )
	);

	return $columns;
}
add_filter( 'manage_edit-job_opening_columns', 'll_edit_job_opening_columns' );


// Set default sort order for Job Openings in backend
// add_filter('pre_get_posts', 'll_set_cpt_default_order' );
// function ll_set_cpt_default_order( $wp_query ) {
// 	global $pagenow;
// 	if ( is_admin() && 'edit.php' == $pagenow && !isset( $_GET['orderby'] ) ) {

// 		$wp_query->set( 'meta_key', 'opening_status' ); // name of your post meta key
// 		$wp_query->set( 'orderby',  'meta_value'); // meta_value since it is a string

// 	}
// }
// For some reason, the above function breaks the list of Reusable Blocks... TODO: Figure out why


// Enable sorting on specific columns for Job Openings
function ll_job_opening_sortable_columns( $columns ) {

	$columns['opening_status'] = 'opening_status';
	// $columns['location'] = 'location';
	$columns['time_status'] = 'time_status';

	return $columns;

}
add_filter( 'manage_edit-job_opening_sortable_columns', 'll_job_opening_sortable_columns' );


/* Only run our customization on the 'edit.php' page in the admin. */
function ll_edit_job_opening_load() {
	add_filter( 'request', 'll_sort_job_openings' );
}
add_action( 'load-edit.php', 'll_edit_job_opening_load' );

function ll_sort_job_openings( $vars ) {
	/* Check if we're viewing the 'job_opening' post type. */
	if ( isset( $vars['post_type'] ) && 'job_opening' == $vars['post_type'] ) {

		/* Check if 'orderby' is set to 'opening_status'. */
		if ( isset( $vars['orderby'] ) && 'opening_status' == $vars['orderby'] ) {

			/* Merge the query vars with our custom variables. */
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'opening_status',
					'orderby' => 'meta_value_num'
				)
			);
		}

		/* Check if 'orderby' is set to 'time_status'. */
		if ( isset( $vars['orderby'] ) && 'time_status' == $vars['orderby'] ) {

			/* Merge the query vars with our custom variables. */
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'time_status',
					'orderby' => 'meta_value'
				)
			);
		}

		/* Check if 'orderby' is set to 'location'. */
		if ( isset( $vars['orderby'] ) && 'location' == $vars['orderby'] ) {

			/* Merge the query vars with our custom variables. */
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'location',
					'orderby' => 'meta_value'
				)
			);
		}

	}

	return $vars;
}


// Set data to display in admin columns
function ll_pop_job_opening_column( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'status' column... */
		case 'opening_status' :
			/* Get the post meta. */
			$status = get_post_meta( $post_id, 'opening_status', true );

			if ( $status === '1' )
				echo '<span style="color: #15803d"><span class="dashicons dashicons-visibility"></span> ' . __( 'Open', 'loadlifter' ) . '</span>';

			if ( $status === '0' )
				echo '<span style="color: #737373"><span class="dashicons dashicons-hidden"></span><em> ' . __( 'Closed', 'loadlifter' ) . '</em></span>';

			break;

		case 'apply_link' :
			$link = get_post_meta( $post_id, 'apply_link', true );
			$truncatedlink = substr( $link, -18 );

			if ( empty( $link ) )
				echo '<em>' . __( 'Not set', 'loadlifter' ) . '</em>';

			if ( !empty( $link ) )
				echo '<a href="' . $link . '" target="_blank"><span class="dashicons dashicons-external"></span> &hellip;' . $truncatedlink . '</a>';

			break;

		case 'location' :
			$locations = get_post_meta( $post_id, 'location', true );

			if ( empty( $locations ) )
				echo '<em>' . __( 'Not set', 'loadlifter' ) . '</em>';

			if ( !empty( $locations ) )
				echo '<span style="text-transform: capitalize">' . implode( ', ', $locations ) . '</span>';

			break;

		case 'time_status' :
			$time_status = get_post_meta( $post_id, 'time_status', true );

			if ( empty( $time_status ) )
				echo '<em>' . __( 'Unknown', 'loadlifter' ) . '</em>';

			if ( $time_status === 'fulltime' )
				echo '<span>Full-Time</span>';

			if ( $time_status === 'parttime' )
				echo '<span>Part-Time</span>';

			break;

			/* Just break out of the switch statement for everything else. */
		default :
			break;

	}
}
add_action( 'manage_job_opening_posts_custom_column', 'll_pop_job_opening_column', 10, 2 );



// FRONTEND  FRONTEND  FRONTEND  FRONTEND  FRONTEND  FRONTEND  FRONTEND  FRONTEND

/* Register Custom Post Type Template */
// if( !function_exists( 'll_job_opening_kuadra_templates' ) ):
// 	function ll_job_opening_kuadra_templates( $template ) {
// 		$post_types = [ 'job_opening' ];

// 		if ( is_singular( $post_types ) && file_exists( plugin_dir_path( __FILE__ ) . 'template-parts/single_job_opening.php' ) ) {
// 			$template = plugin_dir_path( __FILE__ ) . 'template-parts/single_job_opening.php';
// 		}

// 		if ( is_post_type_archive( $post_types ) && file_exists( plugin_dir_path( __FILE__ ) . 'template-parts/archive_job_opening.php' ) ) {
// 			$template = plugin_dir_path( __FILE__ ) . 'template-parts/archive_job_opening.php';
// 		}

// 		return $template;
// 	}
// endif;
// add_filter( 'template_include', 'll_job_opening_kuadra_templates', 99 );


/* Customize the output of the Display Posts Shortcode to include the Location meta_value */
/* via: https://displayposts.com/2019/06/23/display-meta-value-in-output/ */
function ll_dps_include_locations( $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class, $author, $category_display_text ) {
	if( empty( $original_atts['include_location'] ) || false === filter_var( $original_atts['include_location'], FILTER_VALIDATE_BOOLEAN ) )
		return $output;

	$key = 'location';

	$locations = get_post_meta( get_the_ID(), $key, true );
	if( empty( $locations ) )
		return $output;

	$locations = implode( ', ', $locations );

	// Add span around it for styling
	$locations = '<span class="job-opening-location | text-neutral-600 font-bold text-sm ml-2 uppercase dark:text-neutral-400">' . $locations . '</span>';

	// Insert it into the output wherever you'd like it
	$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $image . $title . $locations . $date . $author . $category_display_text . $excerpt . $content . '</' . $inner_wrapper . '>';
	return $output;
}
add_filter( 'display_posts_shortcode_output', 'll_dps_include_locations', 10, 11 );


/* Customize the output of the Display Posts Shortcode to include the dept meta_value */
/* via: https://displayposts.com/2019/06/23/display-meta-value-in-output/ */
function ll_dps_include_depts( $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class, $author, $category_display_text ) {
	if( empty( $original_atts['include_dept'] ) || false === filter_var( $original_atts['include_dept'], FILTER_VALIDATE_BOOLEAN ) )
		return $output;

	$key = 'opening_dept';

	$depts = get_post_meta( get_the_ID(), $key, true );
	if( empty( $depts ) )
		return $output;

	$depts = implode( ', ', $depts );

	// Add span around it for styling
	$depts = '<span class="job-opening-dept | text-aqua-800 font-bold text-sm ml-2 uppercase dark:text-aqua-200">' . $depts . '</span>';

	// Insert it into the output wherever you'd like it
	$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $image . $title . $depts . $date . $author . $category_display_text . $excerpt . $content . '</' . $inner_wrapper . '>';
	return $output;
}
add_filter( 'display_posts_shortcode_output', 'll_dps_include_depts', 10, 11 );
