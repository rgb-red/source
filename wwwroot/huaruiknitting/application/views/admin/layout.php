<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=$this->SITE["sitename"]?> - 后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/layui/css/admin.css" media="all">
</head>
<!--网站由Hsc个人设计及开发，如果您有任何意见或建议请联系QQ:390798960-->
<body class="layui-layout-body">
    <div id="LAY_app">
        <div class="layui-layout layui-layout-admin">
            <div class="layui-header">
                <!-- 头部区域 -->
                <ul class="layui-nav layui-layout-left">
                    <li class="layui-nav-item layadmin-flexible" lay-unselect>
                        <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
                            <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                        </a>
                    </li>
                    <li class="layui-nav-item layui-hide-xs" lay-unselect>
                        <a href="<?=$this->SITE["front_url"]?>" target="_blank" title="前台">
                            <i class="layui-icon layui-icon-website"></i>
                        </a>
                    </li>
                    <li class="layui-nav-item" lay-unselect>
                        <a href="javascript:;" layadmin-event="refresh" title="刷新">
                            <i class="layui-icon layui-icon-refresh-3"></i>
                        </a>
                    </li>
                </ul>
                <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
                    <li class="layui-nav-item" lay-unselect>
                        <a lay-href="/admin/contact" layadmin-event="message" lay-text="留言管理">
                            <i class="layui-icon layui-icon-notice"></i>
                            <!-- 如果有新消息，则显示小圆点 -->
                            <span class="layui-badge-dot"></span>
                        </a>
                    </li>
                    <li class="layui-nav-item layui-hide-xs" lay-unselect>
                        <a href="javascript:;" layadmin-event="note">
                            <i class="layui-icon layui-icon-note"></i>
                        </a>
                    </li>
                    <li class="layui-nav-item" lay-unselect>
                        <a href="javascript:;">
                            <cite><?=$_SESSION["nickname"]?></cite></a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="/admin/user">个人中心</a></dd>
                            <hr>
                            <dd layadmin-event="logout" style="text-align: center;">
                                <a>退出</a>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item layui-hide-xs" lay-unselect>
                        <a href="javascript:;" layadmin-event="fullscreen">
                            <i class="layui-icon layui-icon-screen-full"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- 侧边菜单 -->
            <div class="layui-side layui-side-menu">
                <div class="layui-side-scroll">
                    <div class="layui-logo" lay-href="/admin/shouye">
                        <span>后台管理</span></div>
                    <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
                        <li data-name="home" class="layui-nav-item layui-nav-itemed">
                            <a href="javascript:;" lay-href="/admin/shouye" lay-tips="控制台" lay-direction="1">
                                <i class="layui-icon layui-icon-home"></i>
                                <cite>控制台</cite>
                            </a>
                        </li>
                        <li data-name="info" class="layui-nav-item">
                            <a href="javascript:;" lay-href="/admin/info" lay-tips="站点基本信息" lay-direction="2">
                                <i class="layui-icon layui-icon-website"></i>
                                <cite>站点基本信息</cite>
                            </a>
                        </li>
                        <li data-name="page" class="layui-nav-item">
                            <a href="javascript:;" lay-tips="页面管理" lay-direction="2">
                                <i class="layui-icon layui-icon-template"></i>
                                <cite>页面管理</cite>
                                <span class="layui-nav-more"></span>
                            </a>
                            <dl class="layui-nav-child">
                                <dd data-name="index">
                                    <a href="javascript:;">首页<span class="layui-nav-more"></span></a>
                                    <dl class="layui-nav-child">
                                        <dd><a lay-href="/admin/slide">轮播图</a></dd>
                                        <dd><a lay-href="/admin/about">关于华瑞</a></dd>
                                    </dl>
                                </dd>
                                <dd data-name="about">
                                    <a href="javascript:;">关于华瑞<span class="layui-nav-more"></span></a>
                                    <dl class="layui-nav-child">
                                        <dd><a lay-href="/admin/intro">公司简介</a></dd>
                                        <dd><a lay-href="/admin/speech">总经理致辞</a></dd>
                                        <dd><a lay-href="/admin/culture">企业文化</a></dd>
                                        <dd><a lay-href="/admin/factory">厂房设备</a></dd>
                                    </dl>
                                </dd>
                                <dd data-name="honor">
                                    <a lay-href="/admin/honor">荣誉资质</a>
                                </dd>
                            </dl>
                        </li>
                        <li data-name="product" class="layui-nav-item">
                            <a href="javascript:;" lay-tips="产品管理" lay-direction="2">
                                <i class="layui-icon layui-icon-auz"></i>
                                <cite>产品管理</cite>
                                <span class="layui-nav-more"></span>
                            </a>
                            <dl class="layui-nav-child">
                                <dd data-name="product_list">
                                    <a lay-href="/admin/product_list">产品列表</a>
                                </dd>
                            </dl>
                            <dl class="layui-nav-child">
                                <dd data-name="product_classify">
                                    <a lay-href="/admin/product_classify">分类管理</a>
                                </dd>
                            </dl>
                        </li>
                        <li data-name="news" class="layui-nav-item">
                            <a href="javascript:;" lay-href="/admin/news" lay-tips="新闻管理" lay-direction="2">
                                <i class="layui-icon layui-icon-template-1"></i>
                                <cite>新闻管理</cite>
                            </a>
                        </li>
                        <li data-name="contact" class="layui-nav-item">
                            <a href="javascript:;" lay-href="/admin/contact" lay-tips="留言管理" lay-direction="2">
                                <i class="layui-icon layui-icon-praise"></i>
                                <cite>留言管理</cite>
                            </a>
                        </li>
                        <li data-name="user" class="layui-nav-item">
                            <a href="javascript:;" lay-href="/admin/user" lay-tips="个人中心" lay-direction="2">
                                <i class="layui-icon layui-icon-user"></i>
                                <cite>个人中心</cite>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- 页面标签 -->
            <div class="layadmin-pagetabs" id="LAY_app_tabs">
                <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
                <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
                <div class="layui-icon layadmin-tabs-control layui-icon-down">
                    <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
                        <li class="layui-nav-item" lay-unselect>
                            <a href="javascript:;"></a>
                            <dl class="layui-nav-child layui-anim-fadein">
                                <dd layadmin-event="closeThisTabs">
                                    <a href="javascript:;">关闭当前标签页</a></dd>
                                <dd layadmin-event="closeOtherTabs">
                                    <a href="javascript:;">关闭其它标签页</a></dd>
                                <dd layadmin-event="closeAllTabs">
                                    <a href="javascript:;">关闭全部标签页</a></dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
                    <ul class="layui-tab-title" id="LAY_app_tabsheader">
                        <li lay-id="/admin/shouye" lay-attr="/admin/shouye" class="layui-this">
                            <i class="layui-icon layui-icon-home"></i>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- 主体内容 -->
            <div class="layui-body" id="LAY_app_body">
                <div class="layadmin-tabsbody-item layui-show">
                    <iframe src="/admin/shouye" frameborder="0" class="layadmin-iframe"></iframe>
                </div>
            </div>
            <!-- 辅助元素，一般用于移动设备下遮罩 -->
            <div class="layadmin-body-shade" layadmin-event="shade"></div>
        </div>
    </div>
<script src="/layui/js/layui.js"></script>
<script>layui.config({base: '/layui/js/'}).extend({index: 'index'}).use('index');</script>
</body>
</html>