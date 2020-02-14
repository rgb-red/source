<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	原生方法：
	php.ini 必须开启以下扩展
	extension=php_exif.dll
	extension=php_mbstring.dll
	exif.encode_unicode = ISO-8859-15
	exif.decode_unicode_motorola = UCS-2BE
	exif.decode_unicode_intel    = UCS-2LE
	exif.encode_jis =
	exif.decode_jis_motorola = JIS
	exif.decode_jis_intel    = JIS
*/

class Source extends IMG_Controller {
	//输出图片 CI自带的GD方法
	public function Image($cid, $id, $status, $img, $md5){
		$imgPath = $this->config->item("getImgPath");
		if($md5 != md5($cid."a9".$id."b8".$status."c7".$img."d6") . ".jpg"){
			showImg($imgPath . "/img/error.jpg", 30);
		}

		$img_arr = $this->cache->redis->get("chapterImage:cid_" . $cid . ":status_" . $status . ":mid_" . $id);
		$img = explode(",", $img_arr["images"])[$img];
		$url = $imgPath . $img;

		$this->load->library('image_lib');
		$config['source_image'] = $url;
		$config['dynamic_output'] = true;
		$config['quality'] = 30;
		$init = $this->image_lib->initialize($config);
		
		if (!$init){
		    showImg($imgPath . "/img/error.jpg", 30);
		}

		$do = $this->image_lib->resize();

		if (!$do){
		    showImg($imgPath . "/img/error.jpg", 30);
		}
	}

	//使用原生方法
	public function images2(){
		$url = "D:/SVN/location/yy/webroot/comics/1/002.jpg";
		showImg($url);
	}
}