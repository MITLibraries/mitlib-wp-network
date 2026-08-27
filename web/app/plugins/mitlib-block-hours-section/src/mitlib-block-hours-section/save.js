/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save() {
	return (
		<section id="todays-hours">
			<div class="content-wrapper">
				<h2>Today's hours</h2>
				<ol class="hours-list">
					<li>
						<span class="library-name"><a class="link-no-underline" href="/hayden">Hayden Library</a></span>
						<span class="library-hours"><span data-location-hours="Hayden Library"></span></span>
						<span class="library-study">
							<i class="fa-light fa-moon" aria-hidden="true" role="img"></i>
							24/7 study
						</span>
					</li>
					<li class="hour-rotch">
						<span class="library-name"><a class="link-no-underline" href="/rotch">Rotch Library</a></span>
						<span class="library-hours"><span data-location-hours="Rotch Library"></span></span>
						<span class="library-study">
							<i class="fa-light fa-moon" aria-hidden="true" role="img"></i>
							24/7 study
						</span>
					</li>				
					<li class="hour-barker">
						<span class="library-name"><a class="link-no-underline" href="/barker">Barker Library</a></span>
						<span class="library-hours"><span data-location-hours="Barker Library"></span></span>
						<span class="library-study">
							<i class="fa-light fa-moon" aria-hidden="true" role="img"></i>
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
	);
}
