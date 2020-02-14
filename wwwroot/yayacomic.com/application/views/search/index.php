<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>全站搜索 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="漫画搜索,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="漫画搜索,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<!--引入脚本文件-->
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/script.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<div class="search-top">
			<a href="javascript:history.back();">
				<img class="search-top-back" src="/img/icon/search-top-back.png?<?=VERSION()?>">
			</a>
			<div class="search-top-input">
				<input type="text" id="searchtxt" placeholder="请输入漫画名或作者名">
			</div>
			<?php if($search_history != array()):?>
			<div class="search-downlist" style="display: none;">
				<p class="search-downlist-title">历史搜索</p>
				<?php foreach($search_history as $k => $v):?>
				<a class="search-downlist-item">
					<span class="search-downlist-item-title"><?=$v?></span>
					<img class="search-downlist-item-cross" src="/img/icon/search-downlist-item-cross.png?<?=VERSION()?>">
				</a>
				<?php endforeach;?>
				<a class="search-downlist-clear" href="javascript:historyClear();">清除全部历史记录</a>
			</div>
			<?php endif;?>
			<a href="javascript:void(0);" onclick="doSearch(false);" class="search-top-right">搜索</a>
		</div>
		<p class="search-title">热门搜索</p>
		<div class="search-label">
			<?php foreach($this->config->item("search_hot") as $k => $v):?>
			<a class="search-label-item" href="<?=$v["url"]?>"><?=$v["title"]?></a>
			<?php endforeach;?>
		</div>
		<p class="search-title">热门分类</p>
		<ul class="search-class-2">
			<li>
				<a href="/home/allList">
					<img class="search-class-img" src="/img/search/search-class-1.png?<?=VERSION()?>">
				</a>
			</li>
			<li>
				<a href="/home/search?tag=0">
					<img class="search-class-img" src="/img/search/search-class-2.png?<?=VERSION()?>">
				</a>
			</li>
			<li>
				<a href="/home/search?tag=1">
					<img class="search-class-img" src="/img/search/search-class-3.png?<?=VERSION()?>">
				</a>
			</li>
			<li>
				<a href="/home/allList?type=hot&status=over">
					<img class="search-class-img" src="/img/search/search-class-4.png?<?=VERSION()?>">
				</a>
			</li>
		</ul>
		<ul class="search-class">
			<?php foreach($this->config->item("tag") as $k => $v):?>
			<li>
				<a href="/home/search?tag=<?=$k?>">
					<img class="search-class-img" src="/img/search/search-<?=$k?>.jpg?<?=VERSION()?>">
					<p class="search-class-title"><?=$v?></p>
				</a>
			</li>
			<?php endforeach;?>
		</ul>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>