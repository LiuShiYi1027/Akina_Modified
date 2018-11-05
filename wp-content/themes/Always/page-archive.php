<?php
/*
  Template Name: Archive
 */
?>
<?php if ( $_POST['action'] != 'ajax_post' ){get_header();} ?>
			
			<div id="content" class="post-single">
				<div id="singular-content">
					<?php /* The loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>">

							<header class="entry-header">
								<h1><?php the_title(); ?></h1>
							</header>
							
							<div class="entry-content">
								<?php the_archives(); ?>
							</div>
							
							<div class="clear"></div>
							
						</article><!--post-->
					<?php endwhile; ?>
				</div>
				
			</div><!--content-->
			
<?php if ( $_POST['action'] != 'ajax_post' ){get_footer();} ?>