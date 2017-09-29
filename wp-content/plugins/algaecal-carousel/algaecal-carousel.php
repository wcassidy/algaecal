<?php
defined( 'ABSPATH' ) or die( 'This file is not for reading!' );

/*
Plugin Name:  algaecal-carousel
Description:  Provided a carousel that has an image or video thumbnail showing above and a controlling carousel of thumbnails below. The carousel can take an arbitrary number of items.
Version:      1.0
Author:       Wayne Cassidy
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

function add_styles_scripts()
{
	// Add the main plugin css
	wp_enqueue_style( 'algaecal_carousel_style', plugin_dir_url( __FILE__ ) . 'algaecal-carousel-style.css', array ( 'bootstrap_css' ));

	// Bootstrap js which requires JQuery and we want to use jquery 3.2.1 from the google CDN
	//wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array ( 'bootstrap_css' ), '3.3.7', true);	
}
add_action( 'wp_enqueue_scripts', 'add_styles_scripts' );

function create_algaecal_carousel()
{
	// Set up the labels to be used in the admin console
	$labels = array(
		'name'               => 'AlgaeCal Carousels',
		'singular_name'      => 'AlgaeCal Carousel',
		'menu_name'          => 'AlgaeCal Carousel',
		'name_admin_bar'     => 'AlgaeCal Carousel',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New AlgaeCal Carousel',
		'new_item'           => 'New AlgaeCal Carousel',
		'edit_item'          => 'Edit AlgaeCal Carousel',
		'view_item'          => 'View AlgaeCal Carousel',
		'all_items'          => 'All AlgaeCal Carousels',
		'search_items'       => 'Search AlgaeCal Carousels',
		'parent_item_colon'  => 'Parent AlgaeCal Carousels:',
		'not_found'          => 'No AlgaeCal carousels found.',
		'not_found_in_trash' => 'No AlgaeCal carousel found in Trash.'
	);
	// Set up the basic properties of the of the post_type
	$args = array( 
		'public'      => true, 
		'labels'      => $labels,
		'description' => 'AlgaeCal carousels display product images and videos',
		'supports' => array(
            'title',
			'capability_type' => 'page',
			'rewrite' => false
        )
	);
	
	// Register the post type
	register_post_type( 'algaecal_carousel', $args );
}
add_action( 'init', 'create_algaecal_carousel' );

function display_algaecal_carousel($atts)
{
	// Make sure the name was set.  If not then print out help usage.
	$return_val = "<h4>Could not find algaecal_carousel requested</h4>";
	
	// Set a default name to test
	$atts = shortcode_atts( array(
		'name' => 'no_name'
	), $atts, 'algaecal_carousel' );
	
	// Retrive the algaecal_carousel page requested
	$requested_page = get_page_by_title($atts['name'], OBJECT, 'algaecal_carousel');
	
	if( $atts['name'] != 'no_name' && !is_null( $requested_page ) )
	{
		
		$return_val =  '<div class="row">
							<div class="col-12 carousel-image">
								<h4>' . $requested_page->post_title . ' was requested</h4>
								<img src="http://127.0.0.1/wp/wp-content/uploads/2017/09/AP-1-300x300.png" alt="AlgaeCal Plus Bottle" />
							</div>
						</div>';
	}
	
	return $return_val;
}
add_shortcode( 'algaecal_carousel', 'display_algaecal_carousel' );

?>