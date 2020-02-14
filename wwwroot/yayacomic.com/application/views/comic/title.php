<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>目录 - <?=$comic["title"]?> - 漫画目录列表 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="<?=$comic["title"]?>漫画目录列表,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="<?=$comic["title"]?>漫画目录列表,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<script type="text/javascript" src="/js/lib/jquery.min.js"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js"></script>
		<script type="text/javascript" src="/js/script.js"></script>
		<script type="text/javascript">
			var COMIC_MID = "<?=$comic["id"]?>";
			var CURRENTURL = "/comic/detail/<?=$comic["id"]?>";
			var USERID = "<?=isset($_SESSION["uid"]) ? $_SESSION["uid"] : 0?>";
			var PAGETYPE = 4;
			var PAGEINDEX = 1;
			var PAGEPCOUNT = 10;
			var POSTCOUNT = "<?=$comic["comment"]?>";
			var LOADINGIMAGE = '/img/icon/loading.gif';
			var SHOWCHAPTERIMAGE = "True";
		</script>
		<script type="text/javascript" src="/js/comm.js"></script>
		<script type="text/javascript" src="/js/showcomic.js"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>$comic["title"]))?>
		<div class="selector-top">
			<a class="selector-top-item detail-selector-item active" href="javascript:void(0);" onclick="titleSelect(this, 'detail-list-select', 'detail-list-select-1');">连载</a>
			<?php if($outside_list):?>
			<a class="selector-top-item detail-selector-item " href="javascript:void(0);" onclick="titleSelect(this, 'detail-list-select', 'detail-list-select-3');">番外</a></div>
			<?php endif;?>
		<div class="detail-list-title">
			<span class="detail-list-title-1"><?php echo $comic["status"] == 0 ? "连载中" : "完结"?></span>
			<a href="/m825295/" class="detail-list-title-2">第<?=$comic["chapter"]?>话</a>
			<span class="detail-list-title-3"><?=date("m月d日", $comic["posttime"])?></span>
			<?php if($sort == "desc"):?>
			<a href="javascript:void(0);" onclick="sortBtnClick2(this);" class="detail-list-title-right sort-2">倒序</a>
			<?php else:?>
			<a href="javascript:void(0);" onclick="sortBtnClick2(this);" class="detail-list-title-right sort-1">正序</a>
			<?php endif;?>
		</div>
		<ul class="detail-list-1 detail-list-select" id="detail-list-select-1">
			<?php foreach($chapter_list as $k => $v):?>
			<li style="">
				<a href="/comic/chapter/<?=$v["cid"]?>/0/<?=$v["id"]?>" title="<?=$comic["title"]?>">第<?=$v["chapter"]?>话</a>
				<!-- 非免费 -->
				<?php if(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) != 0):?>
				<img class="detail-list-lock" src="/img/icon/detail-list-logo-right.png?<?=VERSION()?>">
				<?php endif;?>
				<?php if(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) == 2):?>
				<!-- 限时优惠 -->
				<img class="detail-list-2-cover-logo" src="/img/icon/detail-list-logo-2-small.png?<?=VERSION()?>">
				<?php elseif(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) == 1):?>
				<!-- 限时免费 -->
				<img class="detail-list-2-cover-logo" src="/img/icon/detail-list-logo-3-small.png?<?=VERSION()?>">
				<?php endif;?>
			</li>
			<?php endforeach;?>
		</ul>
		<?php if($outside_list):?>
		<ul class="detail-list-1 detail-list-select" id="detail-list-select-3" style="display:none;">
			<?php foreach($outside_list as $k => $v):?>
			<li style="">
				<a href="/comic/chapter/<?=$v["cid"]?>/1/<?=$v["id"]?>" title="<?=$comic["title"]?>" class="chapteritem"><?=$v["title"]?></a>
				<!-- 非免费 -->
				<?php if(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) != 0):?>
				<img class="detail-list-lock" src="/img/icon/detail-list-logo-right.png?<?=VERSION()?>">
				<?php endif;?>
				<?php if(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) == 2):?>
				<!-- 限时优惠 -->
				<img class="detail-list-2-cover-logo" src="/img/icon/detail-list-logo-2-small.png?<?=VERSION()?>">
				<?php elseif(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) == 1):?>
				<!-- 限时免费 -->
				<img class="detail-list-2-cover-logo" src="/img/icon/detail-list-logo-3-small.png?<?=VERSION()?>">
				<?php endif;?>
			</li>
			<?php endforeach;?>
		</ul>
		<?php endif;?>
		<a href="javascript:void(0);" onclick="$('html, body').animate({ scrollTop:0},500);">
			<img class="return-top" src="/img/icon/return-top.png?<?=VERSION()?>">
		</a>
		<script type="text/javascript">
			$(window).scroll(function() {
				var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
				if (scrollTop > 300) {
					$(".return-top").fadeIn();
				} else {
					$(".return-top").fadeOut();
				}
			});
		</script>
		<?php $this->load->view("layout/footerNoBtn")?>
	</body>
</html>