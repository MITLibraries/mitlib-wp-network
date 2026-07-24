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

					<?php
						if ( is_active_sidebar( 'sidebar-search' ) ) :
							dynamic_sidebar( 'sidebar-search' );					
						endif; 
					?>
					
				</div>
				<span class="hero-image-credit">from the <a href="https://archivesspace.mit.edu/repositories/2/resources/603">Harold E. Edgerton papers</a></span>
			</div>
		</div>
	</section>

	<?php //get_template_part( 'inc/alert-local' ); ?>

	<section id="todays-hours">
		<div class="content-wrapper">
			<h2>Today's hours</h2>
			<ol class="hours-list">
				<li>
					<span class="library-name"><a class="link-no-underline" href="/hayden">Hayden Library</a></span>
					<span class="library-hours"><span data-location-hours="Hayden Library"></span></span>
					<span class="library-study">
						<i class="fa-light fa-moon"></i>
						24/7 study
					</span>
				</li>
				<li class="hour-rotch">
					<span class="library-name"><a class="link-no-underline" href="/rotch">Rotch Library</a></span>
					<span class="library-hours"><span data-location-hours="Rotch Library"></span></span>
					<span class="library-study">
						<i class="fa-light fa-moon"></i>
						24/7 study
					</span>
				</li>				
				<li class="hour-barker">
					<span class="library-name"><a class="link-no-underline" href="/barker">Barker Library</a></span>
					<span class="library-hours"><span data-location-hours="Barker Library"></span></span>
					<span class="library-study">
						<i class="fa-light fa-moon"></i>
						24/7 study
					</span>
				</li>
				<li class="hour-lewis">
					<span class="library-name"><a class="link-no-underline" href="/music">Lewis Music Library</a></span>
					<span class="library-hours"><span data-location-hours="Lewis Music Library"></span></span>
					<span class="library-study"></span>
				</li>						
			</ol>
			<a href="/hours" class="link-on-dark">See more locations and hours</a>
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
							<div id="libchat_fa6edc50fe81603743870ca1772bc5b2e7e121436b62ba7da331b9dcabf289c0"></div>
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
						<span class="item-type spotlight">Spotlight</span>
						<img src="https://libraries.mit.edu/app/uploads/2026/07/0fBLLWk0.jpeg" alt="A seated audience watches a man and a woman standing at a podium; a slide on the wall behind them reads, 'Democratizing Access to Climate Data.'" />
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/opendata/open-data-mit-home/mit-prize/">2026 MIT Prize for Open Data</a></h3>
								<p>Nominate an MIT researcher for the $2,500 prize</p>
							</hgroup>
						</div>
					</article>					
					<article class="featured-item side-by-side">
						<span class="item-type spotlight">Spotlight</span>
						<img src="https://d2jv02qf7xgjwx.cloudfront.net/accounts/353/images/smbrown1-100x100.jpg" />
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libguides.mit.edu/profiles/smbrown1">Sabrina Brown</a></h3>
								<div>
									<p>Biosciences Librarian</p>
									<p>Liaison, Instruction, and Reference Services</p>
								</div>
							</hgroup>
							<a class="arrow-right" href="https://libguides.mit.edu/profiles/smbrown1">How can Sabrina help you?</a>
						</div>
					</article>
					<article class="featured-item side-by-side">
						<span class="item-type spotlight">Spotlight</span>
						<img src="https://libraries.mit.edu/app/uploads/2026/07/YpeVtugQ.png" alt="A black book cover featuring light blue type reads “National Bestseller, Ted Chiang, Exhalation, Stories, By the author of Stories of Your Life and Others.”"/>
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/mit-reads/">MIT Reads: <em>Exhalation</em></a></h3>
								<p>Ted Chiang's science fiction story collection selected by President Sally Kornbluth</p>
							</hgroup>
						</div>
					</article>
					<article class="featured-item">
						<span class="item-type service">Service</span>
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/about/service-updates/">Service updates</a></h3>
								<p>The latest information about access to library collections, spaces, and services</p>
							</hgroup>
						</div>
					</article>
					<article class="featured-item">
						<span class="item-type news">News</span>
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libraries.mit.edu/news/future-of-rotch-library-begins-to-take-shape/44423/">Future of Rotch Library begins to take shape</a></h3>
								<p>Reimagining spaces for teaching, studying, and data services</p>
							</hgroup>
						</div>
					</article>																		
					<article class="featured-item">
						<span class="item-type resource">Resource</span>
						<div class="featured-item-content">
							<hgroup>
								<h3><a href="https://libguides.mit.edu/libkey/nomad">Quicker access to journal articles</a></h3>
								<p>The LibKey Nomad browser extension instantly checks for full-text access to articles as you browse the web</p>
							</hgroup>
						</div>
					</article>									
				</div>
			</div>
			<div class="events">
				<div class="events-header">
					<div class="events-header-title-paragraph">
					<h2>Events &amp; Workshops</h2>
					<p>We regularly run classes, workshops, and speaker events</p>
					</div>
					<a class="button secondary" href="https://libraries.mit.edu/news/events/">See all events</a>
				</div>
				<div class="event">
					<div class="event-date">
						<span class="event-month">Aug</span>
						<span class="event-day">24</span>
					</div>
					<div class="event-details">
						<h3><a href="https://calendar.mit.edu/event/carpentriesmit-introduction-to-programming-with-python">Carpentries@MIT Introduction to Programming with Python</a></h3>
						<p>A beginner-friendly workshop combining short tutorials with hands-on exercises</p>
						<div class="event-metadata">
							<span class="event-time"><i class="fa-light fa-clock"></i>10:00 am &#150; 4:00 pm</span>
							<span class="event-location"><i class="fa-light fa-map-pin"></i>Virtual Event</span>
						</div>		
					</div>			
				</div>
				<div class="event">
					<div class="event-date">
						<span class="event-month">Sep</span>
						<span class="event-day">2</span>
					</div>
					<div class="event-details">
						<h3><a href="https://calendar.mit.edu/event/mit-libraries-resources-and-services-for-graduate-students-6074">MIT Libraries: Resources and Services for Graduate Students</a></h3>
						<p>How to find the information and data you'll need</p>
						<div class="event-metadata">
							<span class="event-time"><i class="fa-light fa-clock"></i>10:45 &#150; 11:45 am</span>
							<span class="event-location"><i class="fa-light fa-map-pin"></i>Building 14, S-130 (The Nexus)</span>
						</div>		
					</div>			
				</div>
			</div>			
		</div>
	</section>
	<section id="featured-collection">
		<div class="content-wrapper">
			<div class="featured-collection-image" role="img" aria-label="Architectural elevation of a house with two gables and two chimneys by Howe, Manning and Almy Architects, dated 1927." style="background-image: url('https://libraries.mit.edu/app/uploads/2026/07/Howe-Manning-Almy-1.jpg');">
				<span class="featured-collection-tag">Exhibit</span>
			</div>
			<div class="featured-collection-content">
				<h2 class="sr">Featured Exhibit</h2>
				<p class="eyebrow">Howe, Manning & Almy Exhibit</p>
				<h3>Boston's First All-Woman Firm and the Changing Face of Architecture</h3>
				<p>Learn about the role MIT’s architecture program played in supporting women in the field since the 1890s, Howe, Manning & Almy’s influence on the built environment of Cambridge, and the firm’s ecofriendly approaches to renovation.</p>
				<a class="button secondary" title="Read more about the Howe, Manning & Almy exhibit" href="https://libraries.mit.edu/exhibits/exhibit/howe-manning-almy/">Check it out</a>
			</div>
		</div>
	</section>

</main>

<?php
	get_footer( 'v2' );
?>
