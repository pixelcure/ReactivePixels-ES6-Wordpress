<?php
/*
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */

/************************************************************************************/
// initialization
/************************************************************************************/
add_action( 'after_setup_theme', 'sandbox_setup' );

if ( ! function_exists( 'sandbox_setup' ) ):

function sandbox_setup() {

	// set a content width if you haven't in the Dashboard
	if ( ! isset( $content_width ) ) $content_width = 580;

	// remove version # from RSS
	add_filter('the_generator', 'sandbox_hide_rss_version');

	// post thumbnails & custom sizes
	add_theme_support('post-thumbnails', array( 'page', 'post', 'samples') );

  // featured image support
  add_theme_support( 'post-thumbnails' );

  // theme support for feed links
	add_theme_support( 'automatic-feed-links' );

	// post formats
	add_theme_support( 'post-formats', array('aside','gallery','audio','video','quote','image','chat') );

	// enable the_excerpt for pages
	add_post_type_support('page', 'excerpt');

	// hide version #
	remove_action('wp_head', 'wp_generator');

	// register scripts
	if (!is_admin()) {
		// new scripts
		wp_register_script('sandbox.common', get_bloginfo('template_url').'/scripts/common.js', array('jquery'), '1.0', true);
		// global scripts
		wp_enqueue_script('jquery');
		//wp_enqueue_script('sandbox.common');
	}

	// register scripts for the Dashboard
	if (is_admin()) {
		// new scripts
		wp_register_script('dashboard.custom', get_bloginfo('template_url').'/scripts/dashboard.js', array('jquery'), '1.0', true);
		// global scripts
		wp_enqueue_script('dashboard.custom');
	}

	// register nav menus
	register_nav_menus( array(
		'primary' => 'Primary Navigation',
		'utility' => 'Utility Navigation'
	) );
}
endif;

/************************************************************************************/
// include extra functions
/************************************************************************************/
include_once('includes/functions-deactivate.php');
include_once('includes/functions-extend.php');
include_once('includes/functions-utility.php');

/************************************************************************************/
// include post types
/************************************************************************************/
include_once('includes/types/meta.php');
include_once('includes/types/type-pages.php');
include_once('includes/types/type-posts.php');
include_once('includes/types/type-sample.php');

/************************************************************************************/
// include options pages
/************************************************************************************/
include_once('includes/options/global.php');
include_once('includes/options/slider.php');

/************************************************************************************/
// include widgets
/************************************************************************************/
include_once('includes/widgets/widget-sample.php');

/************************************************************************************/
// include sidebars
/************************************************************************************/
function sandbox_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'sandbox' ),
		'id' => 'default',
		'description' => __( 'The default left sidebar for this theme.', 'sandbox' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	) );
	// this displays a sidebar for each custom sidebar assigned to a page or post
	if(function_exists('register_sidebar')){
		foreach(get_custom_sidebars() as $i=>$sb){
			register_sidebar(array(
				'name'=>$sb[meta_value],
				'id' => strtolower(str_replace(" ", "", $sb[meta_value])),
				'before_widget' => '<div class="widget %2$s" id="%1$s"><div class="top"></div><div class="innards">',
				'after_widget' => '</div><div class="bottom"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));
		}
	}
}
add_action( 'widgets_init', 'sandbox_widgets_init' );

/************************************************************************************/
// Inner Sidebar Custom Posttype
/************************************************************************************/

add_action( 'init', 'innerSideBar' );

function innerSideBar() {
	register_post_type( 'innerSidebar',
		array(
			'labels' => array(
				'name' => __( 'Inner Sidebar' ),
				'singular_name' => __( 'Inner Sidebar' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'sidebars'),
		)
	);
}

/************************************************************************************/
// Hero Featured Video Custom Posttype
/************************************************************************************/

add_action( 'init', 'heroFeaturedVideo' );

function heroFeaturedVideo() {
	register_post_type( 'heroFeaturedVideos',
		array(
			'labels' => array(
				'name' => __( 'Hero Featured Videos' ),
				'singular_name' => __( 'Hero Featured Video' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'hero-featured-videos'),
		)
	);
}

