<?php

// Add Actions
add_action( 'init', 'jquery_register' );
add_action( 'init', 'remove_open_sans_from_wp_core' );//remove open sans
add_action( 'init', 'html5blank_header_scripts' ); // Add Custom Scripts to wp_head(assets.php)
add_action( 'wp_enqueue_scripts', 'html5blank_styles' ); // Add Theme Stylesheet(assets.php)
add_action( 'wp_enqueue_scripts', 'mfthemes_scripts' );//load the commentajax.js ineed
add_action( 'customize_register', 'type_customize_register' );//(options.php)
add_action( 'wp_footer', 'custom_infinite_scroll_js', 100 );//(functions.php)
add_action( 'admin_head', 'type_tinymce' );//(tinymce.php)
add_action('admin_print_scripts', 'my_quicktags');
add_action('wp_head', 'record_visitors');  
add_action('pre_ping','theme_noself_ping');
add_action( 'after_setup_theme', 'wps_attachment_display_settings' );

// Remove Actions
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // Index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
//Embeds
remove_action( 'parse_query', 'wp_oembed_parse_query' );
remove_action( 'wp_head', 'wp_oembed_remove_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_remove_host_js' );