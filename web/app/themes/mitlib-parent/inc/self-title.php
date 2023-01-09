<?php
/**
 *
 * Unline other pages in the Libraries theme,
 * this page template renders the page title
 * from the post, rather than from the parent
 * if the page is a child page.
 *
 * @package MITlib_Parent
 * @since 0.2.0
 */

namespace Mitlib\Parent;

?>

<div class="title-page">
	<h1><?php the_title(); ?></h1>
</div>
