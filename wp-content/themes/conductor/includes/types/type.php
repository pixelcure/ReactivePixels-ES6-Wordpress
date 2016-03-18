<?php
/**
 * type.samples
 *
 * This allows us to add metaboxes to Samples post type.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */

/************************************************************************************/
// define metaboxes
/************************************************************************************/
global $sa_boxes;
$sa_boxes = array (
	'Details' => array (
		array( '_sample_textfield', 'Text Field', 'Here is an example of an input box.'),
		array( '_sample_textarea', 'Text Area', 'This an example of a raw textarea.','textarea'),
		array( '_sample_checkbox', 'Checkbox', 'This an example of a raw textarea.','checkbox'),
		array( '_sample_image', 'Image', 'This an example of a file upload field.','file'),
		array( '_sample_ve', 'Visual Editor', 'This an example of a visual editor.','tinymce'),
		array( '_sidebar', 'Custom Sidebar', 'If you would like to be able a custom sidebar for this page or post, enter a name for the sidebar here. You will then be able to assign widgets to it under Appearance -> Widgets.')
	),
	'Sample Info' => array (
		array( '_sample_textfield2', 'Text Field', 'This is hidden if you choose the sample template.')
	)
);

function sandbox_set_post_types() {
	$postTypes = array();
	$postTypes['samples'] = array(
		'parameters' => array(
			'labels' => array(
				'name' => 'Samples',
				'singular_name' => 'sample',
				'add_new' => 'Add New Sample',
				'add_new_item' => 'Add New Sample',
				'edit_item' => 'Edit Sample',
				'new_item' => 'New Sample',
				'view_item' => 'View Sample',
				'search_items' => 'Search Sample',
				'not_found' =>  'No Samples found',
				'not_found_in_trash' => 'No samples found in Trash',
				'parent_item_colon' => ''
			),
			'description' => 'Posts for all samples.',
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'media_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'register_meta_box_cb' => 'init_metaboxes_samples',
			'supports' => array (
				'title',
				'editor',
				'author',
				'thumbnail',
				'comments',
				'excerpt',
				'revisions'
			)
		),
		'metaboxes' => array (
			'Details' => array (
				array( '_sample_textfield', 'Text Field', 'Here is an example of an input box.'),
				array( '_sample_textarea', 'Text Area', 'This an example of a raw textarea.','textarea'),
				array( '_sample_checkbox', 'Checkbox', 'This an example of a raw textarea.','checkbox'),
				array( '_sample_image', 'Image', 'This an example of a file upload field.','file'),
				array( '_sample_ve', 'Visual Editor', 'This an example of a visual editor.','tinymce'),
				array( '_sidebar', 'Custom Sidebar', 'If you would like to be able a custom sidebar for this page or post, enter a name for the sidebar here. You will then be able to assign widgets to it under Appearance -> Widgets.')
			),
			'Sample Info' => array (
				array( '_sample_textfield2', 'Text Field', 'This is hidden if you choose the sample template.')
			)
		)
	);

	foreach ($postTypes as $i=>$postType)
		register_post_type($postType[$i], $postType[$i]['parameters']);
	}
}

/************************************************************************************/
// register samples post type
/************************************************************************************/
 function post_type_samples() {

	$labels = array(
		'name' => _x('Samples', 'samples'),
		'singular_name' => _x('Sample', 'Sample'),
		'add_new' => _x('Add New', 'sample'),
		'add_new_item' => __('Add New Sample'),
		'edit_item' => __('Edit Sample'),
		'new_item' => __('New Sample'),
		'view_item' => __('View Sample'),
		'search_items' => __('Search Sample'),
		'not_found' =>  __('No Samples found'),
		'not_found_in_trash' => __('No samples found in Trash'),
		'parent_item_colon' => ''
	);

	register_post_type(
		'samples',
		array(
			'labels' => $labels,
			'description' => __('Posts for all samples.'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'media_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'register_meta_box_cb' => 'init_metaboxes_samples',
			'supports' => array (
				'title',
				'editor',
				'author',
				'thumbnail',
				'comments',
				'excerpt',
				'revisions'
			)
		)
	);

	/************************************************************************************/
	// register genres taxonomy (hierarchical)
	/************************************************************************************/
	// genres taxonomy
	$genre_labels = array(
		'name' => _x( 'Genre', 'Genre' ),
		'singular_name' => _x( 'Genre', 'Genre' ),
		'search_items' =>  __( 'Search Genres' ),
		'popular_items' => __( 'Popular Genres' ),
		'all_items' => __( 'All Genres' ),
		'parent_item' => __( 'Parent Genre' ),
		'parent_item_colon' => __( 'Parent Genre:' ),
		'edit_item' => __( 'Edit Genre' ),
		'update_item' => __( 'Update Genre' ),
		'add_new_item' => __( 'Add New Genre' ),
		'new_item_name' => __( 'New Genre' ),
		'separate_items_with_commas' => null,
		'add_or_remove_items' => __( 'Add or remove genre' ),
		'choose_from_most_used' => null
	);
	register_taxonomy( 'genres', 'samples', array ( 'hierarchical' => true, 'labels' => $genre_labels, 'query_var' => 'genres' ) );

	/************************************************************************************/
	// register authors taxonomy (tags)
	/************************************************************************************/
	// authors labels taxonomy
	$author_labels = array(
		'name' => _x( 'Authors', 'Authors' ),
		'singular_name' => _x( 'Author', 'Author' ),
		'search_items' =>  __( 'Search Authors' ),
		'popular_items' => __( 'Popular Authors' ),
		'all_items' => __( 'All Authors' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Author' ),
		'update_item' => __( 'Update Author' ),
		'add_new_item' => __( 'Add New Author' ),
		'new_item_name' => __( 'New Author' ),
		'separate_items_with_commas' => __( 'Separate authors with commas' ),
		'add_or_remove_items' => __( 'Add or remove authors' ),
		'choose_from_most_used' => __( 'Choose from the most used authors' )
	);
	register_taxonomy( 'authors', 'samples', array ( 'hierarchical' => false, 'labels' => $author_labels, 'query_var' => 'authors' ) );


}

/************************************************************************************/
// generate metaboxes
/************************************************************************************/
if ( ! function_exists( 'init_metaboxes_samples' ) ) :
function init_metaboxes_samples($args) {
	global $sa_boxes;
	global $post;
	if ( function_exists( 'add_meta_box' ) ) {
		ksort($sa_boxes);
		foreach ( $sa_boxes as $i => $sa_box_content ) {
			add_meta_box( strtolower(str_replace(' ', '',$i)), __( $i, 'sa' ), 'sa_post_custom_box', 'samples', 'normal', 'high', $sa_box_content[0]);
		}

	}
	/************************************************************************************/
	// display meta boxes conditionally by template
	/************************************************************************************/
	// remove metaboxes if we're on a certain template
	// $this_id = $_GET['post'];
	// $this_post = get_post($this_id);
	// $this_post_parent = $this_post->post_parent;
	// if ($this_post_parent) {
	//      remove_meta_box('attachments','insights','normal');
	//      remove_meta_box('images','insights','normal');
	//      remove_meta_box('tiledisplay','insights','normal');
	//      remove_meta_box('postexcerpt','insights','normal');
	//      remove_meta_box('postimagediv','insights','side');
	//      remove_meta_box('clients-and-insightsdiv','insights','side');
	//}
	//Or the dirty way...
	//echo '<style>#postdivrich{display:none;}</style>';
}
endif;

/************************************************************************************/
// save metaboxes
/************************************************************************************/
if ( ! function_exists( 'sa_post_custom_box' ) ) :
function sa_post_custom_box ($obj, $box) {
	global $sa_boxes;
	global $post;
	static $sa_nonce_flag = false;
	if ( ! $sa_nonce_flag ) {
		sa_echo_sp_nonce();
		$sa_nonce_flag = true;
	}
	foreach ( $sa_boxes[$box['title']] as $sa_box ) {
		if(is_array($sa_box)){
			echo field_html( $sa_box );
		}
	}
}
endif;

if ( ! function_exists( 'sa_save_postdata' ) ) :
function sa_save_postdata($post_id, $post) {
	global $sa_boxes;
	if ( ! wp_verify_nonce( $_POST['sa_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
		} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
		}
		foreach ( $sa_boxes as $sa_box ) {
			foreach ( $sa_box as $sa_fields ) {
				$sa_my_data[$sa_fields[0]] =  $_POST[$sa_fields[0]];
			}
		}
		foreach ($sa_my_data as $key => $value) {
			if ( 'revision' == $post->post_type  ) {
				return;
			}
			$value = implode(',', (array)$value);
			if ( get_post_meta($post->ID, $key, FALSE) ) {
				update_post_meta($post->ID, $key, $value);
			} else {
				add_post_meta($post->ID, $key, $value);
		}
		if (!$value) {
			delete_post_meta($post->ID, $key);
		}
	}
}
endif;

if ( ! function_exists( 'sa_echo_sp_nonce' ) ) :
function sa_echo_sp_nonce () {
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'sa_nonce_name',
		wp_create_nonce( plugin_basename(__FILE__) )
	);
}
endif;

if ( ! function_exists( 'sa_get_custom_field' ) ) :
if ( !function_exists('sa_get_custom_field') ) {
	function sa_get_custom_field($field) {
		global $post;
		$custom_field = get_post_meta($post->ID, $field, true);
		echo $custom_field;
	}
}
endif;

// init sequences
add_action('init', 'sandbox_set_post_types');
add_action( 'save_post', 'sa_save_postdata', 1, 2 );
?>