/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import {
	useBlockProps,
	useInnerBlocksProps,
	InspectorControls,
	store as blockEditorStore,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	TextareaControl,
	ToggleControl,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import './editor.scss';

export default function Edit( { attributes, setAttributes, clientId } ) {
	const {
		heading,
		allowedBlocks,
		showAskUs,
		askUsTitle,
		askUsDescription,
		askUsLinkText,
		askUsLinkUrl,
	} = attributes;

	const hasInnerBlocks = useSelect(
		( select ) =>
			select( blockEditorStore ).getBlockOrder( clientId ).length > 0,
		[ clientId ]
	);

	const blockProps = useBlockProps();

	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'using-the-libraries' },
		{ allowedBlocks }
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ 'Section' }>
					<TextControl
						label={ 'Section heading' }
						placeholder={ 'Using the Libraries' }
						value={ heading }
						onChange={ ( value ) =>
							setAttributes( { heading: value } )
						}
					/>
				</PanelBody>
				<PanelBody title={ 'Ask Us Box' }>
					<ToggleControl
						label={ 'Show "Ask Us" panel' }
						checked={ showAskUs }
						onChange={ ( value ) =>
							setAttributes( { showAskUs: value } )
						}
					/>
					<TextControl
						label={ 'Title' }
						value={ askUsTitle }
						onChange={ ( value ) =>
							setAttributes( { askUsTitle: value } )
						}
					/>
					<TextareaControl
						label={ 'Description' }
						value={ askUsDescription }
						onChange={ ( value ) =>
							setAttributes( { askUsDescription: value } )
						}
					/>
					<TextControl
						label={ 'Link text' }
						value={ askUsLinkText }
						onChange={ ( value ) =>
							setAttributes( { askUsLinkText: value } )
						}
					/>
					<TextControl
						label={ 'Link URL' }
						value={ askUsLinkUrl }
						onChange={ ( value ) =>
							setAttributes( { askUsLinkUrl: value } )
						}
						type="url"
					/>
				</PanelBody>
			</InspectorControls>
			<section { ...blockProps } id="using-the-libraries">
				<div className="content-wrapper">
					<h2>{ heading }</h2>
					<div className="box-wrapper">
						<div { ...innerBlocksProps } />
						{ ! hasInnerBlocks && (
							<div className="mitlib-placeholder">
								{
									' Showing default content until a using-item block is added.'
								}
							</div>
						) }
						{ showAskUs && (
							<div className="mitlib-placeholder">
								{ 'Ask Us widget will be shown.' }
							</div>
						) }
					</div>
				</div>
			</section>
		</>
	);
}
