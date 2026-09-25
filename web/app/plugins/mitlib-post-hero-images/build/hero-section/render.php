<?php
/**
 * Server-side rendering for the hero section block.
 *
 * @package MITlib Post Hero Images
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

// Look up the hero image chosen in the block editor's "Hero Image" panel.
$hero_image    = null;
$hero_image_id = absint( $attributes['heroImageId'] ?? 0 );
if ( $hero_image_id ) {
	$maybe_hero_image = get_post( $hero_image_id );
	if ( $maybe_hero_image && 'hero_images' === $maybe_hero_image->post_type && 'publish' === $maybe_hero_image->post_status ) {
		$hero_image = $maybe_hero_image;
	}
}

// Fallback used when no hero image has been selected in the block editor.
$default_hero_image = array(
	'image_url'          => 'https://libraries.mit.edu/app/uploads/2026/09/hero-image-noise-reduction.jpg',
	'alt_text'           => 'Graphic illustration of a spiral in purple, black, and white.',
	'citation'           => 'from the Muriel Cooper personal archives',
	'citation_link_text' => 'Muriel Cooper personal archives',
	'citation_url'       => 'https://archivesspace.mit.edu/repositories/2/resources/244',
);

// If we have a valid hero image, use those values. If not, use the fallback values.
if ( $hero_image ) {
	$featured_image_id = get_post_thumbnail_id( $hero_image );
	$hero_image_url    = get_the_post_thumbnail_url( $hero_image, 'full' );
	$hero_alt_text     = get_post_meta( $featured_image_id, '_wp_attachment_image_alt', true );
	$hero_citation     = get_post_meta( $hero_image->ID, 'citation', true );
	$hero_link_text    = trim( get_post_meta( $hero_image->ID, 'citation_link_text', true ) );
	$hero_citation_url = get_post_meta( $hero_image->ID, 'citation_url', true );
} else {
	$hero_image_url    = $default_hero_image['image_url'];
	$hero_alt_text     = $default_hero_image['alt_text'];
	$hero_citation     = $default_hero_image['citation'];
	$hero_link_text    = $default_hero_image['citation_link_text'];
	$hero_citation_url = $default_hero_image['citation_url'];
}

// Wrap the matching substring of the citation in a link, if a URL is set.
$escaped_citation = esc_html( $hero_citation );
if ( $hero_citation_url && $hero_link_text && false !== strpos( $hero_citation, $hero_link_text ) ) {
	$escaped_link_text = esc_html( $hero_link_text );
	$anchor            = '<a href="' . esc_url( $hero_citation_url ) . '">' . $escaped_link_text . '</a>';
	$hero_credit       = str_replace( $escaped_link_text, $anchor, $escaped_citation );
} elseif ( $hero_citation_url ) {
	$hero_credit = '<a href="' . esc_url( $hero_citation_url ) . '">' . $escaped_citation . '</a>';
} else {
	$hero_credit = $escaped_citation;
}

?><section id="hero">
	<div class="hero-bg" role="img" aria-label="<?php echo esc_attr( $hero_alt_text ); ?>" style="background-image: url(<?php echo esc_url( $hero_image_url ); ?>);"></div>
	<div class="overlay">	
		<div class="content-wrapper">
			<div class="hero-content">
				<h1><?php echo esc_html( $attributes['heading'] ); ?></h1>

				<?php
					// Search widget area for homepage. Uses Unified Search v2 for this page's search form.
				if ( is_active_sidebar( 'sidebar-search' ) ) :
					dynamic_sidebar( 'sidebar-search' );
					endif;
				?>
				
			</div>
			<?php if ( $hero_credit ) : ?>
			<span class="hero-image-credit">
				<?php
				// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- built from esc_html()/esc_url() pieces above.
				echo $hero_credit;
				// phpcs:enable -- resume normal scanning.
				?>
			</span>
			<?php endif; ?>
		</div>
	</div>
</section>