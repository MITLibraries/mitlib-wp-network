<?php
/**
 * The template used for displaying conditional header content in page.php
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

$page_root = get_root( $post );
$section = get_post( $page_root );
$is_root = $section->ID == $post->ID;

?>

<div class="title-page">
	<?php if ( $is_root ) : ?>
		<h1><?php echo esc_html( $section->post_title ); ?></h1>
	<?php else : ?>
		<a class="title-page-link" href="<?php the_permalink( $section->ID ); ?>"><?php echo esc_html( $section->post_title ); ?></a>
	<?php endif; ?>
</div>
