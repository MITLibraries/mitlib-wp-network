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
	TextControl,
	TextareaControl,
	Button,
} from '@wordpress/components';
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
		itemType,
		title,
		description,
		linkUrl,
		imageUrl,
		imageAlt,
		imagePosition,
	} = attributes;

	const onSelectImage = ( media ) =>
		setAttributes( {
			imageId: media.id,
			imageUrl: media.url,
			imageAlt: media.alt || '',
		} );

	const clearImage = () =>
		setAttributes( {
			imageId: 0,
			imageUrl: '',
			imageAlt: '',
		} );

	const itemTypeLabel =
		ITEM_TYPES.find( ( type ) => type.value === itemType )?.label ??
		itemType;

	const showThumb = 'none' !== imagePosition && imageUrl;

	const blockProps = useBlockProps( {
		className: `mitlib-featured-item-card is-image-${ imagePosition }`,
	} );

	return (
		<div { ...blockProps }>
			<InspectorControls>
				<PanelBody title={ __( 'Featured Item', 'mitlib-blocks' ) }>
					<SelectControl
						label={ __( 'Item type', 'mitlib-blocks' ) }
						value={ itemType }
						options={ ITEM_TYPES }
						onChange={ ( value ) =>
							setAttributes( { itemType: value } )
						}
					/>
					<TextControl
						label={ __( 'Title', 'mitlib-blocks' ) }
						value={ title }
						onChange={ ( value ) =>
							setAttributes( { title: value } )
						}
						help={ __(
							'<em> and <strong> tags are allowed.',
							'mitlib-blocks'
						) }
					/>
					<TextareaControl
						label={ __( 'Description', 'mitlib-blocks' ) }
						value={ description }
						onChange={ ( value ) =>
							setAttributes( { description: value } )
						}
					/>
					<TextControl
						label={ __( 'Link URL', 'mitlib-blocks' ) }
						value={ linkUrl }
						onChange={ ( value ) =>
							setAttributes( { linkUrl: value } )
						}
						type="url"
					/>
					<SelectControl
						label={ __( 'Image position', 'mitlib-blocks' ) }
						value={ imagePosition }
						options={ IMAGE_POSITIONS }
						onChange={ ( value ) =>
							setAttributes( { imagePosition: value } )
						}
					/>
					{ imageUrl && (
						<img
							className="mitlib-featured-item-image-preview"
							src={ imageUrl }
							alt={ imageAlt }
						/>
					) }
					<MediaUploadCheck>
						<MediaUpload
							onSelect={ onSelectImage }
							allowedTypes={ [ 'image' ] }
							render={ ( { open } ) => (
								<Button variant="secondary" onClick={ open }>
									{ imageUrl
										? __( 'Replace image', 'mitlib-blocks' )
										: __(
												'Select image',
												'mitlib-blocks'
											) }
								</Button>
							) }
						/>
						{ imageUrl && (
							<Button
								variant="link"
								isDestructive
								onClick={ clearImage }
							>
								{ __( 'Remove image', 'mitlib-blocks' ) }
							</Button>
						) }
					</MediaUploadCheck>
				</PanelBody>
			</InspectorControls>
			{ showThumb && (
				<img
					className="mitlib-featured-item-card__thumb"
					src={ imageUrl }
					alt={ imageAlt }
				/>
			) }
			<div>
				<span className="mitlib-featured-item-card__type">
					{ itemTypeLabel }
				</span>
				<RichText.Content
					tagName="span"
					className="mitlib-featured-item-card__title"
					value={ title || __( '(No title set)', 'mitlib-blocks' ) }
				/>
				<p className="mitlib-featured-item-card__description">
					{ description }
				</p>
			</div>
		</div>
	);
}
