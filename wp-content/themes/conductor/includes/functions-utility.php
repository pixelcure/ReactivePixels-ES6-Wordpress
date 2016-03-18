<?php 
/**
 * functions.utility
 *
 * These are new helper functions that extend the functionality of the theme.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */

/************************************************************************************/
// truncates text to a specific character limit
/************************************************************************************/
function truncate($text, $limit, $break) {
	// specify number of characters to shorten by
	$size = strlen($text);
	if ($size > $limit) {
		$text = $text." ";
		$text = substr($text,0,$limit);
		$text = substr($text,0,strrpos($text,' '));
		$text = $text.$break;
	}
	return $text;
}

/************************************************************************************/
// case insensitive, partial keyword array search
/************************************************************************************/
function insensitive_array_search($needle = null, $haystack_array = null, $skip = 0) {
	$needle = htmlspecialchars( strip_tags( trim( strtolower($needle) ) ) );
	$haystack_array = array_map('strtolower',$haystack_array);
	if($needle == null || $haystack_array == null)
		die('$needle and $haystack_array are mandatory for functie my_array_search()');
	foreach($haystack_array as $key => $eval) {
		if($skip != 0)$eval = substr($eval, $skip);
		if(stristr($eval, $needle) !== false) return true;
	}
	return false;
}

/**********************************************************************/
// determine which sidebar to use
// this is useful when we have child/parent inheritable sidebars
/**********************************************************************/
function determine_sidebar($default_sidebar) {
	global $post;
	if ($post->ancestors) {
		// get the parent of this page
		$ancestor = end($post->ancestors);
	} else {
		$ancestor = 0;
	}
	// if this page is the toppmost parent 
	if ($ancestor == 0) {
		// we'll use its ID
		$ancestor = $post->ID;
		// get this page's sidebar value
		if (get_post_meta($post->ID, '_sidebar', true)) {
			$sidebar = get_post_meta($post->ID, '_sidebar', true);
		} else {
			// let's use the default sidebar for this template
			$sidebar = $default_sidebar;
		}
	// okay, it's some subpage
	} else {
		// if this child has its own sidebar assigned, use that
		if (get_post_meta($post->ID, '_sidebar', true)) {
			$sidebar = get_post_meta($post->ID, '_sidebar', true);
		} else { 
			// otherwise we need to first see if this page's parent has a sidebar
			$post_parent = get_post($post->post_parent, 'OBJECT'); 
			$post_ancestor = get_post($ancestor, 'OBJECT'); 
			if (get_post_meta($post_parent->ID,'_sidebar', true)) {
				$sidebar = get_post_meta($post_parent->ID,'_sidebar', true);
				// okay, well does the ancestor have a custom sidebar?
			} elseif (get_post_meta($post_ancestor->ID,'_sidebar', true)) {
				$sidebar = get_post_meta($post_ancestor->ID,'_sidebar', true);
			} else {
				// let's use the one assigned to the ancestor
				$sidebar = $default_sidebar;
			}
		}
	}
	return $sidebar;
}

/**********************************************************************/
// sample shortcode
/**********************************************************************/
function sandbox_blockquote_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 'alignment' => 'right', 'source' => '', 'quote' => '' ), $atts ) );
	return '<blockquote class="'.$alignment.'"><p>'.$quote.'</p><p><cite>'.$source.'</cite></p></blockquote>';
}
add_shortcode( 'blockquote', 'sandbox_blockquote_shortcode' );

/**********************************************************************/
// transforms unordered list into a multidimensional array
/**********************************************************************/
function parse_html_into_array($ul_string){
	$return = array();
	$xml = new SimpleXMLElement($ul_string);
	$return = parse_ul_into_array($xml);
	return $return;
}

function parse_ul_into_array($xml){
	$return = array();
	foreach($xml as $key=>$node){
		if('ul'==$key || 'li'==$key){
			if($text = trim((string)$node)){
				$return['text']=$text;
			}
			$return[$key][]=parse_ul_into_array($node);
		} else {
			$return['text']=$node->asXML();
		}
	}
	return $return;
}

/************************************************************************************/
// get the except by ID
/************************************************************************************/
function get_the_excerpt_by_id($object) {
	if ($object->post_type == 'snippets') {
		return $object->post_content;
	} else {
		if ($object->post_excerpt) {
			return $object->post_excerpt;
		} else {
			$output = $object->post_content;
			$output = apply_filters('the_content', $output);
			$output = str_replace('\]\]\>', ']]&gt;', $output);
			$output = strip_tags($output);
			$excerpt_length = 55;
			$words = explode(' ', $output, $excerpt_length + 1);
			if (count($words)> $excerpt_length) {
				array_pop($words);
				array_push($words, '');
				$output = implode(' ', $words);
			}
			return $output;
		}
	}
}

/************************************************************************************/
// allows backend resizing of an image delivered by the custom media plugin
// on the fly, and saves the image as a new custom crop size)
/************************************************************************************/
function wp_fly_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

	/****************************************
	by attachment
	****************************************/
	if ( $attach_id ) {
	
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		$file_path = get_attached_file( $attach_id );
	
	/****************************************
	by url
	****************************************/
	} else if ( $img_url ) {

		$file_path = parse_url( $img_url );
		$file_path = $file_path['path'];
		
		$file_path = rtrim( $_SERVER['DOCUMENT_ROOT'], '/' ).$file_path;
		
		if ($data = @getimagesize($file_path)) {
			$orig_size = getimagesize( $file_path );
		} else {
			return '';
		}
		
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
	}
	
	/****************************************
	get image extension
	****************************************/
	$file_info = pathinfo( $file_path );
	$extension = '.'. $file_info['extension'];

	/****************************************
	image path w/o extension
	****************************************/
	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

	/****************************************
	full image path
	****************************************/
	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;
	
	/****************************************
	if the image is bigger than the crop size
	****************************************/
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		/****************************************
		IMAGE ALREADY EXISTS
		the cropped image already exists
		don't do any resizing, just return the existing cropped size
		****************************************/
		if ( file_exists( $cropped_img_path ) ) {

			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );

			$vt_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);

			return $vt_image;
		}

		/****************************************
		IMAGE DOESN'T EXIST, BUT CROP IS FALSE
		****************************************/
		if ( $crop == false ) {
		
			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

			if ( file_exists( $resized_img_path ) ) {
			
				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

				$vt_image = array (
					'url' => $resized_img_url,
					'width' => $new_img_size[0],
					'height' => $new_img_size[1]
				);

				return $vt_image;
			}
		}

		/****************************************
		DO THE RESIZING
		****************************************/
		$new_img_path = image_resize( $file_path, $width, $height, $crop );
		// suppress the error if for some reason we failed to resize
		if ($data = @getimagesize($new_img_path)) {
			$new_img_size = getimagesize( $new_img_path );
		} else {
			// in the case of failure, we return nothing
			return '';
		}
		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

		// resized output
		$vt_image = array (
			'url' => $new_img,
			'width' => $new_img_size[0],
			'height' => $new_img_size[1]
		);

		return $vt_image;
	}

	/****************************************
	else, return the original image
	****************************************/
	$vt_image = array (
		'url' => $image_src[0],
		'width' => $image_src[1],
		'height' => $image_src[2]
	);
	return $vt_image;
}

/**********************************************************************/
// this builds the error messages for the contact form
/**********************************************************************/
function died($error, $message) {
	global $failed;
	global $message;
	$failed = true;
	$message .= "<li>".$error."</li>";
}

/**********************************************************************/
// this makes a string safe for email
/**********************************************************************/
function clean_string($string) {
	$bad = array("content-type","bcc:","to:","cc:","href");
	return str_replace($bad,"",$string);
}

/**********************************************************************/
// determines if the given page is a child of the given page
/**********************************************************************/
function is_child_of($topid, $thispageid = null){
	global $post;
	
	if($thispageid == null)
		$thispageid = $post->ID; # no id set so get the post object's id.
		
	$current = get_page($thispageid);
	
	if($current->post_parent != 0) # so there is a parent
	{
		if($current->post_parent != $topid)
			return is_child_of($topid, $current->post_parent); # not that page, run again
		else
			return true; # are so it is	
	}
	else
	{
		return false; # no parent page so return false
	}	
}

/************************************************************************************/
// turns a date into a friendly date
/************************************************************************************/
function time_since($older_date, $newer_date = false)
	{
	// array of time period chunks
	$chunks = array(
	array(60 * 60 * 24 * 365 , 'year'),
	array(60 * 60 * 24 * 30 , 'month'),
	array(60 * 60 * 24 * 7, 'week'),
	array(60 * 60 * 24 , 'day'),
	array(60 * 60 , 'hour'),
	array(60 , 'minute'),
	);
	
	// $newer_date will equal false if we want to know the time elapsed between a date and the current time
	// $newer_date will have a value if we want to work out time elapsed between two known dates
	$newer_date = ($newer_date == false) ? (time()+(60*60*get_settings("gmt_offset"))) : $newer_date;
	
	// difference in seconds
	$since = $newer_date - $older_date;
	
	// we only want to output two chunks of time here, eg:
	// x years, xx months
	// x days, xx hours
	// so there's only two bits of calculation below:

	// step one: the first chunk
	for ($i = 0, $j = count($chunks); $i < $j; $i++)
		{
		$seconds = $chunks[$i][0];
		$name = $chunks[$i][1];

		// finding the biggest chunk (if the chunk fits, break)
		if (($count = floor($since / $seconds)) != 0)
			{
			break;
			}
		}

	// set output var
	$output = ($count == 1) ? '1 '.$name : "$count {$name}s";

	// step two: the second chunk
	if ($i + 1 < $j)
		{
		$seconds2 = $chunks[$i + 1][0];
		$name2 = $chunks[$i + 1][1];
		
		if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0)
			{
			// add to output var
			$output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
			}
		}
	
	return $output;
	}

/************************************************************************************/
// chunk an array into # of evenly distributed columns
/************************************************************************************/
function array_chunk_fixed($input, $num, $preserve_keys = FALSE) {
	$count = count($input) ;
	if($count)
		$input = array_chunk($input, ceil($count/$num), $preserve_keys) ;
	$input = array_pad($input, $num, array()) ;
	return $input ;
}

?>