<div class="normal-top">
	<a href="javascript:history.back();">
		<img class="normal-top-back" src="/img/icon/normal-top-back.png?<?=VERSION()?>" alt="后退"></a>
	<span class="normal-top-title"><?=$title?></span>
	<?php if(!isset($type)):?>
	<div class="normal-top-right loginInfo">
		<a href="javascript:pushHistory('/home/search');">
			<img class="normal-top-right-search" src="/img/icon/search.png?<?=VERSION()?>">
		</a>
		<?php if(!loginCheck()):?>
		<a href="/user/login">
			<b><span>登录</span></b>
		</a>
		<?php else:?>
		<a href="/user/center">
			<img class="normal-top-right-avatar" src="<?=getAvatar()?>">
		</a>
		<?php endif;?>
	</div>
	<?php endif;?>
</div>