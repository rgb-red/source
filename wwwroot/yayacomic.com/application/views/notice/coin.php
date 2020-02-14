<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>什么是次元币？ - <?=SITE()["name"]?></title>
		<meta name="keywords" content="什么是次元币？,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="什么是次元币？,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/account.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"什么是次元币？"))?>
		<p class="protocol-title">什么是次元币？</p>
		<p class="protocol-content">次元币是在Dark Comico使用的虚拟货币，可以用于阅读付费章节等。</p>
		<p class="protocol-title">如何获得次元币？</p>
		<p class="protocol-content">仅能通过充值来获取次元币。</p>
		<p class="protocol-title">次元币的安全？</p>
		<p class="protocol-content">
			（1）次元币每次使用行为，均在用户个人中心-我的次元币-明细中被永久记录，可供随时查询。<br />
			（2）次元币目前仅供本人使用，不可转赠，不可转移，充值后不可退还，确保次元币币始终存在于本人账户。<br />
			（3）请保管好自己的账号。<br />
		</p>
		<p class="protocol-title">次元币的用途？</p>
		<p class="protocol-content">
			（1）购买漫画付费章节需消次元币，所消耗次元币，不同章节，定价有所不同。<br />
			（2）购买行为完成后，次元币将被自动扣除。<br />
			（3）购买章节记录，可以明细中进行查询。<br />
			（4）购买的付费章节，可直接浏览，永远无需再次付费。<br />
		</p>
		<div style="height:50px"></div>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>