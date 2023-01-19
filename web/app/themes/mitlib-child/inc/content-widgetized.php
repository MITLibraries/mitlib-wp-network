<?php
/**
 * The template used for displaying page content for Widgetized Page
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

?>
<div class="main-content">
	
	<div class="entry-content">
		<?php
		$title = get_the_title();
		if ( '' !== $title ) :
			if ( ! is_front_page() ) {
				echo '<h1>' . esc_html( $title ) . '</h1>'; }
		endif;

		the_content();

		dynamic_sidebar( 'sidebar-two' );
		?>
	</div>
	
		
</div>
