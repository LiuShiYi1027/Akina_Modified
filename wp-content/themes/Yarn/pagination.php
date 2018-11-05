<div class="pagination js-pagination">

	<?php if(theme_option('infinite-scroll')): ?>
	
		<div class="js-next pagination__load"><?php next_posts_link(__('<i class="iconfont">&#xe605;</i>', 'yarn')); ?></div>
		
	<?php else : ?>
	
		<div id="pagenavi"><?php pagenavi();?></div>
		
	<?php endif ?>
	
</div>
