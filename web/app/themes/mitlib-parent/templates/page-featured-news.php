<?php
/**
 * Template Name: Featured News Article List
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

	get_header();
?>

<div class="col-2 flex-item ">
	<div id="home-posts-news" class="posts--preview news-events">
		<h2>Featured Articles</h2>
		<p>This is a statically-coded page template, provided to allow content
		editors to have a preview of how featured news content will appear when
		it is selected for the site homepage.</p>
		<p>The list below includes all news content which is currently eligible
		to appear on the homepage.</p>
		<div class="home">
			<div class="news-events">
				<div class="flex-container" style="background-color: #f3f3f3; margin: 0 auto; flex-direction: column; width: 662px; padding: 10px;">
					<?php load_news( true ); ?>
				</div>
			</div>
		</div>
	</div><!-- end div.news-events -->
</div><!-- end div.col-2 -->

<?php
	get_footer();
?>
