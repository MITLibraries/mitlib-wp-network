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
				?>

				<div class="entry-content">

					<?php the_content(); ?>

					<table>
						<thead>
							<tr>
								<th scope="col">Field</th>
								<th scope="col">Value</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Audio</td>
								<td><?php the_field( 'audio' ); ?></td>
							</tr>
							<tr>
								<td>Transcript</td>
								<td><?php the_field( 'transcript' ); ?></td>
							</tr>
							<tr>
								<td>CD</td>
								<td><?php the_field( 'cd' ); ?></td>
							</tr>
							<tr>
								<td>Print</td>
								<td><?php the_field( 'print' ); ?></td>
							</tr>
							<tr>
								<td>YouTube</td>
								<td><?php the_field( 'youtube-id' ); ?></td>
							</tr>
							<tr>
								<td>3Play</td>
								<td><?php the_field( '3play-id' ); ?></td>
							</tr>
							<tr>
								<td>Chapters</td>
								<td><?php the_field( 'chapters' ); ?></td>
							</tr>
						</tbody>						
					</table>
					
				</div>

			<?php endwhile; ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>
