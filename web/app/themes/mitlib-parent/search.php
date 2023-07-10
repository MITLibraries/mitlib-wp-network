<?php
/**
 * The template for displaying Search Results pages.
 *
 * We generally don't rely on this template for _most_ of our site search.
 * However, the template remains to handle built in search functionality in
 * WordPress.
 *
 * Example link that uses this template: `/?s=keyword`
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

get_header();

$sidebar_class = '';
if ( is_active_sidebar( 'sidebar-1' ) ) {
	$sidebar_class = 'has-sidebar';
}
?>

<div id="stage" class="inner" role="main">
	<div id="content" class="content <?php echo esc_attr( $sidebar_class ); ?>">

		<div class="content-main main-content">
			<?php get_template_part( 'inc/site-search' ); ?>
		</div>

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
