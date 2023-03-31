<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

?>
	
	<div id="sidebarContent" class="sidebar span3">
		<div class="sidebarWidgets">
			<?php dynamic_sidebar( 'subscribe' ); ?>
		</div>
	</div>		
