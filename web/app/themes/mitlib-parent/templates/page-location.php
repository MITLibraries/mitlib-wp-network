<?php
/**
 * Template Name: Location Template
 *
 * This is the template that displays location records, which have a number
 * of custom fields defined by the ACF plugin. This template was designed
 * prior to 2021, and is a legacy layout.
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

get_header();
?>
		<!-- Version 1.9 -->
		<?php get_template_part( 'inc/breadcrumbs' ); ?>

		<?php
			$objs = get_field( 'page_location' );

			$args = array(
				'p' => $objs->ID,
				'post_type' => 'any',
			);

			$locPosts = new \WP_Query( $args );

			?>
		
		<div id="stage" class="inner" role="main">

		<?php
		while ( $locPosts->have_posts() ) :
			$locPosts->the_post();
			?>

				<?php get_template_part( 'inc/content', 'location' ); ?>

				<?php get_sidebar(); ?>
		
		<?php endwhile; // end of the loop. ?>
		
		</div>

<?php get_footer(); ?>
