//加载页码
var loadPage = 1;
//加载数量
var loadCount = 10;
//加载标识
var loadSign = 0;
//滚动事件
window.onscroll = function () {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    if (($("body").height() - scrollTop) <= document.documentElement.clientHeight && loadSign == 0 ) {
        loadSign = 1;
        if(loadPage != 0){
            //添加加载样式
            //$("body").append("<div class='loading' style='padding-top:10px;font-size:12px;color:#767676;text-align: center;'>正在加载中...</div>");
            loadPage++;
            //获取数据
            $.ajax({
                url: 'pagerdataBBB.ashx?d=' + new Date(),
                dataType: 'json',
                data: { t: 7, pageindex: loadPage , f: _f , title: _title },
                type: 'POST',
                success: function (data) {
                    if(data.length > 0){
                        var result = '';
                        for(var n = 0;n < data.length;n++){
                            result += '<li>';
                            result += '<div class="book-list-cover"><a href="'+data[n].Url+'" title="'+data[n].Title+'"><img class="book-list-cover-img" src="'+data[n].Pic+'" alt="'+data[n].Title+'"></a></div>';
                            result += '<div class="book-list-info">';
                            result += '<a href="' + data[n].Url+'"><p class="book-list-info-title">'+data[n].Title+'</p>';
                            result += '<p class="book-list-info-desc">' + data[n].Content+'</p></a>';
                            result += '<p class="book-list-info-bottom">';
                            result += '<span class="book-list-info-bottom-item">'+data[n].Categorys+'</span>';
                            if(data[n].Status == "已完结"){
                                result += '<span class="book-list-info-bottom-right-font active">'+data[n].Status+'</span>';
                            }else{
                                result += '<span class="book-list-info-bottom-right-font">'+data[n].Status+'</span>';
                            }
                            result += '</p></div></li>';
                        }
                        $(".book-list").append(result);
                    }
                    else{
                        loadPage = 0;
                        if($(".noDataFont").length == 0){
                           $("body").append("<div class='noDataFont'>没有更多</div>");
                        }
                    }
                    $(".loading").remove();
                    loadSign = 0;
                }
            });
        }
        else{
            $(".loading").remove();
            loadSign = 0;
        }
    }
}