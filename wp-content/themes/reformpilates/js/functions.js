// jshint asi: true
// jshint devel: true
// jshint unused:false

// @codekit-prepend "scripts/menuToggle.js"
// @codekit-prepend "scripts/parallax.js"
// @codekit-prepend "scripts/sliders.js"
// @codekit-prepend "scripts/header.js"
// @codekit-prepend "scripts/cover.js"

$(document).ready(function() {

	menuToggle()
	sliders()
	header()
	cover()

	setTimeout(function () {
		parallax()
	},100)

})

$(document).scroll(function() {

	header()

})

$(window).resize(function () { 
	$(window).width() > 1280 ? menuOpen('x') : menuClose('x') //jshint ignore:line
})

window.onload = function () {
	var e = document.getElementById("canvas"),
		o = new Curtains("canvas"), // jshint ignore:line
		t = document.getElementsByClassName("plane")[0],
		n = { vertexShaderID: "plane-vs", fragmentShaderID: "plane-fs", uniforms: { time: { name: "uTime", type: "1f", value: 0 } } },
		i = o.addPlane(t, n)
	i.onRender(function () {
		i.uniforms.time.value++
	})
}
