<?php
/**
 * This template-part displays the EXCERPT on CARDS.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

?>
		
<div class="excerpt-post classCheck">
	<p class="entry-summary">
		
		<?php
			// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- Too many potential tags in the excerpt to reliably escape.
			echo strip_tags( excerpt( 25 ) );
			// phpcs:enable -- Start scanning again.
		?>
		
	</p>
</div>
