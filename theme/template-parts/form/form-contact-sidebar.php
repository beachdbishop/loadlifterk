<?php
// intended partial to be used in sidebar of pages / posts
// $hs_form_id = 'c8675641-3e68-4ff7-9dc3-ae3636fbf1c8';
// echo ( wp_get_environment_type() == 'local' ) ? '<p class="italic">partial: ' . __FILE__ . '</p>' : '';
?>
<h2 class="mb-4 print:hidden">Contact us</h2>

<div class="max-w-prose">
	<?php
	// do_shortcode( '[gravityform id="1" title="true"]' );
	gravity_form( 1, false, false );
	?>
</div>

<noscript>
	<p class="my-4">Let us know what you need.</p>
	<div class="wp-block-buttons is-content-justification-left is-layout-flex wp-block-buttons-is-layout-flex print:hidden">
		<div class="wp-block-button is-style-outline"><a href="mailto:info@kuadrasupport.com?subject=Inquiry%20from:%20<?php echo esc_attr( get_the_title() ); ?>" class="wp-block-button__link has-atlantis-500-color has-text-color wp-element-button "><i class="fa-solid fa-envelope"></i> Email us</a></div>
	</div>
</noscript>
