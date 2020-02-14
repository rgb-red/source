
//去重数组
var array_0 = [];
//加载数量
var loadCount = pagesize;

var loadPage1 = 1;
//加载标识
var loadSign = 0;
//初始化数组
$(function () {
    $("#manga-list-bar-right").click(function () {
        if ($("#manga-list-bar-right-down").is(":hidden")) {
            $("#manga-list-bar-right-down").show();
        }
        else {
            $("#manga-list-bar-right-down").hide();
        }
    });
    var len = $(".manga-list ul li").length;
    for (var i = len - pagesize; i < len; i++) {
        var mid = $(".manga-list ul li").eq(i).data("mid");
        array_0.push(mid);
        if (array_0.length > pagesize) {
            array_0.shift();
        }
    }
});
//滚动事件
window.onscroll = function () {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    if (($("body").height() - scrollTop) <= document.documentElement.clientHeight && loadSign == 0) {
        loadSign = 1;
        var loadPage;
        loadPage = loadPage1;
        if (loadPage != 0) {
            loadPage++;
            var isauthorize = 0;
            if (iscopyright == "True")
            {
                isauthorize = 1;
            }
            //添加加载样式
            $(".manga-list").append("<div class='loading' style='padding-top:10px;font-size:12px;color:#767676;text-align: center;'>正在加载中...</div>");
            //获取数据
            var type = $(".manga-list-bar .active").attr("data");
            var status = $(".manga-list-bar-right-down .active").attr("val");
            $.ajax({
                url: '/ajax/getList',
                dataType: 'json',
                data: { 
                    action: "getclasscomics", 
                    pageindex: loadPage, 
                    pagesize: 21,
                    type: type,
                    status: status
                },
                type: 'POST',
                success: function (data) {
                    var cStr = "";
                    var tempArr = [];
                    cStr = array_0.join(",");
                    tempArr = array_0;
                    if (data.UpdateComicItems && data.UpdateComicItems.length > 0) {
                        var result = '';
                        for (var n = 0; n < data.UpdateComicItems.length; n++) {
                            if (cStr.indexOf(data.UpdateComicItems[n].ID) == -1) {
                                tempArr.push(data.UpdateComicItems[n].ID);
                                if (tempArr.length > pagesize) {
                                    tempArr.shift();
                                }
                                result += '<li>';
                                result += '<div class="manga-list-2-cover">';
                                result += '<a href="/' + data.UpdateComicItems[n].UrlKey + '/"><img class="manga-list-2-cover-img" src="' + data.UpdateComicItems[n].ShowPicUrlB + '"></a>';
                                if (data.UpdateComicItems[n].Logo != '') {
                                    result += '<span class="manga-list-1-cover-logo-font">' + data.UpdateComicItems[n].Logo + '</span>';
                                }
                                result += '</div>';
                                result += '<p class="manga-list-2-title"><a href="/' + data.UpdateComicItems[n].UrlKey + '/">' + data.UpdateComicItems[n].Title + '</a></p>';
                                result += '<p class="manga-list-2-tip"><a href="/' + data.UpdateComicItems[n].LastPartUrl + '/">' + (data.UpdateComicItems[n].Status === 1 ? "完结 " : "最新 ") + data.UpdateComicItems[n].ShowLastPartName + '</a></p>';
                                result += '</li>';
                            }
                        }
                        $(".manga-list ul").append(result);
                        myResize();
                    }
                    else {
                        loadPage = 0;
                        if ($(".noDataFont").length == 0) {
                            $(".manga-list").append("<div class='noDataFont' style='padding-top:10px;font-size:12px;color:#767676;text-align: center;'>没有更多</div>");
                        }
                    }
                    $(".loading").remove();
                    loadSign = 0;
                    loadPage1 = loadPage;
                    array_0 = tempArr;
                }
            });
        }
        else {
            $(".loading").remove();
            loadSign = 0;
        }
    }
}

function myResize() {
    var itemWidth = $(".manga-list-2 li .manga-list-2-cover-img").width();
    $(".manga-list-2 li .manga-list-2-cover-img").css("height", itemWidth * 1.33 + "px");

}