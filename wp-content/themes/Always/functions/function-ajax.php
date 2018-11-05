<?php
/**
 * Ajax comments by Willin Kan.
 * mode by dong
 *
 */
function ajax_comment(){
/*if ( 'POST' != $_SERVER['REQUEST_METHOD'] ) { //有这句会失效
	header('Allow: POST');
	header('HTTP/1.1 405 Method Not Allowed');
	header('Content-Type: text/plain');
	exit;
}*/

/** Sets up the WordPress Environment. */
	if($_POST['action'] == 'ajax_comment_post' && 'POST' == $_SERVER['REQUEST_METHOD']){
		global $wpdb;
		nocache_headers();
		
		$comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
		
		$post = get_post($comment_post_ID);

		if ( empty($post->comment_status) ) {
			do_action('comment_id_not_found', $comment_post_ID);
			err(__('Invalid comment status.')); // 將 exit 改為錯誤提示
		}

		// get_post_status() will get the parent status for attachments.
		$status = get_post_status($post);

		$status_obj = get_post_status_object($status);

		if ( !comments_open($comment_post_ID) ) {
			do_action('comment_closed', $comment_post_ID);
			err(__('Sorry, comments are closed for this item.')); // 將 wp_die 改為錯誤提示
		} elseif ( 'trash' == $status ) {
			do_action('comment_on_trash', $comment_post_ID);
			err(__('Invalid comment status.')); // 將 exit 改為錯誤提示
		} elseif ( !$status_obj->public && !$status_obj->private ) {
			do_action('comment_on_draft', $comment_post_ID);
			err(__('Invalid comment status.')); // 將 exit 改為錯誤提示
		} elseif ( post_password_required($comment_post_ID) ) {
			do_action('comment_on_password_protected', $comment_post_ID);
			err(__('Password Protected')); // 將 exit 改為錯誤提示
		} else {
			do_action('pre_comment_on_post', $comment_post_ID);
		}

		$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
		$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
		$comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
		$comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
		$edit_id              = ( isset($_POST['edit_id']) ) ? $_POST['edit_id'] : null; // 提取 edit_id

		// If the user is logged in
		$user = wp_get_current_user();
		if ( $user->ID ) {
			if ( empty( $user->display_name ) )
				$user->display_name=$user->user_login;
			$comment_author       = $wpdb->escape($user->display_name);
			$comment_author_email = $wpdb->escape($user->user_email);
			$comment_author_url   = $wpdb->escape($user->user_url);
			if ( current_user_can('unfiltered_html') ) {
				if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
					kses_remove_filters(); // start with a clean slate
					kses_init_filters(); // set up the filters
				}
			}
		} else {
			if ( get_option('comment_registration') || 'private' == $status )
				err(__('Sorry, you must be logged in to post a comment.')); // 將 wp_die 改為錯誤提示
		}

		$comment_type = '';

		if ( get_option('require_name_email') && !$user->ID ) {
			if ( 6 > strlen($comment_author_email) || '' == $comment_author )
				err( __('Error: please fill the required fields.') ); // 將 wp_die 改為錯誤提示
			elseif ( !is_email($comment_author_email))
				err( __('Error: please enter a valid email address.') ); // 將 wp_die 改為錯誤提示
		}

		if ( '' == $comment_content )
			err( __('Error: please type a comment.') ); // 將 wp_die 改為錯誤提示



		// 增加: 檢查重覆評論功能
		$dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
		if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
		$dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
		if ( $wpdb->get_var($dupe) ) {
			err(__('Duplicate comment detected; it looks as though you&#8217;ve already said that!'));
		}

		// 增加: 檢查評論太快功能
		if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) { 
		$time_lastcomment = mysql2date('U', $lasttime, false);
		$time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
		$flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
		if ( $flood_die ) {
			err(__('You are posting comments too quickly.  Slow down.'));
			}
		}

		$comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;

		$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

		// 增加: 檢查評論是否正被編輯, 更新或新建評論
		if ( $edit_id ){
		$comment_id = $commentdata['comment_ID'] = $edit_id;
		wp_update_comment( $commentdata );
		} else {
		$comment_id = wp_new_comment( $commentdata );
		}

		$comment = get_comment($comment_id);
		do_action('set_comment_cookies', $comment, $user);

		//$location = empty($_POST['redirect_to']) ? get_comment_link($comment_id) : $_POST['redirect_to'] . '#comment-' . $comment_id; //取消原有的刷新重定向
		//$location = apply_filters('comment_post_redirect', $location, $comment);

		//wp_redirect($location);

		$comment_depth = 1;   //为评论的 class 属性准备的
		$tmp_c = $comment;
		while($tmp_c->comment_parent != 0){
			$comment_depth++;
			$tmp_c = get_comment($tmp_c->comment_parent);
		}

		//此处非常必要，无此处下面的评论无法输出 by mufeng
		$GLOBALS['comment'] = $comment;

		//以下是評論式樣, 不含 "回覆". 要用你模板的式樣 copy 覆蓋.
		?>



		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="author"><?php echo get_avatar($comment,'33'); ?></div>
			<span class="time"><?php echo time_ago(); ?></span>
			<div class="commlist-middle">
				<span class="name"><?php echo get_comment_author_link(); ?></span>
				<div class="text">
					<?php
						if ($comment->comment_parent):
							$parent_id = $comment->comment_parent;
							$comment_parent = get_comment($parent_id);
					?>
						<span class="comment-to"><a href="<?php echo "#comment-".$parent_id; ?>" title="<?php echo mb_strimwidth(strip_tags(apply_filters( 'the_coment', $comment_parent->comment_content )), 0, 100, "..."); ?>">@<?php echo $comment_parent->comment_author; ?></a></span>
						<?php echo get_comment_text(); ?>
					<?php else: comment_text(); ?>
					<?php endif; ?>
				</div>
			</div>
			
			
			<?php if ( $comment->comment_approved == '0'): ?>
				<em><span class="moderation"><?php _e('Your comment is avaiting moderation.'); ?></span></em>
			<?php endif; ?>
		</div>
		<?php
		die();
	}else{return;}
}
add_action('init','ajax_comment');

// 增加: 錯誤提示功能
function err($ErrMsg) {
    header('HTTP/1.1 405 Method Not Allowed');
	header('Content-Type: text/plain;charset=UTF-8');
    echo $ErrMsg;
    exit;
}

//ajax评论翻页
function AjaxCommentsPage(){
	if( isset($_POST['action'])&& $_POST['action'] == 'AjaxCommentsPage'  ){
		global $post,$wp_query, $wp_rewrite;
		$postid = isset($_POST['post']) ? $_POST['post'] : null;
		$pageid = isset($_POST['page']) ? $_POST['page'] : null;
		if(!$postid || !$pageid){
			fail(__('Error post id or comment page id.'));
		}
		// get comments
		$comments = get_comments('post_id='.$postid);
		$post = get_post($postid);
		if(!$comments){
			fail(__('Error! can\'t find the comments'));
		}
		//if( 'desc' != get_option('comment_order') ){
		//	$comments = array_reverse($comments);
		//}
		$comments = array_reverse($comments);//?有点不明白
		// set as singular (is_single || is_page || is_attachment)
		$wp_query->is_singular = true;
		// base url of page links
		
		$max_page = get_comment_pages_count($comments);
		
		wp_list_comments('callback=commentlist&type=comment&page=' . $pageid . '&per_page=' . get_option('comments_per_page'), $comments);
		echo '<!--winysky-AJAX-COMMENT-PAGE-->';
		echo '<span id="cp_post_id" style="display:none;">
			'.$post->ID.'
		</span>';
		paginate_comments_links(array('current' => $pageid , 'total' => $max_page, 'prev_text' => '上一页', 'next_text' => '下一页') );
		die;
	}
}
add_action('init', 'AjaxCommentsPage');

/*
 *footer_load by 咚门
 */
 function footer_load(){
	if ( isset( $_GET['action'] ) && $_GET['action']=='ajax_footer' ){
		$options = get_option('Always_options');
		if ( $options['footer_widget'] == 0 ){
			echo '<div id="footer-widget">';
				echo '<aside id="footer-comments" class="foo-widget">';
					echo '<h3>最新评论</h3>';
						recent_comments(4);
				echo '</aside>';
				echo '<aside id="footer-tags" class="foo-widget">';
					echo '<h3>热门标签</h3>';
						popular_tags();
				echo '</aside>';
				echo '<aside id="footer-readwall" class="foo-widget readwall">';
					echo '<h3>留言墙</h3>';
						the_readerwall(6);
				echo '</aside>';
			echo '</div>';
		}elseif ( $options['footer_widget'] == 1 ){
			echo '<div id="full-footer-widget">';
				echo '<aside id="full-footer-readwall" class="foo-widget readwall">';
					the_readerwall(24);
				echo '</aside>';
			echo '</div>';
		}
		die;
	}else{
		return;
	}
 }
add_action('init', 'footer_load');

/*
 *comment_author_detail by 咚门
 */
function comment_author_detail(){
	if ( isset( $_GET['action'] ) && $_GET['action']=='ajax_author_detail' ){
		$comment = get_comment($_GET['id']);//获得当前评论者邮箱
		$email = $comment -> comment_author_email;
		$author = $comment -> comment_author;
		$url = $comment -> comment_author_url;
		$comments = get_comments( array('author_email' => $email, 'orderby' => 'comment_date_gmt', 'order' => 'DESC') );
		$avatar = get_avatar($email, 46);
		$count = 0;
		$output = '';
		
		$index = 1;
		foreach ( $comments as $comm ) {
			if ( $index == 1 ){
				$date = $comm -> comment_date;
				$content = $comm -> comment_content;
				$id = $comm -> comment_ID;
			}
			$count += 1;
		}
		$output .= '<div class="list-detail"><div class="triangle"><div></div></div>';
		$output .= '<a href="'. $url . '" target="_blank" class="author">' .$avatar.$author. '</a>';
		$output .= '<span class="count">总评论数：'. $count .'</span>';
		$output .= '<a href="'. esc_url( get_comment_link($id) ) . '" class="earlist-comment">第一次留言：'. mb_strimwidth(strip_tags(apply_filters( 'the_coment', $content )),0,50,'') . '</a>';
		$output .= '<span>（这家伙从"' .human_time_diff( mysql2date('U', $date, 'true'), current_time('timestamp') ) . '"前开始在本博客留言！）</span>';
		$output .= '</div>';
		echo $output;
		die;
	}else{
		return;
	}
}
add_action('init', 'comment_author_detail');

/*
 *logo_music by 咚门
 */
function the_slider(){
	if ( isset( $_GET['action'] ) && $_GET['action']=='ajax_logo_music' ){
		$options = get_option('Always_options');
		
		//自动播放
		if ( $options['auto_play'] ){
			$auto_play = $options['auto_play'];
		}
		
		//先返回第一个，方便分割
		if ( $options['music1_name'] ){
			$music_name = $options['music1_name'];
		}
		if ( $options['music1_url'] ){
			$music_src = $options['music1_url'];
		}
		
		//循环判断返回所有音乐
		$music_length = 2;
		while ( $options['music' .$music_length. '_name'] ){
			if ( $options['music' .$music_length. '_name'] ){
				$music_name .= '<!--logo_music_name-->'.$options['music' .$music_length. '_name'];
			}
			if ( $options['music' .$music_length. '_url'] ){
				$music_src .= '<!--logo_music_src-->'.$options['music' .$music_length. '_url'];
			}
			$music_length += 1;
		}
		
		echo $auto_play .'<!--logo_music-->'. $music_name .'<!--logo_music-->'. $music_src;
		die;
	}else{return;}
}
add_action('init','the_slider');

/*
 *site_bg by 咚门
 */
function site_bg(){
	if ( isset( $_GET['action'] ) && $_GET['action']=='ajax_site_bg' ){
		$option = get_option('Always_options');
		if ( $option['site_bg'] ){
			$bg_src = $option['site_bg'];
		}else{
			$bg_src = "";
		}
		echo $bg_src;
		die;
	}else{
		return;
	}
}
add_action('init',site_bg());


?>