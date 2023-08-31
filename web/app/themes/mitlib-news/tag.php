<?php
/**
 * The template for displaying all content with a single tag.
 *
 * @package MITlib_News
 * @since 0.3.0
 */

namespace Mitlib\News;

get_header();
?>

<?php get_template_part( 'inc/sub-header' ); ?>

<div id="content" role="main">
	<?php if ( have_posts() ) : ?>
		<div class="container container-fluid">
			<div class="row">
				<h1 class="lib-header">Tag: <strong><?php echo esc_html( single_tag_title( '', false ) ); ?></strong></h1>
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'content', 'single' );
				endwhile;
				?>
				<?php \Mitlib\Parent\content_nav( 'nav-below' ); ?>
			</div>
		</div>
	<?php endif; ?>
</div><!-- #content -->

<div class="container">
<?php get_footer(); ?>
