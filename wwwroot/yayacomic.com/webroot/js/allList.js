$(window).scroll(function() {
	var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
	if (scrollTop > 300) {
		$(".return-top").fadeIn();
		$(".toHome").css("bottom","120px");
	} else {
		$(".return-top").fadeOut();
		$(".toHome").css("bottom","60px");
	}
});

$(function () {
	$(".manga-list-bar-item").click(function(){
		var type = $(this).attr("data");
		var status = $(".manga-list-bar-right-down .active").attr("val");
		pushHistory("/home/allList?type=" + type + "&status=" + status);
	});

	$(".manga-list-bar-right-down-item").click(function(){
		var type = $(".manga-list-bar .active").attr("data");
		var status = $(this).attr("val");
		pushHistory("/home/allList?type=" + type + "&status=" + status);
	});
})

