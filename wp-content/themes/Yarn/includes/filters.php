<?php
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );
add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
add_filter( 'get_avatar', 'mytheme_get_avatar', 10, 3 );
add_filter( 'comment_text','comment_add_at_parent' );
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );
add_filter( 'the_content','url_to_blog_card' );
add_filter( 'the_content','url_to_hatena_blog_card' );
add_filter( 'embed_oembed_discover', '__return_false' ); 
add_filter( 'wp_default_editor', create_function('', 'return "html";'));
add_filter( 'excerpt_more', 'new_excerpt_more' );
add_filter( 'excerpt_length', 'new_excerpt_length' );
add_filter( 'the_content', 'imgnofollow' );
add_filter( 'admin_footer_text', 'Yarn_admin_footer_text' );
add_filter( 'mce_buttons','enable_more_buttons' );  
add_filter( 'the_content','tag_link',1 );	
add_filter( 'use_default_gallery_style', '__return_false' );

remove_filter( 'the_excerpt', 'wpautop' );
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10);
remove_filter( 'oembed_response_data', 'get_oembed_response_data_rich', 10, 4 );
remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result' );
remove_filter( 'comment_text', 'wptexturize');
remove_filter( 'the_excerpt', 'wptexturize');
remove_filter( 'the_content', 'wptexturize');
