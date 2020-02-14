<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config["info"]["name"] = "丫丫漫画";
$config["info"]["slogan"] = "为漫画而生";
$config["info"]["author"] = "Hsc qq 390798960";
$config["info"]["description"] = "{$config["info"]["name"]} - {$config["info"]["slogan"]} - 在线漫画开源漫画漫画源码全彩漫画长条漫画原厂漫画日本漫画港台漫画韩国漫画欧美漫画 - 海贼王死神一拳超人火影忍者妖精的尾巴";
$config["info"]["keywords"] = "{$config["info"]["name"]},开源漫画,漫画源码,漫画,在线漫画,漫画大全,长条漫画,全彩漫画,韩国漫画,日本漫画,国产漫画";
$config["info"]["url"] = "/";


$config["search_hot"] = array(
	array("title" => "火影忍者", "url" => "/comic/detail/21"),
	array("title" => "海贼王", "url" => "/comic/detail/16"),
	array("title" => "妖精的尾巴", "url" => "/comic/detail/17"),
	array("title" => "名侦探柯南", "url" => "/comic/detail/22"),
	array("title" => "一拳超人", "url" => "/comic/detail/20"),
	array("title" => "妖神记", "url" => "/comic/detail/25"),
);

$config["search_hot2"] = array(
	array("title" => "火影忍者", "url" => "/comic/detail/21"),
	array("title" => "海贼王", "url" => "/comic/detail/16"),
	array("title" => "妖精的尾巴", "url" => "/comic/detail/17"),
	array("title" => "名侦探柯南", "url" => "/comic/detail/22"),
	array("title" => "一拳超人", "url" => "/comic/detail/20"),
	array("title" => "妖神记", "url" => "/comic/detail/25"),
	array("title" => "鬼灭之刃", "url" => "/comic/detail/24"),
);

/* 可新增和修改，不得删除和改顺序 */
$config["tag"] = array(
	0 => "韩漫",
	1 => "日漫",
	2 => "中漫",
	3 => "不可描述",
	4 => "热血",
	5 => "恋爱",
	6 => "校园",
	7 => "百合",
	8 => "彩虹",
	9 => "伪娘",
	10 => "冒险",
	11 => "职场",
	12 => "后宫",
	13 => "治愈",
	14 => "科幻",
	15 => "轻小说",
	16 => "励志",
	17 => "生活",
	18 => "战争",
	19 => "悬疑",
	20 => "推理",
	21 => "搞笑",
	22 => "奇幻",
	23 => "魔法",
	24 => "恐怖",
	25 => "神鬼",
	26 => "萌系",
	27 => "历史",
	28 => "美食",
	29 => "同人",
	30 => "运动",
	31 => "机甲",
);

//系统真实路径
$config["imgPath"] = "/www/wwwroot/yayacomic/webroot";
$config["getImgPath"] = "/www/wwwroot/yayacomic/webroot";