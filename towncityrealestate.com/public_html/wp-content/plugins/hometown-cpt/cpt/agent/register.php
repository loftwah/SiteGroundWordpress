<?php

add_action('init','lt_register_agent_cpt');
function lt_register_agent_cpt() {
	$arg = array(
		'labels' => array(
			'name' 					=> __('Agent', 'hometown-cpt'),
			'singular_name' 		=> __('Agent', 'hometown-cpt'),
			'add_new' 				=> __('Add New', 'hometown-cpt'),
			'add_new_item' 			=> __('Add New Agent', 'hometown-cpt'),
			'edit_item' 			=> __('Edit Agent', 'hometown-cpt'),
			'new_item' 				=> __('New Agent', 'hometown-cpt'),
			'view_item' 			=> __('View Agent', 'hometown-cpt'),
			'search_items' 			=> __('Search Agent', 'hometown-cpt'),
			'not_found' 			=> __('No Agent found', 'hometown-cpt'),
			'not_found_in_trash' 	=> __('No Agent found in Trash', 'hometown-cpt'), 
			'parent_item_colon' 	=> '',
		),
		'singular_label' 		=> __('Agent', 'hometown-cpt'),
		'public' 				=> true,
		'exclude_from_search' 	=> false,
		'show_ui' 				=> true,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'rewrite' 				=> array( 'with_front' => false, 'slug' => 'agent' ),
		'query_var' 			=> 'agent',
		'_builtin' 				=> false,
		'supports' 				=> array('title', 'editor', 'thumbnail'),
		'taxonomies'			=> array(),
		'show_in_menu' 			=> true,
		'has_archive'			=> true,
		'menu_icon'				=> 'dashicons-businessman'
	);

	register_post_type('agent', $arg);
}

?>