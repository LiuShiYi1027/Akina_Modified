/**
 * WordPress jQuery-Ajax-Comments v1.3 by Willin Kan.
 * 
*/
var edit_mode = '1', // 再編輯模式 ( '1'=開; '0'=不開 )
txt1 = '<div id="loading">Sending...</div>',
txt2 = '<div id="error">#</div>',
txt3 = '">留言成功',
edt1 = ', 刷新页面之前可以<a rel="nofollow" class="comment-reply-link" href="#edit" onclick=\'return addComment.moveForm("',
edt2 = ')\'>重新编辑</a>',
cancel_edit = '取消编辑',
edit,
re_edit,
num = 1,
comm_array=[],
$comments = $('#comments-title'), // 評論數的 ID
$cancel,
cancel_text,
$submit,
$body,
wait = 6,
submit_val;
		
function respond_ajax(){
	$comments = $('#comments-title');
	$cancel = $('#cancel-comment-reply-link');
	cancel_text = $cancel.text();
	$submit = $('#commentform #submit');
	$submit.attr('disabled', false);
	submit_val = $submit.val();
	$('#submit').after( txt1 + txt2 );
	$('#loading').hide(); $('#error').hide();
	$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
	comm_array.push(''); //没有的话重新编辑不显示内容
		
	/** submit */
	$('#commentform').submit(function() {
	
		$('#loading').show();
		$submit.attr('disabled', true).fadeTo('slow', 0.5);
		if ( edit ) $('#comment').after('<input type="text" name="edit_id" id="edit_id" value="' + edit + '" style="display:none;" />');
		
	/** Ajax */
		$.ajax({
			url: Always.ajaxurl,
			data: $(this).serialize() + "&action=ajax_comment_post",
			type: $(this).attr('method'),
			error: function(request) {
				$('#loading').hide();
				$('#error').show().html(request.responseText);
				setTimeout(function() {$submit.attr('disabled', false).fadeTo('slow', 1); $('#error').hide();}, 1500);
			},
			success: function(data) {
				
				$('#loading').hide();
				comm_array.push($('#comment').val());
				$('textarea').each(function() {this.value = ''});
				var t = addComment, cancel = t.I('cancel-comment-reply-link'), temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId), post = t.I('comment_post_ID').value, parent = t.I('comment_parent').value;
				
				// comments
				if ( ! edit && $comments.length ) {
					n = parseInt($comments.text().match(/\d+/));
					$comments.text($comments.text().replace( n, n + 1 ));
					
				}
				// show comment
				new_htm = '"id="new_comm_' + num + '"></';
				new_htm = ( parent == '0' ) ? ('\n<div style="clear:both;" class="new-comment-list' + new_htm + 'div>') : ('\n<ul class="children' + new_htm + 'ul>');
				ok_htm = '\n <div class="ajaxtipsdiv"><span class="ajaxtips" id="success_' + num + txt3;
				if ( edit_mode == '1' ) {
					div_ = (document.body.innerHTML.indexOf('div-comment-') == -1) ? '' : ((document.body.innerHTML.indexOf('li-comment-') == -1) ? 'div-' : '');
					ok_htm = ok_htm.concat(edt1, div_, 'comment-', parent, '", "', parent, '", "respond", "', post, '", ', num, edt2);
				}
				ok_htm += '</span><span></span></div>\n';

				if( ( parent == '0' ) ){
					if ( !$( 'ol.comment-list' )[0] ) {
						$( '.comment-title' ).after('<ol class="comment-list"></ol>');//配合主题comments.php文件最初无评论列表时
					}
					$( 'ol.comment-list' ).append(new_htm);
				}else{
					$('#respond').before(new_htm);
				}
				$('#new_comm_' + num).hide().append(data);//插入新提交评论
				$('#new_comm_' + num + ' li').append(ok_htm);
				$('#new_comm_' + num).fadeIn(400);//新提交成功评论渐现
				
				//Always 1.2增加，移动端子列表左边距
				if ( $(window).width() < 780 ){
					$( '.children' ).addClass('mobile');
				}

				//$body.animate( { scrollTop: $('#new_comm_' + num).offset().top - 200}, 900);
				countdown(); num++ ; edit = ''; $('*').remove('#edit_id');
				cancel.style.display = 'none';//“取消回复”消失
				cancel.onclick = null;
				t.I('comment_parent').value = '0';
				if ( temp && respond ) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp)
				}
				
				//Add by dong:recent-comments
				//recent_comments_new(data);
			}
		}); // end Ajax
	  return false;
	}); // end submit
	/** comment-reply.dev.js */
	addComment = {
		moveForm : function(commId, parentId, respondId, postId, num) {
			var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');
			if ( edit ) exit_prev_edit();
			num ? (
				t.I('comment').value = comm_array[num],
				edit = t.I('new_comm_' + num).innerHTML.match(/(comment-)(\d+)/)[2],
				$new_sucs = $('#success_' + num ), $new_sucs.hide(),
				$new_comm = $('#new_comm_' + num ), $new_comm.hide(),
				$cancel.text(cancel_edit)
			) : $cancel.text(cancel_text);

			t.respondId = respondId;
			postId = postId || false;

			if ( !t.I('wp-temp-form-div') ) {
				div = document.createElement('div');
				div.id = 'wp-temp-form-div';
				div.style.display = 'none';
				respond.parentNode.insertBefore(div, respond)
			}

			!comm ? ( 
				temp = t.I('wp-temp-form-div'),
				t.I('comment_parent').value = '0',
				temp.parentNode.insertBefore(respond, temp),
				temp.parentNode.removeChild(temp)
			) : comm.parentNode.insertBefore(respond, comm.nextSibling);



			if ( post && postId ) post.value = postId;
			parent.value = parentId;
			cancel.style.display = '';

			cancel.onclick = function() {
				if ( edit ) exit_prev_edit();
				var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

				t.I('comment_parent').value = '0';
				if ( temp && respond ) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp);
				}
				this.style.display = 'none';
				this.onclick = null;
				return false;
			};

			try { t.I('comment').focus(); }
			catch(e) {}

			return false;
		},

		I : function(e) {
			return document.getElementById(e);
		}
	}; // end addComment
}

function exit_prev_edit() {
	$new_comm.show(); $new_sucs.show();
	$('textarea').each(function() {this.value = ''});
	edit = '';
}

function countdown() {
	if ( wait > 0 ) {
		$submit.val(wait); wait--; setTimeout(countdown, 1000);
	} else {
		$submit.val(submit_val).attr('disabled', false).fadeTo('slow', 1);
		wait = 6;
	}
}

/*
*by 咚门
*/
function comment_page_ajax(){
	$('.comment-navi a').click(function(){
		var wpurl=$(this).attr("href").split(/(\?|&)action=AjaxCommentsPage.*$/)[0];
		var commentPage = 1;
		if (/comment-page-/i.test(wpurl)) {
			commentPage = wpurl.split(/comment-page-/i)[1].split(/(\/|#|&).*$/)[0];
		} else if (/cpage=/i.test(wpurl)) {
			commentPage = wpurl.split(/cpage=/)[1].split(/(\/|#|&).*$/)[0];
		};
		var loading='<div class="commnav_loding">正在努力读取中......</div>';
		var postId = $( '#singular-content' ).find( 'article:first' ).attr('id').replace('post-','');
		$.ajax({
			url:Always.ajaxurl,
			type:'POST',
			data:{action:'AjaxCommentsPage', post:postId, page:commentPage},
			dataType:'html',
			beforeSend: function() {
				var top = $( '#comments' ).offset().top;
				if ( $( '#wpadminbar' )[0] ){
					top -= $( '#wpadminbar' ).height();//登录过后减去adminbar的高度;
				}
				$( 'html,body' ).animate({scrollTop:top},0);
				$( '.comment-list' ).empty().html(loading);
			},
			error: function(request) {
					alert(request.responseText);
				},
			success:function(data){
				var responses=data.split('<!--winysky-AJAX-COMMENT-PAGE-->');
				$('.comment-list').empty().html(responses[0]).stop().css({'margin-top':'80px','opacity':0}).animate({'margin-top':'40px','opacity':1},600);
				$('.comment-navi').empty().html(responses[1]);
				
				comment_page_ajax();//自身重载一次
				comment_list();//重载评论列表相关
				comm_author_detail();//评论列表hover详细信息重载
			}//返回评论列表顶部
		});
		
		return false;
	});
}

//评论列表
function comment_list(){

	//隐藏以前主题jQ添加的@
	$( '.children .text' ).find( 'a[rel=nofollow]' ).each(function(){
		var i = $(this).attr("href").match(/comment-/);
		var j = $(this).attr("href");
		if ( i!=null || j == '#undefined'){
			$(this).hide();
		}
	});
	
	//子列表左边距
	if ( $(window).width() < 780 ){
		if ( $( '.children' )[0] ){
			$( '.children' ).addClass('mobile');
		}
	}else{
		if ( $( '.children' )[0] ){
			$( '.children' ).removeClass('mobile');
		}
	}
	
	//hover name
	var hover_name = $('<div id=hover-name/>'),
		this_name = '',
		hover_width = 0,
		hover_left,
		hover_time;
	$( '#hover-name' )[0] || $('body').append(hover_name);
	$( '.children .comment-body' ).hover(function(){
		$(this).find('.reply').show();
		var _this = $(this);
		clearTimeout(hover_time);
		hover_time = setTimeout(function(){
			this_name = _this.find('.name').text();
			$( '#hover-name' ).html(this_name);
			hover_width = $( '#hover-name' ).width();
			hover_left = _this.offset().left - hover_width - 40;
			$( '#hover-name' ).show().css({'left':hover_left - 12,'top':_this.offset().top+4,'opacity':0}).stop().animate({left:hover_left,opacity:1},200);
		},20);
	},function(){
		$(this).find('.reply').hide();
		clearTimeout(hover_time);
		$( '#hover-name' ).stop().animate({left:hover_left - 12,opacity:0},200,function(){
			$( '#hover-name' ).hide();
		});
	});
}

//留言框
function comment_respond(){	
	$( '#cancel-comment-reply-link' ).click(function(){/////
		$('#comment').val('');
	});
	
	if ( $( '.welcome' )[0] ){/////
		$( '.author-info' ).hide();
		$( 'span.info-edit' ).click(function(){
			$( '.author-info' ).toggle();
		});
	}
	
	$( '#respond input[type=text]' ).focus(function(){/////
		$(this).css({'color':'rgba(0,0,0,0.6)','border-color':'rgba(0,0,0,0.3)'});
	});
	$( '#respond input[type=text]' ).blur(function(){
		$(this).css({'color':'rgba(0,0,0,0.3)','border-color':'rgba(0,0,0,0.1)'});
	});
	$( '#respond textarea' ).focus(function(){
		$(this).css({'color':'rgba(0,0,0,0.6)'});
		$(this).parent().css({'border-color':'rgba(0,0,0,0.3)'});
	});
	$( '#respond textarea' ).blur(function(){
		$(this).css({'color':'rgba(0,0,0,0.3)'});
		$(this).parent().css({'border-color':'rgba(0,0,0,0.1)'});
	});
}

//评论列表头像hover详细信息;;;和guestdetail大部分代码重复，暂且这样
function comm_author_detail(){
	if ( Always.is_mobile != 1 ){//移动端屏蔽
		var list_detail = $('<div id="list-detail" class="detail" />'),
			detail_left,//左边距
			detail_top,//顶距
			detail_time,//鼠标移开的缓冲
			li_hover = 0,
			detail_hover = 0;
		
		if ( !$( '#list-detail ')[0] ){
			$( '#wrapper' ).after(list_detail);
		}
		list_detail = $( '#list-detail ');
		//评论列表
		$( '.comment-list > li' ).each(function(){
			$(this).find('.avatar:first').hover(function(){
				var comment_id = $(this).parent().parent().attr('id').replace('comment-','');
				var _this = $(this),
					_window_width = $(window).width();
				li_hover = 1;
				clearTimeout(detail_time);
				detail_time = setTimeout(function(){
					$.ajax({
						url:Always.ajaxurl,
						type:'GET',
						data:{ action: 'ajax_author_detail', id: comment_id },
						beforeSend:function(){
							//左距离
							detail_left = _this.offset().left - 110;
							if ( detail_left < 0 ) detail_left = 0;
							if ( detail_left + 260 > _window_width ) detail_left = _window_width - 260;
							//顶距
							detail_top = _this.offset().top + 60;
							//向上显示detail框
							list_detail.show().css({'left':detail_left,'top':detail_top + 24,'opacity':0}).stop().animate({top:detail_top,opacity:1},300);
							//预插入显示三角箭头
							list_detail.html('<div class="list-detail"><div class="triangle"><div></div></div></div>');
							//显示loading
							if ( !$( '#list-detail .loading' )[0] ){
								list_detail.append(_loading);//css 3 loading
							}
							$( '#list-detail .loading' ).show();
						},
						error:function(){
							list_detail.html('ajax error!');
						},
						success:function(data){
							$( '#list-detail .loading' ).fadeOut(function(){
								list_detail.html(data);
								
								//评论地址ajax绑定
								$( '#list-detail a.earlist-comment' ).on('click',function(){//底部留言墙
									try{
										if ( typeof(eval(ajax_start)) == 'function' ){
											//audio_ready();
											var i = ajax_start($(this));
											return i;
										}
									}catch(e){
									
									}
								});
								
							});
						}
					});
				},80);
				
			},function(){
				li_hover = 0;
				clearTimeout(detail_time);
				detail_time = setTimeout(function(){
					if ( detail_hover == 0 ){
						list_detail.stop().animate({top:detail_top + 24,opacity:0},300,function(){list_detail.hide()});
					}
				},100);
			});
			
			list_detail.hover(function(){
				detail_hover = 1;
			},function(){
				detail_hover = 0;
				clearTimeout(detail_time);
				detail_time = setTimeout(function(){
					if ( li_hover == 0 ){
						list_detail.stop().animate({top:detail_top + 24,opacity:0},300,function(){list_detail.hide()});
					}
				},100);
			});
			
		});
	}
}

function do_comment_js(){
	if ( $( '.comment-list' )[0] ){
		comment_list();
		comm_author_detail();
	}
	if ( $( '#respond' )[0] ){
		comment_respond();
		respond_ajax();
	}
	if ( $( '.comment-navi' )[0] ){
		comment_page_ajax();
	}
}

$(document).ready(function(){
	do_comment_js();
});