<?php
/**
 * Headerdata
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Include CSS
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'wplook_css_include' ) ) {

	function wplook_css_include() {

		/*-----------------------------------------------------------
			Load our main stylesheet
		-----------------------------------------------------------*/
		// Source: http://stackoverflow.com/a/11741586
		// IE <9 has a limit on CSS rules in a file, so we split the CSS
		// into two files using grunt-bless.
		// To still get the benefits of a single file elsewhere, we check
		// what browser is used and only load the fix on IE 6-9
		preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $browser_version);

		if( count($browser_version) < 2 ){
			preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $browser_version);
		}

		if ( count($browser_version) > 1 && $browser_version[1] >= 6 && $browser_version[1] <= 9 ){
			wp_enqueue_style( 'health-style-ie', get_template_directory_uri() . '/ie.css', array(), '2015-12-11', 'all' );
		} else {
			wp_enqueue_style( 'health-style', get_stylesheet_uri(), array(), '2015-12-11', 'all' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'wplook_css_include' );
}

/*-----------------------------------------------------------------------------------*/
/*	Include Java Scripts
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'wplook_scripts_include' ) ) {

	function wplook_scripts_include() {

		/*-----------------------------------------------------------
			Vendors
		-----------------------------------------------------------*/
		wp_enqueue_script( 'fastclick', get_template_directory_uri() . '/assets/javascripts/vendor/fastclick.js', false, false, true );
		wp_enqueue_script( 'foundation', get_template_directory_uri() . '/assets/javascripts/vendor/foundation.min.js', false, false, true );
		wp_enqueue_script( 'jquery.ajaxchimp', get_template_directory_uri() . '/assets/javascripts/vendor/jquery.ajaxchimp.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery.bxslider', get_template_directory_uri() . '/assets/javascripts/vendor/jquery.bxslider.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery.fitvids', get_template_directory_uri() . '/assets/javascripts/vendor/jquery.fitvids.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery.stellar', get_template_directory_uri() . '/assets/javascripts/vendor/jquery.stellar.min.js', array( 'jquery' ), false, true );


		/*-----------------------------------------------------------
			Include Google Maps
		-----------------------------------------------------------*/
		$maps_api_key = ot_get_option( 'wpl_maps_api_browser_key' );

		if( !empty( $maps_api_key ) ) {
			wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=' . $maps_api_key );
		} else {
			wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp' );
		}

		wp_enqueue_script( 'wplook-google-maps', get_template_directory_uri() . '/assets/javascripts/vendor/google-maps.js', array( 'jquery', 'google-maps-api' ), false, true );


		/*-----------------------------------------------------------
			Base custom scripts
		-----------------------------------------------------------*/
		wp_enqueue_script( 'base', get_template_directory_uri() . '/assets/javascripts/app.js', array( 'jquery' ), false, true );


		/*-----------------------------------------------------------
			Comment Reply
		-----------------------------------------------------------*/
		if ( !is_admin() && is_singular() && comments_open() && get_option( 'thread_comments' ) == 1 ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	add_action( 'wp_enqueue_scripts', 'wplook_scripts_include' );

}


/*-----------------------------------------------------------------------------------*/
/*	Include admin styles and scripts
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_admin_include' ) ) {

	function wplook_admin_include( $hook ) {

		// CSS styles
		wp_enqueue_style( 'wplook_admin_css', get_template_directory_uri() . '/assets/css/admin.css' );

		// JavaScript
		$wplook_ajax_params = array(
			'selectImage' => __( 'Select image', 'healthmedical-wpl' ),
			'useSelectedImage' => __( 'Use selected image', 'healthmedical-wpl' ),
		);

		wp_register_script( 'wplook_admin_js', get_template_directory_uri() . '/assets/javascripts/admin.js', array( 'jquery' ), '', true );
		wp_localize_script( 'wplook_admin_js', 'wplookAjaxParams', $wplook_ajax_params );
		wp_enqueue_script( 'wplook_admin_js' );

		// Media JS
		if ( $hook == 'widgets.php' || $hook == 'customize.php' ) {
			wp_enqueue_media();
		}

	}

	add_action( 'admin_enqueue_scripts', 'wplook_admin_include' );

}
