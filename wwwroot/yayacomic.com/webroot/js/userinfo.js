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

    $("#uploadpic").change(function (e) {
        var file = e.target.files[0]; // 获取图片资源
        // 只能选择图片
        if (!file.type.match('image.*')) {
            return false;
        }
        var fd = new FormData();
        fd.append('file', file);
        fd.append('action', 'uploaduserpic');
        $.ajax({
            type: 'POST',
            url: '/dm115.ashx',
            dataType: 'json',
            data: fd,
            processData: false,  // 注意：不要 process data
            contentType: false,  // 注意：不设置 contentType
            success: function (result) {
                if (result && result['isSuccess'] && result['url']) {
                    $("#userheader").prop("src", result['url']);
                } else if (result['message']) {
                    $('.toast').text(result['message']);
                } else {
                    $('.toast').text('头像上传失败！');
                }
            }, complete: saveheader,
            fail: function (msg) {
                $('.toast').text(msg);
            }
        });
    });

    $(".save_nickname").click(function () {
        var username = $.trim($("#username").val());
        if (username === '') {
            $('.toast').text('主人，我该怎么称呼您呢？');
            $(document.activeElement).blur();
            return false;
        }
        if (getlength(username) < 2) {
            $('.toast').text('主人，您这么短...真的好吗？');
            $(document.activeElement).blur();
            return false;
        }
        if (getlength(username) > 10) {
            $('.toast').text('主人，您太长啦~人家受不的~');
            $(document.activeElement).blur();
            return false;
        }
        $.ajax({
            type: 'POST',
            url: '/ajax/nickname_post',
            dataType: 'json', 
            data: { username: username }, 
            success: function (r) {
                if (r.status == true) {
                    history.go(-1);
                } else{
                    $('.toast').text(r['msg']);
                    $(document.activeElement).blur();
                }
            }
        });
    });

    $(".save_phone").click(function () {
        var phone = $.trim($("#phone").val());
        if (phone === '') {
            $('.toast').text('主人，您..您的手机号是多少？');
            $(document.activeElement).blur();
            return false;
        }
        if (getlength(phone) < 11) {
            $('.toast').text('主人，您这么短...真的好吗？');
            $(document.activeElement).blur();
            return false;
        }
        if (getlength(phone) > 11) {
            $('.toast').text('主人，您太长啦~人家受不的~');
            $(document.activeElement).blur();
            return false;
        }
        $.ajax({
            type: 'POST',
            url: '/ajax/phone_post',
            dataType: 'json', 
            data: { phone: phone }, 
            success: function (r) {
                if (r.status == true) {
                    history.go(-1);
                } else{
                    $('.toast').text(r['msg']);
                    $(document.activeElement).blur();
                }
            }
        });
    });

    function saveheader(data) {
        if (data && data['responseJSON'] && data['responseJSON']['isSuccess'] && data['responseJSON']['url']) {
            $.ajax({
                type: 'POST',
                url: '/dm5.ashx',
                dataType: 'json',
                data: { headerurl: data['responseJSON']['url'], action: 'updateuserheader' },
                success: function (result) {
                    if (result && result['isSuccess']) {
                        $('.toast').text('头像更新成功！');
                    } else {
                        $('.toast').text('头像更新失败！');
                    }
                },
                fail: function (msg) {
                    alert(msg);
                }
            });
        }
    }
});


function getlength(value) {
    var length = value.length;
    for (var i = 0; i < value.length; i++) {
        if (value.charCodeAt(i) > 127) {
            length++;
        }
    }
    return length;
}
