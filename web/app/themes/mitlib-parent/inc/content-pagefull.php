<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

global $isRoot;
?>		
		
		<div class="main-content content-main">
		
			<div class="entry-content">
				<?php if ( ! $isRoot ) : ?>
				<h2><?php the_title(); ?></h2>
				<?php endif; ?>
				<?php the_content(); ?>
			</div>

		</div>

