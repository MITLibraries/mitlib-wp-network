<?php
/**
 * The template used for displaying standard page content.
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

$page_root = get_root( $post );
$section = get_post( $page_root );
$is_root = $section->ID == $post->ID;

?>

<?php if ( in_category( 'has-menu' ) ) { ?>
	<?php get_template_part( 'inc/content', 'secmenu' ); ?>
<?php } ?>

<div class="main-content content-main">
	<div class="entry-content">
		<div class="entry-page-title">
		<?php if ( ! $is_root ) : ?>
			<h1><?php the_title(); ?></h1>
		<?php endif; ?>
		</div>
		<?php the_content(); ?>
	</div>
</div>
