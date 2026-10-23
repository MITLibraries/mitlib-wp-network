import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextareaControl, TextControl } from '@wordpress/components';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { title, description, icon, linkUrl } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title={ 'Using the Libraries Item' }>
					<TextControl
						label={ 'Title' }
						value={ title }
						onChange={ ( value ) =>
							setAttributes( { title: value } )
						}
						placeholder={ 'Find a study space' }
					/>
					<TextareaControl
						label={ 'Description' }
						value={ description }
						onChange={ ( value ) =>
							setAttributes( { description: value } )
						}
						placeholder={
							'Quiet and group spaces - many available 24/7'
						}
					/>
					<TextControl
						label={ 'Icon' }
						value={ icon }
						onChange={ ( value ) =>
							setAttributes( { icon: value } )
						}
						placeholder={ 'lightbulb' }
					/>
					<TextControl
						label={ 'Link' }
						value={ linkUrl }
						onChange={ ( value ) =>
							setAttributes( { linkUrl: value } )
						}
						placeholder={ '/study' }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps() }>
				<div className="content-wrapper">
					<div>
						<i className={ `fa-light fa-${ icon }` }></i>
					</div>
					<h3>{ title }</h3>
					<div>{ description }</div>
				</div>
			</div>
		</>
	);
}
