<?php
// How to include the latest version of jquery in wordpress without using the jquery that comes with core

function add_jquery_script()
{
	// jquery jquery 3.2.1 from the google CDN (3.2.1 is latest version, google recommends we don't use jquery/3.2/... or jquery/3/... links)
	wp_deregister_script('jquery');
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false, '3.2.1', true);
	
	// Note: this loads the js script at the bottom of the page however; if any other scripts that depend on jquery are loaded at the top, jquery will also be loaded at the top so this is not a guarantee
}
add_action( 'wp_enqueue_scripts', 'add_jquery_script' );
?>