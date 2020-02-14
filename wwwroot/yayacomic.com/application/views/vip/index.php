<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>VIP资料 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="VIP资料,VIP会员成长体系,VIP会员成长值,会员成长规则,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="VIP资料,VIP会员成长体系是动漫屋为广大VIP会员提供的一项激励及奖励机制,给予VIP会员用户更多的娱乐体验和享有更多的关怀与回馈。<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/account.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"VIP资料"))?>
		<div class="vip-main">
			<div class="vip-main-cover">
				<img class="vip-main-avatar" src="/img/icon/mrtx.gif">
				<img class="vip-main-avatar-top" src="/img/vip/vip-main-avatar-top.png"></div>
			<div class="vip-main-info">
				<p class="vip-main-info-title">洪啊洪
					<img class="vip-main-info-rank" src="/img/vip/vip-main-info-rank1.png"></p>
				<p class="vip-main-info-tip">VIP有效期：2019-06-07</p>
				<a class="vip-main-info-right" href="/vip/record">开通记录</a></div>
			<div class="dj-top">
				<div class="dj-top-block">
					<div class="dj-top-block-value" style="width:0%;"></div>
				</div>
				<div class="dj-top-item active">
					<p class="dj-top-item-title">VIP1</p>
					<p class="dj-top-item-num">0</p>
					<div class="dj-top-item-bar">
						<div class="dj-top-item-bar-circle1"></div>
						<div class="dj-top-item-bar-circle2"></div>
					</div>
				</div>
				<div class="dj-top-item ">
					<p class="dj-top-item-title">VIP2</p>
					<p class="dj-top-item-num">600</p>
					<div class="dj-top-item-bar">
						<div class="dj-top-item-bar-circle1"></div>
						<div class="dj-top-item-bar-circle2"></div>
					</div>
				</div>
				<div class="dj-top-item ">
					<p class="dj-top-item-title">VIP3</p>
					<p class="dj-top-item-num">1800</p>
					<div class="dj-top-item-bar">
						<div class="dj-top-item-bar-circle1"></div>
						<div class="dj-top-item-bar-circle2"></div>
					</div>
				</div>
				<div class="dj-top-item ">
					<p class="dj-top-item-title">VIP4</p>
					<p class="dj-top-item-num">4800</p>
					<div class="dj-top-item-bar">
						<div class="dj-top-item-bar-circle1"></div>
						<div class="dj-top-item-bar-circle2"></div>
					</div>
				</div>
				<div class="dj-top-item ">
					<p class="dj-top-item-title">VIP5</p>
					<p class="dj-top-item-num">10800</p>
					<div class="dj-top-item-bar">
						<div class="dj-top-item-bar-circle1"></div>
						<div class="dj-top-item-bar-circle2"></div>
					</div>
				</div>
			</div>
			<div class="dj-sign">
				<div class="dj-sign-value gary" style="left:0%;">0</div></div>
			<div class="vip-main-bottom">
				<div class="vip-main-bottom-left">VIP等级：
					<span>Lv1</span></div>
				<div class="vip-main-bottom-right">成长值：
					<span>0点（10点/天）</span></div>
			</div>
		</div>
		<p class="vip-text-1">加油～再获得600会员成长值即可升级为VIP2～</p>
		<a class="vip-text-2" href="/notice/vip">如何提升VIP等级</a>
		<div class="vip-table">
			<table class="dj-table t2">
				<tbody>
					<tr>
						<th style="width:16%;">特权</th>
						<th style="width:16%;">VIP1</th>
						<th style="width:16%;">VIP2</th>
						<th style="width:16%;">VIP3</th>
						<th style="width:16%;">VIP4</th>
						<th style="width:16%;">VIP5</th></tr>
					<tr>
						<td>购买付费章节折扣</td>
						<td class="dj-table-r">9折</td>
						<td class="dj-table-r">8折</td>
						<td class="dj-table-r">7折</td>
						<td class="dj-table-r">6折</td>
						<td class="dj-table-r">5折</td></tr>
				</tbody>
			</table>
		</div>
		<a href="/vip/open">
			<img class="vip-new-btn" src="/img/vip/vip-new-btn.png"></a>
		<div class="vip-privilege-view">
			<p class="vip-privilege-view-title">我的特权</p>
			<a href="javascript:;">
				<ul class="vip-privilege-view-list">
					<li>
						<img class="vip-privilege-view-list-img" src="/img/vip/vip-item-1.png">
						<div class="vip-privilege-view-list-info">
							<p class="vip-privilege-view-list-title">每日领币</p>
							<p class="vip-privilege-view-list-content">每日领取20福币</p>
						</div>
					</li>
					<li>
						<img class="vip-privilege-view-list-img" src="/img/vip/vip-item-2.png">
						<div class="vip-privilege-view-list-info">
							<p class="vip-privilege-view-list-title">章节折扣</p>
							<p class="vip-privilege-view-list-content">全站漫画享折扣</p></div>
					</li>
					<li>
						<img class="vip-privilege-view-list-img" src="/img/vip/vip-item-3.png">
						<div class="vip-privilege-view-list-info">
							<p class="vip-privilege-view-list-title">过滤广告</p>
							<p class="vip-privilege-view-list-content">看漫画无广告，更舒心</p>
						</div>
					</li>
					<li>
						<img class="vip-privilege-view-list-img" src="/img/vip/vip-item-4.png">
						<div class="vip-privilege-view-list-info">
							<p class="vip-privilege-view-list-title">充值+20%</p>
							<p class="vip-privilege-view-list-content">每月首单充值+20%</p>
						</div>
					</li>
					<li>
						<img class="vip-privilege-view-list-img" src="/img/vip/vip-item-5.png">
						<div class="vip-privilege-view-list-info">
							<p class="vip-privilege-view-list-title">尊贵身份</p>
							<p class="vip-privilege-view-list-content">专属标识，尊贵身份亮起来</p>
						</div>
					</li>
					<li>
						<img class="vip-privilege-view-list-img" src="/img/vip/vip-item-6.png">
						<div class="vip-privilege-view-list-info">
							<p class="vip-privilege-view-list-title">更多特权</p>
							<p class="vip-privilege-view-list-content">更多优惠，敬请期待</p></div>
					</li>
				</ul>
			</a>
		</div>
		<?php $this->load->view("layout/footer")?>
		<script type="text/javascript">var isload = true;
			var pageindex = 1;
			var count = Number('95');
			$(function() {
				$(window).scroll(function() {
					var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
					if (($("body").height() - scrollTop) <= document.documentElement.clientHeight && pageindex * 15 < count && isload) {
						isload = false;
						request(++pageindex);
					}
				});
			});
			function request(pageindex) {
				$.ajax({
					url: '/dm5.ashx?t=' + new Date().getTime(),
					dataType: "json",
					type: "POST",
					data: {
						action: 'getvipcomics',
						pageindex: pageindex,
						pagesize: 15
					},
					success: function(data) {
						if (data && data['UpdateComicItems']) {
							$(data['UpdateComicItems']).each(function() {
								var str = '<li><div class="manga-list-2-cover">';
								str += '<a href="/' + this["UrlKey"] + '/"><img class="manga-list-2-cover-img" src="' + this["ShowPicUrlB"] + '"></a>';
								str += '<span class="manga-list-1-cover-logo-font">' + this["Logo"] + '</span>';
								str += '</div><p class="manga-list-2-title"><a href="/' + this["UrlKey"] + '/">' + this["Title"] + '</a></p>';
								str += '<p class="manga-list-2-tip"><a href="/' + this["LastPartUrl"] + '/">' + (this["Status"] === 1 ? "完结": "最新") + ' ' + this["ShowLastPartName"] + '</a></p></li>';
								$(".manga-list-2").append(str);
							});
						}
						if (data && data['Count'] >= 0) {
							count = data['Count'];
						}
						if (count <= pageindex * 15) {
							$(".manga-list-2").append("<div class=\"noDataFont\" style=\"padding:10px;font-size:12px;color:#767676;text-align: center;\">主人，下面木有了~</div>");
						}
					},
					complete: function() {
						isload = true;
					}
				});
			}
		</script>
	</body>
</html>