<?php
/**
 * options.slider
 *
 * This is the settings page for a sample slider, where there can be
 * an infinite number of slides, and the values are also stored in a json file.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */

add_action('admin_menu', 'sandbox_options_slider');

function sandbox_options_slider() {
	$icon_path = get_bloginfo('template_url').'/images/icon-plugin.png';
	add_menu_page('Slider', 'Slider', 'activate_plugins', __FILE__, 'sandbox_options_slider_settings_page',$icon_path, 120);
	add_action( 'admin_init', 'sandbox_options_slider_settings' );
}

function sandbox_options_slider_settings() {
	register_setting( 'sandbox_options_slider_settings-group', 'sandbox_slider_slides' );
	for ($i=1; $i<=get_option('sandbox_slider_slides'); $i++) {
		$value1 = 'sandbox_slider'.$i.'_title';
		$value2 = 'sandbox_slider'.$i.'_image';
		$value3 = 'sandbox_slider'.$i.'_source';
		$value4 = 'sandbox_slider'.$i.'_order';
		register_setting( 'sandbox_options_slider_settings-group',$value1 ); 
		register_setting( 'sandbox_options_slider_settings-group',$value2 ); 
		register_setting( 'sandbox_options_slider_settings-group',$value3 ); 
		register_setting( 'sandbox_options_slider_settings-group',$value4 ); 
	}
}

function sandbox_options_slider_settings_page() { ?>

<div class="wrap theme-options">

<div class="icon32" id="icon-options-general"><br></div>

<h2>Home Slider</h2>

<form method="post" class="theme-options-form" action="options.php">

	<?php
		settings_fields( 'sandbox_options_slider_settings-group');
		
		// if the form is submitted
		if ($_REQUEST['settings-updated'] == true) {
			
			// create an array containing the options in the manual order
			for ($i=1; $i<=get_option('sandbox_slider_slides'); $i++) {
				$data[get_option('sandbox_slider'.$i.'_order')] = array(
					'title'=> get_option('sandbox_slider'.$i.'_title'),
					'image'=> get_option('sandbox_slider'.$i.'_image'),
					'source'=> get_option('sandbox_slider'.$i.'_source'),
				);
			}
			
			// sort the array by key
			ksort($data);
			
			// sort things as objects
			$temp = array();
			foreach ($data as $data_item) {
				$temp_obj = (object)array();
				$temp_obj->slide = $data_item;
				$temp[] = $temp_obj;
			}
			$data = $temp;
			unset($temp);
			
			// create the json response
			$response = $data;

			if (sizeof($response) > 0) {
				// encode and deliver it
				$datapath = $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/sandbox/includes/options/data.json';
				$fp = fopen($datapath, 'w');
				fwrite($fp, stripslashes(json_encode($response)));
				fclose($fp);
				// output a message
				echo '<p style="color: green; font-weight: bold;">The slider has been successfully updated.</p>';
			} else {
				// output an error
				echo '<p style="color: red; font-weight: bold;">There was a problem updating the slider.</p>';
			}
		}
		
	?>

	<div class="postbox metabox-holder">
		<h3 class="hndle">Slides</h3>
		<div class="inside">
			<div class="option-panel">
				<p><label for="sandbox_slider_slides">How many slides should be configurable?</label></p>
				<p>
					<?php $value = get_option('sandbox_slider_slides'); ?>
					<input id="sandbox_slider_slides" name="sandbox_slider_slides" value="<?php echo $value; ?>" style="width: 20%;" type="text" />
				</p>
			</div>
		</div>
	</div>

	<?php for ($i=1; $i<=get_option('sandbox_slider_slides'); $i++) { ?>
	<div class="postbox metabox-holder">
		<h3 class="hndle">Title (Slot <?php echo $i; ?>)</h3>
		<div class="inside">
			<div class="option-panel">
				<p><label for="sandbox_slider<?php echo $i; ?>_title">Enter a title for the slide.</label></p>
				<p>
					<?php 
						$variable = 'sandbox_slider'.$i.'_title';
						$value = get_option($variable); 
					?>
					<input id="sandbox_slider<?php echo $i; ?>_title" name="sandbox_slider<?php echo $i; ?>_title" value="<?php echo $value; ?>" style="width: 90%;" type="text" />
				</p>
			</div>
			<div class="option-panel">
				<p><label for="sandbox_slider<?php echo $i; ?>_image">Upload the image for this slide.</label></p>
				<p>
					<?php 
						$variable = 'sandbox_slider'.$i.'_image';
						$value = get_option($variable); 
					?>
					<input class="custom-media" id="sandbox_slider<?php echo $i; ?>_image" name="sandbox_slider<?php echo $i; ?>_image" value="<?php echo $value; ?>" style="width: 90%; margin-right: 10px;" type="text" />
				</p>
			</div>
			<div class="option-panel">
				<p><label for="sandbox_slider<?php echo $i; ?>_source">Enter the source URL for this slide.</label></p>
				<p>
					<?php 
						$variable = 'sandbox_slider'.$i.'_source';
						$value = get_option($variable); 
					?>
					<input id="sandbox_slider<?php echo $i; ?>_source" name="sandbox_slider<?php echo $i; ?>_source" value="<?php echo $value; ?>" style="width: 90%;" type="text" />
				</p>
			</div>
			<div class="option-panel">
				<p><label for="sandbox_slider<?php echo $i; ?>_order">Enter the order this slide should appear in.</label></p>
				<p>
					<?php 
						$variable = 'sandbox_slider'.$i.'_order';
						$value = get_option($variable); 
					?>
					<input id="sandbox_slider<?php echo $i; ?>_order" name="sandbox_slider<?php echo $i; ?>_order" value="<?php echo $value; ?>" style="width: 90%;" type="text" />
				</p>
			</div>
		</div>
	</div>
	<?php } ?>
	
<input type="hidden" value="1" />
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
</form>

</div>

<?php } ?>