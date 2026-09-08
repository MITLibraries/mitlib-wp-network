<?php
/**
 * Server-side rendering for the featured and events section block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */
?><section id="featured-and-events">
	<div class="content-wrapper">
		<div class="featured-content">
			<h2><?php echo esc_html( $attributes['heading'] ); ?></h2>
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
					<img src="https://libapps.s3.amazonaws.com/accounts/349/images/apaz-100x100.jpg" alt="Headshot of Alejandro Paz" />
					<div class="featured-item-content">
						<hgroup>
							<h3><a href="https://libguides.mit.edu/profiles/apaz">Alejandro Paz</a></h3>
							<div>
								<p>Librarian for Energy and Environment</p>
							</div>
						</hgroup>
						<a class="arrow-right" href="https://libguides.mit.edu/profiles/apaz">How can Alejandro help you?</a>
					</div>
				</article>
				<article class="featured-item side-by-side">
					<span class="item-type news">News</span>
					<img src="https://libraries.mit.edu/app/uploads/2026/08/XKQoSUbi-1.png" alt="A white, two-column locker with a digital screen and text reading &quot;MIT Libraries, Pickup Locker&quot;"/>
					<div class="featured-item-content">
						<hgroup>
							<h3><a href="https://libraries.mit.edu/news/coming-soon-self-service-lockers/44582/">Coming soon: Self-service lockers</a></h3>
							<p>Pick up and drop off library items 24 hours a day, seven days a week</p>
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
			// Pull upcoming events from the News site (blog 4), prioritizing pinned events.
			$news_site_id = 4;
			switch_to_blog( $news_site_id );

			$today = date( 'Ymd' );

			$events_args = array(
				'posts_per_page'      => 20,
				'post_type'           => 'post',
				'post_status'         => 'publish',
				'orderby'             => 'meta_value',
				'meta_key'            => 'event_date',
				'order'               => 'ASC',
				'ignore_sticky_posts' => 1,
				'meta_query'          => array(
					array(
						'key'     => 'event_date',
						'value'   => $today,
						'compare' => '>=',
					),
				),
			);

			$events_query = new WP_Query( $events_args );

			$featured_events = array();
			$regular_events  = array();

			if ( $events_query->have_posts() ) :
				while ( $events_query->have_posts() ) :
					$events_query->the_post();
					$custom = get_post_custom();

					if ( ! isset( $custom['is_event'][0] ) || $custom['is_event'][0] !== '1' ) {
						continue;
					}

					$event_date_raw = isset( $custom['event_date'][0] ) ? $custom['event_date'][0] : '';
					if ( ! $event_date_raw || $event_date_raw < $today ) {
						continue;
					}

					$event_data = array(
						'title'      => ! empty( $custom['homepage_post_title'][0] ) ? $custom['homepage_post_title'][0] : get_the_title(),
						'url'        => ! empty( $custom['calendar_url'][0] ) ? $custom['calendar_url'][0] : get_the_permalink(),
						'event_date' => $event_date_raw,
						'start_time' => isset( $custom['event_start_time'][0] ) ? $custom['event_start_time'][0] : '',
						'end_time'   => isset( $custom['event_end_time'][0] ) ? $custom['event_end_time'][0] : '',
						'location'   => isset( $custom['event_location'][0] ) ? $custom['event_location'][0] : '',
						'excerpt'    => get_the_excerpt(),
					);

					if ( ! empty( $custom['pin_event_on_homepage'][0] ) && $custom['pin_event_on_homepage'][0] === '1' ) {
						$featured_events[] = $event_data;
					} else {
						$regular_events[] = $event_data;
					}
				endwhile;
				wp_reset_postdata();
			endif;

			if ( count( $featured_events ) >= 2 ) {
				$display_events = array_slice( $featured_events, 0, 2 );
			} elseif ( count( $featured_events ) === 1 ) {
				$display_events = array_merge( $featured_events, array_slice( $regular_events, 0, 1 ) );
				usort( $display_events, function ( $a, $b ) {
					return strcmp( $a['event_date'], $b['event_date'] );
				} );
			} else {
				$display_events = array_slice( $regular_events, 0, 2 );
			}

			if ( count( $display_events ) > 0 ) {
				foreach ( $display_events as $event ) :
					$event_dt    = DateTime::createFromFormat( 'Ymd', $event['event_date'] );
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
				?>

				<div class="no-events">
					<h3>Nothing scheduled at the moment</h3>
					<p>Check back later or <a href="/news/subscribe">sign up for our newsletter</a> to stay on top of new events</p>
				</div>

			<?php
			}

			restore_current_blog();
			?>
		</div>
	</div>
</section>
