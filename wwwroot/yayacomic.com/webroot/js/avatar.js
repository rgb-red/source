$(function () {
    $('.toast').bind('DOMNodeInserted', function () {
        var hint = $(this).text();
        if (hint !== '' && hint.length > 0) {
            var self = this;
            $(this).show();
            var timer = setTimeout(function () {
                $(self).hide().empty();
                clearTimeout(timer);
            }, 1500);
        } else {
            $(this).hide();
        }
    });


    $("#change_avatar").on("change", function (e) {
        var file = e.target.files[0];
        if (!file.type.match('image.*'))
            return false;
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function (arg) {
            var lihtml = "<li class=\"change-avatar-li new-avatar\">";
            lihtml += "<input type=\"hidden\" name=\"avatar\" value=\"" + arg.target.result + "\" />";
            lihtml += "<img class=\"feedback-main-pic-img\" src=\"" + arg.target.result + "\" style='width:86px;height:86px'>";
            lihtml += "<a href=\"javascript:void(0);\" onclick=\"$(this).parent().remove();\"><img class=\"feedback-main-pic-del\" " +
                "src=\"/img/icon/feedback-main-pic-del.png\"></a>";
            lihtml += "</li>";
            $(".feedback-main-pic-container li").last().before(lihtml);
            $(".add-avatar-img").remove();
        }
    });

    $(".save_avatar").click(function(){
        var isset = $(".change-avatar-li").hasClass("new-avatar");
        if(!isset){
            $('.toast').text('主人，给我看看您长什么样子嘛~');
        }else{
            $("form")[0].submit();
        }
    });
});