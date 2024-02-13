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
<!-- wp:html -->
<section class="full-bleed ll-equal-vert-padding not-prose bg-atlantis-500 break-inside-avoid print:animate-none print:bg-transparent">
	<div class="px-2 lg:px-[16px]">
		<div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center md:justify-between lg:gap-8">
			<div class="prose lg:prose-xl text-atlantis-950">
				<h2 class="mb-2">Let's get started</h2>
				<p class="max-w-main">Interested in learning more about our bookkeeping and accounting solutions? Complete the form on this page and a team member will reach out to you shortly.</p>
				<p class="hidden print:mt-8 print:block">Email info@kuadrasupport.com</p>
			</div>
			<div class="w-full md:max-w-fit print:hidden">
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#contact">Contact Us</a></div>
			</div>
		</div>
	</div>
</section>
<!-- /wp:html -->
