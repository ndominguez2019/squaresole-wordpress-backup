<?php

/**
 * General
 */
$priority = 0;

new \Kirki\Field\Checkbox_Switch(
	[
		'settings'    => 'page_transition',
		'label'       => esc_html__( 'Page transition', 'mokko' ),
		'section'     => 'section_general_settings',
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
		'settings'    => 'top_btn',
		'label'       => esc_html__( 'Back To Top Button', 'mokko' ),
		'section'     => 'section_general_settings',
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
		'settings'    => 'smooth_scroll',
		'label'       => esc_html__( 'Smooth Scroll', 'mokko' ),
		'section'     => 'section_general_settings',
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
		'settings'    => 'share_post',
		'label'       => esc_html__( 'Share Post', 'mokko' ),
		'section'     => 'section_general_settings',
		'default'     => 'off',
		'priority' => $priority++,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'mokko' ),
			'off' => esc_html__( 'Disable', 'mokko' ),
		],
	]
);