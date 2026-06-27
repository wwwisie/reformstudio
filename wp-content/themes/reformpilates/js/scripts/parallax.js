// jshint asi: true
// jshint devel: true
// jshint unused: false

function parallax() {
	var didScroll
	
	$(window).scroll(function() {
		function scrollHandler(scroll) {
			var scroll = scroll // jshint ignore:line

			$(elementScroll).each(function(){
				var el = $(this)
				// var elH = el.outerHeight()
				var coefficent = el.attr('data-parallax') 
				var offsetTop = el.offset().top - $(window).scrollTop()
				var translateY = offsetTop * -coefficent/5

				TweenLite.to(el, 1.5, { // jshint ignore:line
					y: translateY
				})

			})
		}

		var elementScroll = $('[data-parallax]')
        var scroll = window.scrollY  
        scrollHandler(scroll) 
        didScroll = true
    })
}
