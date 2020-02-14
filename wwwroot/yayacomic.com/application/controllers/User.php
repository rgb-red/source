<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	//个人中心
	public function center(){
		$this->load->view("user/center");
	}

	//登录
	public function login(){
		if(loginCheck() && !isset($_GET["ok"])){
			rJump("", "/");
		}

		$this->load->view("user/login");
	}

	//登出
	public function logout(){
		SESSION_DESTROY();
		rJump("", "/");
	}

	//忘记密码
	public function back(){
		if(loginCheck() && !isset($_GET["ok"])){
			rJump("", "/");
		}

		$this->load->view("user/back");
	}

	//注册
	public function register(){
		if(loginCheck() && !isset($_GET["ok"])){
			rJump("", "/");
		}

		$this->load->view("user/register");
	}

	//个人资料
	public function info(){
		if(!loginCheck()){
			rJump("", "/user/login");
		}

		$this->load->view("user/info");
	}

	//修改个人信息页
	public function change(){
		if(!loginCheck()){
			rJump("", "/user/login");
		}

		$type = $this->input->get("type");

		if(!in_array($type, array("nickname", "phone", "avatar"))){
			$this->load->view("404");
		}else{
			if(in_array($type, array("nickname","phone"))){
				$this->load->view("user/change");
			}
			else if($type == "avatar"){
				$avatar = $_SESSION["avatar"];
				if($avatar == 0){
					$data["avatar"] = "/img/icon/feedback-main-pic-add.png";
				}else{
					$data["avatar"] = "/uploads/avatar/" . $_SESSION["uid"] . ".jpg?" . $_SESSION["avatar"];
				}

				$this->load->view("user/change_avatar", $data);
			}
		}
	}

	//修改密码
	public function password(){
		if(!loginCheck()){
			rJump("", "/user/login");
		}
		
		$this->load->view("user/password");
	}

	//个人收藏
	public function bookmarker(){
		if(!loginCheck()){
			rJump("", "/user/login");
		}

		$this->load->model("home_model", "home");

		$uid = $_SESSION["uid"];
		$data["list"] = $this->home->getBookMarker($uid);

		$this->load->view("user/bookmarker", $data);
	}

	//个人阅读历史
	public function bookhistory(){
		if(!loginCheck()){
			rJump("", "/user/login");
		}

		$this->load->model("home_model", "home");

		$uid = $_SESSION["uid"];
		$data["list"] = $this->home->getBookHistory($uid);
		$data["authorList"] = $this->common->getAuthorList();
		
		$this->load->view("user/bookhistory", $data);
	}

	//帮助中心
	public function opinion(){
		$this->load->view("user/opinion");
	}
}
