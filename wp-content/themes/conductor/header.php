<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
?><!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title>
	Conductor Productions <?php wp_title('|'); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<!-- <link rel="stylesheet" href="<?php bloginfo(template_url); ?>/styles/layout.css"> -->

 
	<!-- build:css(.tmp) styles/main.css -->
	<link rel="stylesheet" href="<?php bloginfo(template_url); ?>/app/styles/screen.css">
	<!-- endbuild -->
	<!-- build:js scripts/vendor/modernizr.js -->
	<script src="<?php bloginfo(template_url); ?>/app/bower_components/modernizr/modernizr.js"></script>
	<!-- endbuild -->


<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico">
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<section class="outer-wrapper bounds">

		<header id="header">
			<section class="header-inner inner-wrapper">
				<a href="/" class="logo-container left" title="Conductor Productions">
					<img src="<?php bloginfo(template_url); ?>/images/logo-white.svg" alt="Conductor" />
				</a>
				<div class="menu-icon right menu-trigger">
					<small>menu</small>
					<span class="top"></span>
					<span class="mid"></span>
					<span class="bottom"></span>
				</div><!-- / end menu icon -->
			</section><!-- / end inner header -->
		</header><!-- / end header -->
		
		<nav class="nav-container">
  			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- / end right nav container -->
		

