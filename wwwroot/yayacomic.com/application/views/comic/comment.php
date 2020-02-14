<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>评论 - <?=$comic["title"]?> - <?=SITE()["name"]?></title>
		<meta name="keywords" content="<?=$comic["title"]?>评论,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="<?=$comic["title"]?>评论,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" href="/css/account.css">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript">
			var CID = "<?=$comic["id"]?>";
			var PAGEINDEX = 1;
			var PAGEPCOUNT = 10;
			var POSTCOUNT = "<?=$comic["comment"]?>";
			
			var TIEBATOPICID = '1257851';
			var PAGETYPE = 9;
			var LOADINGIMAGE = '/img/icon/loading.gif';
			var LIMITPAGE = "<?=ceil($comic["comment"] / 10)?>";
			var CURRENTURL = "/comic/comment/<?=$comic["id"]?>";

			/*var DM5_COMIC_MID = 33991;
			var DM5_COMIC_MNAME = "山海逆战";
			var DM5_COMIC_URL = "/showcomment/?cid=518896";
			var DM5_USERID = 0;
			var COMIC_MID = 33991;
			
			
			
			var 
			
			var DM5_CID = 518896;
			
			var imageHomePath = 'http://css122us.cdndm5.com/v201905271815/dm5/images/moblie/';
			var DM5_CURRENTURL = "/showcomment/?cid=518896";*/
		</script>
		<script type="text/javascript" src="/js/comm.js"></script>
		<script type="text/javascript" src="/js/post.js"></script>
		<script type="text/javascript" src="/js/loadComment.js"></script>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"《" . $comic["title"] . "》评论"))?>
		<textarea class="comment-input" placeholder="我已经忍不住吐槽了～"></textarea>
		<a class="comment-btn win-comment-btn" href="javascript:void(0);">发表评论</a>
		<div class="toast" style="display:none;"></div>
		<ul class="detail-list-comment postlist" style="margin-top:18px"></ul>
		<div class="comment-noData nocomments" style="">
			<img class="comment-noData-img" src="/img/comment-noData.png">
		</div>
		<?php $this->load->view("layout/footerNobtn")?>
	</body>

</html>