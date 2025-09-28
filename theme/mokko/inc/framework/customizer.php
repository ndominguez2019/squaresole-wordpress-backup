<?php

/**
 * Update Kirki Config
 */

$first_level = 10;

// Theme options
new \Kirki\Panel(
	'theme_options',
	[
		'priority'    => $first_level++,
		'title'       => esc_html__( 'Mokko Theme Options', 'mokko' ),
        'icon'  => 'dashicons-admin-generic',
	]
);

// General Options
new \Kirki\Section(
	'section_general_settings',
	[
        'title' => esc_html__('General', 'mokko'),
        'icon' => 'dashicons-align-wide',
		'panel'       => 'theme_options',
		'priority'    => $first_level++,  
	]
);

require_once MOKKO_REQUIRE_DIRECTORY . 'inc/framework/setup/section-general.php';

// Header
new \Kirki\Section(
	'header_settings',
	[
        'title' => esc_html__('Header', 'mokko'),
        'icon'  => 'dashicons-schedule',
        'panel' => 'theme_options',
        'priority' => $first_level++,
    ]
);

require_once MOKKO_REQUIRE_DIRECTORY . 'inc/framework/setup/section-header.php';

// Logo
new \Kirki\Section(
	'logo_settings',
	[
        'title' => esc_html__('Logo', 'mokko'),
        'icon'  => 'dashicons-format-image',
        'panel' => 'theme_options',
        'priority' => $first_level++,
    ]
);

require_once MOKKO_REQUIRE_DIRECTORY . 'inc/framework/setup/section-logo.php';

// Custom Footer
new \Kirki\Section(
	'footer_settings',
	[
        'title' => esc_html__('Footer', 'mokko'),
        'panel' => 'theme_options',
        'icon' => 'dashicons-button',
        'priority' => $first_level++,
    ]
);

require_once MOKKO_REQUIRE_DIRECTORY . 'inc/framework/setup/section-footer.php';

// Fonts_setting
new \Kirki\Section(
	'fonts_setting',
	[
        'panel' => 'theme_options',
        'title' => esc_html__( 'Typography', 'mokko' ),
        'icon' => 'dashicons-text',
        'priority' => $first_level++
    ]
);

require_once MOKKO_REQUIRE_DIRECTORY . 'inc/framework/setup/section-typography.php';

// Colors themes
new \Kirki\Section(
	'colors_schemes',
	[
        'panel' => 'theme_options',
        'title' => esc_html__( 'Colors', 'mokko' ),
        'icon' => 'dashicons-art',
        'priority' => $first_level++
    ]
);

require_once MOKKO_REQUIRE_DIRECTORY . 'inc/framework/setup/section-colors.php';

// Google Map
new \Kirki\Section(
	'section_google_map',
	[
        'panel' => 'theme_options',
        'title' => esc_html__( 'Google Map', 'mokko' ),
        'icon'  => 'dashicons-location-alt',
        'priority' => $first_level++
    ]
);

require_once MOKKO_REQUIRE_DIRECTORY . 'inc/framework/setup/section-google.php';