<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>我的收藏 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="我的收藏,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="我的收藏,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/script.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/comm.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/loadNewBookmarker.js?<?=VERSION()?>"></script>
		<script>USERID="<?=$_SESSION["uid"]?>"</script>
	</head>
	<body class="bg-gray" style="padding-top: 95px;">
		<?php $this->load->view("layout/header", array("title"=>"我的收藏"))?>
		<div class="selector-top" style="position: fixed;top: 46px;left: 0;width: 100%;z-index: 9;">
			<a class="selector-top-item active" href="javascript:pushHistory('/user/bookmarker');">收藏</a>
			<a class="selector-top-item" href="javascript:pushHistory('/user/bookhistory');">历史</a>
			<a href="javascript:editBookmarker();" id="btnedit">
				<img class="selector-top-right-logo" src="/img/icon/selector-top-right.png?<?=VERSION()?>">
			</a>
			<a class="selector-top-right-font" style="display:none;" href="javascript:editBookmarkerClose();" id="btneditclose">完成编辑</a>
		</div>
		<div class="manga-list" style="border:none;background-color:#f8f8f8;">
			<ul class="manga-list-2">
				<?php if($list):?>
				<?php foreach($list as $k => $v):?>
				<li>
					<div class="manga-list-2-cover">
						<a href="/comic/detail/<?=$v["id"]?>">
							<img class="manga-list-2-cover-img" src="/comics/cover/<?=$v["id"]?>.jpg">
						</a>
						<span class="manga-list-2-cover-hover" style="display:none;" mid="<?=$v["id"]?>"></span>
					</div>
					<p class="manga-list-2-title">
						<a href="/comic/detail/<?=$v["id"]?>"><?=$v["title"]?></a></p>
					<p class="manga-list-2-tip">
						<a style="display: unset;"><?=$v["history"] ? "第".$v["history"]."回" : "未读"?>/</a>
						<a href="/comic/detail/<?=$v["id"]?>" style="display: unset;">第<?=$v["chapter"]?>回</a>
					</p>
				</li>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
		</div>
		<a href="javascript:deleteBookmarker();" class="center-main-bottom-btn m100" style="display:none;">删除</a>
		<div style="height:20px"></div>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>