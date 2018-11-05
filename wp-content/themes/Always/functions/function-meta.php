<?php
/**
 * theme_meta
 */
function Always_meta(){ ?>
	<meta charset="UTF-8" />
	<?php
		global $post;
		$options = get_option('Always_options');
		if ( is_home() ){
			if ( $options['description'] ){
				$description = $options['description'];
			}else{
				$description = get_bloginfo( 'description' );
			}
			if ( $options['keywords'] ){
				$keywords = $options['keywords'];
			}else{
				$keywords = get_bloginfo( 'name' );
			}
		}else if ( is_single() ){
		$description = get_post_meta($post -> ID, "description", true);
			if ( $description == ""){
				if($post -> post_excerpt){
				$description = $post -> post_excerpt;
			}else{
				$description = mb_strimwidth(strip_tags($post -> post_content),0,200,'');
			}
			}
			$keywords = get_post_meta($post -> ID, "keywords", true);
			if ( $keywords == "" ){
				$tags = wp_get_post_tags($post->ID);
				foreach ($tags as $tag){
					$keywords = $keywords.$tag->name.",";
				}
				$keywords = rtrim($keywords, ', ');
			}
		}else if( is_page() ){
			$description = get_post_meta($post -> name, "description", true);
			$keywords = get_post_meta($post->name, "keywords", true);
		}else if( is_category() ){
			$description = category_description();
			$keywords = single_cat_title('', false);
		}else if( is_tag() ){
			$description = tag_description();
			$keywords = single_tag_title('', false);
		}
		$description = trim(strip_tags($description));
		$keywords = trim(strip_tags($keywords));
	?>
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
	<link rel="shortcut icon" type="images/x-icon" href="<?php if ( $options['favicon'] ){echo $options['favicon'];} else{echo get_bloginfo("template_url") .'/images/favicon.ico';} ?>" />
	<link rel="pingback" href="<?php bloginfo("pingback_url"); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php  bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
	
<?php
}
?>