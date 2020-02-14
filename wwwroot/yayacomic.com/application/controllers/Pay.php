<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends MY_Controller {
	public function recharge(){
		$uid = $this->input->post("uid");
		$username = $this->input->post("username");
		$amount = $this->input->post("amount");
		$token = $this->input->post("token");
		$paytype = $this->input->post("paytype");
		$order_id = $this->input->post("order_id");
		$time = time();
		$ip = getClientIp();

		$this->load->model("cash_model", "cash");

		$code = 0;

		if(!in_array($paytype, array("wechat", "alipay"))){
			$code = 999;
		}

		if($uid != $_SESSION["uid"] || $username != $_SESSION["username"]){
			$code = 998;
		}

		if(md5(md5($amount)."xo4iu12dfwe".md5($uid)."xoeif23v85kl".md5($order_id)) != $token){
			$code = 997;
		}

		if($code != 0){
			rJump($code . ":充值信息有误，请确认后重试！", "", "window.close();");
		}

		$sql = "SELECT balance FROM user WHERE id={$uid}";
		$balance = $this->db->query($sql)->row_array()["balance"];

		$sql = "INSERT INTO bill_log (order_id,uid,`from`,amount,last_balance,paytype,status,posttime,runtime,ip) VALUES ('{$order_id}',{$uid},8,{$amount},'{$balance}','{$paytype}',0,{$time},{$time},'{$ip}')";
		$createOrder = $this->db->query($sql);

		if(!$createOrder){
			rJump("996:创建订单失败，请重试！", "", "window.close();");
		}
		//////////////////订单创建部分完成//////////////////

		//提交支付(接第三方支付接口) 未完成
		//模拟
		$payUrl = "http://yy.com/pay/payReturn";
		$payData = array(
			"order_id" => $order_id,
			"uid" => $uid,
			"amount" => $amount,
			"paytype" => $paytype,
		);

		$pay = (int)curl($payUrl, $payData);

		rJump("","","window.close();");
	}

	public function checkRecharge(){
		$order_id = $this->input->post("order_id");

		$sql = "SELECT status FROM bill_log WHERE order_id='{$order_id}'";
		$return = $this->db->query($sql)->row_array();

		$status = 0;

		if($return){
			if($return["status"] == 1){
				$status = 1;
			}
		}

		echo $status;
	}

	//模拟回调
	public function payReturn(){
		$order_id = $this->input->post("order_id");
		$uid = $this->input->post("uid");
		$amount = $this->input->post("amount");
		$paytype = $this->input->post("paytype");

		$this->load->model("cash_model", "cash");

		$addBalance = $this->cash->addBalanceOnline($order_id, $uid, $amount, $paytype, "dfpay");

		echo $addBalance;
	}
}