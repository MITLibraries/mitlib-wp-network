<?php
/**
 * Server-side rendering for the hero section block.
 *
 * @package MITlib Blocks
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

?><section id="hero">
	<div class="hero-bg" role="img" aria-label="Illustration of a woman from the early 1900s holding onto a strap on a subway car." style="background-image: url(https://libraries.mit.edu/app/uploads/2026/09/hero-image-subway-glide1.jpg);"></div>
	<div class="overlay">	
		<div class="content-wrapper">
			<div class="hero-content">
				<h1><?php echo esc_html( $attributes['heading'] ); ?></h1>

				<?php
					// Search widget area for homepage. Uses Unified Search v2 for this page's search form.
					if ( is_active_sidebar( 'sidebar-search' ) ) :
						dynamic_sidebar( 'sidebar-search' );					
					endif; 
				?>
				
			</div>
			<span class="hero-image-credit">from the <a href="https://dome.mit.edu/handle/1721.3/188939">Inventions of Note Sheet Music Collection</a></span>
		</div>
	</div>
</section>