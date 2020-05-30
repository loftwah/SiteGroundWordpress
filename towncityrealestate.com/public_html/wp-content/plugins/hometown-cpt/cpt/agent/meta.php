<?php

$config = array(
	'title' => __('Agent Meta', 'hometown-cpt'),
	'group_id' => 'meta',
	'context' => 'normal',
	'priority' => 'core',
	'types' => array( 'agent' )
);

$button_stack[] = array(
	'id' => 'button',
	'type' => 'stack_template',
	'title' => __('Button', 'hometown-cpt'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Text', 'hometown-cpt'),
			'description'	=> ''
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'link',
			'title' 		=> __('Link', 'hometown-cpt'),
			'description' 	=> '',
			'default'		=> '',
		),
		array(
			'type' 			=> 'color',
			'id'			=> 'color',
			'title' 		=> __('Color', 'hometown-cpt'),
			'description' 	=> 'leave blank to use standard color',
			'default'		=> '',
		),
		array(
			'type' 			=> 'icon',
			'id'			=> 'icon',
			'title' 		=> __('Icon', 'hometown-cpt'),
			'description' 	=> '',
			'default'		=> '',
		),

	)
);

$options = array(
	
	array(
		'type' => 'text',
		'id' => 'role',
		'title' => __('Role', 'hometown-cpt'),
		'description' => '',
	),
	array(
		'type' => 'text',
		'id' => 'phone',
		'title' => __('Phone Number', 'hometown-cpt'),
		'description' => '',
	),
	array(
		'type' => 'text',
		'id' => 'email',
		'title' => __('Email', 'hometown-cpt'),
		'description' => '',
	),
	
	
);
new nt_metaboxes_tool($config, $options);

?>