<?php if ( $_POST['action'] != 'ajax_post' ){get_header();} ?>
			
			<div id="content" class="post-single">
				<div id="singular-content">
				
					<?php /* The loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
						<?php comments_template(); ?>
					<?php endwhile; ?>
					
				</div>
				
			</div><!--content-->
			
<?php if ( $_POST['action'] != 'ajax_post' ){get_footer();} ?>