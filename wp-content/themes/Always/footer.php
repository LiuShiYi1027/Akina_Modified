		</div><!--main-->
		<footer id="main-footer">
			<div id="footer-copy">
				<?php foo_copy(); ?>
			</div>
			<div class="clear"></div>
		</footer><!--footer-->
	</div>
	
	<nav id="narrow-menu">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
	</nav>
	
	<div id="loading-wrap">
		<div class="loading">
			<div class="loading-bar">
				<div class="bar1"></div>
				<div class="bar2"></div>
				<div class="bar3"></div>
				<div class="bar4"></div>
			</div>
			<div class="loading-text">loading</div>
		</div>
	</div><!--loading-->
	
	<div id="jquery_jplayer" class="jp-jplayer"></div>
	
	
	
	<?php wp_footer(); ?>
</body>
</html>