
$(document).ready(function(){
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
	
	$("body").prepend('<div id="lightbox" class="lightbox"><img id="lightbox-item" class="lightbox-item" /></div>');
	
	$("#lightbox").click(function(event) {
		$("#lightbox").css("display", "none");
	});

	$("#algaecal-carousel").click(function(event) {
		var target = $( event.target );
		
		if( target.is( "img" ) )
		{
			// copy the attributes of the image tag from the carousel to the preview image
			$("#algaecal-carousel-image").attr( "src", target.attr("src") );
			$("#algaecal-carousel-image").attr( "alt", target.attr("alt") );
			$("#algaecal-carousel-image").data( "video-url", target.data("video-url") );
		}
	});

	$("#algaecal-carousel-image").click(function(event) {
		var target = $( event.target );

		if( target.is( "img" ) )
		{
			var video = $(target).data("video-url");
		
			if(video == '')
			{
				$("#lightbox").css("display", "block");
				$("#lightbox-item").attr( "src", target.attr("src") );
			}
			else
			{
			
			}
		}
	});
	
	// Display the first image from the carousel in the image preview
	$("#algaecal-carousel img[data-slick-index='0']").trigger("click");
});

