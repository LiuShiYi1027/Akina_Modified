<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */
 
 

function optionsframework_option_name() {

	// 从样式表获取主题名称
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  请阅读:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	// 测试数据
	$test_array = array(
		'one' => __('1', 'options_framework_theme'),
		'two' => __('2', 'options_framework_theme'),
		'three' => __('3', 'options_framework_theme'),
		'four' => __('4', 'options_framework_theme'),
		'five' => __('5', 'options_framework_theme'),
		'six' => __('6', 'options_framework_theme'),
		'seven' => __('7', 'options_framework_theme')
	);
		

	// 复选框数组
	$multicheck_array = array(
		'one' => __('法国吐司', 'options_framework_theme'),
		'two' => __('薄煎饼', 'options_framework_theme'),
		'three' => __('煎蛋', 'options_framework_theme'),
		'four' => __('绉绸', 'options_framework_theme'),
		'five' => __('感化饼干', 'options_framework_theme')
	);

	// 复选框默认值
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// 背景默认值
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// 版式默认值
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// 版式设置选项
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => '普通','bold' => '粗体' ),
		'color' => false
	);

	// 将所有分类（categories）加入数组
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// 将所有标签（tags）加入数组
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// 将所有页面（pages）加入数组
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// 如果使用图片单选按钮, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	//基本设置
	$options[] = array(
		'name' => __('基本设置', 'options_framework_theme'),
		'type' => 'heading');

    $options[] = array(
        'name' => __("主题风格", 'akina'),
        'id' => 'theme_skin',
        'std' => "#A0DAD0",
        'desc' => __('自定义主题颜色', ''),
        'type' => "color"
    );

    $options[] = array(
        'name' => __("网站整体变灰", 'akina'),
        'id' => 'site_gray',
        'std' => false,
        'desc' => __('开启'),
        'type' => "checkbox"
    );
		
	$options[] = array(
		'name' => __('logo', 'options_framework_theme'),
		'desc' => __('高度尺寸50px。', 'options_framework_theme'),
		'id' => 'akina_logo',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('博主描述', 'options_framework_theme'),
		'desc' => __('一段自我描述的话', 'options_framework_theme'),
		'id' => 'admin_des',
		'std' => 'Carpe Diem and Do what I like',
		'type' => 'textarea');	
	
	$options[] = array(
		'name' => __('自定义关键词和首页描述', 'options_framework_theme'),
		'desc' => __('开启之后可自定义填写关键词和首页描述', 'options_framework_theme'),
		'id' => 'akina_meta',
		'std' => '0',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('关键词', 'options_framework_theme'),
		'desc' => __('各关键字间用半角逗号","分割，数量在5个以内最佳。', 'options_framework_theme'),
		'id' => 'akina_meta_keywords',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('首页描述', 'options_framework_theme'),
		'desc' => __('用简洁的文字描述本站点，字数建议在120个字以内。', 'options_framework_theme'),
		'id' => 'akina_meta_description',
		'std' => '',
		'type' => 'text');	
	
		
	$options[] = array(
		'name' => __('是否开启多说插件支持', 'options_framework_theme'),
		'desc' => __('如果使用多说插件，请开启此选项;使用自带评论请关闭', 'options_framework_theme'),
		'id' => 'general_disqus_plugin_support',
		'std' => '0',
		'type' => 'checkbox');		
	
	$options[] = array(
		'name' => __('顶部搜索按钮', 'akina'),
		'id' => 'top_search',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
        ));

	$options[] = array(
		'name' => __('评论收缩', 'akina'),
		'id' => 'toggle-menu',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));

	$options[] = array(
		'name' => __('页脚信息', 'options_framework_theme'),
		'desc' => __('页脚说明文字', 'options_framework_theme'),
		'id' => 'footer_info',
		'std' => 'Carpe Diem and Do what I like',
		'type' => 'textarea');

    //首页布局
	$options[] = array(
		'name' => __('首页布局', 'options_framework_theme'),
		'type' => 'heading');
	
	$options[] = array(
        'name' => __('首页背景图', 'options_framework_theme'),
		'desc' => __('高度尺寸1920*1080。', 'options_framework_theme'),
		'id' => 'focus_img',
		'type' => 'upload');
		
	 $options[] = array(
		'name' => __('个人头像', 'options_framework_theme'),
		'desc' => __('高度尺寸50px。', 'options_framework_theme'),
		'id' => 'focus_logo',
		'type' => 'upload'); 
		
	$options[] = array(
		'name' => __('是否开启顶公告', 'options_framework_theme'),
		'desc' => __('默认不显示，勾选开启', 'options_framework_theme'),
		'id' => 'head_notice',
		'std' => '0',
		'type' => 'checkbox');	

	$options[] = array(
		'name' => __('顶部公告内容', 'options_framework_theme'),
		'desc' => __('顶部公告内容', 'options_framework_theme'),
		'id' => 'notice_title',
        'std' => '',
        'type' => 'textarea');
		
	$options[] = array(
		'name' => __('首页列表特色图样式', 'akina'),
		'id' => 'list_type',
		'std' => "round",
		'type' => "radio",
		'options' => array(
			'round' => __('圆形', ''),
			'square' => __('方形', '')
		));	
		
	$options[] = array(
		'name' => __('是否开启聚焦', 'options_framework_theme'),
		'desc' => __('默认开启', 'options_framework_theme'),
		'id' => 'top_feature',
		'std' => '1',
		'type' => 'checkbox');	

	$options[] = array(
		'name' => __('聚焦标题', 'options_framework_theme'),
		'desc' => __('默认为聚焦，你也可以修改为其他，当然不能当广告用！不允许！！', 'options_framework_theme'),
		'id' => 'feature_title',
		'std' => '聚焦',
		'class' => 'mini',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('聚焦图一', 'options_framework_theme'),
		'desc' => __('尺寸257px*160px', 'options_framework_theme'),
		'id' => 'feature1_img',
		'std' => '//i4.piimg.com/501993/38f8fc40d638024f.jpg',
		'type' => 'upload');

	$options[] = array(
		'name' => __('聚焦图一标题', 'options_framework_theme'),
		'desc' => __('聚焦图一标题', 'options_framework_theme'),
		'id' => 'feature1_title',
		'std' => 'feature1',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('聚焦图一链接', 'options_framework_theme'),
		'desc' => __('聚焦图一链接', 'options_framework_theme'),
		'id' => 'feature1_link',
		'std' => '#',
		'type' => 'text');		
		
	$options[] = array(
		'name' => __('聚焦图二', 'options_framework_theme'),
		'desc' => __('尺寸257px*160px', 'options_framework_theme'),
		'id' => 'feature2_img',
		'std' => '//i4.piimg.com/501993/d496add2ef7bcd54.jpg',
		'type' => 'upload');

	$options[] = array(
		'name' => __('聚焦图二标题', 'options_framework_theme'),
		'desc' => __('聚焦图二标题', 'options_framework_theme'),
		'id' => 'feature2_title',
		'std' => 'feature2',
		'type' => 'text');

	$options[] = array(
		'name' => __('聚焦图二链接', 'options_framework_theme'),
		'desc' => __('聚焦图二链接', 'options_framework_theme'),
		'id' => 'feature2_link',
		'std' => '#',
		'type' => 'text');		
		
			
	$options[] = array(
		'name' => __('聚焦图三', 'options_framework_theme'),
		'desc' => __('尺寸257px*160px', 'options_framework_theme'),
		'id' => 'feature3_img',
		'std' => '//i4.piimg.com/501993/e90886a32d277f1c.jpg',
		'type' => 'upload');

	$options[] = array(
		'name' => __('聚焦图三标题', 'options_framework_theme'),
		'desc' => __('聚焦图三标题', 'options_framework_theme'),
		'id' => 'feature3_title',
		'std' => 'feature3',
		'type' => 'text');	

	$options[] = array(
		'name' => __('聚焦图三链接', 'options_framework_theme'),
		'desc' => __('聚焦图三链接', 'options_framework_theme'),
		'id' => 'feature3_link',
		'std' => '#',
		'type' => 'text');
			
    //响应式设置
    $options[] = array(
        'name' => __('响应式', 'options_framework_theme'),
        'type' => 'heading');

    $options[] = array(
        'name' => __('首页背景图高度', 'options_framework_theme'),
        'desc' => __('不填是全屏，输入则指定高度(建议值650px),无需添加px单位，直接填入数值', 'options_framework_theme'),
        'id' => 'focus_img_height',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('小分辨率显示首页背景图', 'akina'),
        'id' => 'display_focus_img',
        'std' => "no",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', ''),
            'no' => __('关闭', '')
        ));

    $options[] = array(
        'name' => __('小分辨率显示文章特色图片', 'akina'),
        'id' => 'display_centerbg_single',
        'std' => "no",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', ''),
            'no' => __('关闭', '')
        ));
    //文章页
	$options[] = array(
		'name' => __('文章页', 'options_framework_theme'),
		'type' => 'heading');

    $options[] = array(
        'name' => __('文章保护提示语', 'options_framework_theme'),
        'desc' => __('游客查看加密文章提示语', 'options_framework_theme'),
        'id' => 'post_password_info',
        'std' => '这是一篇受密码保护的文章，您需要提供访问密码：',
        'type' => 'text');
		
	$options[] = array(
		'name' => __('文章点赞', 'akina'),
		'id' => 'post_like',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));	
		
	$options[] = array(
		'name' => __('文章分享', 'akina'),
		'id' => 'post_share',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));	
	
	$options[] = array(
		'name' => __('上一篇下一篇', 'akina'),
		'id' => 'post_nepre',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));	
		
	$options[] = array(
		'name' => __('首页博主信息', 'akina'),
		'id' => 'author_profile',
		'std' => "yes",
		'type' => "radio",
		'options' => array(
			'yes' => __('开启', ''),
			'no' => __('关闭', '')
		));

    $options[] = array(
        'name' => __('地理位置', 'options_framework_theme'),
        'desc' => __('', 'options_framework_theme'),
        'id' => 'author_location',
        'std' => 'JiangSu.SuZhou',
        'type' => 'text');

    $options[] = array(
        'name' => __('小屏幕设备文章页博主信息', 'akina'),
        'id' => 'post_author_profile',
        'std' => "no",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', ''),
            'no' => __('关闭', '')
        ));

    $options[] = array(
        'name' => __('捐赠：支付宝', 'options_framework_theme'),
        'desc' => __('支付宝二维码(分辨率152像素以上)', 'options_framework_theme'),
        'id' => 'alipay',
        'type' => 'upload');

    $options[] = array(
        'name' => __('捐赠：微信', 'options_framework_theme'),
        'desc' => __('微信二维码(分辨率152像素以上)', 'options_framework_theme'),
        'id' => 'wechatpay',
        'type' => 'upload');

    //社交选项
	$options[] = array(
		'name' => __('社交设置', 'options_framework_theme'),
		'type' => 'heading');

    $options[] = array(
        'name' => __('Email邮箱', 'options_framework_theme'),
        'desc' => __('方案一.使用HTML标签属性：mailto:email@exmail.com 方案二.使用<a href="http://openmail.qq.com/cgi-bin/dy_template?sid=MInEfimdhxHHaEUS&t=index&sub=0&r=7f12022b516fe2723d773cf919d3631f" rel="nofollow" target="_blank">QQ邮箱：邮我</a>', 'options_framework_theme'),
        'id' => 'email',
        'std' => '',
        'type' => 'text');

	$options[] = array(
		'name' => __('微信', 'options_framework_theme'),
		'desc' => __('微信二维码', 'options_framework_theme'),
		'id' => 'wechat',
		'type' => 'upload');

    $options[] = array(
        'name' => __('腾讯qq', 'options_framework_theme'),
        'desc' => __('QQ互联地址(http://wpa.qq.com/msgrd?v=3&uin=你的QQ号码&site=qq&menu=yes)', 'options_framework_theme'),
        'id' => 'qq',
        'type' => 'text');

    $options[] = array(
		'name' => __('新浪微博', 'options_framework_theme'),
		'desc' => __('新浪微博地址', 'options_framework_theme'),
		'id' => 'sina',
		'std' => '',
		'type' => 'text');

    $options[] = array(
        'name' => __('Twitter', 'options_framework_theme'),
        'desc' => __('个人Twitter主页', 'options_framework_theme'),
        'id' => 'twitter',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Google+社区', 'options_framework_theme'),
        'desc' => __('个人Google+主页', 'options_framework_theme'),
        'id' => 'google',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('Facebook', 'options_framework_theme'),
        'desc' => __('个人Facebook主页', 'options_framework_theme'),
        'id' => 'facebook',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('SegmentFault社区', 'options_framework_theme'),
        'desc' => __('个人SegmentFault社区主页', 'options_framework_theme'),
        'id' => 'segmentfault',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('知乎', 'options_framework_theme'),
        'desc' => __('个人知乎主页', 'options_framework_theme'),
        'id' => 'zhihu',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('豆瓣', 'options_framework_theme'),
        'desc' => __('个人豆瓣主页', 'options_framework_theme'),
        'id' => 'douban',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('哔哩哔哩动画', 'options_framework_theme'),
        'desc' => __('个人哔哩哔哩动画主页', 'options_framework_theme'),
        'id' => 'bili',
        'std' => '',
        'type' => 'text');

	$options[] = array(
		'name' => __('Coding', 'options_framework_theme'),
		'desc' => __('Coding个人主页', 'options_framework_theme'),
		'id' => 'coding',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('GitHub', 'options_framework_theme'),
		'desc' => __('GitHub地址', 'options_framework_theme'),
		'id' => 'github',
		'std' => '',
		'type' => 'text');

	//高级设置
	$options[] = array(
		'name' => __('高级设置', 'options_framework_theme'),
		'type' => 'heading' );
		
	$options[] = array(
		'name' => __('作品页面', 'options_framework_theme'),
		'desc' => __('选择一个或多个分类作为作品页面', 'options_framework_theme'),
		'id' => 'works_multicheck',
		'type' => 'multicheck',
		'options' => $options_categories);	
		
	$options[] = array(
		'name' => __('七牛图片cdn', 'options_framework_theme'),
		'desc' => __('！重要:填写格式为 http://你的二级域名（七牛三级域名）/wp-content/uploads', 'options_framework_theme'),
		'id' => 'qiniu_cdn',
		'std' => '',
		'type' => 'text');

    $options[] = array(
        'name' => __('开启页脚加载耗时', 'akina'),
        'id' => 'echo_footer_time_log',
        'std' => "no",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启', ''),
            'no' => __('关闭', '')
        ));

    $options[] = array(
        'name' => __('ICP备案号', 'options_framework_theme'),
        'desc' => __('', 'options_framework_theme'),
        'id' => 'zh_cn_l10n_icp_num',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('公安备案号', 'options_framework_theme'),
        'desc' => __('', 'options_framework_theme'),
        'id' => 'zh_cn_l10n_gongan_icp_num',
        'std' => '<a target="_blank" rel="nofollow" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=32010402000100">苏公网安备 32010402000100号</a>',
        'type' => 'textarea');

    $options[] = array(
        'name' => __('网站统计代码', 'options_framework_theme'),
        'desc' => __('用于添加第三方流量数据统计代码，如：Google analytics、百度统计、CNZZ、51la，国内站点推荐使用百度统计，国外站点推荐使用Google analytics', 'options_framework_theme'),
        'id' => 'track_code',
        'std' => '',
        'type' => 'textarea');

    $options[] = array(
        'name' => __('网站统计链接', 'options_framework_theme'),
        'desc' => __('请按照格式填写相关代码', 'options_framework_theme'),
        'id' => 'track_link',
        'std' => '<a href="链接" rel="nofollow" target="_blank">站长统计</a>',
        'type' => 'textarea');

    $options[] = array(
        'name' => __('网站地图', 'options_framework_theme'),
        'desc' => __('填写网站地图网址', 'options_framework_theme'),
        'id' => 'sitemap_link',
        'std' => '',
        'type' => 'text');

    $options[] = array(
        'name' => __('网页页脚显示RSS', 'options_framework_theme'),
        'id' => 'site_feed',
        'std' => "no",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启'),
            'no' => __('关闭')
        ));

    $options[] = array(
        'name' => '分类url去除category字样',
        'desc' => __('该功能和no-category插件作用相同，可停用no-category插件', 'options_framework_theme'),
        'id' => 'no_categoty',
        'std' => "no",
        'type' => "radio",
        'options' => array(
            'yes' => __('开启'),
            'no' => __('关闭')
        ));

    $options[] = array(
        'name' => __('开启语法高亮', 'options_framework_theme'),
        'desc' => __('', 'options_framework_theme'),
        'id' => 'highlight_highlighters',
        'std' => '0',
        'type' => "radio",
        'options' => array(
            '1' => __('开启'),
            '0' => __('关闭')
        ));
	return $options;
}