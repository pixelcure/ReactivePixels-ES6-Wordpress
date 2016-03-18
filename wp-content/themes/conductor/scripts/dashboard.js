// this method requires a hidden field that tracks the off state of the checkbox
// so that the custom field functions like a switch
jQuery(document).ready(
	function(){
		jQuery(".checkbox_option").change(function(){
		if(jQuery(this).attr("checked")){
			jQuery(this).val("on");
			jQuery(this).next().val("on");
		} else {
			jQuery(this).val("off");
			jQuery(this).next().val("off");
		}
	});
});