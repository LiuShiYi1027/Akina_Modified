<?php
/* quicktags */	
function enable_more_buttons($buttons) {      
     $buttons[] = 'fontselect';      
     $buttons[] = 'fontsizeselect';      
     $buttons[] = 'wp_page';      
     $buttons[] = 'backcolor';      
     return $buttons;      
} 
	 
function my_quicktags() {
    wp_enqueue_script(
        'my_quicktags',
        get_stylesheet_directory_uri().'/assets/js/quicktags.js',
        array('quicktags')
		);
};

function type_tinymce()
{
	global $typenow;
	if ( ! in_array( $typenow, array( 'post', 'page' ) ) ) {
		return;
	}

	add_filter( 'mce_external_plugins', 'type_tinymce_plugin' );
	add_filter( 'mce_buttons', 'type_tinymce_buttons' );
}

function type_tinymce_plugin( $plugin_array )
{
	$plugin_array['fb_test'] = get_template_directory_uri() . '/assets/js/buttons.js';

	return $plugin_array;
}

function type_tinymce_buttons( $buttons )
{
	array_push( $buttons, 'type_button' );
	array_push( $buttons, 'type_alert' );
	array_push( $buttons, 'type_pullquote' );

	return $buttons;
}

function my_shortcodes_mce_css() {
	wp_enqueue_style('symple_shortcodes-tc', get_template_directory_uri().'/includes/admin.css');
}
add_action( 'admin_enqueue_scripts', 'my_shortcodes_mce_css' );
