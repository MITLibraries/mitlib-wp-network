/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { RichText } from '@wordpress/block-editor';
import { ExternalLink } from '@wordpress/components';

export default function save( { attributes } ) {
	const { headline, blurb, icon, link } = attributes;

	return (
		<div>
			<RichText.Content
				tagname="i"
				className="fa-light fa-{ icon }"
				aria-hidden="true"
				role="img"
			/>
			<div className="option-box-content">
				<RichText.Content tagname="h3" value={ headline }>
					<ExternalLink href={ link } />
				</RichText.Content>
				<RichText.Content tagname="p" value={ blurb } />
			</div>
		</div>
	);
}
