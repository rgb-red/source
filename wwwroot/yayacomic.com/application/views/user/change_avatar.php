<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>修改头像 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="修改头像,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="修改头像,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" href="/css/account.css?<?=VERSION()?>" />
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"修改头像"))?>
		<form action="/ajax/getAvatar" method="post" enctype="multipart/form-data">
			<ul class="feedback-main-pic-container">
				<li class="change-avatar-li add-avatar-img">
					<input id="change_avatar" type="file" accept="image/*" style="display: none;">
					<a href="javascript:$('#change_avatar').click();">
						<img class="feedback-main-pic-add" src="<?=$avatar?>">
					</a>
				</li>
			</ul>
		</form>
		<p style="color:#9b9b9b;font-size:14px;text-align:center">点击上传方形头像哟~不然会被压扁的啦~</p>
		<a href="javascript:void(0);" class="line-container-btn save_avatar">保存</a>
		<div class="toast" style="display: none;"></div>
		<div style="height:50px"></div>
		<script src="/js/avatar.js"></script>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>