<?php
/**
 * Template Name: Standard Child
 *
 * This page template is an override of the Standard Template which is inherited
 * from the Parent theme. It is the preferred page template for displaying a
 * Page record, unless a specialized feature is needed like:
 * - Displaying sticky Posts above the content (such as a site-level alert)
 * - Showing a paginated set of Posts below the content (such as a Recent News-
 *   type page for a site)
 *
 * This template supports both widget areas defined by the site, the `sidebar`
 * that usually shows up in a right column, and `sidebar-two` which is loaded
 * by inc/content-page below the page content block.
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

			get_template_part( 'inc/content', 'page' );
		endwhile; // End of the loop.
		?>

		<?php if ( is_active_sidebar( 'sidebar' ) ) { ?>
			<?php get_sidebar(); ?>
		<?php } ?>

	</div><!-- end div#content -->

</div><!-- end div#stage -->

<?php get_footer(); ?>
