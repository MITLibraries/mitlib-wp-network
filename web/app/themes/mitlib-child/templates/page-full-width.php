<?php
/**
 * Template Name: Full Width
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

get_header( 'child' );

get_template_part( 'inc/breadcrumbs', 'child' ); ?>

		<div id="stage" class="inner" role="main">
			
			<?php get_template_part( 'inc/title-banner' ); ?>
			
			<div id="content" class="content">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
	
					<?php get_template_part( 'inc/content', 'widgetized' ); ?>
	
				<?php endwhile; // End of the loop. ?>
	
			</div><!-- #primary -->
		
		</div>

<?php get_footer(); ?>
