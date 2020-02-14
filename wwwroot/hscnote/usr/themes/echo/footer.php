<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="footer">
    <div class="layui-col-md12 t-copy">
        <span class="layui-breadcrumb">
            <span>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?>.<?php $this->options->description(); ?></a></span>
            <span class="layui-hide-xs"><a href="https://hscnote.com/sitemap.xml" target="_blank" rel="nofollow">站点地图</a></span>/
            <script type="text/javascript" src="https://v1.cnzz.com/z_stat.php?id=1278053080&web_id=1278053080"></script>
        </span>
    </div>
</div>

<?php $this->footer(); ?>
</body>
</html>
