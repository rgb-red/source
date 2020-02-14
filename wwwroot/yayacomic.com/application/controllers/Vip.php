<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vip extends MY_Controller {
	public function index(){
		$this->load->view("vip/index");
	}

	public function record(){
		$this->load->view("vip/record");
	}

	public function open(){
		$this->load->view("vip/open");
	}
}