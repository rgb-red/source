<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?=$comic?> - <?php if($status==0):?>第<?=$chapter?>话 - <?php endif;?><?=$title?> - <?=SITE()["name"]?></title>
		<meta name="Keywords" content="<?=$comic?>漫画,<?=$comic?>第<?=$chapter?>话,<?=$comic?>在线漫画,<?=SITE()["name"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="<?=$comic?>漫画简介：<?=$descript?> - <?=SITE()["name"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery-1.9.0.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/script.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/comm.js?<?=VERSION()?>"></script>
		<script type="text/javascript">
			var USERID = "<?=isset($_SESSION["uid"]) ? $_SESSION["uid"] : 0?>";
			var COMIC_MID = "<?=$cid?>";
		</script>
	</head>
	<body class="">
		<div class="view-main-1 readForm" id="cp_img">
			<?php if($last):?>
			<a class="chapter-btn" href="/comic/chapter/<?=$cid . "/" . $status . "/" . $last?>">点击进入上一章</a>
			<?php else:?>
			<a class="chapter-btn" href="javascript:;">没有上一章了</a>
			<?php endif;?>
			<?php foreach($images as $k => $v):?>
			<img src="/img/page_default_img.png?<?=VERSION()?>" class="lazy" data-src="/source/image/<?=$cid . "/" . $id . "/" . $status . "/" . $k . "/" . md5($cid."a9".$id."b8".$status."c7".$k."d6")?>.jpg">
			<?php endforeach;?>
			<?php if($next):?>
			<a class="chapter-btn" href="/comic/chapter/<?=$cid . "/" . $status . "/" . $next?>">点击进入下一章</a>
			<?php else:?>
			<a class="chapter-btn" href="javascript:;">没有下一章了</a>
			<?php endif;?>
		</div>
		<div class="view-fix-top-bar">
			<a href="javascript:;" onclick="javascript:pushHistory('/comic/detail/<?=$cid?>')">
				<img class="view-fix-top-bar-back" src="/img/icon/view-back-logo.png?<?=VERSION()?>">
			</a>
			<p class="view-fix-top-bar-title">
				<?=$comic?> - 
				<?php if($status==0):?>
				第<?=$chapter?>话 - 
				<?php endif;?>
				<?=$title?> - 
				<label id="lbcurrentpage">0</label>/<label id="allImg"><?=$k + 1?></label>
			</p>
			<div class="view-fix-top-bar-right">
				<a href="javascript:void(0);" class="collection">
					<img class="view-fix-top-bar-right-logo" src="/img/icon/view-top-logo-1.png?<?=VERSION()?>">
				</a>
				<a href="/">
					<img class="view-fix-top-bar-right-logo" src="/img/icon/view-top-logo-2.png?<?=VERSION()?>">
				</a>
			</div>
		</div>
		<div class="view-fix-bottom-bar">
			<a class="view-fix-bottom-bar-item" href="/comic/title/<?=$cid?>">
				<img class="view-fix-bottom-bar-logo" src="/img/icon/view-bottom-logo-1.png?<?=VERSION()?>">
				<p class="view-fix-bottom-bar-title">目录</p>
			</a>
			<a class="view-fix-bottom-bar-item jump-single" href="javascript:void(0);">
				<img class="view-fix-bottom-bar-logo" src="/img/icon/view-bottom-logo-3.png?<?=VERSION()?>">
				<p class="view-fix-bottom-bar-title">单页</p>
			</a>
			<a class="view-fix-bottom-bar-item" href="/comic/comment/<?=$cid?>">
				<img class="view-fix-bottom-bar-logo" src="/img/icon/view-bottom-logo-4.png?<?=VERSION()?>">
				<p class="view-fix-bottom-bar-title">评论</p>
			</a>
			<?php if($last):?>
			<a class="view-fix-bottom-bar-item" href="/comic/chapter/<?=$cid . "/" . $status . "/" . $last?>">
				<img class="view-fix-bottom-bar-logo" src="/img/icon/view-bottom-logo-5.png?<?=VERSION()?>">
				<p class="view-fix-bottom-bar-title">上一章</p>
			</a>
			<?php else:?>
			<a class="view-fix-bottom-bar-item" href="javascript:;" onclick="ShowDialog('没有上一章了');">
				<img class="view-fix-bottom-bar-logo" src="/img/icon/view-bottom-logo-5-no.png?<?=VERSION()?>">
				<p class="view-fix-bottom-bar-title">上一章</p>
			</a>
			<?php endif;?>
			<?php if($next):?>
			<a class="view-fix-bottom-bar-item" href="/comic/chapter/<?=$cid . "/" . $status . "/" . $next?>">
				<img class="view-fix-bottom-bar-logo" src="/img/icon/view-bottom-logo-6.png?<?=VERSION()?>">
				<p class="view-fix-bottom-bar-title">下一章</p>
			</a>
			<?php else:?>
			<a class="view-fix-bottom-bar-item" href="javascript:;" onclick="ShowDialog('没有下一章了');">
				<img class="view-fix-bottom-bar-logo" src="/img/icon/view-bottom-logo-6-no.png?<?=VERSION()?>">
				<p class="view-fix-bottom-bar-title">下一章</p>
			</a>
			<?php endif;?>
		</div>
		<div class="toast" style="display:none;"></div>
		<script src="/js/lazyloadimg.js"></script>		
	</body>
</html>