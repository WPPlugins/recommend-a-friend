<?php
class RAF_Admin {
	/**
	 * Constructor
	 *
	 * @return void
	 * @author Benjamin Niess
	 */
	function __construct() {
		// ADD the admin options page
		add_action( 'admin_menu', array( __CLASS__, 'raf_plugin_menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'init_scripts_and_styles' ) );
	}

	/**
	 * Register scripts and styles
	 */
	public static function init_scripts_and_styles() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'raf_admin', RAF_URL . 'js/raf_admin.js', array( 'jquery', 'wp-color-picker' ) );
		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_style( 'raf-admin', RAF_URL . 'css/raf-admin-styles.css', array() );
	}

	public static function raf_plugin_menu() {
		add_options_page( __( 'Options for Recommend to a friend plugin', 'raf' ), __( 'Recommend to a friend', 'raf' ), 'manage_options', 'raf-options', array( __CLASS__, 'display_raf_options' ) );
	}

	/**
	 * Call the admin option template
	 *
	 * @echo the form
	 * @author Benjamin Niess
	 */
	public static function display_raf_options() {
		if ( isset($_POST['save']) ) {
			check_admin_referer( 'raf-update-options' );
			$new_options = array();

			// Update existing
			foreach ( (array) $_POST['raf'] as $key => $value ) {
				$new_options[ $key ] = stripslashes( $value );
			}

			update_option( 'raf_options', $new_options );
		}

		if ( isset( $_POST['save'] ) ) {
			echo '<div class="message updated"><p>' . esc_html__( 'Options updated!', 'raf' ) . '</p></div>';
		}

		$fields = get_option( 'raf_options' );
		if ( empty( $fields ) ) {
			$fields = array();
		}

		$tpl = RAF_Client::get_template( 'admin/options-page' );
		if ( empty( $tpl ) ) {
			return false;
		}

		include( $tpl );
		return true;
	}
}
