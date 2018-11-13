<?php

function customizer_css()
{
    ?>
    <style type="text/css">
        <?php
        // liststyle
        if ( akina_option('list_type') == 'square') { ?>
        .feature img {
            border-radius: 0px;
        !important;
        }

        .feature i {
            border-radius: 0px;
        !important;
        }

        <?php }?>

        <?php
        // like
        if ( akina_option('post_like') == 'no') { ?>
        .post-like {
            display: none !important
        }

        <?php }?>

        <?php
        // share
        if ( akina_option('post_share') == 'no') { ?>
        .post-share {
            display: none !important
        }

        <?php }?>

        <?php
        // nextpre
        if ( akina_option('post_nepre') == 'no') { ?>
        .post-squares {
            display: none !important
        }

        <?php }?>

        <?php
        // nextpre
        if ( akina_option('author_profile') == 'no') { ?>
        .author-profile {
            display: none !important
        }

        <?php }?>

        <?php
        // nextpre
        if ( akina_option('post_author_profile') == 'yes') { ?>
        @media (max-width: 860px) {
            .author-profile {
                display: block;
            }
        }

        <?php }?>

        <?php

        if ( akina_option('post_header') == true) { ?>
        h1.entry-title {
            color: <?php echo akina_option('post_header'); ?>;
        }

        <?php
        }?>

        <?php
        // notice
        if ( akina_option('head_notice') == '0') { ?>
        .notice {
            display: none !important
        }

        <?php }?>

        <?php
        // search
        if ( akina_option('top_search') == 'no') { ?>
        .search_click {
            display: none !important
        }

        <?php }?>

        <?php
        // headerbg
        if ( akina_option('focus_img') == true ) { ?>
        #centerbg {
            background-image: url(<?php echo akina_option('focus_img');?>)
        }
        <?php }?>

        <?php
        // headerbg height
        if ( akina_option('focus_img_height') == true ) { ?>
        #centerbg {
            height: <?php echo akina_option('focus_img_height');?>px !important;
        }
        <?php }?>

        <?php
        //开启小分辨率的首页背景图
        if ( akina_option('display_focus_img') == yes ) { ?>
        @media (max-width: 1280px) {
            #centerbg {
                display: block !important;
            }
        }
        .headertop {
            position: relative;
            overflow: hidden;
            margin-top: -60px;
        }
        <?php }?>

        <?php
        //开启小分辨率的文章特色图片
        if ( akina_option('display_centerbg_single') == yes ) { ?>
        @media (max-width: 1280px) {
            #centerbg_single {
                display: block !important;
            }

            .entry-title-info a:active, .entry-title-info a:hover, .entry-title-info a:link, .entry-title-info a:visited {
                color: #000;
            }

            #centerbg_single {
                height: 350px;
            }

            .header-info_single {
                font-size: 12px;
                margin-top: 45px;
            }

            header.entry-header {
                display: none;
            }
        }

        <?php }?>

        <?php
        // theme-skin
        $color = '';
        if (akina_option('theme_skin') && akina_option('theme_skin') !== '45B6F7') {
            $color = akina_option('theme_skin');
        }

        if ( $color) { ?>

        .reward {
            border: 1px solid <?php echo akina_option('theme_skin'); ?> !important;
            background: <?php echo akina_option('theme_skin'); ?> !important;
        }

        ::selection, #topMenu.menu_close .i_1, #topMenu.menu_close .i_2, .ar-time i, .iconflat {
            background: <?php echo akina_option('theme_skin'); ?> !important;
        }

        .foverlay:hover, .back2top, .comment-checkbox-radio:checked + .comment-checkbox-radioInput:after {
            background: <?php echo akina_option('theme_skin'); ?> !important;
        }

        .site-main input[type=submit],.post-entry input[type=submit],.comment-respond input[type=submit] {
            background: <?php echo akina_option('theme_skin'); ?>;
        }

        .post-more i, .author-profile i, .sub-text, #pagination a:hover, .post-footer-lincenses a, .lower ul li a:hover, .post-like a, .sitename, .akina_one .akina_one_time, .comment h4 a, .comment h4 a:hover {
            color: <?php echo akina_option('theme_skin'); ?>;
        }

        .feature i, .feature-title span, .download, .navigator i:hover, .links ul li:before, span.ar-circle, .object, .instantclick-bar {
            background: <?php echo akina_option('theme_skin'); ?> !important;
        }

        .download, .navigator i:hover, .link-title, .links ul li:hover, #pagination a:hover,#crumbs {
            border-color: <?php echo akina_option('theme_skin'); ?> !important;
        }

        .entry-content a:hover, .site-info a:hover, .comment h4 a:hover, .entry-title a:hover, #archives-temp h3, span.page-numbers.current, .sorry li a:hover, .site-title a:hover {
            color: <?php echo akina_option('theme_skin'); ?> !important;
        }

        <?php }?>

        <?php
        //整站变灰色
        if ( akina_option('site_gray') == true) { ?>
        html {
            overflow-y: scroll;
            filter: progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);
            -webkit-filter: grayscale(100%);
        }
        <?php }?>

    </style>
    <?php
}
add_action('wp_head', 'customizer_css');
//end