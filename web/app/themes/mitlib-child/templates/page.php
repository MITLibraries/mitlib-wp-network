<?php
/**
 * Template Name: Standard Child
 *
 * This page template is an override of the Standard Template which is inherited
 * from the Parent theme.
 *
 * Please note that while this template does load the Main Sidebar defined by
 * the Child theme, it does _not_ load the "Below Content Widget Area" sidebar.
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
