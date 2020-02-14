<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<title>404 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>"></head>
	<body>
		<div class="main-404">
			<img class="main-404-img" src="/img/404.png?<?=VERSION()?>">
			<a class="main-404-btn" href="/">返回首页</a>
			<a class="main-404-btn-cancel" href="/user/opinion">意见反馈</a></div>
	</body>

</html>
<?php exit;?>