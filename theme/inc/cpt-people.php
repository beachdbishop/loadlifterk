<?php

// Register Custom Post Type > People
function ll_register_people_cpt() {

	$labels = array(
		'name'                  => _x( 'Team', 'Post Type General Name', 'loadlifter' ),
		'singular_name'         => _x( 'Person', 'Post Type Singular Name', 'loadlifter' ),
		'menu_name'             => __( 'People', 'loadlifter' ),
		'name_admin_bar'        => __( 'People', 'loadlifter' ),
		'archives'              => __( 'Archives', 'loadlifter' ),
		'attributes'            => __( 'Person Attributes', 'loadlifter' ),
		'parent_item_colon'     => __( 'Parent Item:', 'loadlifter' ),
		'all_items'             => __( 'All People', 'loadlifter' ),
		'add_new_item'          => __( 'Add New Person', 'loadlifter' ),
		'add_new'               => __( 'Add New', 'loadlifter' ),
		'new_item'              => __( 'New Person', 'loadlifter' ),
		'edit_item'             => __( 'Edit Person', 'loadlifter' ),
		'update_item'           => __( 'Update Person', 'loadlifter' ),
		'view_item'             => __( 'View Person', 'loadlifter' ),
		'view_items'            => __( 'View People', 'loadlifter' ),
		'search_items'          => __( 'Search Person', 'loadlifter' ),
		'not_found'             => __( 'Not found', 'loadlifter' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'loadlifter' ),
		'featured_image'        => __( 'Featured Image', 'loadlifter' ),
		'set_featured_image'    => __( 'Set featured image', 'loadlifter' ),
		'remove_featured_image' => __( 'Remove featured image', 'loadlifter' ),
		'use_featured_image'    => __( 'Use as featured image', 'loadlifter' ),
		'insert_into_item'      => __( 'Insert into person', 'loadlifter' ),
		'uploaded_to_this_item' => __( 'Uploaded to this person', 'loadlifter' ),
		'items_list'            => __( 'People list', 'loadlifter' ),
		'items_list_navigation' => __( 'People list navigation', 'loadlifter' ),
		'filter_items_list'     => __( 'Filter people list', 'loadlifter' ),
	);
	$rewrite = array(
		'slug'                  => 'team',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Person', 'loadlifter' ),
		'description'           => __( 'Key People', 'loadlifter' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'revisions', 'thumbnail' ),
		'taxonomies'            => array( 'location', 'department', 'level' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-businesswoman',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'				=> $rewrite,
		// 'query_var' 			=> true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'people', $args );

}
add_action( 'init', 'll_register_people_cpt', 0 );


function ll_filter_people_columns( $columns ) {
	// $columns = [
	// 	'cb' => $columns['cb'],
	// 	'title' => __( 'Title' ),
	// 	'lastname' => __( 'Last Name' ),
	// 	'level' => __( 'Level', 'loadlifter' ),
	// 	'dept' => __( 'Department', 'loadlifter' ),
	// 	'location' => __( 'Location', 'loadlifter' ),
	// 	'll_id' => __( 'ID' ),
	// 	'date' => __( 'Date' ),
	// ];
	$columns = [
		'cb' => $columns['cb'],
		'title' => __( 'Title' ),
		'lastname' => __( 'Last Name' ),
		'level' => __( 'Level', 'loadlifter' ),
		'll_id' => __( 'ID' ),
		'date' => __( 'Date' ),
	];
	return $columns;
}
add_filter( 'manage_people_posts_columns', 'll_filter_people_columns' );


function ll_people_columns( $column, $post_id ) {
	// Last Name column
	if ( 'lastname' === $column ) {
		$lastname_val = get_field( 'll_people_last_name');
		echo $lastname_val;
	}

	// Level column
	if ( 'level' === $column ) {
		$level_obj = get_field_object( 'll_people_level');
		$level_val = $level_obj['value'];
		$level_display = $level_val['label'];
		echo $level_display;
	}

	// Department column
	// if ( ( 'dept' === $column ) && ( get_field_object( 'll_people_department') ) ) {
	// 	$dept_obj = get_field_object( 'll_people_department');
	// 	$dept_val = $dept_obj['value'];
	// 	if ( $dept_val ) {
	// 		echo '<span class="inline-comma-sep">';
	// 		foreach( $dept_val as $dept ) {
	// 			echo '<span>' . $dept['label'] . '</span>';
	// 		}
	// 		echo '</span>';
	// 	}
	// }

	// Location column
	// if ( ( 'location' === $column ) && ( get_field_object( 'll_people_location' ) ) ){
	// 	$location_obj = get_field_object( 'll_people_location');
	// 	$location_val = $location_obj['value'];
	// 	if ( $location_val ) {
	// 		$location_display = $location_val['label'];
	// 		echo $location_display;
	// 	}
	// }
}
add_action( 'manage_people_posts_custom_column', 'll_people_columns', 10, 2 );


function ll_people_sortable_columns( $columns ) {
	$columns['lastname'] = 'lastname';
	$columns['level'] = 'level';
	// $columns['dept'] = 'dept';
	// $columns['location'] = 'location';
	return $columns;
}
add_filter( 'manage_edit-people_sortable_columns', 'll_people_sortable_columns' );

// WP-Admin list sort
function ll_people_orderby( $query ) {

	// $args = [
	//     'post_type' 				=> 'people',
	//     'meta_query'				=> [
	//         'relation' => 'AND',
	//         'level_clause' => [
	//             'key'		=> 'll_people_level',
	//             'value'		=> '400',
	//             'compare'	=> '<=',
	//         ],
	//         'lastname_clause' => [
	//             'key'       => 'll_people_last_name',
	//             'compare'   => 'EXISTS',
	//         ],
	//     ],
	//     'meta_key'					=> 'll_people_level',
	//     'post_status' 				=> 'publish',
	//     'posts_per_page'			=> -1,
	//     'posts_per_archive_page'	=> -1,
	//     'order' 					=> 'ASC',
	//     'orderby' 					=> [
	//         'level_clause' => 'ASC',
	//         'lastname_clause' => 'ASC',
	//     ],
	//     'wp_grid_builder'			=> 'wpgb-content-1',
	// ];


	// Nothing to do
	if( !$query->is_main_query() || 'people' != $query->get( 'post_type' ) )
		return;

	// Do
	if ( '' === $query->get( 'orderby' ) ) {
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'ASC' );
		$query->set( 'meta_key', 'll_people_last_name' );
	}

		if ( 'lastname' === $query->get( 'orderby' ) ) {
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'll_people_last_name' );
	}

	if ( 'level' === $query->get( 'orderby' ) ) {
		$query->set( 'orderby', 'meta_value title' );
		$query->set( 'meta_key', 'll_people_level' );
	}

	// if( 'dept' === $query->get( 'orderby' ) ) {
	// 	$query->set( 'orderby', 'meta_value title' );
	// 	$query->set( 'meta_key', 'll_people_department' );
	// }

	// if( 'location' === $query->get( 'orderby' ) ) {
	// 	$query->set( 'orderby', 'meta_value title' );
	// 	$query->set( 'meta_key', 'll_people_location' );
	// }
}
is_admin() && add_action( 'pre_get_posts', 'll_people_orderby' );


function ll_cpt_people_admin_styles(){

	// Global Admin Variable, It tells which page is on now.
	global $pagenow;

	// Global Admin Variable, It tells which post type is on now.
	global $post_type;

	if( ( $pagenow == 'edit.php' ) && ( $post_type ==  'people' ) ) {
		wp_enqueue_style( 'admin-people', get_template_directory_uri().'/admin-people.css' );
	}

}
add_action( 'admin_enqueue_scripts', 'll_cpt_people_admin_styles' );


// Register Custom Taxonomy
// function ll_locations() {
// 	$labels = array(
// 		'name'                       => _x( 'Locations', 'Taxonomy General Name', 'loadlifter' ),
// 		'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'loadlifter' ),
// 		'menu_name'                  => __( 'Locations', 'loadlifter' ),
// 		'all_items'                  => __( 'All Items', 'loadlifter' ),
// 		'parent_item'                => __( 'Parent Item', 'loadlifter' ),
// 		'parent_item_colon'          => __( 'Parent Item:', 'loadlifter' ),
// 		'new_item_name'              => __( 'New Item Name', 'loadlifter' ),
// 		'add_new_item'               => __( 'Add New Item', 'loadlifter' ),
// 		'edit_item'                  => __( 'Edit Item', 'loadlifter' ),
// 		'update_item'                => __( 'Update Item', 'loadlifter' ),
// 		'view_item'                  => __( 'View Item', 'loadlifter' ),
// 		'separate_items_with_commas' => __( 'Separate items with commas', 'loadlifter' ),
// 		'add_or_remove_items'        => __( 'Add or remove items', 'loadlifter' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used', 'loadlifter' ),
// 		'popular_items'              => __( 'Popular Items', 'loadlifter' ),
// 		'search_items'               => __( 'Search Items', 'loadlifter' ),
// 		'not_found'                  => __( 'Not Found', 'loadlifter' ),
// 		'no_terms'                   => __( 'No items', 'loadlifter' ),
// 		'items_list'                 => __( 'Items list', 'loadlifter' ),
// 		'items_list_navigation'      => __( 'Items list navigation', 'loadlifter' ),
// 	);
// 	$args = array(
// 		'labels'                     => $labels,
// 		'hierarchical'               => true,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
// 		'show_in_nav_menus'          => true,
// 		'show_tagcloud'              => false,
// 		'show_in_rest'               => true,
// 	);
// 	register_taxonomy( 'location', array( 'people' ), $args );
// }

// function ll_departments() {

// 	$labels = array(
// 		'name'                       => _x( 'Departments', 'Taxonomy General Name', 'loadlifter' ),
// 		'singular_name'              => _x( 'Department', 'Taxonomy Singular Name', 'loadlifter' ),
// 		'menu_name'                  => __( 'Depts', 'loadlifter' ),
// 		'all_items'                  => __( 'All Departments', 'loadlifter' ),
// 		'parent_item'                => __( 'Parent Dept', 'loadlifter' ),
// 		'parent_item_colon'          => __( 'Parent Dept:', 'loadlifter' ),
// 		'new_item_name'              => __( 'New Dept Name', 'loadlifter' ),
// 		'add_new_item'               => __( 'Add New Dept', 'loadlifter' ),
// 		'edit_item'                  => __( 'Edit Dept', 'loadlifter' ),
// 		'update_item'                => __( 'Update Dept', 'loadlifter' ),
// 		'view_item'                  => __( 'View Dept', 'loadlifter' ),
// 		'separate_items_with_commas' => __( 'Separate depts with commas', 'loadlifter' ),
// 		'add_or_remove_items'        => __( 'Add or remove depts', 'loadlifter' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used', 'loadlifter' ),
// 		'popular_items'              => __( 'Popular Departments', 'loadlifter' ),
// 		'search_items'               => __( 'Search Departments', 'loadlifter' ),
// 		'not_found'                  => __( 'Not Found', 'loadlifter' ),
// 		'no_terms'                   => __( 'No depts', 'loadlifter' ),
// 		'items_list'                 => __( 'Departments list', 'loadlifter' ),
// 		'items_list_navigation'      => __( 'Departments list navigation', 'loadlifter' ),
// 	);
// 	$args = array(
// 		'labels'                     => $labels,
// 		'hierarchical'               => true,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
// 		'show_in_nav_menus'          => true,
// 		'show_tagcloud'              => false,
// 		'show_in_rest'               => true,
// 	);
// 	register_taxonomy( 'department', array( 'people' ), $args );
// }

// Register Custom Taxonomy
// function ll_levels() {

// 	$labels = array(
// 		'name'                       => _x( 'Levels', 'Taxonomy General Name', 'loadlifter' ),
// 		'singular_name'              => _x( 'Level', 'Taxonomy Singular Name', 'loadlifter' ),
// 		'menu_name'                  => __( 'Levels', 'loadlifter' ),
// 		'all_items'                  => __( 'All Levels', 'loadlifter' ),
// 		'parent_item'                => __( 'Parent Level', 'loadlifter' ),
// 		'parent_item_colon'          => __( 'Parent Level:', 'loadlifter' ),
// 		'new_item_name'              => __( 'New Level Name', 'loadlifter' ),
// 		'add_new_item'               => __( 'Add New Level', 'loadlifter' ),
// 		'edit_item'                  => __( 'Edit Level', 'loadlifter' ),
// 		'update_item'                => __( 'Update Level', 'loadlifter' ),
// 		'view_item'                  => __( 'View Level', 'loadlifter' ),
// 		'separate_items_with_commas' => __( 'Separate levels with commas', 'loadlifter' ),
// 		'add_or_remove_items'        => __( 'Add or remove levels', 'loadlifter' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used', 'loadlifter' ),
// 		'popular_items'              => __( 'Popular Levels', 'loadlifter' ),
// 		'search_items'               => __( 'Search Levels', 'loadlifter' ),
// 		'not_found'                  => __( 'Not Found', 'loadlifter' ),
// 		'no_terms'                   => __( 'No levels', 'loadlifter' ),
// 		'items_list'                 => __( 'Levels list', 'loadlifter' ),
// 		'items_list_navigation'      => __( 'Levels list navigation', 'loadlifter' ),
// 	);
// 	$args = array(
// 		'labels'                     => $labels,
// 		'hierarchical'               => true,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
// 		'show_in_nav_menus'          => false,
// 		'show_tagcloud'              => false,
// 		'rewrite'                    => false,
// 		'show_in_rest'               => true,
// 	);
// 	register_taxonomy( 'level', array( 'people' ), $args );

// }


// add_action( 'init', 'll_locations', 0 );
// add_action( 'init', 'll_departments', 0 );
// add_action( 'init', 'll_levels', 0 );

// if( !function_exists( 'll_unregister_taxonomy' ) ) {
// 	function ll_unregister_taxonomy(){
//     	unregister_taxonomy( 'location' );
//     	unregister_taxonomy( 'department' );
//     	unregister_taxonomy( 'level' );
// 	}
// }
// add_action('init','ll_unregister_taxonomy');
