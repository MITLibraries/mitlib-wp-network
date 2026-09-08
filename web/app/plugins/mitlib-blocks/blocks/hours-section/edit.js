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
} from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { heading, linkText, linkUrl } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Link Settings', 'mitlib-blocks' ) }>
					<TextControl
						label={ __( 'Link text', 'mitlib-blocks' ) }
						value={ linkText }
						onChange={ ( value ) =>
							setAttributes( { linkText: value } )
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
				</PanelBody>
			</InspectorControls>
			<section { ...useBlockProps() } id="todays-hours">
				<div className="content-wrapper">
					<RichText
						tagName="h2"
						value={ heading }
						onChange={ ( value ) =>
							setAttributes( { heading: value } )
						}
						placeholder={ __( "Today's hours", 'mitlib-blocks' ) }
						allowedFormats={ [] }
					/>
				</div>
			</section>
		</>
	);
}
