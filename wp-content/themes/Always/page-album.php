<?php
/*
  Template Name: Album
 */
?>
<?php if ( $_POST['action'] != 'ajax_post' ){get_header();} ?>
			
			<div id="content" class="post-single">
				<div id="singular-content">
				
					<?php /* The loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>">
							
							<div class="entry-content">
							<div class="album">
								<div class="thumb-wrap">
									<span class="thumb-left"></span>
									<div class="thumb">
										<?php the_content( __( '','Always' ) ); ?>
									</div>
									<span class="thumb-right"></span>
								</div>
							</div>
						</div>
							
							<footer class="entry-footer">
								<div class="share">
									<ul class="share-ul">
										<li><a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" rel="nofollow" class="twitter-share" title="Twitter"></a></li>
										<li><a href="http://facebook.com/share.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>" target="_blank" rel="nofollow" class="facebook-share" title="facebook"></a></li>
										<li><a href="http://v.t.sina.com.cn/share/share.php?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow" class="sina-share" title="新浪微博"></a></li>
										<li><a href="http://v.t.qq.com/share/share.php?title=<?php the_title(); ?>&url=<?php the_permalink(); ?>&site=<?php bloginfo('url');?>" target="_blank" rel="nofollow" class="tencent-share" title="腾讯微博"></a></li>
										<li><a href="http://www.douban.com/recommend/?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow" class="douban-share" title="豆瓣网"></a></li>
										<li><a href="http://fanfou.com/sharer?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>" target="_blank" rel="nofollow" class="fanfou-share" title="饭否网"></a></li>
										<li><a href="http://share.renren.com/share/buttonshare?link=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow" class="renren-share" title="人人网"></a></li>
										<li><a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow" class="qzone-share" title="QQ空间"></a></li>
									</ul>
									<span class="share-c">分享到</span>
								</div>
							</footer>
							<div class="clear"></div>
							
						</article><!--post-->
						<?php comments_template(); ?>
					<?php endwhile; ?>
					
				</div>
				
			</div><!--content-->
			
<?php if ( $_POST['action'] != 'ajax_post' ){get_footer();} ?>