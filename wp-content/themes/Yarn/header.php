<!doctype html>
<html lang="zh" >
<head>	
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11"> 
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />  
<?php include('seo.php'); ?>
<?php wp_head(); ?>
</head>

<?php

	$options = array(
	'fancy-captions',
	'format-lede',
	'round-avatars'
	);

	$classes = array();

	foreach ( $options as $option ) {
	if ( theme_option( $option ) ) {
		$classes[] = $option;
	}
	}

	$classes = implode( ' ', $classes );

	?>

<body <?php body_class( $classes ); ?> itemscope itemtype="<?php echo esc_url('http://schema.org/Organization'); ?>" >

	<?php if ( is_home() || is_category() || is_search() || is_tag() ) {?><div class="Yarn_Background" style="background-image: url( <?php if ( $Yarn_Background = theme_option('Yarn_Background', false) ) : ?><?php echo  $Yarn_Background ?><?php else : ?><?php echo get_template_directory_uri() . '/assets/img/thumbnail.jpg'; ?><?php endif; ?>);"></div><?php } ?>
		
	<?php if (theme_option('show-search')) : ?>

		<form class="js-search search-form search-form--modal" method="get" action="<?php echo home_url(); ?>" role="search">
			<div class="search-form__inner">
				<div>
					<div id="search-container" class="ajax_search">
						<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
					<div class="filter_container"><input type="text" value="" autocomplete="off" placeholder="Type then select or enter" name="s" id="search-input"/><ul id="search_filtered" class="search_filtered"></ul> </div>
							<input type="submit" name="submit" id="searchsubmit" class="searchsubmit" value=""/>
						</form>
					</div>
				</div>
			</div>
		</form>
	
	<?php endif ?>
	
	<div class="navi" data-aos="fade-down">

		<div class="bt-nav">
			<div class="line line1"></div>
			<div class="line line2"></div>
			<div class="line line3"></div>
		</div>
			<div class="navbar animated fadeInRight">
			   <div class="inner">      
					<nav id="site-navigation" class="main-navigation">
						<div id="main-menu" class="main-menu-container">
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>			
						</div>
					</nav><!-- #site-navigation -->
				</div>
		</div>
		
	</div>
		
	<div class="hebin" data-aos="fade-down">	
	
	<?php if (theme_option('show-search')) : ?><i class=" js-toggle-search iconfont">&#xe60e;</i>
	
	<?php endif ?>
		
	</div>

	<header id="masthead" class="overlay animated from-bottom" itemprop="brand" itemscope itemtype="<?php echo esc_url('http://schema.org/Brand'); ?>">	

				<div class="site-branding text-center">
					
					<a href="<?php echo home_url() ?>">
						
						<figure >
							
							<?php if ( $avatar = theme_option('avatar', false) ) : ?> <img  class="custom-logo avatar" src="<?php echo  $avatar ?>"/>
			   
							<?php endif ?>
						
						</figure>
					
					</a>
					
					<h3 class="blog-description"><p><?php echo theme_option('notice-section-content', get_bloginfo('description')) ?></p></h3>	
					
			</div><!-- .site-branding -->
			
	<?php if (theme_option('particles-effect')) : ?>	
	
		<div class="decor-part"><?php get_template_part('modules/particles'); ?></div>

	<?php endif ?>	
	
    <div class="animation-header"><?php get_template_part('modules/animation-header'); ?></div>
	
	</header>

	<div id="main" class="content">

			<div class="container">	