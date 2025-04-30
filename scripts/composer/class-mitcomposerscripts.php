<?php
/**
 * Composer scripts for MIT Libraries
 *
 * These functions are used to add additional functionality to composer CLI for use in
 * development work at MIT Libraries.
 *
 * @package Mitlib
 * @file
 * Contains MitComposerScripts.
 */

/**
 * Defines MIT Libraries Composer scripts
 */
class MitComposerScripts {

	/**
	 * Extracts multidev name from arguments
	 *
	 * @param object $event Composer event object.
	 */
	protected static function multidev_name( $event ): string {
		if ( $event->getArguments() ) {
			$multidev = $event->getArguments()[0];
		} else {
			$event->getIO()->write( 'No multidev value provided.' );
			exit();
		}
		return $multidev;
	}

	/**
	 * Creates and displays command syntax for cloning to supplied multidev from live tier
	 *
	 * @param object $event Composer event object.
	 */
	public static function multidev_clone_syntax( $event ): void {
		$multidev = self::multidev_name( $event );
		$terminus_command = "terminus env:clone-content mitlib-wp-network.live $multidev";
		$event->getIO()->write( $terminus_command );
		$event->getIO()->write( '-----' );
	}

	/**
	 * Creates and displays command syntax for creating multidev from supplied name
	 *
	 * @param object $event Composer event object.
	 */
	public static function multidev_create_syntax( $event ): void {
		$multidev = self::multidev_name( $event );
		$terminus_command = "terminus multidev:create mitlib-wp-network.live $multidev";
		$event->getIO()->write( $terminus_command );
		$event->getIO()->write( '-----' );
	}

	/**
	 * Creates and displays command syntax for performing a search-replace on target multidev for live tier data
	 *
	 * @param object $event Composer event object.
	 */
	public static function multidev_search_replace_syntax( $event ): void {
		$multidev = self::multidev_name( $event );
		$terminus_command = "terminus remote:wp mitlib-wp-network.$multidev -- search-replace libraries.mit.edu $multidev-mitlib-wp-network.pantheonsite.io --url=libraries.mit.edu --network";
		$event->getIO()->write( $terminus_command );
		$terminus_command = "terminus remote:wp mitlib-wp-network.$multidev -- search-replace noreply@$multidev-mitlib-wp-network.pantheonsite.io noreply@libraries.mit.edu --network";
		$event->getIO()->write( $terminus_command );
		$event->getIO()->write( '-----' );
	}
}
