<?php
/**
 * Template-part for displaying FOOTER on CARDS.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

?>

	<div class="category-post 
	<?php
	if ( get_post_type( get_the_ID() ) == 'bibliotech' ) {
		echo 'Bibliotech';}
	?>
	">
	<?php
	if ( is_page( 'bibliotech-index' ) || ( is_page_template( 'additionalPosts-biblio.php' ) ) || ( is_category( 'bibliotech_issues' ) || ( is_tax() ) || is_page_template( 'additionalPosts-archives.php' ) ) ) {
		echo "<div class='biblioPad'>&nbsp;<a href='/news/bibliotech-index/' title='Bibliotech'>Bibliotech</a></div>";
	} elseif ( ( get_post_type( get_the_ID() ) == 'bibliotech' ) && ( ! is_page_template( 'additionalPosts-biblio.php' ) ) ) {
		echo "<div class='bilbioImg bilbioTechIcon'> </div>";
		echo "<div class='biblioPadding'>&nbsp;<a href='/news/bibliotech-index/' title='Bibliotech'>Bibliotech</a>";
		?>
	 
	  <span class="mitDate">
		<time class="updated" datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
	  </span>
		<?php
	} else {
		$category = get_the_category();
		$rCat = count( $category );
		$r = rand( 0, $rCat - 1 );
		echo '<a title="' . esc_attr( $category[ $r ]->cat_name ) . '" href="' . esc_url( get_category_link( $category[ $r ]->term_id ) ) . '">' . esc_html( $category[ $r ]->cat_name ) . '</a>';
		?>
	  <span class="mitDate">
		<time class="updated"  datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
	  </span>
		<?php
	}
	?>
	</div> 
