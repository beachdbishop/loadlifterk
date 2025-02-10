<?php
/**
 * Title: Full-width CTA
 * Slug: loadlifter/full-width-cta
 * Categories: fullwidthsections
 * Description: Nested Group blocks to provide a full-width CTA w/ a background color + centered container.
 * Keywords: section, group, cta
 * Block Types: core/heading, core/group
 *
 * @package loadlifter
 * @since 0.1.1
 */
?>
<!-- wp:group {"metadata":{"name":"Page CTA"},"style":{"elements":{"link":{"color":{"text":"var:preset|color|atlantis-900"}}}},"backgroundColor":"atlantis-400","textColor":"atlantis-900","className":"full-bleed ll-equal-vert-padding not-prose break-inside-avoid","layout":{"type":"default"}} -->
<div class="wp-block-group full-bleed ll-equal-vert-padding not-prose break-inside-avoid has-atlantis-900-color has-atlantis-400-background-color has-text-color has-background has-link-color"><!-- wp:group {"className":"px-2  |  lg:px-[16px]","layout":{"type":"default"}} -->
<div class="wp-block-group px-2  | lg:px-[16px]"><!-- wp:columns {"verticalAlignment":null,"className":"mb-0"} -->
<div class="wp-block-columns mb-0"><!-- wp:column {"width":"82%"} -->
<div class="wp-block-column" style="flex-basis:82%"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Expand your talent pool!', 'loadlifter' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'If you are interested in learning how Kuadra Support\'s staffing and employee leasing solutions can help you gain a competitive advantage, let\'s talk.', 'loadlifter' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"18%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:18%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#contact"><?php esc_html_e( 'Contact Us', 'loadlifter' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
