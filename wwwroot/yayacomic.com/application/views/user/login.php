<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>用户登录 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="用户登录,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="用户登录,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<link rel="stylesheet" href="/css/account.css?<?=VERSION()?>" />

	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"用户登录"))?>
		<form method="post" action="/ajax/login_post" onsubmit="return verifyform(1);">
			<div class="line-container">
				<input id="txt_name" name="txt_name" type="text" placeholder="您的手机号/邮箱/用户名" value="" autocomplete="off">
				<input id="txt_password" name="txt_password" type="password" placeholder="密码" autocomplete="off"></div>
			<div class="pic-verification">
				<p class="pic-verification-title">点击下方图片，旋转至正确方向
					<a class="pic-verification-title-right" href="javascript:refreshcode();">换一组</a></p>
				<div class="pic-verification-list">
					<div class="pic-verification-list-item" style="background-position: 0 0;">
						<input type="hidden" value="0" /></div>
					<div class="pic-verification-list-item" style="background-position: 33.33% 0;">
						<input type="hidden" value="0" /></div>
					<div class="pic-verification-list-item" style="background-position: 66.66% 0;">
						<input type="hidden" value="0" /></div>
					<div class="pic-verification-list-item" style="background-position: 100% 0;">
						<input type="hidden" value="0" /></div>
				</div>
				<input id="txt_code" name="txt_code" type="hidden" /></div>
			<a href="javascript:$('form').submit();" class="line-container-btn">立即登录</a>
			<div class="line-tip">
				<a class="line-tip-left" href="/user/back/">忘记密码?</a>
				<a class="line-tip-right" href="/user/register">去注册</a></div>
			<div class="toast" style="display: none;"></div>
			<?php if(isset($_GET["ok"])):?>
			<div class="mask"></div>
			<div class="win-pay2">
				<a href="/">
					<img class="win-pay-cross" src="/img/icon/win-cross.png?<?=VERSION()?>">
				</a>
				<p class="win-pay-title2">恭喜</p>
				<p class="win-pay-content">
					登录成功<br>
					主人您要去哪？我带您去~
				</p>
				<div class="win-pay-btn-group pb20" align="center">
					<a class="win-pay-btn btn_two red" href="/">首页</a>
					<a class="win-pay-btn btn_two red" href="/user/center">个人中心</a>
				</div>
			</div>
			<?php endif;?>
		</form>
		<div style="height:50px"></div>
		<?php $this->load->view("layout/footer")?>
		<script src="/js/login.js?<?=VERSION()?>"></script>
	</body>
</html>