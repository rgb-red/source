<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>个人中心 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="个人中心,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="个人中心,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/script.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"个人中心"))?>
		<?php if(!loginCheck()):?>
		<div class="center-main">
			<div class="center-main-login">
				<a href="/user/login" class="center-main-login-btn">登录</a>
				<a href="/user/register" class="center-main-login-btn">注册</a>
			</div>
		</div>
		<?php else:?>
		<div class="center-main">
			<div class="center-main-info">
				<div class="center-main-info-cover">
					<img src="<?=getAvatar()?>">
				</div>
				<div class="center-main-info-right">
					<p class="center-main-info-title"><?=$_SESSION["username"]?></p>
					<p class="center-main-info-tip"><?=$_SESSION["email"]?></p>
				</div>
				<a href="/user/info">
					<img class="center-main-info-right-logo" src="/img/center/center-main-right.png">
				</a>
			</div>
		</div>
		<?php endif;?>
		<ul class="center-main-list">
			<li>
				<a href="/user/bookmarker">
					<img class="center-main-list-logo" src="/img/center/center-main-list-logo-1.png">
					<span class="center-main-list-title">我的收藏</span>
					<img class="center-main-list-right" src="/img/wallet/wallet-menu-arrow.png?<?=VERSION()?>"></a>
			</li>
			<li>
				<a href="/user/bookhistory">
					<img class="center-main-list-logo" src="/img/center/center-main-list-logo-2.png">
					<span class="center-main-list-title">阅读历史</span>
					<img class="center-main-list-right" src="/img/wallet/wallet-menu-arrow.png?<?=VERSION()?>"></a>
			</li>
			<li>
				<a href="/account/wallet">
					<img class="center-main-list-logo" src="/img/center/center-main-list-logo-3.png">
					<span class="center-main-list-title">钱包君</span>
					<img class="center-main-list-right" src="/img/wallet/wallet-menu-arrow.png?<?=VERSION()?>"></a>
			</li>
			<li>
				<a href="/vip">
					<img class="center-main-list-logo" src="/img/center/center-main-list-logo-4.png">
					<span class="center-main-list-title">VIP会员</span>
					<img class="center-main-list-right" src="/img/wallet/wallet-menu-arrow.png?<?=VERSION()?>"></a>
			</li>
			<!-- <li>
				<a href="/vipexchange/">
					<img class="center-main-list-logo" src="/img/center-main-list-logo-5.png">
					<span class="center-main-list-title">兑换VIP</span>
					<img class="center-main-list-right" src="/img/wallet-menu-arrow.png"></a>
			</li> -->
			<li>
				<a href="/user/opinion">
					<img class="center-main-list-logo" src="/img/center/center-main-list-logo-1.png">
					<span class="center-main-list-title">意见反馈</span>
					<img class="center-main-list-right" src="/img/wallet/wallet-menu-arrow.png?<?=VERSION()?>">
				</a>
			</li>
		</ul>
		<div style="height:20px"></div>
		<?php $this->load->view("layout/footer")?>
		<a href="/user/logout" class="center-main-bottom-btn">退出登录</a>
		<script type="text/javascript">
			if (document.body.offsetHeight > window.innerHeight) {
				document.body.className = 'bg-gray bottom-tool';
			}
		</script>
	</body>

</html>