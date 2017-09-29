Notes on the AlgaeCal Plus Product Page

- I created a "very" basic theme for the project which is called algaecal.
- I didn't use the auto-generate thumbnail feature from Wistia.  There is a comment in my plugins php file about this.
- I used the free glober (semi-bold) font as Roboto was making my eyes bleed.  If you try to view the site with you're glober font you'll have to remove the one I added as I added it as "Glober"
- I avoided object-orientation in php and javascript for two reasons.  Firstly, the project was very simple and didn't really need it.  Secondly it makes the code easier to read for a project this size.  Normally I always code php in an OO manner and avoid it in javascript unless necessary (js OO is pretty hackish).

Files:
/algaecal_product_page_content.php - This is the main content in the page which would be entered into the wordpress admin console.  Basically it's everything except for the carousel which was implemented in the plugin.  It does contain the shortcode used to link the page to the plugin.

/WayneCassidy_wordpress_script.php - This is the answer to question 2.  If you look in the functions.php file for my theme you'll notice I did the same thing there as well.

/algaecal-local/wp-content/uploads - This directory contains the images I used on the page.  I uploaded them to the media gallery in wordpress which is why they are here.

/algaecal-local/wp-content/plugins/algaecal-carousel - This is the directory containing my plugin.  It contains...
	algaecal-carousel-style.scss - The main css for the plugin
	algaecal-carousel.php - The code for the plugin
	algaecal_carousel.js - The javascript used to implement the picture preview and lightbox
	slick - The directory containing the "slick carousel" which is the carousel library I used
	
/algaecal-local/wp-content/themes/algaecal - This is where you'll find the basic theme.  You'll probably only want to look at the style.css file here but feel free to check out whatever is there.