<?php
/*
 * Plugin Name: HomeTown CPT
 * Version: 1.3.0
 * Plugin URI: http://leafthemes.com/
 * Description: Custom Post Type for HomeTown Theme
 * Author: LeafThemes Studio
 * Author URI: http://leafthemes.com/
 *
 *
 * @package WordPress
 * @author Leaf Themes
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;
define('LT_CPT_FOLDER', plugin_dir_path( __FILE__ ).'cpt');


function Lt_Cpt () {
	add_action( 'plugins_loaded', 'lt_cpt_load_textdomain' );
	add_action('lt_cpt_init', 'lt_cpt_init');
	add_action('lt_cpt_admin_init', 'lt_cpt_admin_init');
}

Lt_Cpt();

function lt_cpt_init() {
	foreach (new DirectoryIterator(LT_CPT_FOLDER) as $file){
	    if($file->isDot()) continue;

	    if($file->isDir()){
	        $register_file = LT_CPT_FOLDER.'/'.$file->getFilename().'/'.'register.php';
	        if(is_file($register_file)) {
	        	require_once( $register_file );
	        }
	    }
	}

	require_once( 'theme-function.php' );
}

function lt_cpt_admin_init() {
	foreach (new DirectoryIterator(LT_CPT_FOLDER) as $file){
	    if($file->isDot()) continue;
	    
	    if($file->isDir()){
	        $register_file = LT_CPT_FOLDER.'/'.$file->getFilename().'/'.'register.php';
	        if(is_file($register_file)) {
	        	require_once( $register_file );
	        }
	        $manage_file = LT_CPT_FOLDER.'/'.$file->getFilename().'/'.'manage.php';
	        if(is_file($manage_file)) {
	        	require_once( $manage_file );
	        }
	        $content_file = LT_CPT_FOLDER.'/'.$file->getFilename().'/'.'meta.php';
	        if(is_file($content_file)) {
	        	require_once( $content_file );
	        }
	    }

	}
}




function lt_cpt_load_textdomain() {
  load_plugin_textdomain( 'hometown-cpt', false, dirname(plugin_basename(__FILE__)).'/languages/' );
}

