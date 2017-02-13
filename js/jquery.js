$(function(){
	$(window).resize(function(){
		var rh=$('#binder_wrapper').height()+'px'.toString();
		$('#myCarousel').css('height',rh);
	});

	$('#myCarousel').css('height',$(window).height());
});