<?php

$config = array(
	'title' => __('Property Meta', 'hometown-cpt'),
	'group_id' => 'meta',
	'context' => 'normal',
	'priority' => 'core',
	'types' => array( 'property' )
);

$property_detail_stack[] = array(
	'id' => 'detail',
	'type' => 'stack_template',
	'title' => __('Detail', 'hometown-cpt'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'hometown-cpt'),
			'description'	=> ''
		),
		array(
			'type' 			=> 'textarea',
			'id'			=> 'detail',
			'title' 		=> __('Detail', 'hometown-cpt'),
			'description' 	=> '',
			'default'		=> '',
		),
	)
);
$property_attachment_stack[] = array(
	'id' => 'attachment',
	'type' => 'stack_template',
	'title' => __('Attachment', 'hometown-cpt'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'hometown-cpt'),
			'description'	=> ''
		),
		array(
			'type' 			=> 'input_file',
			'id'			=> 'file',
			'title' 		=> __('File', 'hometown-cpt'),
			'description' 	=> '',
			'default'		=> '',
		),
	)
);

$options = array(
	
	array(
		'type' => 'text',
		'id' => 'id',
		'title' => __('ID', 'hometown-cpt'),
		'description' => '',
	),
	array(
		'type' => 'number',
		'id' => 'price',
		'title' => __('Price', 'hometown-cpt'),
		'default' => '0',
		'description' => __('number only<br /><br />you can define currency symbol at "appearance > theme options > property"<br /><br />set to "0" to show default string which can be define at "appearance > theme options > property"', 'hometown-cpt'),
	),
	array(
		'type' => 'text',
		'id' => 'per',
		'title' => __('Per', 'hometown-cpt'),
		'description' => __('example: day, month, year', 'hometown-cpt'),
	),
	array(
		'type' => 'number',
		'id' => 'area',
		'title' => __('Area', 'hometown-cpt'),
		'default' => '0',
		'description' => __('number only<br /><br />you can define currency symbol at "appearance > theme options > property"', 'hometown-cpt'),
	),
	array(
		'type' => 'number',
		'id' => 'bathroom',
		'title' => __('Bathroom', 'hometown-cpt'),
		'default' => '0',
		'description' => '',
	),
	array(
		'type' => 'number',
		'id' => 'bedroom',
		'title' => __('Bedroom', 'hometown-cpt'),
		'default' => '0',
		'description' => '',
	),
	array(
		'type' => 'number',
		'id' => 'garage',
		'title' => __('Garage', 'hometown-cpt'),
		'default' => '0',
		'description' => '',
	),
	array(
		'type' => 'on_off',
		'id' => 'featured',
		'title' => __('Featured', 'hometown-cpt'),
		'description' => '',
		'default' => 'off'
	),
	array(
		'type' => 'image',
		'id' => 'video_thumb',
		'title' => __('Video Thumbnail', 'hometown-cpt'),
		'description' => '',
	),
	array(
		'type' => 'text',
		'id' => 'video_url',
		'title' => __('Video URL', 'hometown-cpt'),
		'description' => __('support youtube & vimeo', 'hometown-cpt'),
	),
	array(
		'type' => 'images',
		'id' => 'gallery',
		'title' => __('Gallery', 'hometown-cpt'),
		'description' => '',
	),
	array(
		'type' => 'text',
		'id' => 'location_text',
		'title' => __('Location Text', 'hometown-cpt'),
		'description' => '',
	),
	array(
		'type' => 'location',
		'id' => 'location',
		'title' => __('Location', 'hometown-cpt'),
		'description' => __('this information will be shown on "location" tab', 'hometown-cpt'),
	),
	array(
		'type' => 'select',
		'id' => 'agent',
		'title' => __('Agents', 'hometown-cpt'),
		'description' => __('this information will be shown on "contact" tab', 'hometown-cpt'),
		'multiple'	=> 8,
		'source'	=> array('post_type' => 'agent')
	),
	array(
		'type' => 'stack',
		'id' => 'detail',
		'title' => __('Details', 'hometown-cpt'),
		'description' => __('this information will be shown on "detail" tab', 'hometown-cpt'),
		'templates'		=> $property_detail_stack,
		'stack_button'	=> __('Add Property Detail', 'hometown-cpt')
	),
	array(
		'type' => 'images',
		'id' => 'floorplan',
		'title' => __('Floor Plans', 'hometown-cpt'),
		'description' => __('this information will be shown on "detail" tab', 'hometown-cpt'),
	),
	array(
		'type' => 'stack',
		'id' => 'attachment',
		'title' => __('Attachments', 'hometown-cpt'),
		'description' => __('this information will be shown on "detail" tab', 'hometown-cpt'),
		'templates'		=> $property_attachment_stack,
		'stack_button'	=> __('Add Attachment', 'hometown-cpt')
	),
	
);
new nt_metaboxes_tool($config, $options);

?>