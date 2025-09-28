<?php

/**
 * @author: Mad Sparrow
 * @version: 1.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_MS_Projects extends Widget_Base {

	use \MS_Elementor\Traits\Helper;

	public function get_name() {
		return 'ms_projects';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'madsparrow' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid ms-badge';
	}

	public function get_categories() {
		return [ 'ms-elements' ];
	}

	public function get_keywords() {
		return [ 'projects', 'works', 'grid', 'showcase', 'portfolio' ];
	}

	protected function register_controls() {

		$first_level = 0;

		// TAB CONTENT
		$this->start_controls_section(
			'section_' . $first_level++, [
				'label' => esc_html__( 'Portfolio', 'madsparrow' ),
			]
		);

		$this->add_control(
			'layout_options', [
				'label' => __( 'Layout', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'protfolio_style', [
				'label' => esc_html__( 'Grid', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Grid', 'madsparrow' ),
					'grid_2' => esc_html__( 'Grid 2', 'madsparrow' ),
					'masonry' => esc_html__( 'Masonry', 'madsparrow' ),
				],
			]
		);

		$this->add_control(
			'columns', [
				'label' => __( 'Columns', 'madsparrow' ),
				'description' => __( 'Min 1, Max 6', 'madsparrow' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'protfolio_style!' => ['grid_2'],
				],
			]
		);

		$this->add_responsive_control(
			'gutter', [
				'label' => __( 'Gutters', 'madsparrow' ),
				'description' => __( 'Gutters are the padding between your columns, used to responsively space and align content in the Bootstrap grid system.', 'madsparrow' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'pt', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 90,
						'step' => 1,
					],
					'rem' => [
						'min' => 0,
						'max' => 8,
						'step' => 0.1,
					],
					'%' => [
						'min' => 0,
						'max' => 15,
					],
					'vh' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'rem',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .row' => '--bs-gutter-x: {{SIZE}}{{UNIT}};--bs-gutter-y: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [
					'protfolio_style!' => ['masonry_2'],
				],
			]
		);

		$this->add_control(
			'order_opt', [
				'label' => __( 'Order', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_by', [
				'label' => esc_html__( 'Show By', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'show_all',
				'options' => [
					'show_all' => esc_html__( 'Show All', 'madsparrow' ),
					'show_by_id' => esc_html__( 'Show By ID', 'madsparrow' ),
					'show_by_cat' => esc_html__( 'Show By Category', 'madsparrow' ),
				],
			]
		);

		$this->add_control(
			'post_id', [
				'label' => esc_html__( 'Select Post', 'madsparrow' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->ms_get_post_name( 'portfolios' ),
				'condition' => [
					'show_by' => 'show_by_id',
				],
			]
		);

		$this->add_control(
			'post_cat', [
				'label' => esc_html__( 'Select Category', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->ms_get_p_taxonomies( 'portfolios_categories' ),
				'condition' => [
					'show_by' => 'show_by_cat',
				],
			]
		);

		$this->add_control(
			'posts_opt', [
				'label' => __( 'Posts per page', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'max_posts', [
				'label' => esc_html__( 'Show at most', 'madsparrow' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 9,
			]
		);

		$this->add_control(
			'pagination_opt', [
				'label' => __( 'Pagination', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'show_pagination', [
				'label' => esc_html__( 'Show', 'madsparrow' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'text_pagination', [
				'label' => esc_html__( 'Title', 'madsparrow' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Load More', 'madsparrow' ),
				'placeholder' => esc_html__( 'Type your title here', 'madsparrow' ),
				'condition' => [
					'show_pagination' => 'yes',
				],
			]
		);

		$this->add_control(
			'pag_align', [
				'label' => __( 'Alignment', 'madsparrow' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'madsparrow' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'madsparrow' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'madsparrow' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'condition' => [
					'show_pagination' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio_wrap .ajax-area' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_opt', [
				'label' => __( 'Filtering', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'show_filter', [
				'label' => esc_html__( 'Show', 'madsparrow' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'filter_align', [
				'label' => __( 'Alignment', 'madsparrow' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start;' => [
						'title' => __( 'Left', 'madsparrow' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'madsparrow' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'madsparrow' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'flex-start',
				'toggle' => true,
				'condition' => [
					'show_filter' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio_wrap .subnav' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// TAB CONTENT
		$this->start_controls_section(
			'section_' . $first_level++, [
				'label' => esc_html__( 'Style', 'madsparrow' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'carousel_title_typography',
				'label' => __( 'Typography', 'madsparrow' ),
				'selector' => '{{WRAPPER}} .ms-carousel-showcase .ms-p-content h1',
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'carousel_title_color', [
				'label' => __( 'Title', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ms-carousel-showcase .ms-p-content h1' => 'color: {{VALUE}}'
				],
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'carousel_bullet_color', [
				'label' => __( 'Bullet', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'var(--color-primary)',
				'selectors' => [
					'{{WRAPPER}} .ms-carousel-showcase .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}'
				],
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'carousel_bg_color', [
				'label' => __( 'Background', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1E2125',
				'selectors' => [
					'{{WRAPPER}} .ms-carousel-showcase' => 'background-color: {{VALUE}}'
				],
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);

		$this->end_controls_section();

		// TAB CONTENT
 		$this->start_controls_section(
			'section_' . $first_level++, [
				'label' => esc_html__( 'Thumbnail', 'madsparrow' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumb_options', [
				'label' => __( 'Thumbnail', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'protfolio_style!' => [ 'grid_2', 'masonry' ],
				],
			]
		);

		$this->add_control(
			'thumb_ratio', [
				'label' => __( 'Ratio', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => '16/9',
				'options' => [
					'1/1' => esc_html__( '1:1', 'madsparrow' ),
					'4/3' => esc_html__( '4:3', 'madsparrow' ),
					'3/2' => esc_html__( '3:2', 'madsparrow' ),
					'3/4' => esc_html__( '3:4', 'madsparrow' ),
					'9/16' => esc_html__( '9:16', 'madsparrow' ),
					'16/9' => esc_html__( '16:9', 'madsparrow' ),
					'16/10' => esc_html__( '16:10', 'madsparrow' ),
					'21/9' => esc_html__( '21:9', 'madsparrow' ),
				],
                'selectors' => [
                    '{{WRAPPER}} .custom-ratio.grid-item-p,'  => 'aspect-ratio: {{TOP}}',
                    '{{WRAPPER}} .custom-ratio.grid-item-p figure.ms-p-img img, .custom-ratio.grid-item-p .ms-vp__poster img'  => 'aspect-ratio: {{TOP}}',
                    '{{WRAPPER}} .custom-ratio.grid-item-p .ms-p-video'  => 'aspect-ratio: {{TOP}}',
                    '{{WRAPPER}} .custom-ratio.grid-item-p .ms-p-img'  => 'aspect-ratio: {{TOP}}',
                ],
				'condition' => [
					'protfolio_style!' => [ 'grid_2', 'masonry' ],
				],
			]
		);

        $this->add_control(
			'thumb_parallax', [
				'label' => esc_html__( 'Parallax Effect', 'madsparrow' ),
				'type' => Controls_Manager::SWITCHER,
                'description' => __( 'Works only when smooth scrolling is enabled', 'madsparrow' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
					'protfolio_style!' => [ 'masonry' ],
				],
			]
		);

        $this->add_control(
			'thumb_video', [
				'label' => esc_html__( 'Auto-play video', 'madsparrow' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'parallax_speed', [
				'label' => __( 'Parallax Speed', 'madsparrow' ),
				'description' => __( 'Min -1, Max 1', 'madsparrow' ),
				'type' => Controls_Manager::NUMBER,
				'min' => -1,
				'max' => 1,
				'step' => 0.1,
				'default' => 0.4,
				'condition' => [
					'thumb_parallax' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'border',
				'label' => __( 'Border', 'madsparrow' ),
				'selector' => '{{WRAPPER}} .item--inner figure',
			]
		);

        $this->add_control(
			'border_radius', [
				'label' => __( 'Radius', 'madsparrow' ),
                'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [ 
					'{{WRAPPER}} .portfolio-feed .item--inner figure' => 'border-top-left-radius: {{TOP}}{{UNIT}} {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}} {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}} {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}} {{LEFT}}{{UNIT}};', 
					'{{WRAPPER}} .portfolio-feed .item--inner .ms-p-video' => 'border-top-left-radius: {{TOP}}{{UNIT}} {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}} {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}} {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}} {{LEFT}}{{UNIT}};', 
					'{{WRAPPER}} .portfolio-feed.ms-p--g2  .item--inner .ms-p-video video' => 'border-top-left-radius: {{TOP}}{{UNIT}} {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}} {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}} {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}} {{LEFT}}{{UNIT}};', 
				],
			]
		);

		$this->add_control(
			'h_effect', [
				'label' => __( 'Image Hover Effect', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'hover_cursor_effect', [
				'label' => __( 'Cursor', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'madsparrow' ),
					'custom' => esc_html__( 'Custom', 'madsparrow' ),
				],
			]
		);

		$this->add_control(
            'cursor_text', [
                'label' => __( 'Cursor Text', 'madsparrow' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your text', 'madsparrow' ),
				'default' => 'View',
                'condition' => [
                    'hover_cursor_effect' => 'custom',
                ],
            ]
        );

		$this->end_controls_section();

		// TAB CONTENT
 		$this->start_controls_section(
			'section_' . $first_level++, [
				'label' => esc_html__( 'Text', 'madsparrow' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'text_style', [
				'label' => __( 'Style', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'below',
				'options' => [
					'above' => esc_html__( 'Above', 'madsparrow' ),
					'below' => esc_html__( 'Below', 'madsparrow' ),
					'overlay' => esc_html__( 'Overlay', 'madsparrow' ),
					'boxed' => esc_html__( 'Boxed', 'madsparrow' ),
					'fadein' => esc_html__( 'FadeIn', 'madsparrow' ),
					'mokko' => esc_html__( 'Mokko Style', 'madsparrow' ),
				],
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'category_position', [
				'label' => __( 'Category Text Position', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'top' => esc_html__( 'Top', 'madsparrow' ),
					'right' => esc_html__( 'Right', 'madsparrow' ),
					'bottom' => esc_html__( 'Bottom', 'madsparrow' ),
				],
                'condition' => [
					'text_style!' => 'mokko',
				],
			]
		);

        $this->add_control(
			'boxed_bg', [
				'label' => __( 'Content Background Color', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ms-p-content' => 'background-color: {{VALUE}}',
				],
                'condition' => [
					'text_style' => 'boxed',
				],
			]
		);

        $this->add_control(
            'border_radius_boxed', [
                'label' => __( 'Radius', 'madsparrow' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .ms-p-content' => 'border-top-left-radius: {{TOP}}{{UNIT}} {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}} {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}} {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}} {{LEFT}}{{UNIT}};', 
                ],
                'condition' => [
                    'text_style' => 'boxed',
                ],
            ]
        );

        $this->add_responsive_control(
			'padding_content', [
				'label' => esc_html__( 'Padding', 'madsparrow' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'pt', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ms-p-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator' => 'after',
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

        $this->add_responsive_control(
			'content_indent_bottom', [
				'label' => __( 'Text Indent', 'madsparrow' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'pt', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 90,
						'step' => 1,
					],
					'rem' => [
						'min' => 0,
						'max' => 8,
						'step' => 0.1,
					],
					'%' => [
						'min' => 0,
						'max' => 15,
                        'step' => 1,
					],
					'vh' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ms-p-content__inner.bottom h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
					'category_position' => 'bottom',
				],
			]
		);

        $this->add_responsive_control(
			'content_indent_top', [
				'label' => __( 'Text Indent', 'madsparrow' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'pt', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 90,
						'step' => 1,
					],
					'rem' => [
						'min' => 0,
						'max' => 8,
						'step' => 0.1,
					],
					'%' => [
						'min' => 0,
						'max' => 15,
                        'step' => 1,
					],
					'vh' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ms-p-content__inner.top h3' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
					'category_position' => 'top',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'title_typography',
				'label' => __( 'Typography Title', 'madsparrow' ),
				'selector' => '{{WRAPPER}} .portfolio_wrap .portfolio-feed .ms-p-content h3',
				'size_units' => [ 'px', '%', 'em', 'pt', 'custom' ],
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'title_color', [
				'label' => __( 'Title Text Color', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ms-p-content h3' => 'color: {{VALUE}} !important',
				],
			]
		);

        $this->add_control(
			'title_bg', [
				'label' => __( 'Title Background Color', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ms-p-content .ms-p-content__inner h3::after' => 'background-color: {{VALUE}}',
				],
                'condition' => [
					'text_style' => ['mokko'],
				],
			]
		);

		$this->add_control(
			'show_cat', [
				'label' => esc_html__( 'Category', 'madsparrow' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'condition' => [
					'text_style!' => ['mokko'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'cat_typography',
				'label' => __( 'Typography Category', 'madsparrow' ),
				'selector' => '{{WRAPPER}} .ms-p-content .ms-p-cat',
				'condition' => [
					'show_cat' => 'yes',
					'text_style!' => ['mokko'],
				],
			]
		);

		$this->add_control(
			'category_color', [
				'label' => __( 'Category Text Color', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio_wrap .portfolio-feed .item--inner .ms-p-content .ms-p-cat' => 'color: {{VALUE}}',
				],
                'condition' => [
					'text_style!' => ['mokko'],
				],
			]
		);

		$this->add_control(
			'overlay_color', [
				'label' => __( 'Color Overlay', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,.4)',
				'selectors' => [
					'{{WRAPPER}} .overlay .item--inner figure::after' => 'background-color: {{VALUE}}', '{{WRAPPER}} .fadein .item--inner figure::after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .mokko .item--inner figure::after' => 'background-color: {{VALUE}}', '{{WRAPPER}} .fadein .item--inner figure::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'text_style' => ['overlay', 'fadein', 'mokko'],
				],
			]
		);

		$this->add_control(
			'text_align', [
				'label' => __( 'Text Alignment', 'madsparrow' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'madsparrow' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'madsparrow' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'madsparrow' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ms-p-content' => 'text-align: {{VALUE}}',
				],
				'default' => 'left',
				'toggle' => true,
                'condition' => [
					'category_position' => ['top', 'bottom'],
				],
			]
		);

        $this->add_responsive_control(
            'justify_content', [
				'label' => __( 'Justify Content', 'madsparrow' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'madsparrow' ),
						'icon' => 'eicon-flex eicon-justify-start-v',
					],
					'center' => [
						'title' => __( 'Center', 'madsparrow' ),
						'icon' => 'eicon-flex eicon-justify-center-v',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'madsparrow' ),
						'icon' => 'eicon-flex eicon-justify-end-v',
					],
				],
				'default' => 'top',
				'toggle' => true,
                'condition' => [
                    'text_style!' => 'boxed',
                ],
			]  
        );

		$this->end_controls_section();

	}


	protected function render() {

		$settings = $this->get_settings_for_display();
		
		$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
		$items = $settings[ 'max_posts' ];
		$item_inner = 'item--inner';
		$p_item_class = $settings[ 'text_style' ];
		$p_item_class .= ' ' . (isset($settings['text_align']) ? $settings['text_align'] : '');
		$p_item_class .= ' grid-item-p';
		$btntext = $settings['text_pagination'];
        $justify_content = $settings['justify_content'];

        // Options
		if ( $settings[ 'columns' ] ) {
			$col_numb = '12' / $settings[ 'columns' ];
		}

        if ( $settings[ 'protfolio_style' ] !== 'grid_2' ) {
            $ratio_class = 'custom-ratio';
        } else {
            $ratio_class = '';
        }

        $p_item_class .= ' ' . $ratio_class;

        if ( $settings[ 'hover_cursor_effect' ] == 'custom' ) {
            $hover_cursor = ' data-cursor="custom"';
        } else {
            $hover_cursor = '';
        }

        if ( $settings[ 'cursor_text' ] ) {
            $cursor_text = ' data-hover-text="' . $settings[ 'cursor_text' ] .'"';
        } else {
            $cursor_text = '';
        }

        if ( $settings['thumb_parallax'] === 'yes' ) {
            $s_multipler = '10';
            $tpe_s = $settings['parallax_speed'] / $s_multipler;
            $tpe = 'data-scroll data-scroll-speed="' . $tpe_s . '"';
            if ( 0 > $tpe_s) {
                $p_d = ' p_b';
            } else {
                $p_d = ' p_t';
            }
            $tpe_c = ' parallax' . $p_d;            
        } else {
            $tpe = '';
            $tpe_c = '';
            $tpe_s = '';
        }

		// Portfolio Style
		switch ( $settings[ 'protfolio_style' ] ) {

			case 'default':
				$layout = ' ms-p--d row';
				$col = ' col-md-' . $col_numb;
			break;

			case 'grid_2':
				$layout = ' ms-p--g2 row';
				$col = '';
				$i = 0;
			break;

			case 'masonry':
				$layout = ' ms-p--m grid-content';
				$col = ' col-md-' . $col_numb;
			break;

		}
        
		// Order
		switch ( $settings[ 'show_by' ] ) {

			case 'show_all':
                
				$post_id = '';
				$terms = get_terms('portfolios_categories');
				$cat = mokko_filter_category();
				$p_query = mokko_portfolio_loop($cat, $items, $post_id);
				$terms = get_terms('portfolios_categories');
				mokko_infinity_load( $p_query );
				if (sizeof($terms) >= 2) {
					$show_filter = 'on';
				} else {
					$show_filter = '';
				}
                
			break;

			case 'show_by_id':
				$cat_id = $settings[ 'post_id' ];
				$fargs = array(
					'post_type' => 'portfolios',
					'posts_per_page' => '-1',
					'post__in' => $settings[ 'post_id' ],
					'post_status' => 'publish',
				);

				$f_query = new \WP_Query( $fargs );

				if ( $f_query->have_posts() ) :
					$show_cat = array();
					while ( $f_query->have_posts() ) : $f_query->the_post();
						$album_cat = mokko_work_category(get_the_ID());
						$string = str_replace('-', ' ', $album_cat);
						$album_cat = esc_html($string); 
						$show_cat[] = $album_cat;
					endwhile;
				endif;

				if (!empty($show_cat)) {
					$terms = array_unique( $show_cat );
					if (sizeof($terms) > 0) {
						$show_filter = 'on';
					}
				} else {
					$terms = '';
				}

				$post_id = $cat_id;
				$cat = mokko_filter_category();
				$p_query = mokko_portfolio_loop($cat, $items, $post_id);
				mokko_infinity_load( $p_query );
				if (sizeof($terms) > 1) {
					$show_filter = 'on';
				}

			break;

			case 'show_by_cat':
				$get_posts_categories = $settings[ 'post_cat' ];
				$terms = $get_posts_categories;
				$cat = $get_posts_categories;
				$post_id = '';
				$p_query = mokko_portfolio_loop($cat, $items, $post_id);
				mokko_infinity_load($p_query);
				echo the_category();
				$show_filter = 'off';
			break;

		} ?>

		<div class="portfolio_wrap" id="<?php echo $this->get_id(); ?>">

        <?php if ( $settings['text_style'] == 'mokko' ) : ?>
            <svg style="visibility: hidden; position: absolute;" width="0" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1">
                <defs>
                    <filter id="goo"><feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />    
                        <feColorMatrix in="blur" type="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                        <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
                    </filter>
                </defs>
            </svg>
        <?php endif; ?>

        <?php if (!class_exists('ACF')) : ?>
            
            <p><?php esc_html_e( 'Please, install or activate: ', 'mokko' ); ?><a href="<?php echo get_dashboard_url() . 'plugins.php'; ?>">ACF Pro plugin.</a></p>
            
        <?php else : 

            if ( $settings['protfolio_style'] !== 'carousel' ) :?>
                <?php $load_btn = '';?>
                <?php if ( $settings['show_filter'] == 'yes') :
                    if ( $show_filter == 'on') :
                        if ( $terms && !is_wp_error( $terms ) ): ?>
                            <div class="subnav">
                                <div class="subnav__container">
                                    <div class="filter-nav filter-nav--expanded js-filter-nav">
                                    <button class="reset btn--subtle is-hidden js-filter-nav__control" aria-label="<?php esc_attr_e('Select a filter option', 'mokko'); ?>" aria-controls="filter-nav">
                                        <span class="js-filter-nav__placeholder" aria-hidden="true"><?php esc_html_e('All', 'mokko'); ?></span>
                                        <svg class="icon icon--xxs margin-left-xxs" aria-hidden="true" viewBox="0 0 12 12"><polyline points="0.5 3.5 6 9.5 11.5 3.5" fill="none" stroke-width="1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></polyline></svg>
                                    </button>
                                    <div class="filter-nav__wrapper js-filter-nav__wrapper" id="filter-nav">
                                    <nav class="filter-nav__nav js-filter-nav__nav">
                                        <ul class="filtr-btn filter-nav__list js-filter-nav__list">
                                            <li class="filter-nav__item subnav__link active" data-filter="">
                                                <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" aria-current="true" ><?php esc_html_e('All Categories', 'mokko'); ?></button>
                                            </li>
                                            <?php foreach ( $terms as $term ) { ?>
                                                <?php if ( $settings[ 'show_by' ] == 'show_by_id' || $settings[ 'show_by' ] == 'show_by_cat') : ?>
                                                    <li class="filter-nav__item subnav__link" data-filter="<?php echo esc_attr($term); ?>">
                                                        <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" ><?php echo esc_html($term); ?></button>
                                                    </li>
                                                <?php else: ?>
                                                    <li class="filter-nav__item subnav__link" data-filter="<?php echo esc_attr($term->slug); ?>">
                                                        <button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" ><?php echo esc_html($term->name); ?></button>
                                                    </li>
                                                <?php endif; ?>
                                            <?php } ?>
                                            <li class="filter-nav__marker js-filter-nav__marker" aria-hidden="true"></li>
                                        </ul>
                                    <button class="reset filter-nav__close-btn is-hidden js-filter-nav__close-btn js-tab-focus" aria-label="Close navigation">
                                        <svg class="icon" viewBox="0 0 14 14" aria-hidden="true"><g stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"><line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line><line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line></g></svg>
                                    </button>
                                    </nav>
                                </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                    <?php endif;?>
                <?php endif;?>

                <div class="portfolio-feed<?php echo $layout; ?>" <?php echo $hover_cursor; ?> <?php echo $cursor_text; ?>>
                    <span class="load_filter">
                        <svg class="load-filter-icon" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                            <circle cx="50" cy="50" r="30" stroke-width="6" stroke-linecap="round" fill="none">
                                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1"></animateTransform>
                                <animate attributeName="stroke-dasharray" repeatCount="indefinite" dur="1s" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1"></animate>
                            </circle>
                        </svg>
                    </span>

                    <?php if ( $settings[ 'protfolio_style' ] === 'masonry' ) : ?>
                        <div class="row ms-masonry-gallery">
                    <?php endif; ?>

                    
                    <?php if ( $p_query->have_posts() ) : while ( $p_query->have_posts() ) : $p_query->the_post();
                        $string = str_replace('-', ' ', mokko_work_category(get_the_ID())); 
                        $album_cat = esc_html($string); 
                        $show_cat[] = $album_cat;

                        if ( $settings[ 'protfolio_style' ] == 'grid_2' ) {
                            if( $i%3 == 0 ) {
                                $col = ' col-md-6';
                            } else {
                                $col = ' col-md-6';
                            }
                            if( $i == 3 ) {	$i = 0; } else { ++$i; }
                        } ?>
                        
                        <div <?php post_class( $p_item_class . $col ); ?>>

                            <div class="<?php echo mokko_sanitize_class( $item_inner ); ?>">

                                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">

                                    <?php if ( $settings[ 'hover_cursor_effect' ] !== 'custom') : ?>
                                        <div class="ms-p-arrow">
                                            <svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewBox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( get_field('featured_video') ): ?>
                                        <div class="ms-p-video<?php echo $tpe_c . ' cursor-' . $settings[ 'hover_cursor_effect' ];?>">
                                            
                                            <?php if ($settings['thumb_video'] == 'yes') {
                                                $autoplay = ' autoplay';
                                            } else {
                                                $autoplay = '';
                                                if( has_post_thumbnail() ):?>
                                                    <figure class="ms-vp__poster<?php echo $tpe_c; ?>"  style='--speed:<?php echo $tpe_s; ?>'>
                                                        <img <?php echo $tpe; ?> src="<?php the_post_thumbnail_url($size = 'mokko-portfolio-thumb'); ?>" alt="<?php the_title_attribute(); ?>">
                                                    </figure>
                                                <?php endif;
                                            } ?>

                                            <video loop muted<?php echo $autoplay; ?> <?php echo $tpe; echo $tpe_s_css; ?> style='--speed:<?php echo $tpe_s; ?>'>
                                                <source src="<?php echo get_field('featured_video'); ?>"/>
                                            </video>
                                        </div>
                                    <?php else: ?>

                                        <?php if( has_post_thumbnail() ):?>
                                            <figure class="ms-p-img<?php ; echo $tpe_c; echo ' cursor-' . $settings[ 'hover_cursor_effect' ];?>" style='--speed:<?php echo $tpe_s; ?>'>
                                                <img <?php echo $tpe; ?> src="<?php the_post_thumbnail_url($size = 'mokko-portfolio-thumb'); ?>" alt="<?php the_title_attribute(); ?>">
                                            </figure>
                                        <?php endif; ?>

                                    <?php endif; ?>

                                    <div class="ms-p-content justify-<?php echo $justify_content?><?php echo ' cursor-' . $settings[ 'hover_cursor_effect' ];?>">
                                        <div class="ms-p-content__inner <?php echo $settings['category_position']; ?>">
                                            <h3><?php the_title(); ?></h3>
                                            <?php if ( $settings['show_cat'] === 'yes' && $settings['text_style'] !== 'mokko') : ?>
                                                <span class="ms-p-cat"><?php echo esc_html($album_cat); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                </a>

                            </div>

                        </div>
                    <?php endwhile; endif; wp_reset_postdata(); wp_reset_query(); ?>
                    <div class="grid-sizer<?php echo $col?>"></div>
                    
                    <?php if ( $settings[ 'protfolio_style' ] === 'masonry' ) : ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $settings[ 'text_style' ] === 'mokko' ) : ?>
                        <svg style="visibility: hidden; position: absolute;" width="0" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1">
                            <defs>
                                <filter id="goo2"><feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />    
                                    <feColorMatrix in="blur" type="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                                    <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
                                </filter>
                            </defs>
                        </svg>
                    <?php endif; ?>

                </div>

                <?php if ( $settings[ 'show_pagination' ] == 'yes' ) : ?>
                    <?php if ( $p_query->max_num_pages > 1 ) : ?>
                        <?php echo mokko_portfolio_pagination($p_query->max_num_pages, $btntext, $load_btn); ?>
                    <?php endif; ?>
                <?php endif; ?>

            <?php endif; ?>
            
        <?php endif; ?>
		</div>

		<?php if ( Plugin::$instance->editor->is_edit_mode() ) : ?>
			<script>			
				var grid = jQuery('.ms-masonry-gallery');
				grid.isotope();
				grid.imagesLoaded().progress( function() {
					grid.isotope('layout');
				});
			</script>
		<?php endif;	
	}

}