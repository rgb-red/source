<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>密码修改 - <?=SITE()["name"]?></title>
		<meta name="keywords" content="密码修改,<?=SITE()["keywords"]?>" />
		<meta name="Author" content="<?=SITE()["author"]?>" />
		<meta name="Description" content="密码修改,<?=SITE()["description"]?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" type="text/css" href="/css/reset.css?<?=VERSION()?>">
		<link rel="stylesheet" type="text/css" href="/css/style.css?<?=VERSION()?>">
		<link rel="stylesheet" href="/css/account.css?<?=VERSION()?>" />
		<script type="text/javascript" src="/js/lib/jquery.min.js?<?=VERSION()?>"></script>
	</head>
	<body class="bg-gray">
		<?php $this->load->view("layout/header", array("title"=>"密码修改"))?>
		<form action="/ajax/password_post" method="post">
			<div class="line-container">
				<input type="password" id="txtPasswordOld" name="txtPasswordOld" placeholder="请输入原密码" autocomplete="off">
				<input type="password" id="txtPasswordNew" name="txtPasswordNew" placeholder="请输入新密码（6-20位数字、字符和字母组成）" autocomplete="off">
				<input type="password" id="txtPasswordConfirm" name="txtPasswordConfirm" placeholder="请确认新密码" autocomplete="off"></div>
			<a href="javascript:if(submitverify())$('form').submit();" class="line-container-btn">确认修改</a>
			<div class="toast" style="display: none;"></div>
		</form>
		<div style="height:20px"></div>
		<?php $this->load->view("layout/footer")?>
		<script type="text/javascript">
			$(function() {
				$('.toast').bind('DOMNodeInserted',
				function() {
					var hint = $(this).text();
					if (hint !== '' && hint.length > 0) {
						var self = this;
						$(this).show();
						var timer = setTimeout(function() {
							$(self).hide().empty();
							clearTimeout(timer);
						},
						1500);
					} else {
						$(this).hide();
					}
				});
			});
			function submitverify() {
				var $oldpwd = $("#txtPasswordOld");
				var $newpwd = $("#txtPasswordNew");
				var $newpwdc = $("#txtPasswordConfirm");
				if ($.trim($oldpwd.val()) === '') {
					showMsg("旧密码不填可不行哦~");
					$(document.activeElement).blur();
					return false;
				}
				if ($.trim($newpwd.val()) === '') {
					showMsg("新密码不填可不行哦~");
					$(document.activeElement).blur();
					return false;
				}
				if ($.trim($newpwdc.val()) === '') {
					showMsg("确认密码不填可不行哦~");
					$(document.activeElement).blur();
					return false;
				}
				if ($.trim($newpwd.val()) !== $.trim($newpwdc.val())) {
					$newpwd.val("");
					$newpwdc.val("");
					showMsg("两次密码不一致，请重新输入");
					$(document.activeElement).blur();
					return false;
				}
				if ($.trim($newpwd.val()).length < 6 || $.trim($newpwd.val()).length > 50) {
					$newpwd.val("");
					$newpwdc.val("");
					showMsg("新密码格式有误，请重新输入");
					$(document.activeElement).blur();
					return false;
				}
				return true;
			}
			function showMsg(msg) {
				$('.toast').text(msg);
			}
			function changeSuccess() {
				$('.toast').text("修改成功！");
				var timeout = setTimeout(function() {
					history.back();
					clearTimeout(timeout);
				});
			}
			function changeFail(msg) {
				showMsg(msg);
			}
		</script>
	</body>

</html>