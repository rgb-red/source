<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>漫画大全 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="漫画大全,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="漫画大全,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/script.js?<?=VERSION()?>"></script>
		<script type="text/javascript">
			var pageindex = "1";
			var pagesize = "21";
			var usergroup = "0";
			var tagid = "0";
			var status = "0";
			var sort = "10";
			var pay = "-1";
			var areaid = "0";
			var iscopyright = "False";
			var host = "/";
		</script>
		<script type="text/javascript" src="/js/loadNewList.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/allList.js?<?=VERSION()?>"></script>
		<link rel="stylesheet" type="text/css" href="/css/allList.css?<?=VERSION()?>">
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"漫画大全"))?>
		<div class="manga-list-bar">
			<a class="manga-list-bar-item <?php if(!isset($_GET["type"]) || $this->input->get("type") == "hot"):?>active<?php endif;?>" href="javascript:;" data="hot">最热门</a>
			<a class="manga-list-bar-item <?php if($this->input->get("type")  == "new"):?>active<?php endif;?>" href="javascript:;" data="new">最近更新</a>
			<a class="manga-list-bar-right" id="manga-list-bar-right"><?php 
					if(!isset($_GET["status"]) || $this->input->get("status") == "all"){
						echo "全部";
					}
					else if($_GET["status"] == "over"){
						echo "已完结";
					}
					else{
						echo "连载中";
					}
			?></a>
			<div class="manga-list-bar-right-down" id="manga-list-bar-right-down" style="display:none;">
				<a class="manga-list-bar-right-down-item <?php if(!isset($_GET["status"]) || $this->input->get("status")  == "all"):?>active<?php endif;?>" href="javascript:;" val="all">全部</a>
				<a class="manga-list-bar-right-down-item <?php if($this->input->get("status") == "over"):?>active<?php endif;?>" href="javascript:;" val="over">已完结</a>
				<a class="manga-list-bar-right-down-item <?php if($this->input->get("status") == "serial"):?>active<?php endif;?>" href="javascript:;" val="serial">连载中</a>
			</div>
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
					</div>
					<p class="manga-list-2-title">
						<a href="/comic/detail/<?=$v["id"]?>"><?=$v["title"]?></a>
					</p>
					<p class="manga-list-2-tip">
						<a href="/comic/detail/<?=$v["id"]?>">最新 第<?=$v["chapter"]?>话</a>
					</p>
				</li>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
		</div>
		<a href="javascript:void(0);" onclick="$('html, body').animate({ scrollTop:0},500);">
			<img class="return-top" src="/img/icon/return-top.png">
		</a>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>