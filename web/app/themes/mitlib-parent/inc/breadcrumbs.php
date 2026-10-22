<?php
/**
 * Breadcrumb template
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

?>
<div class="breadcrumbs--better hidden-phone group" role="navigation" aria-label="breadcrumbs">
	<div class="breadcrumbs-inner"> 
		<span><a href="/">Libraries home</a></span>
		<?php better_breadcrumbs(); ?>
	</div>
</div>
