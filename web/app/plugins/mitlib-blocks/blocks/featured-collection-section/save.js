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
	return (
		<section id="featured-collection">
			<div className="content-wrapper">
				<div
					className="featured-collection-image"
					role="img"
					aria-label="A 1920s photograph of two men standing on a car and waving from the top of a building's roof."
					style="background-image: url('https://libraries.mit.edu/app/uploads/2026/10/nyi_QvYE.jpeg');"
				>
					<span className="featured-collection-tag">Exhibit</span>
				</div>
				<div className="featured-collection-content">
					<h2 className="sr">Featured Exhibit</h2>
					<h3>
						Spirits, Goblins, and Gnurds
					</h3>
					<p>
						A celebration of the last 150 years of student life at MIT, this digital exhibit examines archival materials from Distinctive Collections focusing on three specific years – 1876, 1926, and 1976.
					</p>
					<a
						className="button secondary"
						title="Read more about the Spirits, Goblins, and Gnurds exhibit"
						href="https://digital-exhibits.libraries.mit.edu/s/MITin50s/page/Intro"
					>
						Check it out
					</a>
				</div>
			</div>
		</section>
	);
}
