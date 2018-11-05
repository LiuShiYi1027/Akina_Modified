 <?php get_header(); ?>
 
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('js-gallery'); ?> itemscope itemtype="http://schema.org/Article">
		
        <?php if ( is_single() ) {?> <style>.container {padding:10px 0px;}.post{margin:0 auto}</style> <?php }

            elseif ( is_page() ) {?> <style>.meta{display: none;}#NextPrevPosts{margin: 0;visibility:hidden;}</style> <?php }?>

		<section class="post_content">
		
        <header class="post_header">
		
            <h1 class="post_title" ><?php the_title(); ?></h1>
			
        </header>
		
        <div class="post-body js-gallery">
		
		<?php the_content(); ?>
		
		<?php custom_wp_link_pages();?>
		
        </div>
		
			<div class="meta split split--responsive cf">
			
				<div class="split__title">
				
					<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>"><?php the_time('Y/m/d'); ?></time>
						
					<span class=""><?php if ( get_the_tags() ) {the_tags('', '', ' ');}?></span>
					
				</div>
				
				<?php if (theme_option('show-social-share')) : ?>
				
					    <div id="social-share"><span class="entypo-share"><i class="iconfont">&#xe614;</i>分享</span></div>
						
				<?php endif ?>
				
				<div class="slide"><a class="btn-slide" title="switch down"><i class="iconfont">&#xe615;</i>折叠评论区</a></div>

			</div>
			
		</section>
			
		</article>

		</div>		

		<svg id="upTriangleColor" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 0 L50 100 L100 0 Z"></path></svg>
		
		<div id="social">
			<ul>
				<li><a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" title="qzone" target="_blank"><i class="iconfont">&#xe67f;</i></a></li>
				<li><a href="http://service.weibo.com/share/share.php?title=<?php the_title(); ?>&url=<?php the_permalink(); ?>" title="weibo" target="_blank"><i class="iconfont">&#xe680;</i></a></li>
				<li><a href="http://www.douban.com/recommend/?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" title="douban" target="_blank"><i class="iconfont">&#xe681;</i></a></li>
				<li><a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" title="twitter" target="_blank"><i class="iconfont">&#xe683;</i></a></li>
			</ul>
		</div>
			
	    <div id="panel">
		
			<div class="comment-area"><?php comments_template(); ?></div>

		</div>
		
		<svg id="dwTriangleColor" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 0 L50 100 L100 0 Z"></path></svg>

		<div class="wrapper">

	<?php endwhile; ?>

	<?php else: ?>
	
		<article>
		
			<h1><?php _e( 'Sorry, nothing to display.', 'Yarn' ); ?></h1>
			
		</article>
		
	<?php endif; ?>

<?php get_footer(); ?>