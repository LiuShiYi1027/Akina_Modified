<?php
 
	/**
	 * COMMENTS TEMPLATE
	 */

	/*if('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die(esc_html__('Please do not load this page directly.', 'Yarn'));*/

	if(post_password_required()){
		return;
	}

?>
	<section class="comments">

		<div class="comments-main">
			
		<?php if ( have_comments() ): ?>

		<div id="comments-list-title"><span><?php comments_number( '0', '1', '%' ); ?></span> 条评论 </div> 
		 
		<div id="loading-comments"><div class="host"> <div class="loading loading-0"></div><div class="loading loading-1"></div><div class="loading loading-2"></div></div></div>

		<ul class="commentwrap"><?php wp_list_comments( 'type=comment&callback=Yarn_comment_format&max_depth=10000' ); ?></ul>

		<nav id="comments-navi"><?php paginate_comments_links( 'prev_text=<&next_text=>' ); ?></nav>
		
		<?php endif; ?>

			<?php if ( comments_open() ): ?>
						
			<div id="respond" class="comment-respond">
			 
				<h6 id="replytitle" class="comment-reply-title"><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">取消</a></h6>
				
					<form action="#" method="post" id="commentform" class="clearfix">
					
					<?php if ( $user_ID ) { ?>
							<div class="checkin"> 当前已登录为 <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;(&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">退出</a>&nbsp;)</div>
					<?php } else { ?>
			
					<?php if($comment_author): ?>
						<div class="welcome">欢迎回来，<?php echo $comment_author; ?>！<span class="info-edit">修改</span></div>
					<?php endif; ?>

					<div class="clearfix"></div>
					
					<div class="author-info">
					<input type="text" name="author" id="author" placeholder="昵  称 : " value="<?php echo $comment_author; ?>" tabindex="1" title="<?php _e('Name', 'cleary'); ?> <?php if ($req) _e('(required)'); ?>" />
					<input type="text" name="email" id="email" placeholder="邮  箱 : " value="<?php echo $comment_author_email; ?>" tabindex="2" title="<?php _e('E-mail', 'cleary');?><?php _e('(will not be published)', 'cleary') ?> <?php if ($req) _e('required', 'cleary'); ?>"  />
					<input type="text" name="url" id="url" placeholder="网  址 : " value="<?php echo $comment_author_url; ?>" tabindex="3" title="<?php _e('Website', 'cleary'); ?>" />
					</div>

					<div class="clearfix"></div>
					
					<?php }?>
			
					<?php comment_id_fields(); do_action('comment_form', $post->ID); ?>
					
					<div class="comment-form-info">
					<div class="real-time-gravatar"><?php $email = ($user_ID) ? get_the_author_meta('user_email', $user_ID) : $comment_author_email;?>
					<img id="real-time-gravatar" src="https://cn.gravatar.com/avatar/<?php echo md5($email);?>?s=60&d=identicon&r=G" alt="gravatar头像" />
					</div>
					
					<p class="input-row">
					<i class="row-icon"></i>
					<textarea class="text_area" rows="3" cols="80" name="comment" id="comment" tabindex="4"  placeholder="你不说两句吗？(°∀°)ﾉ……"></textarea>
					<input type="submit" name="submit" class="button" id="submit" tabindex="5" value="发送"/>
					</p>

					</div>
					
					</form>
					
			 </div>
				 		
					<?php else : ?>
		
					<?php if ( is_single()|| is_page() ) {?><style>.btn-slide{display:none}.comments{padding:0;}</style><?php } ?>
				 		
			<?php endif; ?>
			
	
		</div>
		
	</section>	