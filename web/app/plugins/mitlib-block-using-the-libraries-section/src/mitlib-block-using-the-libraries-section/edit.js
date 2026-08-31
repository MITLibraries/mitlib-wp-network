/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { heading, askUsTitle, askUsDescription, askUsLinkText, askUsLinkUrl } = attributes;

	return (
		<>
		<InspectorControls>
			<PanelBody title={ __( 'Ask Us Box', 'mitlib-block-using-the-libraries-section' ) }>
				<TextControl
					label={ __( 'Title', 'mitlib-block-using-the-libraries-section' ) }
					value={ askUsTitle }
					onChange={ ( value ) => setAttributes( { askUsTitle: value } ) }
				/>
				<TextareaControl
					label={ __( 'Description', 'mitlib-block-using-the-libraries-section' ) }
					value={ askUsDescription }
					onChange={ ( value ) => setAttributes( { askUsDescription: value } ) }
				/>
				<TextControl
					label={ __( 'Link text', 'mitlib-block-using-the-libraries-section' ) }
					value={ askUsLinkText }
					onChange={ ( value ) => setAttributes( { askUsLinkText: value } ) }
				/>
				<TextControl
					label={ __( 'Link URL', 'mitlib-block-using-the-libraries-section' ) }
					value={ askUsLinkUrl }
					onChange={ ( value ) => setAttributes( { askUsLinkUrl: value } ) }
					type="url"
				/>
			</PanelBody>
		</InspectorControls>
		<section { ...useBlockProps() } id="using-the-libraries">
			<div class="content-wrapper">
				<RichText
					tagName="h2"
					value={ heading }
					onChange={ ( value ) => setAttributes( { heading: value } ) }
					placeholder={ __( 'Using the Libraries', 'mitlib-block-using-the-libraries-section' ) }
					allowedFormats={ [] }
				/>
			</div>
		</section>
		</>
	);
}
