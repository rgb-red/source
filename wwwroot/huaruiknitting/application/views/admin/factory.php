<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>页面设置：关于华瑞 > 厂房设备</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/layui/css/admin.css" media="all">
    <style>
        .add-img{
            text-align:center;
            background-color:white;
        }
        .del-btn{
            position:absolute;
            top:10px;
            right:10px;
            background-color:#ff5722;
            border-radius:50px;
            text-align:center;
            line-height:25px;
            width:25px;
            height:25px;
        }
        .del-btn i{
            margin:4px;
            font-size:14px;
            font-weight:1000;
            color:white;
        }
    </style>
</head>
<body>
<div class="layui-fluid layadmin-cmdlist-fluid">
	<div class="layui-row layui-col-space30">
        <?php foreach($slide as $v):?>
        <div class="layui-col-md2 layui-col-sm4 slide_item" data-id="<?=$v["id"]?>">
            <div class="cmdlist-container">
				<div href="javascript:;" class="layui-col-lg12" style="text-align:center">
                    <img src="<?=$this->SITE["front_url"]?>/uploads/factory/<?=$v["id"]?>.jpg" width="100%" height="150px">
                </div>
                <p style="text-align:center">顺序：<a class="set-sort" href="javascript:;" data-sort="<?=$v["sort"]?>"><?=$v["sort"]?></a></p>
                <p style="text-align:center">中文：<a class="set-title" href="javascript:;" data-title="<?=$v["title"]?>"><?php if($v["title"]){echo $v["title"];}else{echo "未设置";}?></a></p>
                <p style="text-align:center">英文：<a class="set-en-title" href="javascript:;" data-en-title="<?=$v["en_title"]?>"><?php if($v["en_title"]){echo $v["en_title"];}else{echo "未设置";}?></a></p>
			</div>
            <div class="del-btn">
                <a href="javascript:;"><i class="layui-icon layui-icon-close"></i></a>
            </div>
		</div>
        <?php endforeach;?>
        <input class="img-choose" type="file" accept=".jpg" style="display:none">
        <div class="layui-col-md2 layui-col-sm4 add-slide">
            <div class="cmdlist-container">
				<a href="javascript:;" class="layui-col-lg12 add-img">
                    <img src="/images/add.jpg" width="100%" height="150px">
                </a>
				<a href="javascript:;">
                    <p style="text-align:center">点击添加图片</p>
				</a>
			</div>
        </div>
	</div>
</div>
</body>
<script src="/js/jquery.min.js"></script>
<script src="/layui/js/modules/layer.js"></script>
<script>

    //设置排序
    $(".set-sort").click(function(){
        var id = $(this).parents(".slide_item").attr("data-id")
        var sort = $(this).attr("data-sort")
        
        layer.prompt({
            value: sort,
            title: '请输入纯数字（数值越大，排序越靠后）',
        }, function(value, index, elem){
            if(!is_num(value)){
                error_tip("请输入纯数字", index)
            }else{
                $.ajax({
                    method: "POST",
                    url: "/ajax/set_factory_sort",
                    data:{id: id, sort: value},
                    success: function(data){
                        if(data == 1){
                            success_tip(index)
                        }
                        else if(data == 2){
                            error_tip("请输入纯数字", index)
                        }else{
                            error_tip("修改失败，请刷新后重试", index)
                        }
                    },
                    error: function(){
                        error_tip("系统错误，请刷新后重试", index)
                    }
                });
            }
        });
    });

    //设置名称
    $(".set-title").click(function(){
        var obj = $(this)
        var id = obj.parents(".slide_item").attr("data-id")
        var title = obj.attr("data-title")
        
        
        layer.prompt({
            value: title,
            title: '名称（中文）',
        }, function(value, index, elem){
            $.ajax({
                method: "POST",
                url: "/ajax/set_factory_title",
                data:{id: id, type:1, title: value},
                success: function(data){
                    if(data == 1){
                        obj.text(value)
                        obj.attr("data-title", value)
                        layer.close(index)
                    }else{
                        error_tip("修改失败，请刷新后重试", index)
                    }
                },
                error: function(){
                    error_tip("系统错误，请刷新后重试", index)
                }
            });
        });
    });

    //设置名称
    $(".set-en-title").click(function(){
        var obj = $(this)
        var id = obj.parents(".slide_item").attr("data-id")
        var title = obj.attr("data-title")
        
        
        layer.prompt({
            value: title,
            title: '名称（英文）',
        }, function(value, index, elem){
            $.ajax({
                method: "POST",
                url: "/ajax/set_factory_title",
                data:{id: id, type:2, title: value},
                success: function(data){
                    if(data == 1){
                        obj.text(value)
                        obj.attr("data-title", value)
                        layer.close(index)
                    }else{
                        error_tip("修改失败，请刷新后重试", index)
                    }
                },
                error: function(){
                    error_tip("系统错误，请刷新后重试", index)
                }
            });
        });
    });

    //删除图片
    $(".del-btn").click(function(){
        var obj = $(this)
        layer.confirm("删除后无法恢复，确认删除该图片？", {
			title: "提示",
			btn: ['确定','取消'] //按钮
		},function(index){
            var id = obj.parents(".slide_item").attr("data-id")
            $.ajax({
                method: "POST",
                url: "/ajax/del_factory",
                data:{id: id},
                success: function(data){
                    if(data == 1){
                        success_tip(index)
                    }else{
                        error_tip("删除失败，请刷新后重试", index)
                    }
                },
                error: function(){
                    error_tip("系统错误，请刷新后重试", index)
                }
            });
		});
    });

    //添加按钮
    $(".add-slide").click(function(){
        $(".img-choose").click();
    });

    //上传图片事件
	$(".img-choose").change(function(){
		var load_layer = layer.load(2);

		var data = new FormData();
		img = $(this)[0].files[0];
		data.append("img", img);

		$.ajax({
			method: "POST",
			url: "/ajax/add_factory",
			processData: false,
			contentType: false,
			data:data,
			success: function(data){
				if(data == 1){
					success_tip()
				}else{
					error_tip("添加失败，请刷新后重试", load_layer)
				}
			},
			error: function(){
				error_tip("系统错误，请刷新后重试", load_layer)
			}
		});
	});
    

    //验证是否纯数字
    function is_num(value){
        if(!/^[0-9]*$/.test(value)){
            return false
        }else{
            return true
        }
    }

    function success_tip(elem = ""){
        if(elem){
            layer.close(elem)
        }
        
		layer.alert('修改成功',{icon: 1}, function(){
			window.location.reload()
		});
	}

	function error_tip(msg, elem){
		layer.close(elem)
		layer.alert(msg, {icon: 5}, function(index){
			layer.close(index);
		});
	}
</script>
</html>