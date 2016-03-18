<?php
/**
 * functions.extend
 *
 * These functions extend or alter default functionality in WordPress.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */

/************************************************************************************/
// allows us to have tinymce on meta boxes
// remember the Visual Editor must be active for this to work
/************************************************************************************/
add_action('admin_print_footer_scripts','sandbox_print_footer_scripts',99);
function sandbox_print_footer_scripts() {
?><script type="text/javascript">/* <![CDATA[ */
	jQuery(function($)
	{
		var i=1;
		$('.customEditor textarea').each(function(e)
		{
			var id = $(this).attr('id');

			if (!id)
			{
				id = 'customEditor-' + i++;
				$(this).attr('id',id);
			}

			tinyMCE.execCommand('mceAddControl', false, id);
			 
		});
	});
/* ]]> */</script><?php
}

/************************************************************************************/
// change the author base to "subscriber"
/************************************************************************************
function sandbox_set_author_base() {
	global $wp_rewrite;
	$author_base = "subscriber";
	$wp_rewrite->init();
	$wp_rewrite->author_base = $author_base;
}
add_action('init', 'sandbox_set_author_base');
*/

/************************************************************************************/
// add query string for a custom URL (this one adds "/bands/" and A - Z
/************************************************************************************
add_filter('rewrite_rules_array','sandbox_insert_rewrite');
add_filter('query_vars','sandbox_insert_query');

// adding a new rule
function sandbox_insert_rewrite($rules) {
	$newrules = array();
	$newrules['(bands)/(.*)$'] = 'index.php?pagename=$matches[1]&alpha=$matches[2]';
	return $newrules + $rules;
}

// adding the id var so that WP recognizes it
function sandbox_insert_query($vars) {
	array_push($vars, 'alpha');
	return $vars;
}
*/

/************************************************************************************
// get attached images
parameters:
$post; ID of the post to get attachments from; this is required
$mime: mime type to get, image by default
$orderby: accepts get_posts orderby values; uses menu_prder then ID by default
$order: ASC by default
$exclude_thumbnail: if true, excludes the featured post thumbnail
/************************************************************************************/
function get_attachments($post, $order = 'ASC', $orderby = 'menu_order ID', $exclude_thumbnail = true) {
	if ($exclude_thumbnail == true) {
		$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type'=> 'attachment', 'order' => $order, 'orderby' => $orderby, 'exclude' => get_post_thumbnail_id($post->ID) ));
	} else {
		$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type'=> 'attachment', 'post_mime_type' => $mime, 'order' => $order, 'orderby' => $orderby ) );
	}
	return $attachments;
}

/************************************************************************************/
// extend body class
/************************************************************************************/
add_filter('body_class','sandbox_research_class');
function sandbox_research_class($classes) {
	if (get_option('sandbox_global_search') == 'research') {
		//$classes[] = 'research';
	}
	return $classes;
}

/************************************************************************************/
// redefine excerpt length
/************************************************************************************/
/*
add_filter('excerpt_length', 'sandbox_excerpt_length');
function sandbox_excerpt_length($length) {
	return 20; 
}
*/

/************************************************************************************/
// add admin styles for login form
/************************************************************************************/
function wp_sandbox_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_url') . '/styles/login.css" />'."\n";
}

add_action('login_head', 'wp_sandbox_login');


/************************************************************************************/
// change login screen url 
/************************************************************************************/
add_filter( 'login_headerurl', 'sandbox_loginlogo_url' );
function sandbox_loginlogo_url($url) {
	return get_bloginfo('url');
}
 
/************************************************************************************/
// enable HTML in taxonomy descriptions
/************************************************************************************/
/*
$filters = array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description');
foreach ( $filters as $filter ) { remove_filter($filter, 'wp_filter_kses'); }
foreach ( array( 'term_description' ) as $filter ) { remove_filter( $filter, 'wp_kses_data' ); }
*/

/************************************************************************************/
// add custom taxonomies to the Right Now Dashboard widget
/************************************************************************************/
add_action( 'right_now_content_table_end' , 'ucc_right_now_content_table_end' );
function ucc_right_now_content_table_end() {
	$args = array(
		'public' => true ,
		'_builtin' => false
	);
	$output = 'object';
	$operator = 'and';
	$post_types = get_post_types( $args , $output , $operator );
	foreach( $post_types as $post_type ) {
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
		if ( current_user_can( 'edit_posts' ) ) {
			$num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
			$text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
		}
	echo '<tr><td class="first b b-' . $post_type->name . '">' . $num . '</td>';
	echo '<td class="t ' . $post_type->name . '">' . $text . '</td></tr>';
}

$taxonomies = get_taxonomies( $args , $output , $operator );

foreach( $taxonomies as $taxonomy ) {
	$num_terms  = wp_count_terms( $taxonomy->name );
	$num = number_format_i18n( $num_terms );
	$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name , intval( $num_terms ) );
	if ( current_user_can( 'manage_categories' ) ) {
		$num = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$num</a>";
		$text = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$text</a>";
	}
	echo '<tr><td class="first b b-' . $taxonomy->name . '">' . $num . '</td>';
	echo '<td class="t ' . $taxonomy->name . '">' . $text . '</td></tr>';
	}
}


/************************************************************************************/
// get all sidebars defined by meta key _sidebars
// this is used only if you're defining custom sidebars per page (see functions.php)
/************************************************************************************/
function get_custom_sidebars(){
	global $wpdb;
	$query = "SELECT * FROM $wpdb->postmeta WHERE meta_key = '_sidebar' GROUP BY meta_value ORDER BY post_id DESC";
	$sidebars = $wpdb->get_results($query, ARRAY_A);
	return $sidebars;
}

/************************************************************************************/
// remove  [...] and replace with "Continue Reading ..." in excerpts
/************************************************************************************/
function sandbox_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . 'Continue reading <span class="meta-nav">&rarr;</span>'. '</a>';
}

function sandbox_auto_excerpt_more( $more ) {
	return ' &hellip;' . sandbox_continue_reading_link();
}
add_filter( 'excerpt_more', 'sandbox_auto_excerpt_more' );

function sandbox_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= sandbox_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'sandbox_custom_excerpt_more' );

/************************************************************************************/
// walk through comment styling
/************************************************************************************/
if ( ! function_exists( 'sandbox_comment' ) ) :
function sandbox_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'sandbox' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sandbox' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'sandbox' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'sandbox' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'sandbox' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'sandbox' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/************************************************************************************/
// add stylesheet to the Dashboard
/************************************************************************************/
add_action('admin_head', 'sandbox_dashboard_css');

function sandbox_dashboard_css() {
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.get_bloginfo( 'template_url' ).'/styles/dashboard.css" />';
}

/************************************************************************************/
// define custom columns for Posts, Samples [example post type], Pages
/************************************************************************************/
/*
add_filter('manage_edit-post_columns', 'add_new_post_columns');
add_filter('manage_edit-sample_columns', 'add_new_sample_columns');
add_filter('manage_edit-page_columns', 'add_new_page_columns');

function add_new_post_columns($post_columns) {
	$new_columns['cb'] = '<input type="checkbox" />';
	$new_columns['title'] = _x('Title', 'column name');
	$new_columns['author'] = __('Author');
	$new_columns['date'] = _x('Date', 'column name');
	$new_columns['id'] = __('ID');
	return $new_columns;
}

function add_new_page_columns($page_columns) {
	$new_columns['cb'] = '<input type="checkbox" />';
	$new_columns['title'] = _x('Title', 'column name');
	$new_columns['author'] = __('Author');
	$new_columns['date'] = _x('Date', 'column name');
	return $new_columns;
}

function add_new_sample_columns($page_columns) {
	$new_columns['cb'] = '<input type="checkbox" />';
	$new_columns['title'] = _x('Title', 'column name');
	$new_columns['genres'] = __('Genres');
	$new_columns['authors'] = __('Authors');
	$new_columns['author'] = __('Author');
	$new_columns['date'] = _x('Date', 'column name');
	$new_columns['id'] = __('ID');
	return $new_columns;
}

add_action('manage_posts_custom_column', 'manage_posts_columns', 10, 2);
/*add_action('manage_posts_custom_column', 'manage_sample_columns', 10, 2); */

/*
function manage_sample_columns($column_name, $id) {
	global $post;
	switch ($column_name) {
	case 'id':
		echo $id;
		break;
	case 'genres':
		$media = get_the_terms( $post->ID, 'genres' );
		if ($media) { 
			$count = 0;
			foreach ($media as $medium) {
				if ($count == count($media)-1) { 
					echo '<a href="edit.php?post_type=books&genres='.$medium->slug.'">'.$medium->name.'</a>'; 
				} else {
					echo '<a href="edit.php?post_type=books&genres='.$medium->slug.'">'.$medium->name.'</a>, '; 
				}
				$count++;
			}
		}
	break;
	case 'authors':
		$media = get_the_terms( $post->ID, 'authors' );
		if ($media) { 
			$count = 0;
			foreach ($media as $medium) {
				if ($count == count($media)-1) { 
					echo '<a href="edit.php?post_type=books&authors='.$medium->slug.'">'.$medium->name.'</a>'; 
				} else {
					echo '<a href="edit.php?post_type=books&authors='.$medium->slug.'">'.$medium->name.'</a>, '; 
				}
				$count++;
			}
		}
	break;
	default:
		break;
	} // end switch
}

function manage_posts_columns($column_name, $id) {
	global $post;
	switch ($column_name) {
	default:
		break;
	} // end switch
}

*/

?>