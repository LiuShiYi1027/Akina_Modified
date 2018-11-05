<?php if(have_posts()):while(have_posts()):the_post(); ?>
		
	<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'Yarn_medium_img','Yarn' ); ?>

	<?php if ( has_post_format( 'status' )){ ?>
		
		<div class="post post-layout-list" data-aos="fade-up">
		
		<?php if(is_sticky()) : ?><div class="sticky"><i class="iconfont">&#xe603;</i></div><?php endif ?>	
	
		<div class="status_list_item icon_kyubo">

			<div class="status_user" style="background-image: url(https://cn.gravatar.com/avatar/<?php echo md5(get_the_author_meta('user_email', $user_ID));?>?s=250&d=identicon&r=G);">	

				<div class="status_section" >	
  
					<a href="<?php the_permalink() ?>" class="status_btn"><?php the_title(); ?></a>
            
					<p class="section_p"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 220,"..."); ?> </p>
		
				</div>	

			</div>
		
		</div>
		
		</div>
			
	<?php } else if (has_post_format('image')) { ?>
		
		<div class="post post-layout-list js-gallery" data-aos="fade-up">
		
		<?php if(is_sticky()) : ?><div class="sticky"><i class="iconfont">&#xe61e;</i></div><?php endif ?>

		<div class="post-album">

		<div class="row content">

		<div class="bg" style="background-image: url(<?php if ( has_post_thumbnail()) : ?><?php echo $thumb['0']; ?><?php else : ?><?php catch_first_img();?><?php endif; ?>);"></div>


		<div class="contentext flex-xs-middle">

			<div class="album-title"><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></div>

			<h5 class="review-item-creator"><b>发布日期：</b><?php the_time('Y-m-d'); ?></h5>

			<div class="album-content"><?php the_excerpt(); ?></div>

		</div>
		
		<div class="album-thumb-width flex-xs-middle">
			
			<div class="row album-thumb no-gutter"><?php echo hui_get_thumbnail(false,true);?>
				
				<div class="col-xs-4"><a href="<?php the_permalink() ?>"><?php echo get_post_images_number().' pics' ?></a></div>
			</div>
		
		</div>
		
		</div>
		
		</div>
		 
		</div>
		
		<?php } else if (has_post_format('quote')) { ?>
		
		<div class="post post-layout-list" data-aos="fade-up">

		<?php if(is_sticky()) : ?><div class="sticky"><i class="iconfont">&#xe60d;</i></div><?php endif ?>
		
			<div class="quote_box">
		
			<div class="quote_ttl"><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></div>
			
			<div class="quote_center"><?php the_content() ; ?></div>
			
			</div>

		</div>	

		<?php } else { ?>

		<div class="post post-layout-list" data-aos="fade-up">
		
		<?php if(is_sticky()) : ?><div class="sticky"><i class="iconfont">&#xe608;</i></div><?php endif ?>
		
		<div class="postnormal review ">
		
		<div class="post-container review-item">
		
			<div class="row review-item-wrapper">
		
				<div class="col-sm-3"><a rel="nofollow" href="<?php the_permalink(); ?>"><div class="review-item-img" style="background-image: url(<?php if ( has_post_thumbnail()) : ?><?php echo $thumb['0']; ?><?php else : ?><?php catch_first_img();?><?php endif; ?>);"></div></a></div>
		
				<div class="col-sm-9 flex-xs-middle">
		
					<div class="review-item-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></div>
		
					<div class="review-item-creator"><b>发布日期：</b><?php the_time('Y-m-d'); ?></div>
		
					<span class="review-item-info"><b>总浏览量：</b><?php Yarn_post_views(' reads');?></span>
		
				</div>
			
			</div>
		
			<div class="review-bg-wrapper"> 

				<div class="bg-blur" style="background-image: url(<?php if ( has_post_thumbnail()) : ?><?php echo $thumb['0']; ?><?php else : ?><?php catch_first_img();?><?php endif; ?>);"></div>
		
			</div>
		
		</div>
		
			<div class="post-container">
		
				<div class="entry-content"><?php the_excerpt(); ?></div>
		
				<div class="post-footer">
		
					<a class="gaz-btn primary" href="<?php the_permalink(); ?>">READ MORE</a>
		
					<span class="total-comments-on-post pull-right"><a href="<?php the_permalink(); ?>#comment"><?php comments_number('0 Comment', '1 Comment', '% Comments' );?></a></span>
		
				</div>
		
			</div>
		
		</div>
		
		</div>
		
	<?php } ?>
		
<?php endwhile;endif; ?>