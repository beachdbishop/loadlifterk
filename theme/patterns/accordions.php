<?php
/**
 * Title: Accordions
 * Slug: loadlifter/accordions
 * Categories: text
 * Description: Multiple Details blocks in a Group w/ appropriate CSS classes set.
 * Keywords: details, summary, accordion
 * Block Types: core/group, core/details, core/list
 *
 * @package loadlifter
 * @since 0.1.0
 */
?>
<!-- wp:group {"className":"accordions is-style-aqua","layout":{"type":"default"}} -->
<div class="wp-block-group accordions is-style-aqua"><!-- wp:details {"summary":"Services we offer"} -->
<details class="wp-block-details"><summary>Services we offer</summary><!-- wp:group {"className":"details-inner","layout":{"type":"default"}} -->
<div class="wp-block-group details-inner"><!-- wp:list -->
<ul><!-- wp:list-item -->
<li>This</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>That</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>The other service</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"Another one"} -->
<details class="wp-block-details"><summary>Another one</summary><!-- wp:group {"className":"details-inner","layout":{"type":"default"}} -->
<div class="wp-block-group details-inner"><!-- wp:list -->
<ul><!-- wp:list-item -->
<li>This</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>That</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>The other service</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></details>
<!-- /wp:details --></div>
<!-- /wp:group -->
