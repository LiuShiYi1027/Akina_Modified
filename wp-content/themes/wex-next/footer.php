<footer id="footer" class="footer">
    <div class="footer-inner">



        <div class="copyright">

                    <span class="author" itemprop="copyrightHolder">
                        <a href="<?php bloginfo('url');?>"><?php wexweb('site_name','wex');?></a>
                    </span>
            &nbsp;&copy;&nbsp;版权所有


            <div class="right">
                <div class="powered-by <?php if(cs_get_option('footer_copyright_switcher')==true){echo 'hidden';}?>">自豪地使用<a class="theme-link" href="http://cn.wordpress.org/">WordPress</a></div>
                <div class="theme-info">
                    <a class="theme-link <?php if(cs_get_option('footer_copyright_switcher')==true){echo 'hidden';}?>" href="http://www.imwex.cn/">NEXT主题</a>
                    <?php
								$icp=cs_get_option('icp_num');
                    if (!empty($icp)){
                        echo '<a class="icp" href="http://www.miitbeian.gov.cn/">';
                        wexweb('icp_num','');
                        echo '</a>';
                    }
                    ?>



                </div>

            </div>
        </div>
    </div>
</footer>
<div class="back-to-top"></div>
</div>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/fancy-box.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/helpers.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/velocity.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/velocity.ui.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/motion.js" id="motion.global"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/fastclick.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/lazyload.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/bootstrap.js"></script>


<?php
if (cs_get_option('pop_switcher')){
    include 'element/script-pop.php';
}




if(is_single()){
    echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/bootstrap.scrollspy.js"></script>';
    echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/article.js"></script>';
}
echo "<div style='display: none;'><script>";
wexweb('footer_add_script','');
echo "</script></div>";
wp_footer();


if(cs_get_option('nest_switcher')==true){
    $template=get_template_directory_uri();
    $opacity=cs_get_option('nest_opacity')/100;
    $count=cs_get_option('nest_count');


echo <<<nestJS

    <script type="text/javascript" color="#000" opacity='{$opacity}' zIndex="-2" count="{$count}" src="{$template}/js/nest.min.js"></script>



nestJS;

}

?>

</body>

</html>