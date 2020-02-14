<?php
	$type = $this->input->get("type");
	if($type == "nickname"){
		$title = "修改昵称";
	}
	else if($type == "phone"){
		$title = "修改手机";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?=$title?> - <?=SITE()["name"]?></title>
		<meta name="keywords" content="<?=$title?>,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="<?=$title?>,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" href="/css/account.css?<?=VERSION()?>" />
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>$title))?>
		<?php if($type == "nickname"):?>
		<div class="line-container username">
			<input id="username" class="cinfo" type="text" placeholder="请输入昵称（昵称为2-8个字符）" onblur="$(this).css({borderColor :'#F4F4F4'});" autocomplete="off">
		</div>
		<a href="javascript:void(0);" class="line-container-btn save_nickname">保存</a>
		<?php elseif($type == "phone"):?>
		<div class="line-container username">
			<input id="phone" class="cinfo" type="text" placeholder="请输入手机号" onblur="$(this).css({borderColor :'#F4F4F4'});" autocomplete="off">
		</div>
		<a href="javascript:void(0);" class="line-container-btn save_phone">保存</a>
		<?php endif;?>
		<div class="toast" style="display: none;"></div>
		<div style="height:50px"></div>
		<script src="/js/userinfo.js?<?=VERSION()?>"></script>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>