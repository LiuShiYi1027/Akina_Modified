<div id="centerbg_single" style="background-image: url('<?php if (has_post_thumbnail()) {
    $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    echo $full_image_url[0];
} else {
    echo akina_option('focus_img');
} ?>')">
    <div class="focusinfo">
        <div class="header-info_single">
            <p>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <span class="entry-title-info">
			    <?php the_time('Y-m-d'); ?> -
                <?php get_post_views($post->ID); ?> Views -
                <?php if (get_post_meta($post->ID, 'specs_zan', true)) {
                    echo get_post_meta($post->ID, 'specs_zan', true);
                } else {
                    echo '0';
                } ?> Goods -
                <?php if ( post_password_required() ) { ?>
                    <a href="">密码保护</a>
                <?php } else { ?>
                    <?php comments_popup_link( 'Nothing', '1 条评论', '% 条评论' ); ?>
                <?php } ?>
		    </span>
            </p>
        </div>
    </div>
</div>






		
	
	
	




