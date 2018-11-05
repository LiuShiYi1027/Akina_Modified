<?php
	
	// Primary Menu 
	register_nav_menus( array( 'primary' => esc_html__( 'Primary Menu','Yarn' ) ) );

	if ( ! isset( $content_width ) ) {$content_width = 800;	}
	
	// Post-formats
    add_theme_support( 'post-formats', array('image','status','quote') );
	
    // valid HTML5
	add_theme_support( 'html5',array( 'search-form','comment-form','comment-list','gallery','caption',) );
		
	// Excerpt-length
	function new_excerpt_length($length) {
		return 120;
	}
	function new_excerpt_more($more) {
	return '...';
	}
	
	// Post-thumbnails
	add_theme_support( 'post-thumbnails' );
    
	// Add thumbnail image size
    add_image_size( 'Yarn_small_img', 250, 250, true );
    add_image_size( 'Yarn_medium_img', 800, 0 );
    add_image_size( 'Yarn_large_img', 1280, 0 );
	
	function wps_attachment_display_settings() {
	update_option( 'image_default_align', 'center' );
	update_option( 'image_default_link_type', 'file' );
	update_option( 'image_default_size', 'full' );
	}
	
	// Catch first img
	function catch_first_img() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1][0];
	if(empty($first_img)){ //Defines a default image
     $first_img =get_template_directory_uri().'/assets/img/thumbnail.jpg';
	}
	echo $first_img;
	}

	// Internal link for Yarn
	function get_this_site_domain(){
	preg_match( '/https?:\/\/(.+?)\//i', admin_url(), $results );
	return $results[1];
	}

	function get_the_custom_excerpt($content, $length) {
	$length = ($length ? $length : 70);
	$content =  preg_replace('/<!--more-->.+/is',"",$content);
	$content =  strip_shortcodes($content);
	$content =  strip_tags($content);
	$content =  str_replace("&nbsp;","",$content);
	$content =  mb_substr($content,0,$length);
	return $content;
	}

	function url_to_blog_card($the_content) {
	if ( is_singular() ) {
    $res = preg_match_all('/^(<p>)?(<a.+?>)?https?:\/\/'.preg_quote(get_this_site_domain()).'\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+(<\/a>)?(<\/p>)?(<br ? \/>)?$/im', $the_content,$m);
    foreach ($m[0] as $match) {
      $url = strip_tags($match);//URL
      $id = url_to_postid( $url );
      if ( !$id ) continue;
      $post = get_post($id);
      $title = $post->post_title;
      $date = mysql2date('Y-m-d H:i', $post->post_date);//时间戳
      $excerpt = get_the_custom_excerpt($post->post_content, 100);//文本输出
      $thumbnail = get_the_post_thumbnail($id,'Yarn_small_img',array('class' => 'blog-card-thumb-image'));//调用WP最小分辨率缩略图
      if ( !$thumbnail ) {//不显示缩略图时可用no-image代替
        $thumbnail = '<img src="'.get_template_directory_uri().'/assets/img/no-image.png"/>';
      }
      //结构
      $tag = '<a href="'.$url.'" class="blog-card-title-link"><div class="blog-card"><div class="blog-card-thumbnail">'.$thumbnail.'</div><div class="blog-card-content"><div class="blog-card-date clearfix">'.$date.'</div><div class="blog-card-title">'.$title.'</div><div class="blog-card-excerpt">'.$excerpt.'</div></div></div></a>';
      //把本文中的URL用博客卡标签替换
      $the_content = preg_replace('{'.preg_quote($match).'}', $tag , $the_content, 1);
    }
	}
	return $the_content;//返回置换后的内容
	}
	
	function url_to_hatena_blog_card($the_content) {
		if ( is_singular() ) {
		$res = preg_match_all('/^(<p>)?(<a.+?>)?https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+(<\/a>)?(<\/p>)?(<br ? \/>)?$/im', $the_content,$m);
    foreach ($m[0] as $match) {
      $url = strip_tags($match);
      $tag = '<iframe class="hatenablogcard" src="http://hatenablog-parts.com/embed?url='.$url.'" frameborder="0" scrolling="no"></iframe>';
      $the_content = preg_replace('{'.preg_quote($match).'}', $tag , $the_content, 1);
    }
	}
	return $the_content;
	}
	
	// All tags with link
	$match_num_from = 1;        //一篇文章中同一个标签少于几次不自动链接
	$match_num_to = 1;      //一篇文章中同一个标签最多自动链接几次
	function tag_sort($a, $b){
    if ( $a->name == $b->name ) return 0;
    return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
	}
	function tag_link($content){
    global $match_num_from,$match_num_to;
        $posttags = get_the_tags();
        if ($posttags) {
            usort($posttags, "tag_sort");
            foreach($posttags as $tag) {
                $link = get_tag_link($tag->term_id);
                $keyword = $tag->name;
                $cleankeyword = stripslashes($keyword);
                $url = "<a class='autotag' href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('【查看含有[%s]标签的文章】'))."\"";
                $url .= ' target="_blank"';
                $url .= ">".addcslashes($cleankeyword, '$')."</a>";
                $limit = rand($match_num_from,$match_num_to);
                $content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
                $content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
                $cleankeyword = preg_quote($cleankeyword,'\'');
                $regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
                $content = preg_replace($regEx,$url,$content,$limit);
                $content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);
            }
        }
    return $content;
	}
	
	// Remove jquery wpmigrate in wordpress
	function remove_jquery_migrate( &$scripts){
    if(!is_admin()){
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.2.1' );
    }
	}
	// Forbiden pingback 
	function theme_noself_ping( &$links ) { 
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
	if ( 0 === strpos( $link, $home ) )
	unset($links[$l]); 
	}
	
	// Forbiden wptexturize 
	$qmr_work_tags = array('the_title','the_excerpt','single_post_title','comment_author','comment_text','link_description','bloginfo','wp_title', 'term_description','category_description','widget_title','widget_text');
	foreach ( $qmr_work_tags as $qmr_work_tag ) {
    remove_filter ($qmr_work_tag, 'wptexturize');
	}
	
	// Remove open sans
	function remove_open_sans_from_wp_core() {
		wp_deregister_style( 'open-sans' );
		wp_register_style( 'open-sans', false );
		wp_enqueue_style('open-sans','');
	}

	// img nofollow 
	function imgnofollow( $content ) {
    $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
    if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
        if( !empty($matches) ) {
            $srcUrl = get_option('siteurl');
            for ($i=0; $i < count($matches); $i++)
            {
                $tag = $matches[$i][0];
                $tag2 = $matches[$i][0];
                $url = $matches[$i][0];
                $noFollow = '';
                $pattern = '/target\s*=\s*"\s*_blank\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                    $noFollow .= ' target="_blank" ';
                $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                    $noFollow .= ' rel="nofollow" ';
                $pos = strpos($url,$srcUrl);
                if ($pos === false) {
                    $tag = rtrim ($tag,'>');
                    $tag .= $noFollow.'>';
                    $content = str_replace($tag2,$tag,$content);
                }
            }
        }
    }
    $content = str_replace(']]>', ']]>', $content);
    return $content;
	}

	// Avatar 
	function mytheme_get_avatar($avatar) {
		$avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"cn.gravatar.com",$avatar);
	return $avatar;
	}

	// Post views
	if ( ! function_exists( 'Yarn_post_views' ) ) :
		function record_visitors(){
	if (is_singular()) 
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
	}

	function Yarn_post_views($after=''){
	global $post;
	$post_ID = $post->ID;
	$views = (int)get_post_meta($post_ID, 'views', true);
	echo $views, $after;
	}
	endif;

	// Friends links 
	function get_the_link_items($id = null){
    $bookmarks = get_bookmarks('orderby=date&category=' . $id);
    $output    = '';
    if (!empty($bookmarks)) {
        $output .= '<div class="catalog-share">' . count($bookmarks) . ' items in collection</div><div class="userItems">';
        foreach ($bookmarks as $bookmark) {
            $output .= '<div class="userItem"><div class="userItem--inner"><div class="userItem-content">'. get_avatar($bookmark->link_notes,64) . '
            <div class="userItem-name"><a class="link link--primary" href="' . $bookmark->link_url . '" target="_blank" >' . $bookmark->link_name . '</a></div></div></div></div>';
        }
        $output .= '</div>';
    }
    return $output;
	}

	function get_link_items(){
    $linkcats = get_terms('link_category');
    if (!empty($linkcats)) {
        foreach ($linkcats as $linkcat) {
            $result .= '
            <h3 class="catalog-title">' . $linkcat->name . '</h3><div class="catalog-description">' . $linkcat->description . '</div>
            ';
            $result .= get_the_link_items($linkcat->term_id);
        }
    } else {
        $result = get_the_link_items();
    }
    return $result;
	}
	
	// Yarn comment structure
	if ( ! function_exists( 'Yarn_comment_format' ) ) {
	function Yarn_comment_format( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment_body contents">
    <?php if( !$parent_id = $comment->comment_parent){ ?>
						<div class="profile">
							<a href="<?php comment_author_url(); ?>"><img src="//cn.gravatar.com/avatar/<?php echo esc_attr(md5($comment->comment_author_email)); ?>?s=96" class="gravatar" alt="<?php comment_author(); ?>"></a>
						</div>
						<div class="main shadow">
							<div class="commentinfo">
									<section class="commeta">
									<div class="shang">
										<h4 class="author"><a href="<?php comment_author_url(); ?>" target="_blank"><img src="//cn.gravatar.com/avatar/<?php echo esc_attr(md5($comment->comment_author_email)); ?>?s=24" class="gravatarsmall" alt="<?php comment_author(); ?>"><?php comment_author(); ?></a></h4>
									</div>
									</section>
							</div>
							
								<?php if ( '0' == $comment->comment_approved ) : ?>
											<div class="comment-awaiting-moderation">您的评论正在排队等待审核，请稍后再来！</div>
								<?php endif; ?>
								
							<div class="body"><?php comment_text(); ?></div>
								<div class="xia info">
										<span><time datetime="<?php comment_date('Y-m-d'); ?>"><?php comment_date(get_option('date_format')); ?></time></span>
										<span><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
									</div>	
						</div>
    <?php } else { ?>
						<div class="profile">
							<a href="<?php comment_author_url(); ?>"><img src="//cn.gravatar.com/avatar/<?php echo esc_attr(md5($comment->comment_author_email)); ?>?s=96" class="gravatar" alt="<?php comment_author(); ?>"></a>
						</div>
						<div class="main shadow">
							<div class="commentinfo">
									<section class="commeta">
									<div class="shang">
										<h4 class="author"><a href="<?php comment_author_url(); ?>" target="_blank"><img src="//cn.gravatar.com/avatar/<?php echo esc_attr(md5($comment->comment_author_email)); ?>?s=24" class="gravatarsmall" alt="<?php comment_author(); ?>"><?php comment_author(); ?></a></h4>
									</div>
									
									<div class="body"><?php comment_text(); ?></div>
							
								<?php if ( '0' == $comment->comment_approved ) : ?>
											<div class="comment-awaiting-moderation">您的评论正在排队等待审核，请稍后再来！</div>
								<?php endif; ?>
										
									</section>
							</div>
								<div class="xia info">
										<span><time datetime="<?php comment_date('Y-m-d'); ?>"><?php comment_date(get_option('date_format')); ?></time></span>
										<span><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
									</div>	
						</div>
    <?php } ;?>
		</div>
	<?php
		}
	}
	
	function comment_add_at_parent( $comment_text ) {
	$comment_ID = get_comment_ID();
	$comment    = get_comment( $comment_ID );
	if ( $comment->comment_parent ) {
		$parent_comment = get_comment( $comment->comment_parent );
		$comment_text   = preg_replace( '/<a href="#comment-([0-9]+)?".*?>(.*?)<\/a>/i', '', $comment_text );
		$comment_text   = '<a class="name" href="#comment-' . $comment->comment_parent . '" rel="nofollow" data-id="' . $comment->comment_parent . '" class="cute atreply">@' . $parent_comment->comment_author . '</a> : ' . $comment_text;
	}

	return $comment_text;
	}

	// Comment_mail_notify
	function comment_mail_notify($comment_id){
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if(($parent_id != '') && ($spam_confirmed != 'spam')){
    $wp_email = 'webmaster@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '你在 [' . get_option("blogname") . '] 的留言有了回应';
    $message = '
    <div style="font-family:Courier New, Courier, monospace, sans-serif;max-width:600px;background-color: white; border: 1px solid #DDDDDD; margin-right: auto; margin-left: auto;">
	<div style="margin-left:30px;margin-right:30px">
    <p>&nbsp;</p>
    <p><strong>您有一条来自 <a href="'.home_url().'" target="_blank" style="color:#3D3D3D;text-decoration:none;">' . get_option("blogname") . '</a> 的回复</strong></p>
    <hr style="margin-top:10px;margin-bottom:65px;border:none;border-bottom:1px solid red"/>
    <h1 style="font-weight: normal; color: #2A2A2A; text-align: center; margin-bottom: 65px;font-size: 20px; letter-spacing: 6px;font-weight: normal; border:1px solid #2A2A2A;; padding: 15px;">THANKS FOR YOUR COMMENTS</h1>
	<td  style="padding:15px;"><p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong>, 你好!</span>
    <p>你在《' . get_the_title($comment->comment_post_ID) . '》的留言:</p>
	<p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">' . trim(get_comment($parent_id)->comment_content) . '</p>
	<p>' . trim($comment->comment_author) . ' 给你的回复:</p>
	<p style="border-left:3px solid #ddd;padding-left:1rem;margin-bottom: 75px;color:#999;">' . trim($comment->comment_content) . '</p>
	</td>
    <table style="margin:0 auto;">
      <th>
        <td style="background-color:black;text-align:center;padding:15px"><a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank" style="text-decoration:none;color: white;text-align:center;font-weight:600;letter-spacing:2px;background-color:black;padding:15px">查看完整内容</a></td>
      </th>
    </table>
    <hr style="margin-top:10px;margin-top:75px"/>
    <p style="text-align:center;margin-bottom:15px"><small style="text-align:center;font-size:10px;color#666;">CC BY-SA 4.0 <a href="'.home_url().'"  style="color:#666">Copyright © '.get_option("blogname").'</a> | Made with <span style="color:red">&hearts;</span> in MacOS </small></p>
    <p>&nbsp;</p>
	</div>
	</div>
	';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
		}
	}
	add_action('comment_post', 'comment_mail_notify');
	
	// Pagenavi if no infinite scroll
	function pagenavi( $p = 2 ) {
	if ( is_singular() ) return;
	global $wp_query, $paged;
	$max_page = $wp_query->max_num_pages;
	if ( $max_page == 1 ) return;
	if ( empty( $paged ) ) $paged = 1;
	if ( $paged > 1 ) p_link( $paged - 1, '前翻', 'Prev' );
	if ( $paged > $p + 2 ) echo '<span class="page-numbers"> « </span>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
		if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );
	}
	if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers"> » </span>';
	if ( $paged < $max_page ) p_link( $paged + 1,'后翻', 'Next' );
	}

	function p_link( $i, $title = '', $linktype = '' ) {
	if ( $title == '' ) $title = "第 {$i} 页";
	if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
	echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
	}

	// Infinite Scroll 
	function custom_infinite_scroll_js()
	{
	?>
	<script>
		var infinite_scroll = {
			loading: {
				img: '<?php echo get_template_directory_uri(); ?>/assets/img/ajax-loader.gif',
				msgText: '',
				finishedMsg: ''
			},
			nextSelector: '.js-next a',
			navSelector: '.js-pagination',
			itemSelector: '.post,.archive-post',
			contentSelector: '.js-posts'
		};
	</script>
	<?php
	}

	// post pagination by c.bavota
	function custom_wp_link_pages( $args = '' ) {
	$defaults = array(
		'before' => '<p id="post-pagination">', 
		'after' => '</p>',
		'text_before' => '',
		'text_after' => '',
		'next_or_number' => 'number', 
		'pagelink' => '%',
		'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= $before;
			for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
				$j = str_replace( '%', $i, $pagelink );
				$output .= ' ';
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= _wp_link_page( $i );
				else
					$output .= '<span class="current-post-page">';

				$output .= $text_before . $j . $text_after;
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= '</a>';
				else
					$output .= '</span>';
			}
			$output .= $after;
		} else {
			if ( $more ) {
				$output .= $before;
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $previouspagelink . $text_after . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $nextpagelink . $text_after . '</a>';
				}
				$output .= $after;
			}
		}
	}

	if ( $echo )
		echo $output;

	return $output;
	}	
	
	// Get thumbnail for images post thanks alibaixiu 
	function hui_get_thumbnail( $single=true, $must=true ) {
    global $post;
    $html = '';
    if ( has_post_thumbnail() ) {
        $domsxe = simplexml_load_string(get_the_post_thumbnail());
        $src = $domsxe->attributes()->src;
        $src_array = wp_get_attachment_image_src(hui_get_attachment_id_from_src($src), 'Yarn_small_img');
        $html = sprintf('<div class="col-xs-4"><img class="thumb" src="%s" /></div>', $src_array[0]);
    } else {
        $content = $post->post_content;
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $images = $strResult[1];
        $counter = count($strResult[1]);
        $i = 0;
        foreach($images as $src){
            $i++;
            $src2 = wp_get_attachment_image_src(hui_get_attachment_id_from_src($src), 'Yarn_small_img');
            $src2 = $src2[0];
            if( !$src2 && true ){
                $src = $src;
            }else{
                $src = $src2;
            }
            $item = sprintf('<div class="col-xs-4"><img class="thumb" src="%s" /></div>', $src);
            if( $single){
                return $item;
                break;
            }
            $html .= $item;
            if(
                ($counter >= 2 && $counter < 5 && $i >= 2) ||
                ($counter >= 5 && $counter < 8 && $i >= 5) ||
                ($counter >= 8 && $i >= 8) ||
                ($counter > 0 && $counter < 2 && $i >= $counter)
            ){
                break;
            }
        }
    }
    return $html;
	}
	function hui_get_attachment_id_from_src ($link) {
    global $wpdb;
    $link = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link);
    return $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE guid='$link'");
	};
	
	if( !function_exists('get_post_images_number') ){  
    function get_post_images_number(){  
        global $post;  
        $content = $post->post_content;    
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $result, PREG_PATTERN_ORDER);    
        return count($result[1]);    
    }  
	};  
	
	// Footer information
	function Yarn_admin_footer_text($text) {
       $text = '<span id="footer-thankyou" style="font-style:normal">感谢购买并使用WordPress 主题<a href="http://jjlin.net/buying.html" target="_blank">Yarn</a>，请勿转售或外传，谢谢。</span>';
    return $text;
	};

	add_filter('admin_footer_text', 'Yarn_admin_footer_text');

