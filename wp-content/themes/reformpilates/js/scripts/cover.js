// jshint asi: true
// jshint devel: true
// jshint unused:false

function cover() {

	$('.cover_JS').find('a').click(function (e) {
		e.preventDefault()
	})
	
	var count = 1
	$('.cover_JS').find('a').each(function () {
		$(this).attr('data-img',count)
		var img = $(this).attr('href')
		$('.cover_JS').append('<img class="cover--img cover_img_JS" data-img="'+count+'" src="'+img+'">')
		count++
	})

	$('.cover_JS').find('a').mouseover(function () {
		var img = $(this).data('img')
		$('.cover_img_JS[data-img="'+img+'"]').addClass('active')
	}).mouseout(function () {
		$('.cover_img_JS').removeClass('active')
	})

}