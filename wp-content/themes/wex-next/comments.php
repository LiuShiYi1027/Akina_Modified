<?php
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');
?>
    <div id="comments">

        <ol class="comment-list">
        <?php
        if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
            // if there's a password
            // and it doesn't match the cookie
            ?>
            <li class="decmt-box">
                <p><a href="#addcomment">请输入密码再查看评论内容.</a></p>
            </li>
            <?php
        } else if ( !comments_open() ) {
            ?>
            <li class="decmt-box">
                <p><a href="#addcomment">评论功能已经关闭!</a></p>
            </li>
            <?php
        } else if ( !have_comments() ) {
            ?>
            <li class="decmt-box">
                <p><a href="#addcomment">还没有任何评论，你来说两句吧</a></p>
            </li>
            <?php
        } else {
            wp_list_comments('type=comment&callback=wex_comment');
        }
        ?>
    </ol>
    <div class="hr clearfix">&nbsp;</div>
<?php
if ( !comments_open() ) :
// If registration required and not logged in.
elseif ( get_option('comment_registration') && !is_user_logged_in() ) :
    ?>
    <p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
<?php else  : ?>
    <!-- Comment Form -->
    <form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
        <h3>发表评论</h3>
        <div class="hr dotted clearfix">&nbsp;</div>
        <textarea id="message comment"  class="comment_content" name="comment" tabindex="4"  placeholder="评论内容"></textarea>


            <?php if ( !is_user_logged_in() ) : ?>
<div class="input_container">
                    <input class="no_sign_input"  type="text" placeholder="昵称" name="author" id="author" value="<?php echo $comment_author; ?>" size="23" tabindex="1" />
                    <input class="no_sign_input" type="text"  placeholder="电子邮件"  name="email" id="email" value="<?php echo $comment_author_email; ?>" size="23" tabindex="2" />
                    <input class="no_sign_input" type="text"  placeholder="网址(选填)"  name="url" id="url" value="<?php echo $comment_author_url; ?>" size="23" tabindex="3" />
</div>
            <?php else : ?>
                <span class="tips">您已登录:<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
                                        <a href="<?php echo wp_logout_url(get_permalink()); ?>">退出 &raquo;</a>
                 </span>
            <?php endif; ?>



                <!-- Add Comment Button -->
                <a href="javascript:void(0);" onClick="document.forms['commentform'].submit()" class="button submit right">发表评论</a>

        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
    </form>

<?php endif; ?>