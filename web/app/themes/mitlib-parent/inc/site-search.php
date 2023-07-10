<?php
/**
 * This is the template for the site search form that points to the Google
 * Custom Search Engine.
 *
 * @package MITlib_Parent
 * @since 0.1.0
 */

?>
<div class="entry-content">

	<form action="https://www.google.com/cse" id="cse-search-box">
		<h2><label for="q">Search the Libraries' web site:</label></h2>
		<div>
			<input type="hidden" name="cx" value="012139403769412284441:qmnizspyywg">
			<input type="hidden" name="ie" value="UTF-8">
			<input type="text" id="q" name="q" size="80" style="width: 300px;">
			<input type="submit" name="sa" value="Search">
		</div>
	</form>

	<h2>Need help? <a href="/ask">Ask us!</a></h2>

	<p>Or try:</p>
	<ul>
		<li><a href="/search">Quick search: Books, articles, films, archival material, and more</a></li>
		<li><a href="/research-guides">Research guides &amp; expert librarians</a></li>
		<li><a href="//web.mit.edu/search.html">MIT web site search</a></li>
	</ul>


</div><!-- .entry-content -->
