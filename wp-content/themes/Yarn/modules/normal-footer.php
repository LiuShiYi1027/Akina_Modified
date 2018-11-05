	<div class="fat-footer">
	
		<div class="wrapper">

        <?php if ( is_home() | is_archive() | is_page()  ) {?><style>#upTriangleColor,#dwTriangleColor{display: none;}.wechatimg{left: -30px;bottom: 80px;z-index: 2;}.pagination {padding-bottom:40px;}</style><?php }

		  elseif ( is_single() ) {?><span class="rule mm+"><style>#dwTriangleColor,#upTriangleColor{display:none}.media__img{margin:0 35px 0 5px}.wechatimg{left:-30px;bottom:80px;z-index:2}#social ul{background-color:#F5F5F5}#comments-list-title{margin:40px 0 20px}</style></span><?php }	?>

			<div class="layout layout--center">
			
				<div class="layout__item clearfix">

					<div class="media">
					
						<div class="media__img avatar"><?php echo get_avatar( get_the_author_email(), 50 ); ?></div>
		
						<div class="media__body"><?php $notice_textbox = get_option( 'yarn_notice_textbox' );
							
							if ($notice_textbox != '') { ?><p><?php echo balanceTags( $notice_textbox, true ); ?></p><?php } ?>
						
						</div>
						
					</div>
				
					<div class="fat-footer__social">
					
						<ul class="list-bare list-inline">
						
							<?php if(theme_option('type-weibo')): ?><li><a title="weibo" href="http://weibo.com/<?php echo theme_option('type-weibo') ?>/"><i class="iconfont" aria-hidden="true">&#xe601;</i></a></li>
		
							<?php endif ?>
		
							<?php if(theme_option('type-twitter')):  ?><li><a title="twitter" href="http://twitter.com/<?php echo theme_option('type-twitter') ?>"><i class="iconfont" aria-hidden="true">&#xe602;</i></a></li>
		
							<?php endif ?>
							
							<?php if(theme_option('type-wechat')): ?><li  class="wechat"><a><i class="iconfont">&#xe609;</i></a>
		
																	 <div class="wechatimg"><?php if ( $wechat = theme_option('wechat', false) ) : ?><img src="<?php echo  $wechat ?>"><?php endif ?></div></li>
							<?php endif ?>

							<?php if(theme_option('type-instagram')):  ?><li><a title="instagram" href="http://instagram.com/<?php echo theme_option('type-instagram') ?>"><i class="iconfont" aria-hidden="true">&#xe610;</i></a></li>
		
							<?php endif ?>

							<?php if(theme_option('type-qq')):  ?><li><a title="QQ" class="socialicon" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo theme_option('type-qq') ?>&site=qq&menu=yes" target="_blank"><i class="iconfont" aria-hidden="true">&#xe616;</i></a></li>
		
							<?php endif ?>
		
						</ul>
						
					</div>
					
				</div>
				
				<?php ?>

			</div>
			
	</div>
	
</div><!--wrapper-->

<footer class="site-footer text-center" itemscope="itemscope" itemtype="<?php echo esc_url('http://schema.org/WPFooter'); ?>" >

		<div class="site-info">

	<?php $credit_link = get_theme_mod( 'credit_link' ); ?>

	<?php $copyright_textbox = get_theme_mod( 'yarn_copyright_textbox' );
	
                   if ($copyright_textbox != '') { ?>

                       <?php echo esc_html($copyright_textbox); ?>

                   <?php } else { ?>

                       <?php esc_html_e('Copyright', 'yarn'); ?>&copy;<?php echo esc_attr( date('Y') ); ?><?php if ( !$credit_link && (is_home() || is_front_page () )) {?><?php esc_html_e('. Design by', 'yarn'); ?> <a href="http://JJlin.net">JJ.lin</a><?php } ?>

                   <?php } ?>
		</div>
		
</footer>
