<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>精选专题 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="精选专题,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="精选专题,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"精选专题"))?>
		<div class="manga-list" style="border:none;background-color:#f8f8f8;">
			<ul class="manga-list-1">
				<?php if($subject):?>
				<?php foreach($subject as $k => $v):?>
				<li>
					<a href="/home/subject/<?=$v["id"]?>" title="<?=$v["title"]?>">
						<div class="manga-list-1-cover">
							<img class="manga-list-1-cover-img" src="/comics/subject/<?=$v["id"]?>_small.jpg"></div>
						<p class="manga-list-1-title"><?=$v["title"]?></p>
						<p class="manga-list-1-tip"><?=$v["brief"]?></p>
					</a>
				</li>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
		</div>
		<?php $this->load->view("layout/footer")?>
	</body>
</html>