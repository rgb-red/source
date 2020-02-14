<?php 
	$title = $comic["title"] . " - ";
	$title .= "第" . $comic["chapter"] . "话";
	if($comic["status"] == 0){
		$title .= "连载中";
	}else{
		$title .= "完结";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?=$title?> - <?=SITE()["name"]?></title>
		<meta name="keywords" content="<?=$comic["title"]?>漫画,<?=$comic["title"]?><?=$comic["chapter"]?><?=$comic["title"]?>在线漫画,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="<?=SITE()["name"]?>提供<?=$comic["title"]?><?=$comic["chapter"]?>在线漫画和第一时间更新。同时也提供<?=$comic["title"]?><?=$comic["chapter"]?>情报、图透等信息。<?=$comic["title"]?><?=$comic["chapter"]?>简介：<?=$comic["descript"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/account.css?<?=VERSION()?>" />
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/script.js?<?=VERSION()?>"></script>
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
		<style type="text/css">
			.detail-list-2{ min-height:400px;}
		</style>
		<script type="text/javascript" src="/js/comm.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/showcomic.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray" style="padding-top: 45px; zoom: 1;">
		<?php $this->load->view("layout/header", array("title"=>$comic["title"]))?>
		<div class="detail-main">
			<img class="detail-main-bg" src="/comics/cover/<?=$comic["id"]?>.jpg">
			<div class="detail-main-cover">
				<img src="/comics/cover/<?=$comic["id"]?>.jpg">
			</div>
			<div class="detail-main-info">
				<p class="detail-main-info-title"><?=$comic["title"]?></p>
				<p class="detail-main-info-star star-<?=$comic["star"]?>"></p>
				<p class="detail-main-info-author">
					作者：
					<?php if($comic["author"]):?>
					<?php $comic["author"] = substr($comic["author"],1, strlen($comic["author"]) - 2);?>
					<?php foreach(explode(",", $comic["author"]) as $k => $v):?>
					<a href="/home/search?author=<?=$v?>"><?=$authorList[$v]?></a>
					<?php endforeach;?>
					<?php else:?>
					<a href="javascript:;">佚名</a>
					<?php endif;?>
				</p>
				<p class="detail-main-info-class">
					<?php if($comic["tag"]):?>
					<?php $comic["tag"] = substr($comic["tag"],1, strlen($comic["tag"]) - 2);?>
					<?php foreach(explode(",", $comic["tag"]) as $k => $v):?>
					<span><a href="/home/search?tag=<?=$v?>"><?=$this->config->item("tag")[$v]?></a></span>
					<?php endforeach;?>
					<?php endif;?>
				</p>
			</div>
		</div>
		<p class="detail-desc" id="detail-desc" style="display:none;"><?=$comic["descript"]?></p>
		<p class="detail-desc" onclick="opendetaildesc(this);"><?=mb_substr($comic["descript"], 0 ,88)?>...<img class="desc-more" src="/img/icon/desc-more.png?<?=VERSION()?>"></p>
		<div id="tempc">
			<div class="detail-selector item-<?php if($outside_list){echo 3;}else{echo 2;}?>">
				<a class="detail-selector-item active" href="javascript:void(0);" onclick="titleSelect(this, 'detail-list-select', 'detail-list-select-1');">连载</a>
				<?php if($outside_list):?>
				<a class="detail-selector-item" href="javascript:void(0);" onclick="titleSelect(this, 'detail-list-select', 'detail-list-select-2');">番外</a>
				<?php endif;?>
				<a class="detail-selector-item" href="javascript:void(0);" onclick="titleCommentSelect(this);">评论
					<span class="detail-selector-item-count commentcount"><?=$comic["comment"] > 999 ? "999+" : $comic["comment"]?></span>
				</a>
			</div>
			<div class="detail-list-title">
				<span class="detail-list-title-1"><?php echo $comic["status"] == 0 ? "连载中" : "完结"?></span>
				<a href="javascript:;" class="detail-list-title-2">第<?=$comic["chapter"]?>话</a>
				<span class="detail-list-title-3"><?=date("m月d日", $comic["posttime"])?></span>
				<?php if($sort == "desc"):?>
				<a href="javascript:void(0);" onclick="sortBtnClick(this);" class="detail-list-title-right sort-2">倒序</a>
				<?php else:?>
				<a href="javascript:void(0);" onclick="sortBtnClick(this);" class="detail-list-title-right sort-1">正序</a>
				<?php endif;?>
			</div>
			<?php if($chapter_list):?>
			<?php if($comic["show"] == 1):?>
			<ul class="detail-list-2 detail-list-select" id="detail-list-select-1">
				<?php foreach($chapter_list as $k => $v):?>
				<li style="<?php if($k > 5):?>display:none<?php endif;?>">
					<a href="/comic/chapter/<?=$v["cid"]?>/0/<?=$v["id"]?>" class="chapteritem">
						<div class="detail-list-2-cover">
							<img class="detail-list-2-cover-img" src="/comics/chapterCover/<?=$comic["id"]?>_<?=$v["id"]?>.jpg?<?=VERSION()?>">
							<?php if(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) == 2):?>
							<!-- 限时优惠 -->
							<img class="detail-list-2-cover-logo" src="/img/icon/detail-list-logo-2.png?<?=VERSION()?>">
							<?php elseif(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) == 1):?>
							<!-- 限时免费 -->
							<img class="detail-list-2-cover-logo" src="/img/icon/detail-list-logo-3.png?<?=VERSION()?>">
							<?php endif;?>
						</div>
						<div class="detail-list-2-info">
							<p class="detail-list-2-info-title">第<?=$v["chapter"]?>话 <?=$v["title"]?></p>
							<p class="detail-list-2-info-subtitle"><?=date("Y-m-d", $v["posttime"])?></p>
							<?php if(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) != 0):?>
							<!-- 非免费 -->
							<img class="detail-list-2-info-right" src="/img/icon/detail-list-logo-right.png?<?=VERSION()?>">
							<?php endif;?>
						</div>
					</a>
				</li>
				<?php endforeach;?>
			</ul>
			<?php else:?>
			<ul class="detail-list-1 detail-list-select" id="detail-list-select-1">
				<?php foreach($chapter_list as $k => $v):?>
				<li style="<?php if($k >= 15):?>display:none<?php endif;?>">
					<a href="/comic/chapter/<?=$v["cid"]?>/0/<?=$v["id"]?>" title="<?=$comic["title"]?>" class="chapteritem">第<?=$v["chapter"]?>话</a>
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
			<?php endif;?>
			<?php if($outside_list):?>
			<?php if($comic["show"] == 1):?>
			<ul class="detail-list-2 detail-list-select" id="detail-list-select-2" style="padding-bottom: 0px; display: none;">
				<?php foreach($outside_list as $k => $v):?>
				<li style="<?php if($k > 5):?>display:none<?php endif;?>">
					<a href="/comic/chapter/<?=$v["cid"]?>/1/<?=$v["id"]?>" class="chapteritem">
						<div class="detail-list-2-cover">
							<img class="detail-list-2-cover-img" src="/comics/chapterCover/<?=$comic["id"]?>_<?=$v["id"]?>.jpg">
							<?php if(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) == 2):?>
							<!-- 限时优惠 -->
							<img class="detail-list-2-cover-logo" src="/img/icon/detail-list-logo-2.png?<?=VERSION()?>">
							<?php elseif(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) == 1):?>
							<!-- 限时免费 -->
							<img class="detail-list-2-cover-logo" src="/img/icon/detail-list-logo-3.png?<?=VERSION()?>">
							<?php endif;?>
						</div>
						<div class="detail-list-2-info">
							<p class="detail-list-2-info-title"><?=$v["title"]?></p>
							<p class="detail-list-2-info-subtitle"><?=date("Y-m-d", $v["posttime"])?></p>
							<?php if(sellStatus($v["free"], $v["limit_free"], $v["discount"], $v["sell"]) != 0):?>
							<!-- 非免费 -->
							<img class="detail-list-2-info-right" src="/img/icon/detail-list-logo-right.png?<?=VERSION()?>">
							<?php endif;?>
						</div>
					</a>
				</li>
				<?php endforeach;?>
			</ul>
			<?php else:?>
			<ul class="detail-list-1 detail-list-select" id="detail-list-select-2" style="display:none">
				<?php foreach($outside_list as $k => $v):?>
				<li style="<?php if($k >= 15):?>display:none<?php endif;?>">
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
			<?php endif;?>
			<a class="detail-list-more" href="javascript:void(0);">展开全部章节</a>
		</div>
		<ul class="detail-list-comment" style="display:none">
			<li style="text-align:center"><img class="comment-noData-img nocomments" src="/img/comment-noData.png?<?=VERSION()?>"></li>
		</ul>
		<div class="detail-comment-fix-bottom" style="display:none;">
			<a class="detail-comment-fix-bottom-a btncomment" href="javascript:void(0);">
				<img class="detail-comment-fix-bottom-logo" src="/img/icon/detail-comment-logo.png?<?=VERSION()?>">
				我已经忍不住要吐槽啦～
			</a>
		</div>
		<div class="detail-fix-bottom">
			<a href="javascript:void(0);" class="collection">
				<img class="detail-bottom-1" src="/img/icon/detail-bottom-<?php echo $marker ? "2" : "1"?>.png?<?=VERSION()?>">
			</a>
			<a href="javascript:showShareList();">
				<img class="detail-bottom-3" src="/img/icon/detail-bottom-3.png?<?=VERSION()?>">
			</a>
			<a href="/comic/chapter/<?=$comic["id"]?>/0/<?=$history_id?>" title="第<?=$history?>话" class="detail-bottom-btn"><?=$history == 1 ? "开始阅读" : "续看第" . $history . "话"?></a>
		</div>
		<div class="mask" style="<?php if($adult):?>display:none<?php endif;?>"></div>
		<div class="win-comment" style="display:none;">
			<a href="javascript:void(0);" class="closecomment"><img class="win-comment-cross" src="/img/icon/win-cross.png?<?=VERSION()?>"></a>
			<p class="win-comment-title">发表评论</p>
			<textarea class="win-comment-input comment-input" placeholder="我已经忍不住吐槽了～"></textarea>
			<a class="win-comment-btn" href="javascript:void(0);">发表评论</a></div>
		<div class="toast" style="display:none;"></div>
		<div class="win-pay2 wincheckAdult" style="<?php if($adult):?>display:none<?php endif;?>">
			<a href="/" class="closewincheckAdult"><img class="win-pay-cross" src="/img/icon/win-cross.png?<?=VERSION()?>"></a>
			<p class="win-pay-title2">该漫画为限制漫画</p>
			<p class="win-pay-content">有部份章节可能含有暴力、血腥、色情或不当的语言等内容，不适合未成年观众，为保护未成年人，我们将对漫画进行屏蔽</p>
			<p class="win-pay-warning">是否已年满18岁？</p>
			<div class="win-pay-btn-group2 pb20">
				<a class="win-pay-btn red closewincheckAdult" href="/">否</a>
				<a class="win-pay-btn red closewincheckAdult" href="javascript:void(0);" id="checkAdult">是</a>
			</div>
		</div>
		<?php $this->load->view("layout/footer")?>
		<div style="height:70px;"></div>
		<a href="javascript:void(0);" onclick="$('html, body').animate({ scrollTop:0},500);">
			<img class="return-top" src="/img/icon/return-top.png?<?=VERSION()?>">
		</a>
		<script type="text/javascript" src="/js/detail.js?<?=VERSION()?>"></script>
		<!-- 分享界面 -->
		<div class="shareForm" style="display:none;">
			<div class="shareList am-avg-sm-3 am-thumbnails">
				<a target="_blank" href="http://service.weibo.com/share/share.php?url=<?=base_url('comic/detail/' . $comic["id"])?>&pic=<?=base_url('comics/cover/' . $comic["id"] . ".jpg")?>">
					<img src="/img/icon/detail_share_1.png?<?=VERSION()?>" alt="微博" />
				</a>
				<a target="_blank" href="http://connect.qq.com/widget/shareqq/index.html?url=<?=base_url('comic/detail/' . $comic["id"])?>&pics=<?=base_url('comics/cover/' . $comic["id"] . ".jpg")?>">
					<img src="/img/icon/detail_share_3.png?<?=VERSION()?>" alt="QQ" />
				</a>
				<a target="_blank" href="http://www.douban.com/recommend/?url=<?=base_url('comic/detail/' . $comic["id"])?>">
					<img src="/img/icon/detail_share_4.png?<?=VERSION()?>" alt="豆瓣" />
				</a>
			</div>
			<a href="javascript:hideShareList();" class="cancel">取消</a>
		</div>
	</body>
</html>