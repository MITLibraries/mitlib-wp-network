<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title">Nothing Found</h1>
		</header>

		<div class="entry-content">
			<p>Apologies, but no results were found. Perhaps searching will help find a related post.</p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
