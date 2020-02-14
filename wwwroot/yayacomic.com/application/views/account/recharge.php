<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>账户充值 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="支付中心,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="支付中心,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/account.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"次元币充值"))?>
		<div class="title-1">充值金额</div>
		<ul class="recharge-selector">
			<li data-name="1000" data-token="<?=$tenToken?>">
				<a href="javascript:void(0);" class="active">
					<p class="recharge-selector-title">1000次元币</p>
					<p class="recharge-selector-main"><span>¥</span>10</p>
					<p class="recharge-selector-tip">送188福币</p>
					<img class="recharge-selector-right" src="/img/icon/recharge-selector-right-1.png">
				</a>
			</li>
			<li data-name="3000" data-token="<?=$thirtyToken?>">
				<a href="javascript:void(0);">
					<p class="recharge-selector-title">3000次元币</p>
					<p class="recharge-selector-main"><span>¥</span>30</p>
					<p class="recharge-selector-tip">送688福币</p>
					<img class="recharge-selector-right" src="/img/icon/recharge-selector-right-1.png">
				</a>
			</li>
			<li data-name="6000" data-token="<?=$sixtyToken?>">
				<a href="javascript:void(0);">
					<p class="recharge-selector-title">6000次元币</p>
					<p class="recharge-selector-main"><span>¥</span>60</p>
					<p class="recharge-selector-tip">送1688福币</p>
					<img class="recharge-selector-right" src="/img/icon/recharge-selector-right-1.png">
				</a>
			</li>
			<li data-name="10000" data-token="<?=$hundrenToken?>">
				<a href="javascript:void(0);">
					<p class="recharge-selector-title">10000次元币</p>
					<p class="recharge-selector-main"><span>¥</span>100</p>
					<p class="recharge-selector-tip">送3888福币</p>
					<img class="recharge-selector-right" src="/img/icon/recharge-selector-right-1.png">
				</a>
			</li>
			<li data-name="20000" data-token="<?=$twoHundrenToken?>">
				<a href="javascript:void(0);">
					<p class="recharge-selector-title">20000次元币</p>
					<p class="recharge-selector-main"><span>¥</span>200</p>
					<p class="recharge-selector-tip">送10888福币</p>
					<img class="recharge-selector-right" src="/img/icon/recharge-selector-right-1.png">
				</a>
			</li>
			<li data-name="888888" data-token="<?=$eightToken?>">
				<a href="javascript:void(0);">
					<p class="recharge-selector-title">88888次元币</p>
					<p class="recharge-selector-main"><span>¥</span>888</p>
					<p class="recharge-selector-tip">送88888福币</p>
					<img class="recharge-selector-right" src="/img/icon/recharge-selector-right-1.png">
				</a>
			</li>
		</ul>
		<div class="title-1">充值方式</div>
		<ul class="recharge-style">
			<!-- <li>
				<img class="recharge-style-img" src="/img/pay/xinyongka.png">
				<div class="recharge-style-info">
					<p class="recharge-style-title">信用卡</p>
				</div>
				<img class="recharge-style-right" src="/img/icon/recharge-style-right.png?<?=VERSION()?>">
			</li> -->
			<!-- <li>
				<img class="recharge-style-img" src="/img/pay/paypal.png">
				<div class="recharge-style-info">
					<p class="recharge-style-title">Paypal</p>
				</div>
				<img class="recharge-style-right" src="/img/icon/recharge-style-right.png?<?=VERSION()?>">
			</li> -->
			<li id="wechat" class="active">
				<img class="recharge-style-img" src="/img/pay/weixin.png">
				<div class="recharge-style-info">
					<p class="recharge-style-title">微信支付</p>
				</div>
				<img class="recharge-style-right" src="/img/icon/recharge-style-right.png?<?=VERSION()?>">
			</li>
			<li id="alipay">
				<img class="recharge-style-img" src="/img/pay/alipay.png">
				<div class="recharge-style-info">
					<p class="recharge-style-title">支付宝</p>
				</div>
				<img class="recharge-style-right" src="/img/icon/recharge-style-right.png?<?=VERSION()?>">
			</li>
			<!-- <li>
				<img class="recharge-style-img" src="/img/pay/mycard.png">
				<div class="recharge-style-info">
					<p class="recharge-style-title">充值卡</p>
				</div>
				<img class="recharge-style-right" src="/img/icon/recharge-style-right.png?<?=VERSION()?>">
			</li> -->
		</ul>
		<!-- 支付信息提交表单 -->
		<form hidden id="payform" name="payform" method="post" action="/pay/recharge" target="_blank">
			<input type="text" class="order_id" name="order_id" value="<?=$order_id?>">
			<input type="text" class="uid" name="uid" value="<?=$_SESSION["uid"]?>">
			<input type="text" class="username" name="username" value="<?=$_SESSION["username"]?>">
			<input type="text" class="amount" name="amount" value="10">
			<input type="text" class="token" name="token" value="<?=$tenToken?>">
			<input type="text" class="paytype" name="paytype" value="wechat">
		</form>
		<div class="recharge-tip">
			<p class="recharge-tip-line">温馨提示：</p>
			<p class="recharge-tip-line">1、福币可抵扣次元币，付费时优先使用</p>
			<p class="recharge-tip-line">2、充值遇到问题？请联系客服QQ390798960</p>
			<p class="recharge-tip-bottom">
				<a href="/notice/pay">《用户充值、消费服务协》</a>
			</p>
		</div>
		<div class="mask" style="display: none;"></div>
		<div id="wxpay" class="win-pay2" style="display: none;">
			<a href="javascript:;">
				<img class="win-pay-cross" src="/img/icon/win-cross.png?<?=VERSION()?>"></a>
			<p class="win-pay-content pb10">请确认支付是否已完成？</p>
			<div class="win-pay-btn-group2 pb20">
				<a class="win-pay-btn gary" href="javascript:$('.mask,#wxpay').hide();">未完成</a>
				<a class="win-pay-btn red" href="javascript:void(0);">已完成</a>
			</div>
		</div>
		<div id="payfail" class="win-pay2" style="display: none;">
			<a href="javascript:;">
				<img class="win-pay-cross" src="/img/icon/win-cross.png?<?=VERSION()?>"></a>
			<p class="win-pay-content pb10">
				支付异常
				<br />请稍后在充值记录查看充值情况
			</p>
			<div class="win-pay-btn-group2 pb20">
				<a class="win-pay-btn gary" href="javascript:$('.mask,#payfail').hide();">我知道了</a>
			</div>
		</div>
		<a class="recharge-fix-btn" href="javascript:void(0);">确认充值</a>
		<script type="text/javascript" src="/js/pay.js"></script>
	</body>
</html>