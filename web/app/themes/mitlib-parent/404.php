<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

get_header();
?>

	<div id="stage" class="inner" role="main">
		<div id="content" class="content has-sidebar">

			<div class="main-content content-main">

				<article id="post-0" class="post error404 no-results not-found">

					<?php if ( is_active_sidebar( 'sidebar-404' ) ) { ?>

						<div id="sidebar-404" class="widget-area" role="complementary">
							<?php dynamic_sidebar( 'sidebar-404' ); ?>
						</div>

					<?php } else { ?>

						<header class="entry-header">
							<h1 class="entry-title">Sorry, that link doesn’t work anymore. Get help below!</h1>
						</header>
						<?php get_template_part( 'inc/site-search' ); ?>

					<?php } ?>

				</article><!-- #post-0 -->

			</div>

			<?php get_sidebar(); ?>

		</div><!-- #content -->
	</div><!-- #stage -->

<?php get_footer(); ?>
