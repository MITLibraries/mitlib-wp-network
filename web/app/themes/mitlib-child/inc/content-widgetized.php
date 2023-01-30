<?php
/**
 * The template used for displaying page content in the Widgetized page template
 * (page-widgetized.php) as well as the Full Width page template
 * (page-full-width.php).
 *
 * @package MITlib_Child
 * @since 0.1.0
 */

namespace Mitlib\Child;

?>
<div class="main-content">
	
	<div class="entry-content">
		<?php
		$page_title = get_the_title();
		if ( '' !== $page_title ) :
			if ( ! is_front_page() ) {
				echo '<h1>' . esc_html( $page_title ) . '</h1>'; }
		endif;

		the_content();

		/**
		 * The "sidebar-two" region is named "Below Content Widget Area" within
		 *  the admin interface.
		 */
		dynamic_sidebar( 'sidebar-two' );
		?>
	</div>
		
</div>
