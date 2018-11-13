<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Akina
 */
//WordPress实现自动记录死链地址
if (is_404 && strpos($_SERVER['HTTP_USER_AGENT'], 'Baiduspider') !== false) {
    $fp = fopen("death.txt", "a");//death.txt就是在网站根目录的记录死链的文件，名字可以随意了
    flock($fp, LOCK_EX);
    fwrite($fp, home_url($_SERVER['REQUEST_URI']) . "\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}
?>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="theme-color" content="<?php echo akina_option('theme_skin'); ?>"><!--设置移动端Chrome浏览器HeaderBar颜色-->
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name');?>"><!--iOS添加到主屏后的标题-->
    <meta name="apple-mobile-web-app-capable" content="yes"/><!--iOS强制全屏-->
    <meta name="renderer" content="webkit"><!--强制让360浏览器使用极速模式(Chrome内核模式)-->
    <title itemprop="name"><?php global $page, $paged;wp_title( '|', true, 'right' );
        bloginfo( 'name' );$site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( '第 %s 页'), max( $paged, $page ) );?>
    </title>
    <?php
    if (akina_option('akina_meta') == true) {
        $keywords = '';
        $description = '';
        if ( is_singular() ) {
            $keywords = '';
            $tags = get_the_tags();
            $categories = get_the_category();
            if ($tags) {
                foreach($tags as $tag) {
                    $keywords .= $tag->name . ',';
                };
            };
            if ($categories) {
                foreach($categories as $category) {
                    $keywords .= $category->name . ',';
                };
            };
            $description = mb_strimwidth( str_replace("\r\n", '', strip_tags($post->post_content)), 0, 240, '…');
        } else {
            $keywords = akina_option('akina_meta_keywords');
            $description = akina_option('akina_meta_description');
        };
        ?>
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta name="description" content="<?php echo $description; ?>" />
    <?php } ?>
    <?php wp_head(); ?>
    <style>
        html,body{
            margin:0;
            padding: 0;
        }
        .content{
            width: 600px;
            margin:200px auto;
        }
        a,a:hover{
            text-decoration: none;
        }
        /*
         Solarized Color Schemes originally by Ethan Schoonover
         http://ethanschoonover.com/solarized

         Ported for PrismJS by Hector Matos
         Website: https://krakendev.io
         Twitter Handle: https://twitter.com/allonsykraken)
        */

        /*
        SOLARIZED HEX
        --------- -------
        base03    #002b36
        base02    #073642
        base01    #586e75
        base00    #657b83
        base0     #839496
        base1     #93a1a1
        base2     #eee8d5
        base3     #fdf6e3
        yellow    #b58900
        orange    #cb4b16
        red       #dc322f
        magenta   #d33682
        violet    #6c71c4
        blue      #268bd2
        cyan      #2aa198
        green     #859900
        */

        code,
        pre {
            color: #657b83; /* base00 */
            font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
            text-align: left;
            white-space: pre-wrap;
            word-spacing: normal;
            word-break: normal;
            word-wrap: normal;
            background: inherit;
            line-height: 1.5;
            text-shadow: none;
            -moz-tab-size: 4;
            -o-tab-size: 4;
            tab-size: 4;

            -webkit-hyphens: none;
            -moz-hyphens: none;
            -ms-hyphens: none;
            hyphens: none;
        }

        pre::-moz-selection, pre ::-moz-selection,
        code::-moz-selection, code ::-moz-selection {
            background: #073642; /* base02 */
        }

        pre::selection, pre ::selection,
        code::selection, code ::selection {
            background: #073642; /* base02 */
        }

        /* Code blocks */
        pre {
            padding: 1em;
            margin: .5em 0;
            overflow: auto;
            border-radius: 0.3em;
        }

        /* Solarized Green */
        .keyword {
            color: #859900;
        }

        /* Solarized Cyan */
        .number,
        .string {
            color: #2aa198;
        }

        /* Solarized Blue */
        .title,
        .name{
            color: #268bd2;
        }
        a,a:visited,.link {
            color: #cb4b16;
        }

        /* Solarized Red */
        .built_in {
            color: #dc322f;
        }

        @media only screen and (max-width: 500px) {
            .content{
                width: 90%
            }
        }

        pre:before {
            content: normal;
        }

        pre:after {
            content: normal;
        }


    </style>
</head>
<body <?php body_class(); ?>>
<div class="content">
<pre><code>
<span class="function"><span class="keyword">function</span> <span class="title">errorHandler</span>(<span
            class="params">req</span>)</span>{
  <span class="keyword">if</span> (req.status == <span class="number">404</span>) {
    <span class="built_in">console</span>.log(<span class="string">"Page not found"</span>);
    <span class="built_in">window</span>.location.href = <span class="link"><a href="<?php bloginfo('url'); ?>">'<?php bloginfo('url'); ?>'</a></span>;
  }
}
</code></pre>
</div>
</body>


