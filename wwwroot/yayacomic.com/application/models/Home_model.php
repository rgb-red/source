<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
	//首页轮播图
	public function getBanner(){
		$sql = "SELECT B.id,B.title,B.chapter FROM banner A LEFT JOIN comics B ON A.cid=B.id WHERE A.group=0 ORDER BY A.id ASC";
		$r = $this->db->query($sql)->result_array();

		return $r;
	}

	//按条件取漫画基本数据
	public function getComic($item, $where, $order, $num = "", $group = ""){
		$where = $where == "" ? "" : "WHERE " . $where;
		$limit = $num == "" ? "" : "LIMIT ". $num;

		$sql = "SELECT {$item} FROM comics {$where} ORDER BY {$order} {$limit}";
		$r = $this->db->query($sql)->result_array();

		if($group){
			$r = group($r, $group);
		}

		return $r;
	}

	//获取专题 首页
	public function getSubject(){
		$sql = "SELECT id,title,descript,book FROM subject ORDER BY id DESC LIMIT 3";
		$subject = $this->db->query($sql)->result_array();

		foreach($subject as $k => $v){
			$subject[$k]["book"] = explode(",", $v["book"]);
		}

		return $subject;
	}

	//搜索
	public function search($keyword, $tag = 0){
		if($tag == 0){
			$sql = "SELECT id,title,descript,tag,status FROM comics WHERE title LIKE '%{$keyword}%' OR descript LIKE '%{$keyword}%' ORDER BY (collect+comment) DESC";
		}
		else if($tag == "all"){
			$sql = "SELECT id,title,descript,tag,status FROM comics ORDER BY (collect+comment) DESC limit 25";
		}
		else if($tag == 1){
			$sql = "SELECT id,title,descript,tag,status FROM comics WHERE tag LIKE '%,{$keyword},%' ORDER BY (collect+comment) DESC";
		}
		else if($tag == 2){
			$sql = "SELECT id,title,descript,tag,status FROM comics WHERE author LIKE '%,{$keyword},%'  ORDER BY (collect+comment) DESC";
		}
		
		$r = $this->db->query($sql)->result_array();

		return $r;
	}

	//分页获取漫画基本数据
	public function searchAll($type, $status, $page, $size){
		$r = $this->cache->redis->get("allList:type_" . $type . "_status_" . $status . "_page_" . $page);

		if(!$r){
			$order = $type == "new" ? "posttime" : $type;
			$order = $type == "hot" ? "(collect+comment)" : $order;

			if($status == "all"){
				$where = "1=1";
			}
			else if($status == "over"){
				$where = "status=1";
			}
			else{
				$where = "status=0";
			}

			$limit = ($page - 1) * $size . "," . $size;

			$sql = "SELECT id,title,chapter FROM comics WHERE {$where} ORDER BY {$order} DESC LIMIT {$limit}";

			$r = $this->db->query($sql)->result_array();

			$this->cache->redis->save("allList:type_" . $type . "_status_" . $status . "_page_" . $page, $r, -1);
		}

		return $r;
	}

	//获取指定用户收藏漫画
	public function getBookMarker($uid = ""){
		if($uid){
			$uid = $_SESSION["uid"];
		}

		$data = $this->cache->redis->get("bookMarker:uid_" . $uid);

		if($data){
			return $data;
		}

		$sql = "SELECT A.cid as id,B.title,B.chapter,C.history FROM (book_marker A LEFT JOIN comics B ON A.cid=B.id) LEFT JOIN book_history C ON A.cid=C.cid WHERE A.uid={$uid} ORDER BY A.posttime DESC";
		$data = $this->db->query($sql)->result_array();
		
		$this->cache->redis->save("bookMarker:uid_" . $uid, $data, -1);

		return $data;
	}

	//获取指定用户阅读历史
	public function getBookHistory($uid = ""){
		if($uid){
			$uid = $_SESSION["uid"];
		}

		$data = $this->cache->redis->get("bookHistory:uid_" . $uid);

		if($data){
			return $data;
		}

		$sql = "SELECT A.cid as id,B.title,B.chapter,B.author,A.history,A.history_id FROM book_history A LEFT JOIN comics B ON A.cid=B.id WHERE A.uid={$uid} ORDER BY A.posttime DESC";
		$data = $this->db->query($sql)->result_array();

		$this->cache->redis->save("bookHistory:uid_" . $uid, $data, -1);

		return $data;
	}
}