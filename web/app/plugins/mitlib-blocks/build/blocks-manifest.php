<?php
// This file is generated. Do not modify it manually.
return array(
	'atom-location' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/atom-location',
		'version' => '0.1.0',
		'title' => 'Atom: Location',
		'category' => 'mitlib',
		'icon' => 'block-default',
		'description' => 'Location information (with hours)',
		'example' => false,
		'attributes' => array(
			'locationName' => array(
				'type' => 'string',
				'default' => 'Hayden Library'
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css'
	),
	'atom-using' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/atom-using',
		'version' => '0.1.0',
		'title' => 'Atom: Using the Libraries',
		'category' => 'mitlib',
		'icon' => 'block-default',
		'description' => 'Using the Libraries blurb',
		'example' => false,
		'attributes' => array(
			'headline' => array(
				'type' => 'string',
				'default' => 'Find a study space'
			),
			'blurb' => array(
				'type' => 'string',
				'default' => 'Quiet and group spaces - many available 24/7'
			),
			'icon' => array(
				'type' => 'string',
				'default' => 'lightbulb'
			),
			'link' => array(
				'type' => 'string',
				'default' => '/study'
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css'
	),
	'featured-and-events-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/featured-and-events-section',
		'version' => '0.1.0',
		'title' => 'Section: Featured and Events',
		'category' => 'mitlib',
		'icon' => 'block-default',
		'description' => 'Displays featured content and upcoming events feed.',
		'example' => array(
			
		),
		'attributes' => array(
			'heading' => array(
				'type' => 'string',
				'default' => 'Featured'
			),
			'featuredExpertId' => array(
				'type' => 'number',
				'default' => 0
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'render' => 'file:./render.php'
	),
	'featured-collection-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/featured-collection-section',
		'version' => '0.1.0',
		'title' => 'Section: Featured Collection',
		'category' => 'mitlib',
		'icon' => 'block-default',
		'description' => 'Displays a curated featured collection section.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css'
	),
	'hours-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/hours-section',
		'version' => '0.1.0',
		'title' => 'Section: Hours',
		'category' => 'mitlib',
		'icon' => 'block-default',
		'description' => 'Locations and hours list for the homepage',
		'example' => array(
			
		),
		'attributes' => array(
			'heading' => array(
				'type' => 'string',
				'default' => 'Today\'s hours'
			),
			'linkText' => array(
				'type' => 'string',
				'default' => 'See more locations and hours'
			),
			'linkUrl' => array(
				'type' => 'string',
				'default' => '/hours'
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css'
	),
	'using-the-libraries-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/using-the-libraries-section',
		'version' => '0.1.0',
		'title' => 'Section: Using The Libraries',
		'category' => 'mitlib',
		'icon' => 'block-default',
		'description' => 'Displays library service links and an Ask Us help box.',
		'example' => array(
			
		),
		'allowedBlocks' => array(
			'mitlib/atom-using'
		),
		'attributes' => array(
			'heading' => array(
				'type' => 'string',
				'default' => 'Using the Libraries'
			),
			'askUsTitle' => array(
				'type' => 'string',
				'default' => 'Ask Us'
			),
			'askUsDescription' => array(
				'type' => 'string',
				'default' => 'Get help via email, live chat with staff, and book appointments'
			),
			'askUsLinkText' => array(
				'type' => 'string',
				'default' => 'All help options'
			),
			'askUsLinkUrl' => array(
				'type' => 'string',
				'default' => '/ask'
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css'
	)
);
