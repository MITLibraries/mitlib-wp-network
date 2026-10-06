/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { headline, blurb, icon, link } = attributes;
	const blockProps = useBlockProps.save();

	return (
		<div { ...blockProps }>
			<i className={ `fa-light fa-${ icon }`} aria-hidden="true" role="img"></i>
			<div className="option-box-content">
				<h3><a href={ link }><RichText.Content value={ headline } /></a></h3>
				<p>{ blurb }</p>
			</div>
		</div>
	);
}
