<?php

$priority = 0;

new \Kirki\Field\Dimensions(
	[
		'settings'    => 'logo_dimensions',
		'label'       => esc_html__( 'Dimensions Control', 'mokko' ),
		'description'       => esc_html__( 'Width and height must be specified in units of measurement (px, em, rem, pt). Example: 100px', 'mokko' ),
		'section'     => 'logo_settings',
        'priority' => $priority++,
		'default'     => [
			'width'  => 'auto',
			'height' => '50px',
		],
        'output'    => [
            [
                'choice'      => 'width',
                'element'  => '.main-header__logo a, .main-header__logo svg, .main-header__logo img',
                'property' => 'width',
            ],
            [
                'choice'      => 'height',
                'element'  => '.main-header__logo a, .main-header__logo svg, .main-header__logo img',
                'property' => 'height',
            ],
        ],
        'transport' => 'auto',
	]
);

new \Kirki\Field\Image(
	[
		'settings'    => 'logo_light',
		'label'       => esc_html__( 'Image Logo Light', 'mokko' ),
		'description' => esc_html__( 'For Dark Theme Mode', 'mokko' ),
		'section'     => 'logo_settings',
		'default'     => '',
        'priority' => $priority++
	]
);

new \Kirki\Field\Image(
	[
		'settings'    => 'logo_dark',
		'label'       => esc_html__( 'Image Logo Dark', 'mokko' ),
		'description' => esc_html__( 'For Light Theme Mode', 'mokko' ),
		'section'     => 'logo_settings',
		'default'     => '',
        'priority' => $priority++
	]
);