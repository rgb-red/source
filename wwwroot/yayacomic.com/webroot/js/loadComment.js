//加载页码
var loadPage = PAGEINDEX;
//加载数量
var loadCount = PAGEPCOUNT;
//加载标识
var loadSign = 0;
//滚动事件
window.onscroll = function () {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    if (($("body").height() - scrollTop) <= document.documentElement.clientHeight && loadSign == 0) {
        loadSign = 1;
        if (loadPage != 0 && loadPage <= parseInt(LIMITPAGE)) {
            loadPage++;
            //添加加载样式
            $(".footer").prepend("<div class='loading' style='color:#666666;font-size:13px;width:100%;text-align: center;'><img src='" + LOADINGIMAGE + "' style='margin-right: 10px;position: relative;top: 3px;'/></div>");
            //获取数据
            var cid = 0;
            if (typeof (CID) != "undefined") {
                cid = CID;
            }
            $.ajax({
                url: '/ajax/getComment?d=' + new Date().getTime(),
                data: { pageindex: loadPage, pagesize: loadCount, mid: cid },
                error: function (msg) {
                    //ShowDialog("服务器出现异常请重试");
                },
                success: function (json) {
                    re = json;
                    var objs = eval(json);
                    html = "";
                    for (var i = 0; i < objs.length; i++) {
                        var obj = objs[i];
                        html += '<li>';
                        html += '<div class="detail-list-comment-cover"><img src="' + obj.HeadUrl + '"></div>';
                        html += '<div class="detail-list-comment-info">';
                        html += '<p class="detail-list-comment-title">' + obj.Poster + '<a class="detail-list-comment-right zanbtn';
                        if (obj.IsPraise) {
                            html += " active";
                        }
                        html += '" href="javascript:void(0);" pid="' + obj.Id + '">';
                        if (obj.PraiseCount > 0) {
                            html += obj.PraiseCount + '</a></p>';
                        }
                        else {
                            html += '赞</a></p>';
                        }
                        html += '<p class="detail-list-comment-subtitle">' + obj.PostArea + ' ' + obj.PostTime + '</p>';
                        html += '<p class="detail-list-comment-content">' + obj.PostContent + '</p>';
                        html += '</div>';
                        html += '</li>';
                    }
                    $(".postlist").append(html);
                    $(".postlist").find(".zanbtn").click(function () {
                        praisepost($(this).attr("pid"), $(this));
                    });
                    $(".loading").remove();
                    loadSign = 0;
                }
            });
        }
        else {
            $(".loading").remove();
            loadSign = 0;
            $(".noMorePost").show();
        }
    }
}