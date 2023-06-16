<?php
/**
 * This template displays a single Interview.
 *
 * @package MITlib_Child
 * @since 0.2.0
 */

namespace Mitlib\PostTypes;

get_header( 'child' ); // Should be 'moh'?

get_template_part( 'inc/breadcrumbs', 'child' );

// Define the set of expected markup (tags and attributes) for some rich text fields.
$allowed_html = array(
	'em' => array(),
	'strong' => array(),
);
$allowed_thumbnail = array(
	'img' => array(
		'alt' => array(),
		'class' => array(),
		'height' => array(),
		'src' => array(),
		'width' => array(),
	),
);

// Populate variables for this Interview.
$interview_id = get_the_id();

// Look up Interviewee record tied to this Interview.
$interviewees = get_field( 'interviewee' );

if ( $interviewees ) {
	// There should only be one Interviewee, but a loop is still necessary it seems.
	foreach ( $interviewees as $interviewee ) {
		$interviewee_music = get_field( 'music-professional-work', $interviewee->ID );
		$interviewee_mit = get_field( 'mit-affiliation', $interviewee->ID );

		$interviewee_thumbnail = '<img src="' . get_stylesheet_directory_uri() . '/images/no-photo.png" alt="No Photo">';
		if ( get_the_post_thumbnail( $interviewee->ID, 'thumbnail' ) ) {
			$interviewee_thumbnail = get_the_post_thumbnail( $interviewee->ID, 'thumbnail' );
		}

		$categories = get_the_category( $interviewee );

		$tags = get_the_tags( $interviewee );
	}
}

/**
 * Look up all Interviews with this Interviewee. This will be filtered further
 * during rendering below.
 */
$query = array(
	'post_type' => 'interview',
	'posts_per_page' => 10,
	'orderby' => 'post_date',
	'order' => 'ASC',
	'post_status' => 'publish',
	'meta_key' => 'interviewee',
	'meta_query' => array(
		'key' => 'interviewee',
		'value' => $interviewee->ID,
		'compare' => 'LIKE',
	),
);
$related = new \WP_Query( $query );
?>

<div id="stage" class="inner" role="main">
	
	<?php get_template_part( 'inc/title-banner' ); ?>

	<div class="title-page flex-container">
		<h3 class="title-sub"><?php the_title(); ?></h3>
	</div>

	<div id="content" class="content">

		<div class="content-main main-content">
			
			<?php
			while ( have_posts() ) : 
				the_post();
				$audio = get_field( 'audio' );
				$transcript = get_field( 'transcript' );
				$cd = get_field( 'cd' );
				$print = get_field( 'print' );
				$chapters = get_field( 'chapters' );

				$threeplay_url = 'https://static.3playmedia.com/p/projects/10129/files/' . get_field( '3play-id' ) . '/plugins/10862.js';
				?>

				<div id="titlebar" class="info-meta group flex-container">
					<div class="post-thumbnail flex-item">
						<?php echo wp_kses( $interviewee_thumbnail, $allowed_thumbnail ); ?>
					</div>
					<div class="flex-item">
						<ul class="list-inline categories">
							<li><i class="icon-folder-close"></i></li>
							<?php
							foreach ( $categories as $category ) {
								echo '<li>' . esc_html( $category->name ) . '</li>';
							}
							?>
						</ul>
						<ul class="list-inline tags">
							<li><i class="icon-tag"></i></li>
							<?php
							foreach ( $tags as $tag ) {
								echo '<li>' . esc_html( $tag->name ) . '</li>';
							}
							?>
						</ul>
						<ul class="list-inline links">
							<?php
							if ( $audio ) {
								echo '<li><i class="icon-download"></i> <a href="' . esc_url( $audio ) . '">Download (MP3)</a></li>';
							}
							if ( $transcript ) {
								echo '<li><i class="icon-file"></i> <a href="' . esc_url( $transcript ) . '">Transcript (PDF)</a></li>';
							}
							if ( $cd ) {
								echo '<li><span class="dashicons dashicons-album"></span> <a href="' . esc_url( $cd ) . '">CD available in the library</a></li>';
							}
							if ( $print ) {
								echo '<li><i class="icon-book"></i> <a href="' . esc_url( $print ) . '">Print transcript available in the library</a></li>';
							}
							?>
						</ul>
					</div>
				</div>

				<section class="expandable group" role="region">
					<h3><a href="#">Biography &amp; other information</a></h3>
					<div id="biography" class="content" style="display: none;">
						<h2 class="heading"><?php echo esc_html( $interviewee->post_title ); ?></h2>
						<p class="muted"><strong>
							<?php echo esc_html( $interviewee_mit ); ?><br>
							<?php echo esc_html( $interviewee_music ); ?>
						</strong></p>
						<p><?php echo wp_kses( $interviewee->post_content, $allowed_html ); ?></p>
					</div>
				</section>

				<div id="interview" class="entry-content flex-container">

					<?php if ( get_field( 'youtube-id' ) ) { ?>
						<div id="playerWrap" class="wrap-videoplayer flex-item">
							<iframe frameborder="0" height="300" id="myytplayer" src="https://www.youtube.com/embed/<?php echo esc_attr( the_field( 'youtube-id' ) ); ?>?enablejsapi=1" type="text/html" width="440" allowfullscreen></iframe>
							<script type="text/javascript" src="<?php echo esc_url( $threeplay_url ); ?>"></script>
						</div>
					<?php } ?>

					<div id="chapterWrap" class="flex-item">

						<?php if ( $chapters ) { ?>
							<h3>Contents</h3>
							<table class="chapters">
								<thead>
									<tr>
										<th>Title</th>
										<th>Time</th>
									</tr>
								</thead>
								<tbody>
								<?php
								foreach ( $chapters as $chapter ) {
									?>
									<tr>
										<td><?php echo esc_html( $chapter['chapter'] ); ?></td>
										<td><?php echo esc_html( $chapter['time'] ); ?></td>
									</tr>
									<?php
								}
								?>
								</tbody>
							</table>
						<?php } ?>

						<?php
						/**
						 * Because the "related" query will return this record,
						 * which gets filtered out in the loop, we have to check
						 * for whether there is more than one record.
						 *
						 * Ideally the query itself would skip this record, but
						 * that isn't the case right now.
						 */
						if ( $related->have_posts() && $related->post_count > 1 ) {
							echo '<h3>More interviews</h3>';
							echo '<ul class="more-interviews">';
							while ( $related->have_posts() ) {
								$related->the_post();
								if ( get_the_id() != $interview_id ) {
									echo '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
								}
							};
							echo '</ul>';
						};
						?>
					</div>

				</div>

			<?php endwhile; ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>
