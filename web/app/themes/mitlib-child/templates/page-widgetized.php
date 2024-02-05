<?php
/**
 * Template Name: DEPRECATED Widgetized Page
 *
 * This page template is "widgetized" in that it loads both of the defined
 * sidebars in the Child theme:
 * - "sidebar" is shown to the right of page content, and is referred to as the
 *   "Main Sidebar" within the WP admin interface.
 * - "sidebar-two" (loaded within the content-widgetized.php partial) is shown
 *   below the page content, and is referred to as the "Below Content Widget
 *   Area" within the WP admin interface.
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

$content_classes = 'content';
if ( is_active_sidebar( 'sidebar' ) ) {
	$content_classes .= ' has-sidebar';
}
?>

<?php get_header(); ?>

<?php
if ( is_front_page() ) {
	get_template_part( 'inc/breadcrumbs', 'sitename' );
} else {
	get_template_part( 'inc/breadcrumbs', 'child' );
}
?>

<div id="stage" class="inner" role="main">

	<?php get_template_part( 'inc/title-banner' ); ?>

	<div id="content" class="<?php echo esc_attr( $content_classes ); ?>">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'inc/content', 'widgetized' );
		endwhile; // End of the loop.
		?>

		<?php if ( is_active_sidebar( 'sidebar' ) ) { ?>
			<?php get_sidebar(); ?>
		<?php } ?>

	</div><!-- end div#content -->

</div><!-- end div#stage -->

<?php get_footer(); ?>
