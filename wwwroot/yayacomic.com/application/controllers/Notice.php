<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends MY_Controller {
	public function service(){
		$this->load->view("notice/service");
	}

	public function coin(){
		$this->load->view("notice/coin");
	}

	public function giftcoin(){
		$this->load->view("notice/giftcoin");
	}

	public function pay(){
		$this->load->view("notice/pay");
	}

	public function vip(){
		$this->load->view("notice/vip");
	}

	public function vipopen(){
		$this->load->view("notice/vipopen");
	}
}