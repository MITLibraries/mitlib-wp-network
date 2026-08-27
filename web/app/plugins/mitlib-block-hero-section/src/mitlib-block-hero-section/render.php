<?php
/**
 * Server-side rendering for the hero section block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */
?><section id="hero" role="img" aria-label="Two notebooks opened to show yellow graph paper; the top one has a black and white photo of a boat crew, and the bottom one shows handwritten text." style="background-image: url(https://libraries.mit.edu/app/uploads/2026/07/hero-image-edgerton.png);">
	<div class="overlay">
		<div class="content-wrapper">
			<div class="hero-content">
				<h1><?php echo wp_kses_post( $attributes['heading'] ); ?></h1>

				<?php
				// Search widget area for homepage. Uses Unified Search v2 for this page's search form.
				if ( is_active_sidebar( 'sidebar-search' ) ) :
					dynamic_sidebar( 'sidebar-search' );
				endif;
				?>

			</div>
			<span class="hero-image-credit">from the <a href="https://archivesspace.mit.edu/repositories/2/resources/603">Harold E. Edgerton papers</a></span>
		</div>
	</div>
</section>