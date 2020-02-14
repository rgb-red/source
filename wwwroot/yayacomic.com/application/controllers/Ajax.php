<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

	//获取文章评论数据
	public function getComment(){
		//获取参数
		$page = $this->input->get("pageindex");
		$size = $this->input->get("pagesize");
		$cid = $this->input->get("mid");

		//获取评论
		$post = $this->cache->redis->get_list("comment:cid_" . $cid, "page_" . $page);
		$post = json_decode($post, true);

		if(!$post){
			$start = ($page - 1) * $size;
			$sql = "SELECT A.id,A.uid,B.username,B.avatar,A.content,A.praise,A.posttime FROM comment A LEFT JOIN user B ON A.uid=B.id WHERE A.cid={$cid} ORDER BY posttime DESC LIMIT {$start},{$size}";
			$post = $this->db->query($sql)->result_array();

			$this->cache->redis->save_list("comment:cid_" . $cid, "page_" . $page, json_encode($post));
		}

		//获取当前用户在上方评论中的点赞
		$comment = array();

		if($post){
			$uid = isset($_SESSION["uid"]) ? $_SESSION["uid"] : 0;
			$comment_id = implode(",", array_column($post, "id"));
			$sql = "SELECT comment_id FROM `like` WHERE uid={$uid} AND comment_id in ({$comment_id})";
			$praise = $this->db->query($sql)->result_array();
			$praise = array_column($praise, "comment_id");
			$praiseCount = array_count_values($praise);

			foreach($post as $k => $v){
				$comment[$k] = array(
					"Id" => $v["id"],
					"Poster" => $v["username"],
					"HeadUrl" => getAvatar($v["uid"], $v["avatar"]),
					"PostContent" => $v["content"],
					"PostTime" => date("Y-m-d H:i:s", $v["posttime"]),
					"PraiseCount" => $v["praise"],
				);

				if(isset($_SESSION["uid"])){
					$comment[$k]["IsPraise"] = isset($praiseCount[$v["id"]]) ? true : false;
				}else{
					$comment[$k]["IsPraise"] = false;
				}
			}
		}
		
		echo json_encode($comment);
	}

	//点赞和取消点赞 praise 0取消点赞 1点赞
	public function praise_post(){
		$praise = $this->input->get("praise");
		$comment_id = $this->input->get("pid");
		$uid = isset($_SESSION["uid"]) ? $_SESSION["uid"] : 0;

		//检测是否登录
		if($uid == 0){
			$data["msg"] = "nologin";
			echo json_encode($data);
			exit;
		}

		//用户操作锁，防止频繁操作
		$isLock = isLock($uid, 2);
		if($isLock){
			echo $isLock;
			exit;
		}

		if($praise == 0){
			$sql = "DELETE FROM `like` WHERE comment_id={$comment_id} AND uid={$uid}";
			$r = $this->db->query($sql);
			$sql = "UPDATE comment SET praise=praise-1 WHERE id={$comment_id}";
			$this->db->query($sql);
			if(!$r){
				exit;
			}
		}else{
			$posttime = time();
			$sql = "INSERT INTO `like` (uid,comment_id,posttime) VALUES ({$uid},{$comment_id},$posttime)";
			$r = $this->db->query($sql);
			$sql = "UPDATE comment SET praise=praise+1 WHERE id={$comment_id}";
			$this->db->query($sql);
			if(!$r){
				exit;
			}
		}

		$data["msg"] = "success";
		echo json_encode($data);
	}

	//评论操作
	public function comment_post(){
		$cid = $this->input->post("cid");
		$message = $this->input->post("message");
		$uid = isset($_SESSION["uid"]) ? $_SESSION["uid"] : false;

		//检测是否登录
		if(!$uid){
			$data["msg"] = "nologin";
			echo json_encode($data);
			exit;
		}

		//用户操作锁，防止频繁操作
		$isLock = isLock($uid, 5);
		if($isLock){
			echo $isLock;
			exit;
		}

		//文字不能少于5个
		if(mb_strlen($message) < 5){
			$data["msg"] = "lengthLess5";
			echo json_encode($data);
			exit;
		}

		$ip = getClientIp();
		$posttime = time();

		$sql = "INSERT INTO comment (uid,cid,content,praise,posttime,ip) VALUES ({$uid},{$cid},'{$message}',0,{$posttime},'{$ip}')";
		$r = $this->db->query($sql);

		if($r){
			$data["msg"] = "success";
		}else{
			exit;
		}

		$this->common->riseComicItem($cid,"comment","+");
		$this->cache->redis->delete("comment:cid_" . $cid);
		$this->cache->redis->delete("comic:cid_" . $cid);

		echo json_encode($data);
	}

	//批量旋转图片方法(未调用方法)，生成验证码图片时使用
	public function allRotate(){
		$imgPath = $this->config->item("imgPath");
		$this->load->library("image_lib");
		$config['image_library'] = 'gd2';
		$config['rotation_angle'] = 90;
		$config['quality'] = "100%";
		for($i = 1; $i <= 109;$i++){
			$config['source_image'] = $imgPath . '\img\extra\origin\\0\\' . $i . '.jpg';
			$config['new_image'] = $imgPath . '\img\extra\origin\\3\\' . $i . '.jpg';

			$this->image_lib->initialize($config);
			$this->image_lib->rotate();
		}
		
	}

	//生成验证码图片
	public function getVerifyImg($code){

		//生成验证码
		$passwd[0] = mt_rand(0,3);
		$passwd[1] = mt_rand(0,3);
		$passwd[2] = mt_rand(0,3);
		$passwd[3] = mt_rand(0,3);

		//选取图片（目前总共109原图）
		$img[0] = mt_rand(1,109);
		$img[1] = mt_rand(1,109);
		$img[2] = mt_rand(1,109);
		$img[3] = mt_rand(1,109);

		//获取当前用户token
		$token = $_COOKIE["extraToken"];

		//旋转图片顺序
		foreach($passwd as $k => $v){
			$v1 = $v + 1 <= 3 ? $v + 1 : 3 - $v;
			$v2 = $v1 + 1 <= 3 ? $v1 + 1 : 3 - $v1;
			$v3 = $v2 + 1 <= 3 ? $v2 + 1 : 3 - $v2;

			$angle[$k][$v] = 0;
			$angle[$k][$v1] = 1;
			$angle[$k][$v2] = 2;
			$angle[$k][$v3] = 3;
		}

		foreach($angle as $k => $v){
			ksort($angle[$k]);
		}

		//加载CI框架图像处理类
		$this->load->library("image_lib");
		//通用配置信息
		$imgPath = $this->config->item("imgPath");
		$config['wm_type'] = 'overlay';
		$config['wm_vrt_alignment'] = 'top';
		$config['wm_hor_alignment'] = 'left';
		$config['wm_opacity'] = '100';

		//将旋转图片按顺序合成
		foreach($angle as $k => $v){
			foreach($v as $kk => $vv){
				$config['wm_overlay_path'] = $imgPath . '/img/extra/origin/' . $vv . '/' . $img[$k] . ".jpg";
				$config['source_image'] = ($k == 0 && $kk == 0) ? $imgPath . "/img/codeBg.jpg" : $imgPath . '/img/extra/' . $token . '.jpg';
				$config['new_image'] = $imgPath . '/img/extra/' . $token . '.jpg';
				$config['wm_vrt_offset'] = $kk * 152;
				$config['wm_hor_offset'] = $k * 152;

				if($k == 3 && $kk == 3){
					$config['dynamic_output'] = true;
					$config['quality'] = 50;
				}

				$this->image_lib->initialize($config);
				$this->image_lib->watermark();
			}
		}

		//将验证码存储在redis 以token为识别标志
		$this->cache->redis->save("verify_code:" . $token, $passwd, 600);

		//删除验证图片
		unlink($imgPath . '/img/extra/' . $token . '.jpg');
	}

	//验证验证码
	public function verify_code(){
		$code = $this->input->post("code");
		$token = $_COOKIE["extraToken"];
		$cache_code = $this->cache->redis->get("verify_code:" . $token);

		$verify = vcode($code, $cache_code, $token);

		if($verify){
			$data["result"] = 'success';
		}else{
			$data["result"] = 'failed';
		}

		echo json_encode($data);
	}

	//登录操作
	public function login_post(){
		$user = $data["user"] = strtolower($this->input->post("txt_name"));
		$pwd = $data["pwd"] = htmlentities($this->input->post("txt_password"), ENT_QUOTES, 'UTF-8');
		$ip = getClientIp();
		$code = $this->input->post("txt_code");
		$token = $_COOKIE["extraToken"];
		$cache_code = $this->cache->redis->get("verify_code:" . $token);

		$verify = vcode($code, $cache_code, $token);

		if($code){
			if(!$verify){
				rBack("验证码错误，请重新输入！");
			}
		}else{
			rBack("验证码错误，请重新输入！");
		}

		$sql = "SELECT id,password,salt FROM user WHERE username='{$user}' or email='{$user}' or phone='{$user}'";
		$res = $this->db->query($sql)->result_array();

		$count = count($res);
		
		if($count == 0){
			$params = array(
				"content"=>"不存在此用户",
				"other" => json_encode($data)
			);
			$this->common->wlog(0, "", $params, $ip);
			rBack("不存在此用户，请重新输入！");
		}
		else if($count > 1){
			$params = array(
				"content"=>"存在账户信息重复",
				"other" => json_encode($data)
			);
			$this->common->wlog(0, "", $params, $ip);
			rBack("您的账户存在重复，请联系管理员检查您的账户！");
		}

		$salt = $res[0]["salt"];
		$md5pwd = $res[0]["password"];
		$pwd = md5Pwd($pwd, $salt);
		$uid = $res[0]["id"];

		if($md5pwd != $pwd){
			$params = array(
				"content"=>"密码错误",
				"other" => json_encode($data)
			);
			$this->common->wlog(0, $uid, $params, $ip);
			rBack("用户名或密码错误，请重新输入！");
		}

		$params = array(
			"content"=>"登录成功",
		);
		$this->common->wlog(1, $uid, $params, $ip);
		$sql = "UPDATE user SET logins=logins+1 WHERE id={$uid}";
		$this->db->query($sql);

		$sql = "SELECT id AS uid,username,email,phone,vip,agent_id,status,invcode,avatar FROM user WHERE id='{$uid}'";
		$_SESSION = $this->db->query($sql)->row_array();

		rJump("", "/user/login?ok");
	}

	//注册操作
	public function register_post(){
		$email = strtolower($this->input->post("txt_reg_name"));
		$pwd = htmlentities($this->input->post("txt_reg_password"), ENT_QUOTES, 'UTF-8');
		$rpwd = htmlentities($this->input->post("txt_reg_password2"), ENT_QUOTES, 'UTF-8');
		$salt = createSalt(8);
		$ip = getClientIp();
		$code = $this->input->post("code");
		$token = $_COOKIE["extraToken"];
		$cache_code = $this->cache->redis->get("verify_code:" . $token);

		$verify = vcode($code, $cache_code, $token);

		if($code){
			if(!$verify){
				rBack("验证码错误，请重新输入！");
			}
		}else{
			rBack("验证码错误，请重新输入！");
		}

		if (!is_email($email)) {
			rBack("无效的邮箱格式，请重新输入！");
		}

		if($pwd != $rpwd && $pwd != ""){
			rBack("两次密码不一致，请重新输入！");
		}

		if(strlen($pwd) < 6){
			rBack("密码需达到6位以上，请重新输入！");
		}

		$sql = "SELECT COUNT(*) as count FROM user WHERE email='{$email}'";

		$count = $this->db->query($sql)->row_array()["count"];

		if($count > 0){
			rBack("该邮箱已被注册，请重新输入！");
		}

		$password = md5Pwd($pwd, $salt);

		$sql = "INSERT INTO user (username,password,salt,email,vip,agent_id,logins,status,reg_ip,reg_time,invcode) VALUES ('{$email}','{$password}','{$salt}','{$email}',0,0,1,0,'{$ip}','".time()."',0)";

		$insert = $this->db->query($sql);

		if(!$insert){
			rBack("系统错误！请稍后再试！");
		}

		$sql = "SELECT id AS uid,username,email,phone,vip,agent_id,status,invcode,avatar FROM user WHERE email='{$email}'";
		$_SESSION = $this->db->query($sql)->row_array();

		$params = array(
			"content"=>"注册成功",
		);
		$this->common->wlog(14, $_SESSION['uid'], $params, $ip);

		rJump("恭喜注册成功！", "/user/register?ok");
	}

	//找回密码发送邮件操作
	public function back_post(){
		//未完成
		rJump("", "/user/login?ok");
	}

	//修改昵称操作
	public function nickname_post(){
		if(!loginCheck()){
			rJump("", "/");
		}

		$uid = $_SESSION["uid"];
		$now_username = $_SESSION["username"];
		$username = $this->input->post("username");
		$len = mb_strlen($username);

		$verify = 0;
		$data["status"] = false;

		if(isLock($uid, 5) == 500){
			$verify = 1;
			$data["msg"] = "主人，您这么快...真的好吗？~";
		}

		if($now_username == $username){
			$verify = 1;
			$data["msg"] = "主人，您真的很喜欢这个名字呢~";
		}

		if($len < 2){
			$verify = 1;
			$data["msg"] = "主人，您这么短...真的好吗？";
		}

		if($len > 10){
			$verify = 1;
			$data["msg"] = "主人，您太长啦~人家受不的~";
		}

		if($verify == 1){
			echo json_encode($data);
			exit;
		}

		$sql = "SELECT COUNT(*) as count FROM user WHERE username='{$username}' or email='{$username}' or phone='{$username}'";
		$count = $this->db->query($sql)->row_array()["count"];

		if($count > 0){
			$verify = 1;
			$data["msg"] = "主人，和其他人叫一样的名字的话人家很难分辨啦~";
		}

		if($verify == 0){
			$sql = "UPDATE user SET username='{$username}' WHERE id={$uid}";
			$this->db->query($sql);

			$_SESSION["username"] = $username;
			$data["status"] = true;
		}

		$params = array(
			"content"=>"修改用户名",
			"other" => json_encode(array('user_o'=>$now_username,'user_c'=>$username)),
		);
		$this->common->wlog(2, $_SESSION['uid'], $params);

		echo json_encode($data);
	}

	//修改手机号操作
	public function phone_post(){
		if(!loginCheck()){
			rJump("", "/");
		}

		$uid = $_SESSION["uid"];
		$now_phone = $_SESSION["phone"];
		$phone = $this->input->post("phone");
		$len = mb_strlen($phone);

		$verify = 0;
		$data["status"] = false;

		if(isLock($uid, 5) == 500){
			$verify = 1;
			$data["msg"] = "主人，您这么快...真的好吗？~";
		}

		if($now_phone == $phone){
			$verify = 1;
			$data["msg"] = "太好了，主人您没有换联系方式呢~";
		}

		if(!is_mobile($phone)){
			$verify = 1;
			$data["msg"] = "主人，这不像是手机号哦~";
		}

		if($len < 11){
			$verify = 1;
			$data["msg"] = "主人，您这么短...真的好吗？";
		}

		if($len > 11){
			$verify = 1;
			$data["msg"] = "主人，您太长啦~人家受不的~";
		}

		if($verify == 1){
			echo json_encode($data);
			exit;
		}

		$sql = "SELECT COUNT(*) as count FROM user WHERE username='{$phone}' or email='{$phone}' or phone='{$phone}'";
		$count = $this->db->query($sql)->row_array()["count"];

		if($count > 0){
			$verify = 1;
			$data["msg"] = "主人，这个手机号是别人的啦~";
		}

		if($verify == 0){
			$sql = "UPDATE user SET phone='{$phone}' WHERE id={$uid}";
			$this->db->query($sql);

			$_SESSION["phone"] = $phone;

			$params = array(
				"content" => "修改手机号",
				"other" => json_encode(array("phone_o"=>$now_phone,"phone_c"=>$phone))
			);
			$this->common->wlog(4, $uid, $params);
			$data["status"] = true;
		}

		echo json_encode($data);
	}

	//修改密码操作
	public function password_post(){
		if(!loginCheck()){
			rJump("", "/");
		}

		$oldPwd = $this->input->post("txtPasswordOld");
		$newPwd = htmlentities($this->input->post("txtPasswordNew"), ENT_QUOTES, 'UTF-8');
		$rNewPwd = htmlentities($this->input->post("txtPasswordConfirm"), ENT_QUOTES, 'UTF-8');
		$uid = $_SESSION["uid"];

		if($newPwd != $rNewPwd){
			rBack("两次密码不一致，请重新输入！");
		}

		if(mb_strlen($newPwd) < 6){
			rBack("新密码太短啦~");
		}

		$sql = "SELECT password,salt FROM user WHERE id={$uid}";
		$old = $this->db->query($sql)->row_array();

		if(md5Pwd($oldPwd, $old["salt"]) != $old["password"]){
			rBack("原密码有误，请重新输入");
		}

		$newPassword = md5Pwd($newPwd, $old["salt"]);
		$sql = "UPDATE user SET password='{$newPassword}' WHERE id={$uid}";
		$update = $this->db->query($sql);

		if(!$update){
			rBack("系统出错啦~您再提交一遍可好？");
		}

		rBack("密码修改成功咯O(∩_∩)O~");
	}

	//收藏 删除收藏操作
	public function bookmarker_post(){
		if(!loginCheck()){
			rJump("", "/");
		}
		
		$cid = $this->input->post("id");
		$type = $this->input->post("type");
		$uid = $_SESSION["uid"];

		if(isLock($uid, 2)){
			echo json_encode(array("Value" => "0"));
			exit;
		}

		$data["Value"] = "2";

		if($type == "delete"){
			$count = count(explode(",", $cid));

			$sql = "DELETE FROM book_marker WHERE uid='{$uid}' AND cid in ({$cid})";
			$delete = $this->db->query($sql);

			$this->cache->redis->delete("bookMarker:uid_" . $uid);

			if($delete){
				$params = array(
					"cid" => $cid,
					"content" => "删除收藏成功",
				);

				$this->common->riseComicItem($cid, "collect", "-", $count);
				$this->cache->redis->delete("comic:cid_" . $cid);

				$this->common->wlog(5, $uid, $params);
				$data["Value"] = "1";
			}
		}else{
			$posttime = time();
			$sql = "INSERT INTO book_marker (uid,cid,posttime) VALUES ({$uid},{$cid},{$posttime})";
			$add = $this->db->query($sql);

			$this->cache->redis->delete("bookMarker:uid_" . $uid);

			$data["Value"] = "0";

			if($add){
				$params = array(
					"cid" => $cid,
					"content" => "收藏成功",
				);
				$data["Value"] = "1";

				$this->common->riseComicItem($cid,"collect","+", 1);
				$this->cache->redis->delete("comic:cid_" . $cid);
			}
		}

		echo json_encode($data);
	}

	//增加 删除 清空 阅读历史操作
	public function bookHistory_post(){
		if(!loginCheck()){
			rJump("", "/");
		}

		$cid = $this->input->post("cid");
		$type = $this->input->post("type");
		$uid = $_SESSION["uid"];
		$data["Value"] = "0";

		if(isLock($uid, 2)){
			echo json_encode(array("Value" => "0"));
			exit;
		}

		if($type == "clearall"){
			$all = "SELECT cid FROM book_history WHERE uid='{$uid}'";
			$all = $this->db->query($all)->result_array();
			$all_id = array_column($all, "cid");
			$all_id = implode(",", $all_id);

			$sql = "DELETE FROM book_history WHERE uid='{$uid}'";
			$delete = $this->db->query($sql);

			if($delete){
				$params = array(
					"cid" => $all_id,
					"content" => "清空历史记录",
				);
				$this->common->wlog(5, $uid, $params);
				$data["Value"] = "1";
			}
		}
		else if($type == "delete"){
			$sql = "DELETE FROM book_history WHERE uid='{$uid}' AND cid in ({$cid})";
			$delete = $this->db->query($sql);

			if($delete){
				$params = array(
					"cid" => $cid,
					"content" => "删除历史记录",
				);
				$this->common->wlog(7, $uid, $params);
				$data["Value"] = "1";
			}
		}

		$this->cache->redis->delete("bookHistory:uid_" . $uid);

		echo json_encode($data);
	}

	//漫画大全获取漫画数据ajax
	public function getList(){
		$this->load->model('home_model', 'home');

		$type = $this->input->post("type") == "" ? "hot" : $this->input->post("type");
		$status = $this->input->post("status") == "" ? "all" : $this->input->post("status");
		$page = $this->input->post("pageindex");
		$size = $this->input->post("pagesize");

		$list = $this->home->searchAll($type, $status, $page, $size);

		if($list){
			foreach($list as $k => $v){
				$r["UpdateComicItems"][$k] = array(
					"UrlKey" => "javascript:;",
					"ShowPicUrlB" => "/comics/cover/" . $v["id"] . ".jpg",
					"Logo" => "",
					"Title" => $v["title"],
					"LastPartUrl" => "javascript:;",
					"Status" => "",
					"ShowLastPartName" => $v["chapter"] . "话",
				);
			}
		}else{
			$r["UpdateComicItems"] = array();
		}

		echo json_encode($r);
	}

	//获取每日更新漫画
	public function getDayUpdate(){
		$this->load->model('home_model', 'home');
		$dk = $this->input->post("DK");	//几天前

		$time = time() - ($dk * 86400);
		$day = date("Y-m-d", $time);
		$starttime = dayStartTime($time);
		$endtime = dayEndTime($time);

		$data = $this->cache->redis->get("dayupdate:" . $day);
		
		if(!$data){
			$data["list"] = $this->home->getComic("id,title,chapter,status", "posttime>={$starttime} AND posttime<{$endtime}", "posttime DESC");

			$this->cache->redis->save("dayupdate:" . $day, $data, -1);
		}

		echo json_encode($data);
	}

	//反馈接收
	public function getOpinion(){
		//检测登录
		if(!isset($_SESSION["uid"])){
			rJump("", "/user/login");
		}

		//接收参数
		$type = $this->input->post("type");
		$content = $this->input->post("content");
		$contact = $this->input->post("contact");
		$imgs = $this->input->post("imgs");
		$imgName = md5(time().$_SESSION["uid"]);

		//检测反馈类型
		if(!in_array($type, array(0,1,2,3))){
			rBack("请选择一个反馈类型");
		}

		//如果有上传图片
		if($imgs){
			foreach($imgs as $k => $v){
				$imgdata = substr($v, strpos($v, ",") + 1);
				$decodedData = base64_decode($imgdata);
				$images[$k] = $imgName . "_" . $k . ".jpg";
				file_put_contents('./uploads/origin/'. $images[$k], $decodedData); //图片临时路径
			}
		}

		$imgPath = $this->config->item("imgPath");

		$success = 1;

		//缩小图片，并存放至真实目录
		$this->load->library('image_lib');
		foreach($images as $k => $v){
			$url = $imgPath . "\uploads\origin\\" . $v;

			//ci框架处理图像方法
			$config['source_image'] = $url;
			$config['width'] = 500;
			$config['height'] = 500;
			$config['quality'] = 30;
			$config['new_image'] = $imgPath . "\uploads\opinion\\" . $v;
			$init = $this->image_lib->initialize($config);
			$do = $this->image_lib->resize();

			if(!$init || !$do){
				$success = 0;
			}

			//删除源文件
			unlink($imgPath . '\uploads\origin\\' . $v);
		}
		
		//如果图片操作都成功，写入数据库
		if($success){
			$time = time();
			$images = implode(",", $images);
			$sql = "INSERT INTO opinion (type,content,contact,images,posttime) VALUES ({$type},'{$content}','{$contact}','{$images}',{$time})";
			$add = $this->db->query($sql);

			if(!$add){
				$success = 0;
			}
		}

		if($success){
			rBack("感谢您的建议或意见，我们将会在3个工作日内给您回复，谢谢！");
		}else{
			rBack("系统出错啦~您再提交一遍可好？");
		}
	}

	//修改头像
	public function getAvatar(){
		//检测登录
		if(!isset($_SESSION["uid"])){
			rJump("", "/user/login");
		}

		$imgs = $this->input->post("avatar");
		$uid = $_SESSION["uid"];
		$imgName = md5(time()."avatar".$uid);

		if($imgs){
			$imgdata = substr($imgs, strpos($imgs, ",") + 1);
			$decodedData = base64_decode($imgdata);
			$images = $imgName . ".jpg";
			file_put_contents('./uploads/origin/'. $images, $decodedData); //图片临时路径
		}

		$imgPath = $this->config->item("imgPath");

		//缩小图片，并存放至真实目录
		$this->load->library('image_lib');
		$url = $imgPath . "/uploads/origin/" . $images;

		//ci框架处理图像方法
		$config['source_image'] = $url;
		$config['width'] = 86;
		$config['height'] = 86;
		$config['quality'] = 90;
		$config['maintain_ratio'] = false;
		$config['new_image'] = $imgPath . "/uploads/avatar/" . $_SESSION["uid"] . ".jpg";
		$init = $this->image_lib->initialize($config);
		$do = $this->image_lib->resize();

		//删除源文件
		unlink($imgPath . '/uploads/origin/' . $images);

		if(!$init || !$do){
			rBack("系统出错啦~您再提交一遍可好？");
		}

		//数据库用户信息头像修改为已设置
		$sql = "UPDATE user SET avatar=avatar+1 WHERE id={$uid}";
		$update = $this->db->query($sql);

		if(!$update){
			rBack("系统出错啦~您再提交一遍可好？");
		}

		$_SESSION["avatar"] = $_SESSION["avatar"] + 1;
		rBack("头像修改成功~");
	}
}