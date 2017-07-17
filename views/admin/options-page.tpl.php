<div class="wrap" id="raf_options">
	<h2><?php esc_html_e( 'Recommend to a friend', 'raf' ); ?></h2>
	
	<form method="post" action="">
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Email shipper ( ex: contact@mysite.com)', 'raf' ); ?></th>
				<td><input type="text" name="raf[email_shipper]" value="<?php echo isset(  $fields['email_shipper'] ) && is_email( $fields['email_shipper'] ) ? esc_attr( $fields['email_shipper'] ) : ''; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Enabled features', 'raf' ); ?></th>
				<td>
					<input type="checkbox" name="raf[manual]" value="1" <?php checked( isset( $fields['manual'] ) ? (int) $fields['manual'] : '' , 1 ); ?> /> <?php esc_html_e( 'Insert emails mannualy', 'raf' ); ?><br />
					<input type="checkbox" name="raf[social]" value="1" <?php checked( isset( $fields['social'] ) ? (int) $fields['social'] : '' , 1 ); ?> /> <?php esc_html_e( 'Share on social networks', 'raf' ); ?><br />
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Google reCaptcha', 'raf' ); ?></th>
				<td>
					<input type="checkbox" id="enable_captcha" name="raf[enable_captcha]" value="1" <?php checked( isset( $fields['enable_captcha'] ) ? (int) $fields['enable_captcha'] : '' , 1 ); ?> /> <label for="enable_captcha"><?php esc_html_e( 'Enable Google reCaptcha', 'raf' ); ?></label><br />
					<div id="recaptcha-params">
						<label for="captcha_site_key"><?php esc_html_e( 'reCaptcha site key', 'raf' ); ?></label><br />
						<input type="text" name="raf[captcha_site_key]" value="<?php echo isset(  $fields['captcha_site_key'] ) ? esc_attr( $fields['captcha_site_key'] ) : ''; ?>" /><br />

						<label for="captcha_secret_key"><?php esc_html_e( 'reCaptcha secret key', 'raf' ); ?></label><br />
						<input type="text" name="raf[captcha_secret_key]" value="<?php echo isset(  $fields['captcha_secret_key'] ) ? esc_attr( $fields['captcha_secret_key'] ) : ''; ?>" />
					</div>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Auto add RAF button after the_content', 'raf' ); ?></th>
				<td><input type="checkbox" name="raf[auto_add]" value="1" <?php checked( isset( $fields['auto_add'] ) ? (int) $fields['auto_add'] : '' , 1 ); ?> /> <?php esc_html_e( 'Check to auto add RAF after the_content', 'raf' ); ?></td>
			</tr> 
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Background color', 'raf' ); ?></th>
				<td><input type="text" class="colorp" name="raf[bg_color]" value="<?php echo isset(  $fields['bg_color'] ) ? esc_attr( $fields['bg_color'] ) : ''; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Titles color', 'raf' ); ?></th>
				<td><input type="text" class="colorp" name="raf[titles_color]" value="<?php echo isset(  $fields['titles_color'] ) ? esc_attr( $fields['titles_color'] ) : ''; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Buttons background color', 'raf' ); ?></th>
				<td><input type="text" class="colorp" name="raf[button_bg_color]" value="<?php echo isset(  $fields['button_bg_color'] ) ? esc_attr( $fields['button_bg_color'] ) : ''; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Buttons background color hover', 'raf' ); ?></th>
				<td><input type="text" class="colorp" name="raf[button_bg_color_hover]" value="<?php echo isset(  $fields['button_bg_color_hover'] ) ? esc_attr( $fields['button_bg_color_hover'] ) : ''; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Buttons text color', 'raf' ); ?></th>
				<td><input type="text" class="colorp" name="raf[button_text_color]" value="<?php echo isset(  $fields['button_text_color'] ) ? esc_attr( $fields['button_text_color'] ) : ''; ?>" /></td>
			</tr>
			
		</table>
		
		<p class="submit">
			<?php wp_nonce_field( 'raf-update-options' ); ?>
			<input type="submit" name="save" class="button-primary" value="<?php esc_html_e( 'Save Changes', 'raf' ) ?>" />
		</p>
	</form>
</div>
