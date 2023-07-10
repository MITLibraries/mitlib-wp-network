<?php
/**
 * The template used for displaying page content for pages in the shortrumb category in page-standard.php
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

?>

<?php if ( in_category( 'has-menu' ) ) { ?>
	<?php get_template_part( 'inc/menu', 'secondary' ); ?>
<?php } ?>

<div class="main-content content-main">
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</div>
