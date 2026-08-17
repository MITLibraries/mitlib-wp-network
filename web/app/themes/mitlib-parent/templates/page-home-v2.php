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

<main id="content">
	<section id="hero" role="img" aria-label="Two notebooks opened to show yellow graph paper; the top one has a black and white photo of a boat crew, and the bottom one shows handwritten text." style="background-image: url(https://libraries.mit.edu/app/uploads/2026/07/hero-image-edgerton.png);">
	<div class="overlay">	
		<div class="content-wrapper">
				<div class="hero-content">
					<h1>Welcome to the MIT Libraries</h1>

					<?php
						// Search widget area for homepage. Uses Unified Search v2 for this page's search form.
						if ( is_active_sidebar( 'sidebar-search' ) ) :
							dynamic_sidebar( 'sidebar-search' );					
						endif; 
					?>
					
				</div>
				<span class="hero-image-credit">from the <a href="https://archivesspace.mit.edu/repositories/2/resources/603">Harold E. Edgerton papers</a></span>
			</div>
		</div>
	</section>

	<?php //get_template_part( 'inc/alert-local' ); ?>

	<section id="todays-hours">
		<div class="content-wrapper">
			<h2>Today's hours</h2>
			<ol class="hours-list">
				<li>
					<span class="library-name"><a class="link-no-underline" href="/hayden">Hayden Library</a></span>
					<span class="library-hours"><span data-location-hours="Hayden Library"></span></span>
					<span class="library-study">
						<i class="fa-light fa-moon" aria-hidden="true" role="img"></i>
						24/7 study
					</span>
				</li>
				<li class="hour-rotch">
					<span class="library-name"><a class="link-no-underline" href="/rotch">Rotch Library</a></span>
					<span class="library-hours"><span data-location-hours="Rotch Library"></span></span>
					<span class="library-study">
						<i class="fa-light fa-moon" aria-hidden="true" role="img"></i>
						24/7 study
					</span>
				</li>				
				<li class="hour-barker">
					<span class="library-name"><a class="link-no-underline" href="/barker">Barker Library</a></span>
					<span class="library-hours"><span data-location-hours="Barker Library"></span></span>
					<span class="library-study">
						<i class="fa-light fa-moon" aria-hidden="true" role="img"></i>
						24/7 study
					</span>
				</li>
				<li class="hour-lewis">
					<span class="library-name"><a class="link-no-underline" href="/music">Lewis Music Library</a></span>
					<span class="library-hours"><span data-location-hours="Lewis Music Library"></span></span>
					<span class="library-study"></span>
				</li>						
			</ol>
			<a href="/hours" class="link-on-dark">See more locations and hours</a>
		</div>
	</section>	
	<section id="using-the-libraries">
		<div class="content-wrapper">
			<h2>Using the Libraries</h2>
			<div class="box-wrapper">
			<div class="option-boxes">
				<div>
					<i class="fa-light fa-lightbulb" aria-hidden="true" role="img"></i>
					<div class="option-box-content">
						<h3><a href="/study">Find a study space</a></h3>
						<p>Quiet and group spaces—many available 24/7</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-file-alt" aria-hidden="true" role="img"></i>
					<div class="option-box-content">
						<h3><a href="/get-materials">Learn how to get materials</a></h3>
						<p>Find, request and get articles, books, and more</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-book" aria-hidden="true" role="img"></i>
					<div class="option-box-content">
						<h3><a href="/experts">Discover guides &amp; librarians</a></h3>
						<p>Resource and class guides with experts for every subject</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-database" aria-hidden="true" role="img"></i>
					<div class="option-box-content">
						<h3><a href="/data-services">Find and manage data</a></h3>
						<p>Get support from creating and visualizing to using and sharing data</p>
					</div>
				</div>												
			</div>
			<div class="ask-us-box">
					<i class="fa-light fa-messages-question" aria-hidden="true" role="img"></i>
					<div class="option-box-content">
						<h3>Ask Us</h3>
						<p>Get help via email, live chat with staff, and appointments</p>
						<div class="ask-us-links">
							<div id="libchat_fa6edc50fe81603743870ca1772bc5b2e7e121436b62ba7da331b9dcabf289c0"></div>
							<a href="/ask">All help options</a>						
					</div>
			</div>
		</div>
	</section>
	<section id="featured-and-events">
		<div class="content-wrapper">
			<div class="featured-content">
				<h2>Featured</h2>
				<div class="featured-items count-6">
					<article class="featured-item">
						<span class="item-type spotlight">Spotlight</span>
						<img src="https://libraries.mit.edu/app/uploads/2026/07/0fBLLWk0.jpeg" alt="A seated audience watches a man and a woman standing at a podium; a slide on the wall behind them reads, 'Democratizing Access to Climate Data.'" />
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/opendata/open-data-mit-home/mit-prize/">2026 MIT Prize for Open Data</a></h3>
								<p>Nominate an MIT researcher for the $2,500 prize</p>
							</hgroup>
						</div>
					</article>					
					<article class="featured-item side-by-side">
						<span class="item-type spotlight">Spotlight</span>
						<img src="https://d2jv02qf7xgjwx.cloudfront.net/accounts/353/images/smbrown1-100x100.jpg" alt="Headshot of Sabrina Brown" />
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libguides.mit.edu/profiles/smbrown1">Sabrina Brown</a></h3>
								<div>
									<p>Biosciences Librarian</p>
									<p>Liaison, Instruction, and Reference Services</p>
								</div>
							</hgroup>
							<a class="arrow-right" href="https://libguides.mit.edu/profiles/smbrown1">How can Sabrina help you?</a>
						</div>
					</article>
					<article class="featured-item side-by-side">
						<span class="item-type news">News</span>
						<img src="https://libraries.mit.edu/app/uploads/sites/4/2026/06/Rotch_Ext-Night-Hzntl-624x483.jpg" alt="The exterior of Rotch Library at dusk bathed in purple light. Book stacks are visible on multiple floors through the windows."/>
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/news/future-of-rotch-library-begins-to-take-shape/44423/">Future of Rotch Library begins to take shape</a></h3>
								<p>Reimagining spaces for teaching, studying, and data services</p>
							</hgroup>
						</div>
					</article>						
					<article class="featured-item">
						<span class="item-type service">Service</span>
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/about/service-updates/">Service updates</a></h3>
								<p>The latest information about access to library collections, spaces, and services</p>
							</hgroup>
						</div>
					</article>
					<article class="featured-item">
						<span class="item-type service">Service</span>
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/scholarly/">Learn about your options and rights in scholarly publishing</a></h3>
								<p>Including open access, copyright, and research funder requirements</p>
							</hgroup>
						</div>
					</article>																	
					<article class="featured-item">
						<span class="item-type resource">Resource</span>
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libguides.mit.edu/libkey/nomad">Quicker access to journal articles</a></h3>
								<p>The LibKey Nomad browser extension instantly checks for full-text access to articles as you browse the web</p>
							</hgroup>
						</div>
					</article>									
				</div>
			</div>
			<div class="events">
				<div class="events-header">
					<div class="events-header-title-paragraph">
					<h2>Events &amp; Workshops</h2>
					<p>Featured classes, workshops, and speaker events</p>
					</div>
					<a class="button secondary" href="https://libraries.mit.edu/news/events/">See all events</a>
				</div>

				<?php
					/* 
					*  EVENTS LOGIC
					*  This logic pulls the next two upcoming events from the News site and displays them on the homepage.
					*  This respects the "Featured on homepage" radio button, making sure those posts are prioritized.
					*/
				
					// Switch to the News site (blog 4) to query event posts.
					$news_site_id = 4;
					switch_to_blog( $news_site_id );

					// Query upcoming posts that have an event_date, sorted soonest-first.
					$today = date( 'Ymd' );

					$events_args = array(
						'posts_per_page'      => 20,
						'post_type'           => 'post',
						'post_status'         => 'publish',
						'orderby'             => 'meta_value',
						'meta_key'            => 'event_date',
						'order'               => 'ASC',
						'ignore_sticky_posts' => 1, // Prevents sticky posts from being pushed to the top of the order
						'meta_query'          => array( // Ensures that the event date is today or later
							array(
								'key'     => 'event_date', 
								'value'   => $today, 
								'compare' => '>=',
							),
						),
					);

					$events_query = new \WP_Query( $events_args );

					// Loop through results, filter to is_event posts, and bucket into featured vs regular.
					$featured_events = array();
					$regular_events  = array();

					if ( $events_query->have_posts() ) :
						while ( $events_query->have_posts() ) :
							$events_query->the_post();
							$custom = get_post_custom(); // store custom fields for this post in an array

							// Skip non-event posts (is_event checkbox unchecked).
							if ( ! isset( $custom['is_event'][0] ) || $custom['is_event'][0] !== '1' ) {
								continue;
							}

							// Skip events with no date or a past date.
							$event_date_raw = isset( $custom['event_date'][0] ) ? $custom['event_date'][0] : '';
							if ( ! $event_date_raw || $event_date_raw < $today ) {
								continue;
							}

							// Build event data array, preferring homepage overrides for title and URL.
							$event_data = array(
								'title'      => ! empty( $custom['homepage_post_title'][0] ) ? $custom['homepage_post_title'][0] : get_the_title(),
								'url'        => ! empty( $custom['calendar_url'][0] ) ? $custom['calendar_url'][0] : get_the_permalink(),
								'event_date' => $event_date_raw,
								'start_time' => isset( $custom['event_start_time'][0] ) ? $custom['event_start_time'][0] : '',
								'end_time'   => isset( $custom['event_end_time'][0] ) ? $custom['event_end_time'][0] : '',										
								'location'   => isset( $custom['event_location'][0] ) ? $custom['event_location'][0] : '',								
								'excerpt'    => get_the_excerpt(),
							);

							// Bucket into pinned (pin_event_on_homepage) vs regular.
							if ( ! empty( $custom['pin_event_on_homepage'][0] ) && $custom['pin_event_on_homepage'][0] === '1' ) {
								$featured_events[] = $event_data;
							} else {
								$regular_events[] = $event_data;
							}
						endwhile;
						wp_reset_postdata();
					endif;

					// Pick 2 events to display: prefer featured, backfill with regular, keep date order.
					if ( count( $featured_events ) >= 2 ) {
						$display_events = array_slice( $featured_events, 0, 2 );
					} elseif ( count( $featured_events ) === 1 ) {
						$display_events = array_merge( $featured_events, array_slice( $regular_events, 0, 1 ) );
						usort( $display_events, function( $a, $b ) {
							return strcmp( $a['event_date'], $b['event_date'] );
						} );
					} else {
						$display_events = array_slice( $regular_events, 0, 2 );
					}

					// Check if there are events to display. If there are, display them. If not, show the empty state.
					if (count($display_events) > 0) {

						// Render each event card with date, title, excerpt, time, and location.
						foreach ( $display_events as $event ) :
							$event_dt = \DateTime::createFromFormat( 'Ymd', $event['event_date'] );
							$event_month = $event_dt ? $event_dt->format( 'M' ) : '';
							$event_day   = $event_dt ? $event_dt->format( 'j' ) : '';

							$time_display = '';
							if ( $event['start_time'] ) {
								$time_display = $event['start_time'];
								if ( $event['end_time'] ) {
									$time_display .= ' &#150; ' . $event['end_time'];
								}
							}
							?>
							
							<div class="event">
								<div class="event-date">
									<span class="event-month"><?php echo esc_html( $event_month ); ?></span>
									<span class="event-day"><?php echo esc_html( $event_day ); ?></span>
									<span class="event-weekday"><?php echo esc_html( $event_dt ? $event_dt->format( 'D' ) : '' ); ?></span>
								</div>
								<div class="event-details">
									<h3><a href="<?php echo esc_url( $event['url'] ); ?>"><?php echo esc_html( mb_strimwidth( $event['title'], 0, 75, '…' ) ); ?></a></h3>
									<p><?php echo esc_html( $event['excerpt'] ); ?></p>
									<?php if ( $time_display || $event['location'] ) : ?>
									<div class="event-metadata">
										<?php if ( $time_display ) : ?>
										<span class="event-time"><i class="fa-light fa-clock" role="img" aria-label="Event time"></i><?php echo wp_kses( $time_display, array() ); ?></span>
										<?php endif; ?>
										<?php if ( $event['location'] ) : ?>
										<span class="event-location"><i class="fa-light fa-map-pin" role="img" aria-label="Event location"></i><?php echo esc_html( $event['location'] ); ?></span>
										<?php endif; ?>
									</div>
									<?php endif; ?>
								</div>
							</div>

							<?php
						endforeach;

					} else { 
						
						// Render the empty state template
						?>	

						<div class="no-events">
							<h3>Nothing scheduled at the moment</h3>
							<p>Check back later or <a href="/news/subscribe">sign up for our newsletter</a> to stay on top of new events</p>
						</div>

					<?php }

					restore_current_blog(); // returns from the News site to current for future queries
				?>
			</div>			
		</div>
	</section>
	<section id="featured-collection">
		<div class="content-wrapper">
			<div class="featured-collection-image" role="img" aria-label="Architectural elevation of a house with two gables and two chimneys by Howe, Manning and Almy Architects, dated 1927." style="background-image: url('https://libraries.mit.edu/app/uploads/2026/07/Howe-Manning-Almy-1.jpg');">
				<span class="featured-collection-tag">Exhibit</span>
			</div>
			<div class="featured-collection-content">
				<h2 class="sr">Featured Exhibit</h2>
				<p class="eyebrow">Howe, Manning & Almy Exhibit</p>
				<h3>Boston's First All-Woman Firm and the Changing Face of Architecture</h3>
				<p>Learn about the role MIT's architecture program played in supporting women in the field since the 1890s, Howe, Manning & Almy's influence on the built environment of Cambridge, and the firms ecofriendly approaches to renovation.</p>
				<a class="button secondary" title="Read more about the Howe, Manning & Almy exhibit" href="https://libraries.mit.edu/exhibits/exhibit/howe-manning-almy/">Check it out</a>
			</div>
		</div>
	</section>

</main>

<?php
	get_footer( 'v2' );
?>
