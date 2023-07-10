<?php
/**
 * Template-part for displaying the UI of the SEARCHBAR.
 *
 * @package MITlib_News
 * @since 0.2.0
 */

namespace Mitlib\News;

?>

<span class="hidden-xs">
<form action="<?php echo esc_url( site_url() ); ?>" method="get">
	<fieldset>
	<input type="text" name="s" id="search"  placeholder="Search news &amp; events" value="<?php the_search_query(); ?>" />
	
	</fieldset>
</form>
</span>

<span class="hidden-lg hidden-md hidden-sm">
<form action="<?php echo esc_url( site_url() ); ?>" method="get">
	<fieldset>
	<input type="text" name="s" id="search"  class="searchForm"  placeholder="Search news" value="<?php the_search_query(); ?>" />
	
	</fieldset>
</form>
</span>
