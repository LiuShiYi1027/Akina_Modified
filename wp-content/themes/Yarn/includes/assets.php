<?php

function jquery_register() {
if ( !is_admin() ) {
wp_deregister_script( 'jquery' );
wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js' , false, null, true );
wp_enqueue_script( 'jquery' );
		}
}

function html5blank_header_scripts()
{
	global $wp_query;

	if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
	   /* wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js' , array(), '2.2.4', false);    */
		wp_enqueue_script( 'type_theme_plugins', get_template_directory_uri() . '/assets/js/plugins.js' , array(), '1.10.2', true);    
		wp_enqueue_script( 'type_theme_script', get_template_directory_uri() . '/assets/js/script.js', array(), '1.00', true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	}
}
function mfthemes_scripts() {
    if ( theme_option('particles-effect') ){	
	wp_enqueue_script( 'particles-effect', get_template_directory_uri() . '/assets/js/particles.js', array(), '1.00', true );
	}
	wp_enqueue_script( 'aos', get_template_directory_uri() . '/assets/js/aos.js', array(), '1.00', true);	
	if ( is_singular() || is_page() ){
	wp_enqueue_script( 'prism', get_template_directory_uri() . '/assets/js/prism.js', array(), '1.00', true);	
	wp_enqueue_script( 'gravatar', get_template_directory_uri() . '/assets/js/gravatar.js', array(), '1.00', true);	
	wp_enqueue_script( 'comments-ajax', get_template_directory_uri() . '/ajax-comment/comments-ajax.js', array(), '1.00', true);
	}
}
// Load HTML5 Blank styles
function html5blank_styles()
{
	wp_enqueue_style( 'yarn-style', get_template_directory_uri().'/style.css' );
	wp_enqueue_style( 'yarn-style', get_stylesheet_uri(), array('yarn-style')  );// chlid 
	wp_enqueue_style( 'gallery', get_template_directory_uri() . '/assets/css/gallery.css' );
	if ( theme_option('setanimate') ){	
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/aos.css' );
	}
	if ( is_singular() || is_page() ){	
	wp_enqueue_style( 'prism', get_template_directory_uri() . '/assets/css/prism.css' );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/assets/css/fancybox.css' );
	}
}