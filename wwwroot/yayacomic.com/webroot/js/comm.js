$(function () {
    $(".closeopenvip").click(function () {
        $(".winopenvip").hide();
        $(".mask").hide();
      
    });
    $(".closenextchapter").click(function () {
        $(".winnextchapter").hide();
        $(".mask").hide();
    });
    if ($(".collection").length > 0) {
        var iscollection = false;
        $(".collection").each(function () {
            var collimg = $(this).find("img");
            if (collimg.attr("src").indexOf("book-list-bottom-right-2")!=-1)
            {
                iscollection = true;
            }
        });
    }
    $(".collection").click(function () {
        if (USERID == 0) {
            showLoginModal();
        }
        else {
            var page = 1;
            var cid = 0;
            if ("undefined" != typeof indexImg) {
                page = indexImg;
            }
            else if (typeof (DM5_PAGE) != "undefined") {
                page = DM5_PAGE;
            }
            else if (typeof (COMIC_MID) != "undefined") {
                cid = COMIC_MID;
            }
            var collection = $(this);
            var iscollection = false;
            var collimg = collection.find("img");
            if (collimg.attr("src").indexOf("detail-bottom-2")!=-1) {
                iscollection = true;
            }
            else if (collimg.attr("src").indexOf("-active") != -1) {
                iscollection = true;
            }
            if (iscollection) {
                $.ajax({
                    url: '/ajax/bookmarker_post?d=' + new Date().getTime(),
                    dataType: 'json',
                    data: { id: cid, uid: USERID, type: "delete" },
                    type: 'POST',
                    success: function (msg) {
                        if (msg.Value == "1") {
                            $(".collection").each(function () {
                                var collimg = $(this).find("img");
                                if (collimg.attr("src").indexOf("detail-bottom-2") != -1) {
                                    collimg.attr("src", collimg.attr("src").replace("detail-bottom-2", "detail-bottom-1"));
                                }
                                else if (collimg.attr("src").indexOf("-active") != -1) {
                                    collimg.attr("src", collimg.attr("src").replace("-active", ""));
                                }
                            });
                            ShowDialog("取消收藏");
                        }
                        else if (msg.Value == "0"){
                            ShowDialog("我跟不上您的速度啦w(ﾟДﾟ)w");
                        }
                        else if (msg.Value == "2") {
                            ShowDialog("取消收藏失败");
                        }
                        else {
                            ShowDialog("取消收藏失败");
                        }
                    }
                });
            }
            else {
                $.ajax({
                    url: '/ajax/bookmarker_post?d=' + new Date().getTime(),
                    dataType: 'json',
                    data: { id: cid, uid: USERID ,type: "add"},
                    type: 'POST',
                    success: function (msg) {
                        if (msg.Value == "1") {
                            $(".collection").each(function () {
                                var collimg = $(this).find("img");
                                if (collimg.attr("src").indexOf("detail-bottom-1") != -1) {
                                    collimg.attr("src", collimg.attr("src").replace("detail-bottom-1", "detail-bottom-2"));
                                }
                                else if (collimg.attr("src").indexOf("view-top-logo-1") != -1) {
                                    collimg.attr("src", collimg.attr("src").replace("view-top-logo-1", "view-top-logo-1-active"));
                                }
                            });
                            ShowDialog("收藏成功");
                        }
                        else if (msg.Value == "0"){
                            ShowDialog("我跟不上您的速度啦w(ﾟДﾟ)w");
                        }
                        else {
                            ShowDialog("收藏失败");
                        }
                    }
                });
            }
        }
    });
});

function ShowDialog(title) {
    $(".toast").text(title);
    $(".toast").show();
    setTimeout(function () {
        $(".toast").hide();
    }, 1000);
}

function showLoginModal() {
    if (typeof (CURRENTURL) != "undefined") {
        window.location.href = "/user/login?from="+CURRENTURL;
    }
    else {
        window.location.href = "/login/";
    }
}


function reLoad() {
    window.location.reload(true);
}

function openwinopenvip()
{
    $(".winopenvip").show();
    $(".mask").show();
}


function openwinnextchapter() {
    if ($(".winnextchapter").length > 0) {
        $(".winnextchapter").show();
        $(".mask").show();
    }
    else {
        if(typeof(DM5_CHAPTERENDURL)!="undefined")
        {
            window.location.href = DM5_CHAPTERENDURL;
        }
    }
}

function isLogin() {
    var ustatus = getLoginStatus();
    if (!ustatus || ustatus == "0") {
        return false;
    }
    return true;
}

function getLoginStatus() {
    return true;
}

function SetBookmarker(cid) {
    t = $(".cid_" + cid);
    var type = "add";
    if (t.hasClass("active")) {
        type = "delete";
    }
    $.ajax({
        url: '/ajax/bookmarker_post?d=' + new Date().getTime(),
        dataType: 'json',
        data: { id: cid, type: type },
        type: 'POST',
        success: function (msg) {
            if(msg.Value == "0"){
                ShowDialog("我跟不上您的速度啦w(ﾟДﾟ)w");
            }else{
                if(t.hasClass("active")){
                    t.removeClass("active");
                    t.html('收藏');
                }else{
                    t.addClass("active");
                    t.html('已收藏');
                }
            }
        }
    });
};


function getPostCheckStatus() {
    return 0;
}
function isPostCheck() {
    var ustatus = getPostCheckStatus();
    if (!ustatus || ustatus == "0") {
        return false;
    }
    return true;
}
