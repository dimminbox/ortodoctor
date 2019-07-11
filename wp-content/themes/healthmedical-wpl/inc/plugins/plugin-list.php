<?php

/**
 * Initiate plugin installing class (TGMPA)
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0.0
 */

if( !function_exists( 'wplook_initiate_tgmpa' ) ) {

	function wplook_initiate_tgmpa() {

		$plugins = array(
			array(
				'name'               => 'Health & Medical Toolskit', // The plugin name.
				'slug'               => 'medical-toolskit', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/inc/plugins/list/medical-toolskit.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			),
			array(
				'name'      => 'Contact Form 7',
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
			array(
				'name'      => 'Widget Importer & Exporter',
				'slug'      => 'widget-importer-exporter',
				'required'  => false,
			),
			array(
				'name'      => 'WordPress Importer',
				'slug'      => 'wordpress-importer',
				'required'  => false,
			),
			array(
				'name'      => 'WooCommerce',
				'slug'      => 'woocommerce',
				'required'  => false,
			),
		);

		// Global TGMPA options
		$config = array(
			'id'           => 'healthmedical-wpl',     // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );

	}

	add_action( 'tgmpa_register', 'wplook_initiate_tgmpa' );

}

?>
