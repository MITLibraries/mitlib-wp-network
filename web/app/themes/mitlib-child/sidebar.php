<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

?>
	
<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>

	<div id="secondary" class="widget-area sidebar" role="complementary">

		<?php

			dynamic_sidebar( 'sidebar' );

		?>

	</div><!-- #secondary -->

<?php endif; ?>
