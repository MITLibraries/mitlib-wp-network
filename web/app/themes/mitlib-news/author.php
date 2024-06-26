<?php
/**
 * The template for displaying archive-type pages for posts by an author.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

get_header(); ?>

<?php get_template_part( 'inc/sub-header' ); ?>


		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<div class="container">
	  <div class="row">

			<?php
				/**
				 * Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>

			<header class="author-archive-header">
				<h1 class="lib-header">Author: <strong><?php printf( get_the_author( '', false ) ); ?></strong></h1>
			</header><!-- .archive-header -->

			<?php
				/**
				 * Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>

			<?php \Mitlib\Parent\content_nav( 'nav-above' ); ?>

			<?php // Start the Loop. ?>
			<div class="row">

			
			
			
				
			<?php
			$i = -1;
			while ( have_posts() ) :
				the_post();
				$i ++;
				?>
				
				   <div id="theBox" class="
				   <?php
					if ( 0 == $i % 3 ) {
						echo 'third '; }
					?>
					no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-4 col-md-4 col-lg-4">
	  <div class="flex-item blueTop  eventsBox <?php echo esc_attr( check_image() ); ?>"
		onClick='location.href="
				<?php
				if ( ( '' != get_field( 'external_link' ) ) && 'spotlights' == $post->post_type ) {
					the_field( 'external_link' );
				} else {
					echo esc_url( get_post_permalink() );
				}
				?>
		"'>
		  
		  
				<?php get_template_part( 'inc/spotlights' ); ?>
	   
				<?php
				if ( get_field( 'listImg' ) != '' ) {
					?>
		<img data-original="<?php the_field( 'listImg' ); ?>" width="100%" height="111" class="img-responsive"  alt="<?php the_title(); ?>"/>
				<?php } ?>
		
		
				<?php if ( 'spotlights' == $post->post_type ) { ?>
			 <h2 class="entry-title title-post spotlights">
		  <a href="<?php the_field( 'external_link' ); ?>"><?php the_title(); ?></a>
		</h2> 
		<?php } else { ?>
		<h2 class="entry-title title-post">
		  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<?php } ?>
		
		
				<?php get_template_part( 'inc/events' ); ?>
		
				<?php get_template_part( 'inc/entry' ); ?>

		<!--final **** else-->
				<?php {; ?>
		<!--EVENT -->
				<?php }; ?>
		<div class="category-post 
				<?php
				if ( get_post_type( get_the_ID() ) == 'bibliotech' ) {
					echo 'Bibliotech';}
				?>
		">
				<?php
				if ( get_post_type( get_the_ID() ) == 'bibliotech' ) {
					echo "<div class='bilbioImg bilbioTechIcon'>
	   </div>";
					echo "<div class='biblioPadding'>&nbsp;<a href='/news/bibliotech/' title='Bibliotech'>Bibliotech</a>";
				} else {
					  $category = get_the_category();
					  $r = rand( 0, count( $category ) - 1 );
					  echo '<a title="' . esc_attr( $category[ $r ]->cat_name ) . '" href="' . esc_url( get_category_link( $category[ $r ]->term_id ) ) . '">' . esc_html( $category[ $r ]->cat_name ) . '</a>';
				}
				?>
		  <span class="mitDate">
		  <time class="updated"  datetime="<?php echo get_the_date(); ?>">&nbsp;&nbsp;<?php echo get_the_date(); ?></time>
		  </span> </div>
	  </div><!--last-->
	</div>
				<?php if ( get_post_type( get_the_ID() ) == 'bibliotech' ) { ?>
	</div><!--this div closes the open div in biblio padding-->
	<?php } ?>
				
				
				
				
				
			<?php endwhile; ?>
			</div>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
			</div>
			</div>
		</div><!-- #content -->

<div class="container">
<?php get_footer(); ?>
