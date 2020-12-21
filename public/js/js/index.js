$(document).ready(function(){
	

$('.bxslider').bxSlider({

			mode: 'fade',
			auto: true,
			speed: 3000

		});




$("#icon").click(function(){

	$("ul").addClass("on");

});




});



$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut(); 
	$("#preloder").delay(400).fadeOut("slow");

});