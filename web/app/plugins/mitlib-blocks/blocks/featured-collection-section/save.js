/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save() {
	const blockProps = useBlockProps.save();

	return (
		<section id="featured-collection" { ...blockProps }>
			<div className="content-wrapper">
				<div
					className="featured-collection-image"
					role="img"
					aria-label="Architectural elevation of a house with two gables and two chimneys by Howe, Manning and Almy Architects, dated 1927."
					style="background-image: url('https://libraries.mit.edu/app/uploads/2026/07/Howe-Manning-Almy-1.jpg');"
				>
					<span className="featured-collection-tag">Exhibit</span>
				</div>
				<div className="featured-collection-content">
					<h2 className="sr">Featured Exhibit</h2>
					<p className="eyebrow">Howe, Manning & Almy</p>
					<h3>
						Boston&apos;s First All-Woman Firm and the Changing Face
						of Architecture
					</h3>
					<p>
						Learn about the role MIT&apos;s architecture program
						played in supporting women in the field since the 1890s,
						Howe, Manning & Almy&apos;s influence on the built
						environment of Cambridge, and the firm&apos;s
						ecofriendly approaches to renovation.
					</p>
					<a
						className="button secondary"
						title="Read more about the Howe, Manning & Almy exhibit"
						href="https://libraries.mit.edu/exhibits/exhibit/howe-manning-almy/"
					>
						Check it out
					</a>
				</div>
			</div>
		</section>
	);
}
