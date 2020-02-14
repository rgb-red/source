$(function() {
	//选择充值方式
	$(".recharge-style li").click(function() {
		//按钮样式
		$(".recharge-style li").removeClass("active");
		$(this).addClass("active");

		var payType = $(this).attr("id");

		$("#payform .paytype").attr("value", payType);
	});

	//选择充值金额
	$("ul.recharge-selector li").click(function() {
		//按钮样式
		$(this).parent().children("li").children("a.active").removeClass("active");
		$(this).children("a").addClass("active");

		var amount = $(this).attr("data-name");
		var token = $(this).attr("data-token");

		$("#payform .amount").attr("value", amount);
		$("#payform .token").attr("value", token);
	});

	//确认充值按钮
	$('.recharge-fix-btn').click(function(e) {
		$(".mask,#wxpay").show();
		$("#payform").submit();
	});

	//关闭提示信息
	$(".gary,.win-pay-cross").click(function(){
		location.reload();
	});

	//检查是否充值成功
	$('#wxpay .win-pay-btn.red').click(function(e) {
		var order_id = $("#payform .order_id").val();

		$.ajax({
		    method: 'POST',
		    url: '/pay/checkRecharge',
		    dataType: 'json',
		    data: { order_id: order_id },
		    async: false,
		    success: function (data) {
		    	if(data == 1){
		    		window.location.href='/account/record_recharge';
		    	}
		    	else{
		    		$("#wxpay").hide();
		    		$("#payfail").show();
		    	}
		    }
		});
	});
	
});