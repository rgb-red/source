<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {
	//写日志
	public function wlog($from, $uid = "", $params = array(), $ip = ""){
		if(!$uid){
			$uid = isset($_SESSION["uid"]) ? $_SESSION["uid"] : "";
		}

		if(!$ip){
			$ip = getClientIp();
		}

		$posttime = time();

		$key = "`from`,`uid`,";
		$val = "'{$from}','{$uid}',";

		foreach($params as $k => $v){
			$key .= "`" . $k . "`,";
			$val .= "'" .$v . "',";
		}

		$key .= "`posttime`,`ip`";
		$val .= "'{$posttime}','{$ip}'";

		$sql = "INSERT INTO log ({$key}) VALUES ({$val})";

		return $this->db->query($sql);
	}

	//获取漫画作者列表
	public function getAuthorList(){
		$list = $this->cache->redis->get("author_list");
		if($list){
			return $list;
		}

		$sql = "SELECT * FROM author_list";
		$list = $this->db->query($sql)->result_array();

		foreach($list as $k => $v){
			$data[(int)$v["id"]] = $v["name"];
		}

		$this->cache->redis->save("author_list", $data, -1);

		return $data;
	}

	//改变漫画统计数据
	public function riseComicItem($cid, $item, $rise, $num = 1){
		$sql = "UPDATE comics SET {$item}={$item}{$rise}1 WHERE id={$cid}";
		$do = $this->db->query($sql);
		return $do;
	}
}