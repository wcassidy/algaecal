<?php
// Main functions for theme. Includes main css and js files

function add_theme_styles_scripts()
{
	// Link css for the fonts Roboto and font-awesome (don't have access to Glober)
	wp_enqueue_style( 'roboto_css', 'https://fonts.googleapis.com/css?family=Roboto');
	wp_enqueue_style( 'font_awesome_css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style( 'globber_css', get_template_directory_uri() . '/fonts/glober/glober.css' );

	// Link bootstrap css
	wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');

	// Add the main css
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	// Bootstrap js which requires JQuery and we want to use jquery 3.2.1 from the google CDN
	wp_deregister_script('jquery');
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false, '3.2.1', true);
	wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array ( 'jquery' ), '3.3.7', true);	
}
add_action( 'wp_enqueue_scripts', 'add_theme_styles_scripts' );
?>