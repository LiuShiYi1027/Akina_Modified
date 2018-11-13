<div id="centerbg">
    <div class="focusinfo">
        <?php if (akina_option('focus_logo')): ?>
            <div class="header-tou"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo akina_option('focus_logo', ''); ?>"></a></div>
        <?php else : ?>
            <div class="header-tou">
                <a href="<?php bloginfo('url'); ?>">
                    <img src="//img.alicdn.com/imgextra/i2/2038135983/TB2lFWRaWi5V1BjSspaXXbrApXa_!!2038135983.png">
                </a>
            </div>
        <?php endif; ?>

        <div class="header-info">
            <p><?php echo akina_option('admin_des', 'Carpe Diem and Do what I like'); ?></p>
        </div>

        <div class="top-social">

            <?php if (akina_option('email')) { ?>
                <li class="email"><a href="<?php echo akina_option('email', ''); ?>" target="_blank" class="social-twitter" title="email"><i class="iconfont">&#xe7ab;</i></a></li>
            <?php } ?>

            <?php if (akina_option('wechat')) { ?>
                <li class="wechat"><a><i class="iconfont">&#xe61e;</i></a>
                    <ul>
                        <a href="#"><img src="<?php echo akina_option('wechat', ''); ?>" alt="微信号" /></a>
                    </ul>

                </li>
            <?php } ?>
            <?php if (akina_option('qq')) { ?>
                <li class="qq"><a href="<?php echo akina_option('qq'); ?>" target="_blank" class="social-qq"
                    title="qq"><i class="iconfont">&#xe621;</i></a>
                </li>
            <?php } ?>
            <?php if (akina_option('sina')) { ?>
                <li class="sina"><a href="<?php echo akina_option('sina', ''); ?>" target="_blank" class="social-sina"
                       title="sina"><i class="iconfont">&#xe623;</i></a></li>
            <?php } ?>
            <?php if (akina_option('twitter')) { ?>
                <li class="twitter"><a href="<?php echo akina_option('twitter', ''); ?>" target="_blank" class="social-twitter"
                       title="twitter"><i class="iconfont">&#xe620;</i></a></li>
            <?php } ?>
            <?php if (akina_option('google')) { ?>
                <li class="google"><a href="<?php echo akina_option('google', ''); ?>" target="_blank" class="social-google"
                       title="google"><i class="iconfont">&#xe62e;</i></a></li>
            <?php } ?>
            <?php if (akina_option('facebook')) { ?>
                <li class="facebook"><a href="<?php echo akina_option('facebook', ''); ?>" target="_blank" class="social-facebook"
                       title="facebook"><i class="iconfont">&#xe62b;</i></a></li>
            <?php } ?>
            <?php if (akina_option('segmentfault')) { ?>
                <li class="segmentfault"><a href="<?php echo akina_option('segmentfault', ''); ?>" target="_blank" class="social-segmentfault"
                       title="segmentfault"><i class="iconfont">&#xe625;</i></a></li>
            <?php } ?>
            <?php if (akina_option('zhihu')) { ?>
                <li class="zhihu"><a href="<?php echo akina_option('zhihu', ''); ?>" target="_blank" class="social-zhihu"
                       title="zhihu"><i class="iconfont">&#xe628;</i></a></li>
            <?php } ?>
            <?php if (akina_option('douban')) { ?>
                <li class="douban"><a href="<?php echo akina_option('douban', ''); ?>" target="_blank" class="social-douban"
                       title="douban"><i class="iconfont">&#xe614;</i></a></li>
            <?php } ?>

            <?php if (akina_option('bili')) { ?>
                <li class="bili"><a href="<?php echo akina_option('bili', ''); ?>" target="_blank" class="social-bili"
                       title="bili"><i class="iconfont">&#xe633;</i></a></li>
            <?php } ?>
            <?php if (akina_option('coding')) { ?>
                <li class="coding"><a href="<?php echo akina_option('coding', ''); ?>" target="_blank" class="social-coding"
                       title="coding"><i class="iconfont">&#xe626;</i></a></li>
            <?php } ?>
            <?php if (akina_option('github')) { ?>
                <li class="github"><a href="<?php echo akina_option('github', ''); ?>" target="_blank" class="social-github"
                       title="github"><i class="iconfont">&#xe629;</i></a></li>
            <?php } ?>
        </div>
    </div>

</div>






		
	
	
	




