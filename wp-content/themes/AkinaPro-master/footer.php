<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Akina
 */

?>

	</div><!-- #content -->


	 <?php
			if(akina_option('general_disqus_plugin_support')=='1'){
				get_template_part('layouts/duoshuo');
			}else{
				comments_template('', true);
			}
	?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
        <?php esc_attr_e('Copyright ©', 'akina'); ?> <?php esc_attr_e(date('Y')); ?> <?php esc_attr_e('. All rights reserved.', 'akina'); ?>
<!--         <span class="sep"> | <a href="<?php bloginfo('url') ?>"><?php echo bloginfo('name') ?>.</a> | </span> -->
<!--          <?php printf(esc_html__('Theme by %1$s. | Powered by %2$s.'), '<a href="http://www.akina.pw" rel="nofollow" target="_blank">Akina</a>', '<a href="https://wordpress.org/" target="_blank" rel="nofollow">WordPress</a>'); ?> -->
        
<!--         <p>WebSite -->
            <?php if (akina_option('zh_cn_l10n_icp_num')) echo ' | <a href="http://www.miitbeian.gov.cn" rel="nofollow" target="_blank">' . akina_option('zh_cn_l10n_icp_num') . '</a>'; ?>
            <?php if (akina_option('zh_cn_l10n_gongan_icp_num')) echo ' | ' . akina_option('zh_cn_l10n_gongan_icp_num'); ?>
            <?php if (akina_option('track_link')) echo ' | ' . akina_option('track_link'); ?>
            <?php if (akina_option('sitemap_link')) echo '<a href="' . akina_option('sitemap_link') . '" target="_blank"> | 网站地图 </a>' ?>
            <?php if (akina_option('site_feed') == 'yes') { ?>
                <a href="<?php bloginfo('url') ?>/feed" target="_blank"> | RSS</a>
            <?php } ?>
            <?php if (akina_option('echo_footer_time_log') == 'yes') { ?>
                <br/>数据库查询<?php echo get_num_queries(); ?>次，页面加载<?php timer_stop(1); ?>秒
            <?php } ?>
            <?php echo '</p>'; ?>
            <div class="footertext">
         <p><?php echo akina_option('footer_info', ''); ?></p>
    </div>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->
</section>
<a class="back2top" style="display:none;"></a>

<!-- search start -->
<form class="js-search search-form search-form--modal" method="get" action="<?php echo home_url(); ?>" role="search">
    <div class="search-form__inner">
        <div>
            <p class="micro mb-"><?php _e('输入后按回车搜索 ...') ?></p>
            <i class="iconfont">&#xe6a2;</i>
            <input class="text-input" type="search" name="s" placeholder="<?php _e('Search', 'akina') ?>" required>
        </div>
    </div>
    <div class="search_close"></div>
</form>
<!-- search end -->

<?php wp_footer(); ?>

</body>
</html>
