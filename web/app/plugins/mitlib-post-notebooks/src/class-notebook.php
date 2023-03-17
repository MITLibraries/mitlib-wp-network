<?php
/**
 * Class that defines the Notebooks custom post type, including fields.
 *
 * @package MITlib Post Notebooks
 * @since 1.0.0
 */

namespace Mitlib\PostTypes;

/**
 * Defines the Notebook post type, used for richer, long-form blobs of text.
 */
class Notebook extends Base {
	/**
	 * The singular name of this post type.
	 */
	const SINGULAR = 'Notebook';

	/**
	 * The plural name of this post type.
	 */
	const PLURAL = 'Notebooks';
}
