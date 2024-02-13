<?php

function ll_register_block_pattern_categories() {
	if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {

		register_block_pattern_category(
			'fullwidthsections',
			[
				'label' => esc_html__( 'Full-width Sections', 'loadlifter' ),
			]
		);

		register_block_pattern_category(
			'text',
			[
				'label' => esc_html__( 'Text', 'loadlifter' ),
			]
		);

	}
}
add_action( 'init', 'll_register_block_pattern_categories' );
