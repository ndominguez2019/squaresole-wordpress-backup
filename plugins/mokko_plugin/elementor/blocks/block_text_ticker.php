<?php

/**
 * @author: madsparrow
 * @version: 1.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_MS_Text_Ticker extends Widget_Base {

    public function get_name() {
        return 'ms_text_ticker';
    }

    public function get_title() {
        return esc_html__( 'Text Ticker', 'madsparrow' );
    }

    public function get_icon() {
        return 'eicon-animation-text ms-badge';
    }

    public function get_categories() {
        return [ 'ms-elements' ];
    }

    public function get_keywords() {
        return [ 'text', 'animation', 'ticker' ];
    }

    protected function register_controls() {

        $first_level = 0;

        $this->start_controls_section(
            'section_' . $first_level++, [
                'label' => esc_html__( 'Content', 'madsparrow' ),
            ]
        );

        $this->add_control(
            'text_ticker',[
                'label' => __( 'Text', 'madsparrow' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => __( 'Type your text here', 'madsparrow' ),
                'description' => __( 'You can use <strong>&#x3c;span&#x3e;</strong> tag to highlight specific words in text.', 'madsparrow' ),
                'default' => __( 'Type your text here', 'madsparrow' ),
            ]
        );

        $this->add_responsive_control(
            'indent_' . $first_level++, [
                'label' => __( 'Text Indent', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ms-tt-wrap .ms-tt' => 'gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ms-tt-wrap .ms-tt li:last-child' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'image',
			[
                'label' => __( 'Divider Image', 'madsparrow' ),
                'type' => Controls_Manager::MEDIA,
			]
		);

        $this->add_responsive_control(
            'height_' . $first_level++, [
                'label' => __( 'Image Size', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 640,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ms-tt__text.img' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // TAB CONTENT
        $this->start_controls_section(
            'section_' . $first_level++, [
                'label' => esc_html__( 'Style', 'madsparrow' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .ms-tt__text',
            ]
        );

        $this->add_control(
            'text_color', [
                'label' => esc_html__( 'Text Color', 'madsparrow' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ms-tt__text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => esc_html__( 'Background Color', 'madsparrow' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ms-tt-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'border',
                'label' => __( 'Border', 'madsparrow' ),
                'selector' => '{{WRAPPER}} .ms-tt-wrap',
            ]
        );

        $this->add_control(
            'scroll_dependency',
            [
                'label' => __( 'Scroll Dependency', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => __( 'It only works with the smooth scrolling option enabled', 'madsparrow' ),
                'label_on' => __( 'On', 'madsparrow' ),
                'label_off' => __( 'No', 'madsparrow' ),
                'return_value' => 'on',
                'default' => 'on',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => __( 'Direction', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'  => __( 'Right to Left', 'madsparrow' ),
                    'right' => __( 'Left to Right', 'madsparrow' ),
                ],
            ]
        );

        $this->add_control(
            'hover',
            [
                'label' => __( 'Hover Effect', 'madsparrow' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'  => __( 'None', 'madsparrow' ),
                    'stop' => __( 'Stop', 'madsparrow' ),
                    'slow_down' => __( 'Slow Down', 'madsparrow' ),
                ],
                'condition' => [
                    'scroll_dependency' => '',
                ],
            ]
        );

        $this->add_control(
            'speed', [
                'label' => __( 'Speed', 'madsparrow' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => .1,
                'default' => 1,
                'selectors' => [
                    '{{WRAPPER}} .ms-tt' => 'animation-duration: {{UNIT}}s;',
                ],
                'condition' => [
                    'scroll_dependency' => '',
                ],
            ]
        );
        
        $this->add_control(
            'scroll-speed', [
                'label' => __( 'Speed', 'madsparrow' ),
                'type' => Controls_Manager::NUMBER,
                'description' => __( 'Min: 1; Max: 15', 'madsparrow' ),
                'min' => 1,
                'max' => 15,
                'step' => .1,
                'default' => 1,
                'selectors' => [
                    '{{WRAPPER}} .ms-tt' => 'animation-duration: {{UNIT}}s;',
                ],
                'condition' => [
                    'scroll_dependency' => 'on',
                ],
            ]
        );

        $this->add_control(
            'text_stroke',
            [
                'label' => __( 'Stroke', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'madsparrow' ),
                'label_off' => __( 'No', 'madsparrow' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'stroke_color',
            [
                'label' => __( 'Stroke Color', 'madsparrow' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ms-tt__text' => '-webkit-text-stroke-color: {{VALUE}}',
                ],
                'condition' => [
                    'text_stroke' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'stroke_width', [
                'label' => __( 'Stroke Fill Width', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ms-tt__text' => ' -webkit-text-stroke-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'text_stroke' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_' . $first_level++, [
                'label' => __( 'Span Text', 'madsparrow' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography_span',
                'selector' => '{{WRAPPER}} .ms-tt__text span',
            ]
        );

        $this->add_control(
            'text_color_span', [
                'label' => esc_html__( 'Text Color', 'madsparrow' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ms-tt__text span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color_span', [
                'label' => esc_html__( 'Background Color', 'madsparrow' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ms-tt-wrap span' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'border_span',
                'label' => __( 'Border', 'madsparrow' ),
                'selector' => '{{WRAPPER}} .ms-tt-wrap span',
            ]
        );

        $this->add_control(
            'text_stroke_span',
            [
                'label' => __( 'Stroke', 'madsparrow' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'madsparrow' ),
                'label_off' => __( 'No', 'madsparrow' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'stroke_color_span',
            [
                'label' => __( 'Stroke Color', 'madsparrow' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ms-tt__text span' => '-webkit-text-stroke-color: {{VALUE}}',
                ],
                'condition' => [
                    'text_stroke_span' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'stroke_width_span', [
                'label' => __( 'Stroke Fill Width', 'madsparrow' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'default' => '1',
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ms-tt__text span' => ' -webkit-text-stroke-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'text_stroke_span' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( $settings['scroll_dependency'] ) {
            $s_d = 'on';
        } else {
            $s_d = 'off';
        }
        if ( $settings['scroll_dependency'] === 'on' ) {

            if ( $settings['direction'] === 'right' ) {
                $s_dir = '-';
            } else {
                $s_dir = '';
            }

            $this->add_render_attribute( 'text-scope', [
                'id' => $this->get_id(),
                'class' => [ 'ms-tt-wrap s-d'],
                'data-scroll-css-progress' => '',
                'data-scroll' => '',
                'data-direction' => $settings['direction'],
                'style' => '--speed:' . $settings['scroll-speed'] . '',
            ]);

        } else {
            $this->add_render_attribute( 'text-scope', [
                'id' => $this->get_id(),
                'class' => [ 'ms-tt-wrap'],
                'data-speed' => isset($settings['speed']) ? $settings['speed'] : '1',
                'data-direction' => $settings['direction'],
                'data-scroll' => $s_d,
                'data-hover' => $settings['hover'],
            ]);
        }


        $this->add_render_attribute( 'text-wrap', [
            'class' => [ 'ms-tt'],
        ] );

        ?>
        <div class="ms-text-ticker">
            <div <?php echo $this->get_render_attribute_string( 'text-scope' ); ?>>
                <div>

                    <ul <?php echo $this->get_render_attribute_string( 'text-wrap' ); ?>>

                    <?php $i = 1;
                        while ($i <= 6): ?>
                            <li class="ms-tt__text"><?php echo $settings['text_ticker']; ?>&nbsp;</li>
                            <?php if(!empty($settings['image']['url'])) : ?>
                                <li class="ms-tt__text img"><img src="<?php echo $settings['image']['url']; ?>"/></li>
                            <?php endif; ?>
                        <?php $i++; endwhile; ?>    
                    </ul>
                    
                </div>
            </div>
        </div>
        <?php }

}