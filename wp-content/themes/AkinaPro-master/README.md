#WP_Akina

---

#### Pjax版本(**已停止版本更新**)：[点击查看](https://coding.net/u/boxrom/p/WP_Akina/git/tree/Wp_Akina_Pjax/)

---

原版地址：[点击查看](http://www.akina.pw/archives/22)

修改地址：[点击查看](https://i95.me/)

### **`注意：请把主题重命名为AkinaPro，否则会出现主题更新失败的问题！`**

### 说明

1. 精简大量无用的代码
1. 重构布局
1. 重绘主题样式
1. 修改社交图片为矢量图标
1. 添加一些增强功能
1. 删除耗资源的jQuery动画效果
1. 重构菜单样式
1. 添加页面过渡特效
1. 添加360收录和百度推送SEO优化

主题下载：[点击下载](https://coding.net/u/boxrom/p/WP_Akina/git/archive/master)

### 优化

style.css中fonts矢量图标建议上cdn，请更换资源地址：

```
@font-face {
  font-family: 'iconfont';
  src: url('//at.alicdn.com/t/font_1473689406_0791912.eot'); /* IE9*/
  src: url('//at.alicdn.com/t/font_1473689406_0791912.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
  url('//at.alicdn.com/t/font_1473689406_0791912.woff') format('woff'), /* chrome、firefox */
  url('//at.alicdn.com/t/font_1473689406_0791912.ttf') format('truetype'), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/
  url('//at.alicdn.com/t/font_1473689406_0791912.svg#iconfont') format('svg'); /* iOS 4.1- */
}
```

主题目录下functions.php的192行到212行，请上传相关资源到CDN服务器(我的就别想了，已经上防盗链了)，更换资源：

```
function akina_scripts() {

	wp_enqueue_style( 'akina-style', get_stylesheet_uri() );

	//wp_enqueue_style( 'akina-style', '//blogresource.oss-cn-hangzhou.aliyuncs.com/css/style.css' );

	wp_enqueue_script( 'jQuery', get_template_directory_uri() . '/js/jquery.min.js', array(), '1.8.2', true );

	//wp_enqueue_script( 'jQuery', '//cdn.bootcss.com/jquery/1.8.2/jquery.min.js', array(), true );

	wp_enqueue_script( 'BaguetteBox', get_template_directory_uri() . '/js/baguetteBox.min.js', array(), '2016429', true );

	//wp_enqueue_script( 'BaguetteBox', '//blogresource.oss-cn-hangzhou.aliyuncs.com/javascript/baguetteBox.min.js', array(), '1.3.2', true );

	wp_enqueue_script( 'comments_ajax_js', get_template_directory_uri() . '/js/functions.js', array(), '2016429', true );

	//wp_enqueue_script('comments_ajax_js', '//blogresource.oss-cn-hangzhou.aliyuncs.com/javascript/functions.js', false, '1.4', true);

    wp_localize_script( 'comments_ajax_js', 'themeAdminAjax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );

}
add_action( 'wp_enqueue_scripts', 'akina_scripts' );
```

当然你用七牛插件那就无视吧...
