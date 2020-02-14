<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>找回密码 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="找回密码,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="找回密码,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<link rel="stylesheet" href="/css/account.css?<?=VERSION()?>" />
		<script type="text/javascript" src="/js/phone.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"找回密码"))?>
		<form method="post" action="/ajax/back_post" onsubmit="return verifyform(3)">
			<div class="line-container">
				<input id="txt_username" name="txt_username" type="text" placeholder="请输入已注册的邮箱地址" value=''></div>
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
				<input id="txt_code" name="code" type="hidden" /></div>
			<a href="javascript:$('form').submit();" class="line-container-btn">确认提交</a>
			<div class="toast" style="display:none;"></div>
			<?php if(isset($_GET["ok"])):?>
			<div class="mask"></div>
			<div class="win-pay2">
				<a href="javascript:$('.mask,.win-pay2').hide();">
					<img class="win-pay-cross" src="/img/icon/win-cross.png">
				</a>
				<p class="win-pay-title2">邮件已发送</p>
				<p class="win-pay-content">
					密码修改邮件已发送至您的邮箱<br>
					请注意查看您的垃圾邮件栏目哦~<br>
				</p>
				<div class="win-pay-btn-group pb20">
					<a class="win-pay-btn red" href="/">我知道了</a>
				</div>
			</div>
			<?php endif;?>
		</form>
		<div style="height:50px"></div>
		<script src="/js/login.js"></script>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>