<?php
/**
 * Server-side rendering for a single featured item.
 *
 * @package MITlib Blocks
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

$item_type_labels = array(
	'spotlight' => 'Spotlight',
	'service'   => 'Service',
	'resource'  => 'Resource',
	'news'      => 'News',
);

$item_type = $attributes['itemType'] ?? 'spotlight';
if ( ! isset( $item_type_labels[ $item_type ] ) ) {
	$item_type = 'spotlight';
}

$item_title       = $attributes['title'] ?? '';
$item_description = $attributes['description'] ?? '';
$item_link_url    = $attributes['linkUrl'] ?? '';
$item_image_id    = absint( $attributes['imageId'] ?? 0 );
$item_image_url   = $attributes['imageUrl'] ?? '';
$item_image_alt   = $attributes['imageAlt'] ?? '';
$item_image_pos   = $attributes['imagePosition'] ?? 'above';
$item_has_image   = 'none' !== $item_image_pos && ( $item_image_id || $item_image_url );
$item_classes     = 'featured-item' . ( $item_has_image && 'left' === $item_image_pos ? ' side-by-side' : '' );

// Titles may carry light emphasis markup from the editor.
$item_allowed_html = array(
	'em'     => array(),
	'i'      => array(),
);

?>
<article class="<?php echo esc_attr( $item_classes ); ?>">
	<span class="item-type <?php echo esc_attr( $item_type ); ?>"><?php echo esc_html( $item_type_labels[ $item_type ] ); ?></span>
	<?php
	if ( $item_has_image ) {
		if ( $item_image_id ) {
			echo wp_get_attachment_image( $item_image_id, 'full' );
		} else {
			?>
	<img src="<?php echo esc_url( $item_image_url ); ?>" alt="<?php echo esc_attr( $item_image_alt ); ?>" />
			<?php
		}
	}
	?>
	<div class="featured-item-content">
		<hgroup>
			<h3>
			<?php if ( $item_link_url ) : ?>
				<a href="<?php echo esc_url( $item_link_url ); ?>"><?php echo wp_kses( $item_title, $item_allowed_html ); ?></a>
			<?php else : ?>
				<?php echo wp_kses( $item_title, $item_allowed_html ); ?>
			<?php endif; ?>
			</h3>
			<p><?php echo esc_html( $item_description ); ?></p>
		</hgroup>
	</div>
</article>
