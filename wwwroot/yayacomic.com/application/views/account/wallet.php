<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>钱包君 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="钱包君,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="钱包君,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" href="/css/account.css?<?=VERSION()?>" />
		<script src="/js/jquery.min.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"钱包君"))?>
		<div class="wallet-main">
			<div class="wallet-main-coin">
				<div class="wallet-main-coin-left">
					<p class="wallet-main-coin-title">
						<img class="wallet-main-coin-logo" src="/img/wallet/wallet-main-coin-logo.png?<?=VERSION()?>">
						次元币
						<a href="/notice/coin">
							<img class="wallet-main-coin-q" src="/img/wallet/wallet-main-coin-q.png?<?=VERSION()?>">
						</a>
					</p>
					<p class="wallet-main-coin-value"><?=$balance?></p>
				</div>
				<div class="wallet-main-coin-right">
					<p class="wallet-main-coin-title">
						<img class="wallet-main-coin-logo" src="/img/wallet/wallet-main-giftcoin-logo.png?<?=VERSION()?>">
						福币
						<a href="/notice/giftcoin">
							<img class="wallet-main-coin-q" src="/img/wallet/wallet-main-coin-q.png?<?=VERSION()?>">
						</a>
					</p>
					<p class="wallet-main-coin-value"><?=$fukaBalance?></p>
					<p class="wallet-main-coin-tip"></p>
				</div>
			</div>
			<p class="wallet-main-coin-bottom">福币期限使用，符合使用标准的时候优先扣除</p>
			<a href="/account/recharge" class="wallet-main-coin-btn">去充值</a>
		</div>
		<div class="wallet-menu">
			<a class="wallet-menu-item" href="/account/record_recharge">充值记录
				<img class="wallet-menu-arrow" src="/img/wallet/wallet-menu-arrow.png">
			</a>
			<a class="wallet-menu-item" href="/account/record_gift">获赠记录
				<img class="wallet-menu-arrow" src="/img/wallet/wallet-menu-arrow.png">
			</a>
			<a class="wallet-menu-item" href="/account/record_consume">消费记录
				<img class="wallet-menu-arrow" src="/img/wallet/wallet-menu-arrow.png">
			</a>
		</div>
		<div style="height:20px"></div>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>