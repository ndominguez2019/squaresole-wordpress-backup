<?php

add_action( 'tgmpa_register', 'mokko_register_required_plugins' );

function mokko_register_required_plugins() {

	$source = 'https://theme.madsparrow.me/plugins/';

	$plugins = array(

		array(
			'name' => esc_html__( 'Elementor Page Builder', 'mokko' ),
			'slug' => 'elementor',
			'required' => false,
		),

		array(
			'name' => esc_html__( 'Advanced Custom Fields PRO', 'mokko' ),
			'slug' => 'acf_pro',
			'source' => esc_url( $source . 'advanced-custom-fields-pro.zip'),
			'required' => true,
		),

		array(
			'name' => esc_html__( 'Mokko Helper Plugin', 'mokko' ),
			'slug' => 'mokko_plugin',
			'source' => esc_url( $source . 'mokko_plugin.zip'),
			'required' => true,
		),

		array(
			'name' => esc_html__( 'Kirki', 'mokko' ),
			'slug' => 'kirki',
			'required' => true,
		),

		array(
			'name' => esc_html__( 'Contact Form 7', 'mokko' ),
			'slug' => 'contact-form-7',
			'required' => true,
		),

		array(
			'name' => esc_html__( 'WooCommerce', 'mokko' ),
			'slug' => 'woocommerce',
			'required' => false,
		),

		array(
			'name' => esc_html__( 'MC4WP: Mailchimp for WordPress', 'mokko' ),
			'slug' => 'mailchimp-for-wp',
			'required' => false,
		),

		array(
			'name' => esc_html__( 'One Click Demo Import', 'mokko' ),
			'slug' => 'one-click-demo-import',
			'required' => true,
		),
	);

	$config = array(
		'id'           => 'mokko',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}