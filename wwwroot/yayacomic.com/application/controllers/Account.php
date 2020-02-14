<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {
	public function wallet(){
		if(!loginCheck()){
			rJump("", "/user/login");
		}

		$this->load->model("cash_model", "cash");

		$data["balance"] = $this->cash->getBalance();
		$data["fukaBalance"] = $this->cash->getFukaBalance();
		$data["fukaBalance"] = $data["fukaBalance"] ? $data["fukaBalance"] : 0;

		$this->load->view("account/wallet", $data);
	}

	public function recharge(){
		if(!loginCheck()){
			rJump("", "/user/login");
		}

		$uid = $_SESSION["uid"];
		$data["order_id"] = $order_id = createOrder();
		$data["tenToken"] = md5(md5("1000")."xo4iu12dfwe".md5($uid)."xoeif23v85kl".md5($data["order_id"]));
		$data["thirtyToken"] = md5(md5("3000")."xo4iu12dfwe".md5($uid)."xoeif23v85kl".md5($data["order_id"]));
		$data["sixtyToken"] = md5(md5("6000")."xo4iu12dfwe".md5($uid)."xoeif23v85kl".md5($data["order_id"]));
		$data["hundrenToken"] = md5(md5("10000")."xo4iu12dfwe".md5($uid)."xoeif23v85kl".md5($data["order_id"]));
		$data["twoHundrenToken"] = md5(md5("20000")."xo4iu12dfwe".md5($uid)."xoeif23v85kl".md5($data["order_id"]));
		$data["eightToken"] = md5(md5("88888")."xo4iu12dfwe".md5($uid)."xoeif23v85kl".md5($data["order_id"]));
		
		$this->load->view("account/recharge", $data);
	}

	public function record_recharge(){
		$this->load->view("account/record_recharge");
	}

	public function record_gift(){
		$this->load->view("account/record_gift");
	}

	public function record_consume(){
		$this->load->view("account/record_consume");
	}

	public function record_lostgift(){
		$this->load->view("account/record_lostgift");
	}
}