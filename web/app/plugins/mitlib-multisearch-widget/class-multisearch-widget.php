<?php
/**
 * Class that defines the multisearch widget.
 *
 * @package Multisearch Widget
 * @since 0.3.0
 */

namespace mitlib;

/**
 * Defines base widget.
 */
class Multisearch_Widget extends \WP_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'multisearch-widget',
			'description' => __( 'Search widget for multiple targets', 'multisearch' ),
		);
		parent::__construct( 'multisearch', __( 'MultiSearch', 'multisearch' ), $widget_ops );
	}

	/**
	 * Widget() builds the output
	 *
	 * @param array $args See WP_Widget in Developer documentation.
	 * @param array $instance See WP_Widget in Developer documentation.
	 * @link https://developer.wordpress.org/reference/classes/wp_widget/
	 */
	public function widget( $args, $instance ) {
		// Identify which templates are needed based on instance variable.
		$all_template = 'templates/tab-all-eds.php';
		$books_template = 'templates/tab-books-eds.php';
		$articles_template = 'templates/tab-articles-eds.php';
		$articles_tab_name = 'Journals + articles';
		$more_template = 'templates/tab-more-eds.php';
		if ( 'alma' == $instance['targets'] ) {
			$all_template = 'templates/tab-all-alma.php';
			$books_template = 'templates/tab-books-alma.php';
			$articles_template = 'templates/tab-articles-alma.php';
			$articles_tab_name = 'Articles + chapters';
			$more_template = 'templates/tab-more-alma.php';
		}

		// Strip initial arguments.
		$args = null;

		// Register / enqueue javascript.
		// First we add the responsive tabs plugin.
		wp_register_script(
			'responsivetabs-js',
			plugin_dir_url( __FILE__ ) . 'libs/jquery.responsiveTabs.min.js',
			array( 'jquery' ),
			'1.6.1',
			false
		);
		// Second, we add this plugin's javascript.
		wp_register_script(
			'multisearch-js',
			plugin_dir_url( __FILE__ ) . 'mitlib-multisearch-widget.js',
			array( 'responsivetabs-js' ),
			'1.4.1',
			false
		);
		// Finally, we enquey only this plugin's javascript (which brings everything else in).
		wp_enqueue_script( 'multisearch-js' );

		// Register / enqueue styles.
		wp_register_style( 'responsivetabs-css', plugin_dir_url( __FILE__ ) . 'libs/responsive-tabs.css', '', '1.6.1' );
		wp_register_style(
			'multisearch-tabs',
			plugin_dir_url( __FILE__ ) . 'mitlib-multisearch-widget.css',
			array( 'responsivetabs-css' ),
			'1.3.0'
		);
		wp_enqueue_style( 'multisearch-tabs' );

		// Render markup.
		echo '<noscript><p>It appears that your browser does not support javascript.</p>';
		include( 'templates/form_nojs.html' );
		echo '</noscript>';
		echo '<div id="multisearch" class="' . esc_attr( $this->widgetClasses( $instance ) ) . ' nojs">';
		echo '<h2 id="searchtabsheader" class="sr">Search the MIT libraries</h2>
			<ul id="search_tabs_nav" aria-labelledby="searchtabsheader">
				<li><a id="tab-all" href="#search-all"><span>All</span></a></li>
				<li><a id="tab-books" href="#search-books"><span>Books + media</span></a></li>
				<li><a id="tab-articles" href="#search-articles"><span>'
				. esc_html( $articles_tab_name )
				. '</span></a></li>
				<li><a id="tab-more" href="#search-more"><span>More...</span></a></li>
			</ul>';
		echo '<div id="search-all" aria-labelledby="tab-all">';
			include( $all_template );
		echo '</div>';
		echo '<div id="search-books" aria-labelledby="tab-books">';
			include( $books_template );
		echo '</div>';
		echo '<div id="search-articles" aria-labelledby="tab-articles">';
			include( $articles_template );
		echo '</div>';
		echo '<div id="search-more" aria-labelledby="tab-more">';
			include( $more_template );
		echo '</div>';
		if ( $instance['banner_text'] ) {
			$allowed = array(
				'a' => array(
					'class' => array(),
					'href' => array(),
					'style' => array(),
				),
				'p' => array(
					'class' => array(),
					'style' => array(),
				),
				'style' => array(),
			);
			echo '<div class="wrap-banner-text no-js-hidden">';
			echo wp_kses( $instance['banner_text'], $allowed );
			echo '</div>';
		}
		echo '</div>';
	}

	/**
	 * Back-end widget form
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$banner_text = $instance['banner_text'];
		$targets = $instance['targets'];
		if ( '' == $instance['targets'] ) {
			$targets = 'eds';
		}
		$bento_url = $instance['bento_url'];
		if ( '' == $instance['bento_url'] ) {
			$bento_url = 'https://lib.mit.edu/';
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'banner_text' ) ); ?>">
				<?php esc_attr_e( 'Banner Text (limited HTML allowed)' ); ?>
			</label>
			<textarea
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'banner_text' ) ); ?>"
				type="text"
				rows="5"
				name="<?php echo esc_attr( $this->get_field_name( 'banner_text' ) ); ?>"><?php echo esc_html( $banner_text ); ?></textarea>
		</p>
		<p>Which set of search targets should be shown?</p>
		<ul>
			<li>
				<label>
					<input
						type="radio"
						name="<?php echo esc_attr( $this->get_field_name( 'targets' ) ); ?>"
						value="eds"
						<?php
						if ( 'eds' == $targets ) {
							echo "checked='checked'";
						}
						?>
					>
					EDS and Barton
				</label>
			</li>
			<li>
				<label>
					<input
						type="radio"
						name="<?php echo esc_attr( $this->get_field_name( 'targets' ) ); ?>"
						value="alma"
						<?php
						if ( 'alma' == $targets ) {
							echo "checked='checked'";
						}
						?>
					>
					Alma and Primo
				</label>
			</li>
		</ul>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'bento_url' ) ); ?>">
				<?php esc_attr_e( 'Bento URL' ); ?> (formatted like "https://lib.mit.edu/")
			</label>
			<input
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'bento_url' ) ); ?>"
				type="text"
				name="<?php echo esc_attr( $this->get_field_name( 'bento_url' ) ); ?>"
				value="<?php echo esc_html( $bento_url ); ?>">
		</p>
		<?php
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
		$instance['banner_text'] = $new_instance['banner_text'];
		$instance['targets'] = $new_instance['targets'];
		$instance['bento_url'] = $new_instance['bento_url'];
		return $instance;
	}

	/**
	 * The classes applied to the widget depend on if the banner_text property
	 * is set.
	 *
	 * @param array $instance The widget being rendered.
	 */
	private function widgetClasses( $instance ) {
		$class = 'wrap-search';
		if ( $instance['banner_text'] ) {
			$class = 'wrap-search banner';
		}
		return $class;
	}
}
