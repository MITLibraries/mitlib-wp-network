import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, Spinner } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import './editor.scss';

// Mirrors the fallback in render.php when no expert has been selected.
const DEFAULT_EXPERT = {
	name: 'Alejandro Paz',
	firstName: 'Alejandro',
	image: 'https://libapps.s3.amazonaws.com/accounts/349/images/apaz-100x100.jpg',
	excerpt: 'Librarian for Energy and Environment',
};

const stripTags = ( value ) => ( value || '' ).replace( /<[^>]*>/g, '' ).trim();

const IMAGE_POSITIONS = [
	{ label: __( 'None', 'mitlib-blocks' ), value: 'none' },
	{ label: __( 'Above', 'mitlib-blocks' ), value: 'above' },
	{ label: __( 'Left', 'mitlib-blocks' ), value: 'left' },
];

export default function Edit( { attributes, setAttributes } ) {
	const { expertId, imagePosition } = attributes;

	const { experts, hasResolvedExperts } = useSelect( ( select ) => {
		const query = {
			per_page: -1,
			status: 'publish',
			orderby: 'title',
			order: 'asc',
			_embed: true,
		};
		return {
			experts: select( coreStore ).getEntityRecords(
				'postType',
				'experts',
				query
			),
			hasResolvedExperts: select( coreStore ).hasFinishedResolution(
				'getEntityRecords',
				[ 'postType', 'experts', query ]
			),
		};
	}, [] );

	const expertOptions = [
		{ label: __( 'Select an expert…', 'mitlib-blocks' ), value: 0 },
		...( experts || [] ).map( ( expert ) => ( {
			label: expert.title.rendered,
			value: expert.id,
		} ) ),
	];

	const selectedExpert = ( experts || [] ).find(
		( expert ) => expert.id === expertId
	);

	const expertName = selectedExpert
		? stripTags( selectedExpert.title.rendered )
		: DEFAULT_EXPERT.name;
	const expertExcerpt = selectedExpert
		? stripTags( selectedExpert.excerpt?.rendered )
		: DEFAULT_EXPERT.excerpt;
	const expertImage = selectedExpert
		? selectedExpert._embedded?.[ 'wp:featuredmedia' ]?.[ 0 ]?.source_url
		: DEFAULT_EXPERT.image;
	const expertFirstName = expertName.split( ' ' )[ 0 ];

	const showThumb = 'none' !== imagePosition && expertImage;

	const blockProps = useBlockProps( {
		className: `mitlib-featured-expert-card is-image-${ imagePosition }`,
	} );

	return (
		<div { ...blockProps }>
			<InspectorControls>
				<PanelBody title={ __( 'Featured Expert', 'mitlib-blocks' ) }>
					{ hasResolvedExperts ? (
						<SelectControl
							label={ __( 'Featured expert', 'mitlib-blocks' ) }
							value={ expertId }
							options={ expertOptions }
							onChange={ ( value ) =>
								setAttributes( { expertId: Number( value ) } )
							}
						/>
					) : (
						<Spinner />
					) }
					<SelectControl
						label={ __( 'Image position', 'mitlib-blocks' ) }
						value={ imagePosition }
						options={ IMAGE_POSITIONS }
						onChange={ ( value ) =>
							setAttributes( { imagePosition: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			{ showThumb && (
				<img
					className="mitlib-featured-expert-card__thumb"
					src={ expertImage }
					alt={ `Headshot of ${ expertName }` }
				/>
			) }
			<div>
				<span className="mitlib-featured-expert-card__type">
					{ __( 'Spotlight', 'mitlib-blocks' ) }
				</span>
				<span className="mitlib-featured-expert-card__name">
					{ expertName }
				</span>
				<p className="mitlib-featured-expert-card__excerpt">
					{ expertExcerpt }
				</p>
				<p className="mitlib-featured-expert-card__link">
					{ `How can ${ expertFirstName } help you?` }
				</p>
			</div>
		</div>
	);
}
