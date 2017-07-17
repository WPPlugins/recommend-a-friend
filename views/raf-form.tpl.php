<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="robots" content="nofollow" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script src="<?php echo RAF_URL; ?>js/raf_form.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>

		<?php
		$css_directory_url = RAF_URL . "css";
		if ( file_exists( get_stylesheet_directory() . "/raf-styles.css" ) ) {
			 $css_directory_url = get_stylesheet_directory_uri();
		}
		elseif ( file_exists( get_template_directory() . "/raf-styles.css" ) ) {
			$css_directory_url = get_template_directory_uri();
		}
		?>
		<link rel='stylesheet' href='<?php echo $css_directory_url; ?>/raf-styles.css' type='text/css' media='all' />

		<style type="text/css" media="all">

			#raf_global {
				border-color: #<?php echo str_replace( '#', '', $border_color ); ?>;
				background: #<?php echo str_replace( '#', '', $bg_color ); ?>;
			}
			#raf_global legend, #raf_global h1 {
				color:#<?php echo str_replace( '#', '', $legend_color ); ?>;
			}
			#raf_global submit-btn, #raf_global .thButton, .submit-btn, .thButton {
				color: #<?php echo str_replace( '#', '', $button_text_color ); ?>;
			}
			#raf_global .submit-btn, #raf_global .thButton {
				background-color: #<?php echo str_replace( '#', '', $button_color ); ?>;
			}
			#raf_global .submit-btn:hover, #raf_global .thButton:hover {
				background-color: #<?php echo str_replace( '#', '', $bg_color_hover ); ?>;
			}
			#raf_global .g-recaptcha {
				margin: 20px 0;
			}
		</style>
	</head>

	<body>
		<div id="raf_global">
			<h1><?php esc_html_e( 'Recommend this page to a friend !' , 'raf'); ?></h1>
			<?php if ( isset( $error_message ) && count( $error_message ) > 0 ) : ?>
				<table cellspacing='0' cellpadding='0' style='border:1px solid red;' align='center'>
					<tr>
						<td valign='middle' style='padding:3px' valign='middle'>
							<img src="<?php echo RAF_URL . 'images/ers.gif'; ?>" />
						</td>
						<td valign='middle' style='color:red;padding:5px;'>
							<?php foreach ( $error_message as $key => $error ) :
								echo "{$error}<br >";
							endforeach; ?>
						</td>
					</tr>
				</table><br >
			<?php elseif ( isset( $_GET['raf_message'] ) && 'success' === $_GET['raf_message'] ) : ?>
				<table border='0' cellspacing='0' cellpadding='10' style='border:1px solid #5897FE;' align='center'>
					<tr>
						<td valign='middle' valign='middle'>
							<img src="<?php echo RAF_URL . 'images/oks.gif'; ?>" />
						</td>
						<td valign='middle' style='color:#5897FE;padding:5px;'>
							<?php esc_html_e( 'Your message has been sent', 'raf' ); ?>
						</td>
					</tr>
				</table>
			<?php endif; ?>

			<form action="" method="post">
				<fieldset>
					<legend><?php _e( 'Customize your message' , 'raf'); ?></legend>
					<textarea name="private_message" cols="69" rows="6" id="private_message"><?php echo esc_textarea( $textarea_value ) ; ?></textarea>
				</fieldset>

				<?php if ( $manual_feature == true ) : ?>
					<fieldset>
						<legend><?php _e( 'Please insert here the email addresses separated by commas' , 'raf'); ?></legend>
						<input class="field" type="text" name="raf_email_addresses" size="70" value="<?php echo ( isset( $email_default_value ) && !empty( $email_default_value ) ) ? $email_default_value : "" ;?>" />

							<?php if ( is_user_logged_in() ) : ?>
								<input type="hidden" name="raf_name_from" size="70" value="<?php echo ( isset( $name_from ) && !empty( $name_from ) ) ? $name_from : "" ; ?>" />
							<?php else : ?>
								<legend><?php _e( 'Your name' , 'raf'); ?></legend>
								<input class="field" type="text" name="raf_name_from" size="70" value="<?php echo ( isset( $name_from ) && !empty( $name_from ) ) ? $name_from : "" ; ?>" />
							<?php endif; ?>
						<?php if ( $enable_captcha === true && ! empty( $captcha_site_key ) && ! empty( $captcha_secret_key ) ) : ?>
							<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $captcha_site_key ); ?>"></div>
						<?php endif; ?>

						<input type="hidden" name="raf_manual_invit" size="100" value="1" />
						<input name="" class="submit-btn" type="submit" value="<?php _e( 'Send' , 'raf'); ?>" />
					</fieldset>
				<?php endif; ?>

				<?php if ( $social_feature == true ) : ?>
				<fieldset>
					<legend><?php _e( 'You can recommend using: ' , 'raf'); ?></legend>
					<ul>
						<li>
							<a id="raf-facebook" href="http://www.facebook.com/share.php?u=<?php echo $current_url; ?>" target="_blank">Facebook</a>
						</li>
						<li>
							<a id="raf-twitter" href="http://twitter.com/home?status=<?php echo $current_url; ?>" target="_blank">Twitter</a>
						</li>
					</ul>
				</fieldset>
				<?php endif; ?>
			</form>
		</div>
	</body>
</html>
