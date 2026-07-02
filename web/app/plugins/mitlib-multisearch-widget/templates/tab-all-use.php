<?php
/**
 * The "Unified Search" of the search tab for all content - which will search "Search MIT Libraries" (USE).
 *
 * @package Multisearch Widget
 * @since 1.5.0
 */

?>
<!-- nls state: _<?php echo esc_attr( $nls_enabled ); ?>_ -->
<form
	class="form search-bento"
	action="https://search.libraries.mit.edu/results"
	method="get"
	data-target="bento">
	<label for="searchinput-bento">Search the MIT Libraries</label>
	<div class="wrap-flex">
		<div class="flex-left">
			<input
				class="field field-text"
				type="text"
				id="searchinput-bento"
				name="q"
				placeholder="Search across collections, services, and website content">
		</div>
		<div class="flex-right">
			<input class="button button-search" type="submit" value="Search">
		</div>
	</div>
</form>
<div class="search-option-links">
	<div>
		<a href="/search-advanced/">Advanced search</a> | <a href="/search/">More ways to search</a>
	</div>
	<?php if ( 'included' == $nls_included ) { ?>
		<div class="nls-toggle">
			<a class="toggle <?php echo esc_attr( $nls_enabled ); ?>" href="<?php echo esc_url( 'https://search.libraries.mit.edu/natural_language_search_optin?natural_language_search_optin=' . $nls_link_toggle . '&return_to=/' ); ?>">Try natural language search</a>
			<a class="learn-more" href="https://search.libraries.mit.edu/about-natural-language-search">Learn more</a>
		</div>
	<?php } ?>
</div>
