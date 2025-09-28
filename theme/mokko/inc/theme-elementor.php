<?php

/**
 * @author: MadSparrow
 * @version: 1.0.0
 */

/**
 * Upload SVG for Elementor
 */
if ( ! function_exists( 'mokko_unfiltered_files_upload' ) ) {
	function mokko_unfiltered_files_upload() {

		// if exists, assign to $cpt_support var
		$cpt_support = get_option( 'elementor_unfiltered_files_upload' );

		// check if option DOESN'T exist in db
		if( ! $cpt_support ) {
			$cpt_support = '1'; //create string value default to enable upload svg
			update_option( 'elementor_unfiltered_files_upload', $cpt_support ); //write it to the database
		}
	}
}
add_action( 'elementor/init', 'mokko_unfiltered_files_upload' );

/**
 * Mokko Widgets Priority
 */
if ( ! class_exists( 'ElementorPro\Plugin' ) ) {
	add_filter( 'elementor/editor/localize_settings', function( $settings ) {
		if ( ! empty( $settings[ 'promotionWidgets' ] ) ) {
			$settings[ 'promotionWidgets' ] = [];
		}
		return $settings;
	}, 20 );
}

/**
 * Add Parallax Effect To Container
 */
add_action( 'elementor/element/container/section_background/after_section_end', function( $section, $args ) {

	$section->start_controls_section(
		'section_navbar_offset', [
			'label' => esc_html__( 'Scroll Trigger', 'mokko' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

	$section->add_control(
		'parallax_container', [
			'label' => esc_html__( 'Scroll Trigger', 'mokko' ),
			'type' => Elementor\Controls_Manager::SWITCHER,
            'description' => __( 'Works only when smooth scrolling is enabled', 'mokko' ),
            'return_value' => 'yes',
            'default' => 'no',
			'prefix_class' => ''
		]
	);

    $section->add_control(
		'parallax_speed_container', [
            'label' => __( 'Speed', 'mokko' ),
            'description' => __( 'Min -1, Max 1', 'mokko' ),
            'type' => Elementor\Controls_Manager::NUMBER,
            'min' => -1,
            'max' => 1,
            'step' => 0.1,
            'default' => 0.4,
            'condition' => [
                'parallax_container' => ['yes'],
            ],
            'prefix_class' => ''
        ]
	);

    $section->add_control(
        'parallax_position', [
            'label' => esc_html__( 'Position', 'mokko' ),
            'type' => Elementor\Controls_Manager::TEXT,
            'description' => esc_html__( 'Accepted values are: "start", "middle", "end".', 'mokko' ),
            'placeholder' => esc_html__( 'start,end', 'mokko' ),
            'condition' => [
                'parallax_container' => ['yes'],
            ],
        ]
    );

    $section->add_control(
        'parallax_offset', [
            'label' => esc_html__( 'Offset', 'mokko' ),
            'type' => Elementor\Controls_Manager::TEXT,
            'description' => esc_html__( 'Example: "100,50%" represents an offset of 100 pixels for the enter position and 50% of the viewport height for.', 'mokko' ),
            'placeholder' => esc_html__( '0,0', 'mokko' ),
            'condition' => [
                'parallax_container' => ['yes'],
            ],
        ]
    );
    
	$section->end_controls_section();

}, 10, 2 );

if ( ! function_exists( 'mokko_render_aos_animation' ) ) {
    function mokko_scroll_parallax( $widget ) {
     $settings = $widget->get_settings_for_display();
     
    if ( $settings['parallax_container'] === 'yes' ) {

        $widget->add_render_attribute( '_wrapper', 'data-scroll', '' );

        if ( $settings['parallax_position'] !== '' ) {
            $widget->add_render_attribute( '_wrapper', 'data-scroll-position', $settings['parallax_position'] );
        }
        
        if ( $settings['parallax_offset'] !== '' ) {
            $widget->add_render_attribute( '_wrapper', 'data-scroll-offset', $settings['parallax_offset'] );
        }
        
        $widget->add_render_attribute( '_wrapper', 'data-scroll-speed', $settings['parallax_speed_container'] );
    }
   
    }
}
   
add_action( 'elementor/frontend/container/before_render', 'mokko_scroll_parallax', 10 );