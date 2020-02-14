<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>帮助中心 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="帮助中心,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="帮助中心,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/account.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"帮助中心"))?>
		<div class="feedback-main">
			<form action="/ajax/getOpinion" method="post" enctype="multipart/form-data">
				<p class="feedback-main-title">反馈类型</p>
				<ul class="feedback-main-list">
					<li data-type="0" class="feedback-main-list-item active">建议与投诉</li>
					<li data-type="1" class="feedback-main-list-item ">错误反馈</li>
					<li data-type="2" class="feedback-main-list-item ">举报低俗</li>
					<li data-type="3" class="feedback-main-list-item ">版权投诉</li>
				</ul>
				<textarea class="feedback-main-textarea" placeholder="请输入您要反馈的详细内容～有配图会更好哦～"></textarea>
				<ul class="feedback-main-pic-container">
					<li class="feedback-main-pic-item">
						<input id="imgs_help" type="file" accept="image/*" style="display: none;" />
						<a href="javascript:$('#imgs_help').click();">
							<img class="feedback-main-pic-add" src="/img/icon/feedback-main-pic-add.png">
						</a>
					</li>
				</ul>
				<p class="feedback-main-title">联系方式</p>
				<input class="feedback-main-input" type="text" name="number" placeholder="手机/QQ/Email请至少填写一项">
				<span id="hint" style="color: red;font-size:14px;margin-left:10px;"></span>
				<a href="javascript:$('form').submit();" class="feedback-main-btn">提交</a>
				<input type="hidden" id="type" name="type">
				<input type="hidden" id="content" name="content" />
				<input type="hidden" id="contact" name="contact" />
			</form>
		</div>
		<div style="height:50px"></div>
		<?php $this->load->view("layout/footer")?>
		<script src="/js/help.js"></script>
	</body>
</html>