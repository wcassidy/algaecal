// Java script needed for the carousel and lightbox functionality

// Everything in the ready event otherwise multi-threaded renderers may have dom issues
$(document).ready(function(){
	// Setup the slick carousel and deal with small screens
	$('.algaecal-carousel').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
		{
		  breakpoint: 767,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			arrows: false
		  }
		}
		]
	});
	
	// Need to add the lightbox to the page at load time since this is for a wordpress plugin
	// Don't want users to have to add tags to support the plugin
	$("body").prepend('<div id="lightbox" class="lightbox"></div>');
	
	// Method to change the preview image above the carousel when the user clicks one of the thumbnails
	// in the carousel
	$("#algaecal-carousel").click(function(event) {
		var target = $( event.target );
		
		if( target.is( "img" ) )
		{
			// copy the attributes of the image tag from the carousel to the preview image
			$("#algaecal-carousel-image").attr( "src", target.attr("src") );
			$("#algaecal-carousel-image").attr( "alt", target.attr("alt") );
			$("#algaecal-carousel-image").data( "video-key", target.data("video-key") );
		}
	});

	// Display the lightbox with either the image or the wistia video when the image preview is clicked on
	$("#algaecal-carousel-image").click(function(event) {
		var target = $( event.target );

		if( target.is( "img" ) )
		{
			// If the video_key (wistia_key) is empty then this is an image not a video
			var video_key = $(target).data("video-key");
		
			if(video_key == '')
			{
				// Add the image to the lightbox and display
				$("#lightbox").prepend('<img id="lightbox-image" class="lightbox-image" />');
				$("#lightbox").css("display", "block");
				$("#lightbox-image").attr( "src", target.attr("src") );
			}
			else
			{
				// Add the wistia video embed tags and display the light box
				$("#lightbox").css("display", "block");
				var video_html = '<div id="lightbox-video" class="lightbox-video">' + 
								 '<script src="//fast.wistia.com/embed/medias/' + video_key + 
								 '.jsonp" async=""></script><div class="wistia_embed wistia_async_' + video_key + 
								 '" style="height:395px;width:700px">&nbsp;</div></div>';
				$("#lightbox").prepend(video_html);
			}
		}
	});

	// Shut down the lightbox when clicked
	$("#lightbox").click(function(event) {
		var target = $( event.target );

		// If the user clicks outside of the image or video shut down the light box and remove the image or video
		if( target.is( "div" ) )
		{
			$("#lightbox").css("display", "none");
			$("#lightbox-image").remove();
			$("#lightbox-video").remove();
		}
	});

	// Display the first image from the carousel in the image preview
	$("#algaecal-carousel img[data-slick-index='0']").trigger("click");
});

