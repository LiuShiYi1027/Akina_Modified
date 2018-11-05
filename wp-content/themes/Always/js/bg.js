/*
 *Site Background by 咚门
 *version 1.5
 *Author URL:http://www.dearzd.com
 */
var bg = $('<div id=bg />'),
	bg_img = new Image(),
	bg_img_width = 0,//必须要先保存，否则当append到页面中时，bg_img.width获取的不是原始宽度而是显示宽度
	bg_img_height = 0;
var non_src = 0;
function bg_image_pos(W,o,bg_img){
	var LH=bg_img_height/bg_img_width*W.width(),//对firefox，汗~~啊
		LW=bg_img_width/bg_img_height*W.height();
	o.css({'width':W.width(),'height':W.height()});
	if(LH>=W.height()){
		$(bg_img).css({
			'width':W.width(),
			'height':LH,
			'top':(W.height()-LH)/2,//垂直居中
			'left':0
		});
		
		
	}else{
		$(bg_img).css({
			'height':W.height(),
			'width':LW,
			'left':(W.width()-LW)/2,//水平居中
			'top':0
		});
	}
}
function ajax_bg(){
	if ( !$( '#bg' )[0] && non_src != 1){
		$.ajax({
			type:'GET',
			url: Always.ajaxurl+"?action=ajax_site_bg",
			success:function(data){
				bg_img.src = data;
				if ( data == "" ){non_src = 1;}
			}
		});
		bg_img.onload = function(){
			//初始化
			bg_img_width = bg_img.width;
			bg_img_height = bg_img.height;
			bg.append(bg_img);
			bg.css({'position':'fixed','left':'0','top':'0','z-index':'-1','overflow':'hidden'});
			$(bg_img).css({'position':'absolute','opacity':'0'});
			
			//定位以及显示
			bg_image_pos($(window),bg,bg_img);
			$( '#wrapper' ).after(bg);
			setTimeout(function(){
				$(bg_img).css({'opacity':'1'});//奇怪，不延迟的话transition动画会不执行
			},30);
			
			$(window).resize(function(){//改变窗口调整大小
				bg_image_pos($(window),bg,bg_img);
			});
		}
	}else{
		if ( document.getElementById("bg") ){$( '#bg img' ).css({'opacity':'1'});};
	}
}
$(document).ready(function(){
	
});