/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
	RichText,
	InnerBlocks,
	InspectorControls,
	store as blockEditorStore,
} from '@wordpress/block-editor';
import { Notice, PanelBody, ToggleControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import './editor.scss';

const MIN_ITEMS = 3;
const MAX_ITEMS = 6;

const ALLOWED_BLOCKS = [ 'mitlib/featured-item', 'mitlib/featured-expert' ];

const TEMPLATE = [
	[
		'mitlib/featured-item',
		{
			itemType: 'spotlight',
			title: 'Read <em>Exhalation</em> by Ted Chiang',
			description:
				'To celebrate 10 years of MIT Reads, President Sally Kornbluth has chosen our fall 2026 selection',
			linkUrl: 'https://libraries.mit.edu/mit-reads/',
			imageUrl:
				'https://libraries.mit.edu/app/uploads/2026/09/mit-reads-highlight.png',
			imageAlt:
				'Exhalation book cover and MIT Reads logo; text reads Fall 2026 selection',
			imagePosition: 'above',
		},
	],
	[ 'mitlib/featured-expert' ],
	[
		'mitlib/featured-item',
		{
			itemType: 'service',
			title: 'New! Self-service lockers',
			description:
				'Pick up and drop off library items 24 hours a day, seven days a week',
			linkUrl: 'https://libraries.mit.edu/locations/lockers/',
			imageUrl:
				'https://libraries.mit.edu/app/uploads/2026/08/XKQoSUbi-1.png',
			imageAlt:
				'A white, two-column locker with a digital screen and text reading "MIT Libraries, Pickup Locker"',
			imagePosition: 'left',
		},
	],
	[
		'mitlib/featured-item',
		{
			itemType: 'service',
			title: 'Service updates',
			description:
				'The latest information about access to library collections, spaces, and services',
			linkUrl: 'https://libraries.mit.edu/about/service-updates/',
			imagePosition: 'none',
		},
	],
	[
		'mitlib/featured-item',
		{
			itemType: 'resource',
			title: 'The New York Times',
			description:
				'A digital edition subscription is available to all MIT students, faculty, and staff.',
			linkUrl: 'https://libguides.mit.edu/news/nyt',
			imagePosition: 'none',
		},
	],
	[
		'mitlib/featured-item',
		{
			itemType: 'service',
			title: 'Geographic Information Systems (GIS)',
			description:
				'Our experts can help you use GIS software, find data, teach GIS concepts, and more.',
			linkUrl: 'https://libguides.mit.edu/gis',
			imagePosition: 'none',
		},
	],
];

export default function Edit( { attributes, setAttributes, clientId } ) {
	const { heading, showEvents } = attributes;

	const itemCount = useSelect(
		( select ) => select( blockEditorStore ).getBlockCount( clientId ),
		[ clientId ]
	);

	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'featured-items' },
		{
			allowedBlocks: ALLOWED_BLOCKS,
			template: TEMPLATE,
			renderAppender:
				itemCount >= MAX_ITEMS
					? false
					: InnerBlocks.ButtonBlockAppender,
		}
	);

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={ __( 'Section Settings', 'mitlib-blocks' ) }>
					<ToggleControl
						label={ __( 'Show events feed', 'mitlib-blocks' ) }
						checked={ showEvents }
						onChange={ ( value ) =>
							setAttributes( { showEvents: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<RichText
				tagName="h2"
				value={ heading }
				onChange={ ( value ) => setAttributes( { heading: value } ) }
				placeholder={ __( 'Featured', 'mitlib-blocks' ) }
				allowedFormats={ [] }
			/>
			{ itemCount < MIN_ITEMS && (
				<Notice status="warning" isDismissible={ false }>
					{ __(
						'This section needs at least 3 featured items.',
						'mitlib-blocks'
					) }
				</Notice>
			) }
			<div { ...innerBlocksProps } />
			{ showEvents && (
				<div className="mitlib-events-feed-placeholder">
					{ __(
						'Events & Workshops feed will be shown.',
						'mitlib-blocks'
					) }
				</div>
			) }
		</div>
	);
}
