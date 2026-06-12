<?php
/**
 * Template Name: Home Page v2
 *
 * This template builds the site homepage. It it applied to a Page record, but
 * no fields from that Page are ever displayed.
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

get_header( 'v2' ); ?>

<main id="content">

	<section>
		<div class="content-wrapper">
			Search box
		</div>
	</section>
	<section>
		<div class="content-wrapper">
			Hours
		</div>
	</section>	
	<section>
		<div class="content-wrapper">
			Getting started
		</div>
	</section>
	<section>
		<div class="content-wrapper">
			Featured
		</div>
	</section>
	<section>
		<div class="content-wrapper">
			Collection
		</div>
	</section>

</main>

<?php
	get_footer( 'v2' );
?>
