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
	<?php betterChildBreadcrumbs(); ?>
</div>
