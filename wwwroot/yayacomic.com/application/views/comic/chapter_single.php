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
			var VIPAD = "<?=$VIPAD?>";
			var DOTIP = "<?=$DOTIP?>";
			var VIPLEVEL = "<?=$vip?>";
			var MAXIMG = "<?=$maxImg?>";
		</script>
	</head>
	<body class="viewbody">
		<div hidden id="imglist">
			<?php foreach($images as $k => $v):?>
			<p>/source/image/<?=$cid . "/" . $id . "/" . $status . "/" . $k . "/" . md5($cid."a9".$id."b8".$status."c7".$k."d6")?>.jpg
			<?php endforeach;?></p>
		</div>
		<div style="position:relative;height:0;z-index:2147483647;">
			<div class="view-fix-top-bar" style="z-index:2147483647;">
				<a href="javascript:;" onclick="javascript:pushHistory('/comic/detail/<?=$cid?>')">
					<img class="view-fix-top-bar-back" src="/img/icon/view-back-logo.png?<?=VERSION()?>">
				</a>
				<p class="view-fix-top-bar-title">
					<?=$comic?> - 
					<?php if($status==0):?>
					第<?=$chapter?>话 - 
					<?php endif;?>
					<?=$title?> - 
					<label id="lbcurrentpage">1</label>/<label id="allImg"><?=$k + 1?></label>
				</p>
				<div class="view-fix-top-bar-right">
					<a href="javascript:void(0)" class="collection">
						<img class="view-fix-top-bar-right-logo" src="/img/icon/view-top-logo-1.png?<?=VERSION()?>">
					</a>
					<a href="/">
						<img class="view-fix-top-bar-right-logo" src="/img/icon/view-top-logo-2.png?<?=VERSION()?>">
					</a>
				</div>
			</div>
		</div>
		<div class="view-main-1 readForm" id="cp_img">
			<img src="/img/page_default_img.png?<?=VERSION()?>" class="lazy">
		</div>
		<div class="view-fix-bottom-bar">
			<a class="view-fix-bottom-bar-item" href="/comic/title/<?=$cid?>">
				<img class="view-fix-bottom-bar-logo" src="/img/icon/view-bottom-logo-1.png?<?=VERSION()?>">
				<p class="view-fix-bottom-bar-title">目录</p>
			</a>
			<a class="view-fix-bottom-bar-item" href="javascript:void(0);" onclick="jumpLong();">
				<img class="view-fix-bottom-bar-logo" src="/img/icon/view-bottom-logo-3.png">
				<p class="view-fix-bottom-bar-title">卷轴</p>
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
		<div class="mask" style="display:none;"></div>
		<div class="toast" style="display:none;"></div>
		<!--操作区域-->
		<div class="clickArea">
			<div id="clickAreaLeft"></div>
			<div id="clickAreaCenter"></div>
			<div id="clickAreaRight"></div>
		</div>
		<!--VIP广告 / 操作提示-->
		<div class="guide" style="display:none">
			<img id="guide_1" src="/img/guide-1.png?<?=VERSION()?>">
			<a href="/vip"></a>
			<img id="guide_2" style="display:none;" src="/img/guide-2.png?<?=VERSION()?>">
		</div>
		<!--非会员跳转卷轴提示-->
		<div class="win-pay2 winopenvip" style="display:none">
			<a href="javascript:void(0);" class="closeopenvip">
				<img class="win-pay-cross" src="/img/icon/win-cross.png?<?=VERSION()?>">
			</a>
			<p class="win-pay-content pb10">仅VIP会员可使用卷轴模式哦!</p>
			<div class="win-pay-btn-group2 pb20">
				<a class="win-pay-btn gary closeopenvip" href="javascript:void(0);">我知道了</a>
				<a class="win-pay-btn vip" href="/vip">开通VIP</a>
			</div>
		</div>
		<script src="/js/lazyloadimgSingle.js"></script>
	</body>
</html>