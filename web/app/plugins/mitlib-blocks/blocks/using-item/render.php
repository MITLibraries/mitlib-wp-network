<?php
/**
 * Server-side rendering for a single featured item.
 *
 * @package MITlib Blocks
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

$item_title       = $attributes['title'] ?? '';
$item_description = $attributes['description'] ?? '';
$item_link_url    = $attributes['linkUrl'] ?? '';
$item_icon        = $attributes['icon'] ?? '';

$item_allowed_html = array();
?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_block_wrapper_attributes() escapes the generated attributes. ?> >
	<i
		class="fa-light fa-<?php echo esc_attr( $item_icon ); ?>"
		aria-hidden="true"
		role="img"
	></i>
	<div class="option-box-content">
		<h3>
			<?php if ( $item_link_url ) : ?>
				<a href="<?php echo esc_url( $item_link_url ); ?>"><?php echo wp_kses( $item_title, $item_allowed_html ); ?></a>
			<?php else : ?>
				<?php echo wp_kses( $item_title, $item_allowed_html ); ?>
			<?php endif; ?>
		</h3>
		<p><?php echo esc_html( $item_description ); ?></p>
	</div>
</div>
