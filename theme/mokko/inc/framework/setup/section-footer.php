<?php

$priority = 0;

new \Kirki\Field\Select(
	[
		'settings'    => 'footer_template',
		'label'       => esc_html__( 'Select Footer Template', 'mokko' ),
		'section'     => 'footer_settings',
        'priority' => $priority++,
		'placeholder' => esc_html__( 'Choose an option', 'mokko' ),
        'choices'     => ms_get_elementor_templates(),
	]
);