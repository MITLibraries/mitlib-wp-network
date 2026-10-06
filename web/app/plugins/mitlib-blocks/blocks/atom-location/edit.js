import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { locationName } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title={ 'Link Settings' }>
					<TextControl
						label={ 'Location name' }
						value={ locationName }
						onChange={ ( value ) =>
							setAttributes( { locationName: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<section { ...useBlockProps() } id="todays-hours">
				<div className="content-wrapper">
					<RichText
						tagName="h2"
						value={ locationName }
						onChange={ ( value ) =>
							setAttributes( { locationName: value } )
						}
						placeholder={ "Today's hours" }
						allowedFormats={ [] }
					/>
				</div>
			</section>
		</>
	);
}
