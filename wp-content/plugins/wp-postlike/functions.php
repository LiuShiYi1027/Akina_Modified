<?php

function wp_postlike($id = null,$prefix = null){
    wp_enqueue_script('wpl');
    wp_enqueue_style('wpl');
    $id = $id ? $id : get_the_ID();
    $like_num = get_post_meta($id,'_post_like',true) ? get_post_meta($id,'_post_like',true) : 0;
    if(isset($_COOKIE['_post_like_'.$id])) $done = ' is-active';
    echo '<button data-id="'.$id.'" class="wpl-button'.$done.'"><span class="wpl-text">' . $prefix . '</span><span class="count">'.$like_num.'</span></button>';

}

function wpl_get_like_count( $id = null ){
    $id = $id ? $id : get_the_ID();
    $like_num = get_post_meta($id,'_post_like',true) ? get_post_meta($id,'_post_like',true) : 0;
    return $like_num;
}


add_action('wp_ajax_nopriv_wpl_callback', 'wpl_callback');
add_action('wp_ajax_wpl_callback', 'wpl_callback');
function wpl_callback(){
    $id = $_POST["id"];
    $like_num = get_post_meta($id,'_post_like',true);
    $expire = time() + 99999999;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
    setcookie('_post_like_'.$id,$id,$expire,'/',$domain,false);
    if (!$like_num || !is_numeric($like_num)) {
        update_post_meta($id, '_post_like', 1);
    }
    else {
        update_post_meta($id, '_post_like', ($like_num + 1));
    }
    $like_num = get_post_meta($id,'_post_like',true);
    echo json_encode(array('code'=>200,'data'=>$like_num));
    die;
}



function wpl_enqueue_scripts(){
    wp_register_style( 'wpl', WPL_URL . "/static/css/bundle.css" , array(), WPL_VERSION );
    wp_register_script( 'wpl', WPL_URL . "/static/js/bundle.js" , array('jquery'), WPL_VERSION ,true);
    wp_localize_script( 'wpl', 'wpl_ajax_url', WPL_ADMIN_URL . "admin-ajax.php");
}
add_action('wp_enqueue_scripts', 'wpl_enqueue_scripts', 20, 1);