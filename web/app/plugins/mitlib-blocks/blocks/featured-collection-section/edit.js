/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import {
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	useBlockProps,
} from '@wordpress/block-editor';
import {
	Button,
	Notice,
	PanelBody,
	SelectControl,
	TextareaControl,
	TextControl,
} from '@wordpress/components';
import { useDispatch } from '@wordpress/data';
import { useEffect } from '@wordpress/element';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Block properties.
 * @param {Object}   props.attributes    Saved block attributes.
 * @param {string}   props.clientId      Unique block instance ID.
 * @param {Function} props.setAttributes Updates block attributes.
 * @return {Element} Element to render.
 */
export default function Edit( props ) {
	const { attributes, clientId, setAttributes } = props;
	const {
		featuredItemType,
		title,
		description,
		linkUrl,
		linkText,
		imageId,
		imageUrl,
	} = attributes;
	const hasImage = Boolean( imageUrl?.trim() );
	const saveLock = `mitlib/featured-collection-section/${ clientId }`;
	const { lockPostSaving, unlockPostSaving } = useDispatch( 'core/editor' );

	useEffect( () => {
		if ( ! hasImage ) {
			lockPostSaving( saveLock );
		}

		return () => unlockPostSaving( saveLock );
	}, [ hasImage, saveLock, lockPostSaving, unlockPostSaving ] );

	return (
		<div { ...useBlockProps() }>
			{ ! hasImage && (
				<Notice status="error" isDismissible={ false }>
					Featured Collection requires an image before saving.
				</Notice>
			) }
			<InspectorControls>
				<PanelBody title="Featured Item">
					<SelectControl
						label="Featured Item Type"
						value={ featuredItemType }
						options={ [
							{
								label: 'Exhibit',
								value: 'Exhibit',
							},
							{
								label: 'Collection',
								value: 'Collection',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { featuredItemType: value } )
						}
					/>
					<TextControl
						label="Title"
						value={ title }
						onChange={ ( value ) =>
							setAttributes( { title: value } )
						}
					/>
					<TextareaControl
						label="Description"
						value={ description }
						onChange={ ( value ) =>
							setAttributes( { description: value } )
						}
					/>
					<TextControl
						label="Link URL"
						type="url"
						value={ linkUrl }
						onChange={ ( value ) =>
							setAttributes( { linkUrl: value } )
						}
					/>
					<TextControl
						label="Link Text"
						value={ linkText }
						onChange={ ( value ) =>
							setAttributes( { linkText: value } )
						}
					/>
				</PanelBody>
				<PanelBody title="Image">
					<MediaUploadCheck>
						<MediaUpload
							allowedTypes={ [ 'image' ] }
							value={ imageId }
							onSelect={ ( media ) =>
								setAttributes( {
									imageId: media.id,
									imageUrl: media.url,
								} )
							}
							render={ ( { open } ) => (
								<Button variant="secondary" onClick={ open }>
									{ imageUrl
										? 'Replace image'
										: 'Select image' }
								</Button>
							) }
						/>
					</MediaUploadCheck>
					{ imageUrl && (
						<Button
							variant="tertiary"
							isDestructive
							onClick={ () =>
								setAttributes( { imageId: 0, imageUrl: '' } )
							}
						>
							Remove image
						</Button>
					) }
				</PanelBody>
			</InspectorControls>
			<section className="featured-collection-preview">
				<div className="content-wrapper">
					<div
						className="featured-collection-image"
						style={
							imageUrl
								? { backgroundImage: `url("${ imageUrl }")` }
								: undefined
						}
					>
						<span className="featured-collection-tag">
							{ featuredItemType }
						</span>
					</div>
					<div className="featured-collection-content">
						<h2 className="screen-reader-text">
							Featured { featuredItemType }
						</h2>
						<h3>{ title }</h3>
						<p>{ description }</p>
						{ linkUrl && (
							<a
								className="button secondary"
								href={ linkUrl }
								onClick={ ( event ) => event.preventDefault() }
							>
								{ linkText }
							</a>
						) }
					</div>
				</div>
			</section>
		</div>
	);
}
