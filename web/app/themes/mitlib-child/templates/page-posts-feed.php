<?php
/**
 * Template Name: Posts Feed Page
 *
 * This is very similar to the Standard Child template, except that it loads
 * the content-feed rather than content-page partial.
 *
 * Content-feed implements a custom query and content loop that will show a list
 * of Post records, which is useful when a site wants a page to highlight recent
 * news articles.
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

			get_template_part( 'inc/content', 'feed' );
		endwhile; // End of the loop.
		?>

		<?php if ( is_active_sidebar( 'sidebar' ) ) { ?>
			<?php get_sidebar(); ?>
		<?php } ?>

	</div><!-- end div#content -->

</div><!-- end div#stage -->

<?php get_footer(); ?>
