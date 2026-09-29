<?php
// This file is generated. Do not modify it manually.
return array(
	'featured-and-events-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/featured-and-events-section',
		'version' => '0.1.0',
		'title' => 'MITLIB - Featured and Events Section',
		'category' => 'widgets',
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
			),
			'spotlightItemType' => array(
				'type' => 'string',
				'default' => 'spotlight'
			),
			'spotlightTitle' => array(
				'type' => 'string',
				'default' => 'Read <em>Exhalation</em> by Ted Chiang'
			),
			'spotlightDescription' => array(
				'type' => 'string',
				'default' => 'To celebrate 10 years of MIT Reads, President Sally Kornbluth has chosen our fall 2026 selection'
			),
			'spotlightLinkUrl' => array(
				'type' => 'string',
				'default' => 'https://libraries.mit.edu/mit-reads/'
			),
			'spotlightImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'spotlightImageUrl' => array(
				'type' => 'string',
				'default' => 'https://libraries.mit.edu/app/uploads/2026/09/mit-reads-highlight.png'
			),
			'spotlightImageAlt' => array(
				'type' => 'string',
				'default' => 'Exhalation book cover and MIT Reads logo; text reads Fall 2026 selection'
			),
			'spotlightImagePosition' => array(
				'type' => 'string',
				'default' => 'above'
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
		'title' => 'MITLIB - Featured Collection Section',
		'category' => 'widgets',
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
		'title' => 'MITLIB - Hours Section',
		'category' => 'widgets',
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
		'title' => 'MITLIB - Using The Libraries Section',
		'category' => 'widgets',
		'icon' => 'block-default',
		'description' => 'Displays library service links and an Ask Us help box.',
		'example' => array(
			
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
