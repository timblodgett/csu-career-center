jQuery(document).ready(function($) {

	// LCD Slides
	$('.lcd-slides').slick({
		// default settings
		autoplay: true,
		arrows: false,
		pauseOnFocus: false,
		pauseOnHover: false,

		// optional settings
		autoplaySpeed: $('.lcd-slides').data("autoplaySpeed"),
		speed: $('.lcd-slides').data("slideSpeed"),
		fade: $('.lcd-slides').data("fade")
	});

});
