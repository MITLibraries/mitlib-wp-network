<?php
/**
 * Template Name: Standard Template
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

get_header();
?>

<div id="content">
	<?php the_title(); ?>

	<?php the_content(); ?>
</div>

<?php get_footer(); ?>
