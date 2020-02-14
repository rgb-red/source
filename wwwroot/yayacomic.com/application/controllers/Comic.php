<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comic extends MY_Controller {
	//漫画详情页
	public function detail($cid = ""){
		if(!$cid){
			$this->load->view("404");
		}

		$this->load->model("comic_model", "comic");
		//加载url辅助函数（分享功能需用到）
		$this->load->helper('url');

		//获取漫画详情页必要数据
		$data["comic"] = $this->comic->getComic($cid);	//漫画数据
		$data["chapter_list"] = $this->comic->getChapterList($cid);	//连载章节数据
		$data["outside_list"] = $this->comic->getOutsideList($cid);	//番外章节数据

		//获取阅读历史信息
		$data["history"] = 1;	//默认第一话
		$data["history_id"] = $data["chapter_list"] ? $data["chapter_list"][count($data["chapter_list"]) - 1]["id"] : 1;	//默认第一话的chapter_id

		if(isset($_SESSION["uid"])){
			$this->load->model("home_model", "home");
			$uid = $_SESSION["uid"];
			$bookHistory = $this->home->getBookHistory($uid);
			foreach($bookHistory as $k => $v){
				if($v["id"] == $cid){
					$data["history"] = $v["history"];
					$data["history_id"] = $v["history_id"];
				}
			}
		}

		//获取收藏信息
		$data["marker"] = 0;
		if(isset($_SESSION["uid"])){
			$this->load->model("home_model", "home");
			$uid = $_SESSION["uid"];
			$BookMarker = $this->home->getBookMarker($uid);
			foreach($BookMarker as $k => $v){
				if($v["id"] == $cid){
					$data["marker"] = 1;
				}
			}
		}
		

		//获取作者数据列表
		$data["authorList"] = $this->common->getAuthorList();

		//识别是否限制级内容
		$data["adult"] = true;
		if($data["comic"]["adult"] == 1){
			if(!isset($_COOKIE["adult_" . $cid])){
				$data["adult"] = false;
				setcookie("adult_" . $cid, true, time() + 600);
			}
		}

		//漫画章节排序
		$data["sort"] = "desc";
		$sort = isset($_COOKIE["sort"]) ? $_COOKIE["sort"] : "desc";

		if($sort == "asc"){
			$data["sort"] = "asc";

			if($data["chapter_list"]){
				$data["chapter_list"] = array_reverse($data["chapter_list"]);
			}

			if($data["outside_list"]){
				$data["outside_list"] = array_reverse($data["outside_list"]);
			}
		}

		$this->load->view('comic/detail', $data);
	}

	//漫画阅读页
	public function chapter($cid, $status, $mid){
		if(!$mid){
			$this->load->view("404");
		}
		
		//获取章节数据
		$data = $this->cache->redis->get("chapterImage:cid_" . $cid . ":status_" . $status . ":mid_" . $mid);

		if(!$data){
			$sql = "SELECT A.id,A.cid,B.title as comic,A.title,A.chapter,B.descript,A.title,A.images,B.status,A.free,A.limit_free,A.discount,A.sell FROM chapter A LEFT JOIN comics B ON A.cid=B.id WHERE A.id={$mid} AND A.status={$status}";
			$data = $this->db->query($sql)->row_array();

			if(!$data){
				$this->load->view("404");
			}

			$data["id"] = $mid;
			$data["cid"] = $cid;
			$data["status"] = (int)$status;
			$this->cache->redis->save("chapterImage:cid_" . $cid . ":status_" . $status . ":mid_" . $mid, $data, 86400 * 365);
		}

		if(in_array(sellStatus($data["free"], $data["limit_free"], $data["discount"], $data["sell"]), array(2, 3))){	//限时优惠和收费状态
			echo json_encode($data);exit;
			$this->load->view("comic/buy", $data);
		}

		//获取漫画列表数据
		$this->load->model("comic_model", "comic");
		if($status == 0){
			$chapter_list = $this->comic->getChapterList($cid);
		}else{
			$chapter_list = $this->comic->getOutsideList($cid);
		}

		//获取上一章下一章
		foreach($chapter_list as $k => $v){
			if($v["id"] == $mid){
				$data["last"] = isset($chapter_list[$k + 1]) ? $chapter_list[$k + 1]["id"] : false;
				$data["next"] = isset($chapter_list[$k - 1]) ? $chapter_list[$k - 1]["id"] : false;
			}
		}

		//章节图片
		$data["images"] = explode(",", $data["images"]);
		$data["maxImg"] = count($data["images"]);

		//记录阅读历史 需登录 番外章节不记录阅读历史
		if(isset($_SESSION["uid"]) && $status == 0){
			$this->comic->addBookHistory($_SESSION["uid"], $cid, $data["chapter"], $data["id"]);
		}

		//默认关闭vip广告和操作提示 0关闭 1开启
		$data["VIPAD"] = 0;
		$data["DOTIP"] = 0;
		$data["vip"] = isset($_SESSION["vip"]) ? $_SESSION["vip"] : 0;

		if(!isset($_SESSION["uid"])){	//未登录
			if(!isset($_COOKIE["VIPAD"])){
				$data["VIPAD"] = 1;
			}

			if(!isset($_COOKIE["DOTIP"])){
				$data["DOTIP"] = 1;
			}

			//未登录显示单页
			$this->load->view("comic/chapter_single", $data);
		}else{
			if($_SESSION["vip"] <= 0){
				if(!isset($_COOKIE["VIPAD"])){
					$data["VIPAD"] = 1;
				}

				if(!isset($_COOKIE["DOTIP"])){
					$data["DOTIP"] = 1;
				}

				//非VIP显示单页
				$this->load->view("comic/chapter_single", $data);
			}else{
				if(isset($_COOKIE["SINGLE"])){
					if($_COOKIE["SINGLE"] == 1){	//vip用户自愿单页显示
						if(!isset($_COOKIE["DOTIP"])){
							$data["DOTIP"] = 1;
						}

						$this->load->view("comic/chapter_single", $data);
					}else{
						$this->load->view("comic/chapter", $data);
					}
				}else{
					$this->load->view("comic/chapter", $data);
				}
			}
		}
	}

	//漫画章节页
	public function title($cid){
		if(!$cid){
			$this->load->view("404");
		}

		$this->load->model("comic_model", "comic");

		//获取漫画详情页必要数据
		$data["comic"] = $this->comic->getComic($cid);	//漫画数据
		$data["chapter_list"] = $this->comic->getChapterList($cid);	//连载章节数据
		$data["outside_list"] = $this->comic->getOutsideList($cid);	//番外章节数据

		//漫画章节排序
		$data["sort"] = "desc";
		$sort = isset($_COOKIE["sort"]) ? $_COOKIE["sort"] : "desc";

		if($sort == "asc"){
			$data["sort"] = "asc";

			if($data["chapter_list"]){
				$data["chapter_list"] = array_reverse($data["chapter_list"]);
			}

			if($data["outside_list"]){
				$data["outside_list"] = array_reverse($data["outside_list"]);
			}
		}

		$this->load->view('comic/title', $data);
	}

	public function comment($cid){
		if(!$cid){
			$this->load->view("404");
		}

		$this->load->model("comic_model", "comic");

		//获取漫画详情页必要数据
		$data["comic"] = $this->comic->getComic($cid);	//漫画数据

		$this->load->view("comic/comment", $data);
	}
}