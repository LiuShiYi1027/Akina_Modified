<?php get_header();?>

	<div class="location">当前位置：<a href="<?php echo get_option('home'); ?>/">首页</a><?php wp_title(); ?>

	</div>	
	
	<div class="posts-list js-posts" itemscope="itemscope" itemtype="<?php echo esc_url('http://schema.org/Blog'); ?>">
	
		<?php if(have_posts()):while(have_posts()):the_post(); ?>

		<?php if ( has_post_format( 'status' )){ ?>
		
			<div class="archive-post">
							
			<div class="type"><div class="mask"><i class="iconfont">&#xe603;</i></div></div>
				
				<h2 class="archive-title" style="color: #<?php echo $colors[$i++] ?>">

					<span>
					
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
					
					</span>
					
					<div class="post-time"><?php the_time('Y/m/d'); ?></div>

				</h2>
				
			<div class="post-category"><?php the_category(','); ?></div>

			</div>
        
		<?php } else if (has_post_format('image')) { ?>	
		
			<div class="archive-post">
				
			<div class="type"><div class="mask" ><i class="iconfont">&#xe61e;</i></div></div>
				
				<h2 class="archive-title" style="color: #<?php echo $colors[$i++] ?>">

					<span>
					
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
					
					</span>
					
					<div class="post-time"><?php the_time('Y/m/d'); ?></div>

				</h2>
				
				<div class="post-category"><?php the_category(','); ?></div>

			</div>
			
		<?php } else if (has_post_format('quote')) { ?>	
		
			<div class="archive-post">
				
			<div class="type"><div class="mask"><i class="iconfont">&#xe60d;</i></div></div>
				
				<h2 class="archive-title" style="color: #<?php echo $colors[$i++] ?>">

					<span>
					
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
					
					</span>
					
					<div class="post-time"><?php the_time('Y/m/d'); ?></div>

				</h2>
				
				<div class="post-category"><?php the_category(','); ?></div>

			</div>
			
		<?php } else { ?>
		
			<div class="archive-post">
				
			<div class="type"><div class="mask"><i class="iconfont">&#xe608;</i></div></div>
                
				<h2 class="archive-title" style="color: #<?php echo $colors[$i++] ?>">

					<span>
					
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
					
					</span>
					
					<div class="post-time"><?php the_time('Y/m/d'); ?></div>

				</h2>
				
				<div class="post-category"><?php the_category(','); ?></div>

			</div>
			
		<?php } ?>
		
		<?php endwhile;endif; ?>
		
	</div>

	<div class="mt+"><?php get_template_part('pagination'); ?></div>
	
<?php get_footer(); ?>