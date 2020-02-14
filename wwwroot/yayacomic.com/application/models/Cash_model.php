<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cash_model extends CI_Model {
	//返回指定用户余额
	public function getBalance($uid = ""){
		if(!$uid){
			$uid = $_SESSION["uid"];
		}

		$balance = $this->cache->redis->get("balance:uid_" . $uid);

		if($balance != ""){
			return $balance;
		}

		$sql = "SELECT balance FROM user WHERE id={$uid}";
		$balance = $this->db->query($sql)->row_array()["balance"];

		$this->cache->redis->save("balance:uid_" . $uid, $balance, -1);

		return $balance;
	}

	//返回在未超出期限的福卡总余额
	public function getFukaBalance($uid = ""){
		if(!$uid){
			$uid = $_SESSION["uid"];
		}

		$fukaBalance = $this->cache->redis->get("fukaBalance:uid_" . $uid);

		if($fukaBalance != ""){
			return $fukaBalance;
		}

		$time = time();

		$sql = "SELECT SUM(balance) as balance FROM fuka WHERE uid={$uid} AND endtime>{$time}";
		$fukaBalance = $this->db->query($sql)->row_array()["balance"];

		$this->cache->redis->save("fukaBalance:uid_" . $uid, $fukaBalance, -1);

		return $fukaBalance;
	}

	//增加余额
	public function addBalanceOnline($order_id, $uid, $amount, $paytype, $payname){
		//status 0初始状态 入款失败 1未查找到订单号 2订单号有重复 入款失败 3已入款 请勿重复入款 4增加余额失败 5  6入款成功
		//先验证订单是否存在且订单唯一
		$sql = "SELECT status FROM bill_log WHERE order_id='{$order_id}' AND uid={$uid} AND amount={$amount} AND paytype='{$paytype}'";
		$order = $this->db->query($sql)->result_array();
		$count = count($order);

		$status = 0;	//初始状态 入款失败

		if($count == 0){
			$status = 1; //未查找到订单号 入款失败
		}
		else if($count > 1){
			$status = 2;	//订单号有重复 入款失败
		}

		if($status == 0){	//若查找到订单号，并且订单号唯一
			if($order[0]["status"] == 1){
				$status = 3;
			}
		}

		if($status == 0){	//若查找到订单号，订单号唯一，状态为未入款
			$sql = "UPDATE user SET balance=balance+{$amount} WHERE id={$uid}";
			$add = $this->db->query($sql);

			if(!$add){
				$status = 4;
			}
		}

		if($status == 0){ //若增加余额成功
			$time = time();

			$sql = "UPDATE bill_log SET now_balance=last_balance+{$amount},status=1,payname='{$payname}',posttime={$time} WHERE order_id='{$order_id}' AND uid={$uid} AND `from`=8 AND amount={$amount} AND paytype='{$paytype}'";
			$log = $this->db->query($sql);

			if(!$log){
				$status = 5;
			}else{
				$status = 6;
			}
		}

		return $status;
	}

	//赠送福卡
	public function addFuka(){

	}
}