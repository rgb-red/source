<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>阅读历史 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="阅读历史,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="阅读历史,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/script.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/comm.js"></script>
		<script type="text/javascript" src="/js/loadNewHistory.js"></script>
		<script>USERID="<?=$_SESSION["uid"]?>"</script>
	</head>
	<body class="bg-gray" style="padding-top: 95px;">
		<?php $this->load->view("layout/header", array("title"=>"我的收藏"))?>
		<div class="selector-top" style="position: fixed;top: 46px;left: 0;width: 100%;z-index: 9;">
			<a class="selector-top-item" href="javascript:pushHistory('/user/bookmarker');">收藏</a>
			<a class="selector-top-item active" href="javascript:pushHistory('/user/bookhistory');">历史</a>
			<a href="javascript:editReadhistory();" id="btnedit">
				<img class="selector-top-right-logo" src="/img/icon/selector-top-right.png?<?=VERSION()?>">
			</a>
			<a class="selector-top-right-font" href="javascript:editReadhistoryClose();" style="display:none;" id="btneditclose">完成编辑</a>
		</div>
		<?php if($list):?>
		<?php foreach($list as $k => $v):?>
		<div class="buy-manga" id="buy-manga41679">
			<div class="buy-manga-cover">
				<a href="/comic/detail/<?=$v["id"]?>">
					<img src="/comics/cover/<?=$v["id"]?>.jpg">
				</a>
				<a class="buy-manga-cover-hover" href="javascript:void(0);" mid="<?=$v["id"]?>" style="display:none;"></a>
			</div>
			<div class="buy-manga-info">
				<a href="/comic/detail/<?=$v["id"]?>" class="readlink" mid="<?=$v["id"]?>">
					<p class="buy-manga-title"><?=$v["title"]?></p>
				</a>
				<p class="buy-manga-author">
					作者：
					<?php if($v["author"]):?>
					<?php foreach(explode(",", substr($v["author"], 1, strlen($v["author"]) - 2)) as $kk => $vv):?>
					<a href="/home/search?author=<?=$vv?>" style="color: #666666;" mid="<?=$vv?>" class="readlink"><?=$authorList[$vv]?></a>
					<?php endforeach;?>
					<?php else:?>
					<a href="javascript:;" style="color: #666666;" mid="" class="readlink">佚名</a>
					<?php endif;?>
				</p>
				<a href="/comic/detail/<?=$v["id"]?>" class="readlink" mid="<?=$v["chapter"]?>">
					<p class="buy-manga-new">更新至第<?=$v["chapter"]?>回</p>
				</a>
				<a class="buy-manga-right-a readlink" mid="<?=$v["history"]?>" href="/comic/chapter/<?=$v["id"]?>/0/<?=$v["history_id"]?>">
					<img class="buy-manga-right-img" src="/img/icon/buy-manga-right.png?<?=VERSION()?>">
					<p class="buy-manga-right-title">续看</p>
				</a>
			</div>
		</div>
		<?php endforeach;?>
		<?php endif;?>
		<a href="javascript:$('.win-pay2').show();$('.mask').show();" class="center-main-bottom-btn l50" style="display:none;">清空</a>
		<a href="javascript:deleteReadhistory();" class="center-main-bottom-btn r50" style="display:none;">删除</a>
		<div class="mask" style="display: none;"></div>
		<div class="win-pay2" style="display: none;">
			<a href="javascript:$('.mask,.win-pay2').hide();">
				<img class="win-pay-cross" src="/img/icon/win-cross.png"></a>
			<p class="win-pay-content pb10">是否清空清空阅读历史?</p>
			<div class="win-pay-btn-group2 pb20">
				<a class="win-pay-btn gary" href="javascript:$('.mask,.win-pay2').hide();">再想想</a>
				<a class="win-pay-btn red" href="javascript:clearReadhistory();">确认清空</a></div>
		</div>
		<div class="toast" style="display:none;"></div>
		<div style="height:20px"></div>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>