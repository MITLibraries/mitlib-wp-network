<?php
/**
 * The template for displaying the archive of all Interviewee records.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package MITlib_Child
 * @since 1.0.2
 */

namespace Mitlib\Child;

$interviewee_params = array(
	'posts_per_page' => -1,
	'post_type' => 'interviewee',
	'post_status' => 'publish',
	'meta_key' => 'sort-name',
	'orderby' => 'sort-name',
	'order' => 'ASC',
);
$interviewees = new \WP_Query( $interviewee_params );

$interview_params = array(
	'post_type' => 'interview',
	'posts_per_page' => -1,
	'orderby' => 'post_date',
	'order' => 'ASC',
	'post_status' => 'publish',
);
$interviews = new \WP_Query( $interview_params );
?>

<?php get_header( 'child' ); ?>

<?php get_template_part( 'inc/breadcrumbs', 'child' ); ?>

<div id="stage" class="inner" role="main">

	<?php get_template_part( 'inc/title-banner' ); ?>

	<div id="content" class="content">

		<div class="content-main main-content">

			<?php if ( $interviewees->have_posts() ) { ?>

				<div class="entry-content">
					<h1>Index of interviewees</h1>

					<div class="table">
						<div class="table-row table-head">
							<div class="table-cell"><span>Photo</span></div>
							<div class="table-cell"><span>Name</span></div>
							<div class="table-cell"><span>MIT affiliation</span></div>
							<div class="table-cell"><span>Music / professional work</span></div>
							<div class="table-cell"><span>Interview dates</span></div>
						</div>

					<?php
					while ( $interviewees->have_posts() ) {
						$interviewees->the_post();
						$record_id = get_the_ID();
						$interviewee_name = get_the_title();
						$affiliation = get_field( 'mit-affiliation' );
						$work = get_field( 'music-professional-work' );
						?>

						<div class="table-row">
							<div class="table-cell">
								<?php
								if ( has_post_thumbnail() ) {
									echo '<span class="table-value-only">';
									the_post_thumbnail( 'small' );
									echo '</span>';
								} else {
									echo '<span class="table-value-only null-image">&nbsp;</span>';
								}
								?>
							</div>
							<div class="table-cell"><span class="table-value-only record-title"><strong><?php the_title(); ?></strong></span></div>
							<div class="table-cell"><span class="table-label">MIT affiliation</span><span class="table-value"><?php echo esc_html( $affiliation ); ?></span></div>
							<div class="table-cell"><span class="table-label">Music / professional work</span><span class="table-value"><?php echo esc_html( $work ); ?></span></div>
							<div class="table-cell">
								<span class="table-label">Interview dates</span>
								<?php
								if ( $interviews->have_posts() ) {
									echo '<ul class="table-value">';
									while ( $interviews->have_posts() ) {
										$interviews->the_post();
										$interview_title = get_the_title();
										if ( str_contains( $interview_title, $interviewee_name ) ) {
											echo '<li><a href="' . esc_url( get_permalink() ) . '">';
											echo get_the_date( 'n/j/Y' );
											echo '</a></li>';
										}
									};
									echo '</ul>';
								};
								?>
							</div>
						</div>
					<?php } ?>
					</div> <!-- end div.table -->

				</div> <!-- end div.entry-content -->

			<?php } ?>
		</div>

	</div>

</div>

<?php get_footer(); ?>
