<?php get_template_part('modules/Yarn_thumb'); ?>

<?php /** Template Name:Archive*/get_header(); ?>

		<section class="post_content" itemscope itemtype="http://schema.org/Article">
		
	    <header class="post_header">
		
            <h1 class="post_title" ><?php the_title(); ?></h1>
			
        </header>
			
		<div class="post-Archive" >
			<?php $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
			$year=0; $mon=0; $i=0; $j=0;
			$all = array();
			$output = '<div id="archives">';
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$year_tmp = get_the_time('Y');
				$mon_tmp = get_the_time('n');
				//var_dump($year_tmp);
				$y=$year; $m=$mon;
				if ($mon != $mon_tmp && $mon > 0) $output .= '</div></div>';
				
				if ($year != $year_tmp) {
					$year = $year_tmp;
					$all[$year] = array();
				}

				if ($mon != $mon_tmp) {
					$mon = $mon_tmp;
					array_push($all[$year], $mon);
					$output .= "<div class='archive-title' id='arti-$year-$mon'><h3>$year-$mon</h3><div class='archives archives-$mon' data-date='$year-$mon'>"; //输出月份
				}
				$output .= '<div class="brick"><a href="'.get_permalink() .'"><span class="time">'.get_the_time('n-d').'</span>'.get_the_title() .'<span>('. get_comments_number('0', '1', '%') .')</span></a></div>'; //输出文章日期和标题
			endwhile;
			wp_reset_postdata();
			$output .= '</div></div></div>';
			echo $output;
			?>
		</section>

<?php get_footer(); ?>
