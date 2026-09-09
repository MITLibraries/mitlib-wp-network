/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, Spinner } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { heading, featuredExpertId } = attributes;

	const { experts, hasResolvedExperts } = useSelect( ( select ) => {
		const query = { per_page: -1, status: 'publish', orderby: 'title', order: 'asc' };
		return {
			experts: select( coreStore ).getEntityRecords( 'postType', 'experts', query ),
			hasResolvedExperts: select( coreStore ).hasFinishedResolution( 'getEntityRecords', [ 'postType', 'experts', query ] ),
		};
	}, [] );

	const expertOptions = [
		{ label: __( 'Select a librarian…', 'mitlib-blocks' ), value: 0 },
		...( experts || [] ).map( ( expert ) => ( {
			label: expert.title.rendered,
			value: expert.id,
		} ) ),
	];

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={ __( 'Featured Librarian', 'mitlib-blocks' ) }>
					{ hasResolvedExperts ? (
						<SelectControl
							label={ __( 'Featured librarian', 'mitlib-blocks' ) }
							value={ featuredExpertId }
							options={ expertOptions }
							onChange={ ( value ) => setAttributes( { featuredExpertId: Number( value ) } ) }
						/>
					) : (
						<Spinner />
					) }
				</PanelBody>
			</InspectorControls>
			<RichText
				tagName="h2"
				value={ heading }
				onChange={ ( value ) => setAttributes( { heading: value } ) }
				placeholder={ __( 'Featured', 'mitlib-blocks' ) }
				allowedFormats={ [] }
			/>
		</div>
	);
}
