<?php
// Make sure people aren't reading this file from the web (web server permissions should be used so this is just a backup)
defined( 'ABSPATH' ) or die( 'This file is not for reading!' );

/*
Plugin Name:  algaecal-carousel
Description:  Provided a carousel that has an image or video thumbnail showing above and a controlling carousel of thumbnails below. The carousel can take an arbitrary number of items.
Version:      1.0
Author:       Wayne Cassidy
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

// Add all of the css and js files needed by this plugin
function add_styles_scripts()
{
	// Add slick css files
	wp_enqueue_style( 'slick_css', plugin_dir_url( __FILE__ ) . 'slick/slick.css');
	wp_enqueue_style( 'slick_theme_css', plugin_dir_url( __FILE__ ) . 'slick/slick-theme.css');

	// Add the main plugin css
	wp_enqueue_style( 'algaecal_carousel_style', plugin_dir_url( __FILE__ ) . 'algaecal-carousel-style.css');


	// Load slick js
	wp_enqueue_script( 'slick_js', plugin_dir_url( __FILE__ ) . 'slick/slick.min.js', array ( 'jquery' ), '1.0', true);

	// Load main js for plugin
	wp_enqueue_script( 'algaecal_carousel_script', plugin_dir_url( __FILE__ ) . 'algaecal_carousel.js', array ( 'jquery' ), '1.0', true);

	// Load main wistia script
	wp_enqueue_script( 'ev1_js', 'https://fast.wistia.com/assets/external/E-v1.js', false, '1.0', true);
}
add_action( 'wp_enqueue_scripts', 'add_styles_scripts' );

// Setup the custom post_type
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

// The main "GUTS" of this plugin.  This method responds to the usage of a shortcode placed on a page.
function display_algaecal_carousel($atts)
{
	// Default return value to use if there name of the algaecal_carousel is invalid or it doesn't contain any media
	$return_val = "<h4>Could not find algaecal_carousel requested or there were no media entries</h4>";
	
	// Set a default name to test against
	$atts = shortcode_atts( array(
		'name' => 'no_name'
	), $atts, 'algaecal_carousel' );
	
	// Retrieve the algaecal_carousel page requested
	$requested_page = get_page_by_title($atts['name'], OBJECT, 'algaecal_carousel');
	
	// If the page is invalid then we just don't do anything as the default return value is already set
	if( $atts['name'] != 'no_name' && !is_null( $requested_page ) )
	{
		// NOTE: I was going to use a generated thumbnail however the wistia site specified that thumbnail
		// generation can take up to 20 seconds.  Instead I have the person who makes the algaecal_carousel post_type
		// enter a thumbnail url as a custom field.  This way they can pre-generate the thumbnail for speed or use
		// an auto generate url if they don't mind the speed issue

		// ALSO NOTE: The custom fields are setup so that in wordpress, if the media_type is image,
		// then the wistia_key and wistia_thumbnail fields are not displayed and, if the media_type is video,
		// then the image field is not displayed
		
		// Get all of the media entries from the ACF Repeater field (get all the rows)
		$media_entries = get_field('media_entries',  $requested_page);
		if($media_entries)
		{
			// Add the carousel pre-amble tags
			$return_val =  '<div class="hidden-xs algaecal-carousel-preview">
								<img id="algaecal-carousel-image" class="algaecal-carousel-image" data-video-url="" />
							</div>
							<div id="algaecal-carousel" class="algaecal-carousel">';

			foreach( $media_entries as $media_entry )
			{
				// Read the custom fields for the algaecal_carousel post_type
				$caption = $media_entry['caption'];
				$media_type = $media_entry['media_type'];;
				$image = $media_entry['image'];;
				$wistia_key = $media_entry['wistia_key'];;
				$wistia_thumbnail = $media_entry['wistia_thumbnail'];;
										
				// Add the appropriate thumbnail image
				if( $media_type == 'image' )
				{
					$return_val .= '<img class="algaecal-carousel-item" data-video-key="" src="' . $image .
								   '" alt="' . $caption . '" />';
				}
				else
				{
					$return_val .= '<img class="algaecal-carousel-item" data-video-key="' . $wistia_key . 
								   '" src="' . $wistia_thumbnail . '" alt="' . $caption . '" />';
				}
			}
			
			$return_val .= '</div>';
		}
	}

	return $return_val;
}
add_shortcode( 'algaecal_carousel', 'display_algaecal_carousel' );

?>