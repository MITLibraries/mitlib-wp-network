<?php
/**
 * Template Name: Additional Posts - Category
 *
 * This template loads additional Posts if any exist by Category.
 *
 * @package MITlib_News
 * @since 0.1.0
 */

namespace Mitlib\News;

?>

<script>
$(function() {
	$("img.img-responsive").lazyload({ 
	effect : "fadeIn", 
	effectspeed: 450 ,
	failure_limit: 999999
	}); 
});	

</script>

<?php

$date = \DateTime::createFromFormat( 'Ymd', get_field( 'event_date' ) );

?>
<?php

global $post;
$category_id = 3; // 3 is the "All news" value.
if ( isset( $_GET['categoryID'] ) ) {
	$category_id = sanitize_key( $_GET['categoryID'] );
}

$offset = 21;
if ( isset( $_GET['offset'] ) ) {
	$offset = sanitize_key( $_GET['offset'] );
}

$limit = 9;
if ( isset( $_GET['limit'] ) ) {
	$limit = sanitize_key( $_GET['limit'] );
}



	$args = array(
		'posts_per_page'      => $limit,
		'post_type'               => 'post',
		'cat'                 => $category_id,
		'offset'              => 21,
		'post__not_in'        => get_option( 'sticky_posts' ),
		'ignore_sticky_posts' => 1,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'suppress_filters' => false,

	);

	$the_query = new \WP_Query( $args );

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
	$o = -1;

	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$o++;
				renderRegularCard( $o, $post ); // --- CALLS REGULAR CARDS --- //
		?>


		<?php if ( get_post_type( get_the_ID() ) == 'bibliotech' ) { ?>
		   
			<?php } //get_post_type( get_the_ID() ) == 'bibliotech' ?>
			  
					<?php wp_reset_query(); // Restore global post data stomped by the_post(). ?>
		   
					<?php endwhile; ?>
			
					<?php endif; ?>
