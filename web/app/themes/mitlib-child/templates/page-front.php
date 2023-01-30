<?php
/**
 * Template Name: Front Page
 *
 * This is the same as the Standard Child template, except that it loads the
 * content-front partial rather than content-page.
 *
 * This difference means that the Front Page template will load a feed of recent
 * Posts above the page content.
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

<?php get_header( 'child' ); ?>

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

			get_template_part( 'inc/content', 'front' );
		endwhile; // End of the loop.
		?>

		<?php if ( is_active_sidebar( 'sidebar' ) ) { ?>
			<?php get_sidebar(); ?>
		<?php } ?>

	</div><!-- end div#content -->

</div><!-- end div#stage -->

<?php get_footer(); ?>
