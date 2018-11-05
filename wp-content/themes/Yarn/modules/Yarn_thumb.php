<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>
<div class="p-header">
		<figure class="p-image" style="background-image: url(<?php if ( has_post_thumbnail()) : ?><?php echo $thumb['0']; ?><?php else : ?><?php echo get_template_directory_uri() . '/assets/img/thumbnail.jpg'; ?><?php endif; ?>);"></figure>
</div>
       