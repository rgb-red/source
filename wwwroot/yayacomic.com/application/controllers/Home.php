<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	//首页
	public function index(){
		$this->load->model('home_model', 'home');

		$sevenAgo = time() - 99 * 86400; //7天前

		$banner = $this->cache->redis->get("index:banner");
		if($banner){
			$data["banner"] = $banner;
		}else{
			$data["banner"] = $this->home->getBanner();
			$this->cache->redis->save("index:banner", $data["banner"], -1);
		}

		$rand = $this->cache->redis->get("index:rand");
		if($rand){
			$data["rand"] = $rand;
		}else{
			$data["rand"] = $this->home->getComic("id,title,brief", "posttime>" . $sevenAgo, "RAND()", 12, 4);
			$this->cache->redis->save("index:rand", $data["rand"], dayEndTime(time()) - time());
		}

		$news = $this->cache->redis->get("index:news");
		if($news){
			$data["news"] = $news;
		}else{
			$data["news"] = $this->home->getComic("id,title,chapter", "", "posttime DESC", 9, 3);
			$this->cache->redis->save("index:news", $data["news"], dayEndTime(time()) - time());
		}

		$hot = $this->cache->redis->get("index:hot");
		if($hot){
			$data["hot"] = $hot;
		}else{
			$data["hot"] = $this->home->getComic("id,title,chapter", "", "(collect+comment) DESC", 9, 3);
			$this->cache->redis->save("index:hot", $data["hot"], dayEndTime(time()) - time());
		}

		$subject = $this->cache->redis->get("index:subject");
		if($subject){
			$data["subject"] = $subject;
		}else{
			$data["subject"] = $this->home->getSubject();
			$this->cache->redis->save("index:subject", $data["subject"], -1);
		}

		$rank = $this->cache->redis->get("index:rank");
		if($rank){
			$data["rank"] = $rank;
		}else{
			$data["rank"][0] = $this->home->getComic("id,title,descript", "", "(collect+comment) DESC", 5, 0);
			$data["rank"][1] = $this->home->getComic("id,title,descript", "", "id DESC", 5, 0);
			$data["rank"][2] = $this->home->getComic("id,title,descript", "", "collect DESC", 5, 0);
			$data["rank"][3] = $this->home->getComic("id,title,descript", "", "comment DESC", 5, 0);
			$this->cache->redis->save("index:rank", $data["rank"], dayEndTime(time()) - time());
		}

		$this->load->view('index', $data);
	}

	//搜索页
	public function search(){
		//取出搜索历史
		$search_history = isset($_COOKIE["search_history"]) ? $_COOKIE["search_history"] : array();

		if($_GET){
			$this->load->model('home_model', 'home');

			if(isset($_GET["title"])){
				$title = $this->input->get("title");
				$isset = 0;
				foreach($search_history as $v){
					if($v == $title){
						$isset = 1;
					}
				}

				//搜索历史数据处理
				if($isset == 0){
					$count = count($search_history);

					if($count == 5){
						unset($search_history[4]);
					}

					array_unshift($search_history, $title);
				}

				//重新保存搜索历史至cookie
				foreach($search_history as $k => $v){
					setcookie("search_history[$k]", $search_history[$k]);
				}

				$data["list"] = $this->home->search($title);

				$data["title"] = $title;
			}
			else if(isset($_GET["tag"])){
				$tag = $this->input->get("tag");
				$data = $this->cache->redis->get("search:tag_" . $tag);

				if(!$data){
					$data["list"] = $this->home->search($tag, 1);

					$data["title"] = $this->config->item("tag")[$tag];

					$this->cache->redis->save("search:tag_" . $tag, $data, -1);
				}
			}
			else if(isset($_GET["author"])){
				$author = $this->input->get("author");
				$data = $this->cache->redis->get("search:author_" . $author);

				if(!$data){
					$data["list"] = $this->home->search($author, 2);

					$data["title"] = $this->common->getAuthorList()[$author];

					$this->cache->redis->save("search:author_" . $author, $data, -1);
				}
			}
			
			$this->load->view('search/list', $data);
		}else{
			$data["search_history"] = $search_history;
			$this->load->view('search/index', $data);
		}
	}

	//清除搜索历史cookie
	public function rmSearchHistory(){
		$action = $this->input->get("action");
		$search_history = isset($_COOKIE["search_history"]) ? $_COOKIE["search_history"] : array();

		if($action == "removehistory"){
			$keyword = urldecode($this->input->get("title"));

			foreach($search_history as $k => $v){
				setcookie("search_history[$k]", "", time() - 1);
				if($v == $keyword){
					unset($search_history[$k]);
				}
			}

			foreach($search_history as $k => $v){
				setcookie("search_history[$k]", $v);
			}
		}else if($action == "removeall"){
			foreach($search_history as $k => $v){
				setcookie("search_history[$k]", "", time() - 1);
			}
		}

		echo "ok";
	}

	//漫画大全
	public function allList(){
		$this->load->model('home_model', 'home');

		$type = $this->input->get("type") == "" ? "hot" : $this->input->get("type");
		$status = $this->input->get("status") == "" ? "all" : $this->input->get("status");
		$page = 1;
		$size = 21;

		$data["list"] = $this->home->searchAll($type, $status, $page, $size);

		$this->load->view("search/all", $data);
	}

	//榜单
	public function rank(){
		$this->load->model('home_model', 'home');
		$item = "id,title,chapter,descript";

		$data = $this->cache->redis->get("rank_list");

		if(!$data){
			$data["hot"] = $this->home->getComic($item, "", "(collect+comment) DESC", 100);
			$data["new"] = $this->home->getComic($item, "", "posttime DESC", 100);
			$data["collect"] = $this->home->getComic($item, "", "collect DESC", 100);
			$data["comment"] = $this->home->getComic($item, "", "comment DESC", 100);

			$this->cache->redis->save("rank_list", $data, dayEndTime(time()) - time());
		}

		$this->load->view('search/rank', $data);
	}

	//每日更新
	public function dayupdate(){
		$this->load->model('home_model', 'home');

		$time = time();
		$day = date("Y-m-d", $time);
		$starttime = dayStartTime($time);
		$endtime = dayEndTime($time);

		$data = $this->cache->redis->get("dayupdate:" . $day);

		if(!$data){
			$data["list"] = $this->home->getComic("id,title,chapter,status", "posttime>={$starttime} AND posttime<{$endtime}", "posttime DESC");

			$data["weekList"] = weekList(time());

			$this->cache->redis->save("dayupdate:" . $day, $data, -1);
		}

		$this->load->view("search/dayupdate", $data);
	}

	//专题
	public function subject($id = ""){
		if($id == ""){
			$data = $this->cache->redis->get("subject:all");
			if(!$data){
				$sql = "SELECT id,title,brief FROM subject ORDER BY posttime DESC";
				$data["subject"] = $this->db->query($sql)->result_array();

				$this->cache->redis->save("subject:all", $data, -1);
			}

			$this->load->view("search/subject", $data);
		}else{
			//专题基本信息
			$data = $this->cache->redis->get("subject:sid_" . $id);

			if(!$data){
				$sql = "SELECT id,title,descript,brief,book FROM subject WHERE id={$id}";
				$data["subject"] = $this->db->query($sql)->row_array();

				//专题中的漫画基本信息
				$book = $data["subject"]["book"];
				$sql = "SELECT id,title,descript,tag FROM comics WHERE id in ({$book}) ORDER BY posttime DESC";
				$data["book"] = $this->db->query($sql)->result_array();

				$this->cache->redis->save("subject:sid_" . $id, $data);
			}

			//当前用户收藏信息
			if(!isset($_SESSION["uid"])){
				$data["marker"] = array();
			}else{
				$this->load->model("home_model", "home");
				$marker = $this->home->getBookMarker($_SESSION["uid"]);
				if(!$marker){
					$data["marker"] = array();
				}else{
					foreach($marker as $k => $v){
						$data["marker"][$v["id"]] = $v;
					}
				}
			}

			$this->load->view("search/subject_detail", $data);
		}
	}
}