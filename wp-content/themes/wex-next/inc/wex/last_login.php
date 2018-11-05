<?php
/*-----------------------------------------------------------------------------------*/
/* 最后一次登录时间
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_login', 'set_last_login' );
function set_last_login( $login ) {
    //date(time() + 8*3600); 8小时时差
    update_user_meta( 1, 'last_login', time() );
}
function last_login() {
    $time = get_user_meta( 1, 'last_login' )[0];
    echo human_time_diff( $time );
}


?>