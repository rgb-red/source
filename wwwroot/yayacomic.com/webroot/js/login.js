var regpwd = new RegExp("^[0-9A-Za-z\\-=\\[\\];,./~!@#$%^*()_+}{:?]{6,21}$");
var regemail = new RegExp("^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$");

$(function () {
    var imgUrl = '/ajax/getVerifyImg/code.jpg?t=' + new Date().getTime();
    $('.pic-verification-list div').each(function () {
        $(this).css('background-image', 'url(' + imgUrl + ')');
        $(this).bind('click', function () {
            var value = Number($(this).find('input[type=hidden]').val());
            $(this).find('input[type=hidden]').val(++value);
            $(this).css('background-position', $(this).css('background-position').split(' ')[0] + ' ' + ((value % 4) * 33.33) + '%');
        });
    });

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

    // 默认提示信息验证
    var hint = $.trim($('.toast').text());
    if (hint !== '' && hint.length > 0) {
        $('.toast').show();
        var timer = setTimeout(function () {
            $('.toast').hide().empty();
            clearTimeout(timer);
        }, 1500);
    }
});

/**
 * 刷新验证码
 */
function refreshcode() {
    var imgurl = '/ajax/getVerifyImg/code.jpg?t=' + new Date().getTime();
    $('.pic-verification-list div').each(function () {
        $(this).css('background-image', 'url(' + imgurl + ')');
        $(this).css('background-position', $(this).css('background-position').split(' ')[0] + ' 0');
        $(this).find('input[type=hidden]').val(0);
    });
    $('#txt_code').val("");
}

/**
 * 表单内容校验
 * 1登录，2注册，3找回密码
 * @param {any} action 
 */
function verifyform(action) {
    var result = true;
    var $name = (action === 1 ? $('#txt_name') : (action === 2 ? $('#txt_reg_name') : $('#txt_username')));
    var $pwd = action === 1 ? $('#txt_password') : $('#txt_reg_password');
    var $phone = $('#txt_phone');
    var $phonecode = $("#txt_phonecode");
    var $hint = $('.toast');
    if (action === 1 || action === 2) {
        if ($phone.length > 0) {
            if ($.trim($phone.val()) === "") {
                $hint.text("手机号码不填可是不行的哦~");
                return false;
            }
            if (!$phonecode || $.trim($phonecode.val()) === "") {
                $hint.text("短信验证码不填可是不行的哦~");
                return false;
            }
        }
        else {
            if (!$name || $.trim($name.val()) === '') {
                $hint.text(action === 1 ? '账号信息不填可是不行的哦~' : '邮箱不填可是不行的哦~');
                result = false;
            } else if (action === 2 && !regemail.test($name.val())) {
                $hint.text('主人，这看起来不像邮箱呢~');
                result = false;
            }
            if (result && (!$pwd || $.trim($pwd.val()) === '')) {
                $hint.text('密码不填可是不行的哦~');
                result = false;
            }
        }
    }
    switch (action) {
        case 2:
            var $pwd1 = $('#txt_reg_password2');
            if (result && (!$pwd1 || $.trim($pwd1.val()) === '')) {
                $hint.text('请再次输入密码');
                result = false;
            }
            if (result && $.trim($pwd.val()) !== $.trim($pwd1.val())) {
                $hint.text('两次输入的密码不一致，请重新输入');
                $pwd.val('');
                $pwd1.val('');
                result = false;
            }
            if (result && !regpwd.test($pwd.val())) {
                $hint.text('请输入6位及以上密码');
                $pwd.val('');
                $pwd1.val('');
                result = false;
            }
            if (result && !$('#ck_accepted').prop('checked')) {
                $hint.text('您必须同意使用协议后，才能提交注册。');
                result = false;
            }
            break;
        case 3:
            if (result && (!$name || $.trim($name.val()) === '')) {
                $hint.text('邮箱不填可是不行的哦~');
                result = false;
            }
            if (result && !regemail.test($name.val())) {
                $hint.text('亲，看起来不像邮箱呢~');
                result = false;
            }
            break;
        case 4:
            if (result && (!$name || $.trim($name.val()) === '')) {
                $hint.text('手机或者邮箱不填可是不行的哦~');
                result = false;
            }
            break;
    }
    if (result) {
        result = checkcode();
    }
    $(document.activeElement).blur();

    return result;
}

/**
 * 校验验证码
 */
function checkcode() {
    var result = false;
    var capacity = 'ri_' + $('.pic-verification-list input[type=hidden]').map(function () { return this.value }).get().join(',');
    $('#txt_code').val(capacity);
    $.ajax({
        method: 'POST',
        url: '/ajax/verify_code?d=' + new Date().getTime(),
        dataType: 'json',
        data: { code: capacity },
        async: false,
        success: function (data) {
            if (data.result === 'success') {
                result = true;
            }
            else {
                $('.toast').text('请点击下方图片，旋转至正确方向~');
                result = false;
                refreshcode();
            }
        },
        error: function (e) {

        }
    });

    return result;
}