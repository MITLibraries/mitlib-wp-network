<?php
/**
 * The template for displaying content of a single post.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

$category = get_the_category();
$type_post = get_post_type();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-category="<?php echo esc_attr( $category[0]->slug ); ?>">
	<div class="title-page mySingle">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<span class="author">
				By <?php the_author_posts_link(); ?>
			</span>
			<span class="date-post">
				on <?php the_date(); ?>
			</span>
		</div><!-- .entry-meta -->
	</div><!-- .title-page -->

	<div class="entry-content mitContent">
		<?php
		the_content();

		if ( 'post' == $type_post && 1 == get_field( 'is_event' ) ) {
			get_template_part( 'inc/events' );
		}
		?>
	</div>
</article><!-- #post-## -->
