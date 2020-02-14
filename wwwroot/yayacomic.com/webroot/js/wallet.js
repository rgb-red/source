function Wallet() {
    this.isloading = false;
}
/**
 * 追加内容
 */
Wallet.prototype.append = function () { }

/**
 * 加载中显示信息
 */
Wallet.prototype.loading = function() {
    $("body").append("<div class='loading' style='padding-top:10px;font-size:12px;color:#767676;text-align: center;'>正在加载中...</div>");
}

var wallet = new Wallet();
var myScroll;
$(function () {
    // 初始化滑动事件
    myScroll = new IScroll('#wrapper', {
        //scrollbars: true,
        mouseWheel: true,
        shrinkScrollbars: 'scale',
        click: true
    }).on('scrollEnd', function () {
        if (!wallet.isloading) {
            if (this.y === 0) {
            } else if (this.y === this.maxScrollY) {
                wallet.isloading = true;
                wallet.append();
                this.refresh();
                if (document.getElementById('scroller') && document.getElementById('scroller').offsetHeight + 60 >= document.getElementById('wrapper').clientHeight) {
                    $('#footer1').css({ display: 'block' });
                    $('#footer2').hide();
                }
            }
        }
    });
});

function isPassive() {
    var supportsPassiveOption = false;
    try {
        addEventListener('test', null, Object.defineProperty({}, 'passive', {
            get: function () {
                supportsPassiveOption = true;
            }
        }));
    } catch (e) { }
    return supportsPassiveOption;
}

//初始化绑定iScroll控件
document.addEventListener('touchmove', function (e) { e.preventDefault(); }, isPassive() ? {
    capture: false,
    passive: false
} : false);


function pushHistory(replaceUrl) {
    location.replace(replaceUrl);
}