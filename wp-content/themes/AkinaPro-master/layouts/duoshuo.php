<?php 

	/**
	 * DISQUS COMMENTS
	 */

?>

<?php if ( !is_home()&&(comments_open() != false) ){ ?>

	<section id="comments" class="duoshuowrapper comments">
		<div class="comments-main">
			<div class="commentwrap">
				<?php comments_template('', true); ?>
			</div>
		</div>
	</section>
	<?php } ?>
