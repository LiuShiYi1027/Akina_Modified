<?php
/*
* 优化函数
*/

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param    array  $plugins
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

//去除头部菜单
add_filter( 'show_admin_bar', '__return_false' );
//去除头部冗余代码
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator' ); //隐藏wordpress版本
remove_filter('the_content', 'wptexturize'); //取消标点符号转义

remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
// Remove the Link header for the WP REST API
// [link] => <http://cnzhx.net/wp-json/>; rel="https://api.w.org/"
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

//去谷歌字体，貌似没用
function coolwp_remove_open_sans_from_wp_core() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );

//修改后台字体
function admin_lettering(){
    echo'<style type="text/css">
     body{ font-family: Microsoft YaHei;}
    </style>';
}
add_action('admin_head', 'admin_lettering');

// Gravatar头像使用中国服务器
function gravatar_cn( $url ){
    $gravatar_url = array('0.gravatar.com','1.gravatar.com','2.gravatar.com');
    return str_replace( $gravatar_url, 'cn.gravatar.com', $url );
}
add_filter( 'get_avatar_url', 'gravatar_cn', 4 );

// 阻止站内文章互相Pingback
function theme_noself_ping( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action('pre_ping','theme_noself_ping');

/*
 * 删除后台某些版权和链接
 * @wpdx
 */
add_filter('admin_title', 'wpdx_custom_admin_title', 10, 2);
function wpdx_custom_admin_title($admin_title, $title){
    return $title.' &lsaquo; '.get_bloginfo('name');
}
//去掉Wordpress LOGO
function remove_logo($wp_toolbar) {
    $wp_toolbar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'remove_logo', 999);

//去掉Wordpress 底部版权
function change_footer_admin () {return '';}
add_filter('admin_footer_text', 'change_footer_admin', 9999);
function change_footer_version() {return '';}
add_filter( 'update_footer', 'change_footer_version', 9999);

//去掉Wordpres挂件
function disable_dashboard_widgets() {
    //remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');//近期评论
    //remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');//近期草稿
    remove_meta_box('dashboard_primary', 'dashboard', 'core');//wordpress博客
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');//wordpress其它新闻
    remove_meta_box('dashboard_right_now', 'dashboard', 'core');//wordpress概况
    //remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');//wordresss链入链接
    //remove_meta_box('dashboard_plugins', 'dashboard', 'core');//wordpress链入插件
    //remove_meta_box('dashboard_quick_press', 'dashboard', 'core');//wordpress快速发布
}
add_action('admin_menu', 'disable_dashboard_widgets');

//删除自带小工具
function unregister_default_widgets() {
    unregister_widget("WP_Widget_Pages");
    unregister_widget("WP_Widget_Calendar");
    unregister_widget("WP_Widget_Archives");
    unregister_widget("WP_Widget_Links");
    unregister_widget("WP_Widget_Meta");
    unregister_widget("WP_Widget_Search");
    unregister_widget("WP_Widget_Categories");
    unregister_widget("WP_Widget_Recent_Posts");
    unregister_widget("WP_Widget_Recent_Comments");
    unregister_widget("WP_Widget_RSS");
    unregister_widget("WP_Nav_Menu_Widget");
}
add_action("widgets_init", "unregister_default_widgets", 11);

remove_action('admin_init', '_maybe_update_core'); // 禁止 WordPress 检查更新
remove_action('admin_init', '_maybe_update_plugins'); // 禁止 WordPress 更新插件
remove_action('admin_init', '_maybe_update_themes'); // 禁止 WordPress 更新主题