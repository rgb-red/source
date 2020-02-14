var commentPID = 0;
var commentUser = '';
var zanbtn;
$(function () {
    zanbtn = $(".zanbtn");
    if (POSTCOUNT > 0) {
        getPost(PAGEINDEX, PAGEPCOUNT, TIEBATOPICID);
    }
    zanbtn.click(function () {
        praisepost($(this).attr("pid"), $(this));
    });
    $(".comment-input").click(function ()
    {
        if (!isLogin()) {
            showLoginModal();
            return false;
        }
        if (isPostCheck()) {
            showCheckPostModal();
            return false;
        }
    });
    $(".win-comment-btn").click(function () {
        var btn = $(this);
        if (commentVerify()) {
            commentSubmit(function () {
                btn.data('isenable', 1);
            });
        }
    });
    $(".recommentbtn").click(function () {
        if (!isLogin()) {
            showLoginModal();
            return false;
        }
        if (isPostCheck()) {
            showCheckPostModal();
            return false;
        }
        $(".win-comment-btn").text("回复评论");
        commentPID = $(this).attr("pid");
        $(".comment-input").val("");
        $('.comment-input').attr('placeholder', '@' + $(this).attr("poster"));
        $(".comment-input").attr("tocommentuser", $(this).attr("poster"));
    });

    $(".footer").prepend("<p class='noMorePost' hidden>人家下面你都看完了   ⁄(⁄ ⁄•⁄ω⁄•⁄ ⁄)⁄   还想怎样啦~</p>");
});

function commentSubmit(callback) {
    var _commentInput = $(".comment-input");
    var content = _commentInput.val();
    var tocommentuser = _commentInput.attr('tocommentuser');
    if (tocommentuser != '' && tocommentuser != null && tocommentuser != undefined) {
        content = '@' + tocommentuser + ' ' + content;
    }

    var code = "";
    if (commentPID != 0) {
        if (content.indexOf("@" + commentUser) == -1) {
            commentPID = 0;
            commentUser = "";
        }
    }
    var cid = 0;
    if (typeof (CID) != "undefined") {
        cid = CID;
    }
    $.ajax({
        url: '/ajax/comment_post?d=' + new Date().getTime(),
        type: 'POST',
        dataType: 'json',
        data: { message: content, cid: cid},
        error: function (msg) {
            ShowDialog("评论发生异常，请重试");
            if (callback != undefined)
                callback();
        },
        success: function (json) {
            if (json.msg == 'success') {
                if ($(".commentcount").length > 0) {
                    if (POSTCOUNT < 999) {
                        POSTCOUNT++;
                        $(".commentcount").html(POSTCOUNT);
                    }
                }
                if ($(".nocomments").length > 0) {
                    $(".nocomments").hide();
                }
                if (commentPID > 0) {
                    ShowDialog("回复成功了♪(^∇^*)");
                }
                else {
                    ShowDialog("评论成功了♪(^∇^*)");
                }
                commentPID = 0;
                commentUser = "";
                $(".comment-input").val("");
                $('.comment-input').attr('placeholder', "");
                $('.comment-input').attr('tocommentuser', "");
                if (typeof (PAGETYPE) != "undefined") {
                    if (PAGETYPE == 9) {
                        getPost(PAGEINDEX, PAGEPCOUNT, TIEBATOPICID);
                    }
                    else if (PAGETYPE == 4) {
                        getMangaPost(PAGEINDEX, PAGEPCOUNT, COMIC_MID);
                    }
                }
            }
            else if (json.msg == 'nologin') {
                window.location.href = "/user/login?from=" + CURRENTURL;
            }
            else if (json.msg == 'lengthLess5') {
                ShowDialog("您的话太少了，都还没有5个字");
            }
            else if (json == 500){
                return;
            }
            else {
                ShowDialog(json.msg);
            }

            if (callback != undefined)
                callback();
        }
    });
}

function praisepost(id, t) {
    if (!isLogin()) {
        showLoginModal();
        return false;
    }
    if (isPostCheck()) {
        showCheckPostModal();
        return false;
    }
    var praise = 0;
    if (!$(t).hasClass("active")) {
        praise = 1;
    }
    
    $.ajax({
        url: '/ajax/praise_post?d=' + new Date().getTime(),
        dataType: 'json',
        data: { pid: id, praise: praise },
        error: function (msg) {
            ShowDialog("操作出现异常");
        },
        success: function (json) {
            if (json.msg == 'success') {
                if (!$(t).hasClass("active")) {
                    $(t).addClass("active");
                    var praisecount = parseInt($(t).text());
                    if (isNaN(praisecount)) {
                        praisecount = 0;
                    }
                    praisecount++;
                    $(t).text(praisecount);
                    ShowDialog("点赞成功♪(^∇^*)");
                }
                else {
                    $(t).removeClass("active");
                    var praisecount = parseInt($(t).text());
                    if (isNaN(praisecount)) {
                        praisecount = 0;
                    }
                    if (praisecount > 0) {
                        praisecount--;
                    }
                    if (praisecount == 0) {
                        $(t).text("赞");
                    }
                    else {
                        $(t).text(praisecount);
                    }
                    ShowDialog("取消点赞成功♪(^∇^*)");
                }
            }
            else if(json.msg == 'nologin'){
                window.location.href = "/user/login?from=" + CURRENTURL;
            }
            else if(json == 500){
                ShowDialog("您这么快...︿(￣︶￣)︿真的好吗？");
            }
            else {
                if (!$(t).hasClass("active")) {
                    ShowDialog("点赞失败了(￣_,￣ )");
                }
                else {
                    ShowDialog("取消点赞成功♪(^∇^*)");
                }
            }
        }
    });
}

function commentVerify() {
    if (!isLogin()) {
        showLoginModal();
        return false;
    }
    if (isPostCheck()) {
        showCheckPostModal();
        return false;
    }
    var content = $(".comment-input").val();
    if (content.length < 5) {
        ShowDialog("评论字数不能小于5个");

        return false;
    }
    else {
        return true;
    }
}

function getMangaPost(pageindex, pagesize, mid, type) {
    var html = "<div style=\"color:#666666;font-size:13px;width:830px;height:25px;text-align: center;\"><img src=\"" + LOADINGIMAGE +
        "\" style=\"margin-right: 10px;position: relative;top: 3px;\">加载中</div>";
    $(".detail-list-comment").html(html);
    $.ajax({
        url: 'pagerdata.ashxCCC?d=' + new Date().getTime(),
        data: { pageindex: pageindex, pagesize: pagesize, mid: mid, t: type },
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
                html += '<p class="detail-list-comment-subtitle">'+ obj.PostTime + '</p>';
                html += '<p class="detail-list-comment-content recommentbtn" pid="' + obj.Id + '" poster="' + obj.Poster + '"  >' + obj.PostContent + '</p>';
                html += '</div>';
                html += '</li>';
            }
            $(".detail-list-comment").append(html);
            $(".detail-list-comment").find(".zanbtn").click(function () {
                praisepost($(this).attr("pid"), $(this));
            });
            $(".detail-list-comment").find(".recommentbtn").click(function () {
                if (!isLogin()) {
                    showLoginModal();
                    return false;
                }
                if (isPostCheck()) {
                    showCheckPostModal();
                    return false;
                }
                commentPID = $(this).attr("pid");
                $(".comment-input").val("");
                $(".comment-input").attr("tocommentuser", $(this).attr("poster"));
                $('.comment-input').attr('placeholder', '@' + $(this).attr("poster"));
                $(".mask").show();
                $(".win-comment").show();
            });
        }
    });
}

function getPost(pageindex, pagesize, tid) {
    $(".nocomments").hide();
    var html;
        html = "<div class='loading' style=\"color:#666666;font-size:13px;width:100%;text-align: center;margin-top: 50px;height:25px;\"><img src=\"" +
            LOADINGIMAGE + "\" style=\"margin-right: 10px;position: relative;top: 3px;\">加载中</div>";
    $(".postlist").html(html);
    var cid = 0;
    if (typeof (CID) != "undefined") {
        cid = CID;
    }
    $.ajax({
        url: '/ajax/getComment?d=' + new Date().getTime(),
        data: { pageindex: pageindex, pagesize: pagesize, mid: cid },
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
                html += '<p class="detail-list-comment-subtitle">'+ obj.PostTime + '</p>';
                html += '<p class="detail-list-comment-content recommentbtn" pid="' + obj.Id + '" poster="' + obj.Poster + '"  >' + obj.PostContent + '</p>';
                html += '</div>';
                html += '</li>';
            }
            $(".postlist").html(html);
            $(".postlist").find(".zanbtn").click(function () {
                praisepost($(this).attr("pid"), $(this));
            });
            if (typeof (loadPage) != "undefined") {
                 loadPage = PAGEINDEX;
            }
            if (typeof (loadPage) != "undefined") {
                loadCount = PAGEPCOUNT;
            }
            $(".postlist").find(".recommentbtn").click(function () {
                if (!isLogin()) {
                    showLoginModal();
                    return false;
                }
                if (isPostCheck()) {
                    showCheckPostModal();
                    return false;
                }
                commentPID = $(this).attr("pid");
                $(".comment-input").val("");
                $(".win-comment-btn").text("回复评论");
                $(".comment-input").attr("tocommentuser", $(this).attr("poster"));
                $('.comment-input').attr('placeholder', '@' + $(this).attr("poster"));
                $(".mask").show();
                $(".win-comment").show();
            });
        }
    });
}

function showCheckPostModal()
{
    if ($(".checkpost-mask").length <= 0) {
        var html = '';
        html += '<div class="checkpost-mask" id="checkpost-mask"></div>';
        html += '<div class="checkpost-win">';
        html += '<p class="checkpost-win-title">您尚未验证手机号</p>';
        html += '<p class="checkpost-win-tip">依照《移动互联网应用程序信息服务管理规定》，通过实名认证后才能进行发帖、评论等操作。请先绑定手机号完成实名认证。</p>';
        html += '<a href="javascript:void(0);" class="checkpost-win-btn" >下次再说</a>';
        html += '<a href="/bindphone/" class="checkpost-win-btn">去验证</a>';
        html += '</div>';
        $("body").append(html);
        $(".checkpost-win-btn").click(function(){
            $('.checkpost-mask').hide();
            $('.checkpost-win').hide();
        });
        $('.checkpost-mask').show();
        $('.checkpost-win').show();
    }
    else {
        $(".checkpost-mask").show();
        $(".checkpost-win").show();
    }
}

