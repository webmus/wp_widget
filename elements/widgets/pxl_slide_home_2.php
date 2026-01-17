<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
pxl_add_custom_widget(
    array(
        'name' => 'pxl_slide_home_2',
        'title' => esc_html__('BR Slide Home 2', 'konstruc'),
        'icon' => 'eicon-post-slider',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'swiper',
            'pxl-swiper',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_layout',
                    'label' => esc_html__('Layout', 'konstruc' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'konstruc' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'konstruc' ),
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_slide_home_2/layout1.jpg'
                                ],
                                
                                
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__('Content', 'konstruc'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'slide_home',
                            'label' => esc_html__('Content', 'konstruc'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name'  => 'bg_image',
                                    'label' => esc_html__('Background Image','konstruc'),
                                    'type'  => \Elementor\Group_Control_Background::get_type(),
                                    'control_type'  => 'group',
                                    'selector'  => '{{WRAPPER}} .pxl-slide--home {{CURRENT_ITEM}} .pxl-item--overlay',
                                ),
                                
                                
                                array(
                                    'name'  => 'heading',
                                    'label' => esc_html__('Heading','konstruc'),
                                    'type'  => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block'   => true,
                                ),
                                array(
                                    'name'  => 'description',
                                    'label' => esc_html__('Description','konstruc'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                    'label_block'   => true,
                                ),
                                array(
                                    'name'  => 'text_button',
                                    'label' => esc_html__('Button','konstruc'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                    'label_block'   => true,
                                    'default'   => 'LEARN MORE',
                                ),
                                array(
                                    'name' => 'button_link',
                                    'label' => esc_html__('Link Details', 'konstruc'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'default'   => [
                                        'url'   => '#',
                                    ],
                                ),
                                array(
                                    'name'  => 'text_button_2',
                                    'label' => esc_html__('Button 2','konstruc'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                    'label_block'   => true,
                                    'default'   => 'CONTACT US',
                                ),
                                array(
                                    'name' => 'button_link2',
                                    'label' => esc_html__('Link Details 2', 'konstruc'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'default'   => [
                                        'url'   => '#',
                                    ],
                                ),

                            ),
                        ),
                    ),
                ),
array(
    'name' => 'section_carousel_settings',
    'label' => esc_html__('Carousel Settings', 'konstruc'),
    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
    'controls' => array(
        array(
            'name' => 'col_xs',
            'label' => esc_html__('Columns XS Devices', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '6' => '6',
            ],
        ),
        array(
            'name' => 'col_sm',
            'label' => esc_html__('Columns SM Devices', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '6' => '6',
            ],
        ),
        array(
            'name' => 'col_md',
            'label' => esc_html__('Columns MD Devices', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '6' => '6',
            ],
        ),
        array(
            'name' => 'col_lg',
            'label' => esc_html__('Columns LG Devices', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '6' => '6',
                '7' => '7',
                '8' => '8',
            ],
        ),
        array(
            'name' => 'col_xl',
            'label' => esc_html__('Columns XL Devices', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
            ],
        ),
        array(
            'name' => 'col_xxl',
            'label' => esc_html__('Columns XXL Devices', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
            ],
        ),

        array(
            'name' => 'slides_to_scroll',
            'label' => esc_html__('Slides to scroll', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
            ],
        ),
        array(
            'name' => 'arrows',
            'label' => esc_html__('Show Arrows', 'konstruc'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
        ),
        
        array(
            'name' => 'pause_on_hover',
            'label' => esc_html__('Pause on Hover', 'konstruc'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ),
        array(
            'name' => 'autoplay',
            'label' => esc_html__('Autoplay', 'konstruc'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ),
        array(
            'name' => 'autoplay_speed',
            'label' => esc_html__('Autoplay Delay', 'konstruc'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 5000,
            'condition' => [
                'autoplay' => 'true'
            ]
        ),
        array(
            'name' => 'infinite',
            'label' => esc_html__('Infinite Loop', 'konstruc'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ),
        array(
            'name' => 'speed',
            'label' => esc_html__('Animation Speed', 'konstruc'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 500,
        ),
        array(
            'name' => 'drap',
            'label' => esc_html__('Show Scroll Drap', 'konstruc'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ),
        array(
            'name' => 'item_spacer',
            'label' => esc_html__('Item Spacer', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-slider .pxl-swiper-container .pxl-swiper-slide' => 'padding: 0 {{SIZE}}px;',
                '{{WRAPPER}} .pxl-swiper-slider .pxl-swiper-container' => 'margin: 0 -{{SIZE}}px;',
            ],
        ),
    ),
),
array(
    'name' => 'section_carousel_content',
    'label' => esc_html__('Content', 'konstruc'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'heading_title',
            'label' => esc_html__('TITLE','konstruc'),
            'type'  => \Elementor\Controls_Manager::HEADING,
        ),
        array(
            'name'  => 'title_color',
            'label' => esc_html__('Color','konstruc'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl--title'  => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'title_typography',
            'label' => esc_html__('Typography','konstruc'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-slide--home .pxl--title',
        ), 
        array(
            'name'  => 'title_stroke',
            'label' => esc_html__('Stroke','konstruc'),
            'type'  => \Elementor\Group_Control_Text_Stroke::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-slide--home .pxl--title',
        ),

        array(
            'name'  => 'heading_sub_heading',
            'label' => esc_html__('SUB HEADING','konstruc'),
            'type'  => \Elementor\Controls_Manager::HEADING,
        ),
        array(
            'name'  => 'sub_heading_color',
            'label' => esc_html__('Color','konstruc'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-sub--heading'  => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-slide--home .pxl-sub--heading svg path'  => 'fill: {{VALUE}};'
            ],
        ),
        array(
            'name'  => 'sub_heading_typography',
            'label' => esc_html__('Typography','konstruc'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-slide--home .pxl-sub--heading',
        ),
        array(
            'name'  => 'heading_heading',
            'label' => esc_html__('HEADING','konstruc'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'heading_color',
            'label' => esc_html__('Color','konstruc'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl--heading'  => 'color: {{VALUE}};'
            ],
        ),
        array(
            'name'  => 'heading_typography',
            'label' => esc_html__('Typography','konstruc'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-slide--home .pxl-sub--heading',
        ), 
    ),
),
array(
    'name' => 'section_carousel_button',
    'label' => esc_html__('Button', 'konstruc'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'button_heading',
            'label' => esc_html__('BUTTON','konstruc'),
            'type'  => \Elementor\Controls_Manager::HEADING,
        ),
        array(
            'name'  => 'button_color',
            'label' => esc_html__('Color','konstruc'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-text--button'  => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-slide--home .pxl-text--button svg path'  => 'fill: {{VALUE}};'
            ],
        ),

        array(
            'name' => 'button_bg_color',
            'label' => esc_html__('Background Color', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-text--button' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'btn_text_effect!'   => 'btn-spotlight-scale',
            ],
        ),
        array(
            'name' => 'btn_bg_color_spotlight_hover',
            'label' => esc_html__('Background Color', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .btn-spotlight-scale .item-spotlight' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'btn_text_effect'   => 'btn-spotlight-scale',
            ],
        ),

        array(
            'name'  => 'button_typography',
            'label' => esc_html__('Typography','konstruc'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-slide--home .pxl-text--button',
        ),
        array(
            'name'  => 'button_border',
            'label' => esc_html__('Border','konstruc'),
            'type'  => \Elementor\Group_Control_Border::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-slide--home .pxl-text--button',
        ),
        array(
            'name' => 'button_border_radius',
            'label' => esc_html__('Border Radius', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'custom'],
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-text--button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),

        array(
            'name' => 'btn_text_effect',
            'label' => esc_html__('Text Effect', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('Default', 'konstruc' ),
                'btn-arrow' => esc_html__('Arrow', 'konstruc' ),
                'btn-text-nina' => esc_html__('Nina', 'konstruc' ),
                'btn-text-nanuk' => esc_html__('Nanuk', 'konstruc' ),
                'btn-text-smoke' => esc_html__('Smoke', 'konstruc' ),
                'btn-text-reverse' => esc_html__('Reverse', 'konstruc' ),
                'btn-text-parallax' => esc_html__('Text Parallax', 'konstruc' ),
                'btn-hide-icon' => esc_html__('Hide Icon', 'konstruc' ),
                'btn-glossy' => esc_html__('Glossy', 'konstruc' ),
                'btn-underline' => esc_html__('Underline', 'konstruc' ),
            ],
        ),
    ),
),
array(
    'name' => 'section_carousel_image',
    'label' => esc_html__('Image', 'konstruc'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'img_size',
            'label' => esc_html__('Image Size', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
        ),
        array(
            'name'  => 'background_image_color',
            'label' => esc_html__('Background Image Color','konstruc'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-item--image::before'  => 'background: {{VALUE}};'
            ],
            'condition' => [
                'layout'   => '2',
            ],
        ),

        array(
            'name' => 'image_featured_bg',
            'label' => esc_html__('Background Image Featured ', 'konstruc' ),
            'type' => \Elementor\Group_Control_Background::get_type(),
            'control_type'  => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-item--image::after',
            'condition' => [
                'layout'   => '2',
            ],
        ),

        array(
            'name'  => 'img_feature_border',
            'label' => esc_html__('Border','konstruc'),
            'type'  => \Elementor\Group_Control_Border::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-slide--home .pxl-sub--heading',
        ),
        array(
            'name' => 'img_feature_border_radius',
            'label' => esc_html__('Border Radius', 'konstruc' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'custom'],
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-item--image::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),
    ),
),
konstruc_widget_animation_settings(),
),
),
),
konstruc_get_class_widget_path()
);