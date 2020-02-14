function setCookieTime(cName, value, cExpires) {
	if (!cExpires || cExpires <= 0) {
		cExpires = 12;
	}
	var cookie_time;
	try {
		cookie_time = parseFloat(cExpires) * 1;
	} catch(e) {
		cookie_time = 86400;
	}
	if (isNaN(cookie_time)) {
		cookie_time = 86400;
	}
	var then = new Date();
	then.setTime(then.getTime() + cookie_time * 60 * 1000);
	document.cookie = cName + '=' + value + ';expires=' + then.toGMTString() + ';path=/;';
}
$(window).scroll(function() {
	var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
	if (scrollTop > 300) {
		$(".return-top").fadeIn();
	} else {
		$(".return-top").fadeOut();
	}
});
var mySwiper = new Swiper('.swiper-container', {
	loop: true,
	autoplay: {
		disableOnInteraction: false,
	},
	pagination: {
		el: '.swiper-pagination',
	},
});
var mySwiper_rank = new Swiper('#rank_list', {
	loop: true,
	slidesPerView: 'auto',
	on: {
		slideChangeTransitionEnd: function() {
			$('.manga-list-title-right-item').removeClass('active');
			$('.manga-list-title-right-item').eq(this.activeIndex % 4).addClass('active');
		},
	}
});
var mySwiper1 = new Swiper('.swiper-container1', {
	loop: true,
	slidesPerView: 'auto',
});
var mySwiper2 = new Swiper('.swiper-container2', {
	freeMode: true,
	slidesPerView: 'auto',
});
var mySwiper3 = new Swiper('.swiper-container3', {
	loop: true,
	speed: 1000,
	direction: 'vertical',
	autoplay: {
		delay: 3000
	},
});
$(window).scroll(function() {
	var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
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