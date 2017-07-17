jQuery(document).ready(function() {
	jQuery('.colorp').wpColorPicker();


	function maybe_show_captcha_fields() {
		if (jQuery('#enable_captcha').attr('checked')) {
			jQuery('#recaptcha-params').show( 'fast' );
		} else {
			jQuery('#recaptcha-params').hide( 'fast');
		}
	}

	maybe_show_captcha_fields();
	jQuery('#enable_captcha').change(function(){
		maybe_show_captcha_fields();
	});
});