<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>失效的福币 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="失效的福币,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="失效的福币,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/account.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<style type="text/css">#wrapper { position: absolute; z-index: 1; top: 90px; bottom: 0px; left: 0; width: 100%; overflow: hidden; } #scroller { position: absolute; z-index: 1; -webkit-tap-highlight-color: rgba(0,0,0,0); width: 100%; -webkit-transform: translateZ(0); -moz-transform: translateZ(0); -ms-transform: translateZ(0); -o-transform: translateZ(0); transform: translateZ(0); -webkit-touch-callout: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-text-size-adjust: none; -moz-text-size-adjust: none; -ms-text-size-adjust: none; -o-text-size-adjust: none; text-size-adjust: none; }</style>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"失效的福币"))?>
		<div class="selector-top">
			<a class="selector-top-item " href="javascript:pushHistory('/account/record_recharge');">充值记录</a>
			<a class="selector-top-item active" href="javascript:pushHistory('/account/record_gift');">获赠记录</a>
			<a class="selector-top-item " href="javascript:pushHistory('/account/record_consume');">消费记录</a>
		</div>
		<div id="wrapper">
			<div id="scroller">
				<div class="ticket-item">
					<div class="ticket-item-left">
						<p class="ticket-item-left-title">1000</p>
						<p class="ticket-item-left-tip">福币</p>
						<img class="ticket-item-left-right" src="/img/icon/ticket-item-left-right.png"></div>
					<div class="ticket-item-right">
						<p class="ticket-item-right-title">剩余：1000福币</p>
						<p class="ticket-item-right-subtitle">有效期至:2019-06-22 16:42</p>
						<p class="ticket-item-right-tip">来源：首充福利
							<span>时间：2019-05-23 16:42</span></p>
					</div>
				</div>
			</div>
		</div>
		<script src="/js/iscroll.js"></script>
		<script src="/js/wallet.js"></script>
		<script type="text/javascript">var timestamp = Number('0' || '0');
			Wallet.prototype.append = function() {
				if (timestamp > 0) {
					$.ajaxSettings.async = false;
					$.getJSON('/dm5.ashx', {
						action: 'getgiftcoinhistorys',
						type: 2,
						timestamp: timestamp
					},
					function(data) {
						if (data && data['items']) {
							$(data['items']).each(function() {
								var itemstr = '<div class="ticket-item"><div class="ticket-item-left">';
								itemstr += '<p class="ticket-item-left-title">' + this['OrignalAmount'] + '</p>';
								itemstr += '<p class="ticket-item-left-tip">福币</p>';
								itemstr += '<img class="ticket-item-left-right" src="http://css122us.cdndm5.com/v201904041843/dm5/images/mobile/ticket-item-left-right.png">';
								itemstr += '</div>';
								itemstr += '<div class="ticket-item-right">';
								itemstr += '<p class="ticket-item-right-title">剩余：' + this['AvailableAmount'] + '福币</p>';
								itemstr += '<p class="ticket-item-right-subtitle">' + (this['Brief'] || '有效期至:永久有效') + '</p>';
								itemstr += '<p class="ticket-item-right-tip">来源：' + this['BizInfo'] + '<span>时间：' + this['GetTime'] + '</span></p>';
								if (this['Status'] > 0) {
									itemstr += '<img class="ticket-item-right-img" src="http://css122us.cdndm5.com/v201904041843/dm5/images/mobile/ticket-item-right-img-' + (this['Status'] === 1 ? 'used': (this['Status'] === 2 ? 'active': 'expired')) + '.png">';
								}
								itemstr += '</div></div>';
								$('#scroller').append(itemstr);
							});
							timestamp = data['mintimestamp'];
						}
					});
				} else if ($('#scroller .noDataFont').length === 0) {
					$('#scroller').append("<div class=\"noDataFont\" style=\"padding:10px;font-size:12px;color:#767676;text-align: center;\">主人，下面木有了~</div>");
				}
			}
		</script>
	</body>
</html>