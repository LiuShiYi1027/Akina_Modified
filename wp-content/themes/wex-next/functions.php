<?php
require_once dirname( __FILE__ ) .'/inc/admin/cs-framework.php';
if ( !defined( 'THEME_DIR' ) ) {
	define( 'THEME_DIR', get_template_directory() );
}
if ( !defined( 'THEME_URI' ) ) {
	define( 'THEME_URI', get_template_directory_uri() );
}

define('INC', TEMPLATEPATH.'/inc/wex');
IncludeAll( INC );
function IncludeAll($dir){
	$dir = realpath($dir);
	if($dir){
		$files = scandir($dir);
		sort($files);
		foreach($files as $file){
			if($file == '.' || $file == '..'){
				continue;
			}elseif(preg_match('/.php$/i', $file)){
				include_once $dir.'/'.$file;
			}
		}
	}
}
function wex_comment($comment, $args, $depth)
{$GLOBALS['comment'] = $comment; ?>
    <li id="li-comment-<?php comment_ID(); ?>" class="comment-body comment-parent comment-odd" style="padding-top: 0;">
        <div id="comment-<?php comment_ID(); ?>" class="comment-blockpost">
        <div class="gravatar">
            <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?>
            <div class="comment-main">

                <div class="comment_text">
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em>你的评论正在审核，稍后会显示出来！</em><br />
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div>





                <div class="comment-meta">
                    <span class="comment-author">
                        <?php printf(__('<cite class="author_name">%s</cite>'), get_comment_author_link()); ?>
                    </span>
                    <span class="comment-reply">
                        <time class="comment-time">
                            <?php echo get_comment_time('Y-m-d H:i'); ?>
                        </time>
                        &nbsp;&nbsp;&nbsp;
                        <?php edit_comment_link('修改'); ?>

                        <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                     </span>

                </div>

             </div>
        </div>


        </div>
    </li>


<?php } ?>




