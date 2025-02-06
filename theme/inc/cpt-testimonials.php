<?php
/**
 * CPT Testimonials
 *
 * This module relies on ACF PRO
 *
 * @package Load_Lifter
 */

$post_type_key = 'testimonial';

// BACKEND  BACKEND  BACKEND  BACKEND  BACKEND  BACKEND  BACKEND  BACKEND  BACKEND


// NOTE!!! This CPT is currently generated/built w/ ACF PRO.

// Set active ADMIN COLUMNS for Testimonials
function ll_edit_testimonials_columns( $columns ) {

	$columns = array(
		'cb' 							=> '<input type="checkbox" />',
		'title' 					=> __( 'Title' ),
		'll_id' 					=> __( 'ID' ),
		'll_testim_type' 	=> __( 'Type' ),
		'date' 						=> __( 'Date' )
	);

	return $columns;
}
add_filter( 'manage_edit-' . $post_type_key . '_columns', 'll_edit_testimonials_columns' );


// Enable sorting on specific columns for Testimonials
function ll_testimonials_sortable_columns( $columns ) {
	$columns['ll_testim_type'] = 'll_testim_type';

	return $columns;
}
add_filter( 'manage_edit-' . $post_type_key . '_sortable_columns', 'll_testimonials_sortable_columns' );


// Only run our customization on the 'edit.php' page in the admin.
function ll_edit_testimonials_load() {
	add_filter( 'request', 'll_sort_testimonials' );
}
add_action( 'load-edit.php', 'll_edit_testimonials_load' );

function ll_sort_testimonials( $vars ) {
	if ( isset( $vars['post_type'] ) && 'testimonial' == $vars['post_type'] ) {
		if ( isset( $vars['orderby'] ) && 'll_testim_type' == $vars['orderby'] ) {
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'll_testim_type',
					'orderby' => 'meta_value'
				)
			);
		}
	}

	return $vars;
}


// Set data to display in admin columns
function ll_pop_testimonials_column( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'll_testim_type' :
			$ttype = get_post_meta( $post_id, 'll_testim_type', true );
			if ( empty( $ttype ) )
				echo '<em>' . __( 'Not set?!', 'loadlifter' ) . '</em>';
			if ( $ttype === 'client' )
				echo '<span style="color: #b2d235; text-transform: capitalize">' . $ttype . '</span>'; // atlantis-500
			if ( $ttype === 'staff' )
				echo '<span style="color: #45c2cc; text-transform: capitalize">' . $ttype . '</span>'; // aqua-500

			break;

			/* Just break out of the switch statement for everything else. */
		default :
			break;

	}
}
add_action( 'manage_' . $post_type_key . '_posts_custom_column', 'll_pop_testimonials_column', 10, 2 );


// FRONTEND  FRONTEND  FRONTEND  FRONTEND  FRONTEND  FRONTEND  FRONTEND  FRONTEND
