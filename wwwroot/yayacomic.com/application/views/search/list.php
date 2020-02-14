<?php
	if(isset($_GET["tag"])){
		$type = "标签";
	}
	else if(isset($_GET["author"])){
		$type = "作者";
	}
	else{
		$type = "关键字";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?=$title?> - <?=$type?> - <?=SITE()["name"]?></title>
		<meta name="keywords" content="全站搜索,<?=$title?>,<?=$type?>,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="全站搜索,<?=$type?>,<?=$title?>,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/script.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/loadSearch.js"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>$type."：".$title))?>
		<?php if($list):?>
		<ul class="book-list">
			<?php foreach($list as $k => $v):?>
			<li>
				<div class="book-list-cover">
					<a href="/comic/detail/<?=$v["id"]?>" title="<?=$v["title"]?>">
						<img class="book-list-cover-img" src="/comics/cover/<?=$v["id"]?>.jpg?<?=VERSION()?>" alt="<?=$v["title"]?>">
					</a>
				</div>
				<div class="book-list-info">
					<a href="/comic/detail/<?=$v["id"]?>">
						<p class="book-list-info-title"><?=$v["title"]?></p>
						<p class="book-list-info-desc"><?=$v["descript"]?></p>
					</a>
					<p class="book-list-info-bottom">
						<?php if($v["tag"]):?>
						<?php $v["tag"] = substr($v["tag"],1, strlen($v["tag"]) - 2);?>
						<?php foreach(explode(",", $v["tag"]) as $kk => $vv):?>
						<a href="/home/search?tag=<?=$vv?>" style="color:#666;">
							<span class="book-list-info-bottom-item"><?=$this->config->item("tag")[$vv]?></span>
						</a>
						<?php endforeach;?>
						<?php endif?>
						<span class='book-list-info-bottom-right-font <?php if($v["status"] == 1):?>active<?php endif;?>'><?=$v["status"] == 0 ? "连载中" : "已完结"?></span>
					</p>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
		<?php else:?>
		<div class="search-noData">
			<img class="search-noData-img" src="/img/search/search-noData.png?<?=VERSION()?>">
			<p class="search-noData-title">没有找到你搜索的作品 ∑(っ °Д °;)っ<br>先看看其他作品吧！</p>
		</div>
		<p class="search-title">大家都在搜</p>
		<div class="search-label">
			<?php foreach($this->config->item("search_hot2") as $k => $v):?>
			<a class="search-label-item" href="<?=$v["url"]?>"><?=$v["title"]?></a>
			<?php endforeach;?>
		</div>
		<?php endif;?>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>