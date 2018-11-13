<?php 

	/**
	 * AUTHOR PROFILE
	 */

?>

	<section class="author-profile">
		<div class="info" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
			<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="profile gravatar">
                <?php if (akina_option('focus_logo')): ?>
                    <img src="<?php echo akina_option('focus_logo', ''); ?>" itemprop="image" alt="<?php the_author(); ?>">
                <?php else : ?>
                    <img src="//img.alicdn.com/imgextra/i2/2038135983/TB2lFWRaWi5V1BjSspaXXbrApXa_!!2038135983.png" itemprop="image" alt="<?php the_author(); ?>">
                <?php endif; ?>
            </a>
			<div class="meta">
				<span class="title"><?php esc_html_e('Author', 'akina'); ?></span>	
				<h3 itemprop="name">
					<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" itemprop="url" rel="author"><?php the_author(); ?></a>
				</h3>						
			</div>
		</div>
		<hr>
		<?php if (akina_option('author_location')) echo ' <div class="author_local"><i class="iconfont">&#xe622;</i> ' . akina_option('author_location') . '</div>' ?>
		<p><i class="iconfont">&#xe638;</i><?php echo akina_option('admin_des', 'Carpe Diem and Do what I like'); ?></p>
	</section>
