<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?=$subject["title"]?> - 精选专题 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="精选专题,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="精选专题,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/account.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js"></script>
		<script type="text/javascript" src="/js/script.js"></script>
		<script type="text/javascript" src="/js/comm.js"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"精选专题"))?>
		<div class="book-banner">
			<img class="book-banner-img" src="/comics/subject/<?=$subject["id"]?>.jpg">
		</div>
		<p class="book-desc"><?=$subject["descript"]?></p>
		<ul class="book-list">
			<?php if($book):?>
			<?php foreach($book as $k => $v):?>
			<li>
				<div class="book-list-cover">
					<a href="/comic/detail/<?=$v["id"]?>">
						<img class="book-list-cover-img" src="/comics/cover/<?=$v["id"]?>.jpg">
					</a>
				</div>
				<div class="book-list-info">
					<a href="/comic/detail/<?=$v["id"]?>" title="<?=$v["title"]?>">
						<p class="book-list-info-title"><?=$v["title"]?></p>
						<p class="book-list-info-desc"><?=$v["descript"]?></p>
					</a>
					<p class="book-list-info-bottom">
						<?php foreach(explode(",", substr($v["tag"], 1, strlen($v["tag"]) - 2)) as $kk => $vv):?>
						<a class="book-list-info-bottom-item" href="/home/search?tag=<?=$vv?>" style="color:#666;"><?=$this->config->item("tag")[$vv]?></a>
						<?php endforeach;?>
						<a class="book-list-info-bottom-right btn_collection cid_<?=$v["id"]?> <?php if(isset($marker[(string)$v["id"]])):?>active<?php endif;?>" onclick="SetBookmarker('<?=$v["id"]?>');"><?php if(isset($marker[(string)$v["id"]])):?>已<?php endif;?>收藏</a>
					</p>
				</div>
			</li>
			<?php endforeach;?>
			<?php endif;?>
		</ul>
		<div class="toast" style="display:none;"></div>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>