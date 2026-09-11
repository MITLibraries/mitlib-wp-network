<?php
/**
 * Server-side rendering for the hero section block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */
?>	<section id="hero">
		<div class="hero-bg" role="img" aria-label="Graphic illustration of a spiral in purple, black, and white." style="background-image: url(https://libraries.mit.edu/app/uploads/2026/09/hero-image-noise-reduction.jpg);"></div>
		<div class="overlay">	
			<div class="content-wrapper">
				<div class="hero-content">
					<h1>Welcome to the MIT Libraries</h1>

					<?php
						// Search widget area for homepage. Uses Unified Search v2 for this page's search form.
						if ( is_active_sidebar( 'sidebar-search' ) ) :
							dynamic_sidebar( 'sidebar-search' );					
						endif; 
					?>
					
				</div>
				<span class="hero-image-credit">from the <a href="https://archivesspace.mit.edu/repositories/2/resources/244">Muriel Cooper personal archives</a></span>
			</div>
		</div>
	</section>