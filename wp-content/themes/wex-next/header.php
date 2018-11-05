<!doctype html>

<head lang="zh" class="theme-next use-motion theme-next-mist">
<?php $themeUrl=get_template_directory_uri();

echo
<<<head


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <link rel="shortcut icon" href="<?php wexweb('favicon','');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="{$themeUrl}/css/font-css/current.css" />
    <link rel="stylesheet" type="text/css" href="{$themeUrl}/css/1.css" />
    <link rel="stylesheet" type="text/css" href="{$themeUrl}/css/jquery.fancybox.css" />
    <link rel="stylesheet" type="text/css" href="{$themeUrl}/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="{$themeUrl}/style.css" />
    <script  class="class" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script type="text/javascript"> var CONFIG = {motion: true , sidebar: 'post'  };</script>

head;


if(is_page()){

echo <<<pageCss
<link rel="stylesheet" type="text/css" href="{$themeUrl}/css/about.css"" />
pageCss;


}
?>
<?php

    include ('seo.php');

wexweb('header_add_script','');

wp_head();?>
    <?php if ( is_single() ){ ?>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
    <?php } ?>



</head>

<body>
    <div class="container one-column page-home">
        <!--page home-->
        <div class="headband"></div>
        <header id="header" class="header">
            <div class="header-inner">
                <h1 class="site-meta">
                    <?php
                     if (cs_get_option('logo_switcher')==true){
                         include ('element/header-img-logo.php');
                     }else{
                         include ('element/header-text-logo.php');
                     }
                    ?>
                </h1>
                <div class="site-nav-toggle">
                    <button>
                        <span class="btn-bar"></span>
                        <span class="btn-bar"></span>
                        <span class="btn-bar"></span>
                    </button>
                </div>
                <nav class="site-nav">
<?php
$main = array(
    'theme_location'  =>'main-menu',
    'container'       => 'false',
    'menu_class'      => 'menu menu-left',
    'menu_id'         => 'menu',
    'fallback_cb'     => 'wp_page_menu',
    'depth'           => 1,
);
wp_nav_menu( $main );
 
?>
     

                    <div class="site-search">
                        <form class="site-search-form">
                            <input type="text" id="st-search-input" name="s" class="st-search-input st-default-search-input"
                                   autocomplete="off" autocorrect="off" autocapitalize="off" value="" />
                        </form>
                    </div>
                </nav>
            </div>
        </header>