<?php
/**
 * The template for displaying the footer.
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

?>
	<footer>

		<?php get_template_part( 'inc/footer', 'main' ); ?>

		<div class="footer-info-institute">
			<a class="link-logo-mit" href="https://www.mit.edu">
				<img src="https://cdn.libraries.mit.edu/files/branding/local/mit_lockup_std-three-line_rgb_white.svg" alt="MIT" width="152">
			</a>

			<div class="license">Content created by the MIT Libraries, <a href="https://creativecommons.org/licenses/by-nc/4.0/">CC BY-NC</a> unless otherwise noted. <a href="https://libraries.mit.edu/research-support/notices/copyright-notify/">Notify us about copyright concerns</a>.</div>
		</div><!-- End div.footer-info-institure -->
	</footer>

</div><!-- End div.wrap-page -->

<?php wp_footer(); ?>
</body>
</html>
