var lazy = $(".lazy"); /*懒惰加载图片标签*/
var allImg = lazy.length;
var host = "http://" + window.location.host;
var hosts = "https://" + window.location.host;

$(function(){
    //点击 显示/隐藏 页头页尾
    $('.view-main-1').click(function() {
        $('body').toggleClass('toolbar');
    });

    firstLoad();

    //监听滚动条
    window.onscroll= function(){
        var index = $("#lbcurrentpage").text(); //加载到第几张图片
        index = index > allImg - 1 ? allImg - 1 : index; //加载到最后一张则不再增加计数
        var positionTop = $(lazy[index]).offset().top; //此图片距离页面顶部位置
        var t = document.documentElement.scrollTop||document.body.scrollTop;    //滚动条位置

        //当滚动该图片1500px的时候加载该图片
        if(positionTop - t <= 1500){
            loadImg(index);
        }

        if(t == 0){
            ShowDialog("已经是第一页");
        }
    }

    //单页显示
    $(".jump-single").click(function(){
        $.cookie("SINGLE", 1);
        location.reload();
    });
});

//打开页面加载前3张图片
function firstLoad(nowImgIndex = 0){
    if(nowImgIndex == 3){
        return;
    }
    loadImg(nowImgIndex);
    nowImgIndex++;
    setTimeout(function(){firstLoad(nowImgIndex)}, 1000);
}

//加载图片
function loadImg(index){
    if(lazy[index].src != host + lazy[index].getAttribute("data-src") && lazy[index].src != hosts + lazy[index].getAttribute("data-src")){
        lazy[index].src = lazy[index].getAttribute("data-src");
        addLoadImg();
    }
}

//增加图片加载页码
function addLoadImg(){
    $("#lbcurrentpage").text(parseInt($("#lbcurrentpage").text()) + 1);
}