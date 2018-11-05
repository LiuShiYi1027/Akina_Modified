<?php
include "includes/actions.php";
include "includes/filters.php";
include "includes/assets.php";
include "includes/base.php";
include "includes/shortcodes.php";
include "includes/tinymce.php";

// theme_options
function theme_option( $name, $default = false )
{
	$options = ( get_option( 'theme_options' ) ) ? get_option( 'theme_options' ) : null;
	if ( isset( $options[ $name ] ) && ! empty( $options[ $name ] ) ) {
	return apply_filters( 'theme_options_$name', $options[ $name ] );
	}
	return apply_filters( 'theme_options_$name', $default );
}

function type_customize_register( $wp_customize )
{


	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'custom_css' );

	$wp_customize->add_section( 'title_tagline', array(
		'title'      => '个人信息',
		'capability' => 'edit_theme_options',
		'priority'   => 1
	) );
    
	$wp_customize->add_section( 'theme_section', array(
		'title'      => '功能设置',
		'capability' => 'edit_theme_options',
		'priority'   => 2
	) );
	
	$wp_customize->add_section( 'post_section', array(
		'title'      => '文章设置',
		'capability' => 'edit_theme_options',
		'priority'   => 3
	) );
	
	$wp_customize->add_section( 'colors_section', array(
		'title'      => '颜色设置',
		'capability' => 'edit_theme_options',
		'priority'   => 4
	) );

	$wp_customize->add_section( 'social_section', array(
		'title'      => '社交图标',
		'capability' => 'edit_theme_options',
		'description' => __('一般情况下填写所在社交网站上的用户名即可'),
		'priority'   => 5
	) );
	
	$wp_customize->add_section( 'Custom_Background_Image_section', array(
		'title'      => '自定义背景',
		'capability' => 'edit_theme_options',
		'description' => __('建议上传 1024 像素宽度以上的图像'),
		'priority'   => 6
	) );
	
	$wp_customize->add_section( 'custom_css_section', array(
		'title'      => '自定义样式',
		'capability' => 'edit_theme_options',
		'description' => __('直接填写css样式即可'),
		'priority'   => 7
	) );
	
    $wp_customize->add_section( 'footer_section', array(
        'title'		 => '页脚信息',
        'capability' => 'edit_theme_options',
		'description' => __('两选项可选其一，但自定义内容会全覆盖原版权链接。这是保留选项，献给强迫症！'),
        'priority' 	 => 8
        )
    );

	// Yarn_Background

	$wp_customize->add_setting( 'theme_options[Yarn_Background]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'Yarn_Background', array(
		'label'    => '自定义背景图',
		'section'  => 'Custom_Background_Image_section',
		'settings' => 'theme_options[Yarn_Background]'
	) ) );
	

    // Avatar	 
	$wp_customize->add_setting( 'theme_options[avatar]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
	) );
	

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'avatar', array(
		'label'    => '头像标识',
		'description' => __('建议上传 128 像素的图像作为标识'),        
		'section'  => 'title_tagline',
		'settings' => 'theme_options[avatar]',
        'priority'   => 99
	) ) );
    

	// Description
	$wp_customize->add_setting( 'theme_options[description-section-caption]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option'
	) );

	$wp_customize->add_control( 'description-section-caption', array(
		'settings' => 'theme_options[description-section-caption]',
		'label'    => '描述（Description）',
		'section'  => 'title_tagline',
		'type'     => 'text',
        'priority'   => 100
	) );

	// Keyword
	
	$wp_customize->add_setting( 'theme_options[keyword-section-content]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option'
	) );

	$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'keyword-section-content', array(
		'label'    => '关键词（keyword）',
		'section'  => 'title_tagline',
		'settings' => 'theme_options[keyword-section-content]',
        'priority'   => 101
	) ) );
        
	// Notic	
	$wp_customize->add_setting( 'theme_options[notice-section-content]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option'
	) );

	$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'notice-section-content', array(
		'label'    => '公告栏',
		'section'  => 'title_tagline',
		'settings' => 'theme_options[notice-section-content]',
        'priority'   => 102
	) ) );
    
	// setanimate
	$wp_customize->add_setting( 'theme_options[setanimate]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'setanimate', array(
		'settings' => 'theme_options[setanimate]',
		'label'    => '动画效果（Animate effect）',
		'section'  => 'theme_section',
		'type'     => 'checkbox',
	) );
		 
	// wave effect
	
	$wp_customize->add_setting( 'theme_options[wave-effect]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'wave-effect', array(
		'settings' => 'theme_options[wave-effect]',
		'label'    => '波浪布局（Wave layout）',
		'section'  => 'theme_section',
		'type'     => 'checkbox',
	) );


	// Show/Hide particles effect
	
	$wp_customize->add_setting( 'theme_options[particles-effect]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'particles-effect', array(
		'settings' => 'theme_options[particles-effect]',
		'label'    => '粒子动画（Particles effect）',
		'section'  => 'theme_section',
		'type'     => 'checkbox',
	) );
	
	// loop-type
	
	$wp_customize->add_setting( 'theme_options[loop-type]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'loop-type', array(
		'settings' => 'theme_options[loop-type]',
		'label'    => '多种文章格式（Multi Post Formats）',
		'section'  => 'theme_section',
		'type'     => 'checkbox',
	) );

	// Infinite scroll
	
	$wp_customize->add_setting( 'theme_options[infinite-scroll]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'infinite-scroll', array(
		'settings' => 'theme_options[infinite-scroll]',
		'label'    => '滚动加载（Infinite scroll）',
		'section'  => 'theme_section',
		'type'     => 'checkbox',
	) );
	
	// Dblclick to top
	
	$wp_customize->add_setting( 'theme_options[dblclick]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'dblclick', array(
		'settings' => 'theme_options[dblclick]',
		'label'    => '双击回顶（dblclick to top）',
		'section'  => 'theme_section',
		'type'     => 'checkbox',
	) );
	// Show/Hide Search
	 
	$wp_customize->add_setting( 'theme_options[show-search]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'show-search', array(
		'settings' => 'theme_options[show-search]',
		'label'    => '搜索图标（Search icon ）',
		'section'  => 'theme_section',
		'type'     => 'checkbox',
	) );

	// Round/Square logo
	
	$wp_customize->add_setting( 'theme_options[round-avatars]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'round-avatars', array(
		'settings' => 'theme_options[round-avatars]',
		'label'    => '圆角头像（Round avatars）',
		'section'  => 'theme_section',
		'type'     => 'checkbox',
	) );
	
	// Post Section

	// Format first paragraph
	
	$wp_customize->add_setting( 'theme_options[format-lede]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'format-lede', array(
		'settings' => 'theme_options[format-lede]',
		'label'    => '首段标黑（Format first paragraph）',
		'section'  => 'post_section',
		'type'     => 'checkbox',
	) );
	
	// Show/Hide nav post
	
	$wp_customize->add_setting( 'theme_options[nav-post]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'nav-post', array(
		'settings' => 'theme_options[nav-post]',
		'label'    => '前后文章链接（Nav post）',
		'section'  => 'post_section',
		'type'     => 'checkbox',
	) );
	
	// scroll to hide
	
	$wp_customize->add_setting( 'theme_options[scrolltohide]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'scrolltohide', array(
		'settings' => 'theme_options[scrolltohide]',
		'label'    => '滚动隐藏前后文链接（scroll to hide）',
		'section'  => 'post_section',
		'type'     => 'checkbox',
	) );
	
	// Fancy photo captions
	 
	$wp_customize->add_setting( 'theme_options[fancy-captions]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => true
	) );

	$wp_customize->add_control( 'fancy-captions', array(
		'settings' => 'theme_options[fancy-captions]',
		'label'    => '图像暗箱效果（fancy Gallery）',
		'section'  => 'post_section',
		'type'     => 'checkbox',
	) );

	// Show/Hide Social Share Buttons
	
	$wp_customize->add_setting( 'theme_options[show-social-share]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'show-social-share', array(
		'settings' => 'theme_options[show-social-share]',
		'label'    => '文章社交分享（Social share）',
		'section'  => 'post_section',
		'type'     => 'checkbox',
	) );

	
	// Top gradient color
	 
	$wp_customize->add_setting( 'theme_options[type-start-color]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => '#648CFE'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'type-start-color', array(
		'label'    => '链接颜色 X 图像遮罩层',
		'section'  => 'colors_section',
		'description' => __('链接颜色 X 图像遮罩渐变顶色'),
		'settings' => 'theme_options[type-start-color]'
	) ) );


	// Top gradient color
	 
	$wp_customize->add_setting( 'theme_options[type-end-color]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => '#1abc9c'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'type-end-color', array(
		'label'    => '遮罩底色',
		'section'  => 'colors_section',
		'description' => __('图像遮罩的渐变底色'),
		'settings' => 'theme_options[type-end-color]'
	) ) );
	
    // Copyright Text
    $wp_customize->add_setting(
        'yarn_copyright_textbox',
        array(
            'default' => '',
            'callback' => 'yarn_text',
        )
    );

    $wp_customize->add_control(
        'yarn_copyright_textbox',
        array(
            'label' => __('版权信息'),
            'section' => 'footer_section',
            'type' => 'text',
            'priority' => 1
        )
    );

    $wp_customize->add_setting(
        'credit_link',
        array(
            'default' => '',
            'callback' => 'yarn_checkbox',
        )
    );

    $wp_customize->add_control(
        'credit_link',
        array(
            'type' => 'checkbox',
            'label' => esc_html__('隐藏显示版权链接'),
            'section' => 'footer_section',
            'priority' => 2
        )
    );
		
    // notice board
    $wp_customize->add_setting(
        'yarn_notice_textbox',
        array(		 
            'default' => '',
            'type' => 'option',
            'callback' => 'yarn_text',
        )
    );
	
	    $wp_customize->add_control(
        'yarn_notice_textbox',
        array(
            'label' => __('页脚公告栏'),
            'section' => 'footer_section',
            'type' => 'text',
			'description' => __('建议限制在15个中文字以内（波浪布局下生效）'),
            'priority' => 3
        )
    );
	
	// social section 
	// wechat img
	
	$wp_customize->add_setting( 'theme_options[wechat]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wechat', array(
		'label'    => '微信二维码图像',
		'section'  => 'social_section',
		'settings' => 'theme_options[wechat]'
	) ) );
	
	// Show/Hide wechat

	$wp_customize->add_setting( 'theme_options[type-wechat]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'default'    => false
	) );

	$wp_customize->add_control( 'type-wechat', array(
		'settings' => 'theme_options[type-wechat]',
		'label'    => '显示/隐藏微信',
		'section'  => 'social_section',
		'type'     => 'checkbox',
	) );

	// Social icons
	registerSocial( 'type-weibo', '微博' );
	registerSocial( 'type-twitter', '推特' );
	registerSocial( 'type-instagram', 'instagram' );
	registerSocial( 'type-qq', 'QQ number' );
	
	// Custom css
	
	$wp_customize->add_setting( 'theme_options[custom-css]', array(
		'capability' => 'edit_theme_options',
		'type'       => 'option'
	) );

	$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'custom-css', array(
		'label'    => '',
		'section'  => 'custom_css_section',
		'settings' => 'theme_options[custom-css]'
	) ) );
	
	}


	function yarn_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
	}

	function yarn_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
	}

	function registerSocial( $name, $label )
	{
	global $wp_customize;

	$wp_customize->add_setting( "theme_options[$name]", array(
		'capability' => 'edit_theme_options',
		'type'       => 'option'
	) );

	$wp_customize->add_control( $name, array(
		'settings' => "theme_options[$name]",
		'label'    => $label,
		'section'  => 'social_section',
		'type'     => 'text',
	) );
	}

	class ColorGenerator {

	private static $startColor;
	private static $endColor;
	private static $steps;
	private static $colors;

	private static function interpolate(
		$pBegin, $pEnd, $pStep, $pMax
	) {
		if ( $pBegin < $pEnd ) {
			return ( ( $pEnd - $pBegin ) * ( $pStep / $pMax ) ) + $pBegin;
		} else {
			return ( ( $pBegin - $pEnd ) * ( 1 - ( $pStep / $pMax ) ) ) + $pEnd;
		}
	}

	public static function generate( $start, $end, $steps )
	{
		self::$startColor = hexdec( '0x' . str_replace( '#', '', $start ) );
		self::$endColor   = hexdec( '0x' . str_replace( '#', '', $end ) );

		self::$startColor = ( ( self::$startColor >= 0x000000 ) && ( self::$startColor <= 0xffffff ) ) ?
			self::$startColor : 0x000000;

		self::$endColor = ( ( self::$endColor >= 0x000000 ) && ( self::$endColor <= 0xffffff ) ) ?
			self::$endColor : 0xffffff;

		self::$steps = ( ( $steps > 0 ) && ( $steps < 256 ) ) ? --$steps : 16;

		if (self::$steps > 0) {
			$theR0 = ( self::$startColor & 0xff0000 ) >> 16;
			$theG0 = ( self::$startColor & 0x00ff00 ) >> 8;
			$theB0 = ( self::$startColor & 0x0000ff ) >> 0;

			$theR1 = ( self::$endColor & 0xff0000 ) >> 16;
			$theG1 = ( self::$endColor & 0x00ff00 ) >> 8;
			$theB1 = ( self::$endColor & 0x0000ff ) >> 0;

			for ( $i = 0; $i <= self::$steps; $i ++ ) {
				$theR = self::interpolate( $theR0, $theR1, $i, self::$steps );
				$theG = self::interpolate( $theG0, $theG1, $i, self::$steps );
				$theB = self::interpolate( $theB0, $theB1, $i, self::$steps );

				$color = ( ( ( $theR << 8 ) | $theG ) << 8 ) | $theB;

				self::$colors[] = str_pad( dechex( $color ), 6, '0', STR_PAD_LEFT );
			}
		} else {
			self::$colors[] = str_pad( dechex( self::$startColor ), 6, '0', STR_PAD_LEFT );
		}

		return self::$colors;
	}
}

	if ( class_exists( 'WP_Customize_Control' ) ):
		class WP_Customize_Textarea_Control extends WP_Customize_Control {
			public $type = 'textarea';

			public function render_content()
			{
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5"
				          style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
				<?php
			}
	}
	endif;
