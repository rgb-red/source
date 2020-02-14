var pageindex0, pageindex1, pageindex2, pageindex3, pageindex4, pageindex5, pageindex6, pageindex7;
var count0, count1, count2, count3, count4, count5, count6, count7;
var scrollTop0, scrollTop1, scrollTop2, scrollTop3, scrollTop4, scrollTop5, scrollTop6, scrollTop7;
var pagesize = 21;
var currentindex = 0;
var isenable = true;

$(function () {
    // 初始化第一页索引值
    currentindex = $('.selector-update-top-item.active').data('index');
    eval('pageindex' + currentindex + '=1');
    eval('count' + currentindex + '=21');

    // 日期选择
    $('.selector-update-top a').click(function () {
        var index = $(this).data('index');
        if (index >= 0 && index <= 7) {
            currentindex = index;
            var $updatedb = $('#updatedb' + index);
            var scrollTop = eval('scrollTop' + index) || 0;

            $('.manga-list-2').not($updatedb).hide();
            $(this).parent().children('a.active').removeClass('active');
            $(this).addClass('active');

            if (!$updatedb || $updatedb.length === 0) {
                $('.manga-list').append('<ul id="updatedb' + index + '" class="manga-list-2"></ul>');
            } else {
                $updatedb.show();
                return;
            }
            document.documentElement.scrollTop = scrollTop;
            appendhtml(index, 1);
        }
    });
});

/**
 * 滚动加载事件
 */
/*window.onscroll = function () {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    if (($("body").height() - scrollTop) <= document.documentElement.clientHeight) {
        var pageindex = eval('pageindex' + currentindex) || 0;
        var count = eval('count' + currentindex) || 0;
        if (count === pageindex * pagesize) {
            appendhtml(currentindex, ++pageindex);
        }
    }
    // 记录当前滚轮位置
    eval('scrollTop' + currentindex + '=' + document.documentElement.scrollTop);
}*/

/**
 * 追加html标签
 * @param {any} index
 * @param {any} pageindex
 */
function appendhtml(index, pageindex) {
    var $updatedb = $('#updatedb' + currentindex);
    if (!$updatedb || $updatedb.length === 0) {
        return;
    }
    if (isenable) {
        isenable = false;
        $.ajax({
            url: '/ajax/getDayUpdate?action=getupdatecomics&d=' + new Date().getTime(),
            method: 'POST',
            dataType: 'JSON',
            data: { DK: index },
            complete: function () {
                isenable = true;
            }, success: function (data) {
                if (data) {
                    var htmlstr = '';
                    $(data.list).each(function () {
                        htmlstr += '<li><div class="manga-list-2-cover" ><a href="/comic/detail/' + this['id'] + '"><img class="manga-list-2-cover-img" src="/comics/cover/'
                            + this['id'] + '.jpg"></a></div>';
                        htmlstr += '<p class="manga-list-2-title"><a href="/comic/detail/' + this['id'] + '">' + this['title'] + '</a></p>';
                        htmlstr += '<p class="manga-list-2-tip"><a href="/comic/detail/' + this['id'] + '">' + (parseInt(this["status"]) === 1 ? "完结 " : "最新 ") + '第' + this['chapter'] + '话</a></p></li>';
                    });
                    $updatedb.append(htmlstr);
                    eval('pageindex' + index + ' = ' + pageindex);
                    //eval('count' + index + ' = ' + (eval('count' + index) || 0) + ' + ' + data['UpdateComicItems'].length);
                    /*if (eval('count' + index) >= data['Count'] && $updatedb.children(".noDataFont").length === 0) {
                        $updatedb.append("<div class=\"noDataFont\" style=\"padding:10px;font-size:12px;color:#767676;text-align: center;\">主人，下面木有了~</div>");
                    }*/
                }
            }
        });
    }
}