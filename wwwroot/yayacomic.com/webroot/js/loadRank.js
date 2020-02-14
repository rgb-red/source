//加载页码
var loadPage_0 = 3;
var loadPage_1 = 3;
var loadPage_2 = 3;
var loadPage_3 = 3;
var loadPage_4 = 3;
//排行数
var rank_0 = 30;
var rank_1 = 30;
var rank_2 = 30;
var rank_3 = 30;
var rank_4 = 30;
var scrollTop0, scrollTop1, scrollTop2, scrollTop3, scrollTop4;
//加载数量
var loadCount = 10;
//加载标识
var loadSign = 0;
//滚动事件
window.onscroll = function () {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    if (($("body").height() - scrollTop) <= document.documentElement.clientHeight && loadSign == 0) {
        loadSign = 1;
        var myPage;
        var mySc;
        var myT = 1;
        var myMt = 0;
        //判断选择栏状态
        switch ($('.rank-selector .active').index() + 1) {
            case 0: loadPage_0++; myPage = loadPage_0; mySc = 0; break;
            case 1: loadPage_1++; if (loadPage_1 < 2) { myPage = loadPage_1; } else { myPage = 1; } mySc = 1; break;
            case 2: loadPage_2++; myPage = loadPage_2; mySc = 2; break;
            case 3: loadPage_3++; myPage = loadPage_3; mySc = 3; break;
            case 4: loadPage_4++; myPage = loadPage_4; mySc = 4; break;
        }
        /*if (myPage != 1) {
            //添加加载样式
            $("body").append("<div class='loading' style='padding-top:10px;font-size:12px;color:#767676;text-align: center;'>正在加载中...</div>");
            //获取数据
            $.ajax({
                url: 'pagerdata.ashx?d=' + new Date(),
                dataType: 'json',
                data: { t: myT, pageindex: myPage, sc: mySc == 0 ? 5 : mySc, mt: myMt },
                type: 'POST',
                success: function (data) {
                    if (data.length > 0) {
                        var result = '';
                        var myRank;
                        var logoPath;
                        switch (mySc) {
                            case 0: myRank = rank_0; logoPath = ""; break;
                            case 1: myRank = rank_1; logoPath = "_1"; break;
                            case 2: myRank = rank_2; logoPath = ""; break;
                            case 3: myRank = rank_3; logoPath = "_3"; break;
                            case 4: myRank = rank_4; logoPath = "_2"; break;
                        }
                        for (var n = 0; n < data.length; n++) {
                            if (myRank >= 999) {
                                switch (mySc) {
                                    case 0: loadPage_0 = 0; break;
                                    case 1: loadPage_1 = 0; break;
                                    case 2: loadPage_2 = 0; break;
                                    case 3: loadPage_3 = 0; break;
                                    case 4: loadPage_4 = 0; break;
                                }
                            }
                            else {
                                myRank++;
                                result += '<a href="' + data[n].Url + '" title="{cp.Title}"><li>';
                                result += '<div class="rank-list-cover"><img class="rank-list-cover-img" src="' + data[n].Pic + '" alt="' + data[n].Title + '漫画' + data[n].LastPartShowName + '"></div>';
                                result += '<div class="rank-list-info">';
                                result += '<div class="rank-list-info-left"><span class="rank-list-info-left-index top-' + myRank + '">' + myRank + '</span></div>';
                                result += '<div class="rank-list-info-right">';
                                result += '<p class="rank-list-info-right-title">' + data[n].Title + '</p>';
                                result += '<p class="rank-list-info-right-subtitle">' + data[n].Content + '</p>';
                                result += '</div>';
                                result += '</div></li></a>';
                            }
                        }
                        switch (mySc) {
                            case 0: rank_0 = myRank; break;
                            case 1: rank_1 = myRank; break;
                            case 2: rank_2 = myRank; break;
                            case 3: rank_3 = myRank; break;
                            case 4: rank_4 = myRank; break;
                        }
                        $("#rankList_" + mySc).append(result);
                        // if(mySc == 4){
                        //     $(".rankList").eq(4).append(result);
                        // }
                        // if(mySc == 1){
                        //     $(".rankList").eq(5).append(result);
                        // }
                    }
                    else {
                        switch (mySc) {
                            case 0: loadPage_0 = 0; break;
                            case 1: loadPage_1 = 0; break;
                            case 2: loadPage_2 = 0; break;
                            case 3: loadPage_3 = 0; break;
                            case 4: loadPage_4 = 0; break;
                        }
                        if ($(".noDataFont").length == 0) {
                            $("body").append("<div class=\"noDataFont\" style=\"padding:10px;font-size:12px;color:#767676;text-align: center;\">主人，下面木有了~</div>");
                        }
                    }
                    $(".loading").remove();
                    loadSign = 0;
                }
            });
            switch (mySc) {
            case 0: scrollTop0 = document.documentElement.scrollTop; break;
            case 1: scrollTop1 = document.documentElement.scrollTop; break;
            case 2: scrollTop2 = document.documentElement.scrollTop; break;
            case 3: scrollTop3 = document.documentElement.scrollTop; break;
            case 4: scrollTop4 = document.documentElement.scrollTop; break;
            }
        }
        else {
            switch (mySc) {
                case 0: loadPage_0 = 0; break;
                case 1: loadPage_1 = 0; break;
                case 2: loadPage_2 = 0; break;
                case 3: loadPage_3 = 0; break;
                case 4: loadPage_4 = 0; break;
            }
            if ($(".noDataFont").length == 0) {
                $("body").append("<div class=\"noDataFont\" style=\"padding:10px;font-size:12px;color:#767676;text-align: center;\">主人，下面木有了~</div>");
            }
            $(".loading").remove();
            loadSign = 0;
        }*/
        switch (mySc) {
            case 0: scrollTop0 = document.documentElement.scrollTop; break;
            case 1: scrollTop1 = document.documentElement.scrollTop; break;
            case 2: scrollTop2 = document.documentElement.scrollTop; break;
            case 3: scrollTop3 = document.documentElement.scrollTop; break;
            case 4: scrollTop4 = document.documentElement.scrollTop; break;
        }
    }
}