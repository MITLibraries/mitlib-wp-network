/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { heading, linkText, linkUrl } = attributes;

	return (
		<section id="todays-hours">
			<div className="content-wrapper">
				<RichText.Content tagName="h2" value={ heading } />
				<ol className="hours-list">
					<li>
						<span className="library-name"><a className="link-no-underline" href="/hayden">Hayden Library</a></span>
						<span className="library-hours"><span data-location-hours="Hayden Library"></span></span>
						<span className="library-study">
							<i className="fa-light fa-moon" aria-hidden="true" role="img"></i>
							24/7 study
						</span>
					</li>
					<li className="hour-rotch">
						<span className="library-name"><a className="link-no-underline" href="/rotch">Rotch Library</a></span>
						<span className="library-hours"><span data-location-hours="Rotch Library"></span></span>
						<span className="library-study">
							<i className="fa-light fa-moon" aria-hidden="true" role="img"></i>
							24/7 study
						</span>
					</li>
					<li className="hour-barker">
						<span className="library-name"><a className="link-no-underline" href="/barker">Barker Library</a></span>
						<span className="library-hours"><span data-location-hours="Barker Library"></span></span>
						<span className="library-study">
							<i className="fa-light fa-moon" aria-hidden="true" role="img"></i>
							24/7 study
						</span>
					</li>
					<li className="hour-lewis">
						<span className="library-name"><a className="link-no-underline" href="/music">Lewis Music Library</a></span>
						<span className="library-hours"><span data-location-hours="Lewis Music Library"></span></span>
						<span className="library-study"></span>
					</li>
				</ol>
				<a href={ linkUrl } className="link-on-dark">{ linkText }</a>
			</div>
		</section>
	);
}
