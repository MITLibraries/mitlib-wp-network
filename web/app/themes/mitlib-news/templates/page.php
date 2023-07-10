<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package MITlib_News
 * @since 0.1.0
 */

namespace Mitlib\News;

$pageRoot = getRoot( $post );
$section = get_post( $pageRoot );
$isRoot = $section->ID == $post->ID;

get_header(); ?>
	<?php get_template_part( 'inc/sub-headerSingle' ); ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<div class="container">
		<div class="row">
		<div id="stage" class="inner column3 tertiaryPage  subscribe clearfix" role="main">
			

		
<div class="col-xs-12 col-xs-B-12 col-sm-9 col-md-9 col-lg-9">
	
			<div class="">
				<div class="col-1 content-page">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="featuredImage">
			<?php
			// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- This would either need wp_kses, or a different native WP function.
			echo the_post_thumbnail( 700, 300 );
			// phpcs:enable -- Start scanning again.
			?>
		
		</div>	
		<?php endif; ?>
		
		
		<div class="entry-content">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
			
		</div>
		
</div>
			</div>
			</div>
	
	
	<div class="col-xs-12 col-xs-B-11 col-sm-3 col-md-3 col-lg-3">
		<?php if ( ! dynamic_sidebar() ) : ?>
	
		<div id="sidebarContent" class="sidebar span3">
		<div class="sidebarWidgets">
					<?php // This was a call to dynamic_sidebar() for 'subscribe'. ?>
		</div>
	</div>		

		<?php endif; ?>	


</div>

		</div>
		</div>
		</div>
		<?php endwhile; // end of the loop. ?>
<div class="container">
<?php get_footer(); ?>
