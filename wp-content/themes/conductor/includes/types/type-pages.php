<?php
/**
 * type.page
 *
 * This allows us to add metaboxes to Pages.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
 /************************************************************************************/
// define meta boxes
/************************************************************************************/
$pa_boxes = array (
	'Details' => array (
		array( '_page_textfield', 'Text Field', 'Here is an example of an input box.'),
		array( '_page_textarea', 'Text Area', 'This an example of a raw textarea.','textarea'),
		array( '_page_checkbox', 'Checkbox', 'This an example of a raw textarea.','checkbox'),
		array( '_page_image', 'Image', 'This an example of a file upload field.','file'),
		array( '_page_ve', 'Visual Editor', 'This an example of a visual editor.','tinymce'),
		array( '_sidebar', 'Custom Right Sidebar', 'If you would like to be able to add a custom right sidebar for this page or post, enter a name for the sidebar here. You will then be able to assign widgets to it under Appearance -> Widgets.'),
	),
	'Sample Info' => array (
		array( '_page_textfield2', 'Text Field', 'This is hidden if you choose the sample template.')
	)
);

add_action( 'add_meta_boxes', 'pa_add_custom_box' );
add_action( 'save_post', 'pa_save_postdata', 1, 2 );

/************************************************************************************/
// generate meta boxes
/************************************************************************************/
function pa_add_custom_box() {
	global $pa_boxes;
	global $post;
	if ( function_exists( 'add_meta_box' )) {
		ksort($pa_boxes);
		foreach ( $pa_boxes as $i => $pa_box_content ) {
			add_meta_box( strtolower(str_replace(' ', '',$i)), __( $i, 'pa' ), 'pa_post_custom_box', 'page', 'normal', 'high', $pa_box_content[0]);
		}
		/************************************************************************************/
		// display meta boxes conditionally by template
		/************************************************************************************/
		// we have to extract just the template name, since this returns a path to the template
		$current_template = get_post_meta( $_GET['post'], '_wp_page_template', true );
		$current_template = pathinfo($current_template);
		$current_template = $current_template['filename'];
		// remove metaboxes if we're on a certain template
		if ($current_template == 'sample') {
			// note that the metaboxes are ID'd lowercase without spaces
			remove_meta_box('sampleinfo','page','normal');
		}
	}
}

/************************************************************************************/
// save meta boxes
/************************************************************************************/
function pa_post_custom_box ( $obj, $box ) {
	global $pa_boxes;
	static $pa_nonce_flag = false;
	if ( ! $pa_nonce_flag ) {
		echo_pa_nonce();
		$pa_nonce_flag = true;
	}
	foreach ( $pa_boxes[$box['title']] as $pa_box ) {
		if(is_array($pa_box)){
			echo field_html( $pa_box );
		}
	}
}

function pa_save_postdata($post_id, $post) {
	global $pa_boxes;
	if ( ! wp_verify_nonce( $_POST['pa_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
	} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
	}
	foreach ( $pa_boxes as $pa_box ) {
		foreach ( $pa_box as $pa_fields ) {
			$pa_my_data[$pa_fields[0]] =  $_POST[$pa_fields[0]];
		}
	}
	foreach ($pa_my_data as $key => $value) {
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

function echo_pa_nonce () {
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'pa_nonce_name',
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
?>