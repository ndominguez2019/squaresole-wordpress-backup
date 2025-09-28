<?php

$priority = 0;

new \Kirki\Field\Dimensions(
	[
		'settings'    => 'setting_dimensions_1',
		'label'       => esc_html__( 'Dimensions Control', 'mokko' ),
		'description'       => esc_html__( 'Any value must contain a unit of measurement (px, rem, em, %)', 'mokko' ),
		'section'     => 'header_settings',
        'priority' => $priority++,
		'default'     => [
			'width'  => '1320px',
			'height' => '100px',
		],
        'output'    => [
            [
                'choice'      => 'width',
                'element'  => ':root',
                'property' => '--main-header-width-md',
            ],
            [
                'choice'      => 'height',
                'element'  => ':root',
                'property' => '--main-header-height',
            ],
        ],
        'transport' => 'auto',
	]
);

new \Kirki\Field\Radio_Buttonset(
    [
    'section'     => 'header_settings',
    'settings'    => 'type_header',
    'label' => esc_html__( 'Style', 'mokko' ),
    'default'     => 'default',
    'choices'     => [
        'default'   => esc_html__( 'Default', 'mokko' ),
        'fixed' => esc_html__( 'Fixed', 'mokko' ),
    ],
    'priority' => $priority++,
] );

new \Kirki\Field\Radio_Buttonset(
    [
    'section'     => 'header_settings',
    'settings'    => 'menu_type',
    'label' => esc_html__( 'Menu Type', 'mokko' ),
    'default'     => 'default',
    'choices'     => [
        'default'   => esc_html__( 'Default', 'mokko' ),
        'button' => esc_html__( 'Button', 'mokko' ),
    ],
    'priority' => $priority++,
] );

new \Kirki\Field\Radio_Buttonset(
    [
    'section'     => 'header_settings',
    'settings'    => 'menu_align',
    'label' => esc_html__( 'Menu Align', 'mokko' ),
    'default'     => 'right',
    'choices'     => [
        'left'   => esc_html__( 'Left', 'mokko' ),
        'center' => esc_html__( 'Center', 'mokko' ),
        'right' => esc_html__( 'Right', 'mokko' ),
    ],
    'priority' => $priority++,
    'required'  => array( 
        array( 
            'setting'   => 'menu_type',
            'operator'  => '==',
            'value'     => 'default'
        )
    ),
] );

new \Kirki\Field\Checkbox_Switch(
	[
		'settings'    => 'mode_switcher',
		'label'       => esc_html__( 'Theme Mode Switcher', 'mokko' ),
		'section'     => 'header_settings',
		'default'     => 'off',
		'priority' => $priority++,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'mokko' ),
			'off' => esc_html__( 'Disable', 'mokko' ),
		],
	]
);

new \Kirki\Field\Checkbox_Switch(
    [
        'settings'    => 'search_widget',
        'label'       => esc_html__( 'Show Search', 'mokko' ),
        'section'     => 'header_settings',
        'default'     => 'on',
        'priority' => $priority++,
        'choices'     => [
            'on'  => esc_html__( 'Enable', 'mokko' ),
            'off' => esc_html__( 'Disable', 'mokko' ),
        ],
    ]
);

if ( MOKKO_WOOCOMMERCE ) {

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'cart_widget',
            'label'       => esc_html__( 'Show Cart', 'mokko' ),
            'section'     => 'header_settings',
            'default'     => 'on',
            'priority' => $priority++,
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'mokko' ),
                'off' => esc_html__( 'Disable', 'mokko' ),
            ],
        ]
    );

}