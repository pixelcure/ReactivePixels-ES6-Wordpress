<?php
/**
 * type.post
 *
 * This allows us to add metaboxes to Posts.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
 /************************************************************************************/
// define meta boxes
/************************************************************************************/
$po_boxes = array (
	'Details' => array (
		array( '_post_textfield', 'Text Field', 'Here is an example of an input box.'),
		array( '_post_textarea', 'Text Area', 'This an example of a raw textarea.','textarea'),
		array( '_post_checkbox', 'Checkbox', 'This an example of a raw textarea.','checkbox'),
		array( '_post_image', 'Image', 'This an example of a file upload field.','file'),
		array( '_post_ve', 'Visual Editor', 'This an example of a visual editor.','tinymce'),
		array( '_sidebar', 'Custom Sidebar', 'If you would like to be able a custom sidebar for this page or post, enter a name for the sidebar here. You will then be able to assign widgets to it under Appearance -> Widgets.')
	),
	'Sample Info' => array (
		array( '_post_textfield2', 'Text Field', 'This is hidden if you choose the sample template.')
	)
);

add_action( 'add_meta_boxes', 'po_add_custom_box' );
add_action( 'save_post', 'po_save_postdata', 1, 2 );

/************************************************************************************/
// generate meta boxes
/************************************************************************************/
function po_add_custom_box() {
	global $po_boxes;
	global $post;
	if ( function_exists( 'add_meta_box' )) {
		ksort($po_boxes);
		foreach ( $po_boxes as $i => $po_box_content ) {
			add_meta_box( strtolower(str_replace(' ', '',$i)), __( $i, 'po' ), 'po_post_custom_box', 'post', 'normal', 'high', $po_box_content[0]);
		}
	}
}

/************************************************************************************/
// save meta boxes
/************************************************************************************/
function po_post_custom_box ( $obj, $box ) {
	global $po_boxes;
	static $po_nonce_flag = false;
	if ( ! $po_nonce_flag ) {
		echo_po_nonce();
		$po_nonce_flag = true;
	}
	foreach ( $po_boxes[$box['title']] as $po_box ) {
		if(is_array($po_box)){
			echo field_html( $po_box );
		}
	}
}

function po_save_postdata($post_id, $post) {
	global $po_boxes;
	if ( ! wp_verify_nonce( $_POST['po_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
	} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
	}
	foreach ( $po_boxes as $po_box ) {
		foreach ( $po_box as $po_fields ) {
			$po_my_data[$po_fields[0]] =  $_POST[$po_fields[0]];
		}
	}
	foreach ($po_my_data as $key => $value) {
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

function echo_po_nonce () {
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'po_nonce_name',
		wp_create_nonce( plugin_basename(__FILE__) )
	);
}

if ( !function_exists('get_custom_field') ) {
	function get_custom_field($field) {
		global $post;
		$custom_field = get_post_meta($post->ID, $field, true);
		echo $custom_field;
	}
}

// add_action( 'init', 'beaker_posttype' );
// function beaker_posttype() {
// 	register_post_type( 'home_beaker',
// 		array(
// 			'labels' => array(
// 				'name' => __( 'Beakers' ),
// 				'singular_name' => __( 'Beaker' )
// 			),
// 			'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 
// 			),
// 			'public' => true,
// 			'has_archive' => true,
// 			'rewrite' => array('slug' => 'beakers'),
// 		)
// 	);
// }

?>