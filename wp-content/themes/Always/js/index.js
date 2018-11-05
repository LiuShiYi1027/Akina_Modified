/*
 *Primary JS by 咚门
 *version 1.6
 *Author URL:http://www.dearzd.com
 */
var _loading = $( '#loading-wrap .loading' );//全局loading

//归档页面js
function page_archive(){
	if ( !document.getElementById("archives") ) return false;
	var year = $( '.year:first' ).attr("id").replace("year-", "");
	var old_top = $( '#archives' ).offset().top;
	$( '.year:first, .month:first' ).addClass('selected');
	$( '.year:first' ).parent().addClass('current-year');
	
	$( '.month' ).click(function(){
		var id = "#" + $(this).attr("id").replace("m", "archive");
		var top = $(id).offset().top-40;
		$( '.month.selected' ).removeClass('selected');
		$(this).addClass('selected');
		$( 'body,html' ).scrollTop(top);
	});
	
	$('.year').click(function(){
		if ( !$(this).next().hasClass('selected')){
			$( '.year.selected' ).removeClass('selected');
			$( '.current-year' ).removeClass('current-year');
			$(this).parent().addClass('current-year');
			$(this).addClass('selected');
		}
		$(this).next().click();
	});
	if ( Always.is_mobile != 1 ){//移动端屏蔽
		$(window).scroll(function(){
			var top = $(this).scrollTop();
			$( '.archive-content' ).each(function(){
				var thistop = $(this).offset().top-40,
				thisbottom = thistop + $(this).height();
				var newyear = $(this).attr("id").replace(/archive-(\d*)-\d*/, "$1");
				if ( top >= thistop && top <= thisbottom){
					if ( newyear != year ){
						$( '#year-' + year ).parent().removeClass('current-year');
						$( '#year-' + newyear ).parent().addClass('current-year');
						$( '.year.selected' ).removeClass('selected');
						$( '#year-' + newyear ).addClass('selected');
						year = newyear;
					}
					var id = "#" + $(this).attr("id").replace("archive", "m");
					$( '.month.selected' ).removeClass('selected');
					$(id).addClass('selected');
				}
			});
			//下拉超出修复
			if ( top > ( $('#main-footer').offset().top-$( '#archive-nav' ).offset().top-$( '.archive-nav' ).height()) ){
				$( '.archive-nav' ).css({'bottom':$('#main-footer').height()+10});
			}else{
				$( '.archive-nav' ).css({'bottom':'auto'});
			}
		});
	}else{
		$( '#archives').css({'width':'100%'});
	}
}

//留言墙hover 详细信息;;;因overflow:hidden，故需js单独操控
function guestbook_detail(){
	if ( Always.is_mobile != 1 ){//移动端屏蔽
		var guest_detail = $('<div id="guestbook-detail" class="detail" />'),
			detail_left,//左边距
			detail_top,//顶距
			detail_time,//鼠标移开的缓冲
			li_hover = 0,
			detail_hover = 0;	

		//底部留言墙
		$( '.readwall li' ).hover(function(){
			var _this = $(this),
				_window_width = $(window).width();
			$( '#guestbook-detail ')[0] || $( '#wrapper' ).after(guest_detail);
			li_hover = 1;
			clearTimeout(detail_time);
			detail_time = setTimeout(function(){
				//存入详细内容
				guest_detail.html(_this.find('.detail').html());
				//左距离
				detail_left = _this.offset().left - 95;
				if ( detail_left < 0 ) detail_left = 0;
				if ( detail_left + 260 > _window_width ) detail_left = _window_width - 260;
				//顶距
				detail_top = _this.offset().top - guest_detail.height() - 40;
				//往下显示详细信息
				guest_detail.show().css({'left':detail_left,'top':detail_top - 24,'opacity':0}).stop().animate({top:detail_top,opacity:1},300);
				//最后评论ajax绑定
				$( '#guestbook-detail a.recent-comment' ).on('click',function(){//底部留言墙
					try{
						if ( typeof(eval(ajax_start)) == 'function' ){
							//audio_ready();
							var i = ajax_start($(this));
							return i;
						}
					}catch(e){
					
					}
				});
				
			},80);
		},function(){
			li_hover = 0;
			clearTimeout(detail_time);
			detail_time = setTimeout(function(){
				if ( detail_hover == 0 ){
					guest_detail.stop().animate({top:detail_top - 24,opacity:0},300,function(){guest_detail.hide()});
				}
			},20);
		});
		
		guest_detail.hover(function(){
			detail_hover = 1;
		},function(){
			detail_hover = 0;
			clearTimeout(detail_time);
			detail_time = setTimeout(function(){
				if ( li_hover == 0 ){
					guest_detail.stop().animate({top:guest_detail.offset().top - 24,opacity:0},300,function(){guest_detail.hide()});
				}
			},20);
		});
	}
}

function footer_width(){
	var footer_padd;
	if ( $( '#footer-widget' ).width() < 900 ){
		
		if ( $( '#footer-widget' ).width() > 720 ){
			footer_padd = parseInt( ( $( '#footer-widget' ).width() - 720 ) / 6 );
			//alert(padd);
		}else{
			footer_padd = parseInt( ( $( '#footer-widget' ).width()-240 )/ 2 );
			
		}
		
	}else{
		footer_padd = 30;
	}
	$( '.foo-widget' ).css({'padding-left':footer_padd,'padding-right':footer_padd});
}

var footer_ajax_time = 3;//只重复加载3次
function footer_js(){
	footer_ajax_time -= 1;
	$.ajax({
		url:Always.ajaxurl,
		type:'GET',
		data:{action:'ajax_footer'},
		beforeSend:function(){
			
		},
		error:function(){
			if ( footer_ajax_time < 0 ){
				$( '#main-footer' ).prepend('ajax加载失败。');
			}else{
				setTimeout(function(){
					footer_js();
				},100);
			}
		},
		success:function(data){
			$( '#main-footer' ).prepend(data);
			$( '.foo-widget' ).hide().slideDown();
			guestbook_detail();
			//限宽最新评论
			if ( $( '#footer-comments' )[0] ) {
				$( '#footer-comments a' ).on('click',function(){
					var i = ajax_start($(this));
					return i;
				});
			}
			//限宽热门标签
			if ( $( '#footer-tags' )[0] ) {
				$( '#footer-tags a' ).on('click',function(){
					var i = ajax_start($(this));
					return i;
				});
			}
		}
	});
}

//文章主体一些js，和resize无关，也和ajax无关
function article_js(){
	
	//share
	var share_time;
	$( '.share' ).hover(function(){
		clearTimeout(share_time);
		$( '.share ul' ).slideDown('slow');
	},function(){
		share_time=setTimeout(function(){$( '.share ul' ).slideUp('slow');},300);
	});
	
	//有图片的a标签hover修复
	$( '.entry-content a' ).has('img').addClass('has-img-a');
	
}

//菜单隐藏或显示
function narrow_menu(){
	if ( !$( '.post-index' )[0] ){
		if ( $(window).width() < ( $( '#main-nav' ).width() + 100 ) ){
			$( '#main-nav' ).fadeOut();
			$( '#openmenu' ).fadeIn();
		}else{
			$( '#main-nav' ).fadeIn();
			$( '#openmenu' ).fadeOut();
		}
	}else{
		$( '#main-nav' ).fadeIn();
		$( '#openmenu' ).fadeOut();
	}
}

//h3标题格式化
function h3_js(){
	$( 'article h3' ).each(function(){
		var text = $(this).text(),
			line_width = 0,
			margin_top = 0;
		$(this).empty();
		$(this).append('<span class="h3-text">' + text +'</span>');
		line_width = $(this).width() - $(this).find( '.h3-text' ).width() - 12;
		margin_top = $(this).height() / 2 -1;
		$(this).append('<span class="h3-line" style="width:' + line_width + 'px;margin-top:' + margin_top + 'px;"></span>');
	});
}

//顶部logo隐藏与否
function logo_switch(){
	if ( !$( '.post-index' )[0] ) {//非首页执行代码
		$( '#logo' ).animate({marginTop:-120,opacity:0},800,function(){$( '#logo' ).hide();});
		$( '#search-form' ).animate({marginBottom:-24,opacity:0},800,function(){$( '#search-form' ).hide();});
	}else{//首页执行代码
		$( '#logo' ).show().animate({marginTop:12,opacity:1},800);
		$( '#search-form' ).show().animate({marginBottom:12,opacity:1},800);
	}
}

//根据屏幕尺寸相应式的js
function change_js(){
	
	//文章主体宽度
	if ( document.getElementById("singular-content") ){
		if ( $(window).width() < 780 ){
			$( '#singular-content' ).addClass('singular-narrow-content');
		}else{
			$( '#singular-content' ).removeClass('singular-narrow-content');
		}
	}
	
	//page navi
	if ( document.getElementById("wide-page-navi") ){
		if ( $(window).width() < 610 ){
			$( '#wide-page-navi' ).hide();
			$( '#narrow-page-navi' ).show();
		}
		else{
			$( '#wide-page-navi' ).show();
			$( '#narrow-page-navi' ).hide();
		}
	}
	
	//scroll显示与否
	if ( document.getElementById("scrolltop") ){
		if ( $( '.post-index' )[0] ){
			$('#scrolltop').addClass('hide');
		}else{
			if ( $(window).width() > 900 ){
				$('#scrolltop').removeClass('hide');
				if ( $(window).scrollTop()>400 ){
					$('#scrolltop').css({right:( $(window).width() - 780 ) / 4 - 25,bottom:100,opacity:0.7});
				}else{
					$('#scrolltop').css({right:( $(window).width() - 780 ) / 4 - 25,bottom:80,opacity:0});
				}
			}else{
				$('#scrolltop').addClass('hide');
			}
		}
	}
	
	//如果是移动端就一直显示播放列表
	if ( Always.is_mobile == 1 ){
		$( '#openlist' ).fadeIn();
	}else{
		if ( $( '.post-index' )[0] ){
			$( '#openlist' ).fadeOut();
		}else{
			$( '#openlist' ).fadeIn();
		}
	}
	
	//归档页面map隐藏
	if ( document.getElementById("archive-nav") ){
		if ( $(window).width() < 780 ){
			$( '#archive-nav' ).hide();
			$( '#archives').css({'width':'100%'});
		}else{
			$( '#archive-nav' ).show();
			$( '#archives').css({'width':'86%'});
		}
	}
	
	//判断是否显示导航
	narrow_menu();
	
	//格式化h3标签
	h3_js();
	
	//背景图片
	if( window.ajax_bg !== undefined ){
		if ( $(window).width() > 780 && !$( '.post-index' )[0]){
			ajax_bg();
		}else{
			if ( document.getElementById("bg") ){$( '#bg img' ).css({'opacity':'0'});}
		}
	}
	
	//底部小工具
	if ( $( '#footer-widget' ) ){
		footer_width();
	}
	
}

$(document).ready(function(){
	
	//main-nav
	var nav_li_width,
		nav_ul_width;
	
	$( '#main-nav li:has(ul)' ).hover(function(){
		nav_li_width = $(this).width();
		nav_ul_width = $(this).find('ul:first').width();
		
		$(this).find('ul:first').stop().css({'left':(nav_li_width - nav_ul_width)/2,'top':'36px'}).show().animate({
			opacity:1,
			top:48
		},300);
	},function(){
		var _this = $(this).find('ul:first');
		_this.stop().animate({
			opacity:0,
			top:36
		},300,function(){
			_this.hide();
		});
	});
	$( '#main-nav li.menu-item-has-children ul li:has(ul)' ).hover(function(){
		$(this).find('ul:first').stop().css({'left':'80%','top':'0'}).show().animate({
			opacity:1,
			left:'100%'
		},300);
	},function(){
		var _this = $(this).find('ul:first');
		_this.stop().animate({
			opacity:0,
			left:'80%'
		},300,function(){
			_this.hide();
		});
	});
	
	//narrow menu,点击事件只绑定一次
	var narrow_menu_is_show = 0,
	narrow_menu_width;
	$( '#openmenu' ).on('click',function(){
		if ( narrow_menu_is_show == 0 ){
			narrow_menu_width = $(window).width() - 100;
			if ( $( '#wpadminbar' )[0] ){
				$( '#narrow-menu' ).css({'top':$( '#wpadminbar' ).height()});
			}
			$( '#narrow-menu' ).css({'width':narrow_menu_width,'height':$(window).height(),'left':-narrow_menu_width}).show().animate({left:0},400);
			narrow_menu_is_show = 1;
		}else{
			$( '#narrow-menu' ).animate({left:-narrow_menu_width},400,function(){
				$( '#narrow-menu' ).hide();
				narrow_menu_is_show = 0;
			});
			
		}
	});
	
	
	//添加scrolltop并绑定事件
	if ( Always.is_mobile != 1 ){//移动端屏蔽
		if ( !$( '#scrolltop' )[0] ){$( '#wrapper' ).after('<div id=scrolltop/>');}
		
		$(window).scroll(function(){
			if ( $(window).scrollTop()>400 && $(window).width() > 900 ){
				$('#scrolltop').css({bottom:100,opacity:0.7});
			}else{
				$('#scrolltop').css({bottom:80,opacity:0});
			}
		});
		
		$( '#scrolltop' ).click(function(){
			$('html,body').stop().animate({scrollTop:0},400);
		});
		
	}
	
	logo_switch();
	article_js();
	page_archive();
	change_js();
	$(window).resize(function(){
		change_js();
	});
	if ( Always.is_mobile != 1 ){
		footer_js();
	}
});