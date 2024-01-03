<?php
/**
 * Template-part for displaying social media icons in subheader.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

?>

<ul class="sIcons hidden-xs anotherMenu clearfix pull-right flex-container">
	<li class="sub soc">
		<a title="subscribe" href="/news/subscribe/" >
		Subscribe to news
		</a>
	</li>
	<li class="follow soc">
		<a title="follow" href="/follow">Follow us</a>
	</li>
	<li class="sf">
		<?php get_search_form( 'true' ); ?>
	</li>
</ul>
