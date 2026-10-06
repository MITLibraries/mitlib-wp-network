/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { locationName } = attributes;

	return (
		<li>
			<span className="library-name">
				<a className="link-no-underline" href="/hayden">
					<RichText.Content value={ locationName } />
				</a>
			</span>
			<span className="library-hours">
				<span data-location-hours="Hayden Library"></span>
			</span>
			<span className="library-study">
				<i
					className="fa-light fa-moon"
					aria-hidden="true"
					role="img"
				></i>
				24/7 study
			</span>
		</li>
	);
}
