<?php
/*
Title: Format Meta
Description: Fill me with goodies.
Post Type: post
Context: normal
*/

// Let's create a text box field
piklist('field', array(
	'type' => 'textarea'
	,'field' => 'video'
	,'label' => __('Video / Embed')
	,'attributes' => array(
		'class' => 'text',
		'columns' => 10,
		'rows' => 5
		)
	,'position' => 'wrap'
	));

piklist('field', array(
	'type' => 'checkbox'
	,'field' => 'video-options'
	,'label' => __('Video Options')
	,'choices' => array(
		'widescreen' => 'Widescreen'
		,'vimeo' => 'Vimeo'
		)
	,'position' => 'wrap'
	));

?>