<?php
/**
 * Template Name: Standard Template
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

get_header();
?>

<div id="content">
	<?php the_title(); ?>

	<?php the_content(); ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php get_sidebar(); ?>
	<?php endif; ?>

</div>

<?php get_footer(); ?>
