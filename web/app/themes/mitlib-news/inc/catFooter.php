<?php
/**
 * Template-part for displaying FOOTER on featured/sticky + Bibliotech CARDS.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

?>

<div class="category-post">
	  <?php
		$category = get_the_category();
		if ( $category[0] ) {
			echo '<a title="' . esc_attr( $category[0]->cat_name ) . '" href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '">' . esc_html( $category[0]->cat_name ) . '</a>';
		}
		?>
	  <span class="mitDate"><?php echo get_the_date(); ?></span> 
	  <!--echo all the cat --> 
	</div>
