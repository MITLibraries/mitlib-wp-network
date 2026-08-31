<?php
/**
 * Template Name: Home Page v2
 *
 * This template builds the site homepage. It it applied to a Page record, but
 * no fields from that Page are ever displayed.
 *
 * @package MITlib_Parent
 * @since 0.11
 */

namespace Mitlib\Parent;

get_header( 'v2' ); ?>

<main id="content" class="block-editor">

	<?php
	while ( have_posts() ) :
		the_post();

		// This function pulls in whatever blocks you design in the admin dashboard
		the_content(); 

	endwhile;
	?>

</main>

<?php
	get_footer( 'v2' );
?>
