<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?=SITE()["name"]?> - <?=SITE()["slogan"]?></title>
		<meta name="keywords" content="<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>" />
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>" />
		<link rel="stylesheet" type="text/css" href="/css/swiper-4.1.0.min.css?<?=VERSION()?>" />
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>" /></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>" /></script>
		<script type="text/javascript" src="/js/script.js?<?=VERSION()?>" /></script>
	</head>
	<body class="bg-gray" style="padding-top: 0px; zoom: 1;">
		<!-- 顶部导航条 -->
		<div class="normal-top" style="position: inherit;">
			<img class="normal-top-logo" src="/img/logo.png?<?=VERSION()?>">
			<div class="normal-top-right loginInfo">
				<a href="/home/search">
					<img class="normal-top-right-search" src="/img/icon/search.png?<?=VERSION()?>">
				</a>
				<?php if(!loginCheck()):?>
				<a href="/user/login">
					<b><span>登录</span></b>
				</a>
				<?php else:?>
				<a href="/user/center">
					<img class="normal-top-right-avatar" src="<?=getAvatar()?>">
				</a>
				<?php endif;?>
			</div>
		</div>
		<!-- 轮播图 -->
		<div class="index-banner">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach($banner as $k => $v):?>
					<div class="swiper-slide">
						<a href="/comic/detail/<?=$v["id"]?>" title="<?=$v["title"]?>">
							<img src="/comics/top/<?=$v["id"]?>.jpg?<?=VERSION()?>" alt="《<?=$v["title"]?>》更新至<?=$v["chapter"]?>节" title="《<?=$v["title"]?>》更新至<?=$v["chapter"]?>节">
						</a>
					</div>
					<?php endforeach;?>
				</div>
				<!-- 分页器 -->
				<!-- <div class="swiper-pagination"></div> -->
			</div>
		</div>
		<!-- 首页分类栏 -->
		<div class="banner-bottom">
			<img src="/img/banner-bottom.png?<?=VERSION()?>"></div>
		<div class="index-menu">
			<div class="index-menu-item">
				<a href="/home/search">
					<img class="index-menu-item-img" src="/img/icon/index-menu-1.png?<?=VERSION()?>">
					<p class="index-menu-item-title">分类</p>
				</a>
			</div>
			<div class="index-menu-item">
				<a href="/home/rank">
					<img class="index-menu-item-img" src="/img/icon/index-menu-2.png?<?=VERSION()?>">
					<p class="index-menu-item-title">排行</p>
				</a>
			</div>
			<div class="index-menu-item">
				<a href="/home/dayupdate">
					<img class="index-menu-item-img" src="/img/icon/index-menu-3.png?<?=VERSION()?>">
					<p class="index-menu-item-title">更新</p>
				</a>
			</div>
			<div class="index-menu-item">
				<a href="/user/bookhistory">
					<img class="index-menu-item-img" src="/img/icon/index-menu-4.png?<?=VERSION()?>">
					<p class="index-menu-item-title">历史</p>
				</a>
			</div>
		</div>
		<!-- 广告栏 -->
		<div class="ad-top">
			<a href="/user/register/">
				<img class="ad-top-img" src="/img/ad/index-ad-1.jpg?<?=VERSION()?>">
			</a>
		</div>
		<div class="manga-list" style="border-top:none;margin-top: 0;">
			<div class="manga-list-title index">
				大家都在看
				<a href="/home/allList" class="manga-list-title-more">更多</a>
			</div>
			<ul class="manga-list-1">
				<div class="swiper-container1">
					<div class="swiper-wrapper">
						<?php if($rand):?>
						<?php foreach($rand as $k => $v):?>
						<div class="swiper-slide">
							<?php foreach($v as $kk => $vv):?>
							<li>
								<a href="/comic/detail/<?=$vv["id"]?>" title="<?=$vv["title"]?>">
									<div class="manga-list-1-cover">
										<img class="manga-list-1-cover-img" src="/comics/cover2/<?=$vv["id"]?>.jpg?<?=VERSION()?>">
									</div>
									<p class="manga-list-2-title"><?=$vv["title"]?></p>
									<p class="manga-list-1-tip"><?=$vv["brief"]?></p>
								</a>
							</li>
							<?php endforeach;?>
						</div>
						<?php endforeach;?>
						<?php endif;?>
					</div>
				</div>
			</ul>
		</div>
		<div class="manga-list">
			<div class="manga-list-title index">每日上新
				<a href="/home/dayupdate" class="manga-list-title-more">更多</a>
			</div>
			<ul class="manga-list-2">
				<div class="swiper-container2">
					<div class="swiper-wrapper">
						<?php if($news):?>
						<?php foreach($news as $k => $v):?>
						<div class="swiper-slide">
							<?php foreach($v as $kk => $vv):?>
							<li>
								<div class="manga-list-2-cover">
									<a href="/comic/detail/<?=$vv["id"]?>" title="<?=$vv["title"]?>">
										<img class="manga-list-2-cover-img" src="/comics/cover/<?=$vv["id"]?>.jpg?<?=VERSION()?>">
									</a>
								</div>
								<p class="manga-list-2-title">
									<a href="/comic/detail/<?=$vv["id"]?>"><?=$vv["title"]?></a>
								</p>
								<p class="manga-list-2-tip">
									<a href="/comic/detail/<?=$vv["id"]?>">最新 第<?=$vv["chapter"]?>话</a>
								</p>
							</li>
							<?php endforeach;?>
						</div>
						<?php endforeach;?>
						<?php endif;?>
					</div>
				</div>
			</ul>
		</div>
		<div class="manga-list">
			<div class="manga-list-title index">上升最快
				<a href="/home/rank" class="manga-list-title-more">更多</a></div>
			<ul class="manga-list-2">
				<div class="swiper-container2">
					<div class="swiper-wrapper">
						<?php if($news):?>
						<?php foreach($news as $k => $v):?>
						<div class="swiper-slide">
							<?php foreach($v as $kk => $vv):?>
							<li>
								<div class="manga-list-2-cover">
									<a href="/comic/detail/<?=$vv["id"]?>" title="<?=$vv["title"]?>">
										<img class="manga-list-2-cover-img" src="/comics/cover/<?=$vv["id"]?>.jpg?<?=VERSION()?>"></a>
								</div>
								<p class="manga-list-2-title">
									<a href="/comic/detail/<?=$vv["id"]?>"><?=$vv["title"]?></a></p>
								<p class="manga-list-2-tip">
									<a href="/comic/detail/<?=$vv["id"]?>">最新 第<?=$vv["chapter"]?>话</a></p>
							</li>
							<?php endforeach;?>
						</div>
						<?php endforeach;?>
						<?php endif;?>
					</div>
				</div>
			</ul>
		</div>
		<div class="manga-list">
			<div class="manga-list-title index">精品专题
				<a href="/home/subject" class="manga-list-title-more">更多</a>
			</div>
			<div class="manga-book-list">
				<div class="swiper-container1 swiper-container-horizontal swiper-container-ios swiper-container-wp8-horizontal">
					<div class="swiper-wrapper" style="transform: translate3d(-1013px, 0px, 0px); transition-duration: 0ms;">
						<?php if($subject):?>
						<?php foreach($subject as $k => $v):?>
						<div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0">
							<div class="manga-book-list-main">
								<?php foreach($v["book"] as $kk => $vv):?>
								<?php if($kk <= 2):?>
								<div class="manga-book-list-main-cover">
									<div class="manga-book-list-main-cover-item">
										<img src="/comics/cover/<?=$vv?>.jpg" onclick="window.location.href = '/comic/detail/<?=$vv?>';">
									</div>
								</div>
								<?php endif;?>
								<?php endforeach;?>
								<a href="/home/subject/<?=$v["id"]?>" title="<?=$v["title"]?>">
									<p class="manga-book-list-main-title"><?=$v["title"]?></p>
									<p class="manga-book-list-main-subtitle"><?=$v["descript"]?></p>
								</a>
							</div>
						</div>
						<?php endforeach;?>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
		<div class="manga-list">
			<div class="manga-list-title index">排行榜
				<div class="manga-list-title-right">
					<a class="manga-list-title-right-item active" href="javascript:void(0);" onclick="mySwiper_rank.slideTo(0);">人气</a>
					<a class="manga-list-title-right-item" href="javascript:void(0);" onclick="mySwiper_rank.slideTo(1);">新番</a>
					<a class="manga-list-title-right-item" href="javascript:void(0);" onclick="mySwiper_rank.slideTo(2);">收藏</a>
					<a class="manga-list-title-right-item" href="javascript:void(0);" onclick="mySwiper_rank.slideTo(3);">吐槽</a>
				</div>
			</div>
			<ul class="rank-list index">
				<div class="swiper-container4" id="rank_list">
					<div class="swiper-wrapper">
						<?php if($rank):?>
						<?php foreach($rank as $k => $v):?>
						<div class="swiper-slide" id="rank_<?=$k + 1?>">
							<?php foreach($v as $kk => $vv):?>
							<li>
								<a href="/comic/detail/<?=$vv["id"]?>" title="<?=$vv["title"]?>">
									<div class="rank-list-cover">
										<img class="rank-list-cover-img" src="/comics/cover2/<?=$vv["id"]?>.jpg?<?=VERSION()?>"></div>
									<div class="rank-list-info">
										<div class="rank-list-info-right">
											<p class="rank-list-info-right-title"><?=$vv["title"]?></p>
											<p class="rank-list-info-right-subtitle"><?=$vv["descript"]?></p>
										</div>
									</div>
								</a>
							</li>
							<?php endforeach;?>
						</div>
						<?php endforeach;?>
						<?php endif;?>
					</div>
				</div>
			</ul>
		</div>
		<a href="javascript:void(0);" onclick="$('html, body').animate({ scrollTop:0},500);">
			<img class="return-top" src="/img/icon/return-top.png?<?=VERSION()?>">
		</a>
		<script type="text/javascript" src="/js/lib/swiper-4.1.0.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/index.js?<?=VERSION()?>"></script>
		<?php $this->load->view("layout/footerNoBtn")?>
	</body>
</html>