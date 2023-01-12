<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package MIT_Libraries_Child
 * @since Twenty Twelve 1.0
 */

?>
	
<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>

	<div id="secondary" class="widget-area sidebar" role="complementary">

		<?php

			dynamic_sidebar( 'sidebar' );

		?>

	</div><!-- #secondary -->

<?php endif; ?>
