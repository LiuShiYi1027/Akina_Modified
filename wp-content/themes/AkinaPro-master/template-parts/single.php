<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<span class="entry-title-info">
			<?php the_time('Y-m-d');?> -
			<?php get_post_views($post -> ID); ?> Views -
			<?php if( get_post_meta($post->ID,'specs_zan',true) ){
				echo get_post_meta($post->ID,'specs_zan',true);
			} else {
				echo '0';
			}?> Goods -
            <?php if ( post_password_required() ) { ?>
                <a href="">密码保护</a>
            <?php } else { ?>
                <?php comments_popup_link( 'Nothing', '1 条评论', '% 条评论' ); ?>
            <?php } ?>
		</span>

		<hr>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if (post_password_required()):the_content(); else:?>
		<?php the_content(); endif; ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ondemand' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?><!--面包屑导航-->

    <?php if (akina_option('alipay') || akina_option('wechatpay')) { ?>
        <div class="reward">
            <span>赏</span>
            <ul>
                <?php if (akina_option('alipay')) { ?>
                    <li><img src="<?php echo akina_option('alipay'); ?>">支付宝打赏</li>
                <?php };
                if (akina_option('wechatpay')) { ?>
                    <li><img src="<?php echo akina_option('wechatpay'); ?>">微信打赏</li>
                <?php }; ?>
            </ul>
        </div>
    <?php } ?>

	<footer class="post-footer">
		<div class="post-footer-lincenses">
			<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank" rel="nofollow">本站内容遵循知识共享署名-非商业性使用-相同方式共享
				4.0 国际许可协议</a>
		</div>
		<div class="post-tags">
			<?php if ( get_the_tags() ) {
				echo '<i class="iconfont">&#xe62d;</i> ';
				the_tags( '', ' ', ' ' );
			} ?>
		</div>
		<?php get_template_part( 'inc/sharelike' ); ?>
		
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
