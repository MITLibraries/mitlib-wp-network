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
					<form id="search-form" action="https://search.libraries.mit.edu/results" method="" role="search">
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
				<span class="hero-image-credit">from the <a href="https://archivesspace.mit.edu/repositories/2/resources/1">Connick Stained Glass</a> Collection</span>
			</div>
		</div>
	</section>
	<section id="todays-hours">
		<div class="content-wrapper">
			<h2>Today's hours</h2>
			<ol class="hours-list">
				<li>
					<span class="library-name"><a class="link-no-underline" href="/hayden">Hayden Library</a></span>
					<span class="library-hours">9am &#150; 9pm</span>
					<span class="library-study">
						<i class="fa-light fa-moon"></i>
						24/7 study
					</span>
				</li>
				<li class="hour-rotch">
					<span class="library-name"><a class="link-no-underline" href="/rotch">Rotch Library</a></span>
					<span class="library-hours">9am &#150; 9pm</span>
					<span class="library-study">
						<i class="fa-light fa-moon"></i>
						24/7 study
					</span>
				</li>				
				<li class="hour-barker">
					<span class="library-name"><a class="link-no-underline" href="/barker">Barker Library</a></span>
					<span class="library-hours">9am &#150; 9pm</span>
					<span class="library-study">
						<i class="fa-light fa-moon"></i>
						24/7 study
					</span>
				</li>
				<li class="hour-lewis">
					<span class="library-name"><a class="link-no-underline" href="/music">Lewis Music Library</a></span>
					<span class="library-hours">9am &#150; 9pm</span>
					<span class="library-study"></span>
				</li>						
			</ol>
			<a href="/hours" class="link-on-dark">See all locations and hours</a>
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
						<h3><a href="/study">Find a study space</a></h3>
						<p>Quiet and group spaces—many available 24/7</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-file-alt"></i>
					<div class="option-box-content">
						<h3><a href="/get-materials">Get materials</a></h3>
						<p>Learn how to find, request and get the materials you need</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-book"></i>
					<div class="option-box-content">
						<h3><a href="/experts">Discover subject guides &amp; librarians</a></h3>
						<p>Resources and expertise for every research interest</p>
					</div>
				</div>
				<div>
					<i class="fa-light fa-calendar"></i>
					<div class="option-box-content">
						<h3><a href="/data-services">Find and manage data</a></h3>
						<p>Get support from creating and visualizing to using and sharing data</p>
					</div>
				</div>												
			</div>
			<div class="ask-us-box">
					<i class="fa-light fa-messages-question"></i>
					<div class="option-box-content">
						<h3>Ask Us</h3>
						<p>Get help via email, chat and consultations</p>
						<div class="ask-us-links">
							<a class="button secondary" href="#">Chat now</a>
							<a href="/ask">All help options</a>						
					</div>
			</div>
		</div>
	</section>
	<section id="featured-and-events">
		<div class="content-wrapper">
			<div class="featured-content">
				<h2>Featured</h2>
				<div class="featured-items count-6">
					<article class="featured-item">
						<span class="item-type news">News</span>
						<img src="https://libraries.mit.edu/app/uploads/sites/4/2026/06/Rotch_Ext-Night-Hzntl-300x232.jpg" />
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/news/future-of-rotch-library-begins-to-take-shape/44423/">Future of Rotch Library begins to take shape</a></h3>
								<p>Exploring how Rotch can evolve to meet the changing needs of its communities</p>
							</hgroup>
							<a class="right-arrow" href="https://libraries.mit.edu/news/future-of-rotch-library-begins-to-take-shape/44423/">More details</a>
						</div>
					</article>					
					<article class="featured-item side-by-side">
						<span class="item-type spotlight">Spotlight</span>
						<img src="https://d2jv02qf7xgjwx.cloudfront.net/accounts/353/images/smbrown1-100x100.jpg" />
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libguides.mit.edu/profiles/smbrown1">Sabrina Brown</a></h3>
								<p>Biosciences Librarian<br />Liaison, Instruction, and Reference Services</p>
							</hgroup>
							<a class="right-arrow" href="https://libguides.mit.edu/profiles/smbrown1">How can Sabrina help you?</a>
						</div>
					</article>
					<article class="featured-item side-by-side">
						<span class="item-type news">News</span>
						<img src="https://libraries.mit.edu/app/uploads/sites/4/2026/06/MIT_Summer-Books-2026-01_0-300x200.jpg" />
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/news/summer-2026-recommended-reading/44435/">Summer 2026 recommended reading</a></h3>
								<p>Featuring recent books published by MIT faculty and staff</p>
							</hgroup>
							<a class="right-arrow" href="https://libraries.mit.edu/news/summer-2026-recommended-reading/44435/">More details</a>
						</div>
					</article>
					<article class="featured-item">
						<span class="item-type resource">Resource</span>
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/news/streamline-your-access-to-full-text/39807/">Streamline your access to full text</a></h3>
								<p>The LibKey Nomad browser extension instantly checks for full text access to articles as you browse the web</p>
							</hgroup>
							<a class="right-arrow" href="https://libraries.mit.edu/news/streamline-your-access-to-full-text/39807/">More details</a>
						</div>
					</article>
					<article class="featured-item">
						<span class="item-type resource">Resource</span>
						<div class="featured-item-content">
							<h3><a href="https://libraries.mit.edu/news/nyt">Access the New York Times</a></h3>
							<p>A personal digital edition subscription is available to all MIT students, faculty, and staff</p>
							<a class="right-arrow" href="https://libraries.mit.edu/news/nyt">More details</a>
						</div>
					</article>																		
					<article class="featured-item">
						<span class="item-type service">Service</span>
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/scholarly/">Learn about your options and rights in scholarly publishing</a></h3>
								<p>Including open access, copyright, and research funder requirements</p>
							</hgroup>
							<a class="right-arrow" href="https://libraries.mit.edu/scholarly/">More details</a>
						</div>
					</article>									
				</div>
			</div>
			<div class="events">
				<div class="events-header">
					<div class="events-header-title-paragraph">
					<h2>Events &amp; Workshops</h2>
					<p>We're regularly running classes, workshops, and speaker events</p>
					</div>
					<a class="button secondary" href="https://calendar.mit.edu/department/mit_libraries">See all events</a>
				</div>
				<div class="event">
					<div class="event-date">
						<span class="event-month">Aug</span>
						<span class="event-day">21</span>
					</div>
					<div class="event-details">
						<h3><a href="https://calendar.mit.edu/event/carpentriesmit-introduction-to-programming-with-python">Programming with Python</a></h3>
						<p>Register for a beginner-friendly workshop that combines short tutorials with hands-on exercises</p>
						<div class="event-metadata">
							<span class="event-time"><i class="fa-light fa-clock"></i>9:00 am &#150; 4:00 pm</span>
							<span class="event-location"><i class="fa-light fa-map-pin"></i>Virtual Event</span>
						</div>
						<a class="right-arrow" href="https://calendar.mit.edu/event/carpentriesmit-introduction-to-programming-with-python">More details</a>			
					</div>			
				</div>
				<div class="event">
					<div class="event-date">
						<span class="event-month">Aug</span>
						<span class="event-day">22</span>
					</div>
					<div class="event-details">
						<h3><a href="https://calendar.mit.edu/event/optimizing-article-access-5613">Optimizing article access</a></h3>
						<p>Learn how to access articles for free using library resources </p>
						<div class="event-metadata">
							<span class="event-time"><i class="fa-light fa-clock"></i>11:00 &#150; 11:30 am</span>
							<span class="event-location"><i class="fa-light fa-map-pin"></i>Building 14, N-132 (DIRC)</span>
						</div>
						<a class="right-arrow" href="https://calendar.mit.edu/event/optimizing-article-access-5613">More details</a>			
					</div>			
				</div>
			</div>			
		</div>
	</section>
	<section id="featured-collection">
		<div class="content-wrapper">
			<div class="featured-collection-image" style="background-image: url('https://libraries.mit.edu/app/uploads/sites/13/2025/10/Digital_Display_InkStone-2-624x886.jpg');">
				<span class="featured-collection-tag">Exhibit</span>
			</div>
			<div class="featured-collection-content">
				<p class="eyebrow">Maihaugen Gallery Exhibit</p>
				<h2><a href="https://libraries.mit.edu/exhibits/exhibit/ink-stone-and-silver-light/">Ink, Stone, and Silver Light</a></h2>
				<p>This exhibition draws on archival materials from the Aga Khan Documentation Center at MIT (AKDC) to explore a century of cultural heritage preservation in Aleppo, Syria. </p>
				<a class="button secondary" href="https://libraries.mit.edu/exhibits/exhibit/ink-stone-and-silver-light/">Check it out</a>
			</div>
		</div>
	</section>

</main>

<?php
	get_footer( 'v2' );
?>
