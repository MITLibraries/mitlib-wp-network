<?php
/**
 * Template-part for displaying IMAGES on CARDS fom Calendar.mit.edu.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

?>

<?php
if ( get_field( 'calendar_image' ) !== '' ) {
	?>
	<div class="card-image classCheck">
		<div id='crop_the_image'>
			<img src="<?php the_field( 'calendar_image' ); ?>"  alt="<?php the_title(); ?>"/>
		</div>
	</div>
	<?php
}
?>
