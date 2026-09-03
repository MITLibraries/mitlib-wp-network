/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { heading, linkText, linkUrl } = attributes;

	return (
		<>
		<InspectorControls>
			<PanelBody title={ __( 'Link Settings', 'mitlib-block-hours-section' ) }>
				<TextControl
					label={ __( 'Link text', 'mitlib-block-hours-section' ) }
					value={ linkText }
					onChange={ ( value ) => setAttributes( { linkText: value } ) }
				/>
				<TextControl
					label={ __( 'Link URL', 'mitlib-block-hours-section' ) }
					value={ linkUrl }
					onChange={ ( value ) => setAttributes( { linkUrl: value } ) }
					type="url"
				/>
			</PanelBody>
		</InspectorControls>
		<section { ...useBlockProps() } id="todays-hours">
			<div class="content-wrapper">
				<RichText
					tagName="h2"
					value={ heading }
					onChange={ ( value ) => setAttributes( { heading: value } ) }
					placeholder={ __( 'Today\'s hours', 'mitlib-block-hours-section' ) }
					allowedFormats={ [] }
				/>
			</div>
		</section>
		</>
	);
}
