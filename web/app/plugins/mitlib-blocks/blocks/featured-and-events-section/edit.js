/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	Spinner,
	TextControl,
	TextareaControl,
	Button,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import './editor.scss';

const ITEM_TYPES = [
	{ label: __( 'Spotlight', 'mitlib-blocks' ), value: 'spotlight' },
	{ label: __( 'Service', 'mitlib-blocks' ), value: 'service' },
	{ label: __( 'Resource', 'mitlib-blocks' ), value: 'resource' },
	{ label: __( 'News', 'mitlib-blocks' ), value: 'news' },
];

const IMAGE_POSITIONS = [
	{ label: __( 'None', 'mitlib-blocks' ), value: 'none' },
	{ label: __( 'Above', 'mitlib-blocks' ), value: 'above' },
	{ label: __( 'Left', 'mitlib-blocks' ), value: 'left' },
];

export default function Edit( { attributes, setAttributes } ) {
	const {
		heading,
		featuredExpertId,
		spotlightItemType,
		spotlightTitle,
		spotlightDescription,
		spotlightLinkUrl,
		spotlightImageUrl,
		spotlightImageAlt,
		spotlightImagePosition,
	} = attributes;

	const onSelectSpotlightImage = ( media ) =>
		setAttributes( {
			spotlightImageId: media.id,
			spotlightImageUrl: media.url,
			spotlightImageAlt: media.alt || '',
		} );

	const clearSpotlightImage = () =>
		setAttributes( {
			spotlightImageId: 0,
			spotlightImageUrl: '',
			spotlightImageAlt: '',
		} );

	const { experts, hasResolvedExperts } = useSelect( ( select ) => {
		const query = {
			per_page: -1,
			status: 'publish',
			orderby: 'title',
			order: 'asc',
		};
		return {
			experts: select( coreStore ).getEntityRecords(
				'postType',
				'experts',
				query
			),
			hasResolvedExperts: select( coreStore ).hasFinishedResolution(
				'getEntityRecords',
				[ 'postType', 'experts', query ]
			),
		};
	}, [] );

	const expertOptions = [
		{ label: __( 'Select an expert…', 'mitlib-blocks' ), value: 0 },
		...( experts || [] ).map( ( expert ) => ( {
			label: expert.title.rendered,
			value: expert.id,
		} ) ),
	];

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={ __( 'Large Spotlight', 'mitlib-blocks' ) }>
					<SelectControl
						label={ __( 'Item type', 'mitlib-blocks' ) }
						value={ spotlightItemType }
						options={ ITEM_TYPES }
						onChange={ ( value ) =>
							setAttributes( { spotlightItemType: value } )
						}
					/>
					<TextControl
						label={ __( 'Title', 'mitlib-blocks' ) }
						value={ spotlightTitle }
						onChange={ ( value ) =>
							setAttributes( { spotlightTitle: value } )
						}
						help={ __(
							'<em> and <strong> tags are allowed.',
							'mitlib-blocks'
						) }
					/>
					<TextareaControl
						label={ __( 'Description', 'mitlib-blocks' ) }
						value={ spotlightDescription }
						onChange={ ( value ) =>
							setAttributes( { spotlightDescription: value } )
						}
					/>
					<TextControl
						label={ __( 'Link URL', 'mitlib-blocks' ) }
						value={ spotlightLinkUrl }
						onChange={ ( value ) =>
							setAttributes( { spotlightLinkUrl: value } )
						}
						type="url"
					/>
					<SelectControl
						label={ __( 'Image position', 'mitlib-blocks' ) }
						value={ spotlightImagePosition }
						options={ IMAGE_POSITIONS }
						onChange={ ( value ) =>
							setAttributes( { spotlightImagePosition: value } )
						}
					/>
					{ spotlightImageUrl && (
						<img
							className="mitlib-spotlight-image-preview"
							src={ spotlightImageUrl }
							alt={ spotlightImageAlt }
						/>
					) }
					<MediaUploadCheck>
						<MediaUpload
							onSelect={ onSelectSpotlightImage }
							allowedTypes={ [ 'image' ] }
							render={ ( { open } ) => (
								<Button variant="secondary" onClick={ open }>
									{ spotlightImageUrl
										? __( 'Replace image', 'mitlib-blocks' )
										: __(
												'Select image',
												'mitlib-blocks'
											) }
								</Button>
							) }
						/>
						{ spotlightImageUrl && (
							<Button
								variant="link"
								isDestructive
								onClick={ clearSpotlightImage }
							>
								{ __( 'Remove image', 'mitlib-blocks' ) }
							</Button>
						) }
					</MediaUploadCheck>
				</PanelBody>
				<PanelBody title={ __( 'Featured Expert', 'mitlib-blocks' ) }>
					{ hasResolvedExperts ? (
						<SelectControl
							label={ __( 'Featured expert', 'mitlib-blocks' ) }
							value={ featuredExpertId }
							options={ expertOptions }
							onChange={ ( value ) =>
								setAttributes( {
									featuredExpertId: Number( value ),
								} )
							}
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
