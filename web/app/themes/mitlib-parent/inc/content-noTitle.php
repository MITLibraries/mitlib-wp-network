<?php
/**
 * The template used for displaying page content in page-SelfTitle.php
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

global $isRoot;
?>

<div id="mainContent" class="mainContent">

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="featuredImage">
			<?php
			// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- This is intended to output markup, need to understand how to escape it properly.
			echo the_post_thumbnail( 700, 300 );
			// phpcs:enable
			?>
		
		</div>
	
	<?php endif; ?>
	
	
	<div class="entry-content">

		<?php the_content(); ?>
		
	</div>

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	
</div>

<?php get_sidebar(); ?>
