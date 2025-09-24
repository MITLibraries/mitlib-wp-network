<?php
/**
 * The template used for displaying page content in page-front.php
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

?>
<div class="main-content content-main">
	
	<div class="entry-content">
		
<?php
// Get array of sticky posts.
$sticky = get_option( 'sticky_posts' );

// If no sticky posts, skip this whole section.
if ( count( $sticky ) > 0 ) {

	// Build WP query.
	$args = array(
		'posts_per_page' => 5,
		'post__in' => $sticky,
		'ignore_sticky_posts' => 1,
	);

	// Execute query.
	$the_query = new \WP_Query( $args );

	if ( $the_query->have_posts() ) {

		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			?>

		<aside aria-label="Featured content" class="mitlib-spotlight">
			<?php if ( get_first_post_image() ) : ?>
				<img src="<?php echo esc_attr( get_first_post_image() ); ?>">
			<?php endif; ?>
			<div>				
				<h3><?php the_title(); ?></h3>
				<?php custom_excerpt( 20, '...' ); ?>
				<a class="btn btn-secondary" aria-label="Read more about <?php the_title(); ?>" href="<?php echo esc_url( the_permalink() ); ?>">Read more</a>			
			</div>			
		</aside>

			<?php
		endwhile;

		wp_reset_postdata();

	} // End "have posts".
} // End "if no sticky posts".

the_content();

if ( is_active_sidebar( 'sidebar-two' ) ) :
	dynamic_sidebar( 'sidebar-two' );
endif;
?>
	
	</div><!-- end div.entry-content -->
		
</div><!-- end div.main-content -->
