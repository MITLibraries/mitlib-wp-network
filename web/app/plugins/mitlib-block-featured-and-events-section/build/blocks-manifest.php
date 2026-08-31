<?php
// This file is generated. Do not modify it manually.
return array(
	'mitlib-block-featured-and-events-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/mitlib-block-featured-and-events-section',
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
		'textdomain' => 'mitlib-block-featured-and-events-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js',
		'render' => 'file:./render.php'
	)
);
