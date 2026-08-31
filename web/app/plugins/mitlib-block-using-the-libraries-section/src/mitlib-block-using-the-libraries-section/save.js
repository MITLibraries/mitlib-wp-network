/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { heading, askUsTitle, askUsDescription, askUsLinkText, askUsLinkUrl } = attributes;

	return (
		<section id="using-the-libraries">
			<div class="content-wrapper">
				<RichText.Content tagName="h2" value={ heading } />
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
							<h3>{ askUsTitle }</h3>
							<p>{ askUsDescription }</p>
							<div class="ask-us-links">
								<div id="libchat_fa6edc50fe81603743870ca1772bc5b2e7e121436b62ba7da331b9dcabf289c0"></div>
								<a href={ askUsLinkUrl }>{ askUsLinkText }</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	);
}
