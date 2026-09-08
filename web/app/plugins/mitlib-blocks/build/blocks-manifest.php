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
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js',
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
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js'
	),
	'hero-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'mitlib/hero-section',
		'version' => '0.1.0',
		'title' => 'MITLIB - Hero Image Section (Full)',
		'category' => 'widgets',
		'icon' => 'block-default',
		'description' => 'Adds a hero image with optional search.',
		'attributes' => array(
			'heading' => array(
				'type' => 'string',
				'default' => 'Welcome to the MIT Libraries'
			)
		),
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'mitlib-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js',
		'render' => 'file:./render.php'
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
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js'
	)
);
