<?php
/**
 * Template Name: Home Page v2
 *
 * This template builds the site homepage. It it applied to a Page record, but
 * no fields from that Page are ever displayed.
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

get_header( 'v2' ); ?>

<main id="content">

	<section>
		<div class="content-wrapper">
			<h1>Welcome to the MIT Libraries</h1>
			<form id="search-form" action="" method="" role="search">
				<label for="basic-search-main">What can we help you find?</label>
				<div class="form-wrapper">
					<div class="search-input-wrapper">
						<i class="fa-regular fa-magnifying-glass"></i>
						<input id="basic-search-main" type="search" class="field field-text basic-search-input" name="q" title="Keyword anywhere" value="" required="">
						<button title="Clear search" aria-label="Clear search" type="button" id="clear-search" style="display: none;">Clear search</button>
					</div>
					<input id="tab-to-target" type="hidden" name="tab" value="all">
					<button type="submit" class="btn button-primary">Search</button>
				</div>
				<div class="search-actions">
					<a href="https://libraries.mit.edu/search-advanced">Advanced search</a>
					<div class="semantic-search-toggle toggled-off">
						<button type="button" aria-pressed="false">Natural language search</button>
						<a href="/about-natural-language-search">Learn more</a>
					</div>
				</div>
			</form>
		</div>
	</section>
	<section>
		<div class="content-wrapper">
			<h2>Today's hours</h2>
			<ol class="hours-list">
				<li>
					<span class="libary-name">Hayden Library</span>
					<span class="libary-hours">9am &#150; 9pm today</span>
					<span class="libary-study">24/7 study</span>
				</li>
				<li>
					<span class="libary-name">Rotch Library</span>
					<span class="libary-hours">9am &#150; 9pm today</span>
					<span class="libary-study">24/7 study</span>
				</li>				
				<li>
					<span class="libary-name">Barker Library</span>
					<span class="libary-hours">9am &#150; 9pm today</span>
					<span class="libary-study">24/7 study</span>
				</li>
				<li>
					<span class="libary-name">Lewis Music Library</span>
					<span class="libary-hours">9am &#150; 9pm today</span>
					<span class="libary-study"></span>
				</li>						
			</ol>
			<a href="#">See all locations and hours</a>
		</div>
	</section>	
	<section>
		<div class="content-wrapper">
			<h2>Using the Libraries</h2>
			<div class="option-boxes">
				<div>
					<i class="fa-light fa-lightbulb"></i>
					<div class="option-box-content">
						<a href="#"><h3>Find a study space</h3></a>
						<p>Quiet and group spaces - many available 24/7</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-lightbulb"></i>
					<div class="option-box-content">
						<a href="#"><h3>Find a study space</h3></a>
						<p>Quiet and group spaces - many available 24/7</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-lightbulb"></i>
					<div class="option-box-content">
						<a href="#"><h3>Find a study space</h3></a>
						<p>Quiet and group spaces - many available 24/7</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-lightbulb"></i>
					<div class="option-box-content">
						<a href="#"><h3>Find a study space</h3></a>
						<p>Quiet and group spaces - many available 24/7</p>
					</div>
				</div>												
			</div>
			<div class="ask-us-box">
					<i class="fa-light fa-lightbulb"></i>
					<div class="option-box-content">
						<h3>Ask us</h3>
						<p>Get help via email, chat and more.</p>
						<a class="button" href="#">See options</a>
					</div>
		</div>
	</section>
	<section>
		<div class="content-wrapper">
			Featured + Events
		</div>
	</section>
	<section>
		<div class="content-wrapper">
			<div class="featured-collection-image"></div>
			<div class="featured-collection-content">
				<p class="eyebrow">Maihaugen Gallery Exhibit</p>
				<h2>Ink, Stone, and Silver Light</h2>
				<p>This exhibition draws on archival materials from the Aga Khan Documentation Center at MIT (AKDC) to explore a century of cultural heritage preservation in Aleppo, Syria. </p>
				<a class="button" href="#">Check it out</a>
			</div>
		</div>
	</section>

</main>

<?php
	get_footer( 'v2' );
?>
