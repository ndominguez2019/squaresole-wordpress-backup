<?php

$priority = 0;

/**
 * Theme Mode
 */
new \Kirki\Field\Radio_Buttonset(
	[
        'settings'    => 'theme_mode',
        'label'       => esc_html__( 'Select Default Website Mode', 'mokko' ),
        'section'     => 'colors_schemes',
        'default'     => 'light',
        'priority'    => $priority++,
        'choices'     => [
            'light'   => esc_html__( 'Light Mode', 'mokko' ),
            'dark'    => esc_html__( 'Dark Mode', 'mokko' ),
        ],
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<br>',
        'priority' => $priority++,
    ]
);

new \Kirki\Field\Custom(
	[
    'type' => 'custom',
    'settings' => 'sg_1',
    'section' => 'colors_schemes',
    'default' => '<div class="ms-mode-kirki-separator"><h2>' . esc_html__( 'Light Mode', 'mokko' ) . '</h2></div>',
    'priority' => $priority++,
    ]
);

/**
 * Primary Color (Light Mode)
 */
new \Kirki\Field\Color(
	[
        'settings' => 'accent_color',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Accent Color', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => false 
        ),
        'default' => 'hsl(115, 68%, 74%)',
        'output'    => [
            [
                'element'  => ':root, [data-theme="light"]',
                'property' => '--color-primary',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

/**
 * Contrast Higher (Light Mode)
 */
new \Kirki\Field\Color(
	[
        'settings' => 'primary_color1',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Primary Text Color', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => false 
        ),
        'default' => 'hsl(0, 0%, 0%)',
        'output'    => [
            [
                'element'  => ':root, [data-theme="light"]',
                'property' => '--color-contrast-higher',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

/**
 * Contrast Medium (Light Mode)
 */
new \Kirki\Field\Color(
	[
        'settings' => 'contrast_color2',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Color Contrast Medium', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => true 
        ),
        'default' => 'hsl(225, 4%, 47%)',
        'output'    => [
            [
                'element'  => ':root, [data-theme="light"]',
                'property' => '--color-contrast-medium',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

/**
 * Contrast Low (Light Mode)
 */
new \Kirki\Field\Color(
	[
        'settings' => 'contrast_low',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Color Contrast Low', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => true 
        ),
        'default' => 'hsl(0, 0%, 84%)',
        'output'    => [
            [
                'element'  => ':root, [data-theme="light"]',
                'property' => '--color-contrast-low',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

/**
 * Contrast Lower (Light Mode)
 */
new \Kirki\Field\Color(
	[
        'settings' => 'contrast_lower',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Color Contrast Lower', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => true 
        ),
        'default' => 'hsl(0, 0%, 97%)',
        'output'    => [
            [
                'element'  => ':root, [data-theme="light"]',
                'property' => '--color-contrast-lower',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

/**
 * Background Color Light
 */
new \Kirki\Field\Color(
	[
        'settings' => 'bg_color_light',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Background Color', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => false 
        ),
        'default' => 'hsl(0, 0%, 100%)',
            'output'    => [
            [
                'element'  => ':root, [data-theme="light"]',
                'property' => '--color-bg',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '',
        'priority' => $priority++,
    ]
);

/**
 * Primary Color (Dark Mode)
 */
new \Kirki\Field\Custom(
	[
    'type' => 'custom',
    'settings' => 'sg_2',
    'section' => 'colors_schemes',
    'default' => '<div class="ms-mode-kirki-separator"><h2>' . esc_html__( 'Dark Mode', 'mokko' ) . '</h2></div>',
    'priority' => $priority++,
    ]
);

new \Kirki\Field\Color(
	[
        'settings' => 'accent_color_d',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Accent Color', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => false 
        ),
        'default' => 'hsl(115, 68%, 74%)',
        'output'    => [
            [
                'element'  => ':root, [data-theme="dark"]',
                'property' => '--color-primary',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

/**
 * Contrast Higher (Dark Mode)
 */
new \Kirki\Field\Color(
	[
        'settings' => 'primary_color_dark_1',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Primary Text Color', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => false 
        ),
        'default' => 'hsl(0, 100%, 99%)',
        'output'    => [
            [
                'element'  => ':root, [data-theme="dark"]',
                'property' => '--color-contrast-higher',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

/**
 * Contrast Medium (Dark Mode)
 */
new \Kirki\Field\Color(
	[
        'settings' => 'contrast_color_dark_2',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Color Contrast Medium', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => true 
        ),
        'default' => 'hsl(0, 0%, 57%)',
        'output'    => [
            [
                'element'  => ':root, [data-theme="dark"]',
                'property' => '--color-contrast-medium',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

/**
 * Contrast Low (Dark Mode)
 */
new \Kirki\Field\Color(
	[
        'settings' => 'contrast_low_2',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Color Contrast Low', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => true 
        ),
        'default' => 'hsl(0, 0%, 22%)',
        'output'    => [
            [
                'element'  => ':root, [data-theme="dark"]',
                'property' => '--color-contrast-low',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

/**
 * Contrast Lower (Dark Mode)
 */
new \Kirki\Field\Color(
	[
        'settings' => 'contrast_lower_2',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Color Contrast Lower', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => true 
        ),
        'default' => 'hsl(0, 0%, 15%)',
        'output'    => [
            [
                'element'  => ':root, [data-theme="dark"]',
                'property' => '--color-contrast-lower',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);

/**
 * Background Color (Dark Mode)
 */
new \Kirki\Field\Color(
	[
        'settings' => 'bg_color',
        'section' => 'colors_schemes',
        'label' => esc_html__( 'Background Color', 'mokko' ),
        'priority' => $priority++,
        'choices' => array(
            'alpha' => false 
        ),
        'default' => 'hsl(150, 4%, 11%)',
            'output'    => [
            [
                'element'  => ':root, [data-theme="dark"]',
                'property' => '--color-bg',
            ],
        ],
        'transport' => 'auto',
    ]
);

// Separator
new \Kirki\Field\Custom(
	[
        'settings'    => 'separator' . $priority++,
        'section'     => 'colors_schemes',
        'default'     => '<hr>',
        'priority' => $priority++,
    ]
);