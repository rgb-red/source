var lazy = $(".lazy"); /*懒惰加载图片标签*/
var date = new Date();
date.setTime(date.getTime() + 600 * 1000); //cookie 10分钟
var p = 1;

$(function(){
    $(document.body).css({ "overflow-y": "hidden"});
    $(document.body).scrollTop(0);
    show(VIPAD, DOTIP);

    //加载图片
    loadImg(0);
   
    //点击 显示/隐藏 页头页尾
    $('#clickAreaCenter').click(function() {
        $('body').toggleClass('toolbar');
    });

    //点击 上一页
    $('#clickAreaLeft').click(function() {
        if(p == 0){
            ShowDialog('这是第一页了');
        }else{
            p--;
            $("#lbcurrentpage").text(String(p));
            loadingImg();
            setTimeout("loadImg(p)", 1000);
        }
    });

    //点击 下一页
    $('#clickAreaRight').click(function() {
        if(p == parseInt(MAXIMG) - 1){
            ShowDialog('这是最后一页了');
        }else{
            p++;
            $("#lbcurrentpage").text(String(p));
            loadingImg();
            setTimeout("loadImg(p)", 1000);
            
        }
    });

    //隐藏VIP广告
    $("#guide_1").click(function(){
        $('.guide a').remove();
        $('#guide_1').hide();
        $('#guide_2').show();
        $.cookie('VIPAD', 0, {expires: date});
    });
    
    //隐藏操作提示
    $("#guide_2").click(function(){
        $('.guide').remove();
        $.cookie('DOTIP', 0, {expires: date});
        $(document.body).css({ "overflow-y": "auto"});
    });
});

//加载图片
function loadImg(p){
    lazy[0].src = $("#imglist").children("p").eq(p).text();
}

function loadingImg(){
    lazy[0].src = "/img/page_default_img.png";
    $('html,body').animate({scrollTop:0});
}

//vip广告和操作提示显示
function show(VIPAD, DOTIP){
    if(VIPAD == "1" && DOTIP == "1"){
        $('.guide').show();
    }
    else if(VIPAD == "0" && DOTIP == "1"){
        $('.guide a').remove();
        $('#guide_1').hide();
        $('#guide_2').show();
        $('.guide').show();
    }
    else if(VIPAD == "0" && DOTIP == "0"){
        $(document.body).css({ "overflow-y": "auto"});
    }
}

//跳转至长条显示
function jumpLong(){
    if(parseInt(VIPLEVEL) <= 0){
        $(".mask").show();
        $(".winopenvip").show();
    }else{
        $.cookie("SINGLE", 0);
        location.reload();
    }
}