<?php
/**
 * Template Name: Study Spaces Template
 *
 * This template constructs a query for Location records which have the flag set
 * indicating that they have spaces for studying.
 *
 * While the template includes space for the title and body of the host page to
 * be rendered, these fields are a minor part of the overall display.
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

$gStudy24Url = '/study/24x7/';

get_header(); ?>

		<?php get_template_part( 'inc/breadcrumbs' ); ?>

		<div id="stage" class="inner" role="main">
			<div class="title-page flex-container">
				<h1><?php the_title(); ?></h1>
				<div class="extraInfo">
					<a href="/hours/">See all library hours <i class="fa fa-arrow-right"></i></a>
				</div>
			</div>
			
			<?php
			if ( in_category( 'has-menu' ) ) {
				get_template_part( 'inc/menu', 'secondary' );
			}
			?>
						
			<div id="content" class="content has-sidebar">
				<div class="main-content content-main">
					<?php the_content(); ?>
					<ul class="list--study-spaces">
						<?php
							$args = array(
								'post_type' => 'location',
								'meta_key' => 'study_location',
								'meta_compare' => '==',
								'meta_value' => 1,
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC',

							);
							$subList = new \WP_Query( $args );

							?>
											
						<?php
						while ( $subList->have_posts() ) :
							$subList->the_post();
							?>
							<?php
							$locationId = get_the_ID();
							$slug = $post->post_name;

							$subject = get_field( 'subject' );
							$phone = get_field( 'phone' );
							$building = get_field( 'building' );
							$spaces = get_field( 'group_spaces' );
							$individual = get_field( 'individual_spaces' );

							$equipment = get_field( 'equipment' );
							$expert = get_field( 'expert' );

							$title1 = get_field( 'tab_1_title' );
							$subtitle1 = get_field( 'tab_1_subtitle' );
							$content1 = get_field( 'tab_1_content' );

							$title2 = get_field( 'tab_2_title' );
							$subtitle2 = get_field( 'tab_2_subtitle' );
							$content2 = get_field( 'tab_2_content' );

							$studyImage = get_field( 'study_space_image' );

							$study24 = get_field( 'study_24' );
							$reserveText = get_field( 'reserve_text' );
							if ( $reserveText == '' ) {
								$reserveText = 'Reserve Group Study Space';
							}
							$reserveUrl = get_field( 'reserve_url' );



							$displayPage = get_field( 'display_page' );
							$pageID = $displayPage->ID;
							$pageLink = get_permalink( $pageID );

							$description = get_the_content();

							$temp = $post;
							$post = $temp;


							?>
							<li class="study-space">
								<div class="study-space-image" style="background-image: url(<?php echo esc_url( $studyImage ); ?>);"></div>
								<div class="study-space--content">
									<div class="study-space--header ss-item">
										<h3><a href="<?php echo esc_url( $pageLink ); ?>"><?php echo esc_html( the_title() ); ?></a></h3>
										<div class="description">
											<?php
											// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- This field will need careful inspection and probably wp_kses().
											echo $description;
											// phpcs:enable
											?>
										</div>
										<?php if ( $reserveUrl != '' ) : ?>
												<a class="reserve hidden-phone" href="<?php echo esc_url( $reserveUrl ); ?>"><?php echo esc_html( $reserveText ); ?></a>
										<?php endif; ?>
										<?php if ( $study24 == 1 ) : ?>
											<span> | </span><a class="space247 hidden-phone" href="<?php echo esc_url( $gStudy24Url ); ?>" alt="This location contains one or more study spaces available 24 hours a day, seven days a week. Click the link for more info." title="Study 24/7">Study 24/7</a>
										<?php endif; ?>
									</div>
									<div class="study-space--info">
										<div class="ss-1 ss-item">
											<h4><?php echo esc_html( $subject ); ?></h4>
											<div class="sub">
												<?php if ( $phone != '' ) : ?>
													<?php echo esc_html( $phone ); ?><br/>
												<?php endif; ?>
												Show on map: <br><a href="/locations/#!<?php echo esc_url( $slug ); ?>"><?php echo esc_html( $building ); ?></a><br/>
												<?php if ( get_the_title() !== 'Information Intersection at Stata Center' ) : ?>
													<span class="hours">Today's hours:<br/>
													<span data-location-hours="<?php the_title(); ?>"></span></span>
													<?php
													endif;
												if ( $reserveUrl != '' ) :
													?>
												<a class="mobileReserve visible-phone" href="<?php echo esc_url( $reserveUrl ); ?>"><?php echo esc_html( $reserveText ); ?></a>
												<?php endif; ?>
											</div>
										</div>

										<?php if ( $individual != '' ) : ?>
										<div class="ss-2 ss-item">
											<h4>Total seats</h4>
											<?php
											// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- This field will need careful inspection and probably wp_kses().
											echo $individual;
											// phpcs:enable
											?>
										</div>
										<?php endif; ?>

										<?php if ( $spaces != '' ) : ?>
										<div class="ss-3 ss-item last">
											<h4>Group spaces</h4>
											<?php
											// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- This field will need careful inspection and probably wp_kses().
											echo $spaces;
											// phpcs:enable
											?>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</li><!-- end li.study-space -->
						<?php endwhile; // end of the loop. ?>					
					</ul><!-- end ul.list-study-spaces -->
				</div><!-- end div.main-content.content-main -->
				
				<?php get_sidebar(); ?>

			</div><!-- end div.content.has-sidebar -->		
		</div><!-- end div#stage -->	

<?php get_footer(); ?>
