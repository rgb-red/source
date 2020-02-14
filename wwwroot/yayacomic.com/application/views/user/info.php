<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>修改资料 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="修改资料,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="修改资料,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" href="/css/account.css?<?=VERSION()?>" />
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"修改资料"))?>
		<ul class="center-main-list-border">
			<li class="info_avatar">
				<a href="/user/change?type=avatar">
					<span class="center-main-list-title-edit">头像</span>
					<img class="center-main-list-right" src="/img/wallet/wallet-menu-arrow.png?<?=VERSION()?>">
					<span class="center-main-list-right-tip">
						<img class="avatar" src="<?=getAvatar()?>">
					</span>
				</a>
			</li>
		</ul>
		<ul class="center-main-list-border">
			<li>
				<a href="javascript:$('.toast').text('主人，邮箱改了我就不认得您了~呜呜~~');">
					<span class="center-main-list-title-edit">邮箱</span>
					<img class="center-main-list-right" src="/img/wallet/wallet-menu-arrow.png?<?=VERSION()?>">
					<span class="center-main-list-right-tip"><?=$_SESSION["email"]?></span>
				</a>
			</li>
		</ul>
		<ul class="center-main-list-border">
			<li>
				<a href="/user/change?type=nickname">
					<span class="center-main-list-title-edit">昵称</span>
					<img class="center-main-list-right" src="/img/wallet/wallet-menu-arrow.png?<?=VERSION()?>">
					<span class="center-main-list-right-tip"><?=$_SESSION["username"]?></span>
				</a>
			</li>
		</ul>
		<ul class="center-main-list-border">
			<li>
				<a href="/user/change?type=phone">
					<span class="center-main-list-title-edit">手机</span>
					<img class="center-main-list-right" src="/img/wallet/wallet-menu-arrow.png?<?=VERSION()?>">
					<span class="center-main-list-right-tip"><?php echo $_SESSION["phone"] ? $_SESSION["phone"] : "未设置";?></span>
				</a>
			</li>
		</ul>
		<ul class="center-main-list-border">
			<li>
				<a href="/user/password">
					<span class="center-main-list-title-edit">修改密码</span>
					<img class="center-main-list-right" src="/img/wallet/wallet-menu-arrow.png?<?=VERSION()?>">
				</a>
			</li>
		</ul>
		<div class="toast" style="display: none;"></div>
		<div style="height:50px"></div>
		<?php $this->load->view("layout/footer")?>
		<script src="/js/userinfo.js"></script>
	</body>
</html>