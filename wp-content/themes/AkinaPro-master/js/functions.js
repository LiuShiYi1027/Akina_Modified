//自定义
var Wang = {
    //浏览器高度
    BG_IMG_Hight: function () {
        var CenterBgheight = $(window).height();
        $('#centerbg').css({'height': CenterBgheight});
    },
    //移动端菜单切换
    Mobile_Menu: function () {
        $('.iconflat').click(function () {
            if ($('body').hasClass('navOpen')) {
                $('#mo-nav').css('display','none');
            } else {
                $('#mo-nav').css('display','block');
            }
            $('body').toggleClass('navOpen');
            $('.mo-nav,.wrapper,.iconflat').toggleClass('open');
            $('div.site-branding').toggleClass('site-branding-hidden');
        });
    },
    //移动端自动关闭菜单
    Close_Mobile_Menu: function () {
        if ($('body').hasClass('navOpen')) {
            $('body').toggleClass('navOpen');
            $('.mo-nav,.wrapper,.iconflat').toggleClass('open');
            $('div.site-branding').toggleClass('site-branding-hidden');
        }
    },
    //移动端隐藏博主信息展示
    Hide_Blog_Info: function () {
        $('.iconflat').click(function () {
            if ($('body').hasClass('navOpen')) {
                $('#mo-nav').css('display','block');
            } else {
                $('#mo-nav').css('display','none');
            }
        });
    },
    //搜索
    Click_Events: function () {
        $('.js-toggle-search').on('click', function () {
            $('.js-toggle-search').toggleClass('is-active');
            $('.js-search').toggleClass('is-visible');
        });
        $('.search_close').on('click', function () {
            if ($('.js-search').hasClass('is-visible')) {
                $('.js-toggle-search').toggleClass('is-active');
                $('.js-search').toggleClass('is-visible');
            }
        });
        //导航栏菜单自适应隐藏/显示
        $(function () {
            var h1 = 0;
            var h2 = 50;
            var ss = $(document).scrollTop();
            $(window).scroll(function () {
                var s = $(document).scrollTop();

                if (s == h1) {
                    $('.site-header').removeClass('yya');
                }
                if (s > h1) {
                    $('.site-header').addClass('yya');
                }
                if (s > h2) {
                    $('.site-header').addClass('gizle');
                    if (s > ss) {
                        $('.site-header').removeClass('sabit');
                    } else {
                        $('.site-header').addClass('sabit');
                    }
                    ss = s;
                }
            });
        });
        //图箱功能
        baguetteBox.run('.entry-content', {
            captions: function (element) {
                // `this` == Array of current gallery items
                return element.getElementsByTagName('img')[0].alt;
            }
        });
        //文章归档
        $(document).ready(function ($) {
            $('.archives').hide();
            $('.archives:first').show();
            $('#archives-temp h3').click(function () {
                $(this).next().slideToggle('fast');
                return false;
            });
        });
    },
    Back_Top: function () {
        //返回顶部
        $('.back2top').hide();
        $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('.back2top').fadeIn(200)
            } else {
                $('.back2top').fadeOut(200)
            }
            if ($(this).scrollTop() > 360) $('#index').addClass('fix');
            else $('#index').removeClass('fix');
        });
        $('.back2top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            return false
        });
    },
    Click_likes: function () {
        //点赞功能
        $.fn.postLike = function () {
            if ($(this).hasClass('done')) {
                return false;
            } else {
                $(this).addClass('done');
                var id = $(this).data("id"),
                    action = $(this).data('action'),
                    rateHolder = $(this).children('.count');
                var ajax_data = {
                    action: "specs_zan",
                    um_id: id,
                    um_action: action
                };
                $.post("/wp-admin/admin-ajax.php", ajax_data, function (data) {
                    $(rateHolder).html(data);
                });
                return false;
            }
        };
        $(document).on("click", ".specsZan", function () {
            $(this).postLike();
        });
    },
    Submit_Review: function () {
        //Zepto.js版Ajax评论，兼容jQuery
        var i = 0, got = -1, len = document.getElementsByTagName('script').length;
        while (i <= len && got == -1) {
            var js_url = document.getElementsByTagName('script')[i].src,
                got = js_url.indexOf('functions.js');
            i++;
            js_url = js_url.replace('res.i95.me','iiong.com');
        }
        var ajax_php_url = iiong.ajax_url,
            wp_url = js_url.substr(0, js_url.indexOf('wp-content')),
            txt1 = '<div id="loading">正在提交...</div>',
            txt2 = '<div id="error"></div>',
            edit,
            num = 1,
            comm_array = [];
        comm_array.push('');
        jQuery(document).ready(function ($) {
            $comments = $('#comments-title'); // 評論數的 ID
            $cancel = $('#cancel-comment-reply-link');
            cancel_text = $cancel.text();
            $submit = $('#commentform #submit');
            //$submit.attr('disabled', false);
            $('#comment').after(txt1 + txt2);
            $('#loading').hide();
            $('#error').hide();
            $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
            /** submit */
            $('#commentform').submit(function () {
                $('#loading').show();
                //$submit.attr('disabled', true);
                if (edit) $('#comment').after('<input type="text" name="edit_id" id="edit_id" value="' + edit + '" style="display:none;" />');
                /** ajax */
                $.ajax({
                    url: ajax_php_url,
                    data: $(this).serialize() + '&action=comment-submission',
                    type: $(this).attr('method'),
                    error: function (request) {
                        $('#loading').hide();
                        $('#error').show().html(request.responseText);
                        setTimeout(function () {
                            //$submit.attr('disabled', false);
                            $('#error').hide();
                        }, 3000);
                    },
                    success: function (data) {
                        $('#loading').hide();
                        comm_array.push($('#comment').val());
                        $('textarea').each(function () {
                            this.value = ''
                        });
                        var t = addComment, cancel = t.I('cancel-comment-reply-link'), temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId), post = t.I('comment_post_ID').value, parent = t.I('comment_parent').value;
                        // comments
                        if (!edit && $comments.length) {
                            n = parseInt($comments.text().match(/\d+/));
                            $comments.text($comments.text().replace(n, n + 1));
                        }
                        // show comment
                        new_htm = '" id="new_comm_' + num + '"></';
                        new_htm = ( parent == '0' ) ? ('\n<ol style="clear:both;" class="commentlist' + new_htm + 'ol>') : ('\n<ul class="children' + new_htm + 'ul>');
                        $('#respond').before(new_htm);
                        $('#new_comm_' + num).hide().append(data);
                        $('#new_comm_' + num).show();
                        //$body.animate( { scrollTop: $('#new_comm_' + num).offset().top - 200},0);
                        scrollTop: $('#new_comm_' + num).offset().top;
                        countdown();
                        num++;
                        edit = ''; //$('*').remove('#edit_id');
                        cancel.style.display = 'none';
                        cancel.onclick = null;
                        t.I('comment_parent').value = '0';
                        if (temp && respond) {
                            temp.parentNode.insertBefore(respond, temp);
                            temp.parentNode.removeChild(temp)
                        }
                    }
                }); // end Ajax
                return false;
            }); // end submit
            /** comment-reply.dev.js */
            addComment = {
                moveForm: function (commId, parentId, respondId, postId, num) {
                    var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');
                    if (edit) exit_prev_edit();
                    num ? (
                            t.I('comment').value = comm_array[num],
                                edit = t.I('new_comm_' + num).innerHTML.match(/(comment-)(\d+)/)[2],
                                $new_sucs = $('#success_' + num), $new_sucs.hide(),
                                $new_comm = $('#new_comm_' + num), $new_comm.hide()
                        ) : $cancel.text(cancel_text);
                    t.respondId = respondId;
                    postId = postId || false;
                    if (!t.I('wp-temp-form-div')) {
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
                    scrollTop: $('#respond').offset().top;
                    if (post && postId) post.value = postId;
                    parent.value = parentId;
                    cancel.style.display = '';
                    cancel.onclick = function () {
                        if (edit) exit_prev_edit();
                        var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);
                        t.I('comment_parent').value = '0';
                        if (temp && respond) {
                            temp.parentNode.insertBefore(respond, temp);
                            temp.parentNode.removeChild(temp);
                        }
                        this.style.display = 'none';
                        this.onclick = null;
                        return false;
                    };
                    try {
                        t.I('comment').focus();
                    }
                    catch (e) {
                    }
                    return false;
                },
                I: function (e) {
                    return document.getElementById(e);
                }
            }; // end addComment
            function exit_prev_edit() {
                $new_comm.show();
                $new_sucs.show();
                $('textarea').each(function () {
                    this.value = ''
                });
                edit = '';
            }
            var wait = 15, submit_val = $submit.val();
            function countdown() {
                if (wait > 0) {
                    $submit.val(wait);
                    wait--;
                    setTimeout(countdown, 1000);
                } else {
                    $submit.val(submit_val);
                    //$submit.val(submit_val).attr('disabled', false);
                    wait = 15;
                }
            }
        });
    },
    Review_Tab: function () {
        // 评论分页
        $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');//commentnav ajax
        $(document).on('click', '.navigation a', function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: $(this).attr('href'),
                beforeSend: function() {
                    $('.navigation').remove();
                    $('.commentlist').remove();
                    $body.animate({scrollTop: $('#comments').offset().top - 65}, 800 );
                },
                dataType: "html",
                success: function(out) {
                    result = $(out).find('.commentlist');
                    nextlink = $(out).find('.navigation');
                    $('#comments').after(result.fadeIn(500));
                    $('.commentlist').after(nextlink);
                    other();
                }
            });
        });
    },
    Highlight_Block: function () {
        //语法高亮
        $(document).ready(function() {
            $('pre code').each(function(i, block) {
                hljs.highlightBlock(block);
            });
        });
    }
};

//载入JS脚本
$(function () {
    Wang.BG_IMG_Hight(); //获取背景图片自适应高度
    Wang.Click_Events(); //点击事件
    Wang.Mobile_Menu(); //移动端菜单
    Wang.Close_Mobile_Menu(); //关闭移动菜单
    Wang.Hide_Blog_Info(); //移动端隐藏博主信息展示
    Wang.Back_Top(); //返回顶部
    Wang.Click_likes(); //点赞
    Wang.Submit_Review(); //提交评论
    Wang.Review_Tab();//评论分页
    Wang.Highlight_Block(); //语法高亮
});
//Pjax配置
$(document).ready(function () {
    $(document).pjax('a[target!=_top]', '#page', {
        fragment: '#page',
        timeout: 5000, //超时，超过5s还没加载到网页即刷新整个网页
    }).on('pjax:send', function () {
        //载入移动端菜单关闭
        Wang.Close_Mobile_Menu();
        //加入loading动画
        $('body').append("<div id='container' ><div id='loader-wrapper'><div id='loader'></div><div class='loader-section section-left'></div><div class='loader-section section-right'></div></div></div>");
    }).on('pjax:complete', function () {
        Wang.BG_IMG_Hight();
        Wang.Click_Events();
        Wang.Submit_Review();
        //去掉loading动画
        $('#container').remove();
        //解决hljs代码高亮
        if ( iiong.highlight_highlighters == 'yes' ) {
            //hljs.initHighlightingOnLoad();
            //self.hljs.initHighlightingOnLoad(event); 为什么没效果？
            Wang.Highlight_Block();
        }
        //解决多说加载问题
        if ($('.ds-thread').length > 0) {
            if (typeof DUOSHUO !== 'undefined') {
                DUOSHUO.EmbedThread('.ds-thread');
                DUOSHUO.ThreadCount($('.ds-thread-count'));
                DUOSHUO.RecentVisitors('.ds-recent-visitors');
            } else {
                $.getScript("//static.duoshuo.com/embed.js");
            }
        }
    }).on('submit', '.search-form,.s-search,.mo_s-search', function (event) {
        event.preventDefault();
        $.pjax.submit(event, '#page', {
            fragment: '#page',
            timeout: 8000,
        });
        if ($('.js-search.is-visible').length > 0) {
            $('.js-toggle-search').toggleClass('is-active');
            $('.js-search').toggleClass('is-visible');
            $('.mo_s-search').toggleClass('is-visible');
        }
    });
});