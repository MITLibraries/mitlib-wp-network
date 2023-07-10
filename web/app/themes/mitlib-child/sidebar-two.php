<?php
/**
 * The sidebar template that controls the widgetized area below content.
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

?>
	
<?php if ( is_active_sidebar( 'sidebar-two' ) ) : ?>

	<div id="below" class="widget-area" role="complementary">

		<?php

			dynamic_sidebar( 'sidebar-two' );

		?>

	</div><!-- #secondary -->

<?php endif; ?>
