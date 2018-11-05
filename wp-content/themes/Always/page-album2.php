<?php
/*
  Template Name: Album2
 */
?>
<?php if ( $_POST['action'] != 'ajax_post' ){get_header();} ?>
			
			<div id="content" class="album2">
			
					<?php /* The loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php
							preg_match_all('/\<img.+?src="(.+?)".*?\/>/is ',$post->post_content,$matches ,PREG_SET_ORDER);
							foreach ( $matches as $key => $value ){
								echo '<article><div class="entry-content"><a href="' .$value[1]. '"><img src="' .$value[1]. '" /></a></div></article>';
							}
						?>
					<?php endwhile; ?>
					
			</div><!--content-->
			
<?php if ( $_POST['action'] != 'ajax_post' ){get_footer();} ?>