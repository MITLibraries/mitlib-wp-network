<?php
// This file is generated. Do not modify it manually.
return array(
	'featured-and-events-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/featured-and-events-section',
		'version' => '0.1.0',
		'title' => 'Featured and Events',
		'category' => 'mitlib',
		'icon' => 'align-wide',
		'description' => 'Displays featured content and upcoming events feed.',
		'example' => array(
			
		),
		'attributes' => array(
			'heading' => array(
				'type' => 'string',
				'default' => 'Featured'
			),
			'showEvents' => array(
				'type' => 'boolean',
				'default' => true
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
		'title' => 'Featured Collection',
		'category' => 'mitlib',
		'icon' => 'align-wide',
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
	'featured-expert' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/featured-expert',
		'version' => '0.1.0',
		'title' => 'Featured Expert',
		'category' => 'mitlib',
		'icon' => 'businessperson',
		'description' => 'Highlights a librarian inside the Featured and Events section.',
		'parent' => array(
			'mitlib/featured-and-events-section'
		),
		'attributes' => array(
			'expertId' => array(
				'type' => 'number',
				'default' => 0
			),
			'imagePosition' => array(
				'type' => 'string',
				'default' => 'left'
			)
		),
		'supports' => array(
			'html' => false,
			'reusable' => false
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'render' => 'file:./render.php'
	),
	'featured-item' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/featured-item',
		'version' => '0.1.0',
		'title' => 'Featured Item',
		'category' => 'mitlib',
		'icon' => 'star-filled',
		'description' => 'A single item inside the Featured and Events section.',
		'parent' => array(
			'mitlib/featured-and-events-section'
		),
		'attributes' => array(
			'itemType' => array(
				'type' => 'string',
				'default' => 'spotlight'
			),
			'title' => array(
				'type' => 'string',
				'default' => ''
			),
			'description' => array(
				'type' => 'string',
				'default' => ''
			),
			'linkUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'imageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'imageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'imageAlt' => array(
				'type' => 'string',
				'default' => ''
			),
			'imagePosition' => array(
				'type' => 'string',
				'default' => 'above'
			)
		),
		'supports' => array(
			'html' => false,
			'reusable' => false,
			'customClassName' => true
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'render' => 'file:./render.php'
	),
	'hours-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/hours-section',
		'version' => '0.1.0',
		'title' => 'Hours',
		'category' => 'mitlib',
		'icon' => 'align-wide',
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
	'using-item' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/using-item',
		'version' => '0.1.0',
		'title' => 'Using the Libraries Item',
		'category' => 'mitlib',
		'icon' => 'block-default',
		'description' => 'A single item inside the Using the Libraries section.',
		'parent' => array(
			'mitlib/using-the-libraries-section'
		),
		'example' => array(
			
		),
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Find a study space'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Quiet and group spaces - many available 24/7'
			),
			'linkUrl' => array(
				'type' => 'string',
				'default' => '/study'
			),
			'icon' => array(
				'type' => 'string',
				'default' => 'lightbulb'
			)
		),
		'supports' => array(
			'html' => false,
			'resuable' => false,
			'customClassName' => true
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => array(
			'file:./index.css',
			'fontawesome'
		),
		'render' => 'file:./render.php'
	),
	'using-the-libraries-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/using-the-libraries-section',
		'version' => '0.1.0',
		'title' => 'Using the Libraries',
		'category' => 'mitlib',
		'icon' => 'align-wide',
		'description' => 'Displays library service links and an Ask Us help box.',
		'example' => array(
			
		),
		'allowedBlocks' => array(
			'mitlib/using-item'
		),
		'attributes' => array(
			'heading' => array(
				'type' => 'string',
				'default' => 'Using the Libraries'
			),
			'showAskUs' => array(
				'type' => 'boolean',
				'default' => true
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
		'editorStyle' => 'file:./index.css',
		'render' => 'file:./render.php'
	)
);
