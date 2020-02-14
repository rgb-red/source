<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>花边 - 搜索 - 博罗县华瑞针织实业有限公司</title>
    <meta name="keywords" content="花边,内衣超薄面料,内衣提花面料,内衣网布,睡衣,功能性面料" />
    <meta name="description" content="花边,内衣超薄面料,内衣提花面料,内衣网布,睡衣,功能性面料" />
    <meta name="applicable-device" content="pc,mobile" />
    <link href="/css/bootstrap.css" rel="stylesheet" />
    <link href="/css/bxslider.css" rel="stylesheet" />
    <link href="/css/style.css" rel="stylesheet" />
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bxslider.min.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/bootstrap.js"></script>
</head>
<body>
    <?php $this->load->view("layout/header")?>
    <div class="page_bg" style="background: url(/images/detail_bg.jpg) center top no-repeat;"></div>
    <div class="bread_bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="bread_nav">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                        <a href='/'>主页</a>>
                        <a href='javascript:;'>搜索</a>>
                        <a href='javascript:;'>花边</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- left -->
            <div class="col-xs-12 col-sm-4 col-md-3">
                <h3 class="left_h3"><span>搜索</span></h3>
                <div class="left_column">
                    <ul class="left_nav_ul" id="firstpane">
                        <li><a href="javascript:;" class="biglink left_active">搜索结果</a></li>
                    </ul>
                </div>
                <?php $this->load->view("layout/news_sidebar")?>
            </div>
            <!-- right -->
            <div class="col-xs-12 col-sm-8 col-md-9" style="float:right">
                <div class="right_head">
                    <h2><span>搜索结果</span></h2>
                </div>
                <div class="product_list product_list2">
                    <div class="col-sm-4 col-md-4 col-mm-6 product_img">
                        <a href="javascript:;" title="保暖衣">
                            <img src="/uploads/product/7.jpg" alt="保暖衣" class="img-thumbnail" />
                        </a>
                        <p class="product_title">
                            <a href="javascript:;" title="保暖衣">保暖衣</a>
                        </p>
                    </div>
                    <div class="col-sm-4 col-md-4 col-mm-6 product_img">
                        <a href="javascript:;" title="保暖衣">
                            <img src="/uploads/product/8.jpg" alt="保暖衣" class="img-thumbnail" />
                        </a>
                        <p class="product_title">
                            <a href="javascript:;" title="保暖衣">保暖衣</a>
                        </p>
                    </div>
                    <div class="col-sm-4 col-md-4 col-mm-6 product_img">
                        <a href="javascript:;" title="保暖衣">
                            <img src="/uploads/product/9.jpg" alt="保暖衣" class="img-thumbnail" />
                        </a>
                        <p class="product_title">
                            <a href="javascript:;" title="保暖衣">保暖衣</a>
                        </p>
                    </div>
                    <div class="pages">
                        <ul>
                            <li>
                                <span class="pageinfo">
                                    共
                                    <strong>1</strong>
                                    页
                                    <strong>9</strong>
                                    条记录
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view("layout/footer")?>
</body>
</html>