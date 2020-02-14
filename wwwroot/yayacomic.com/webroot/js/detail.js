$(window).scroll(function() {
	var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
	if (scrollTop > 300) {
		$(".return-top").fadeIn();
		$(".toHome").css("bottom","120px");
	} else {
		$(".return-top").fadeOut();
		$(".toHome").css("bottom","60px");
	}
	if (scrollTop > 111) {
		$('.normal-top').css('position', 'fixed');
		$('body').css('padding-top', '0px');
	} else if (scrollTop > 65) {
		$('.normal-top').css('position', 'fixed');
		$('body').css('padding-top', (111 - scrollTop) + 'px');
	} else {
		$('.normal-top').css('position', 'inherit');
		$('body').css('padding-top', '0px');
	}
});