<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comic_model extends CI_Model {
	//获取漫画数据
	public function getComic($cid){
		$data = $this->cache->redis->get("comic:cid_" . $cid);

		if(!$data){
			$sql = "SELECT id,title,descript,chapter,comment,tag,author,adult,status,`show`,star,posttime FROM comics WHERE id={$cid}";
			$data = $this->db->query($sql)->row_array();

			$this->cache->redis->save("comic:cid_" . $cid, $data, -1);
		}

		return $data;
	}

	//获取连载章节数据
	public function getChapterList($cid){
		$data = $this->cache->redis->get("chapter:cid_" . $cid);

		if(!$data){
			$sql = "SELECT id,cid,chapter,title,free,limit_free,discount,sell,status,posttime FROM chapter WHERE cid={$cid} AND status=0 ORDER BY chapter DESC";
			$data = $this->db->query($sql)->result_array();

			$redis = $this->cache->redis->save("chapter:cid_" . $cid, $data, 86400 * 365);

		}

		return $data;
	}

	//获取番外章节数据
	public function getOutsideList($cid){
		$data = $this->cache->redis->get("outside:cid_" . $cid);

		if(!$data){
			$sql = "SELECT id,cid,chapter,title,free,limit_free,discount,sell,status,posttime FROM chapter WHERE cid={$cid} AND status=1 ORDER BY chapter DESC";
			$data = $this->db->query($sql)->result_array();
			
			$this->cache->redis->save("outside:cid_" . $cid, $data, -1);
		}

		return $data;
	}

	public function addBookHistory($uid, $cid, $history, $history_id){
		$time = time();
		
		$sql = "DELETE FROM book_history WHERE uid={$uid} AND cid={$cid}";
		$delete = $this->db->query($sql);

		$sql = "INSERT INTO book_history (uid,cid,history,history_id,posttime) VALUES ({$uid},{$cid},{$history},{$history_id},{$time})";
		$add = $this->db->query($sql);

		$this->cache->redis->delete("bookHistory:uid_" . $uid);

		return $add;
	}
}