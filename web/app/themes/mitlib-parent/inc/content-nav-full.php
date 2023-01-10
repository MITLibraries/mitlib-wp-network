<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

global $isRoot;
?>
<div class="row">
	<div id="leftContent" class="span3">
		<div class="pagenav">
		<ul>
		<?php
			// $pageParent = getParent($post->ID);
			$pageRoot = getRoot( $post );
			$section = get_post( $pageRoot );

			$args = array(
				'child_of' => $pageRoot,
				'title_li' => '',
			);

			$menuName = $section->post_name;

			$menu = wp_get_nav_menu_items( $menuName );

			if ( $menu ) {
				wp_nav_menu(
					array(
						'menu' => $menuName,
						'menu_class' => 'nav-menu',
					)
				);
			} else {
				wp_list_pages( $args );
			}
			?>
		</ul>
		</div>
	</div>
	<div id="mainContent" class="span9">
	
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
			<?php if ( ! $isRoot ) : ?>
			<h2><?php the_title(); ?></h2>
			<?php endif; ?>
			
			<?php the_content(); ?>
			
		</div>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		
	</div>
</div>
