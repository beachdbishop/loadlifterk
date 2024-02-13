<?php
/**
 * Block styles, yo
 */

add_action( 'init', function() {

	register_block_style( 'core/paragraph', [
		'name'				=> 'note-info',
		'label'				=> __( 'Info Note', 'loadlifter' ),
	] );

	register_block_style( 'core/paragraph', [
		'name'				=> 'note-success',
		'label'				=> __( 'Success Note', 'loadlifter' ),
	] );

	register_block_style( 'core/paragraph', [
		'name'				=> 'note-warning',
		'label'				=> __( 'Warning Note', 'loadlifter' ),
	] );

	register_block_style( 'core/paragraph', [
		'name'				=> 'note-error',
		'label'				=> __( 'Error Note', 'loadlifter' ),
	] );

	// register_block_style( 'core/button', [
	// 	'name' 				=> 'papercorners',
	// 	'label' 			=> __( 'Papercorners', 'loadlifter' ),
	// 	'is_default'	=> false,
	// ] );

	register_block_style( 'core/group', [
		'name'				=> 'green',
		'label'				=> __( 'Green Accordion group', 'loadlifter' ),
		'is_default'	=> false,
	] );

	register_block_style( 'core/group', [
		'name'				=> 'aqua',
		'label'				=> __( 'Aqua Accordion group', 'loadlifter' ),
		'is_default'	=> false,
	] );

	register_block_style( 'core/separator', [
		'name'				=> 'sep-aqua',
		'label'				=> __( 'Double Line Aqua', 'loadlifter' ),
	] );

	register_block_style( 'core/separator', [
		'name'				=> 'sep-green',
		'label'				=> __( 'Double Line Green', 'loadlifter' ),
	] );

	register_block_style( 'core/separator', [
		'name'				=> 'sep-gray',
		'label'				=> __( 'Double Line Gray', 'loadlifter' ),
	] );

	register_block_style( 'core/list', [
		'name'  			=> 'list-none',
		'label' 			=> __( 'No bullets', 'loadlifter' ),
	] );

	register_block_style( 'core/list', [
		'name'				=> 'list-square',
		'label'				=> __( 'Square bullets', 'loadlifter' ),
	] );

	register_block_style( 'core/list', [
		'name'				=> 'list-columns-2',
		'label'				=> __( '2 Columns', 'loadlifter' ),
	] );

	register_block_style( 'core/list', [
		'name' 				=> 'list-divide-light',
		'label' 			=> __( 'Light Border Between Items' ),
	] );

	register_block_style( 'core/list', [
		'name' 				=> 'list-divide-gray',
		'label' 			=> __( 'Gray Border Between Items' ),
	] );

	register_block_style( 'core/list', [
		'name' 				=> 'list-divide-green',
		'label' 			=> __( 'Green Border Between Items' ),
	] );

	register_block_style( 'core/list', [
		'name' 				=> 'list-divide-aqua',
		'label' 			=> __( 'Aqua Border Between Items' ),
	] );

	register_block_style( 'core/list', [
		'name'				=> 'circle',
		'label'				=> __( 'Circle', 'loadlifter' ),
	] );

	register_block_style( 'core/list', [
		'name'				=> 'circle-green',
		'label'				=> __( 'Circle Green', 'loadlifter' ),
	] );

	register_block_style( 'core/list', [
		'name'				=> 'circle-aqua',
		'label'				=> __( 'Circle Aqua', 'loadlifter' ),
	] );

	register_block_style( 'core/list', [
		'name'				=> 'boxed',
		'label'				=> __( 'Boxed', 'loadlifter' ),
	] );

	register_block_style( 'core/spacer', [
		'name'				=> 'xs',
		'label'				=> __( 'XS', 'loadlifter' ),
	] );

	register_block_style( 'core/spacer', [
		'name'				=> 'sm',
		'label'				=> __( 'S', 'loadlifter' ),
	] );

	register_block_style( 'core/spacer', [
		'name'				=> 'md',
		'label'				=> __( 'M', 'loadlifter' ),
	] );

	register_block_style( 'core/spacer', [
		'name'				=> 'lg',
		'label'				=> __( 'L', 'loadlifter' ),
	] );

	register_block_style( 'core/spacer', [
		'name'				=> 'xl',
		'label'				=> __( 'XL', 'loadlifter' ),
	] );

});
