<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');header("Content-type: text/html; charset=utf-8");

class MY_Controller extends CI_Controller {
	public function __construct (){
		parent::__construct();
		
		//全局加载数据库
		$this->load->model('common_model', 'common');

		//生成临时token
		if(!isset($_COOKIE["extraToken"])){
			$extraToken = md5(time() . mt_rand(0,99999999));
			setcookie("extraToken", $extraToken);
		}

		//全局开启SESSION
		SESSION_START();
	}
}

class IMG_Controller extends CI_Controller {
	public function __construct (){
		parent::__construct();

		//关闭php错误报告
		error_reporting(0); 
		
		//检测是否存在临时token
		//防止图片外链
		if(!isset($_COOKIE["extraToken"])){
			$imgPath = $this->config->item("getImgPath");
			showImg($imgPath . "/img/error2.jpg", 30);
		}
	}
}