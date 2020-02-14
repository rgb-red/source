$(function () {
    if ($(".btnphonecodeget").length > 0 || $(".btnphonecodeget1").length > 0) {
        testTime();
    }
    $(".btnphonecodeget").click(function () {
        var action = 3;
        var parent = action === 1 ? ".login-modal" : ".right";
        var $hint = $('.toast');
        var phone = $(".txt_phone").val();
        $hint.text("");
        if (phone == '') {
            $hint.text("手机不填可是不行的哦~");
            return false;
        }
        var capacity = 'ri_' + $('.pic-verification-list input[type=hidden]').map(function () { return this.value }).get().join(',');
        $('#txt_code').val(capacity);
        var code = "";
        if ($('#txt_code').length > 0)
        {
            code = $('#txt_code').val();
        }
        if (!checkcode(action)) {
            $hint.text("请点击上方图片，旋转至正确方向~");
            return false;
        }
        var areacode = $(".select_areacode").val();
        $.ajax({
            url: '/phonecode.ashx?d=' + new Date().getTime(),
            dataType: 'json',
            data: { code: code, areacode: areacode, phone: phone },
            async: false,
            error: function (msg) {
            },
            success: function (json) {
                if (json.result === 'success') {
                    result = true;
                    startTime();
                    $hint.text("短信验证码已经发送至" + phone + ", 10分钟内有效")
                }
                else {
                    if ($hint.length > 0) {
                        $hint.text(json.msg);
                    }
                    //$(parent + ' .rotate-refresh').click();
                    result = false;
                }
            }
        });
    });

    $(".btnphonecodeget1").click(function () {
        var action = 3;
        var parent = action === 1 ? ".login-modal" : ".right";
        var $hint = $('.toast');
        var ischeck = $(this).attr("ischeck");
        $hint.text("");
        var phone = $(".txt_phone").val();
        if (phone == '') {
            $hint.text("手机不填可是不行的哦~");
            return false;
        }
        var areacode = $(".txt_areacode").val();
        $.ajax({
            url: '/phonecode.ashx?d=' + new Date().getTime(),
            dataType: 'json',
            data: { areacode: areacode, phone: phone, isval: 1, ischeck: ischeck },
            async: false,
            error: function (msg) {
            },
            success: function (json) {
                if (json.result === 'success') {
                    result = true;
                    startTime();
                    $hint.text("短信验证码已经发送至" + phone + ", 10分钟内有效")
                }
                else {
                    $hint.text(json.msg);
                    //$(parent + ' .rotate-refresh').click();
                    result = false;
                }
            }
        });
    });
});

function resetpwdbyphone()
{
    var $pwd = $(".txt_reg_password");
    var $pwd2 = $(".txt_reg_password2");
    var $hint = $('.toast');
    $hint.text("");
    var $phonecode = $(".txt_phonecode");
    if (!$pwd || $.trim($pwd.val()) === "") {
        $hint.text("密码不填可是不行的哦~");
        $pwd.focus().css({ outlineWidth: 1, outlineColor: "#fd113a" });
        return false;
    }
    else if (!$pwd2 || $.trim($pwd2.val()) === "") {
        $hint.text("新密码不填可是不行的哦~");
        $pwd.focus().css({ outlineWidth: 1, outlineColor: "#fd113a" });
        return false;
    }
    else if ($pwd.val() != $pwd2.val()) {
        $hint.text("两次密码输入不一致~");
        $pwd.focus().css({ outlineWidth: 1, outlineColor: "#fd113a" });
        $pwd2.focus().css({ outlineWidth: 1, outlineColor: "#fd113a" });
        return false;
    }
    else if (!$phonecode || $.trim($phonecode.val()) === "") {
        $phonecode.focus().css({ outlineWidth: 1, outlineColor: "#fd113a" });
        $hint.text("短信验证码不填可是不行的哦~");
        return false;
    }
}

function forgetpwdbyphone() {
    var $username = $(".right input[type=text][name=txt_username]");
    var $hint = $('.toast');
    $hint.text("");
    if (!$username || $.trim($username.val()) === "") {
        $tip.text("账号信息不填可是不行的哦~");
        $username.focus().css({ outlineWidth: 1, outlineColor: "#fd113a" });
        return false;
    } 
    if (!checkcode(3)) {
        $hint.text("请点击下方图片，旋转至正确方向~");
        return false;
    }
    return true;
}

function startTime() {
    var index = 60;
    if ($('.btnphonecodeget').length > 0) {
        $('.btnphonecodeget').hide();
        if ($('.btnphonecodeget').hasClass("a-code-get")) {
            $('.btnphonecodeget').parent().append('<a href="javascript:void(0);" class="a-code-get timer">重新获取(60)</a>');
        }
        else if ($('.btnphonecodeget').hasClass("input-con-code")) {
            $('.btnphonecodeget').parent().append('<a href="javascript:void(0);" class="input-con-code timer">重新获取(60)</a>');
        }
        else {
            $('.btnphonecodeget').parent().append('<a href="javascript:void(0);" class="code-get timer">重新获取(60)</a>');
        }
    }
    if ($('.btnphonecodeget1').length > 0) {
        $('.btnphonecodeget1').hide();
        if ($('.btnphonecodeget1').hasClass("a-code-get")) {
            $('.btnphonecodeget1').parent().append('<a href="javascript:void(0);" class="a-code-get timer">重新获取(60)</a>');
        }
        else if ($('.btnphonecodeget1').hasClass("input-con-code")) {
            $('.btnphonecodeget1').parent().append('<a href="javascript:void(0);" class="input-con-code timer">重新获取(60)</a>');
        }
        else {
            $('.btnphonecodeget1').parent().append('<a href="javascript:void(0);" class="code-get timer">重新获取(60)</a>');
        }
    }
    var date = new Date();
    $.cookie('phonecodemailTimer', date.getTime(), { expires: 7, path: '/' });
    var timer = setInterval(function () {
        index--;
        if (index == 0) {
            $('.timer').remove();
            if ($('.btnphonecodeget').length > 0) {
                $('.btnphonecodeget').show();
            }
            if ($('.btnphonecodeget1').length > 0) {
                $('.btnphonecodeget1').show();
            }
            clearInterval(timer);
        }
        else {
            $('.timer').text('重新获取(' + index + ')');
        }
    }, 1000);
}

function testTime() {
    if ($.cookie('phonecodemailTimer') != null) {
        var dateTime = $.cookie('phonecodemailTimer');
        var date = new Date();
        var dateTime1 = date.getTime();
        if (dateTime1 - dateTime < 60000) {
            var index = Math.ceil((60000 - (dateTime1 - dateTime)) / 1000);
            if ($('.btnphonecodeget').length > 0) {
                $('.btnphonecodeget').hide();
                if ($('.btnphonecodeget').hasClass("a-code-get")) {
                    $('.btnphonecodeget').parent().append('<a href="javascript:void(0);" class="a-code-get timer">重新获取(60)</a>');
                }
                else if ($('.btnphonecodeget').hasClass("input-con-code")) {
                    $('.btnphonecodeget').parent().append('<a href="javascript:void(0);" class="input-con-code timer">重新获取(60)</a>');
                }
                else {
                    $('.btnphonecodeget').parent().append('<a href="javascript:void(0);" class="code-get timer">重新获取(60)</a>');
                }
            }
            if ($('.btnphonecodeget1').length > 0) {
                $('.btnphonecodeget1').hide();
                if ($('.btnphonecodeget1').hasClass("a-code-get")) {
                    $('.btnphonecodeget1').parent().append('<a href="javascript:void(0);" class="a-code-get timer">重新获取(60)</a>');
                }
                else if ($('.btnphonecodeget1').hasClass("input-con-code")) {
                    $('.btnphonecodeget1').parent().append('<a href="javascript:void(0);" class="input-con-code timer">重新获取(60)</a>');
                }
                else {
                    $('.btnphonecodeget1').parent().append('<a href="javascript:void(0);" class="code-get timer">重新获取(60)</a>');
                }
            }
            var timer = setInterval(function () {
                index--;
                if (index == 0) {
                    $('.timer').remove();
                    if ($('.btnphonecodeget').length > 0) {
                        $('.btnphonecodeget').show();
                    }
                    if ($('.btnphonecodeget1').length > 0) {
                        $('.btnphonecodeget1').show();
                    }
                    clearInterval(timer);
                }
                else {
                    $('.timer').text('重新获取(' + index + ')');
                }
            }, 1000);
        }
    }
}
