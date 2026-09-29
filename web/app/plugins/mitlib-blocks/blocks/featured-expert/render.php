<?php
/**
 * Server-side rendering for the featured expert item.
 *
 * @package MITlib Blocks
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

// Look up the librarian chosen in the block editor's "Featured Expert" panel.
$featured_expert    = null;
$featured_expert_id = absint( $attributes['expertId'] ?? 0 );
if ( $featured_expert_id ) {
	$maybe_expert = get_post( $featured_expert_id );
	if ( $maybe_expert && 'experts' === $maybe_expert->post_type && 'publish' === $maybe_expert->post_status ) {
		$featured_expert = $maybe_expert;
	}
}

// Fallback used when no librarian has been selected in the block editor.
$default_expert = array(
	'name'       => 'Alejandro Paz',
	'first_name' => 'Alejandro',
	'url'        => 'https://libguides.mit.edu/profiles/apaz',
	'image'      => 'https://libapps.s3.amazonaws.com/accounts/349/images/apaz-100x100.jpg',
	'excerpt'    => 'Librarian for Energy and Environment',
);

// If we have a valid expert, use those values. If not, use the fallback values.
if ( $featured_expert ) {
	$expert_name       = get_the_title( $featured_expert );
	$expert_first_name = strtok( $expert_name, ' ' );
	$expert_url        = get_post_meta( $featured_expert->ID, 'expert_url', true );
	$expert_image      = get_the_post_thumbnail_url( $featured_expert, 'thumbnail' );
	$expert_excerpt    = get_the_excerpt( $featured_expert );
} else {
	$expert_name       = $default_expert['name'];
	$expert_first_name = $default_expert['first_name'];
	$expert_url        = $default_expert['url'];
	$expert_image      = $default_expert['image'];
	$expert_excerpt    = $default_expert['excerpt'];
}

// Generate the strings for alt text and help link text.
$expert_alt_text       = 'Headshot of ' . $expert_name;
$expert_help_link_text = 'How can ' . $expert_first_name . ' help you?';

?>
<article class="featured-item side-by-side">
	<span class="item-type spotlight">Spotlight</span>
	<?php if ( $expert_image ) : ?>
	<img src="<?php echo esc_url( $expert_image ); ?>" alt="<?php echo esc_attr( $expert_alt_text ); ?>" />
	<?php endif; ?>
	<div class="featured-item-content">
		<hgroup>
			<h3><a href="<?php echo esc_url( $expert_url ); ?>"><?php echo esc_html( $expert_name ); ?></a></h3>
			<div>
				<p><?php echo esc_html( $expert_excerpt ); ?></p>
			</div>
		</hgroup>
		<a class="arrow-right" href="<?php echo esc_url( $expert_url ); ?>">
			<?php echo esc_html( $expert_help_link_text ); ?>
		</a>
	</div>
</article>
