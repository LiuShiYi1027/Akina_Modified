<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	  $array_posts = array ();
		
	  if (have_posts()) :
	  
	  while (have_posts()) : the_post();
	  
	  array_push($array_posts, array("title"=>get_the_title(),"url"=>get_permalink()));
		
	  endwhile;
	  
	  endif;
	  
      echo json_encode($array_posts);
		
    } else {
	
	get_header(); ?>

	<?php $count = $wp_query->found_posts; ?>
	
	<?php $posts = query_posts($query_string . '&orderby=date&showposts=10000'); ?>

	<h1 class="page-title"><?php _e('以', 'Yarn') ?>&ldquo;<?php echo get_search_query(); ?>&rdquo;为关键字</h1>

	<p class="Searchmeta"><?php printf( _n( '共计 %d 篇文章', '共计 %d 篇文章', $count, 'Yarn' ), $count); ?></p>

	<?php get_template_part('archive'); ?>

<?php get_footer();} ?>
