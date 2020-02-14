<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>每日更新 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="每日更新,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="每日更新,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
		<script type="text/javascript" src="/js/lib/jquery.cookie.js"></script>
		<script type="text/javascript" src="/js/lib/amazeui.min.js"></script>
		<script type="text/javascript" src="/js/script.js"></script>
	</head>
	<body class="bg-gray" style="padding-top: 87px;">
		<?php $this->load->view("layout/header", array("title"=>"每日更新"))?>
		<div class="selector-update-top">
			<?php foreach($weekList as $k => $v):?>
			<a class="selector-update-top-item <?php if($k==0):?>active<?php endif;?>" href="javascript:void(0);" data-index="<?=$k?>"><?=$v?></a>
			<?php endforeach;?>
		</div>
		<div class="manga-list" style="border:none;background-color:#f8f8f8;">
			<ul id="updatedb0" class="manga-list-2">
				<?php foreach($list as $k => $v):?>
				<li>
					<div class="manga-list-2-cover">
						<a href="/comic/detail/<?=$v["id"]?>">
							<img class="manga-list-2-cover-img" src="/comics/cover/<?=$v["id"]?>.jpg?<?=VERSION()?>">
						</a>
					</div>
					<p class="manga-list-2-title">
						<a href="/comic/detail/<?=$v["id"]?>"><?=$v["title"]?></a></p>
					<p class="manga-list-2-tip">
						<a href="/comic/detail/<?=$v["id"]?>"><?php echo $v["status"] == 1 ? "完结" : "最新"?> 第<?=$v["chapter"]?>话</a>
					</p>
				</li>
				<?php endforeach;?>
			</ul>
		</div>
		<?php $this->load->view("layout/footer")?>
		<script type="text/javascript" src="/js/update.js?<?=VERSION()?>"></script>
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
	</body>
</html>