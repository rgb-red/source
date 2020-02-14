<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>消息中心</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/layui/css/admin.css" media="all">
</head>
<body>
<div class="layui-fluid" id="LAY-app-message">
	<div class="layui-card">
		<div class="layui-tab layui-tab-brief">
			<ul class="layui-tab-title">
				<li class="layui-this">
					全部消息
					<span class="layui-badge no_read"><?php echo $no_read ? $no_read : 0;?></span>
				</li>
			</ul>
			<div class="layui-tab-content">
				<div class="layui-tab-item layui-show">
					<div class="LAY-app-message-btns" style="margin-bottom: 10px;">
						<button class="layui-btn layui-btn-primary layui-btn-sm" data-type="all" data-events="del">删除</button>
						<button class="layui-btn layui-btn-primary layui-btn-sm" data-type="all" data-events="ready">标记已读</button>
						<button class="layui-btn layui-btn-primary layui-btn-sm" data-type="all" data-events="no_ready">标记未读</button>
						<button class="layui-btn layui-btn-primary layui-btn-sm" data-type="all" data-events="readyAll">全部已读</button>
					</div>
					<table id="LAY-app-message-all" lay-filter="LAY-app-message-all">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="/layui/js/layui.js"></script>
<script>
  layui.config({
    base: '/layui/js/' //静态资源所在路径
  }).extend({
    index: 'index' //主入口模块
  }).use(['index', '../lib/message']);
  </script>
</body>
</html>