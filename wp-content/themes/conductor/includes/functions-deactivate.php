<?php
/**
 * functions.deactivate
 *
 * These functions remove default functionality from the WordPress core.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */

/************************************************************************************/
// hides default dashboard widgets
/************************************************************************************/
function disable_default_dashboard_widgets() {
	//remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget
	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         // 
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget
}
add_action( 'admin_menu', 'disable_default_dashboard_widgets' );

/************************************************************************************/
// hides WP version number in RSS
/************************************************************************************/
function sandbox_hide_rss_version() { return ''; }

/************************************************************************************/
// restore display of hidden metaboxes from 3.1
/************************************************************************************
add_filter( 'default_hidden_meta_boxes', 'enable_custom_fields_per_default', 20, 1 );
function enable_custom_fields_per_default( $hidden )
{
    foreach ( $hidden as $i => $metabox )
    {
        if ( 'postexcerpt' == $metabox )
        {
            unset ( $hidden[$i] );
        }
    }
    return $hidden;
}
*/

/************************************************************************************/
// include a custom post type in the feed
/************************************************************************************
function sandbox_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post');
	return $qv;
}
add_filter('request', 'sandbox_request');
*/

/************************************************************************************/
// exclude galleries from generating intermediate image sizes
/************************************************************************************
function sandbox_gallery_stop_intermediate_sizes($sizes) {
	$current_post_type = get_post_type( $_POST['post_id'] );
	if ($current_post_type == 'gallery') { 
		// send the resize function nothing
		$sizes = array();
		return $sizes;
	} else {
		// do whatever happens normally
		return $sizes;
	}
}
add_filter('intermediate_image_sizes_advanced', 'sandbox_gallery_stop_intermediate_sizes');
*/

/************************************************************************************/
// restrict search
/************************************************************************************
function sandbox_restrictSearch($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','sandbox_restrictSearch');
*/

/************************************************************************************/
// remove default user profile fields */
/************************************************************************************
function remove_default_user_meta( $contactmethods ) {
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	return $contactmethods;
}

add_filter('user_contactmethods','remove_default_user_meta', 10, 1);
*/

/************************************************************************************/
// remove recent comment styles
/************************************************************************************/
function sandbox_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'sandbox_remove_recent_comments_style' );

/************************************************************************************/
// remove default meta boxes
/************************************************************************************/
add_action('admin_init','sandbox_hide_unused_admin');

if ( ! function_exists( 'sandbox_hide_unused_admin' ) ) :
function sandbox_hide_unused_admin() {
	remove_meta_box('postcustom','page','normal');
	remove_meta_box('postcustom','post','normal');
	remove_meta_box('postcustom','sample','normal');
}
endif;

/************************************************************************************/
// remove default widgets
/************************************************************************************
add_action( 'widgets_init', 'sandbox_unregister_widgets' );

function sandbox_unregister_widgets() {
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Nav_Menu_Widget' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Text' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
}

/************************************************************************************/
// hide akismet widget
/************************************************************************************/
add_action('admin_print_scripts', 'tc_additional_admin_css');
function tc_additional_admin_css() {
	ob_start();?>
	<style>
		#widget-1_akismet {display:none;}
	</style>
<?php echo $x = ob_get_clean();
}

/************************************************************************************/
// remove default menu panels
/************************************************************************************/
if ( ! function_exists( 'sandbox_remove_menus' ) ) :
function sandbox_remove_menus() {
	global $menu;
	$restricted = array();
	// $restricted = array(__('Posts'), __('Comments'), __('Tools'),__('Themes'));
	end($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(is_array($restricted)) { if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);} }
	}
}
endif;
add_action('admin_menu', 'sandbox_remove_menus');

/************************************************************************************/
// remove inline gallery CSS
/************************************************************************************/
add_filter( 'use_default_gallery_style', '__return_false' );
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}

/************************************************************************************/
// remove specific submenu items
/************************************************************************************/
function remove_submenus() {
	global $submenu;
	//unset($submenu['edit.php'][15]); // Removes 'Categories'
	//unset($submenu['edit.php'][16]); // Removes 'Tags'
}

add_action('admin_menu', 'remove_submenus');

/************************************************************************************/
// hide default taxonomies
/************************************************************************************
function remove_default_taxonomies() {
	remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' );
	remove_meta_box( 'categorydiv', 'post', 'side' );
}

add_action( 'admin_menu' , 'remove_default_taxonomies' );
*/

?>