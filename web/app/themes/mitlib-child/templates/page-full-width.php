<?php
/**
 * Template Name: DEPRECATED Full Width
 *
 * This page template is "full width" because it does not load the Main Sidebar
 * (which allows pages to avoid having widgets alongside content, which makes
 * setting some visibility rules a little easier).
 *
 * Please note that, because this template loads the widgetized content partial,
 * pages with this template will still show content in the Below Content Widget
 * Area.
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

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

	<div id="content" class="content">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'inc/content', 'widgetized' );
		endwhile; // End of the loop.
		?>

	</div><!-- end div#content -->

</div><!-- end div#stage -->

<?php get_footer(); ?>
