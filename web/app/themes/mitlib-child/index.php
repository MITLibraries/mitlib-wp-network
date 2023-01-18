<?php
/**
 *
 * This is the template that displays the news page
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

get_header( 'child' ); ?>

<?php get_template_part( 'inc/breadcrumbs', 'sitename' ); ?>
		
<div id="stage" class="inner" role="main">

	<?php get_template_part( 'inc/title-banner' ); ?>

	<div id="content" class="content has-sidebar">
		<div class="content-main main-content">

				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<?php get_template_part( 'inc/post', 'trimmed' ); ?>
			
				<?php endwhile; // End of the loop. ?>

				<?php \Mitlib\Parent\content_nav( 'nav-below' ); ?>
			</div>
				
				<?php get_sidebar(); ?>				
		</div>
</div>

<?php get_footer(); ?>
