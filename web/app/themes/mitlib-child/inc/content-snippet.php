<?php
/**
 * The template used for displaying search results in search.php
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
	</header><!-- .entry-header -->
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<footer class="entry-meta">
		<?php if ( 'page' === $post->post_type ) { ?>
			<p>Page</p>
		<?php } else { ?>
			<p>Posted on <?php the_date(); ?> in <?php the_category( ', ' ); ?></p>
		<?php } ?>
	</footer>
</article><!-- #post -->
