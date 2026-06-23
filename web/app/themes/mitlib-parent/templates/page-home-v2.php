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

<?php
// Gets the featured image for the hero section.
if ( has_post_thumbnail() ) {
    $image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
}
?>

	<section id="hero" style="background-image: url(<?php echo esc_url( $image_url ); ?>);">
	<div class="overlay">	
		<div class="content-wrapper">
				<div class="hero-content">
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
							<a class="link-on-dark" href="https://libraries.mit.edu/search-advanced">Advanced search</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<section id="todays-hours">
		<div class="content-wrapper">
			<h2>Today's hours</h2>
			<ol class="hours-list">
				<li>
					<span class="libary-name"><a class="link-no-underline" href="#">Hayden Library</a></span>
					<span class="libary-hours">9am &#150; 9pm today</span>
					<span class="libary-study">
						<i class="fa-light fa-moon"></i>
						24/7 study
					</span>
				</li>
				<li>
					<span class="libary-name"><a class="link-no-underline" href="#">Rotch Library</a></span>
					<span class="libary-hours">9am &#150; 9pm today</span>
					<span class="libary-study">
						<i class="fa-light fa-moon"></i>
						24/7 study
					</span>
				</li>				
				<li>
					<span class="libary-name"><a class="link-no-underline" href="#">Barker Library</a></span>
					<span class="libary-hours">9am &#150; 9pm today</span>
					<span class="libary-study">
						<i class="fa-light fa-moon"></i>
						24/7 study
					</span>
				</li>
				<li>
					<span class="libary-name"><a class="link-no-underline" href="#">Lewis Music Library</a></span>
					<span class="libary-hours">9am &#150; 9pm today</span>
					<span class="libary-study"></span>
				</li>						
			</ol>
			<a href="#" class="link-on-dark">See all locations and hours</a>
		</div>
	</section>	
	<section id="using-the-libraries">
		<div class="content-wrapper">
			<h2>Using the Libraries</h2>
			<div class="box-wrapper">
			<div class="option-boxes">
				<div>
					<i class="fa-light fa-lightbulb"></i>
					<div class="option-box-content">
						<h3><a href="#">Find a study space</a></h3>
						<p>Quiet and group spaces - many available 24/7</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-file-alt"></i>
					<div class="option-box-content">
						<h3><a href="#">Get materials</a></h3>
						<p>Learn how to access articles, books, and more</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-book"></i>
					<div class="option-box-content">
						<h3><a href="#">Explore research guides & librarians</a></h3>
						<p>Guides and librarians for every research interest.</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-calendar"></i>
					<div class="option-box-content">
						<h3><a href="#">Schedule a research consultation</a></h3>
						<p>For complex research questions</p>
					</div>
				</div>												
			</div>
			<div class="ask-us-box">
					<i class="fa-light fa-messages-question"></i>
					<div class="option-box-content">
						<h3>Ask us</h3>
						<p>Get help via email, chat and more.</p>
						<a class="button secondary" href="#">See options</a>
					</div>
			</div>
		</div>
	</section>
	<section id="featured-and-events">
		<div class="content-wrapper">
			<h2>Featured + Events</h2>
		</div>
	</section>
	<section id="featured-collection">
		<div class="content-wrapper">
			<div class="featured-collection-image" style="background-image: url('https://libraries.mit.edu/app/uploads/sites/13/2025/10/Digital_Display_InkStone-2-624x886.jpg');">
				<!--<img src="https://libraries.mit.edu/app/uploads/sites/13/2025/10/Digital_Display_InkStone-2-624x886.jpg" alt="Image from the Maihaugen Gallery exhibit, Ink, Stone, and Silver Light. It shows a display case with an open book, a stone object, and a silver object, all on a red background.">-->
			</div>
			<div class="featured-collection-content">
				<p class="eyebrow">Maihaugen Gallery Exhibit</p>
				<h2>Ink, Stone, and Silver Light</h2>
				<p>This exhibition draws on archival materials from the Aga Khan Documentation Center at MIT (AKDC) to explore a century of cultural heritage preservation in Aleppo, Syria. </p>
				<a class="button secondary" href="#">Check it out</a>
			</div>
		</div>
	</section>

</main>

<?php
	get_footer( 'v2' );
?>
