<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>什么是福币？ - <?=SITE()["name"]?></title>
		<meta name="keywords" content="什么是福币？,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="什么是福币？,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/account.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"什么是福币？"))?>
		<p class="protocol-title">什么是福币？</p>
		<p class="protocol-content">福币是指用户通过Dark Comico活动获取的限期免费币种。</p>
		<p class="protocol-content">福币与次元币价值等同，但有使用期限。</p>
		<p class="protocol-title">如何查询福币的使用期限？</p>
		<p class="protocol-content">用户可通过 钱包君-获赠记录 查看到自己福币到期时间。</p>
		<p class="protocol-title">福币的使用范围</p>
		<p class="protocol-content">
			（1）购买漫画付费章节，当用户同时有次元币和福币时，优先消耗福币。<br />
			（2）购买行为完成后，福币将被自动扣除。<br />
			福币可能在部分消费功能中无法使用，具体可在消费时查看消费页面的帐户余额或以页面提示信息为准。<br />
		</p>
		<div style="height:50px"></div>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>