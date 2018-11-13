<?php 

	/**
	 * sharelike
	 */

?>

<div class="post-like">
			<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="specsZan <?php if(isset($_COOKIE['specs_zan_'.$post->ID])) echo 'done';?>">
                <i class="iconfont">&#xe635;</i> <span class="count">
					<?php if( get_post_meta($post->ID,'specs_zan',true) ){
								echo get_post_meta($post->ID,'specs_zan',true);
							} else {
								echo '0';
							}?></span>
				</a>
			</div>
			
<div class="post-share">
    <ul class="sharehidden">
        <li><a href="http://www.jiathis.com/send/?webid=email&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'renren-share', 'width=490,height=600');return false;" class="s-email"><i class="iconfont email">&#xe7ab;</i></a></li>
        <li><a href="http://www.jiathis.com/send/?webid=weixin&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'renren-share', 'width=490,height=700');return false;" class="s-weixin"><i class="iconfont wechat">&#xe61e;</i></a></li>
		<li><a href="http://www.jiathis.com/send/?webid=cqq&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'weibo-share', 'width=730,height=500');return false;" class="s-qq"><i class="iconfont qq">&#xe621;</i></a></li>
		<li><a href="http://www.jiathis.com/send/?webid=tsina&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'weibo-share', 'width=550,height=235');return false;" class="s-sina"><i class="iconfont sina">&#xe623;</i></a></li>
		<li><a href="http://www.jiathis.com/send/?webid=douban&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'renren-share', 'width=490,height=600');return false;" class="s-douban"><i class="iconfont douban">&#xe614;</i></a></li>
        <li><a href="http://www.jiathis.com/send/?webid=twitter&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'renren-share', 'width=490,height=600');return false;" class="s-twitter"><i class="iconfont twitter">&#xe620;</i></a></li>
        <li><a href="http://www.jiathis.com/send/?webid=fb&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'renren-share', 'width=490,height=600');return false;" class="s-facebook"><i class="iconfont facebook">&#xe62b;</i></a></li>
        <li><a href="http://www.jiathis.com/send/?webid=googleplus&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'renren-share', 'width=490,height=600');return false;" class="s-googleplus"><i class="iconfont google">&#xe62e;</i></a></li>
    </ul>
		
		<i class="iconfont show-share">&#xe61f;</i>

	</div>