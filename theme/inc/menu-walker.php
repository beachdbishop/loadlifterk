<?php

class LL_Menu_Walker extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth = 0, $args = \null, $id = 0) {
		$output .= "<li class='" . implode( " ", $item->classes ) . "'>";

		if( $item->url && $item->url != '#' ) {
			$output .= '<a href="' . $item->url . '">';
		} else {
			$output .= '<span>';
		}

		$output .= $item->title;

		// if( !empty( $item->classes ) &&
		// 	is_array( $item->classes ) &&
		// 	in_array( 'menu-item-has-children', $item->classes ) ) {
		// 		// this gal has children
		// 		$output .= ' <i class="fa-regular fa-angle-down"></i>';
		// }

		if( $item->url && $item->url != '#' ) {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}

		// if ( $args->walker->has_children) {
		// 	$output .= '<i class="fa-regular fa-angle-down"></i>';
		// }
	}

}
