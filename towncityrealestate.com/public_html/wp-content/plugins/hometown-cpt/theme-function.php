<?php

// Custom User Contact Info
function nt_extra_contact_info($contactmethods)
{
    $contactmethods['phone'] = 'Phone';
    return $contactmethods;
}
add_filter('user_contactmethods', 'nt_extra_contact_info');

// Support LESS
add_filter('style_loader_tag', 'nt_style_loader_tag_function');
function nt_style_loader_tag_function($tag){
	if(strpos($tag, '.less') !== FALSE) {
	  return str_replace('stylesheet','stylesheet/less',$tag);
	} else {
	  return $tag;
	}
}

// Mail Function
add_action('nt_mail', 'nt_cmail', 10, 4);
function nt_cmail($to, $subject, $message, $headers) {
    wp_mail( $to, $subject, $message, $headers );
}