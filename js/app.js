(function($, document, window){
	
	$(window).load(function(){

		// Cloning main navigation for mobile menu
		$(".mobile-navigation").append($(".main-navigation .menu").clone());

		// Mobile menu toggle 
		$(".toggle-menu").click(function(){
			$(".mobile-navigation").slideToggle();
		});

		setTimeout(function(){
		$(".home-slider").flexslider({
			controlNav: true,
			directionNav: false
		});}, 50);

		initLightbox({
	    	selector : '.product-images a',
	    	overlay: true,
	    	closeButton: true,
	    	arrow: true
	    });

		/*$(".login-button").on("click",function(){
			$(".overlay").fadeIn();
			$(".auth-popup").toggleClass("active");
		});*/

		/*$(".close, .overlay").on("click",function(){
			$(".overlay").fadeOut();
			$(".popup").toggleClass("active");
		});*/

		/*$(document).keyup(function(e) {
			if( $(".popup").hasClass("active")){
		  		if (e.keyCode === 27) {
		  			$(".overlay").fadeOut();
					$(".popup").toggleClass("active");
		  		}   
			}
		});*/
	});

})(jQuery, document, window);