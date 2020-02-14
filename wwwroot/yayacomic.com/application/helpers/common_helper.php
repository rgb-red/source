<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*-----常用函数-----*/


//版本号
function VERSION(){
	$CI =& get_instance();
	$version = $CI->cache->redis->get("VERSION");
	if(!$version){
		$version = date("YmdHis", time());
		$CI->cache->redis->save("VERSION", $version, 86400 * 365);
	}

	return $version;
}

//站点基本信息
function SITE(){
	$CI =& get_instance();
	return $CI->config->item("info");
}

//获取访客ip
function getClientIp() {
	if( !empty($_SERVER["HTTP_CF_CONNECTING_IP"]) )
		$cip = $_SERVER["HTTP_CF_CONNECTING_IP"];
	elseif( !empty($_SERVER["HTTP_INCAP_CLIENT_IP"]) )
		$cip = $_SERVER["HTTP_INCAP_CLIENT_IP"];
	elseif( !empty($_SERVER["HTTP_CLIENT_IP"]) )
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	elseif( !empty($_SERVER["HTTP_X_FORWARDED_FOR"]) )
		$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	elseif( !empty($_SERVER["REMOTE_ADDR"]) )
		$cip = $_SERVER["REMOTE_ADDR"];
	else
		$cip = "";
	$cip = preg_replace('/[^\d|\.]/',"",$cip);
	return $cip;
}

//数据分组
function group($arr, $num){
	$r = "";

	if($arr){
		foreach($arr as $k => $v){
			$sort = ceil(($k + 1) / $num) - 1;
			$sort2 = ($k + 1) % $num;
			$sort2 = $sort2 ? $sort2 - 1 : $sort2 + $num - 1;
			$r[$sort][$sort2] = $v;
		}
	}

	return $r;
}

//返回时间当天开始的时间戳
function dayStartTime($unixtime){
	$time_str = date("Y-m-d", $unixtime);
	$time = $time_str . " 00:00:00";
	$unixtime = strtotime($time);

	return $unixtime;
}

//返回时间当天结束的时间戳
function dayEndTime($unixtime){
	$time_str = date("Y-m-d", $unixtime);
	$time = $time_str . " 23:59:59";
	$unixtime = strtotime($time);

	return $unixtime;
}

//输出从某天开始7天的星期列表
//传入时间戳
//type 0输出星期几 1输出今天明天
function weekList($time, $type = 0){
	$w = date("w", $time);

	for($i = 0; $i <= 6; $i ++){
		$week[$i] = $w - $i >= 0 ? $w - $i : 7 + $w - $i;
	}

	$week_arr = array(
		0 => "周日",
		1 => "周一",
		2 => "周二",
		3 => "周三",
		4 => "周四",
		5 => "周五",
		6 => "周六",
	);

	if($type == 0){
		foreach($week as $k => $v){
			$week[$k] = $week_arr[$v];
		}
	}else{
		$week[0] = "今天";
		$week[1] = "昨天";

		foreach($week as $k => $v){
			if($k > 1){
				$week[$k] = $week_arr[$v];
			}
		}
	}

	return $week;
}

//密码加密
function md5Pwd($pwd, $salt){
	$md5 = md5(md5($pwd) . "Gd3VMu9vw28aDlku" . md5($salt));

	return $md5;
}

//生成salt
function createSalt($num){
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";

	$length = strlen($str)-1;

	for($i = 0; $i <= $num - 1; $i ++){
		$start = rand(0,$length);
		$salt[$i]=substr($str, $start, 1);
	}

	$salt = implode("", $salt);
	 
	return $salt;
}

//锁定用户操作2秒（防止并发）
function isLock($uid, $time = 2){
	$CI =& get_instance();
	$userLock = $CI->cache->redis->get("userLock:uid_" . $uid);

	if($userLock == "LOCK"){
		return 500;
	}

	$CI->cache->redis->save("userLock:uid_" . $uid, "LOCK", $time);

	return false;
}

//提示错误信息，并返回上一个页面
function rBack($str){
	$r = "<script>";
	if($str){
		$r .= "alert('{$str}');";
	}

	$r .= "history.go(-1);";

	$r .= "</script>";

	echo $r;
	exit;
}

//提示信息，并跳转指定url
function rJump($str, $url, $do = ""){
	$r = "<script>";
	if($str){
		$r .= "alert('{$str}');";
	}

	if($do){
		$r .= $do;
	}else{
		$r .= "window.location.href='{$url}'";
	}

	$r .= "</script>";

	echo $r;
	exit;
}

//输出图片 原生方法 默认质量无损
function showImg($img, $quality = 100){
	$info = getimagesize($img);
	$imgExt = image_type_to_extension($info[2], false); //获取文件后缀
	$fun = "imagecreatefrom{$imgExt}"; //创建图片方法
	$imgInfo = $fun($img);	//1.由文件或 URL 创建一个新图象。
	$mime = image_type_to_mime_type(exif_imagetype($img)); //获取图片的 MIME 类型
	header('Content-Type:'.$mime); //设置头部信息最终返回的是图片

	//输出质量,JPEG格式(0-100),PNG格式(0-9)
	if($imgExt == 'png'){
		if($quality == 100){
			$quality = 90;
		}

		$quality = intval($quality / 10);
	}
	
	//输出并销毁图片内存占用
	$getImgInfo = "image{$imgExt}";
	$getImgInfo($imgInfo, null, $quality);
	imagedestroy($imgInfo); 
	exit;
}


//验证邮箱是否合法
function is_email($user_email){
	$pattern = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/";
	if (strpos($user_email, '@') !== false && strpos($user_email, '.') !== false){
		if (preg_match($pattern, $user_email)){
			return true;
		}
	}
	return false;
}


//验证手机是否合法
function is_mobile($mobile){
	return preg_match("/^(147|13[0-9]|15[0-9]|18[0-9]|17[0-9])\d{8}$/i", $mobile);
}

//验证码验证
function vcode($code, $cache_code, $token){
	if($code){
		$code = explode("_", $code)[1];
		$code = explode(",", $code);

		$verify = 0;

		foreach($code as $k => $v){
			if($v % 4 != $cache_code[$k]){
				$verify = 1;
			}
		}

		if($verify == 0){
			return true;
		}else{
			return false;
		}
	}
	
	return false;
}

//检测是否登录
function loginCheck(){
	if(isset($_SESSION["uid"])){
		return true;
	}

	return false;
}

//生成订单号
function createOrder(){
	$order = date("YmdHis", time());
	$order .= createSalt(12);
	$order = strtolower($order);

	return $order;
}

//检测销售状态
//0免费 1限时免费 2限时优惠 3收费
function sellStatus($free, $limit_free, $discount, $sell){
	//status 0免费 1限时免费 2限时优惠 3收费

	$status = 3; //收费时为3

	//免费时 status=0
	if($free == 0 || ($free == 1 && $sell == 0)){
		$status = 0;
	}

	//当非免费时
	if($status != 0){
		//当开启限时免费时 status=1
		if($limit_free == 1){
			$status = 1;
		}

		//既没有免费 也没有限时免费时
		if($status != 1){
			//当限时优惠为100时，打10折，不改变状态，即为收费 status=3

			//当限时优惠不为100时
			if($discount != 100){
				if($discount == 0){	//限时优惠为0时为打0折，即为限时免费 status=1
					$status = 1;
				}else{ //当限时优惠不为0时即为限时优惠 status=2
					$status = 2;
				}
			}
		}
	}

	return $status;
}

function payError($code){
	$msg = array(
		999 => "对不起，您提交的充值信息有误",
		998 => "对不起，您提交的充值信息有误",
		997 => "对不起，您提交的充值信息有误",
	);

	return $msg[$code];
}

function curl($url,$data){ // 模拟提交数据函数
    $curl = curl_init(); // 启动一个CURL会话

    curl_setopt($curl, CURLOPT_URL,$url);//抓取指定网页
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    curl_setopt($curl, CURLOPT_POST, 1);//post提交方式
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        echo 'Errno'.curl_error($curl);//捕抓异常
    }

    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据，json格式
}

function getAvatar($uid = "", $avatar = "0"){
	$mrtx = "/img/icon/mrtx.gif?" . VERSION();

	if($uid == ""){
		if(!isset($_SESSION["uid"])){
			return $mrtx;
		}else{
			if($_SESSION["avatar"] == 0){
				return $mrtx;
			}else{
				return "/uploads/avatar/" . $_SESSION["uid"] . ".jpg?" . $_SESSION["avatar"];
			}
		}
	}else{
		if($avatar == 0){
			return $mrtx;
		}else{
			return "/uploads/avatar/" . $uid . ".jpg?" . $avatar;
		}
	}
}

//福卡消费， 返回所有福卡余额 以及未抵消的额度、
function subFuka($fuka, $balance){
	
}