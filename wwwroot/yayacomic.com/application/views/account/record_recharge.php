<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>充值记录 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="充值记录,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="充值记录,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/account.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<style type="text/css">#wrapper { position: absolute; z-index: 1; top: 90px; bottom: 0px; left: 0; width: 100%; overflow: hidden; } #scroller { position: absolute; z-index: 1; -webkit-tap-highlight-color: rgba(0,0,0,0); width: 100%; -webkit-transform: translateZ(0); -moz-transform: translateZ(0); -ms-transform: translateZ(0); -o-transform: translateZ(0); transform: translateZ(0); -webkit-touch-callout: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-text-size-adjust: none; -moz-text-size-adjust: none; -ms-text-size-adjust: none; -o-text-size-adjust: none; text-size-adjust: none; }</style>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"充值记录"))?>
		<div class="selector-top">
			<a class="selector-top-item active" href="javascript:pushHistory('/account/record_recharge');">充值记录</a>
			<a class="selector-top-item " href="javascript:pushHistory('/account/record_gift');">获赠记录</a>
			<a class="selector-top-item " href="javascript:pushHistory('/account/record_consume');">消费记录</a>
		</div>
		<div id="wrapper">
			<ul class="vip-record">
				<li>
					<p class="vip-record-rechange">2019-05-23 16:41 / 微信充值</p>
					<span class="vip-record-right">+1000</span>
				</li>
			</ul>
		</div>
		<div style="height:50px"></div>
		<?php $this->load->view("layout/footer")?>
		<script src="/js/iscroll.js"></script>
		<script src="/js/wallet.js"></script>
		<script type="text/javascript">
			if (document.getElementById('scroller') && document.getElementById('scroller').offsetHeight + 60 >= document.getElementById('wrapper').clientHeight) {
				$('#footer1').css({
					display: 'block'
				});
				$('#footer2').hide();
			}
			var timestamp = Number('1558600904250' || '0');
			var type = Number('0');
			Wallet.prototype.append = function() {
				if (timestamp > 0) {
					this.loading();
					$.ajaxSettings.async = false;
					if (type === 1) {
						$.getJSON('/dm5.ashx', {
							action: 'getgiftcoinhistorys',
							type: type,
							timestamp: timestamp
						},
						function(data) {
							if (data && data['items']) {
								$(data['items']).each(function() {
									var itemstr = '<div class="ticket-item ' + (this['Status'] === 0 || this['Status'] === 2 ? 'active': '') + '"><div class="ticket-item-left">';
									itemstr += '<p class="ticket-item-left-title">' + this['OrignalAmount'] + '</p>';
									itemstr += '<p class="ticket-item-left-tip">赠币</p>';
									itemstr += '<img class="ticket-item-left-right" src="http://css122us.cdndm5.com/v201904041843/dm5/images/mobile/ticket-item-left-right.png">';
									itemstr += '</div>';
									itemstr += '<div class="ticket-item-right">';
									itemstr += '<p class="ticket-item-right-title">剩余：' + this['AvailableAmount'] + '赠币</p>';
									itemstr += '<p class="ticket-item-right-subtitle">' + (this['Brief'] || '有效期至:永久有效') + '</p>';
									itemstr += '<p class="ticket-item-right-tip">来源：' + this['BizInfo'] + '<span>时间：' + this['GetTime'] + '</span></p>';
									if (this['Status'] > 0) {
										itemstr += '<img class="ticket-item-right-img" src="http://css122us.cdndm5.com/v201904041843/dm5/images/mobile/ticket-item-right-img-' + (this['Status'] === 1 ? 'used': (this['Status'] === 2 ? 'active': 'expired')) + '.png">';
									}
									itemstr += '</div></div>';
									$('#footer1').before(itemstr);
								});
								timestamp = data['mintimestamp'];
							}
							wallet.isloading = false;
						});
					} else if (type === 2) {
						$.getJSON('/dm5.ashx', {
							action: 'getpayhistorys',
							timestamp: timestamp
						},
						function(data) {
							if (data && data['items']) {
								$(data['items']).each(function() {
									var itemstr = '<li class="gary">';
									itemstr += '<p class="vip-record-title">' + this['Brief'] + '</p>';
									itemstr += '<p class="vip-record-tip">' + this['PayTime'] + '</p>';
									itemstr += '<span class="vip-record-right">' + this['Amount'] + '</span>';
									itemstr += '</li>';
									$('#wrapper ul').append(itemstr);
								});
								timestamp = data['mintimestamp'];
							}
							wallet.isloading = false;
						});
					} else if (type === 0) {
						$.getJSON('/dm5.ashx', {
							action: 'getrechargehistories',
							timestamp: timestamp
						},
						function(data) {
							if (data && data['items']) {
								$(data['items']).each(function() {
									var itemstr = '<li>';
									itemstr += '<p class="vip-record-rechange">' + this['RechargeTime'] + '</p>';
									itemstr += '<span class="vip-record-right">' + this['Amount'] + '</span>';
									itemstr += '</li>';
									$('#wrapper ul').append(itemstr);
								});
								timestamp = data['mintimestamp'];
							}
							wallet.isloading = false;
						});
					}
					$('.loading').remove();
				}
				if (timestamp === 0) {
					if ((type === 0 || type === 2) && $('#wrapper ul .noDataFont').length === 0) {
						$('#wrapper ul').append("<div class=\"noDataFont\" style=\"padding:10px;font-size:12px;color:#767676;text-align: center;\">主人，下面木有了~</div>");
					}
					if (type === 1 && $('#footer1 .noDataFont').length === 0) {
						$('#footer1').before("<div class=\"noDataFont\" style=\"padding:10px;font-size:12px;color:#767676;text-align: center;\">主人，下面木有了~</div>");
					}
				}
			};
		</script>
	</body>
</html>