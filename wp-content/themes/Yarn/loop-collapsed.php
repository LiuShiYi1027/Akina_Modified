<?php if (have_posts()): ?>
    
    <article itemscope="itemscope" itemtype="<?php echo esc_url('http://schema.org/Blog'); ?>">
	
    <div class="posts-list js-posts">
	
	<?php if (theme_option('loop-type')) : ?>	
	
	<?php get_template_part('modules/loop-Multi'); ?>

	<?php else : ?>
	
	<?php get_template_part('modules/loop-normal'); ?>
	
	<?php endif; ?>
	
	</div><!-- post-formats end Infinite Scroll star -->	
	
	<?php else: ?>

	<h2><?php _e( 'Sorry, nothing to display.', 'Yarn' ); ?></h2>
		
	</article>

<?php endif; ?>