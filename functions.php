<?php
/**
 * modularcontent functions and definitions.
 *
 * @package mecare
 */

// Enqueue the scripts and styles

// SCRIPTS
add_action('wp_enqueue_scripts', 'add_my_custom_scripts');
function add_my_custom_scripts(){
	// de-register stock jquery
	wp_deregister_script( 'jquery' );

	// register for all
	wp_register_script('my_jquery' ,get_stylesheet_directory_uri().'/includes/jquery/jquery.1.11.1.min.js', false);
	wp_register_script('my_bootstrap_js' ,get_stylesheet_directory_uri().'/includes/bootstrap/js/bootstrap.min.js', false);

	// enqueue
	wp_enqueue_script('my_jquery');
	wp_enqueue_script('my_bootstrap_js');
}

// STYLES
add_action('wp_enqueue_scripts', 'add_my_custom_styles');
function add_my_custom_styles(){
	//register
	wp_register_style('my_stylesheet', get_stylesheet_directory_uri().'/includes/css/style.css');
	wp_register_style('my_style_map', get_stylesheet_directory_uri().'/includes/css/style.css.map');
	wp_register_style('my_bootstrap', get_stylesheet_directory_uri().'/includes/bootstrap/css/bootstrap.min.css');

	//enqueue
	wp_enqueue_style('my_stylesheet');
	wp_enqueue_style('my_style_map');
	wp_enqueue_style('my_bootstrap');
}

// Include the praktijk custom post type
include_once('theme-files/custom-post-types/praktijk-cpt.php');

// Include the behandelingen custom post type
include_once('theme-files/custom-post-types/behandelingen-cpt.php');
