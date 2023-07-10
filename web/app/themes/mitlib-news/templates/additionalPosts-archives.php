<?php
/**
 * Template Name: Additional Posts - Archives
 *
 * This template loads additional Posts if any exist from the homepage.
 *
 * @package MITlib_News
 * @since 0.1.0
 */

namespace Mitlib\News;

?>

<script type="text/javascript">
$(document).ready(function() {
	$("img.img-responsive").lazyload({ 
	effect : "fadeIn", 
	effectspeed: 450 ,
	failure_limit: 999999
	}); 
});	
</script>

<?php
$offset = 10;
if ( isset( $_GET['offset'] ) ) {
	$offset = sanitize_key( $_GET['offset'] );
}

$limit = 9;
if ( isset( $_GET['limit'] ) ) {
	$limit = sanitize_key( $_GET['limit'] );
}



	$args = array(
		'post_type' => array( 'bibliotech' ),
		'post__not_in'   => array( 'sticky_posts' ),
		'ignore_sticky_posts' => 1,
		'offset'          => 10,
		'posts_per_page'  => $limit,
		'order'                  => 'DESC',
		'orderby'                => 'date',
		'suppress_filters' => false,


	);
	$the_query = new \WP_Query( $args );


	?>
	<div class="row">
	
	
	<?php
	// Removes button start.
	$ajaxLength = $the_query->post_count;
	?>
<?php if ( $ajaxLength < $limit ) { ?>
<script>
$("#another").hide();
</script>


	<?php
}
// Removes button end.
?>
	
	
	
<?php if ( $the_query->have_posts() ) : ?>

	<?php
	$i = -1;
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$theLength = $my_query->post_count;
		$i++;
		?>


	<div class="
		<?php
		if ( 0 === $i % 3 ) {
			echo 'third '; }
		?>
	 col-xs-12  col-xs-B-6 col-sm-4 col-md-4 no-padding-left-mobile">
		<div class="flex-item blueTop eventsBox <?php echo esc_attr( check_image() ); ?>"
			onClick='location.href="
			<?php
			if ( ( '' !== get_field( 'external_link' ) ) && 'spotlights' == $post->post_type ) {
				the_field( 'external_link' );
			} else {
				echo esc_url( get_post_permalink() );
			}
			?>
			"'>
			<?php
			if ( '' !== get_field( 'listImg' ) ) {
				?>
		<img data-original="<?php the_field( 'listImg' ); ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title(); ?>"/>
			<?php } ?>
		
		
		<h2 class="entry-title title-post  
		<?php
		if ( 'spotlights' === $post->post_type ) {
			echo 'spotlights'; }
		?>
		">
			  <?php the_title(); ?>
		</h2>
		
		
			 <?php get_template_part( 'inc/events' ); ?>
		
			<?php get_template_part( 'inc/entry' ); ?>

		<!--final **** else-->
			<?php {; ?>
		<!--EVENT -->
			<?php }; ?>
		
		
		
		<div class="category-post">
			  <?php
				$category = get_the_category();
				$rCat = count( $category );
				$r = rand( 0, $rCat - 1 );

				echo '<a title="' . esc_attr( $category[ $r ]->cat_name ) . '" href="' . esc_url( get_category_link( $category[ $r ]->term_id ) ) . '">' . esc_html( $category[ $r ]->cat_name ) . '</a>';
				?>
		  <span class="mitDate">
		  <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
		  </span> </div>
	  </div>
	</div>
	<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
</div>
