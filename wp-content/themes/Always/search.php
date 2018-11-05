<?php

if ( $_POST['action'] != 'ajax_post' ){get_header();} ?>
		
			<div id="content" class="post-index">
				<?php if ( have_posts() ) : ?>
				
					<?php /* The loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
					<?php endwhile; ?>
					
				<?php endif; ?>
			</div><!--content-->
			<?php pagenavi(); ?>
			
<?php if ( $_POST['action'] != 'ajax_post' ){get_footer();} ?>