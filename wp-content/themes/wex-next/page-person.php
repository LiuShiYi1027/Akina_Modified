<?php
/**
 * Template Name: 个人主页
 */


get_header();if( have_posts() ) : while( have_posts() ) : the_post();
?>

    <?php
    $weibo= cs_get_option('admin_weibo');
    $zhihu= cs_get_option('admin_zhihu_link');
    $mail= cs_get_option('admin_mail');
    $address= cs_get_option('admin_address');
    $name= cs_get_option('admin_name');
    $weixin= cs_get_option('admin_weixin');
    $hobby= cs_get_option('admin_hobby');
    $slogan= cs_get_option('slogan');
    $setup_date = cs_get_option( 'setup_date' );
    $days= floor((time()-strtotime("$setup_date"))/86400);

    ?>
<link rel="stylesheet" href="<?php bloginfo('template_url')?>/style/about.css">

    <main id="main" class="main">
        <div class="main-inner">
            <div class="left">
                        <img src="<?php wexweb('admin_photo','')?>" alt="<?php bloginfo('name');?>" class="photo">
                        <div class="slogan"><?php  echo "Hi, <br> I am  $name"; ?></div>
            </div>
            <div class="right">
                <ul class="info">

<?php
                echo <<<info
                  <li>昵称：$name</li>
                  <li>坐标：$address</li>
                  <li>爱好：$hobby</li>
                  <li>网站已存在：$days 天</li>
                  <li>建站日期：$setup_date</li>

info;





?>
    <li>上次登陆：<?php last_login();?>前</li>
    <li class="social">
        社交媒体
        <ul class="social-media">

<?php
if(!empty($weibo)){ echo <<<weibo
    <li><a href="$weibo" alt=""><i class="iconfont icon-weibo"></i></a></li>
weibo;

}
if(!empty($mail)){ echo <<<youxiang
    <li><a href="mailto:$mail" alt=""><i class="iconfont icon-youxiang"></i></a></li>
youxiang;

}
if(!empty($zhihu)){ echo <<<zhihu
    <li><a href="$zhihu" alt=""><i class="iconfont icon-zhihu"></i></a></li>
zhihu;

}
if(!empty($weixin)){ echo <<<zhihu

            <li class="weixin_img"><a><i class="iconfont icon-weixin"></i></a>
            <div class="qr_container">
                <img src="$weixin" alt="" class="qr">
            </div></li>
zhihu;

}




?>

        </ul>
    </li>
</ul>

            </div>
        </div>
    </main>
    <script>

        $('.weixin_img').hover(
            function () {
                $('.qr_container').addClass('show');
            },
            function () {
                $('.qr_container').removeClass('show');
            })
    </script>

<?php endwhile; ?>
<?php endif; ?>
<?php get_sidebar();?>
<?php get_footer();?>