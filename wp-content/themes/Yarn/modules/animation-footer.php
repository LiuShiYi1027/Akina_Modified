<footer id="footer" class="overlay animated from-top"  itemscope="itemscope" itemtype="<?php echo esc_url('http://schema.org/WPFooter'); ?>">

    <div class="decor-wrapper">
	
            <svg id="footer-decor" class="decor top" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path class="large left" d="M0 0 L50 50 L0 100" fill="rgba(255,255,255, .1)"></path>
                <path class="large right" d="M100 0 L50 50 L100 100" fill="rgba(255,255,255, .1)"></path>
                <path class="medium left" d="M0 0 L50 50 L0 66.6" fill="rgba(255,255,255, .3)"></path>
                <path class="medium right" d="M100 0 L50 50 L100 66.6" fill="rgba(255,255,255, .3)"></path>
                <path class="small left" d="M0 0 L50 50 L0 33.3" fill="rgba(255,255,255, .5)"></path>
                <path class="small right" d="M100 0 L50 50 L100 33.3" fill="rgba(255,255,255, .5)"></path>
                <path d="M0 0 L50 50 L100 0 L0 0" fill="rgba(255,255,255, 1)"></path>
                <path d="M48 48 L50 51 L52 48 L48 48" fill="rgba(255,255,255, 1)"></path>
            </svg>
    </div>
  
	<div class="socialize" data-aos="zoom-in">
					
		<?php if(theme_option('type-weibo')): ?><li><a title="weibo" class="socialicon" href="http://weibo.com/<?php echo theme_option('type-weibo') ?>/"><i class="iconfont" aria-hidden="true">&#xe601;</i></a></li>
		
		<?php endif ?>
		
		<?php if(theme_option('type-twitter')):  ?><li><a title="twitter" class="socialicon" href="http://twitter.com/<?php echo theme_option('type-twitter') ?>"><i class="iconfont" aria-hidden="true">&#xe602;</i></a></li>
		
		<?php endif ?>

		<?php if(theme_option('type-wechat')): ?><li  class="wechat"><a class="socialicon"><i class="iconfont">&#xe609;</i></a>
		
			<div class="wechatimg"><?php if ( $wechat = theme_option('wechat', false) ) : ?><img src="<?php echo  $wechat ?>"><?php endif ?></div>
		
		</li>

		<?php endif ?>
					
		<?php if(theme_option('type-instagram')):  ?><li><a title="instagram" class="socialicon" href="http://instagram.com/<?php echo theme_option('type-instagram') ?>"><i class="iconfont" aria-hidden="true">&#xe610;</i></a></li>
		
		<?php endif ?>

		<?php if(theme_option('type-qq')):  ?><li><a title="QQ" class="socialicon" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo theme_option('type-qq') ?>&site=qq&menu=yes" target="_blank"><i class="iconfont" aria-hidden="true">&#xe616;</i></a></li>
		
		<?php endif ?>
	
	</div>
					
    <div class="cr">  
	
	<?php $credit_link = get_theme_mod( 'credit_link' ); ?>

	<?php $copyright_textbox = get_theme_mod( 'yarn_copyright_textbox' );
	
                   if ($copyright_textbox != '') { ?>

                       <?php echo esc_html($copyright_textbox); ?>

                   <?php } else { ?>

                       <?php esc_html_e('Copyright', 'yarn'); ?>&copy;<?php echo esc_attr( date('Y') ); ?><?php if ( !$credit_link && (is_home() || is_front_page () )) {?><?php esc_html_e('. Design by', 'yarn'); ?> <a href="http://JJlin.net">JJ.lin</a><?php } ?>

                   <?php } ?>
				   
	</div>