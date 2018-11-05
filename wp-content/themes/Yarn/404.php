<?php get_header(); ?>
	<article id="post-404" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<img src="<?php bloginfo('template_directory');?>/assets/img/404.png" alt="404">
         <p>对不起，你请求的页面不存在！请 <a href="<?php bloginfo('url');?>"> 返回首页 </a></p>
  		 <p>如无任何操作将在 <span id="mes">9</span> 秒钟后返回到首页！</p>
	</article>
    <script>
    var i = 5;
    var timer;
    timer = setInterval("fun()", 1000);

    function fun() {
        if (i == 0) {
            window.location.href="<?php bloginfo('url');?>";
            clearInterval(timer);
        }
        document.getElementById("mes").innerHTML = i;
        i--;
    }
    </script>
<?php get_footer(); ?>
