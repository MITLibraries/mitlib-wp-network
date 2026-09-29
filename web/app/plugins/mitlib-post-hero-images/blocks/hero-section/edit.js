/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl, Spinner } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { heading, heroImageId } = attributes;

	const { heroImages, hasResolvedHeroImages } = useSelect( ( select ) => {
		const query = {
			per_page: -1,
			status: 'publish',
			orderby: 'title',
			order: 'asc',
		};
		return {
			heroImages: select( coreStore ).getEntityRecords(
				'postType',
				'hero_images',
				query
			),
			hasResolvedHeroImages: select( coreStore ).hasFinishedResolution(
				'getEntityRecords',
				[ 'postType', 'hero_images', query ]
			),
		};
	}, [] );

	const heroImageOptions = [
		{ label: __( 'Select a hero image…', 'mitlib-post-hero-images' ), value: 0 },
		...( heroImages || [] ).map( ( heroImage ) => ( {
			label: heroImage.title.rendered,
			value: heroImage.id,
		} ) ),
	];

	const blockProps = useBlockProps();

	return (
		<div { ...blockProps }>
			<InspectorControls>
				<PanelBody title={ __( 'Hero Image', 'mitlib-post-hero-images' ) }>
					{ hasResolvedHeroImages ? (
						<SelectControl
							label={ __( 'Hero image', 'mitlib-post-hero-images' ) }
							value={ heroImageId }
							options={ heroImageOptions }
							onChange={ ( value ) =>
								setAttributes( {
									heroImageId: Number( value ),
								} )
							}
						/>
					) : (
						<Spinner />
					) }
				</PanelBody>
			</InspectorControls>
			<RichText
				tagName="h1"
				value={ heading }
				onChange={ ( heading ) => setAttributes( { heading } ) }
				placeholder={ __( 'Enter heading…', 'mitlib-post-hero-images' ) }
			/>
		</div>
	);
}
