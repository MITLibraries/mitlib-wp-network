<?php
$featured_item_type = 'Collection' === $attributes['featuredItemType'] ? 'Collection' : 'Exhibit';
$image_id           = absint( $attributes['imageId'] );
$image_url          = $attributes['imageUrl'];

if ( ! $image_id && $image_url ) {
	$image_id = attachment_url_to_postid( $image_url );
}

$image_alt = '';
if ( $image_id ) {
	$image_url = wp_get_attachment_image_url( $image_id, 'full' ) ?: $image_url;
	$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
} elseif ( 'https://libraries.mit.edu/app/uploads/2026/10/nyi_QvYE.jpeg' === $image_url ) {
	$image_alt = "A 1920s photograph of two men standing on a car and waving from the top of a building's roof.";
}
?>
<section id="featured-collection">
	<div class="content-wrapper">
		<div
			class="featured-collection-image"
			<?php if ( $image_url && $image_alt ) : ?>
				role="img"
				aria-label="<?php echo esc_attr( $image_alt ); ?>"
			<?php endif; ?>
			<?php if ( $image_url ) : ?>
				style="<?php echo esc_attr( 'background-image: url("' . esc_url( $image_url ) . '");' ); ?>"
			<?php endif; ?>
		>
			<span class="featured-collection-tag"><?php echo esc_html( $featured_item_type ); ?></span>
		</div>
		<div class="featured-collection-content">
			<h2 class="sr">Featured <?php echo esc_html( $featured_item_type ); ?></h2>
			<h3><?php echo esc_html( $attributes['title'] ); ?></h3>
			<p><?php echo esc_html( $attributes['description'] ); ?></p>
			<?php if ( $attributes['linkUrl'] ) : ?>
			<a
				class="button secondary"
				title="<?php echo esc_attr( sprintf( 'Read more about the %s %s', $attributes['title'], strtolower( $featured_item_type ) ) ); ?>"
				href="<?php echo esc_url( $attributes['linkUrl'] ); ?>"
			>
				<?php echo esc_html( $attributes['linkText'] ); ?>
			</a>
			<?php endif; ?>
		</div>
	</div>
</section>