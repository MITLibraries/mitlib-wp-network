<?php
/**
 * Class that defines the widget - used on the homepage - that displays all
 * library locations with today's hours.
 *
 * @package MITlib Pull Hours
 * @since 0.6.0
 */

namespace Mitlib\PullHours;

/**
 * Defines a public-facing widget for displaying all locations
 */
class Display_Widget_Frontpage extends \WP_Widget {

	/**
	 * Overridden constructor from WP_Widget.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'pull-hours-display-widget-frontpage',
			'description' => __( 'Locations and hours list for the homepage', 'hoursdisplayfrontpage' ),
		);
		parent::__construct(
			'hoursdisplayfrontpage',
			__( 'Location Hours - Frontpage', 'hoursdisplayfrontpage' ),
			$widget_ops
		);
	}

	/**
	 * Widget instance form
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = $instance['title'];

		$this->form_textfield(
			'title',
			'Widget Title:',
			$title,
			'The title is not displayed outside of the administration interface.'
		);
	}

	/**
	 * Common template for text fields in widget settings forms.
	 *
	 * @param string   $fieldname The name of the field.
	 * @param string   $fieldtitle The displayed title of the field.
	 * @param variable $fieldvalue The current value of the field.
	 * @param string   $fieldexplain Optional: a statement explaining the purpose of the field.
	 */
	public function form_textfield( $fieldname, $fieldtitle, $fieldvalue, $fieldexplain = null ) {
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( $fieldname ) ); ?>">
				<?php echo esc_attr( $fieldtitle ); ?>
				<input
					class="widefat"
					id="<?php echo esc_attr( $this->get_field_id( $fieldname ) ); ?>"
					type="text"
					name="<?php echo esc_attr( $this->get_field_name( $fieldname ) ); ?>"
					value="<?php echo esc_html( $fieldvalue ); ?>">
			</label>
			<?php
			if ( $fieldexplain ) {
				echo esc_html( $fieldexplain );
			}
			?>
		</p>
		<?php
	}

	/**
	 * Registers widget.
	 */
	public static function init() {
		register_widget( 'Mitlib\PullHours\Display_Widget_Frontpage' );
	}

	/**
	 * This function accepts the post ID of a location record, which will be used
	 * to check if that location has its alert populated. If either of the two
	 * fields for the location alert (alert_title or alert_content) are populated,
	 * that content will be shown in a div.
	 *
	 * The function does not return anything.
	 *
	 * @param string $location_id The ID of a location record to look up.
	 *
	 * @return void
	 */
	public function location_alert( $location_id ) {
		$allowed_html = array(
			'a' => array(
				'href' => array(),
			),
			'p' => array(),
		);

		$query_args = array(
			'post_type' => 'location',
			'p' => $location_id,
			'post_status' => 'publish',
		);
		$locations = new \WP_Query( $query_args );

		while ( $locations->have_posts() ) {
			$locations->the_post();
			$alert_frontpage = get_field( 'alert_frontpage' );
			if ( $alert_frontpage ) {
				echo '<div class="location-alert">';
				echo wp_kses( $alert_frontpage, $allowed_html );
				echo '</div>';
			}
		}
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}

	/**
	 * Widget() builds the output
	 *
	 * @param array $args See WP_Widget in Developer documentation.
	 * @param array $instance See WP_Widget in Developer documentation.
	 * @link https://developer.wordpress.org/reference/classes/wp_widget/
	 */
	public function widget( $args, $instance ) {
		// Register javascript.
		wp_register_script( 'moment', plugin_dir_url( __FILE__ ) . '../js/libs/moment.min.js', array(), '2.8.3', true );
		wp_register_script( 'underscore', plugin_dir_url( __FILE__ ) . '../js/libs/underscore.min.js', array(), '1.7.0', true );
		wp_register_script( 'polyfill', '//polyfill.io/v3/polyfill.js?version=3.52.1', array(), '3.52.1', true );
		wp_register_script( 'hours-loader', plugin_dir_url( __FILE__ ) . '../js/hours-loader.js', array( 'jquery', 'moment', 'underscore', 'polyfill' ), '1.10.0', true );
		wp_enqueue_script( 'hours-loader' );

		$instance = null; // There are no publicly exposed settings for this widget.

		// Define expected array of tags and attributes in user-configurable fields.
		$allowed = array(); // Do not allow any tags in these fields.

		// Render markup.
		echo wp_kses( $args['before_widget'], $allowed );
		require( plugin_dir_path( __FILE__ ) . '../templates/display-widget-frontpage.php' );
		echo wp_kses( $args['after_widget'], $allowed );
	}
}
