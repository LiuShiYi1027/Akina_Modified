<?php

//定义菜单
if (function_exists('register_nav_menus')){
    register_nav_menus( array(
        'nav' => __('导航')
    ) );
}
//删除后台多余菜单栏（不需要可以删除）
function remove_menus() {
  global $menu;
  $restricted = array(__('Tools'),  __('Users'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(strpos($value[0], '<') === FALSE) {
      if(in_array($value[0] != NULL ? $value[0]:"" , $restricted)){
        unset($menu[key($menu)]);
      }
    }
    else {
      $value2 = explode('<', $value[0]);
      if(in_array($value2[0] != NULL ? $value2[0]:"" , $restricted)){
        unset($menu[key($menu)]);
      }
    }
  }
}

if ( is_admin() ) {
  // 删除左侧菜单
  add_action('admin_menu', 'remove_menus');
}
/* 设置评论字数限制开始 */
function set_comments_length($commentdata) {
	$minCommentlength = 5;		//最少字数限制
	$maxCommentlength = 200;	//最多字数限制
	$pointCommentlength = mb_strlen($commentdata['comment_content'],'UTF8');	//mb_strlen 1个中文字符当作1个长度
	if ($pointCommentlength < $minCommentlength){
		err('抱歉，您的评论字数过少，请至少输入' . $minCommentlength .'个字（目前字数：'. $pointCommentlength .'个字）');
		exit;
	}
	if ($pointCommentlength > $maxCommentlength){
		err('对不起，您的评论字数过多，请少於' . $maxCommentlength .'个字（目前字数：'. $pointCommentlength .'个字）');
		exit;
	}
	return $commentdata;
}
add_filter('preprocess_comment', 'set_comments_length');
/* 设置评论字数限制结束 */

