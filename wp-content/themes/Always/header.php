<!DOCTYPE html>
<html>
<head>
	<title><?php wp_title( '-', true, 'right'); ?></title>
	<?php Always_meta(); ?>
	
	<?php wp_head(); ?>
	<?php $options = get_option('Always_options');?>

</head>
<body>
	<div id="wrapper">
		<header id="main-header" <?php if ( $options['header_bg'] ): ?>style="background-image:url(<?php echo $options['header_bg']; ?>);background-position:center center;background-size:cover;" <?php endif; ?>>
			<div id="header-wrap">
				<div id="logo">
					<h1><a href="<?php bloginfo("url"); ?>" title="<?php bloginfo("name"); ?>"><?php bloginfo("name"); ?></a></h1>
					<h2><?php bloginfo("description"); ?></h2>
					
					<div class="logo-img" >
						<?php if ( $options['logo_img'] ): ?>
							<img class="avatar" src="<?php echo $options['logo_img']; ?>" title="<?php bloginfo("name"); ?>"/>
						<?php else: ?>
							<?php echo get_avatar( get_bloginfo('admin_email') ); ?>
						<?php endif; ?>
					</div>
					<div id="logo-music">
						<div id="logo-music-name"></div>
						<div id="logo-music-prev"></div>
						<div id="logo-music-play"></div>
						<div id="logo-music-pause"></div>
						<div id="logo-music-next"></div>
						<div class="loading">
							<div class="loading-bar">
								<div class="bar1"></div>
								<div class="bar2"></div>
								<div class="bar3"></div>
								<div class="bar4"></div>
							</div>
						</div>
					</div>
					<div id="logo_jplayer" class="jp-jplayer"></div>
				</div>
				
				<button id="openlist" class="open"><span></span><span></span><span></span>playlist</button>
				<button id="openmenu" class="open"><span></span><span></span><span></span>menu</button>
				
				<nav id="main-nav">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
				</nav>
				
				<form role="search" method="get" id="search-form" action="<?php echo home_url( '/' ); ?>">
					<div>
						<input type="text" value="Search" name="s" id="s" onblur="if ( this.value == '' ){this.value='Search';}" onfocus = "if ( this.value == 'Search' ){this.value = '';}" />
					</div>
				</form>
				
				<div class="clear"></div>
			</div>
		</header><!--header-->
		
		<div id="main" <?php if ( $options['main_width'] == 0 ){echo 'class="main-full"';}else{echo 'class="main-narrow"';}  ?>>