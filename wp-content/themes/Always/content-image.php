<?php if( is_singular() ): ?>
<article id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<h1><?php the_title(); ?></h1>
	</header>
	
	<div class="entry-content">
		<?php the_content( __( '','Always' ) ); ?>
	</div>
	
	<footer class="entry-footer">
		<?php if(get_the_tags()): ?>
			<div class="meta-tag">Tags:<?php the_tags('','&nbsp;,&nbsp;',''); ?></div>
		<?php endif; ?>
		<div class="meta-author">文 / <?php echo get_the_author(); ?></div>
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
<?php else: ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<div class="article-wrap">
	
		<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
			<?php
				preg_match_all('/\<img.+?src="(.+?)".*?\/>/is ',$post->post_content,$matches ,PREG_SET_ORDER);
				echo '<img src="' .$matches [0][1]. '" />';
			?>
		</a>
	
	</div>
</article><!--post-index-->
<?php endif; ?>
