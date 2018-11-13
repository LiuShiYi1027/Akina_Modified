<?php 

	/**
	 Template Name: 友情链接
	 */

	get_header(); 

?>

	<?php while(have_posts()) : the_post(); ?>
	
		<article <?php post_class("post-item"); ?>>

            <span class="linkss-title">友链</span>

			<?php the_content(); ?>
			
			<div class="links">
				<?php echo get_link_items(); ?>
			
			</div>
			


		</article>
	<?php endwhile; ?>

<?php

get_footer();
