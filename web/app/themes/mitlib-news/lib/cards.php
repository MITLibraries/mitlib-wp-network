<?php
/**
 * Handles render function for all elements that constitute CARDS.
 *
 * @package MITlib_News
 * @since 0.1.0
 */

namespace Mitlib\News;

/**
 * This returns either "no-image" or "has-image" based on whether a post has an image or not.
 * This is done by checking two custom fields:
 * listImg is for locally-declared images.
 * calendar_immage is for images imported from the MIT Calendar.
 */
function check_image() {
	$result = 'no-image';
	if ( get_field( 'listImg' ) || get_field( 'calendar_image' ) ) {
		$result = 'has-image';
	}
	return $result;
}

/**
 * This returns the URL that should be used for a given card. It can be drawn from three sources:
 * 1. The post permalink (default value)
 * 2. The external_link field (for spotlight records)
 * 3. The calendar_url field (for imported records from the MIT Calendar)
 *
 * @param object $post A WP post object.
 */
function lookup_url( $post ) {
	$url = get_permalink();
	if ( '' !== get_field( 'external_link' ) && 'spotlights' === $post->post_type ) {
		$url = get_field( 'external_link' );
	} elseif ( get_field( 'calendar_url' ) ) {
		$url = get_field( 'calendar_url' );
	}
	return $url;
}

/**
 * Render function
 *
 * @param object $post A WP post object.
 * @param int    $i The index of the post object in a list.
 * @param string $type The type of post.
 */
function render( $post, $i, $type ) {
	// Default outer classes.
	$outerClasses = 'padding-right-mobile col-xs-12 col-xs-B-6 col-sm-4 col-md-4 col-lg-4';
	if ( 0 == $i % 3 ) {
		$outerClasses .= ' third';
	}
	// Default inner classes.
	$inner_classes = 'flex-item blueTop eventsBox render-confirm-' . $type . ' ' . check_image();

	// Inner onClick.
	$card_url = lookup_url( $post );
	// Image handled by inc/card-image.
	// Title handled by inc/card-title.
	// Event handled by inc/events.
	// Entry handled by inc/entry.
	// Category.
	$categoryClasses = 'category-post';
	$categoryMarkup = '';
	$dateMarkup = '';

	/*
	Not sure this check is needed
	if ($post->post_type == 'bibliotech') {
	$categoryClasses .= " Bibliotech";
	}
	*/
	if ( is_page( 'bibliotech-index' ) || ( is_page_template( 'additionalPosts-biblio.php' ) ) || ( is_category( 'bibliotech_issues' ) || ( is_tax() ) || is_page_template( 'additionalPosts-archives.php' ) ) ) {
		// Bibliotech articles without icon.
		$categoryMarkup = "<div class='biblioPad'>&nbsp;<a href='/news/bibliotech-index/' title='Bibliotech'>Bibliotech</a></div>";
	} elseif ( ( 'bibliotech' == $post->post_type ) && ( ! is_page_template( 'additionalPosts-biblio.php' ) ) ) {
		// Bibliotech articles with icon.
		$categoryMarkup = "<div class='bilbioImg bilbioTechIcon'> </div>";
		$categoryMarkup .= "<div class='biblioPad'>&nbsp;<a href='/news/bibliotech-index/' title='Bibliotech'>Bibliotech</a>";
		$dateMarkup = "<span class='mitDate'>" .
		"<time class='updated' datetime='" . get_the_date() . "'>" . get_the_date() . '</time>' .
		'</span>' .
		'</div>';
	} else {
		// Non-biliotech articles.
		$category = get_the_category();
		$rCat = count( $category );
		$r = rand( 0, $rCat - 1 );
		$categoryMarkup = '<a title="' . $category[ $r ]->cat_name . '"  title="' . $category[ $r ]->cat_name . '" href="' . get_category_link( $category[ $r ]->term_id ) . '">' . $category[ $r ]->cat_name . '</a>';
		$dateMarkup = "<span class='mitDate'>" .
		"<time class='updated' datetime='" . get_the_date() . "'>&nbsp;&nbsp;" . get_the_date() . '</time>' .
		'</span>';
	}
	?>
	<div id="theBox" class="<?php echo esc_attr( $outerClasses ); ?>">
	<div class="<?php echo esc_attr( $inner_classes ); ?>" onClick='location.href="<?php echo esc_url( $card_url ); ?>"'>

	  <?php get_template_part( 'inc/spotlights' ); ?>

	  <?php get_template_part( 'inc/card-image' ); ?>

	  <?php get_template_part( 'inc/card-title' ); ?>

	  <?php get_template_part( 'inc/events' ); ?>

	  <?php get_template_part( 'inc/entry' ); ?>

	  <div class="<?php echo esc_attr( $categoryClasses ); ?>">
		<?php
		// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- This would need wpkses to escape properly.
		echo $categoryMarkup;
		echo $dateMarkup;
		// phpcs:enable -- Start scanning again.
		?>
	  </div>

	</div>
	</div>

<!-- RENDER FUNCTION FOR MOBILE CARDS -->

	<?php
}
/**
 * Render a card for display on mobile devices
 *
 * @param int    $i Unused - the index of the post object in a list.
 * @param object $post A WP post object.
 */
function renderMobileCard( $i, $post ) {
	$card_url = lookup_url( $post );
	?>
<div  class="visible-xs visible-sm hidden-md hidden-lg no-padding-left-mobile no-padding-left-tablet col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4 ">
<div class="flex-item blueTop eventsBox <?php echo esc_attr( check_image() ); ?>"
	onClick='location.href="<?php echo esc_url( $card_url ); ?>"'>
	
			   <!-- INTERNAL CONTAINER TO CONTROL FOR OVERFLOW -->   
			 <div class="interiorCardContainer">
				 
				<!-- CHECKS FOR SPOTLIGHT -->   
				<?php if ( 'spotlights' == $post->post_type ) { ?>
					<?php get_template_part( 'inc/spotlights' ); ?>
				<?php } ?><!-- SPOTLIGHT -->  
				
				<!-- CHECKS FOR IMAGE -->   
				<?php
				if ( get_field( 'listImg' ) != '' ) {
					?>
					<?php get_template_part( 'inc/image' ); ?>
				<?php } ?><!-- .listImg -->  
				 
				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
				<?php get_template_part( 'inc/title' ); ?>
				<!-- TITLE -->  
				
				<!-- CHECKS IF EVENT TYPE -->   
				<?php if ( get_field( 'event_date' ) ) { ?>
					<?php get_template_part( 'inc/events' ); ?>
				<?php } ?><!-- EVENT -->
				
				<!-- CHECKS FOR SUBTITLE -->
				<?php if ( get_field( 'subtitle' ) ) { ?>
					<?php get_template_part( 'inc/subtitle' ); ?>
				<?php } ?><!-- .subtitle -->    	
				
				<!-- CALLS FOR EXCERPT -->   
				<?php get_template_part( 'inc/entry' ); ?>
		
			</div> <!--.interiorCardBox -->  
				
				<!-- CALLS FOR FOOTER -->   
				<?php get_template_part( 'inc/footer' ); ?>

	</div><!--last-->
</div>

	<?php
}
/**
 * Render a Bibliotech card for display on mobile devices
 *
 * @param int    $i Unused - the index of the post object in a list.
 * @param object $post A WP post object.
 */
function renderMobileBiblioCard( $i, $post ) {
	$card_url = lookup_url( $post );
	?>
<div  class="visible-xs visible-sm hidden-md hidden-lg no-padding-left-mobile no-padding-left-tablet col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4 ">
<div class="flex-item blueTop eventsBox <?php echo esc_attr( check_image() ); ?>"
	onClick='location.href="<?php echo esc_url( $card_url ); ?>"'>
	
			   <!-- INTERNAL CONTAINER TO CONTROL FOR OVERFLOW -->   
			 <div class="interiorCardContainer">
				
				<!-- CHECKS FOR IMAGE -->   
				<?php
				if ( get_field( 'listImg' ) != '' ) {
					?>
					<?php get_template_part( 'inc/image' ); ?>
				<?php } ?><!-- .listImg -->  
				 
				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
				<?php get_template_part( 'inc/title' ); ?>
				<!-- TITLE -->  
				
				<!-- CHECKS FOR SUBTITLE -->
				<?php if ( get_field( 'subtitle' ) ) { ?>
					<?php get_template_part( 'inc/subtitle' ); ?>
				<?php } ?><!-- .subtitle -->    	
				
				<!-- CALLS FOR EXCERPT -->   
				<?php get_template_part( 'inc/entry' ); ?>
		
			</div> <!--.interiorCardBox -->  
				
				<!-- CALLS FOR FOOTER -->   
				<?php get_template_part( 'inc/catFooter' ); ?>

	</div><!--last-->
</div>

	<?php
}
/**
 * Render a Bibliotech card
 *
 * @param int    $m Unused.
 * @param object $post A WP post object.
 */
function renderBiblioCard( $m, $post ) {
	$card_url = lookup_url( $post );
	?>
<div  class="no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4">
<div class="flex-item blueTop eventsBox <?php echo esc_attr( check_image() ); ?>"
	onClick='location.href="<?php echo esc_url( $card_url ); ?>"'>
	
			   <!-- INTERNAL CONTAINER TO CONTROL FOR OVERFLOW -->   
			 <div class="interiorCardContainer">
								
				<!-- CHECKS FOR IMAGE -->   
				<?php
				if ( get_field( 'listImg' ) != '' ) {
					?>
					<?php get_template_part( 'inc/image' ); ?>
				<?php } ?><!-- .listImg -->  
				 
				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
				<?php get_template_part( 'inc/title' ); ?>
				<!-- TITLE -->  
				
				<!-- CHECKS FOR SUBTITLE -->
				<?php if ( get_field( 'subtitle' ) ) { ?>
					<?php get_template_part( 'inc/subtitle' ); ?>
				<?php } ?><!-- .subtitle -->    	
				
				<!-- CALLS FOR EXCERPT -->   
				<?php get_template_part( 'inc/entry' ); ?>
		
			</div> <!--.interiorCardBox -->  
				
				<!-- CALLS FOR FOOTER -->   
				<?php get_template_part( 'inc/catFooter' ); ?>

	</div><!--last-->
</div>

<!-- RENDER FUNCTION FOR REGULAR CARDS -->

	<?php
}
/**
 * Render a card
 *
 * @param int    $i Unused - the index of the post object in a list.
 * @param object $post A WP post object.
 */
function renderRegularCard( $i, $post ) {

	$card_url = lookup_url( $post );

	$image_class = check_image();

	?>
<div id="theBox" class="no-padding-left-mobile col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4">
<div class="flex-item blueTop eventsBox <?php echo esc_attr( $image_class ); ?>" 
	onClick='location.href="<?php echo esc_url( $card_url ); ?>"'
	>
			   <!-- INTERNAL CONTAINER TO CONTROL FOR OVERFLOW -->   
			 <div class="interiorCardContainer">
				 
				<!-- CHECKS FOR SPOTLIGHT -->   
				<?php if ( 'spotlights' == $post->post_type ) { ?>
					<?php get_template_part( 'inc/spotlights' ); ?>
				<?php } ?><!-- SPOTLIGHT -->  
				
				<!-- CHECKS FOR IMAGE -->   
				<?php
				if ( get_field( 'listImg' ) != '' ) {
					?>
					<?php get_template_part( 'inc/image' ); ?>
				<?php } elseif ( strlen( get_field( 'calendar_image' ) ) > 0 ) { ?>
					<?php get_template_part( 'inc/imageEvent' ); ?>
				<?php } ?><!-- .listImg -->  

				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
				<?php get_template_part( 'inc/title' ); ?>
				<!-- TITLE -->  
				
				<!-- CHECKS IF EVENT TYPE -->   
				<?php if ( get_field( 'event_date' ) ) { ?>
					<?php get_template_part( 'inc/events' ); ?>
				<?php } ?><!-- EVENT -->
				
				<!-- CHECKS FOR SUBTITLE -->
				<?php if ( get_field( 'subtitle' ) ) { ?>
					<?php get_template_part( 'inc/subtitle' ); ?>
				<?php } ?><!-- .subtitle -->    	
				
				<!-- CALLS FOR EXCERPT -->   
				<?php get_template_part( 'inc/entry' ); ?>
		
			</div> <!--.interiorCardBox -->  
				
				<!-- CALLS FOR FOOTER -->   
				<?php get_template_part( 'inc/footer' ); ?>

	</div><!--last-->
</div>
	<?php
	if ( get_post_type( get_the_ID() ) == 'bibliotech' ) {
		?>
	</div>

<!-- RENDER FUNCTION FOR EVENT CARDS -->

		<?php
	}
}
/**
 * Render an event card
 *
 * @param int    $i Unused - the index of the post object in a list.
 * @param object $post A WP post object.
 */
function renderEventCard( $i, $post ) {

	$card_url = lookup_url( $post );

	$image_class = check_image();
	?>
	<div id="theBox" class="col-xs-12 col-xs-B-6 col-sm-6 col-md-4 col-lg-4">
	<div itemscope itemtype="http://data-vocabulary.org/Event"
		class="flex-item blueTop eventsBox <?php echo esc_attr( $image_class ); ?>"
		onClick='location.href="<?php echo esc_url( $card_url ); ?>"'>
	<!-- INTERNAL CONTAINER TO CONTROL FOR OVERFLOW -->   
			 <div class="interiorCardContainer">
				 
				<!-- CHECKS FOR IMAGE -->   
				<?php
				if ( get_field( 'listImg' ) != '' ) {
					?>
					<?php get_template_part( 'inc/image' ); ?>
				<?php } elseif ( strlen( get_field( 'calendar_image' ) ) > 0 ) { ?>
					<?php get_template_part( 'inc/imageEvent' ); ?>
				<?php } ?><!-- .listImg -->  


				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
				<?php get_template_part( 'inc/title' ); ?>
				<!-- TITLE -->  
				
				<!-- CHECKS IF EVENT TYPE -->   
				<?php if ( get_field( 'event_date' ) ) { ?>
					<?php get_template_part( 'inc/events' ); ?>
				<?php } ?><!-- EVENT -->
				
				<!-- CHECKS FOR SUBTITLE -->
				<?php if ( get_field( 'subtitle' ) ) { ?>
					<?php get_template_part( 'inc/subtitleEvents' ); ?>
				<?php } ?><!-- .subtitle -->    	
				
				<!-- CALLS FOR EXCERPT -->   
				<?php get_template_part( 'inc/entry' ); ?>
		
			</div> <!--.interiorCardBox -->  
				
				<!-- CALLS FOR FOOTER -->   
				<?php get_template_part( 'inc/catFooter' ); ?>
	</div> <!-- close itemscope -->
</div> <!-- close eventsPage -->

<!-- RENDER FUNCTION FOR STICKY/FEATURED CARDS -->

	<?php
}
/**
 * Render a featured card
 *
 * @param int    $i Unused - the index of the post object in a list.
 * @param object $post A WP post object.
 */
function renderFeatureCard( $i, $post ) {
	$card_url = lookup_url( $post );
	?>
	<div class="sticky  hidden-xs hidden-sm col-md-12 clearfix">
	<div class="no-padding-left-mobile sticky col-xs-3 col-xs-B-6 col-sm-8 col-lg-8 col-md-8" onClick='location.href="<?php echo esc_url( $card_url ); ?>"' style="padding-right:0px; padding-left:6px !important;" > <img src="<?php the_field( 'featuredListImg' ); ?>" class="img-responsive" width="679" height="260" alt="<?php the_title(); ?>" /> </div>
	<div class=" hidden-xs bgWhite col-xs-12 col-xs-B-6 col-sm-4 col-md-4 col-lg-4" onClick='location.href="<?php echo esc_url( $card_url ); ?>"'>
		
				<!-- CHECKS FOR SPOTLIGHT -->   
				<?php if ( 'spotlights' == $post->post_type ) { ?>
					<?php get_template_part( 'inc/spotlights' ); ?>
				<?php } ?><!-- SPOTLIGHT -->  
				 
				<!-- CALLS TITLE FOR REGULAR/SPOTLIGHT POST-TYPES -->   
				<?php get_template_part( 'inc/title' ); ?>
				<!-- TITLE -->  
				
				<!-- CHECKS IF EVENT TYPE -->   
				<?php if ( get_field( 'event_date' ) ) { ?>
					<?php get_template_part( 'inc/events' ); ?>
				<?php } ?><!-- EVENT -->
				
				<!-- CHECKS FOR SUBTITLE -->
				<?php if ( get_field( 'subtitle' ) ) { ?>
					<?php get_template_part( 'inc/subtitle' ); ?>
				<?php } ?><!-- .subtitle -->    	
				
				<!-- CALLS FOR EXCERPT -->   
				<?php get_template_part( 'inc/entry' ); ?>
		
				<!-- CALLS FOR FOOTER --> 
				<?php get_template_part( 'inc/catFooter' ); ?>
	
	</div>
</div>
	<?php
}
?>
