<?php
// This file is generated. Do not modify it manually.
return array(
	'mitlib-block-hours-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/mitlib-block-hours-section',
		'version' => '0.1.0',
		'title' => 'MITLIB - Hours Section',
		'category' => 'widgets',
		'icon' => 'block-default',
		'description' => 'Static block for displaying library hours',
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
		'textdomain' => 'mitlib-block-hours-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js'
	)
);
