<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

get_header();
$date = \DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );

/**
 * Trim a post excerpt at a provided length.
 *
 * @param int $charlength The length of desired excerpt.
 */
function the_excerpt_max_charlength( $charlength ) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- the excerpt in these posts could have a lot of markup, so there isn't a great way to escape it without a lot more work.
			echo mb_substr( $subex, 0, $excut );
			// phpcs:enable -- Start scanning again.
		} else {
			return $subex;
		}
		echo '[...]';
	} else {
		return $excerpt;
	}
}


?>
<?php get_template_part( 'inc/sub-header' ); ?>

<section id="primary" class="site-content">
	<div id="content" role="main">
	<?php if ( have_posts() ) : ?>
	<header class="archive-header">
	  <h2>
		<?php
		if ( is_day() ) :
			printf( esc_html__( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
		elseif ( is_month() ) :
			printf( esc_html__( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
		elseif ( is_year() ) :
			printf( esc_html__( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
		else :
			esc_html_e( 'Archives', 'twentytwelve' );
		endif;
		?>
	  </h2>
	</header>
	<!-- .archive-header -->
	<div class="mit-container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
	  <div class="flex-item blueTop eventsBox <?php echo esc_attr( check_image() ); ?>"
		onClick='location.href="<?php echo esc_url( get_post_permalink() ); ?>"'>
			<?php if ( get_field( 'mark_as_new' ) === true ) : ?>
		<?php endif; ?>
			<?php
			if ( has_post_thumbnail() ) {
				$thumb_id = get_post_thumbnail_id();
				$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
				$thumb_url = $thumb_url_array[0];

				?>
		<img src="<?php echo esc_url( $thumb_url ); ?>" width="100%" height="200" />
			<?php	} ?>
		<h2 class="title-post">
			<?php the_title(); ?>
		</h2>
		<br />
		<div class="excerpt-post">
			<?php the_excerpt_max_charlength( 140 ); ?>
		</div>
		<div class="category-post">
			<?php
			$category = get_the_category();
			if ( $category[0] ) {
				echo '<a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '">' . esc_html( $category[0]->cat_name ) . '</a>';
			}
			?>
		  <span class="mitDate">&nbsp;&nbsp;<?php echo get_the_date(); ?></span> 
		  <!--echo all the cat --> 
		  
		</div>
	  </div>
	  <!-- eventsBox -->
	  <?php endwhile; ?>
	  <?php else : ?>
		  <?php get_template_part( 'content', 'none' ); ?>
	  <?php endif; ?>
	</div>
	<!-- MITContainer --> 
	
	</div>
	<!-- #content --> 
</section>
<!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
