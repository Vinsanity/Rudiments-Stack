<?php
/**
 * The Header for our theme.
 *
 * @package Rudiments
 */
?>
<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	
	<title><?php wp_title(''); ?></title>

	<?php // Misc Meta ?>
	<meta charset="utf-8">
	<meta name="author" content="<?php bloginfo( 'name' ); ?>">
	<meta http-equiv="cleartype" content="on">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php // Google Chrome Frame for IE ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<?php // Mobile Meta ?>
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>

	<?php // icons & favicons ?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-touch.png">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>
	<meta name="msapplication-TileColor" content="#eee">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<div id="site-wrap">

	<header class="site-header" role="banner" itemtype="http://schema.org/WPHeader">
		<div class="content-wrap clearfix">

			<div class="site-branding column mobile-12 tablet-12 desktop-12 wide-12" itemscope itemprop="author headline" itemtype="http://schema.org/Organization">
				<?php // if logo ?>
				<div id="brand-logo" itemprop="logo"></div>
				<?php // if no logo ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div> <!-- .site-branding -->

			<nav id="primary-navigation" class="row clearfix" aria-label="Primary Menu" itemscope itemtype="http://schema.org/SiteNavigationElement">
				<button class="visuallyhidden menu-toggle"><?php _e( 'Primary Menu', 'rudiments' ); ?></button>
				<?php rudiments_primary_nav_menu(); ?>
			</nav><!-- #primary-navigation -->

		</div>
	</header><!-- .site-header -->
