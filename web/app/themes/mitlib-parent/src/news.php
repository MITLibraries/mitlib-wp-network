<?php
/**
 * Front page news functions
 *
 * These functions are called by page-home.php, and control the loading of news
 * items from the News site (which is a separate site than the parent site which
 * will call this code).
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

$news_site_id = 4;

/**
 * This is an alternate entry point for the code, which gets called on a staff
 * template which lists all current articles which are eligible for the front
 * page.
 */
function debug_news() {
	global $news_site_id;

	echo '<!-- Loading featured news items -->';

	// Switch context to news site.
	switch_to_blog( $news_site_id );

	$pool = retrieve_pool();

	render_pool( $pool );

	// Restore context back to current site.
	restore_current_blog();
}

/**
 * This is the main entry point for this code, which gets called on the homepage
 * template.
 */
function load_news() {
	global $news_site_id;

	echo '<!-- Loading featured news items -->';

	// Switch context to news site.
	switch_to_blog( $news_site_id );

	$pool = retrieve_pool();

	if ( count( $pool ) != 2 ) {
		// If there are anything other than two items in the pool, then we...
		// Summarize the pool and determine query type.
		$query_type = summarize_pool( $pool );

		// Build the appropriate item pool.
		if ( 'two' === $query_type ) {
			$pool = query_pool_two();
		} else {
			$pool = query_pool_one();
		}
	}

	if ( 0 == count( $pool ) ) {
		echo 'No front page news posts found.';
	}

	render_pool( $pool );

	// Restore context back to current site.
	restore_current_blog();
}

/**
 * This builds a recordset for two post/bibliotech articles.
 */
function query_pool_two() {
	$args = array(
		'meta_query' => array(
			array(
				'key' => 'featuredArticle',
				'value' => 'True',
				'compare' => '=',
			),
		),
		'post_type' => array( 'post', 'bibliotech' ),
		'post_status' => 'publish',
		'posts_per_page' => 2,
		'orderby' => 'rand',
		'ignore_sticky_posts' => 1,
	);
	$items = get_posts( $args );

	return $items;
}

/**
 * This builds a recordset for one post/bibliotech and one spotlight article.
 */
function query_pool_one() {
	// Start by getting post/bibliotech.
	$args = array(
		'meta_query' => array(
			array(
				'key' => 'featuredArticle',
				'value' => 'True',
				'compare' => '=',
			),
		),
		'post_type' => array( 'post', 'bibliotech' ),
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'orderby' => 'rand',
		'ignore_sticky_posts' => 1,
	);
	$first = get_posts( $args );

	// Then get the spotlight.
	$args = array(
		'meta_query' => array(
			array(
				'key' => 'featuredArticle',
				'value' => 'True',
				'compare' => '=',
			),
		),
		'post_type' => array( 'spotlights' ),
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'orderby' => 'rand',
		'ignore_sticky_posts' => 1,
	);
	$second = get_posts( $args );

	// Merge the two.
	$items = array_merge( $first, $second );

	return $items;
}

/**
 * This function takes a WordPress post object, inspects the relevant fields,
 * and returns the appropriate URL for use in the front page card markup.
 *
 * @param object $item A WordPress post object.
 * @param array  $custom An array of custom post values.
 */
function build_url( $item, $custom ) {
	$url = get_permalink( $item->ID );
	if ( array_key_exists( 'calendar_url', $custom ) ) {
		if ( 0 < strlen( $custom['calendar_url'][0] ) ) {
			$url = $custom['calendar_url'][0];
		}
	} elseif ( 'bibliotech' === $item->post_type ) {
		$url = str_replace( '/news/', '/news/bibliotech/', get_permalink( $item->ID ) );
	} elseif ( 'spotlights' === $item->post_type ) {
		$url = $custom['external_link'][0];
	}
	return $url;
}

/**
 * This takes an input recordset of news items and renders it as HTML.
 *
 * @param array $items An array of WordPress post objects.
 */
function render_pool( $items ) {
	foreach ( $items as $item ) {
		$custom = get_post_custom( $item->ID );

		// URL.
		$url = build_url( $item, $custom );

		// Label.
		$label = '<div class="category-post">';
		if ( 'post' === $item->post_type ) {
			if ( '1' === $item->is_event[0] ) {
				$label .= 'Event';
			} else {
				$label .= 'News';
			}
		} else {
			if ( 'spotlights' === $item->post_type ) {
				if ( 'tip' === $custom['feature_type'][0] ) {
					$label .= $custom['feature_type'][0];
				} elseif ( 'update' === $custom['feature_type'][0] ) {
					$label .= $custom['feature_type'][0];
				} elseif ( 'check' === $custom['feature_type'][0] ) {
					$label .= 'Check it out';
				} elseif ( 'media' === $custom['feature_type'][0] ) {
					$label .= 'In the media';
				} else {
					$label .= 'Featured ' . $custom['feature_type'][0];
				}
			} elseif ( 'bibliotech' === $item->post_type ) {
				$label .= 'Bibliotech';
			} else {
				$label .= 'Other';
			}
		}
		$label .= '</div>';

		// Headline.
		if ( $custom['homepage_post_title'][0] ) {
			$headline = '<h3 class="title-post">' . $custom['homepage_post_title'][0] . '</h3>';
		} else {
			$headline = '<h3 class="title-post">' . $item->post_title . '</h3>';
		}

		// Event date, if applicable.
		$event_date = '';
		if ( 'post' === $item->post_type && array_key_exists( 'is_event', $custom ) ) {
			if ( '1' === $custom['is_event'][0] ) {
				$event_date = DateTime::createFromFormat( 'Ymd', $custom['event_date'][0] );
				$event_date = '<div class="date-event"><img alt="calendar icon" src="<?php echo get_template_directory_uri(); ?>/images/calendar.svg" width="13px" height="13px" ><span class="event">' . date_format( $event_date, 'F j' ) . '</span>';
				if ( '' != $custom['event_start_time'][0] ) {
					$event_date = $event_date . '<span class="time-event"> ' . $custom['event_start_time'][0];
				};
				if ( '' != $custom['event_end_time'][0] ) {
					$event_date = $event_date . ' - ' . $custom['event_end_time'][0];
				};
				if ( '' != $custom['event_start_time'][0] ) {
					$event_date = $event_date . '</span>';
				};
				$event_date = $event_date . '</div>';
			}
		}

		// Highlight image.
		$image_element = '';
		if ( 'post' === $item->post_type || 'bibliotech' === $item->post_type ) {
			if ( '' != $custom['homeImg'][0] ) {
				$image = json_decode( $custom['homeImg'][0] );
				// We use "original" even though this is already cropped to avoid cropping again.
				$image_url = wp_get_attachment_image_src( $image->cropped_image, 'original' );
				$image_url = str_replace( '/wp-content/uploads/', '/news/files/', $image_url[0] );
				$image_element = '<div class="image" style="background-image: url(' . $image_url . ')"></div>';
			}
		}

		echo '<a class="post--full-bleed no-underline flex-container" href="' . esc_url( $url ) . '">';
		echo '<div class="excerpt-news">';
		echo wp_kses( $label, array( 'div' => array( 'class' => array() ) ) );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $headline;
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $event_date;
		echo '</div>';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $image_element;
		echo '</a>';
	}
}

/**
 * This characterizes the pool of eligible articles, and then calls the
 * relevant query builder.
 */
function retrieve_pool() {
	// Get all eligible articles.
	$args = array(
		'meta_query' => array(
			array(
				'key' => 'featuredArticle',
				'value' => 'True',
				'compare' => '=',
			),
		),
		'post_type' => array( 'post', 'bibliotech', 'spotlights' ),
		'post_status' => 'publish',
		'posts_per_page' => 99,
		'orderby' => 'rand',
		'ignore_sticky_posts' => 1,
	);
	$items = get_posts( $args );

	return $items;

}

/**
 * This takes the pool of all eligible news items, determines how many of each
 * type exist, and determines what type of query is needed to populate the front
 * page.
 *
 * @param array $items An array of WordPress post objects.
 */
function summarize_pool( $items ) {
	// Summarize article list.
	$summary = array(
		'news' => 0,
		'spotlights' => 0,
		'other' => 0,
		'total' => 0,
	);
	foreach ( $items as $item ) {
		if ( 'post' === $item->post_type || 'bibliotech' === $item->post_type ) {
			$summary['news']++;
		} elseif ( 'spotlights' === $item->post_type ) {
			$summary['spotlights']++;
		} else {
			$summary['other']++;
		};
		$summary['total']++;
	}

	// Determine query type based on summary results.
	if ( 1 === $summary['news'] ) {
		// Only one eligible news item - so we set type to one.
		$type = 'one';
	} elseif ( 0 === $summary['spotlights'] ) {
		// No eligible spotlights - so we show two news items.
		$type = 'two';
	} else {
		// More than one news item - so we flip a coin for type.
		if ( mt_rand( 0, 1 ) ) {
			$type = 'two';
		} else {
			$type = 'one';
		}
	}

	return $type;
}
