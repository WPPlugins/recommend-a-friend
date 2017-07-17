<?php
class RAF_Client {
	/**
	 * Constructor
	 *
	 * @return void
	 * @author Benjamin Niess
	 */
	function __construct() {
		add_action( 'init', array( __CLASS__, 'init_styles_scripts' ) );
		add_filter( 'the_content', array( __CLASS__, 'auto_add_button' ) );
		add_shortcode( 'raf_link', array( __CLASS__, 'shortcode_recommend_a_friend_link' ) );
		add_action( 'template_redirect', array( __CLASS__, 'load_popin' ) );
	}

	/**
	 * Enqueue all scripts and styles
	 *
	 * @author Benjamin Niess
	 */
	public static function init_styles_scripts() {
		if ( is_admin() ) {
			return false;
		}

		// Register scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'fancy_box', RAF_URL . 'js/fancybox/jquery.fancybox-1.3.4.pack.js', array( 'jquery' ), '1.3' );
		wp_enqueue_script( 'raf_script', RAF_URL . 'js/raf_script.js', array( 'jquery', 'fancy_box' ), '1.0' );

		// Register styles
		wp_enqueue_style( 'fancy_box_css', RAF_URL . 'js/fancybox/jquery.fancybox-1.3.4.css', '', '1.3.4' );

		// Specific RAF styles
		if ( file_exists( get_stylesheet_directory() . '/raf-styles.css' ) ) {
			wp_enqueue_style( 'raf-style', get_stylesheet_directory_uri() . '/raf-styles.css', array(), '1.0' );
		}
		elseif ( file_exists( get_template_directory() . "/raf-styles.css" ) ) {
			wp_enqueue_style( 'raf-style', get_template_directory_uri() . '/raf-styles.css', array(), '1.0' );
		} else {
			wp_enqueue_style( 'raf-style', RAF_URL . 'css/raf-styles.css', '', '1.0' );
		}
	}
	
	/**
	 * Add RAF button after the_content if the option is enabled.
	 * 
	 * @param string $the_content
	 * @return string the link 
	 * @author Benjamin Niess
	 */
	public static function auto_add_button( $the_content ){
		if ( is_admin() ) {
			return false;
		}

		$raf_options = get_option ( 'raf_options' );
		
		if ( !isset( $raf_options['auto_add'] ) || $raf_options['auto_add'] != 1 ) {
			return $the_content;
		}
		
		return $the_content . recommend_a_friend_link();
	}
	
	/**
	 * The function for the RAF shortcode.
	 * 
	 * @param array $atts
	 * @author Benjamin Niess
	 */
	public static function shortcode_recommend_a_friend_link( $atts = array() ) {
		extract( shortcode_atts( array(
			'permalink' => '',
			'image' => '',
			'text' => ''
		), $atts ) );
		
		return recommend_a_friend_link( $permalink, $image, $text );
	}

	/**
	 * Get template file depending on theme
	 * 
	 * @param (string) $tpl : the template name
	 * @return (string) the file path | false
	 * 
	 * @author Benjamin Niess
	 */
	public static function get_template( $tpl = '' ) {
		if ( empty( $tpl ) ) {
			return false;
		}
		
		if ( is_file( STYLESHEETPATH . '/views/raf/' . $tpl . '.tpl.php' ) ) {// Use custom template from child theme
			return ( STYLESHEETPATH . '/views/raf/' . $tpl . '.tpl.php' );
		} elseif ( is_file( TEMPLATEPATH . '/raf/' . $tpl . '.tpl.php' ) ) {// Use custom template from parent theme
			return (TEMPLATEPATH . '/views/raf/' . $tpl . '.tpl.php' );
		} elseif ( is_file( RAF_DIR . 'views/' . $tpl . '.tpl.php' ) ) {// Use builtin template
			return ( RAF_DIR . 'views/' . $tpl . '.tpl.php' );
		}
		
		return false;
	}

	/**
	 * Load the RAF iframe popin content
	 */
	public static function load_popin() {
		global $email_shipper, $manual_feature, $social_feature;

		if ( ! isset( $_GET['raf-form'] ) ) {
			return false;
		}

		//init $error_message
		$error_message = array();

		$raf_options = get_option( 'raf_options' );

		//enabled features
		$manual_feature = ( isset( $raf_options['manual'] ) && $raf_options['manual'] == 1 ) ? true : false;
		$social_feature = ( isset( $raf_options['social'] ) && $raf_options['social'] == 1 ) ? true : false;

		//Get the email shipper from admin option
		$email_shipper = ( !empty( $raf_options['email_shipper'] ) ) ? $raf_options['email_shipper'] : get_option( 'admin_email' );

		$bg_color = ( !empty( $raf_options['bg_color'] ) ) ? $raf_options['bg_color'] : 'ffffff';
		$bg_color_hover = ( !empty( $raf_options['button_bg_color_hover'] ) ) ? $raf_options['button_bg_color_hover'] : '85acca';
		$button_color = ( !empty( $raf_options['button_bg_color'] ) ) ? $raf_options['button_bg_color'] : '6194bb';
		$border_color = ( !empty( $raf_options['border_color'] ) ) ? $raf_options['border_color'] : 'ECECE6';
		$legend_color = ( !empty( $raf_options['titles_color'] ) ) ? $raf_options['titles_color'] : '6194BB';
		$button_text_color = ( !empty( $raf_options['button_text_color'] ) ) ? $raf_options['button_text_color'] : 'FFFFFF';

		$enable_captcha = ( isset( $raf_options['enable_captcha'] ) && $raf_options['enable_captcha'] == 1 ) ? true : false;
		$captcha_site_key = ( !empty( $raf_options['captcha_site_key'] ) ) ? $raf_options['captcha_site_key'] : '';
		$captcha_secret_key = ( !empty( $raf_options['captcha_secret_key'] ) ) ? $raf_options['captcha_secret_key'] : '';

		//get the current url (in $_GET)
		$current_url = ( isset( $_GET['current-url'] ) && !empty( $_GET['current-url'] ) ) ? $_GET['current-url'] : home_url();

		$current_user = wp_get_current_user();

		if ( isset( $_POST['raf_manual_invit'] ) && !empty( $_POST['raf_manual_invit'] ) && $_POST['raf_manual_invit'] == '1' ) {

			if ( true === $enable_captcha  && ! empty( $captcha_site_key ) && ! empty( $captcha_secret_key ) ) {
				// Include google recaptcha lib
				include_once(RAF_DIR . 'lib/recaptcha/autoload.php');

				$recaptcha = new \ReCaptcha\ReCaptcha( $captcha_secret_key );
				$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
				if ( ! $resp->isSuccess()) {
					$error_message['captcha'] = __( 'The captcha is not correct', 'raf' ) ;
				}
			}

			$email_addresses = str_replace( ";", ",", trim( $_POST['raf_email_addresses'] ) ) ;

			//delete escape char
			$clean_email_addresses = str_replace( ' ', '', $email_addresses );

			//Explode email field in an array
			$email_addresses = explode( ",", $clean_email_addresses );

			$secure_content = stripslashes( esc_textarea( $_POST['private_message'] ) );
			$secure_name_from = stripslashes( $_POST['raf_name_from'] );

			//Set the $error_message value if one of the emails is not correct
			foreach ( $email_addresses as $email ) {
				if ( !is_email( $email ) ) {
					$error_message['email'] = __( 'You need to enter valid email addresses', 'raf' );
				}
			}


			//Set $email_default_value to display it into the form
			$email_default_value = ( !isset( $error_message['mail'] ) || !empty( $error_message['mail'] ) ) ? $clean_email_addresses : '';

			//check if user is logged in - Use name & first name or name field depending on the logged in statut
			if ( is_user_logged_in() ) {
				$name_from = $current_user->user_login;
			}
			else {
				if ( !empty( $secure_name_from ) ){
					$name_from = $secure_name_from;
				}
				else {
					$error_message['name_from'] = __( 'You need to specify your name', 'raf' ) ;
					$name_from = '';
				}
			}
			//If everything is correct send an mail for each email address
			if ( isset( $error_message ) && count( $error_message ) == 0 ) {
				$headers = 'From: "' . $name_from . '" <' . $email_shipper . '>'. "\n";
				$headers .= 'Content-type: text/html; charset= utf-8'. "\n";

				$body_message = '';
				$body_message .= '<br /><br />';
				$body_message .= __( 'Attached message: ', 'raf' ) . "<br /><br />";
				$body_message .= $secure_content;
				$body_message = nl2br( $body_message );

				$subject = __( ' would like to invite you on ', 'raf' ) . ' http://' . $_SERVER['HTTP_HOST'];

				foreach ( $email_addresses as $dest_email ) {


					if ( !function_exists( 'raf_mail' ) ){
						function raf_mail(  $email, $subject, $body_message, $headers, $sender  ){
							wp_mail( $email, $sender['name'] . $subject, $body_message, $headers );

						}

					}
					raf_mail( $dest_email, $subject, $body_message, $headers, array( 'mail' => $email_shipper, 'name' => $name_from, 'id' => $current_user->data->ID ) );

				}

				wp_redirect( add_query_arg( array( 'raf-form' => 'true', 'raf_message' => 'success' ), home_url() ) );
				exit;
			}
		}


		//Set the $textarea value to display it into the form. It checks the hidden_content_field that is in the openinviter form
		if ( isset( $_POST['hidden_content_field'] ) && !empty( $_POST['hidden_content_field'] )) {
			$textarea_value = stripslashes ( $_POST['hidden_content_field'] );
		}
		elseif ( isset( $_POST['private_message'] ) && !empty( $_POST['private_message'] )) {
			$textarea_value = stripslashes ( $_POST['private_message'] );
		}
		else {
			$textarea_value = __( "Hello,\nI'd like to recommend you the following page...\n", 'raf' ) . $current_url;
		}

		$tpl = self::get_template( 'raf-form' );
		if ( empty( $tpl ) ) {
			return false;
		}
		include_once ( $tpl );
		exit;
	}
}
