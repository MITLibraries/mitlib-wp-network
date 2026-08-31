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
				<ol class="hours-list">
					<li>
						<span class="library-name"><a class="link-no-underline" href="/hayden">Hayden Library</a></span>
						<span class="library-hours"><span data-location-hours="Hayden Library"></span></span>
						<span class="library-study">
							<i class="fa-light fa-moon" aria-hidden="true" role="img"></i>
							24/7 study
						</span>
					</li>
					<li class="hour-rotch">
						<span class="library-name"><a class="link-no-underline" href="/rotch">Rotch Library</a></span>
						<span class="library-hours"><span data-location-hours="Rotch Library"></span></span>
						<span class="library-study">
							<i class="fa-light fa-moon" aria-hidden="true" role="img"></i>
							24/7 study
						</span>
					</li>
					<li class="hour-barker">
						<span class="library-name"><a class="link-no-underline" href="/barker">Barker Library</a></span>
						<span class="library-hours"><span data-location-hours="Barker Library"></span></span>
						<span class="library-study">
							<i class="fa-light fa-moon" aria-hidden="true" role="img"></i>
							24/7 study
						</span>
					</li>
					<li class="hour-lewis">
						<span class="library-name"><a class="link-no-underline" href="/music">Lewis Music Library</a></span>
						<span class="library-hours"><span data-location-hours="Lewis Music Library"></span></span>
						<span class="library-study"></span>
					</li>
				</ol>
				<a href={ linkUrl } class="link-on-dark">{ linkText }</a>
			</div>
		</section>
		</>
	);
}
