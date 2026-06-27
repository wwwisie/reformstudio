//jshint asi: true
//jshint devel: true

var menuSt = 0
var menu = $('.menu_JS')

function menuOpen(duration) {
	if (duration) {
		menu.fadeIn(0)
	} else {
		menu.fadeIn('fast')
	}
	$('.menu_btn_JS').addClass('active')
	menuSt = 1
}

function menuClose(duration) {
	if (duration) {
		menu.fadeOut(0)
	} else {
		menu.fadeOut('fast')
	}
	$('.menu_btn_JS').removeClass('active')
	menuSt = 0
}

function menuToggle() {
	$('.menu_btn_JS').click(function() {
		if (menuSt === 0) {		
			menuOpen()
		} else {
			menuClose(0)
		} 
	})
	$('.menu_item_JS').click(function () {
		if ($(window).width() <= 1280) {
			menuClose('x')
		}
	})
}
