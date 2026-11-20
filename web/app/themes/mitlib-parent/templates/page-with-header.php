<?php
/**
 * Template Name: Blank Canvas -  Styled Header
 *
 * This template displays a styled header with a blank single column canvas, typically used for the block editor.
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

get_header( 'v2' );
?>
<?php
	while ( have_posts() ) :
		the_post();
		$featured_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		$featured_image_alt = get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_alt', true );
		$header_subtitle = get_field( 'header_subtitle' );
		?>

	<section class="styled-header<?php echo $featured_image ? ' has-image' : ''; ?>">
		<?php if ( $featured_image ) : ?>
			<div class="styled-header__image" role="img" aria-label="<?php echo esc_attr( $featured_image_alt ); ?>" style="background-image: url('<?php echo esc_url( $featured_image ); ?>');"></div>
			<div class="styled-header__overlay" aria-hidden="true"></div>
		<?php endif; ?>
		
		<div class="styled-header__content">
			<div class="styled-header__headergroup">
				<h1><?php the_title(); ?></h1>
				<?php if ( $header_subtitle ) : ?>
					<p><?php echo esc_html( $header_subtitle ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<main id="content" class="page-template block-editor long-form-content">
		<div class="content-wrapper">
		<?php the_content(); ?>
		</div>
	</main>

<?php endwhile; ?>

<?php get_footer( 'v2'); ?>
