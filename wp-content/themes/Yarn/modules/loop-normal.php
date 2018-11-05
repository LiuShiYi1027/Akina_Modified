<?php if(have_posts()):while(have_posts()):the_post(); ?>
	
		<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'Yarn_medium_img','Yarn' ); ?>

		<div class="post post-layout-list" style="margin: 0 auto 60px;" data-aos="fade-up">
		
		<?php if(is_sticky()) : ?><div class="sticky" style="left: 20px;"><i class="iconfont">&#xe608;</i></div><?php endif ?>
				
		<?php if ( is_home() || is_front_page() ) {?> <style>.post{margin: 0 auto 60px;}</style><?php }?>

		<div class="posts-wrap">
			
			<div class="tesetu">
			
				<div class="mediain">

				<a rel="nofollow" href="<?php the_permalink(); ?>" style="background-image: url(<?php if ( has_post_thumbnail()) : ?><?php echo $thumb['0']; ?><?php else : ?><?php catch_first_img();?><?php endif; ?>);"></a>
			
				</div>
			
			</div>
			
			<div class="neirong clearfix">

			<div class="rit-news-info">

					<header class="entry-header">
					
                    <div class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></div> 
						
					<div class="info-post">
				
					<span class="cate-news"><?php the_category(','); ?></span>&nbsp;&nbsp;-&nbsp;&nbsp;
					
					<span class="info-cat"><?php Yarn_post_views(' reads');?></span>&nbsp;&nbsp;-&nbsp;&nbsp;
                    
					<a href="<?php the_permalink(); ?>#comment"><?php comments_number('0 Comment', '1 Comment', '% Comments' );?></a>
								
					</div>
					
					</header><!-- .entry-header -->
					
                </div>
				
				<div class="entry-content"><?php the_excerpt(); ?></div><!-- .entry-content -->
				
			</div>
			
		</div>
				
		</div>
		
<?php endwhile;endif; ?>		