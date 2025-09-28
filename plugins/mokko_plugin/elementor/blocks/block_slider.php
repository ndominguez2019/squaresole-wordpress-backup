<?php

/**
 * @author: madsparrow
 * @version: 1.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_MS_Slider extends Widget_Base {

    use \MS_Elementor\Traits\Helper;

    public function get_name() {
        return 'ms_slider';
    }

    public function get_title() {
        return esc_html__( 'Slider', 'madsparrow' );
    }

    public function get_icon() {
        return 'eicon-slider-full-screen ms-badge';
    }

    public function get_categories() {
        return [ 'ms-elements' ];
    }

    public function get_keywords() {
        return [ 'slider', 'controls', ];
    }

    protected function register_controls() {

        $first_level = 0;

        $this->start_controls_section(
            'section_' . $first_level++, [
                'label' => esc_html__( 'Slider', 'madsparrow' ),
            ]
        );


        $repeater = new Repeater();

        $repeater->add_control(
            'slide_type', [
                'label' => __( 'Slide Type', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image'  => __( 'Image', 'madsparrow' ),
                    'video'  => __( 'Video', 'madsparrow' ),
                ],
            ]
        );

        $repeater->add_control(
            'slide_img', [
                'label' => __( 'Slide Image', 'madsparrow' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'slide_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
			'slide_video_type', [
				'label' => esc_html__( 'Source', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'youtube',
				'options' => [
					'youtube' => esc_html__( 'YouTube', 'madsparrow' ),
					'vimeo' => esc_html__( 'Vimeo', 'madsparrow' ),
					'hosted' => esc_html__( 'Self Hosted', 'madsparrow' ),
				],
                'condition' => [
                    'slide_type' => 'video',
                ],
			]
		);

        $repeater->add_control(
            'youtube_url',
            [
                'label' => esc_html__( 'Link', 'madsparrow' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your URL', 'madsparrow' ) . ' (YouTube)',
                'default' => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
                'label_block' => true,
                'condition' => [
                    'slide_video_type' => 'youtube',
                    'slide_type' => 'video',
                ],
                'frontend_available' => true,
            ]
        );
        
        $repeater->add_control(
            'vimeo_url',
            [
                'label' => esc_html__( 'Link', 'madsparrow' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your URL', 'madsparrow' ) . ' (Vimeo)',
                'default' => 'https://vimeo.com/235215203',
                'label_block' => true,
                'condition' => [
                    'slide_video_type' => 'vimeo',
                    'slide_type' => 'video',
                ],
            ]
        );

        $repeater->add_control(
            'hosted_url', [
                'label' => esc_html__( 'Choose File', 'madsparrow' ),
                'type' => Controls_Manager::MEDIA,
                'media_type' => 'video',
                'condition' => [
                    'slide_video_type' => 'hosted',
                    'slide_type' => 'video',
                ],
            ]
        );

        $repeater->add_control(
			'video_start', [
				'label' => esc_html__( 'Start Time', 'madsparrow' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Specify a start time (in seconds)', 'madsparrow' ),
				'frontend_available' => true,
                'condition' => [
					'slide_video_type' => [ 'youtube', 'vimeo' ],
                    'slide_type' => 'video',
				],
			]
		);

		$repeater->add_control(
			'video_end', [
				'label' => esc_html__( 'End Time', 'madsparrow' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Specify an end time (in seconds)', 'madsparrow' ),
				'condition' => [
					'slide_video_type' => [ 'youtube' ],
                    'slide_type' => 'video',
				],
				'frontend_available' => true,
			]
		);

        $repeater->add_control(
            'content_select', [
                'label' => __( 'Content Text', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'  => __( 'Default', 'madsparrow' ),
                    'template'  => __( 'Template', 'madsparrow' ),
                ],
            ]
        );

        $repeater->add_control(
            'content_title', [
                'label' => esc_html__( 'Title', 'madsparrow' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'content_select' => 'default',
                ],
            ]
        );

        $repeater->add_control(
            'content_subtitle', [
                'label' => esc_html__( 'Subtitle', 'madsparrow' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'separator' => 'before',
                'condition' => [
                    'content_select' => 'default',
                ],
            ]
        );

        $repeater->add_control(
            'btn_text', [
                'label' => esc_html__( 'Button Text', 'madsparrow' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'content_select' => 'default',
                ],
            ]
        );

        $repeater->add_control(
            'content_link', [
                'label' => esc_html__( 'Link', 'madsparrow' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'label_block' => true,
                'default' => [
                    'url'=> '',
                ],
                'condition' => [
                    'content_select' => 'default',
                ],
            ]
        );

        $repeater->add_control(
            'content_template', [
                'label' => esc_html__( 'Select a Template', 'madsparrow' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->ms_get_elementor_templates(),
                'label_block' => true,
                'condition' => [
                    'content_select' => 'template',
                ],
            ]
        );

        $this->add_control(
            'slider_fs', [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_img' => 'Slide Image',
                        'slide_link' => 'Link',
                        'slide_title' => 'Title',
                        'slide_desc' => 'Description',
                        'content_template' => '',
                    ],
                ],
            ]
        );

        $this->end_controls_section();


        // TAB CONTENT
        $this->start_controls_section(
            'slider_view', [
                'label' => __( 'View', 'madsparrow' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'effect', [
                'label' => __( 'Effect', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fade',
                'options' => [
                    'slide'  => __( 'Slide', 'madsparrow' ),
                    'fade'  => __( 'Fade', 'madsparrow' ),
                    'cube'  => __( 'Cube', 'madsparrow' ),
                    'cards'  => __( 'Cards', 'madsparrow' ),
                    'flip'  => __( 'Flip', 'madsparrow' ),
                    'coverflow'  => __( 'Coverflow', 'madsparrow' ),
                    'material'  => __( 'Material', 'madsparrow' ),
                    'triple'  => __( 'Triple', 'madsparrow' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'height_' . $first_level++, [
                'label' => __( 'Container Height', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1080,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'vh',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'width_' . $first_level++, [
                'label' => __( 'Slide Width', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'description' => esc_html__( 'Live view doesnt work', 'madsparrow' ),
                'size_units' => [ 'px', 'vh', 'em', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1080,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'vh',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .triple-slider .swiper' => 'max-width: {{SIZE}}{{UNIT}}; ',
                ],
                'condition' => [
                    'effect' => 'triple',
                ],
            ]
        );

        $this->add_responsive_control(
            'slidesPerView', [
                'label' => __( 'Slides Per View', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 8,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 1,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 1,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 1,
                    'unit' => 'px',
                ],
                'condition' => [
                    'effect' => ['material', 'slide'],
                ],
            ]

        );

        $this->add_responsive_control(
            'spaceBetween', [
                'label' => __( 'Space Between', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ], 
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'condition' => [
                    'effect' => ['material', 'slide'],
                ],
            ]
        );

        $this->add_control(
            'badge_radius', [
                'label' => __( 'Border Radius', 'madsparrow' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'pt' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper .swiper-material-wrapper' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .swiper .ms-material-image' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .triple-slider .swiper' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ms-slider.default-slider .ms-slider--img img' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ms-slider .swiper-slide' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .swiper-3d .swiper-slide-shadow-right' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .swiper-3d .swiper-slide-shadow-left' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slider_background_color', [
                'label' =>esc_html__( 'Background', 'madsparrow' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-material-content' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .default-slider .swiper-slide' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // TAB CONTENT
        $this->start_controls_section(
            'slider_opt', [
                'label' => __( 'Options', 'madsparrow' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'autoplay', [
                'label' => __( 'Autoplay', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'madsparrow' ),
                'label_off' => __( 'Off', 'madsparrow' ),
                'return_value' => 'on',
                'default' => 'on',
                'condition' => [
                    'effect!' => 'triple',
                ],
            ]
        );

        $this->add_control(
            'delay', [
                'label' => __( 'Autoplay Delay', 'madsparrow' ),
                'type' => Controls_Manager::NUMBER,
                'description' => __( 'Delay between transitions (in ms)', 'madsparrow' ),
                'min' => 0,
                'max' => 10000,
                'step' => 100,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'on',
                ],
            ]
        );

        $this->add_control(
            'tricker', [
                'label' => __( 'Tricker', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'madsparrow' ),
                'label_off' => __( 'Off', 'madsparrow' ),
                'return_value' => 'on',
                'default' => 'off',
                'condition' => [
                    'autoplay!' => 'on',
                ],
            ]
        );

        $this->add_control(
            'centered', [
                'label' => __( 'Centered', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'madsparrow' ),
                'label_off' => __( 'Off', 'madsparrow' ),
                'return_value' => 'on',
                'default' => 'on',
                'condition' => [
                    'effect!' => 'triple',
                    'tricker!' => 'on',
                ],
            ]
        );

        $this->add_control(
            'mousewheel', [
                'label' => __( 'Mousewheel', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'madsparrow' ),
                'label_off' => __( 'Off', 'madsparrow' ),
                'return_value' => 'on',
                'default' => 'on',
                'condition' => [
                    'tricker!' => 'on',
                ],
            ]
        );

        $this->add_control(
            'simulatetouch', [
                'label' => __( 'Simulate Touch', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'madsparrow' ),
                'label_off' => __( 'Off', 'madsparrow' ),
                'return_value' => 'on',
                'default' => 'on',
                'condition' => [
                    'tricker!' => 'on',
                ],
            ]
        );


        $this->add_control(
            'speed', [
                'label' => __( 'Transition Speed', 'madsparrow' ),
                'type' => Controls_Manager::NUMBER,
                'description' => __( 'Duration of transition between slides (in ms)', 'madsparrow' ),
                'min' => 100,
                'max' => 10000,
                'step' => 100,
                'default' => 1000,
            ]
        );

        $this->add_control(
            'material_scale', [
                'label' => __( 'Scale', 'madsparrow' ),
                'type' => Controls_Manager::NUMBER,
                'description' => __( 'Duration of transition between slides (in ms)', 'madsparrow' ),
                'min' => 0,
                'max' => 2.5,
                'step' => .01,
                'default' => 1.25,
                'condition' => [
                    'effect' => 'material',
                ],
            ]
        );


        $this->add_control(
            'loop', [
                'label' => __( 'Loop', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'true' => __( 'On', 'madsparrow' ),
                'false' => __( 'Off', 'madsparrow' ),
                'return_value' => 'on',
                'default' => 'on',
                'condition' => [
                    'effect!' => 'triple',
                    'tricker!' => 'on',
                ],
            ]
        );

        $this->add_control(
            'direction', [
                'label' => __( 'Direction', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal'  => __( 'Horizontal', 'madsparrow' ),
                    'vertical'  => __( 'Vertical', 'madsparrow' ),
                ],
                'condition' => [
                    'effect!' => ['fade', 'triple', 'material'],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'navigation_' . $first_level++, [
                'label' => __( 'Navigation', 'madsparrow' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tricker!' => 'on',
                    'effect!' => 'triple',
                ],
            ] 
        );

        $this->add_control(
            'nav_show', [
                'label' => __( 'Arrows', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'  => __( 'None', 'madsparrow' ),
                    'show'  => __( 'Show', 'madsparrow' ),
                    'hover'  => __( 'Show On Hover', 'madsparrow' ),
                ],
            ]
        );

        $this->add_control(
            'nav_size', [
                'label' => __( 'Size', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'lg',
                'options' => [
                    'sm'  => __( 'Small', 'madsparrow' ),
                    'md'  => __( 'Medium', 'madsparrow' ),
                    'lg'  => __( 'Large', 'madsparrow' ),
                    'xl'  => __( 'XL', 'madsparrow' ),
                ],
                'condition' => [
                    'nav_show' => ['show', 'hover' ],
                ],
            ]
        );

        $this->add_control(
            'button_color', [
                'label' =>esc_html__( 'Color', 'madsparrow' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ms-nav--next.swiper-button-next::after, .ms-nav--prev.swiper-button-prev::after' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'nav_show' => ['show', 'hover' ],
                ],
            ]
        );

        $this->add_responsive_control(
            'distance_' . $first_level++, [
                'label' => __( 'Distance', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ms-nav--prev.swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ms-nav--next.swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        

        $this->end_controls_section();

        // TAB CONTENT
        $this->start_controls_section(
            'progress', [
                'label' => __( 'Scrollbar', 'madsparrow' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tricker!' => 'on',
                ],
            ]
        );

        $this->add_control(
            'scrollbar', [
                'label' => __( 'Show', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'true' => __( 'On', 'madsparrow' ),
                'false' => __( 'Off', 'madsparrow' ),
                'return_value' => 'on',
                'default' => 'off',
            ]
        );

        $this->add_control(
            'progress_color', [
                'label' =>esc_html__( 'Track Color', 'madsparrow' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-scrollbar' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'scrollbar' => 'on',
                ], 
            ]
        );

        $this->add_control(
            'progress_background_color', [
                'label' =>esc_html__( 'Thumb Color', 'madsparrow' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-scrollbar-drag' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'scrollbar' => 'on',
                ], 
            ]
        );

        $this->add_responsive_control(
            'scrollbar_position', [
                'label' => esc_html__( 'Position', 'madsparrow' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Top', 'madsparrow' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'madsparrow' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'bottom',
                'condition' => [
                    'scrollbar' => 'on',
                ],
            ]
        );

        $this->add_control(
            'scrollbar_drag', [
                'label' => __( 'Dragable', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'true' => __( 'On', 'madsparrow' ),
                'false' => __( 'Off', 'madsparrow' ),
                'return_value' => 'on',
                'default' => 'off',
                'condition' => [
                    'scrollbar' => 'on',
                ],
            ]
        );

        $this->add_control(
            'scrollbar_hide', [
                'label' => __( 'Hide after interaction', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'true' => __( 'On', 'madsparrow' ),
                'false' => __( 'Off', 'madsparrow' ),
                'return_value' => 'on',
                'default' => 'off',
                'condition' => [
                    'scrollbar' => 'on',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'img_opt_' . $first_level++, [
                    'label' => __( 'Image', 'madsparrow' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ] 
        );

        $this->add_responsive_control(
            'image_object', [
                'label' => __( 'Object-fit', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'none'  => __( 'None', 'madsparrow' ),
                    'fill'  => __( 'Fill', 'madsparrow' ),
                    'contain'  => __( 'Contain', 'madsparrow' ),
                    'cover'  => __( 'Cover', 'madsparrow' ),
                    'scale-down'  => __( 'Scale-down', 'madsparrow' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper img,.swiper video' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section();

        $this->start_controls_section(
            'img_' . $first_level++, [
                    'label' => __( 'Overlay', 'madsparrow' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ] 
        );

        $this->start_controls_tabs(
            'tabs_' . $first_level++
        );

        $this->start_controls_tab(
            'tab_' . $first_level++, [
                'label' => esc_html__( 'Normal', 'vlthemes' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'overlay',
                'label' => __( 'Overlay', 'madsparrow' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ms-slider--overlay',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_' . $first_level++, [
                'label' => esc_html__( 'Hover', 'vlthemes' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'overlay_h',
                'label' => __( 'Overlay', 'madsparrow' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ms-slider--cont:hover .ms-slider--overlay',
            ]
        );
        
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // TAB CONTENT
        $this->start_controls_section(
            'content_' . $first_level++, [
                'label' => __( 'Content', 'madsparrow' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'alignment_' . $first_level++, [
                'label' => esc_html__( 'Vertical Position', 'madsparrow' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'madsparrow' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'madsparrow' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'madsparrow' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ms-slider--cont' => 'justify-content: {{VALUE}}',
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );

        $this->add_responsive_control(
            'position_' . $first_level++, [
                'label' => esc_html__( 'Horizontal Position', 'madsparrow' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'madsparrow' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Middle', 'madsparrow' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'madsparrow' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ms-slider--cont' => 'align-items: {{VALUE}}',
                ],
                'default' => 'flex-start',
                'separator' => 'before',
                'toggle' => true,
            ]
        );

		$this->add_responsive_control(
			'content_text_align',
			[
				'label' => esc_html__( 'Text Alignment', 'madsparrow' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'madsparrow' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'madsparrow' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'madsparrow' ),
						'icon' => 'eicon-text-align-right',
					],
				],
                'selectors' => [
                    '{{WRAPPER}} .ms-slider--cont .ms-cont__inner' => 'text-align: {{VALUE}}',
                ],
				'default' => 'center',
				'toggle' => true,
                'separator' => 'before',
			]
		);

        $this->add_control(
			'heading_' . $first_level++, [
				'label' => esc_html__( 'Content', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
                'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'margin' . $first_level++, [
                'label' => __( 'Margin', 'madsparrow' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'vh', 'vw' ],
                'selectors' => [
                    '{{WRAPPER}} .ms-slider--cont .elementor-section-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ms-slider--cont .ms-cont__inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding' . $first_level++, [
                'label' => __( 'Padding', 'madsparrow' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'vh', 'vw' ],
                'selectors' => [
                    '{{WRAPPER}} .ms-slider--cont .elementor-section-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ms-slider--cont .ms-cont__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_' . $first_level++, [
                'label' => esc_html__( 'Title', 'madsparrow' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_animate', [
                'label' => __( 'Animation', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'swiper-material-animate-opacity',
                'options' => [
                    'swiper-material-animate-none'  => __( 'None', 'madsparrow' ),
                    'swiper-material-animate-opacity'  => __( 'Fade', 'madsparrow' ),
                    'swiper-material-animate-scale'  => __( 'Scale', 'madsparrow' ),
                ],
                'condition' => [
                    'effect!' => ['triple'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => esc_html__( 'Typography', 'madsparrow' ),
                'name' => 'content_title',
                'selector' => '{{WRAPPER}} .ms-sc--t',
            ]
        );

        $this->add_responsive_control (
            'title_indent_h', [
                'label' => __( 'Text Indent (horizontal)', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'vh', 'vw', 'pt' ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => -20,
                        'max' => 20,
                    ],
                    'vw' => [
                        'min' => -20,
                        'max' => 20,
                    ],
                    'pt' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],           
                'selectors' => [
                    '{{WRAPPER}} .ms-sc--t' => 'text-indent: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control (
            'title_indent_v', [
                'label' => __( 'Text Indent (vertical)', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'vh', 'vw', 'pt' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    'pt' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],           
                'selectors' => [
                    '{{WRAPPER}} .ms-sc--t' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'title_color', [
				'label' => esc_html__( 'Color', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ms-sc--t' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
            'heading_' . $first_level++, [
                'label' => esc_html__( 'SubTitle', 'madsparrow' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => esc_html__( 'Typography', 'madsparrow' ),
                'name' => 'content_subtitle',
                'selector' => '{{WRAPPER}} .ms-sc--text',
            ]
        );

        $this->add_responsive_control (
            'subtitle_indent_v', [
                'label' => __( 'Text Indent (vertical)', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'vh', 'vw', 'pt' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    'pt' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],           
                'selectors' => [
                    '{{WRAPPER}} .ms-sc--text' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_position', [
                'label' => __( 'Animation', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'top'  => __( 'Top', 'madsparrow' ),
                    'right'  => __( 'Right', 'madsparrow' ),
                    'bottom'  => __( 'Bottom', 'madsparrow' ),
                ],
                'condition' => [
                    'effect' => ['material'],
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment_' . $first_level++, [
                'label' => esc_html__( 'Align-Items', 'madsparrow' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'start-end', 'madsparrow' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'center', 'madsparrow' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'flex-end', 'madsparrow' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-material-wrapper .ms-cont__inner' => 'align-items: {{VALUE}}',
                ],
                'condition' => [
                    'subtitle_position' => ['right'],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ($settings['tricker'] == 'on') {
            $ticker = ' ms-ticker';
            $settings['autoplay'] = 'on';
            $settings['delay'] = '0';
            $settings['loop'] = 'on';
            $centered = 'on';
        } else {
            $ticker = '';
            $settings['autoplay'] = $settings['autoplay'];
            $settings['delay'] = $settings['delay'];
            $centered = 'off';
        }

        switch ( $settings['effect'] ) {

            default :

                if (isset($settings['slidesPerView_tablet']['size'])) {
                    $spv_t = $settings['slidesPerView_tablet']['size'];
                } else {
                    $spv_t = '1';
                }
                if (isset($settings['slidesPerView_mobile']['size'])) {
                    $spv_m = $settings['slidesPerView_mobile']['size'];
                } else {
                    $spv_m = '1';
                }
                if (isset($settings['spaceBetween_tablet']['size'])) {
                    $sbt_t = $settings['spaceBetween_tablet']['size'];
                } else {
                    $sbt_t = '0';
                }
                if (isset($settings['spaceBetween_mobile']['size'])) {
                    $sbt_m = $settings['spaceBetween_mobile']['size'];
                } else {
                    $sbt_m = '0';
                }
                
                if ( $settings['effect'] == 'slide') {
                    $spv = $settings['slidesPerView']['size'];
                    $sbt = $settings['spaceBetween']['size'];
                } else {
                    $spv = '1';
                    $sbt = 0;
                }

                if ($settings['content_animate'] === 'swiper-material-animate-scale') {
                    $splitting_anim = ' data-splitting';
                } else {
                    $splitting_anim = '';
                }
                
                $direction = $settings['direction'];

                $this->add_render_attribute( 'slider-wrap', [
                    'class' => [ 'swiper ms-slider-default' ],
                    'data-autoplay' => $settings['autoplay'],
                    'data-autoplay-delay' => $settings['delay'],
                    'data-centered' => $settings['centered'],
                    'data-mousewheel' => $settings['mousewheel'],
                    'data-simulatetouch' => $settings['simulatetouch'],
                    'data-effect' => $settings['effect'],
                    'data-direction' => $settings['direction'],
                    'data-direction' => $direction,
                    'data-loop' => $settings['loop'],
                    'data-spv' => $spv,
                    'data-spv-t' => $spv_t,
                    'data-spv-m' => $spv_m,
                    'data-space' => $sbt,
                    'data-space-t' => $sbt_t,
                    'data-space-m' => $sbt_m,
                    'data-speed' => $settings['speed'],
                    'data-nav' => $settings['nav_show'],
                   
                ] ); ?>

                <div class="ms-slider default-slider">

                    <div <?php echo $this->get_render_attribute_string( 'slider-wrap' ); ?>>

                        <div class="swiper-wrapper<?php echo $ticker; ?>">

                            <?php foreach ( $settings[ 'slider_fs' ] as $index => $item ) : ?>

                                <div class="swiper-slide">
                                
                                    <?php if ( $item['slide_type'] == 'image' ) : ?>
                                        <div class="ms-slider--img">
                                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $item, 'slide_img' ); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($item['slide_type'] == 'video') : ?>

                                        <div class="ms-slider--video">

                                            <?php if ( $item['slide_video_type'] === 'youtube') : ?>
                                                <div data-vbg-mobile="true" data-vbg-start-at="<?php echo $item['video_start']; ?>" data-vbg-end-at="<?php echo $item['video_end']; ?>" data-vbg="<?php echo $item['youtube_url']; ?>"></div>
                                            <?php endif; ?>

                                            <?php if ( $item['slide_video_type'] === 'vimeo') : ?>
                                                <div data-vbg-mobile="true" data-vbg-start-at="<?php echo $item['video_start']; ?>" data-vbg="<?php echo $item['vimeo_url']; ?>"></div>
                                            <?php endif; ?>

                                            <?php if ( $item['slide_video_type'] === 'hosted') : ?>
                                                <div data-vbg-mobile="true" video-background-mute data-vbg="<?php echo $item['hosted_url']['url']; ?>"></div>
                                            <?php endif; ?>

                                        </div>

                                    <?php endif; ?>

                                    <?php if ( $item[ 'content_select' ] == 'default' ) : ?>

                                        <?php if ( !empty( $item[ 'content_select' ] ) ) : ?>

                                            <div class="ms-slider--cont ms-material-label <?php echo $settings['content_animate']?>">
                                                <div class="ms-cont__inner">

                                                    <?php if ( $item['content_title'] ) : ?>
                                                        <h1 class="ms-sc--t"<?php echo $splitting_anim; ?>><?php echo wp_kses_post($item['content_title']); ?></h1>
                                                    <?php endif; ?>

                                                    <?php if ( $item['content_subtitle'] ) : ?>
                                                        <h3 class="ms-sc--text"><?php echo $item['content_subtitle']; ?></h3>
                                                    <?php endif; ?>

                                                    <?php if ( !empty( $item['btn_text'] ) ) : ?>

                                                        <div class="ms-cont__btn">

                                                            <?php if ( !empty( $item['content_link']['url'] ) ) : ?>
                                                                <?php
                                                                    if ( $item[ 'content_link' ][ 'is_external' ] === 'on' ) {
                                                                        $target = ' target="_blank"';
                                                                    } else {
                                                                        $target = '';
                                                                    }
                                                        
                                                                    if ( $item[ 'content_link' ][ 'nofollow' ] === 'on' ) {
                                                                        $nofollow = ' rel="nofollow"';
                                                                    } else {
                                                                        $nofollow = '';
                                                                    }
                                                                ?>
                                                                <a class="btn btn-mokko btn--lg btn--primary" href="<?php echo $item['content_link']['url']?>" <?php echo $target; echo $nofollow; ?>>
                                                                    <div class="ms-btn__text">
                                                                        <?php echo $item['btn_text']; ?>
                                                                    </div>
                                                                </a>
                                                            <?php endif; ?>

                                                        </div>

                                                    <?php endif; ?>
                                                    
                                                    <div class="ms-slider--overlay"></div>
                                                </div>
                                            </div>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                    <?php if ( !empty( $item[ 'content_template' ] ) ) : ?>
                                        <div class="ms-slider--cont ms-material-label swiper-material-animate-opacity" data-swiper-parallax="<?php echo $data_parallax_content;?>">
                                            <?php
                                                if ( 'publish' !== get_post_status( $item[ 'content_template' ] ) ) {
                                                    return;
                                                }
                                                echo Plugin::instance()->frontend->get_builder_content_for_display( $item[ 'content_template' ], true );
                                            ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php endforeach; ?>

                        </div>

                        <?php if ( $settings['nav_show'] == 'show' || $settings['nav_show'] == 'hover' ) : ?>
                            <div class="ms-nav--next swiper-button-next <?php echo $settings[ 'nav_size' ]; ?>"></div>
                            <div class="ms-nav--prev swiper-button-prev <?php echo $settings[ 'nav_size' ]; ?>"></div>
                        <?php endif; ?>

                        <?php if ( $settings['scrollbar'] == 'on' ) : ?>
                        <div class="swiper-scrollbar" 
                        data-position="<?php echo $settings['scrollbar_position']; ?>" 
                        data-dragable="<?php echo $settings['scrollbar_drag']; ?>" 
                        data-interaction="<?php echo $settings['scrollbar_hide']; ?>"></div>
                        <?php endif; ?>
                        
                    </div>

                </div>

            <?php break;

            case 'material' : ?>

                <?php
                    if (isset($settings['slidesPerView_tablet']['size'])) {
                        $spv_t = $settings['slidesPerView_tablet']['size'];
                    } else {
                        $spv_t = '1';
                    }
                    if (isset($settings['slidesPerView_mobile']['size'])) {
                        $spv_m = $settings['slidesPerView_mobile']['size'];
                    } else {
                        $spv_m = '1';
                    }
                    if (isset($settings['spaceBetween_tablet']['size'])) {
                        $sbt_t = $settings['spaceBetween_tablet']['size'];
                    } else {
                        $sbt_t = '0';
                    }
                    if (isset($settings['spaceBetween_mobile']['size'])) {
                        $sbt_m = $settings['spaceBetween_mobile']['size'];
                    } else {
                        $sbt_m = '0';
                    }
                    if ($settings['content_animate'] === 'swiper-material-animate-scale') {
                        $splitting_anim = ' data-splitting';
                    } else {
                        $splitting_anim = '';
                    }
                ?>

                <?php $this->add_render_attribute( 'slider-wrap', [
                    'class' => [ 'swiper ms-slider-material' ],
                    'data-autoplay' => $settings['autoplay'],
                    'data-centered' => $settings['centered'],
                    'data-mousewheel' => $settings['mousewheel'],
                    'data-simulatetouch' => $settings['simulatetouch'],
                    'data-centered' => $settings['centered'],
                    'data-speed' => $settings['speed'],
                    'data-direction' => 'horizontal',
                    'data-effect' => 'material',
                    'data-modules' => 'EffectMaterial',
                    'data-autoplay' => $settings['autoplay'],
                    'data-delay' => $settings['delay'],
                    'data-spv' => $settings['slidesPerView']['size'],
                    'data-spv-t' => $spv_t,
                    'data-spv-m' => $spv_m,
                    'data-loop' => $settings['loop'],
                    'data-space' => $settings['spaceBetween']['size'],
                    'data-space-t' => $sbt_t,
                    'data-space-m' => $sbt_m,
                    'data-nav' => $settings['nav_show'],
                ] ); ?>
                <div class="ms-slider material-slider">

                    <div <?php echo $this->get_render_attribute_string( 'slider-wrap' ); ?>>

                        <div class="swiper-wrapper">

                            <?php foreach ( $settings[ 'slider_fs' ] as $index => $item ) : ?>
        
                                <div class="swiper-slide">
                                    
                                    <div class="swiper-material-wrapper">
        
                                        <div class="swiper-material-content">

                                            <?php if ( $item['slide_type'] == 'image' ) : ?>
                                                <img class="ms-material-image" data-swiper-material-scale="<?php echo $settings['material_scale']; ?>" src="<?php echo $item['slide_img']['url']; ?>" />
                                            <?php endif; ?> 

                                            <?php if ($item['slide_type'] == 'video') : ?>

                                            <div class="ms-slider--video">

                                                <?php if ( $item['slide_video_type'] === 'youtube') : ?>
                                                    <div data-vbg-mobile="true" data-swiper-material-scale="<?php echo $settings['material_scale']; ?>" data-vbg-start-at="<?php echo $item['video_start']; ?>" data-vbg-end-at="<?php echo $item['video_end']; ?>" data-vbg="<?php echo $item['youtube_url']; ?>"></div>
                                                <?php endif; ?>

                                                <?php if ( $item['slide_video_type'] === 'vimeo') : ?>
                                                    <div data-vbg-mobile="true" data-swiper-material-scale="<?php echo $settings['material_scale']; ?>" data-vbg-start-at="<?php echo $item['video_start']; ?>" data-vbg="<?php echo $item['vimeo_url']; ?>"></div>
                                                <?php endif; ?>

                                                <?php if ( $item['slide_video_type'] === 'hosted') : ?>
                                                    <div data-vbg-mobile="true" data-swiper-material-scale="<?php echo $settings['material_scale']; ?>" video-background-mute data-vbg="<?php echo $item['hosted_url']['url']; ?>"></div>
                                                <?php endif; ?>

                                            </div>

                                            <?php endif; ?>

                                            <?php if ( !empty( $item[ 'content_template' ] ) ) : ?>
                                                <div class="ms-slider--cont ms-material-label swiper-material-animate-opacity" data-swiper-parallax="<?php echo $data_parallax_content;?>">
                                                    <?php
                                                        if ( 'publish' !== get_post_status( $item[ 'content_template' ] ) ) {
                                                            return;
                                                        }
                                                        echo Plugin::instance()->frontend->get_builder_content_for_display( $item[ 'content_template' ], true );
                                                    ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ( $item[ 'content_select' ] == 'default' ) : ?>
                                                <?php if ( !empty( $item[ 'content_select' ] ) ) : ?>
                                                    <div class="ms-slider--cont ms-material-label <?php echo $settings['content_animate']?>">
                                                        <div class="ms-cont__inner <?php echo $settings['subtitle_position'];?>">

                                                            <?php if ( $item['content_title'] ) : ?>
                                                                <h1 class="ms-sc--t"<?php echo $splitting_anim;?>><?php echo wp_kses_post($item['content_title']); ?></h1>
                                                            <?php endif; ?>

                                                            <?php if ( $item['slide_desc'] ) : ?>
                                                                <p class="ms-sc--text"<?php echo $splitting_anim;?>><?php echo wp_kses_post($item['slide_desc']); ?></p>
                                                            <?php endif; ?>

                                                        </div>
                                                    </div>
                                                    <div class="ms-slider--overlay"></div>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </div>
        
                                    </div>
        
                                </div>

                            <?php endforeach; ?>

                        </div>

                        <?php if ( $settings['nav_show'] == 'show' || $settings['nav_show'] == 'hover' ) : ?>
                            <div class="ms-nav--next swiper-button-next <?php echo $settings[ 'nav_size' ]; ?>"></div>
                            <div class="ms-nav--prev swiper-button-prev <?php echo $settings[ 'nav_size' ]; ?>"></div>
                        <?php endif; ?>

                        <?php if ( $settings['scrollbar'] == 'on' ) : ?>
                        <div class="swiper-scrollbar" 
                        data-position="<?php echo $settings['scrollbar_position']; ?>" 
                        data-dragable="<?php echo $settings['scrollbar_drag']; ?>" 
                        data-interaction="<?php echo $settings['scrollbar_hide']; ?>"></div>
                        <?php endif; ?>

                    </div>

                </div>
            <?php break;

            case 'triple' :

                if (isset($settings['slidesPerView_tablet']['size'])) {
                    $spv_t = $settings['slidesPerView_tablet']['size'];
                } else {
                    $spv_t = '1';
                }
                if (isset($settings['slidesPerView_mobile']['size'])) {
                    $spv_m = $settings['slidesPerView_mobile']['size'];
                } else {
                    $spv_m = '1';
                }
                if (isset($settings['spaceBetween_tablet']['size'])) {
                    $sbt_t = $settings['spaceBetween_tablet']['size'];
                } else {
                    $sbt_t = '0';
                }
                if (isset($settings['spaceBetween_mobile']['size'])) {
                    $sbt_m = $settings['spaceBetween_mobile']['size'];
                } else {
                    $sbt_m = '0';
                }
                if (isset($settings['spaceBetween']['size'])) {
                    // null
                } else {
                    $sbt = '0';
                }
                ?>

                <?php $this->add_render_attribute( 'slider-wrap', [
                    'class' => [ 'swiper ms-slider-triple' ],
                    'data-autoplay' => $settings['autoplay'],
                    'data-centered' => $settings['centered'],
                    'data-mousewheel' => $settings['mousewheel'],
                    'data-simulatetouch' => $settings['simulatetouch'],
                    'data-centered' => $settings['centered'],
                    'data-speed' => $settings['speed'],
                    'data-direction' => 'horizontal',
                    'data-effect' => 'triple',
                    'data-modules' => 'EffectMaterial',
                    'data-spv-t' => $spv_t,
                    'data-spv-m' => $spv_m,
                    'data-loop' => $settings['loop'],
                    'data-space' => $sbt,
                    'data-space-t' => $sbt_t,
                    'data-space-m' => $sbt_m,
                ] ); ?>

                <div class="ms-slider triple-slider">

                    <div <?php echo $this->get_render_attribute_string( 'slider-wrap' ); ?>>
                    
                        <div class="swiper-wrapper">

                            <?php foreach ( $settings[ 'slider_fs' ] as $index => $item ) : ?>

                                <div class="swiper-slide">

                                    <?php if ( $item['slide_type'] == 'image' ) : ?>
                                        <img class="bg-image" src="<?php echo $item['slide_img']['url']; ?>" alt="">
                                    <?php endif; ?>

                                    <?php if ( !empty( $item[ 'content_template' ] ) ) : ?>
                                        <div class="ms-slider--cont ms-material-label swiper-material-animate-opacity" data-swiper-parallax="<?php echo $data_parallax_content;?>">
                                            <?php
                                                if ( 'publish' !== get_post_status( $item[ 'content_template' ] ) ) {
                                                    return;
                                                }
                                                echo Plugin::instance()->frontend->get_builder_content_for_display( $item[ 'content_template' ], true );
                                            ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( $item[ 'content_select' ] == 'default' ) : ?>

                                        <?php if ( !empty( $item[ 'content_select' ] ) ) : ?>

                                            <div class="ms-slider--cont ms-material-label swiper-material-animate-opacity" data-swiper-parallax-x="30%">
                                                <div class="ms-cont__inner">

                                                    <?php if ( $item['content_title'] ) : ?>
                                                        <h1 class="ms-sc--t"><?php echo wp_kses_post($item['content_title']); ?></h1>
                                                    <?php endif; ?>

                                                    <div class="ms-slider--overlay"></div>
                                                </div>
                                            </div>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                </div>

                            <?php endforeach; ?>
                            
                        </div>

                    </div>

                </div>

            <?php break;

        } ?>


		<?php if ( Plugin::$instance->editor->is_edit_mode() ) : ?>
			<script>			
                jQuery('[data-vbg]').youtube_background();
			</script>
		<?php endif;
    }

}