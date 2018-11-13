<?php
/*
 * 调用头部背景图作为登陆界面背景
 */
function plus_bingbg()
{
    $imgurl = akina_option('focus_img');
    echo '<style type="text/css">body{background: url(' . $imgurl . ');width:100%;height:100%;background-image:url(' . $imgurl . ');-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: 100% 100%;-moz-border-image: url(' . $imgurl . ') 0;background-repeat:no-repeat\9;background-image:none\9;background-position:center center;background-repeat:no-repeat;background-attachment:scroll;background-size:cover;}</style>';
}
add_action('login_head', 'plus_bingbg');

/*
 * WP后台信息修改
 */
function custom_loginlogo() {
    echo '<style type="text/css">
h1 a {background-image: url('.akina_option('akina_logo').') !important; }
</style>';
}
add_action('login_head', 'custom_loginlogo');

/**
 * 密码保护文章禁止搜索引擎收录（加noindex）
 */
function password_noindex_header() {
    global $post;
    if (!empty($post->post_password)) {
        echo '<meta name="robots" content="noindex,nofollow">'."\n";
    }
}
add_action('wp_head', 'password_noindex_header');

/**
 * XFN管理器添加Nofllow属性
 */
function nofollow_blogroll( $html ) {
    // remove existing rel attributes
    $html = preg_replace( '/\s?rel=".*"/', '', $html );
    // add rel="nofollow" to all links
    $html = str_replace( '<a ', '<a rel="nofollow" ', $html );
    return $html;
}
add_filter( 'wp_list_bookmarks', 'nofollow_blogroll' );

?>