<style>
		<?php $startColor = theme_option('type-start-color', '#648CFE');
		
			  $endColor = theme_option('type-end-color', '#c02942');
		?>
		 
		.post [rel="gallery"]:after {
			background: <?php echo $startColor ?>;
		}
		.post [rel="gallery"]:after {
			background: <?php echo $endColor ?>;
			background: -moz-linear-gradient(top,  <?php echo $startColor ?> 0%, <?php echo $endColor ?> 100%);
			background: -webkit-gradient(linear, top center, bottom center, color-stop(0%,<?php echo $startColor ?>), color-stop(100%,<?php echo $endColor ?>));
			background: -webkit-linear-gradient(top,  <?php echo $startColor ?> 0%,<?php echo $endColor ?> 100%);
			background: -o-linear-gradient(top,  <?php echo $startColor ?> 0%,<?php echo $endColor ?> 100%);
			background: -ms-linear-gradient(top,  <?php echo $startColor ?> 0%,<?php echo $endColor ?> 100%);
			background: linear-gradient(to bottom,  <?php echo $startColor ?> 0%,<?php echo $endColor ?> 100%);
		}
		.wpcf7-text:focus,
		.wpcf7-number:focus,
		.wpcf7-select:focus,
		.wpcf7-textarea:focus {
			border-color: <?php echo $startColor ?>;
		}
		[id="submit"],
		.wpcf7-submit,
		.btn--primary {
			background: <?php echo $startColor ?>;
		}

		.statusicon,.red .mediain,.gaz-btn.primary {background: <?php echo $startColor ?>;}.red .pointyTip,.red .pointyTipShadow {border-top-color: <?php echo $startColor ?>;}
		
		a,#error,.navbar ul li.current-menu-ancestor>a,.navbar ul li.current-menu-item>a,.pagination i,.page-numbers.current {color: <?php echo $startColor ?>;}
		
		.posts-list a:hover,.socialize a:hover,.fat-footer__social a i:hover,.comment h4 a:hover,.comment .comment-reply-link:hover,.welcome span:hover{color: <?php echo $startColor ?>;}
		
		.color {background-image: -webkit-linear-gradient(right,<?php echo $startColor ?> 0%, <?php echo $endColor ?> 100%);
		background-image: linear-gradient(right,<?php echo $startColor ?> 0%, <?php echo $endColor ?> 100%);
		}
		
		<?php echo theme_option('custom-css', '') ?>
		
</style>