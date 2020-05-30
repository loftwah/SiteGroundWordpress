<?php

add_action('init','lt_register_Property_cpt');
function lt_register_Property_cpt() {
	$arg = array(
		'labels' => array(
			'name' 					=> __('Property', 'hometown-cpt'),
			'singular_name' 		=> __('Property', 'hometown-cpt'),
			'add_new' 				=> __('Add New', 'hometown-cpt'),
			'add_new_item' 			=> __('Add New Property', 'hometown-cpt'),
			'edit_item' 			=> __('Edit Property', 'hometown-cpt'),
			'new_item' 				=> __('New Property', 'hometown-cpt'),
			'view_item' 			=> __('View Property', 'hometown-cpt'),
			'search_items' 			=> __('Search Property', 'hometown-cpt'),
			'not_found' 			=> __('No Property found', 'hometown-cpt'),
			'not_found_in_trash' 	=> __('No Property found in Trash', 'hometown-cpt'), 
			'parent_item_colon' 	=> '',
		),
		'singular_label' 		=> __('Property', 'hometown-cpt'),
		'public' 				=> true,
		'exclude_from_search' 	=> false,
		'show_ui' 				=> true,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'rewrite' 				=> array( 'with_front' => false, 'slug' => nt_get_option('property', 'slug', 'property') ),
		'query_var' 			=> 'property',
		'_builtin' 				=> false,
		'supports' 				=> array('title', 'editor', 'thumbnail', 'author', 'excerpt'),
		'taxonomies'			=> array(),
		'show_in_menu' 			=> true,
		'has_archive'			=> true,
		'menu_icon'				=> 'dashicons-admin-home'
	);

	register_post_type('property', $arg);

	// Taxonomy
	register_taxonomy('location','property',array(
		'hierarchical' => true,
		'labels' => array(
			'name' =>  __('Location', 'hometown-cpt'),
			'singular_name' =>  __('Location', 'hometown-cpt'),
			'search_items' =>   __('Search Location', 'hometown-cpt'),
			'popular_items' =>  __('Popular Location', 'hometown-cpt'),
			'all_items' =>  __('All Location', 'hometown-cpt'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' =>  __('Edit Location', 'hometown-cpt'), 
			'update_item' =>  __('Update Location', 'hometown-cpt'),
			'add_new_item' =>  __('Add New Location', 'hometown-cpt'),
			'new_item_name' =>  __('New Location Name', 'hometown-cpt'),
			'separate_items_with_commas' =>  __('Separate Location with commas', 'hometown-cpt'),
			'add_or_remove_items' =>  __('Add or remove Location', 'hometown-cpt'),
			'choose_from_most_used' =>  __('Choose from the most used Location', 'hometown-cpt'),
			'menu_name' =>  __('Location', 'hometown-cpt'),
		),
		'public' 				=> true,
		'show_in_nav_menus' 	=> true,
		'show_ui' 				=> true,
		'show_admin_column'		=> true,
		'sort'					=> true,
		'show_tagcloud' 		=> false,
		'rewrite' 				=> array( 'slug' => 'property-location' ),
		'query_var' 			=> 'location'
	));

	// Taxonomy
	register_taxonomy('type','property',array(
		'hierarchical' => true,
		'labels' => array(
			'name' =>  __('Type', 'hometown-cpt'),
			'singular_name' =>  __('Type', 'hometown-cpt'),
			'search_items' =>   __('Search Type', 'hometown-cpt'),
			'popular_items' =>  __('Popular Type', 'hometown-cpt'),
			'all_items' =>  __('All Type', 'hometown-cpt'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' =>  __('Edit Type', 'hometown-cpt'), 
			'update_item' =>  __('Update Type', 'hometown-cpt'),
			'add_new_item' =>  __('Add New Type', 'hometown-cpt'),
			'new_item_name' =>  __('New Type Name', 'hometown-cpt'),
			'separate_items_with_commas' =>  __('Separate Type with commas', 'hometown-cpt'),
			'add_or_remove_items' =>  __('Add or remove Type', 'hometown-cpt'),
			'choose_from_most_used' =>  __('Choose from the most used Type', 'hometown-cpt'),
			'menu_name' =>  __('Type', 'hometown-cpt'),
		),
		'public' 				=> true,
		'show_in_nav_menus' 	=> true,
		'show_ui' 				=> true,
		'show_admin_column'		=> true,
		'sort'					=> true,
		'show_tagcloud' 		=> false,
		'query_var' 			=> 'type',
		'rewrite' 				=> array( 'slug' => 'property-type' ),
		// 'meta_box_cb'			=> 'post_categories_meta_box'
	));

	// Taxonomy
	register_taxonomy('status','property',array(
		'hierarchical' => true,
		'labels' => array(
			'name' =>  __('Status', 'hometown-cpt'),
			'singular_name' =>  __('Status', 'hometown-cpt'),
			'search_items' =>   __('Search Status', 'hometown-cpt'),
			'popular_items' =>  __('Popular Status', 'hometown-cpt'),
			'all_items' =>  __('All Status', 'hometown-cpt'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' =>  __('Edit Status', 'hometown-cpt'), 
			'update_item' =>  __('Update Status', 'hometown-cpt'),
			'add_new_item' =>  __('Add New Status', 'hometown-cpt'),
			'new_item_name' =>  __('New Status Name', 'hometown-cpt'),
			'separate_items_with_commas' =>  __('Separate Status with commas', 'hometown-cpt'),
			'add_or_remove_items' =>  __('Add or remove Status', 'hometown-cpt'),
			'choose_from_most_used' =>  __('Choose from the most used Status', 'hometown-cpt'),
			'menu_name' =>  __('Status', 'hometown-cpt'),
		),
		'public' 				=> true,
		'show_in_nav_menus' 	=> true,
		'show_ui' 				=> true,
		'show_admin_column'		=> true,
		'sort'					=> true,
		'show_tagcloud' 		=> false,
		'query_var' 			=> 'status',
		'rewrite' 				=> array( 'slug' => 'property-status' ),
		// 'meta_box_cb'			=> 'post_categories_meta_box'
	));

	// Taxonomy
	register_taxonomy('features','property',array(
		'hierarchical' => true,
		'labels' => array(
			'name' =>  __('Feature', 'hometown-cpt'),
			'singular_name' =>  __('Feature', 'hometown-cpt'),
			'search_items' =>   __('Search Feature', 'hometown-cpt'),
			'popular_items' =>  __('Popular Feature', 'hometown-cpt'),
			'all_items' =>  __('All Feature', 'hometown-cpt'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' =>  __('Edit Feature', 'hometown-cpt'), 
			'update_item' =>  __('Update Feature', 'hometown-cpt'),
			'add_new_item' =>  __('Add New Feature', 'hometown-cpt'),
			'new_item_name' =>  __('New Feature Name', 'hometown-cpt'),
			'separate_items_with_commas' =>  __('Separate Feature with commas', 'hometown-cpt'),
			'add_or_remove_items' =>  __('Add or remove Feature', 'hometown-cpt'),
			'choose_from_most_used' =>  __('Choose from the most used Status', 'hometown-cpt'),
			'menu_name' =>  __('Feature', 'hometown-cpt'),
		),
		'public' 				=> true,
		'show_in_nav_menus' 	=> false,
		'show_ui' 				=> true,
		'show_admin_column'		=> false,
		'sort'					=> true,
		'show_tagcloud' 		=> false,
		'query_var' 			=> 'feature',
		'rewrite' 				=> array( 'slug' => 'property-feature' ),
		// 'meta_box_cb'			=> 'post_categories_meta_box'
	));
}

?>