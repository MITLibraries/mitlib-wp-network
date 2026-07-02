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
		if ( 'use' == $instance['targets'] ) {
			$all_template = 'templates/tab-all-use.php';
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
		echo '<h2 id="searchtabsheader" class="sr">Search the MIT libraries</h2>';

		// Render the search tabs only when "Unified Search" option is not selected
		if ( $instance['targets'] != 'use' ) {
		
			echo '<ul id="search_tabs_nav" aria-labelledby="searchtabsheader">
				<li><a id="tab-all" href="#search-all"><span>All</span></a></li>
				<li><a id="tab-books" href="#search-books"><span>Books + media</span></a></li>
				<li><a id="tab-articles" href="#search-articles"><span>'
				. esc_html( $articles_tab_name )
				. '</span></a></li>
				<li><a id="tab-more" href="#search-more"><span>More...</span></a></li>
			</ul>';			

			// Render the individual tab panes
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

		};

		if ( $instance['targets'] == 'use' ) {
		
			// Determine whether to enable NLS based on widget settings and the user's cookie.
			$nls_enabled = $this->readCookie( $instance['nls_default'] );

			$nls_link_toggle = $this->setToggleValue( $nls_enabled );

			$nls_included = $instance['nls_included'];

			echo '<div id="search-all" class="r-tabs-panel r-tabs-state-active use" aria-labelledby="tab-all">';
				include( $all_template );
			echo '</div>';

		};

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
		$nls_default = $instance['nls_default'];
		if ( '' == $instance['nls_default'] ) {
			$nls_default = 'off';
		}
		$nls_included = $instance['nls_included'];
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
			<li>
				<label>
					<input
						type="radio"
						name="<?php echo esc_attr( $this->get_field_name( 'targets' ) ); ?>"
						value="use"
						<?php
						if ( 'use' == $targets ) {
							echo "checked='checked'";
						}
						?>
					>
					Unified Search
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
		<h3>Natural language search</h3>
		<p>
			Should the natural language option be shown?<br>
			<label>
				<input
					type="checkbox"
					name="<?php echo esc_attr( $this->get_field_name( 'nls_included' ) ); ?>"
					value="included"
						<?php
						if ( 'included' == $nls_included ) {
							echo "checked='checked'";
						}
						?>
				>
				Yes, include this feature.
			</label>
		</p>
		<p>Which is the default query mode?</p>
		<ul>
			<li>
				<label>
					<input
					  type="radio"
						name="<?php echo esc_attr( $this->get_field_name( 'nls_default' ) ); ?>"
						value="off"
						<?php
						if ( 'off' == $nls_default ) {
							echo "checked='checked'";
						}
						?>
					>
					Keyword
				</label>
			</li>
			<li>
				<label>
					<input
					  type="radio"
						name="<?php echo esc_attr( $this->get_field_name( 'nls_default' ) ); ?>"
						value="on"
						<?php
						if ( 'on' == $nls_default ) {
							echo "checked='checked'";
						}
						?>
					>
					Natural Language
				</label>
			</li>
		</ul>
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
		$instance['nls_default'] = $new_instance['nls_default'];
		$instance['nls_included'] = $new_instance['nls_included'];
		return $instance;
	}

	/**
	 * ReadCookie looks for the 'STYXKEY_nls_enabled' domain cookie in the $_COOKIE superglobal. If no value is found, it
	 * returns the default value - which is defined via the widget settings form. (We use the STYXKEY prefix in the cookie
	 * name because this is what Pantheon allows to pass through its caching layers).
	 *
	 * @see https://docs.pantheon.io/cookies#cache-varying-cookies
	 *
	 * @param string $nls_enabled Either 'on' (for hybrid) or 'off' (for keyword) - defined in widget settings form.
	 */
	private function readCookie( $nls_enabled ) {
		if ( array_key_exists( 'STYXKEY_nls_enabled', $_COOKIE ) ) {
			if ( 'true' == $_COOKIE['STYXKEY_nls_enabled'] ) {
				$nls_enabled = 'on';
			} else {
				$nls_enabled = 'off';
			}
		}

		return $nls_enabled;
	}

	/**
	 * SetToggleValue determines what the state of the toggle value should be if the user decides to activate (or
	 * deactivate) the natural language feature.
	 *
	 * @param string $nls_enabled Either 'on' (for hybrid) or 'off' (for keyword) - by this point defined by readCookie.
	 */
	private function setToggleValue( $nls_enabled ) {
		if ( 'on' == $nls_enabled ) {
			return 'false';
		}

		return 'true';
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
