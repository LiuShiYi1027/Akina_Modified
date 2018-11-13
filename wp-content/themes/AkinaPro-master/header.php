<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Akina
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="<?php echo akina_option('theme_skin'); ?>"><!--设置移动端Chrome浏览器HeaderBar颜色-->
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>"><!--iOS添加到主屏后的标题-->
    <meta name="apple-mobile-web-app-capable" content="yes"/><!--iOS强制全屏-->
    <meta name="renderer" content="webkit"><!--强制让360浏览器使用极速模式(Chrome内核模式)-->
    <title itemprop="name"><?php global $page, $paged;
        wp_title('|', true, 'right');
        bloginfo('name');
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page())) echo " | $site_description";
        if ($paged >= 2 || $page >= 2) echo ' | ' . sprintf(__('第 %s 页'), max($paged, $page)); ?>
    </title>
    <?php
    $noindex = get_post_meta($post->ID, 'nofollow_post', true);
    if ($noindex) {
        echo '<meta name="robots" content="noindex,nofollow" />';
    }
    ?>
    <?php
    if (akina_option('akina_meta') == true) {
        $keywords = '';
        $description = '';
        if (is_singular()) {
            $keywords = '';
            $tags = get_the_tags();
            $categories = get_the_category();
            if ($tags) {
                foreach ($tags as $tag) {
                    $keywords .= $tag->name . ',';
                };
            };
            if ($categories) {
                foreach ($categories as $category) {
                    $keywords .= $category->name . ',';
                };
            };
            $description = mb_strimwidth(str_replace("\r\n", '', strip_tags($post->post_content)), 0, 240, '…');
        } else {
            $keywords = akina_option('akina_meta_keywords');
            $description = akina_option('akina_meta_description');
        };
        ?>
        <meta name="keywords" content="<?php echo $keywords; ?>"/>
        <meta name="description" content="<?php echo $description; ?>"/>
    <?php } ?>
    <?php wp_head(); ?>
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
<section id="index">
    <!-- 移动端导航 -->
    <div id="mo-nav">
        <!--头像-->
        <div class="mo_header_img">
            <?php if (akina_option('focus_logo')): ?>
                <img src="<?php echo akina_option('focus_logo', ''); ?>">
            <?php else : ?>
                <img src="//img.alicdn.com/imgextra/i2/2038135983/TB2lFWRaWi5V1BjSspaXXbrApXa_!!2038135983.png">
            <?php endif; ?>
        </div>
        <!--博客名-->
        <div class="mo_header_title">
            <?php if (akina_option('author_location')) echo ' <a class="author_local"><i class="iconfont">&#xe622;</i> ' . akina_option('author_location') . '</a>' ?>
            <a><?php bloginfo('name'); ?></a>
        </div>
        <!--博主描述-->
        <div class="mo_header_info">
            <a><?php echo akina_option('admin_des', 'Carpe Diem and Do what I like'); ?></a>
        </div>
        <!--搜索-->
        <div class="search-box">
            <!-- search start -->
            <form class="mo_s-search">
                <input class="text-input" type="search" name="s" placeholder="<?php _e('搜索...', 'akina') ?>">
            </form>
            <!-- search end -->
        </div>
        <!--菜单-->
        <?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'header_nav', 'echo' => true)); ?>
    </div>
    <!--手机菜单-->
    <div class="openNav">
        <div class="iconflat">
            <div class="icon"></div>
        </div>
        <div class="site-branding">
            <!-- 如果设置logo则显示，反之显示博客名 -->
            <?php if (akina_option('akina_logo')): ?>
                <div class="site-title"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo akina_option('akina_logo', ''); ?>"></a></div>
            <?php else : ?>
                <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
            <?php endif; ?>
            <!-- logo end -->
        </div><!-- .site-branding -->
    </div>

    <div id="page" class="site wrapper">

        <header class="site-header" role="banner">
            <div class="site-top">
                <div class="site-branding">
                    <!-- 如果设置logo则显示，反之显示博客名 -->
                    <?php if (akina_option('akina_logo')): ?>
                        <div class="site-title"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo akina_option('akina_logo', ''); ?>"></a></div>
                    <?php else : ?>
                        <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
                    <?php endif; ?>
                    <!-- logo end -->
                </div><!-- .site-branding -->
                <div class="searchbox"><i class="iconfont js-toggle-search iconsearch">&#xe6a2;</i></div>
                <div class="lower">
                    <nav>
                        <?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'header_nav', 'echo' => true)); ?>
                    </nav><!-- #site-navigation -->
                </div>
                <nav id="topMenu" class="menu_click">
                    <?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'header_nav', 'echo' => true)); ?>
                    <i class="i_1"></i>
                    <i class="i_2"></i>
                </nav>
            </div>
        </header><!-- #masthead -->
        <div class="blank"></div>
        <div class="headertop">
            <!-- #imgbox -->
            <?php if (is_home()) { ?>
                <?php get_template_part('layouts/imgbox'); ?>
            <?php } else if (is_single()) { ?>
                <?php get_template_part('layouts/imgbox-single'); ?>
            <?php } ?>
            <!-- #imgbox -->
        </div>

        <div id="content" class="site-content">