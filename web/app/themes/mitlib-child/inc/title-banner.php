<?php
/**
 * The template for displaying a post header.
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

?>
<div class="header-section group 
<?php
if ( is_front_page() ) {
	echo 'hasImage'; }
?>
">
	<?php if ( is_front_page() ) : ?>
		<div class="child-header-tall">
			<div class="page-header-home">
				<h1 class="child-page-title"><?php bloginfo(); ?></h1>
				<?php
				// Checks to see if tagline exists.
				$description = get_bloginfo( 'description' );
				if ( ! empty( $description ) ) :
					?>
					<p class="child-tagline"><?php echo esc_html( $description ); ?></p>
					<?php
				endif;

				global $blog_id;
				$current_blog_id = $blog_id;

				$site_name = get_bloginfo( 'name' );

				// If this is the Doc Services site, switch out to main site to get location IDs.
				if ( 'Document Services' === $site_name && is_front_page() ) {
					switch_to_blog( 1 );
					get_template_part( 'inc/location' );
					switch_to_blog( $current_blog_id );
				}

				?>

			</div>

			<?php get_template_part( 'inc/header', 'image' ); ?>

		</div>

	<?php else : ?>

		<div class="child-header-short">
			<div class="page-header-internal">
				<div class="child-page-title"><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></div>
			</div>

			<?php get_template_part( 'inc/header', 'image' ); ?>

		</div>

	<?php endif; ?>
</div>

<?php get_template_part( 'inc/nav', 'child' ); ?>
