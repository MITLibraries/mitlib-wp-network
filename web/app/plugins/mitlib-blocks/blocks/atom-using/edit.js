import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { headline, blurb, icon, link } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title={ 'Blurb contents' }>
					<TextControl
						label={ 'Blurb' }
						value={ blurb }
						onChange={ ( value ) =>
							setAttributes( { blurb: value } )
						}
					/>
					<TextControl
						label={ 'Icon' }
						value={ icon }
						onChange={ ( value ) =>
							setAttributes( { icon: value } )
						}
					/>
					<TextControl
						label={ 'Link' }
						value={ link }
						onChange={ ( value ) =>
							setAttributes( { link: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<section { ...useBlockProps() }>
				<div className="content-wrapper">
					<RichText
						tagName="h3"
						value={ headline }
						onChange={ ( value ) =>
							setAttributes( { headline: value } )
						}
						placeholder={ 'Using the libraries ...' }
						allowedFormats={ [] }
					/>
				</div>
			</section>
		</>
	);
}
