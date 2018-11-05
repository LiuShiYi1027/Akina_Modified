<div id="NextPrevPosts">

	<?php $prev_post = get_previous_post();

		  $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID),'Yarn_small_img','Yarn'); 
			 
		  if (!empty( $prev_post )): ?>
			   
	<div class="prev" data-aos="slide-right" data-aos-delay="1.5s">
  
		<div class="arrow"><i class="iconfont">&#xe625;</i></div>
    
		<div class="preview">
	
			<div class="pull-left featuredImg" style="background-image:url('<?php if ( has_post_thumbnail($prev_post)) : ?><?php echo esc_url($thumb_url[0]); ?><?php else : ?><?php echo get_template_directory_uri() . '/assets/img/no-image.png'; ?><?php endif; ?>');"></div>

			<a class="pull-left preview-content bold" href="<?php echo get_permalink( $prev_post->ID ); ?>"><span><?php echo mb_strimwidth(strip_tags(apply_filters(¡®the_title¡¯,$prev_post->post_title)), 0, 20," ~ "); ?></span></a>
		
		</div>
	
	</div>
  
<?php endif; ?>

	<?php $next_post = get_next_post();
		
		  $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID),'Yarn_small_img', 'Yarn');
		
		  if (!empty( $next_post )): ?>
     
    <div class="next" data-aos="slide-left" data-aos-delay="1.5s">
  
		<div class="arrow"><i class="iconfont">&#xe623;</i></div>
  	
		<div class="preview">
	
			<div class="pull-right featuredImg" style="background-image:url('<?php if ( has_post_thumbnail($next_post)) : ?><?php echo esc_url($thumb_url[0]); ?><?php else : ?><?php echo get_template_directory_uri() . '/assets/img/no-image.png'; ?><?php endif; ?>');"></div>

			<a class="pull-right preview-content bold" href="<?php echo get_permalink( $next_post->ID ); ?>"><span><?php echo mb_strimwidth(strip_tags(apply_filters(¡®the_title¡¯,$next_post->post_title)), 0, 20," ~ "); ?></span></a>

		</div>
		
    </div>
  
<?php endif; ?>  
  
</div>