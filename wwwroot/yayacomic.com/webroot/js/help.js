$(function () {
    $(".feedback-main-textarea").bind("input propertychange", function () {
        $("#content").val($(this).val());
    });

    $(".feedback-main-input").bind("input propertychange", function () {
        $("#contact").val($(this).val());
    });

    $("#imgs_help").on("change", function (e) {
        var file = e.target.files[0];
        if (!file.type.match('image.*'))
            return false;
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function (arg) {
            var lihtml = "<li class=\"feedback-main-pic-item\">";
            lihtml += "<input type=\"hidden\" name=\"imgs[]\" value=\"" + arg.target.result + "\" />";
            lihtml += "<img class=\"feedback-main-pic-img\" src=\"" + arg.target.result + "\">";
            lihtml += "<a href=\"javascript:void(0);\" onclick=\"$(this).parent().remove();\"><img class=\"feedback-main-pic-del\" " +
                "src=\"/img/icon/feedback-main-pic-del.png\"></a>";
            lihtml += "</li>";
            $(".feedback-main-pic-container li").last().before(lihtml);
        }
    });

    $(".feedback-main-list li").click(function () {
        var type = Number($(this).data('type'));
        if ([0, 1, 2, 3].indexOf(type) !== -1) {
            $('.feedback-main-list li.active').removeClass('active');
            $(this).addClass('active');
            $("#type").val(type);
        }
    });

    $(".feedback-main-btn").click(function () {
        var center = $.trim($("#content").val());
        var number = $.trim($("#contact").val());
        var $hint = $("#hint");
        if (center === '') {
            $(".feedback-main-textarea").focus();
            $hint.text("请详细的描述你要反馈的问题内容");
            return false;
        }
        if (number === '') {
            $(".feedback-main-input").focus();
            $hint.text("请输入手机/QQ/Email内容");
            return false;
        }
    });
});

function ShowDialog(msg) {
    $("#hint").text(msg);
    var timeout = setTimeout(function () {
        clearTimeout(timeout);
        $("#hint").text('');
    },3000);
}