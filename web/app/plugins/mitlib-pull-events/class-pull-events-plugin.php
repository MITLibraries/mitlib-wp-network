<?php
/**
 * Class that defines the plugin behavior.
 *
 * @package MITLib Pull Events
 * @since 1.1.0
 */

/**
 * Class that includes all plugin behavior.
 */
class Pull_Events_Plugin {


	/**
	 * This constructor method defines all actions that get taken by the
	 * plugin, defining the dashboard, plugin settings structure, and
	 * activation / deactivation hooks.
	 *
	 * The daily_event_pull is a new action defined in this plugin, which is
	 * how new events should be harvested automatically every hour.
	 */
	public function __construct() {
		// Hook into the admin menu.
		add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );

		add_action( 'daily_event_pull', 'pull_events' );

		add_action( 'admin_init', array( $this, 'setup_sections' ) );
		add_action( 'admin_init', array( $this, 'setup_fields' ) );
		register_setting( 'pull_mit_events', 'pull_url_field' );

		register_activation_hook( __FILE__, 'my_activation' );
		register_deactivation_hook( __FILE__, 'my_deactivation' );

	}

	/**
	 * Upon plugin deactivation, delete the daily_event_pull action.
	 */
	public function my_deactivation() {
		wp_clear_scheduled_hook( 'daily_event_pull' );
	}

	/**
	 * Upon plugin activation, define the daily_event_pull action, to be
	 * completed hourly.
	 */
	public function my_activation() {
		wp_schedule_event( time(), 'hourly', 'daily_event_pull' );
	}

	/**
	 * This creates the plugin settings page / dashboard, which is where all
	 * operations are invoked and reported upon.
	 */
	public function create_plugin_settings_page() {
		// Add the menu item and page.
		$page_title = 'Pull Events Settings Page';
		$menu_title = 'Pull MIT Events';
		$capability = 'manage_options';
		$slug = 'pull_mit_events';
		$callback = array( $this, 'plugin_settings_page_content' );
		$icon = 'dashicons-admin-plugins';
		$position = 100;

		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
	}

	/**
	 * This defines the section which contains the plugin settings fields.
	 * With only a single settings field in the plugin, this is a bit of
	 * overkill, but necessary.
	 */
	public function setup_sections() {
		add_settings_section( 'url_section', 'Configure Events Pull', false, 'pull_mit_events' );
	}

	/**
	 * This defines the single configurable value needed by the plugin - the
	 * URL to be polled to harvest event records.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_settings_field/
	 */
	public function setup_fields() {
		add_settings_field( 'pull_url_field', 'Pull Events URL:', array( $this, 'field_callback' ), 'pull_mit_events', 'url_section' );
	}

	/**
	 * Callback method to render the form field for the URL settings field.
	 *
	 * @param array $arguments See the Settings API documentation for info.
	 */
	public function field_callback( $arguments ) {
		echo '<input name="pull_url_field" id="pull_url_field" type="text" size="100" value="' . esc_url( get_option( 'pull_url_field' ) ) . '" />';

	}

	/**
	 * Pulls events and either updates or inserts based on calendar ID field
	 *
	 * @param boolean $confirm Flag to direct feedback to the user or to the
	 *                         error log.
	 */
	public static function pull_events( $confirm = false ) {
		$url = EVENTS_URL;
		$result = file_get_contents( $url );
		$events = json_decode( $result, true );
		foreach ( $events['events'] as $val ) {
			if ( is_array( $val ) ) {
				if ( isset( $val['event']['title'] ) ) {
					$title = $val['event']['title'];
					$slug = str_replace( ' ', '-', $title );
				}
				if ( isset( $val['event']['description_text'] ) ) {
					$description = $val['event']['description_text'];
				}
				if ( isset( $val['event']['event_instances'][0]['event_instance'] ) ) {
					$calendar_id = $val['event']['event_instances'][0]['event_instance']['id'];
					$start = strtotime( $val['event']['event_instances'][0]['event_instance']['start'] );
					$startdate = gmdate( 'Ymd', $start );
					$workingtime = new DateTime( gmdate( 'h:i A', $start ) );
					$workingtime->setTimezone( new DateTimeZone( get_option( 'timezone_string' ) ) );
					$starttime = $workingtime->format( 'h:i A' );
					$end = '';
					$enddate = '';
					$endtime = '';
					if ( isset( $val['event']['event_instances'][0]['event_instance']['end'] ) ) {
						$end = strtotime( $val['event']['event_instances'][0]['event_instance']['end'] );
						$enddate = gmdate( 'Ymd', $end );
						$workingtime = new DateTime( gmdate( 'h:i A', $end ) );
						$workingtime->setTimezone( new DateTimeZone( get_option( 'timezone_string' ) ) );
						$endtime = $workingtime->format( 'h:i A' );
					}
				}
				if ( isset( $val['event']['localist_url'] ) ) {
					$calendar_url = $val['event']['localist_url'];
				}
				if ( isset( $val['event']['photo_url'] ) ) {
					$photo_url = $val['event']['photo_url'];
				}
				$category = 43;  // TODO: Make this user-configurable. This is the Category ID value in the News site for the "All News" value.

				if ( isset( $calendar_id ) ) {

					$args = array(
						'post_status'     => 'publish',
						'numberposts'   => -1,
						'post_type'     => 'post',
						'meta_key'      => 'calendar_id',
						'meta_value'    => $calendar_id,
					);
					query_posts( $args );

					if ( have_posts() ) {

						the_post();
						$post_id = wp_update_post(
							array(
								'ID'  => get_the_ID(),
								'comment_status'  => 'closed',
								'ping_status'   => 'closed',
								'post_title'    => $title,
								'post_description'    => $description,
							),
							true
						);
						if ( is_wp_error( $post_id ) ) {
							$errors = $post_id->get_error_messages();
							foreach ( $errors as $error ) {
								error_log( $error );
							}
						} else {
							if ( $confirm ) {
								echo esc_html( $title ) . ': Updated<br/>';
							}
							error_log( $title . ': Updated' );
						}
					} else {

						$post_id = wp_insert_post(
							array(
								'comment_status'  => 'closed',
								'ping_status'   => 'closed',
								'post_name'   => $slug,
								'post_title'    => $title,
								'post_description'    => $description,
								'post_status'   => 'publish',
								'post_type'   => 'post',
								'post_category' => array( $category ),
							),
							true
						);

						if ( is_wp_error( $post_id ) ) {
							$errors = $post_id->get_error_messages();
							foreach ( $errors as $error ) {
								error_log( $error );
							}
						} else {
							if ( $confirm ) {
								echo esc_html( $title ) . ': Inserted<br/>';
							}
							error_log( $title . ': Inserted' );
						}
					}
					self::wrap_update_post_meta( $post_id, 'event_date', $startdate );
					self::wrap_update_post_meta( $post_id, 'event_start_time', $starttime );
					if ( isset( $val['event']['event_instances'][0]['event_instance']['end'] ) ) {
						self::wrap_update_post_meta( $post_id, 'event_end_time', $endtime );
					}
					self::wrap_update_post_meta( $post_id, 'is_event', '1' );
					self::wrap_update_post_meta( $post_id, 'calendar_url', $calendar_url );
					self::wrap_update_post_meta( $post_id, 'calendar_id', $calendar_id );
					self::wrap_update_post_meta( $post_id, 'calendar_image', $photo_url );

				}
			}
		}
	}

	/**
	 * This stores the correct value for a post's meta field. The actual
	 * action taken may be an update, creation, or deletion.
	 *
	 * @param integer $post_id the ID of the post being updated.
	 * @param string  $field_name The field being updated for this post.
	 * @param string  $value The new value for this field.
	 */
	public static function wrap_update_post_meta( $post_id, $field_name, $value = '' ) {
		if ( empty( $value ) || ! $value ) {
			delete_post_meta( $post_id, $field_name );
		} elseif ( ! get_post_meta( $post_id, $field_name ) ) {
			add_post_meta( $post_id, $field_name, $value );
		} else {
			update_post_meta( $post_id, $field_name, $value );
		}
	}

	/**
	 * This renders the markup for the plugin dashboard / settings page.
	 */
	public function plugin_settings_page_content() {

		if ( isset( $_GET['page'] ) && isset( $_GET['action'] ) ) {

			if ( 'pull_mit_events' == $_GET['page'] && 'pull-events' == $_GET['action'] ) {
				 echo '<h2>Pull MIT Library Events</h2>';
				self::pull_events( true );
				exit;
			}
		}

		?>

		<div>

		<h2>Pull MIT Library Events</h2>

		<p>
		Example: https://calendar.mit.edu/api/2/events?pp=500&group_id=11497&exclude_type=102763&days=365<br/>
		pp – record count  . If you don’t specify a count, by default it returns only 10<br/>
		group_id – the id for MIT Libraries<br/>
		exclude_type – excluding exhibits<br/>
		days – 365 , number of days to return (always in future) . If you don’t specify this parameter, by default it returns only today
		</p>
		<form method="POST" action="options.php">

		<?php
		settings_fields( 'pull_mit_events' );
		do_settings_sections( 'pull_mit_events' );
		submit_button();
		?>

		</form>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin.php?page=pull_mit_events&action=pull-events' ) ); ?>">
			
		<h2>Do it now:</h2> 

		<input type="hidden" name="action" value="pull-events" />
		<input type="submit" value="Pull Events" class="button button-primary" />
		</form>	
		<hr/>

		</div>


		<?php
	}

}
