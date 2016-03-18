<?php
/**
 * options.global
 *
 * This is the settings page for the Theme as a whole.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */

add_action('admin_menu', 'sandbox_options');

function sandbox_options() {
	$icon_path = get_bloginfo('template_url').'/images/icon-plugin.png';
	add_menu_page('Options', 'Options', 'delete_others_pages', __FILE__, 'sandbox_options_settings_page',$icon_path, 115);
	add_action( 'admin_init', 'sandbox_options_settings' );
}

function sandbox_options_settings() {
	register_setting( 'sandbox_options_settings-group', 'sandbox_contact_url' );
	register_setting( 'sandbox_options_settings-group', 'pixel_dev' );
}

function sandbox_options_settings_page() { ?>

<div class="wrap theme-options">

<div class="icon32" id="icon-options-general"><br /></div>

<h2>Theme Options</h2>

<form method="post" class="theme-options-form" action="options.php">
	
		<?php settings_fields( 'sandbox_options_settings-group'); ?>
		<?php settings_fields( 'sandbox_options_settings-group', 'pixel_dev'); ?>
		
		<div class="postbox">
			<h3>Development Mode</h3>
			<div class="inside">
				<div class="option-panel">
					<p>
						<?php $pixel_dev = get_option('pixel_dev'); ?>
						<input <?php if ($pixel_dev == 'on') { echo 'checked="checked"'; } ?> class="checkbox_option" id="pixel_dev" name="pixel_dev" value="<?php echo $pixel_dev; ?>" type="checkbox" /> <label for="pixel_dev"> (Check to use uncompiled JS)</label>
					</p>
				</div>
			</div>
		</div>

		<div class="postbox metabox-holder">
			<h3 class="hndle">Contact Info</h3>
			<div class="inside">
				<div class="option-panel">
					<p><label for="sandbox_contact_url">Enter Email Address</label></p>
					<p>
						<?php $sandbox_contact_url = get_option('sandbox_contact_url'); ?>
						<input id="sandbox_contact_url" name="sandbox_contact_url" value="<?php echo $sandbox_contact_url; ?>" style="width: 90%;" type="text" />
					</p>
				</div>
			</div>
		</div>

<input type="hidden" value="1" />
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
</form>

</div>

<?php } ?>