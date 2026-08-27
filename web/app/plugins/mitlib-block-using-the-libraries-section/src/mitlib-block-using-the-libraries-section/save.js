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
		<section id="using-the-libraries">
			<div class="content-wrapper">
				<h2>Using the Libraries</h2>
				<div class="box-wrapper">
				<div class="option-boxes">
					<div>
						<i class="fa-light fa-lightbulb" aria-hidden="true" role="img"></i>
						<div class="option-box-content">
							<h3><a href="/study">Find a study space</a></h3>
							<p>Quiet and group spaces—many available 24/7</p>
						</div>
					</div>
					<div>
						<i class="fa-light fa-file-alt" aria-hidden="true" role="img"></i>
						<div class="option-box-content">
							<h3><a href="/get-materials">Learn how to get materials</a></h3>
							<p>Find, request, and get articles, books, and more</p>
						</div>
					</div>
					<div>
						<i class="fa-light fa-book" aria-hidden="true" role="img"></i>
						<div class="option-box-content">
							<h3><a href="/experts">Discover guides &amp; librarians</a></h3>
							<p>Resource and class guides with experts for every subject</p>
						</div>
					</div>
					<div>
						<i class="fa-light fa-database" aria-hidden="true" role="img"></i>
						<div class="option-box-content">
							<h3><a href="/data-services">Find and manage data</a></h3>
							<p>Get support from creating and visualizing to using and sharing data</p>
						</div>
					</div>												
				</div>
				<div class="ask-us-box">
						<i class="fa-light fa-messages-question" aria-hidden="true" role="img"></i>
						<div class="option-box-content">
							<h3>Ask Us</h3>
							<p>Get help via email, live chat with staff, and book appointments</p>
							<div class="ask-us-links">
								<div id="libchat_fa6edc50fe81603743870ca1772bc5b2e7e121436b62ba7da331b9dcabf289c0"></div>
								<a href="/ask">All help options</a>						
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	);
}
