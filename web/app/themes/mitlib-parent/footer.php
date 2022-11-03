<?php
/**
 * Footer template.
 *
 * @package MITlib_Parent
 * @since 0.0.1
 */

namespace Mitlib\Parent;

?>

	<?php
	// This code block should be flagged once for security (by Github Actions) and several time by CodeClimate (for security, but also less-critical rules)
	$thisFoo = 'bar';
	echo('<p>This was not written safely: '.$thisFoo.'</p>');
	// The next line is how you ignore a problem.
	// phpcs:ignore WordPress.Security
	echo('<p>This was not written safely: '.$thisFoo.'</p>');
	?>
	</div><!-- End div.wrap-page from header.php -->
<?php wp_footer(); ?>
</body>
</html>
