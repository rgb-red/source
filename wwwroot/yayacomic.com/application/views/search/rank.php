<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>漫画榜单 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="漫画榜单,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="漫画榜单,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/script.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/loadRank.js"></script>
	</head>
	<body class="bg-gray" style="padding-top: 85px;">
		<?php $this->load->view("layout/header", array("title"=>"排行榜"))?>
		<div class="rank-selector">
			<a class="rank-selector-item active" href="javascript:void(0);" onclick="btnClick(this); $('.rank-list').hide(); $('#rankList_1').show(); $('.noDataFont').remove();$('body').scrollTop(0);">人气榜</a>
			<a class="rank-selector-item" href="javascript:void(0);" onclick="btnClick(this); $('.rank-list').hide(); $('#rankList_2').show(); $('.noDataFont').remove();$('body').scrollTop(0);">新番榜</a>
			<a class="rank-selector-item" href="javascript:void(0);" onclick="btnClick(this); $('.rank-list').hide(); $('#rankList_3').show(); $('.noDataFont').remove();$('body').scrollTop(0);">收藏榜</a>
			<a class="rank-selector-item" href="javascript:void(0);" onclick="btnClick(this); $('.rank-list').hide(); $('#rankList_4').show(); $('.noDataFont').remove();$('body').scrollTop(0);">吐槽榜</a></div>
		<div class="rank-list-con">
			<ul class="rank-list" id="rankList_1">
				<?php if($hot):?>
				<?php foreach($hot as $k => $v):?>
				<a href="/comic/detail/<?=$v["id"]?>" title="<?=$v["title"]?>">
					<li>
						<div class="rank-list-cover">
							<img class="rank-list-cover-img" src="/comics/cover2/<?=$v["id"]?>.jpg" alt="<?=$v["title"]?>漫画<?=$v["chapter"]?>">
						</div>
						<div class="rank-list-info">
							<div class="rank-list-info-left">
								<span class="rank-list-info-left-index top-<?=$k+1?>"><?=$k+1?></span>
							</div>
							<div class="rank-list-info-right">
								<p class="rank-list-info-right-title"><?=$v["title"]?></p>
								<p class="rank-list-info-right-subtitle"><?=$v["descript"]?></p>
							</div>
						</div>
					</li>
				</a>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
			<ul class="rank-list" id="rankList_2" style="display: none;">
				<?php if($new):?>
				<?php foreach($new as $k => $v):?>
				<a href="/comic/detail/<?=$v["id"]?>" title="<?=$v["title"]?>">
					<li>
						<div class="rank-list-cover">
							<img class="rank-list-cover-img" src="/comics/cover2/<?=$v["id"]?>.jpg" alt="<?=$v["title"]?>漫画<?=$v["chapter"]?>">
						</div>
						<div class="rank-list-info">
							<div class="rank-list-info-left">
								<span class="rank-list-info-left-index top-<?=$k+1?>"><?=$k+1?></span>
							</div>
							<div class="rank-list-info-right">
								<p class="rank-list-info-right-title"><?=$v["title"]?></p>
								<p class="rank-list-info-right-subtitle"><?=$v["descript"]?></p>
							</div>
						</div>
					</li>
				</a>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
			<ul class="rank-list" id="rankList_3" style="display: none;">
				<?php if($collect):?>
				<?php foreach($collect as $k => $v):?>
				<a href="/comic/detail/<?=$v["id"]?>" title="<?=$v["title"]?>">
					<li>
						<div class="rank-list-cover">
							<img class="rank-list-cover-img" src="/comics/cover2/<?=$v["id"]?>.jpg" alt="<?=$v["title"]?>漫画<?=$v["chapter"]?>">
						</div>
						<div class="rank-list-info">
							<div class="rank-list-info-left">
								<span class="rank-list-info-left-index top-<?=$k+1?>"><?=$k+1?></span>
							</div>
							<div class="rank-list-info-right">
								<p class="rank-list-info-right-title"><?=$v["title"]?></p>
								<p class="rank-list-info-right-subtitle"><?=$v["descript"]?></p>
							</div>
						</div>
					</li>
				</a>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
			<ul class="rank-list" id="rankList_4" style="display: none;">
				<?php if($comment):?>
				<?php foreach($comment as $k => $v):?>
				<a href="/comic/detail/<?=$v["id"]?>" title="<?=$v["title"]?>">
					<li>
						<div class="rank-list-cover">
							<img class="rank-list-cover-img" src="/comics/cover2/<?=$v["id"]?>.jpg" alt="<?=$v["title"]?>漫画<?=$v["chapter"]?>">
						</div>
						<div class="rank-list-info">
							<div class="rank-list-info-left">
								<span class="rank-list-info-left-index top-<?=$k+1?>"><?=$k+1?></span>
							</div>
							<div class="rank-list-info-right">
								<p class="rank-list-info-right-title"><?=$v["title"]?></p>
								<p class="rank-list-info-right-subtitle"><?=$v["descript"]?></p>
							</div>
						</div>
					</li>
				</a>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
			<div style="background:white;width:100%;height:15px"></div>
		</div>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>