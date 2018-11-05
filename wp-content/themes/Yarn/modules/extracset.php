
	<?php if (theme_option('wave-effect')) : ?>
	
	<?php get_template_part('modules/normal-footer'); ?>
	
	<?php else : ?>
	
	<?php get_template_part('modules/animation-footer'); ?>
	
	<?php endif; ?>
		
	<?php if (theme_option('dblclick')) : ?>
	
	<script type="text/javascript">function dblclick(){window.scrollTo(0,0)}if(document.layers){document.captureEvents(ONDBLCLICK)}document.ondblclick=dblclick;</script>
	
	<?php endif ?>
	
	<?php if (theme_option('scrolltohide')) : ?>
	
	<?php if ( is_single() ) {?><script type="text/javascript">window.onscroll=function(){var scrollTop=document.body.scrollTop;if(scrollTop>=200){document.getElementById("NextPrevPosts").style.display="none"}else{document.getElementById("NextPrevPosts").style.display="block"}}</script><?php } ?>
	
	<?php endif ?>
