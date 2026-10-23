<?php
/**
 * Server-side rendering for the using the libraries section block.
 *
 * @package MITlib Blocks
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

$show_askus = ! isset( $attributes['showAskUs'] ) || $attributes['showAskUs'];

?><section id="using-the-libraries" <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_block_wrapper_attributes() escapes the generated attributes. ?> >
	<div class="content-wrapper">
		<h2><?php echo esc_html( $attributes['heading'] ); ?></h2>
		<div class="box-wrapper">
			<div class="option-boxes">
				<?php if ( $content ) : ?>
					<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Inner block markup is already rendered and escaped. ?>
				<?php else : ?>
					<div>
						<i class="fa-light fa-lightbulb" aria-hidden="true" role="img"></i>
						<div class="option-box-content">
							<h3>
								<a href="/study">Find a study space</a>
							</h3>
							<p>Quiet and group spaces—many available 24/7</p>
						</div>
					</div>
					<div>
						<i class="fa-light fa-file-alt" aria-hidden="true" role="img"></i>
						<div class="option-box-content">
							<h3>
								<a href="/get-materials">Learn how to get materials</a>
							</h3>
							<p>Find, request, and get articles, books, and more</p>
						</div>
					</div>
					<div>
						<i class="fa-light fa-book" aria-hidden="true" role="img"></i>
						<div class="option-box-content">
							<h3>
								<a href="/experts">Discover guides &amp; librarians</a>
							</h3>
							<p>Resource and class guides with experts for every subject</p>
						</div>
					</div>
					<div>
						<i class="fa-light fa-database" aria-hidden="true" role="img"></i>
						<div class="option-box-content">
							<h3>
								<a href="/data-services">Find and manage data</a>
							</h3>
							<p>Get support from creating and visualizing to using and sharing data</p>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( $show_askus ) : ?>
			<div class="ask-us-box">
				<i
					class="fa-light fa-messages-question"
					aria-hidden="true"
					role="img"
				></i>
				<div class="option-box-content">
					<h3><?php echo esc_html( $attributes['askUsTitle'] ); ?></h3>
					<p><?php echo esc_html( $attributes['askUsDescription'] ); ?></p>
					<div class="ask-us-links">
						<div id="libchat_fa6edc50fe81603743870ca1772bc5b2e7e121436b62ba7da331b9dcabf289c0"></div>
						<a href="<?php echo esc_url( $attributes['askUsLinkUrl'] ); ?>"><?php echo esc_html( $attributes['askUsLinkText'] ); ?></a>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
