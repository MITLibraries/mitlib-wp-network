<?php
/**
 * Template-part for displaying related posts to the category page.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

?>

<?php $category = get_the_category(); ?>
<div class="posts--related">
	<button>More in <?php echo esc_html( $category[0]->cat_name ); ?></button>
	<div class="flex-container space-between"></div>
</div>

<script>
	function mitlib_related_posts() {
		// Get the post type from a data attribute
		var cat = $('article').data('category'),
				i,
				relatedCompiled,
				relatedTemplate;
		console.log(cat);
		$.ajax({
				cache: true,
				// Filter by current post category
				url: "/news/wp-json/posts?filter[category_name]=" + cat,
				dataType: "json"
			})
			.done(function(json) {
				for (var i = 0; i < 3; i++) {
					relatedCompiled = _.template(
						'<div class="post-preview">' +
							'<h3><%= title %></h3>' +
							'<img src="<?php echo esc_url( the_field( 'listImg', $post_id ) ); ?>" />' +
						'</div>'
					);
					relatedTemplate = relatedCompiled(json[i]);
					$('.posts--related > .flex-container').append(relatedTemplate);
				};
			})
	}
	mitlib_related_posts();
</script>

<div>here</div>
