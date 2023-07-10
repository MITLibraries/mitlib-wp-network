<?php
/**
 * Breadcrumb template for internal (non-front) pages.
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

?>
<div class="betterBreadcrumbs hidden-phone" role="navigation" aria-label="breadcrumbs">
	<span><a href="/">Libraries home</a></span>
	<span><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo(); ?></a></span>
	<span>
	<?php
	$cats = array();

	foreach ( get_the_category( $post_id ) as $cat ) {
		$categ = get_category( $cat );
		array_push( $cats, $categ->name );
	}

	$post_categories = implode( ', ', $cats );

	echo esc_html( $post_categories );
	?>
	</span>
</div>
