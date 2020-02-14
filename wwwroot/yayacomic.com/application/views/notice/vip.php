<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>VIP等级提升说明 - Dark Comico</title>
		<meta name="Keywords" content="漫画,在线漫画,漫画大全" />
		<meta name="Author" content="Dark Comico:好漫画,为看漫画的人而生" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<link rel="stylesheet" href="/css/account.css" />
		<script src="/js/jquery.min.js"></script>
	</head>
	<body class="bg-gray">
		<div class="normal-top">
			<a href="javascript:history.back();">
				<img class="normal-top-back" src="/img/normal-top-back.png" alt="后退"></a>
			<span class="normal-top-title">VIP等级提升说明</span>
			<div class="normal-top-right">
				<a href="/home/search">
					<img class="normal-top-right-search" src="/img/top-right-search.png"></a>
				<a href="/user/center">
					<img class="normal-top-right-avatar" src="/img/mrtx.gif"></a>
			</div>
		</div>
		<div class="vip-rank">
			<p class="dj-title">如何提升VIP等级</p>
			<p class="dj-text2">当VIP用户的累积会员成长值达到指定点数即可自动升级</p>
			<div class="dj-form">
				<div class="dj-form-item">会员成长值</div>
				<div class="dj-form-sign">=</div>
				<div class="dj-form-item">每天成长值</div>
				<div class="dj-form-sign">+</div>
				<div class="dj-form-item">开通成长值</div></div>
			<div class="dj-form">
				<div class="dj-form-sign">-</div>
				<div class="dj-form-item gary">非会员下降值</div>
				<div class="dj-form-sign">&nbsp;</div></div>
			<table class="dj-table">
				<tr>
					<th>支付方式</th>
					<th>每日成长值</th>
					<th>开通成长</th>
					<th>非会员下降值</th></tr>
				<tr>
					<td>连续包月(连续两个月及两个月以上即为连续包月)</td>
					<td class="dj-table-y">12点/天</td>
					<td>可立即获得
						<span class="dj-table-y">300点</span>成长值（每个账号限一次)</td>
					<td rowspan="3">
						<span class="dj-table-g">-5点／天</span>
						<br />
						<br />VIP权益到期后没有续费，成长值每天下降5点，成长等级也会随之下降</td></tr>
				<tr>
					<td>年付</td>
					<td class="dj-table-y">15点/天</td>
					<td>可立即获得
						<span class="dj-table-y">600点</span>成长值</td></tr>
				<tr>
					<td>包月</td>
					<td class="dj-table-y">10点/天</td>
					<td>包月会额外获得开通成长值</td></tr>
			</table>
		</div>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>