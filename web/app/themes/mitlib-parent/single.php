<?php
/**
 *
 * This is the template that displays single posts
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

get_header(); ?>

<?php get_template_part( 'inc/breadcrumbs', 'child' ); ?>
	
<div id="stage" class="inner" role="main">

		<div id="content" class="content has-sidebar">

				<div class="content-main main-content">			
					
					<?php
					while ( have_posts() ) :
						the_post();
						?>
					
						<div class="article-head">

						<h2><?php the_title(); ?></h2>
						
						</div>
						
						<div class="entry-content">
							<?php the_content(); ?>
						</div>					
								
					
									
					<?php endwhile; // end of the loop. ?>
				</div>
				
				<?php get_sidebar(); ?>					
		</div>
		
</div><!-- end div#stage -->

<?php get_footer(); ?>
