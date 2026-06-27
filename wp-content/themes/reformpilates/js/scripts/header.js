// jshint asi: true
// jshint devel: true
// jshint unused:false


function header() {

	var header_distance = $('.header_JS').offset().top - $(window).scrollTop()

	if (header_distance <= 0) {
		$('.header_JS').addClass('active')
	} else {
		$('.header_JS').removeClass('active')
	}

}