<?php
/**
 * Template Name: Content with Sidebar
 *
 * This template is used to display
 * page content with sidebar
 *
 * @package MITlib_News
 * @since 0.1.0
 */

namespace Mitlib\News;

get_header(); ?>

<?php get_template_part( 'inc/subheader-exception' ); ?>

<div id="primary" class="content-area">
<main id="main" role="main">
<div class="row">
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<div id="content" class="content has-sidebar">

				<div class="main-content">
					
					<div class="entry-content">
						
						<div class="entry-page-title">
							
							<h1><?php the_title(); ?></h1>
						
						</div>
						
						<?php the_content(); ?>
					
					</div>
				
				</div>

				<?php get_sidebar(); ?>

			</div>

		<?php endwhile; // End of the loop. ?>

	</div><!-- end .row -->

</main><!-- end #main -->
</div><!-- end #primary -->
<?php get_footer(); ?>
