<?php
/**
 * The "Unified Search" of the search tab for all content - which will search "Search MIT Libraries" (USE).
 * This version is designed to trim away surrounding markup so it can be embedded on the new homepage hero. 
 *
 * @package Multisearch Widget
 * @since 1.5.0
 */

?>
<!-- nls state: _<?php echo esc_attr( $nls_enabled ); ?>_ -->
<form id="search-form" action="https://search.libraries.mit.edu/results" method="get" role="search">
	<label for="basic-search-main">Search for books, articles, library services, and more</label>
	<div class="form-wrapper">
		<div class="search-input-wrapper">
			<i class="fa-regular fa-magnifying-glass"></i>
			<input id="basic-search-main" placeholder="Try a citation, topic, database, etc." type="search" class="field field-text basic-search-input" name="q" title="Keyword anywhere" value="" required="">
			<button title="Clear search" aria-label="Clear search" type="button" id="clear-search" style="display: none;">Clear search</button>
		</div>
		<input id="tab-to-target" type="hidden" name="tab" value="all">
		<button type="submit" class="btn button-primary">Search</button>
	</div>
	<div class="search-actions">
		<a class="link-on-dark" href="https://libraries.mit.edu/search-advanced">Advanced search</a>			

		<?php if ( 'included' == $nls_included ) { ?>
			<div class="nls-toggle">
				<a class="toggle <?php echo esc_attr( $nls_enabled ); ?>" href="<?php echo esc_url( 'https://search.libraries.mit.edu/natural_language_search_optin?natural_language_search_optin=' . $nls_link_toggle . '&return_to=/' ); ?>">Natural language search</a>
				<a class="learn-more" href="https://search.libraries.mit.edu/about-natural-language-search">Learn more</a>
			</div>
		<?php } ?>			
	</div>
</form>
