<?php
add_shortcode( 'chatl', 'chatLeft' );
add_shortcode( 'chatr', 'chatRight' );

add_shortcode( 'button', 'type_shortcode_button' );
add_shortcode( 'alert', 'type_shortcode_alert' );
add_shortcode( 'pullquote', 'type_shortcode_pullquote' );

function chatLeft( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'id' => '小左',
		'dir' => 'left',
	), $atts ) );

	return '<div class="chatbox cf"><section class="red chat_content '.$dir.'"><div class="chat-arrow"></div><div class="bub">'.$content.'</div></section></div>';
}
function chatRight( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'id' => '小右',
		'dir' => 'right',
	), $atts ) );

	return '<div class="chatbox cf"><section class="green chat_content '.$dir.'"><div class="chat-arrow"></div><div class="bub">'.$content.'</div></section></div>';
}

function type_shortcode_button( $atts, $content = null )
{
	$content = trim( do_shortcode( shortcode_unautop( $content ) ) );
	extract( shortcode_atts( array( "href" => 'http://' ), $atts ) );

	return '<p><a class="milli" href="' . $href . '">
		<span class="btn btn--primary">' . $content . '</span>
	</a></p>';
}

function type_shortcode_alert( $atts, $content = null )
{
	$content = trim( do_shortcode( shortcode_unautop( $content ) ) );
	extract( shortcode_atts( array( "type" => 'success' ), $atts ) );

	return '<p class="alert alert--' . $type . '">' . $content . '</p>';
}

function type_shortcode_pullquote( $atts, $content = null )
{
	$content = trim( do_shortcode( shortcode_unautop( $content ) ) );
	extract( shortcode_atts( array(), $atts ) );

	return '<quote class="pullquote">' . $content . '</quote>';
}
