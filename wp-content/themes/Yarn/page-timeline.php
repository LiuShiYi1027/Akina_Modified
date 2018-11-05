<?php get_template_part('modules/Yarn_thumb'); ?>

<?php /** Template Name: update*/ get_header();?>

	<?php while(have_posts()) : the_post(); ?>

	<?php if ( is_page() ) {?> <style>body.custom-background {background:#fff}.container {padding:10px 0px;}</style> <?php } ?>
 
		<section class="post_content" itemscope itemtype="http://schema.org/Article">
		
	    <header class="post_header">
		
            <h1 class="post_title" ><?php the_title(); ?></h1>
			
        </header>

			
				<?php the_content(); ?>
				
			
		</section>
		
	<?php endwhile; ?>

<?php get_footer(); ?>
