<?php
/**
 * This is the template that displays all locations.
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

get_header(); ?>

		<div id="breadcrumb" class="inner" role="navigation" aria-label="breadcrumbs">
			<a href="#">Libraries Home</a>
			&raquo; <?php the_title(); ?>
		</div>

		<?php
		while ( have_posts() ) :
			the_post();
			?>
		
			<?php get_template_part( 'content', 'location' ); ?>
		
		<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
