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
	PanelBody,
	SelectControl,
	TextareaControl,
	TextControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
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
 * @param {Function} props.setAttributes Updates block attributes.
 * @return {Element} Element to render.
 */
export default function Edit( props ) {
	const { attributes, setAttributes } = props;
	const {
		featuredItemType,
		title,
		description,
		linkUrl,
		linkText,
		imageId,
		imageUrl,
	} = attributes;

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={ __( 'Featured Item', 'mitlib-blocks' ) }>
					<SelectControl
						label={ __( 'Featured Item Type', 'mitlib-blocks' ) }
						value={ featuredItemType }
						options={ [
							{
								label: __( 'Exhibit', 'mitlib-blocks' ),
								value: 'Exhibit',
							},
							{
								label: __( 'Collection', 'mitlib-blocks' ),
								value: 'Collection',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { featuredItemType: value } )
						}
					/>
					<TextControl
						label={ __( 'Title', 'mitlib-blocks' ) }
						value={ title }
						onChange={ ( value ) =>
							setAttributes( { title: value } )
						}
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
						type="url"
						value={ linkUrl }
						onChange={ ( value ) =>
							setAttributes( { linkUrl: value } )
						}
					/>
					<TextControl
						label={ __( 'Link Text', 'mitlib-blocks' ) }
						value={ linkText }
						onChange={ ( value ) =>
							setAttributes( { linkText: value } )
						}
					/>
				</PanelBody>
				<PanelBody title={ __( 'Image', 'mitlib-blocks' ) }>
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
										? __( 'Replace image', 'mitlib-blocks' )
										: __(
												'Select image',
												'mitlib-blocks'
											) }
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
							{ __( 'Remove image', 'mitlib-blocks' ) }
						</Button>
					) }
				</PanelBody>
			</InspectorControls>
			<h2>{ `${ __( 'Featured', 'mitlib-blocks' ) } ${ featuredItemType }` }</h2>
			{ imageUrl && (
				<div
					style={ {
						backgroundImage: `url("${ imageUrl }")`,
						backgroundSize: 'cover',
						backgroundPosition: 'center',
						aspectRatio: '16 / 9',
					} }
				/>
			) }
			<h3>{ title }</h3>
			<p>{ description }</p>
			<span>{ linkText }</span>
		</div>
	);
}
