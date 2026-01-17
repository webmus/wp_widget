<?php 

/**
 * Swipper Lib
*/
if(!function_exists('konstruc_elements_scripts')){
    add_action( 'wp_enqueue_scripts', 'konstruc_elements_scripts');
    function konstruc_elements_scripts() {  
        $theme = wp_get_theme( get_template() );
        wp_register_script( 'gsap', get_template_directory_uri() . '/assets/js/libs/gsap.min.js', array( 'jquery' ), '3.5.0', true );
        wp_register_script( 'pxl-scroll-trigger', get_template_directory_uri() . '/assets/js/libs/scroll-trigger.js', array( 'jquery' ), '3.10.5', true );
        wp_register_script( 'pxl-splitText', get_template_directory_uri() . '/assets/js/libs/split-text.js', array( 'jquery' ), '3.6.1', true );
        wp_register_script( 'circle-text', get_template_directory_uri() . '/assets/js/libs/circletype.min.js', array( 'jquery' ), '2.3.2', true );
        wp_register_script( 'pxl-bundled-lenis', get_template_directory_uri() . '/assets/js/libs/typography/set1/bundled-lenis.min.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script('konstruc-countdown', get_template_directory_uri() . '/elements/widgets/js/pxl-countdown.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_enqueue_script( 'pxl-slick-min', get_template_directory_uri() . '/assets/js/libs/slick.min.js', array( 'jquery' ), '1.9.0', true );
        
        wp_register_script('konstruc-particle', get_template_directory_uri() . '/elements/widgets/js/particle.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_register_script('konstruc-parallax', get_template_directory_uri() . '/elements/widgets/js/parallax.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_register_script('pxl-post-grid', get_template_directory_uri() . '/elements/widgets/js/grid.js', [ 'isotope', 'jquery' ], $theme->get( 'Version' ), true);
        wp_enqueue_script( 'Snap.svg', get_template_directory_uri() . '/elements/widgets/js/Snap.svg.js', array( 'jquery' ), '0.4.1', true );        
        wp_localize_script( 'pxl-post-grid', 'main_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_register_script('pxl-swiper', get_template_directory_uri() . '/elements/widgets/js/carousel.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_register_script('konstruc-counter', get_template_directory_uri() . '/elements/widgets/js/counter.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_register_script('konstruc-accordion', get_template_directory_uri() . '/elements/widgets/js/accordion.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_register_script('pxl-circle--text', get_template_directory_uri() . '/elements/widgets/js/circle-text.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_register_script('konstruc-tabs', get_template_directory_uri() . '/elements/widgets/js/tabs.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_register_script('konstruc-progressbar', get_template_directory_uri() . '/elements/widgets/js/progressbar.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_register_script('konstruc-countdown', get_template_directory_uri() . '/elements/widgets/js/countdown.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_register_script('pxl-pie-chart', get_template_directory_uri() . '/assets/js/libs/pie-chart.min.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_register_script('konstruc-pie-chart', get_template_directory_uri() . '/elements/widgets/js/pie-chart.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        wp_enqueue_script('konstruc-elementor', get_template_directory_uri() . '/elements/widgets/js/elementor.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    }
}

/**
 * Extra Elementor Icons
*/
if(!function_exists('konstruc_register_custom_icon_library')){
    add_filter('elementor/icons_manager/native', 'konstruc_register_custom_icon_library');
    function konstruc_register_custom_icon_library($tabs){
        $custom_tabs = [
            'pxl_icon1' => [
                'name' => 'flaticon',
                'label' => esc_html__( 'Konstruc', 'konstruc' ),
                'url' => false,
                'enqueue' => false,
                'prefix' => 'flaticon-',
                'displayPrefix' => 'flaticon',
                'labelIcon' => 'flaticon-group',
                'ver' => '1.0.0',
                'fetchJson' => get_template_directory_uri() . '/assets/fonts/flaticon/flaticon.js',
                'native' => true,
            ],

        ];
        $tabs = array_merge($custom_tabs, $tabs);
        return $tabs;
    }
}

/**
 * Get class widget path
*/
if(!function_exists('konstruc_get_class_widget_path')){
    function konstruc_get_class_widget_path(){
        $upload_dir = wp_upload_dir();
        $cls_path = $upload_dir['basedir'].'/elementor-widget/';
        if(!is_dir($cls_path)) {
            wp_mkdir_p( $cls_path );
        }
        return $cls_path;
    }
}

/**
 * Get post type options
*/
function konstruc_get_post_type_options($pt_supports=[]){
    $post_types = get_post_types([
        'public'   => true,
    ], 'objects');
    $excluded_post_type = [
        'page',
        'attachment',
        'revision',
        'nav_menu_item',
        'custom_css',
        'customize_changeset',
        'oembed_cache',
        'e-landing-page',
        'header',
        'footer',
        'mega-menu',
        'elementor_library'
    ];

    $result_some = [];
    $result_any = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $post_type) {
        if (!$post_type instanceof WP_Post_Type)
            continue;
        if (in_array($post_type->name, $excluded_post_type))
            continue;

        if(!empty($pt_supports) && in_array($post_type->name, $pt_supports)){
            $result_some[$post_type->name] = $post_type->labels->singular_name;
        }else{
            $result_any[$post_type->name] = $post_type->labels->singular_name;
        }
    }

    if(!empty($pt_supports))
        return $result_some;
    else   
        return $result_any;
}


/**
 * Start Post Grid Functions
*/
function konstruc_get_post_grid_layout($pt_supports = []){
    $post_types  = konstruc_get_post_type_options($pt_supports); 
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name'     => 'layout_'.$name,
            'label'    => sprintf(esc_html__( 'Select Template of %s', 'konstruc' ), $label),
            'type'     => 'layoutcontrol',
            'default' => 'post-1',
            'options'  => konstruc_get_grid_layout_options($name),
            'prefix_class' => 'pxl-post-layout-',
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;   
}

function konstruc_get_grid_layout_options($post_type){
    $option_layouts = [];
    switch ($post_type) {
        case 'portfolio':
        $option_layouts = [
            'portfolio-1' => [
                'label' => esc_html__( 'Layout 1', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_grid/portfolio-layout1.jpg'
            ],
            'portfolio-2' => [
                'label' => esc_html__( 'Layout 2', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_grid/portfolio-layout2.jpg'
            ],
            
        ];
        break;

        case 'service':
        $option_layouts = [
            'service-1' => [
                'label' => esc_html__( 'Layout 1', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_grid/service-layout1.jpg'
            ],
        ];
        break;


        case 'post':  
        $option_layouts = [
            'post-1' => [
                'label' => esc_html__( 'Layout 1', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_grid/post-layout1.jpg'
            ],
            'post-2' => [
                'label' => esc_html__( 'Layout 2', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_grid/post-layout2.jpg'
            ],
            
        ];
        break;

    }
    return $option_layouts;
}
function konstruc_get_term_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = konstruc_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $taxonomy = get_object_taxonomies($name, 'names');


        if ($name == 'post') $taxonomy = ['category'];
        if ($name == 'product') $taxonomy = ['product_cat'];

        $options = pxl_get_grid_term_options($name, $taxonomy);
        if ($name == 'phb_room_type') $options = [];
        
        $result[] = array(
            'name' => 'source_' . $name,
            'label' => sprintf(esc_html__('Select Term', 'konstruc'), $label),
            'description' => esc_html__('Get all when no term selected', 'konstruc'),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $options,
            'label_block' => true,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}
function konstruc_get_grid_term_by_post_type($pt_supports = [], $args=[]){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]); 
    $post_types  = konstruc_get_post_type_options($pt_supports); 
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $taxonomy = get_object_taxonomies($name, 'names');
        
        if($name == 'post') $taxonomy = ['category'];

        $result[] = array(
            'name'     => 'source_'.$name,
            'label'    => sprintf(esc_html__( 'Select Term of %s', 'konstruc' ), $label),
            'type'     => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options'  => pxl_get_grid_term_options($name,$taxonomy),
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}
function konstruc_get_ids_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = konstruc_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;

    foreach ($post_types as $name => $label) {

        $posts = konstruc_list_post($name, false);

        $result[] = array(
            'name' => 'source_' . $name . '_post_ids',
            'label' => sprintf(esc_html__('Select posts', 'konstruc'), $label),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $posts,
            'label_block' => true,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}
function konstruc_get_ids_unselected_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = konstruc_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $posts = konstruc_list_post($name, false);

        $result[] = array(
            'name' => 'source_' . $name . '_post_ids_unselected',
            'label' => sprintf(esc_html__('Unselected posts', 'konstruc'), $label),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $posts,
            'label_block' => true,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}

function konstruc_get_grid_ids_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = konstruc_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $posts = konstruc_list_post($name, false);

        $result[] = array(
            'name' => 'source_' . $name . '_post_ids',
            'label' => sprintf(esc_html__('Select posts', 'konstruc'), $label),
            'type'     => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $posts,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}

/**
 * End Post Grid Functions
*/


/**
 * Start Post Carousel Functions
*/
function konstruc_get_post_carousel_layout($pt_supports = []){
    $post_types  = konstruc_get_post_type_options($pt_supports); 
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name'     => 'layout_'.$name,
            'label'    => sprintf(esc_html__( 'Select Template of %s', 'konstruc' ), $label),
            'type'     => 'layoutcontrol',
            'default' => 'post-1',
            'options'  => konstruc_get_carousel_layout_options($name),
            'prefix_class' => 'post-layout-',
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;   
}

function konstruc_get_carousel_layout_options($post_type){
    $option_layouts = [];
    switch ($post_type) {
        case 'portfolio':
        $option_layouts = [
            'portfolio-1' => [
                'label' => esc_html__( 'Layout 1', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/portfolio-layout1.jpg'
            ],
            'portfolio-2' => [
                'label' => esc_html__( 'Layout 2', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/portfolio-layout2.jpg'
            ],

            'portfolio-3' => [
                'label' => esc_html__( 'Layout 3', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/portfolio-layout3.jpg'
            ],
        ];
        break;

        case 'service':
        $option_layouts = [
            'service-1' => [
                'label' => esc_html__( 'Layout 1', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/service-layout1.1.jpg'
            ],
            'service-2' => [
                'label' => esc_html__( 'Layout 2', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/service-layout2.jpg'
            ], 
            'service-3' => [
                'label' => esc_html__( 'Layout 3', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/service-layout3.jpg'
            ],
            'service-4' => [
                'label' => esc_html__( 'Layout 4', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/service-layout4.jpg'
            ],
            
        ];
        break;

        case 'post':  
        $option_layouts = [
            'post-1' => [
                'label' => esc_html__( 'Layout 1', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/post-layout1.jpg'
            ],
            'post-2' => [
                'label' => esc_html__( 'Layout 2', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/post-layout2.jpg'
            ],
            'post-3' => [
                'label' => esc_html__( 'Layout 3', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/post-layout3.jpg'
            ],
            'post-4' => [
                'label' => esc_html__( 'Layout 4', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_carousel/post-layout4.jpg'
            ],
            
        ];
        break;
    }
    return $option_layouts;
}

/**
 * End Post Carousel Functions
*/

/**
 * Start Post Modern Functions
*/
function konstruc_get_post_modern_layout($pt_supports = []){
    $post_types  = konstruc_get_post_type_options($pt_supports); 
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name'     => 'layout_'.$name,
            'label'    => sprintf(esc_html__( 'Select Template of %s', 'konstruc' ), $label),
            'type'     => 'layoutcontrol',
            'default' => 'post-1',
            'options'  => konstruc_get_modern_layout_options($name),
            'prefix_class' => 'post-layout-',
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;   
}

function konstruc_get_modern_layout_options($post_type){
    $option_layouts = [];
    switch ($post_type) {

        case 'post':  
        $option_layouts = [
            'post-1' => [
                'label' => esc_html__( 'Layout 1', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_modern/post-layout1.jpg'
            ],
        ];
        break;
    }
    return $option_layouts;
}

/**
 * End Post Modern Functions
*/

/**
 * Start Post Slip Functions
*/
function konstruc_get_post_slip_layout($pt_supports = []){
    $post_types  = konstruc_get_post_type_options($pt_supports); 
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name'     => 'layout_'.$name,
            'label'    => sprintf(esc_html__( 'Select Template of %s', 'konstruc' ), $label),
            'type'     => 'layoutcontrol',
            'default' => 'portfolio-1',
            'options'  => konstruc_get_slip_layout_options($name),
            'prefix_class' => 'portfolio-layout-',
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;   
}

function konstruc_get_slip_layout_options($post_type){
    $option_layouts = [];
    switch ($post_type) {

        case 'portfolio':  
        $option_layouts = [
            'portfolio-1' => [
                'label' => esc_html__( 'Layout 1', 'konstruc' ),
                'image' => get_template_directory_uri() . '/elements/widgets/img-layout/pxl_post_slip/portfolio-layout1.jpg'
            ],
        ];
        break;
    }
    return $option_layouts;
}

/**
 * End Post Slip Functions
*/


/* Icon render */ 
function konstruc_elementor_icon_render( $settings, $args = []){
    $args = wp_parse_args($args, [
        'prefix'     => '',   
        'id'         => 'selected_icon',
        'loop'       => false,
        'tag'        => 'div',   
        'wrap_class' => '',
        'class'      => '',
        'style'      => '',
        'before'     => '',
        'after'      => '',
        'atts'       => [],
        'animate_data' => '',
        'default_icon'    => [
            'value'   => '',
            'library' => ''
        ],
        'echo' => true
    ]);
    if($args['loop']) {
        $icon = $args['id'];
    } else {
        $icon = $settings[$args['id']];
    }
    if(empty($icon['value'])) $icon = $args['default_icon'];
    if (empty($icon['value'])) return;

    if ( 'svg' === $icon['library'] ){
        $args['before'] = '<span class="'.$args['wrap_class'].' '.$args['class'].'" data-settings="'. esc_attr($args['animate_data']).'">';
        $args['after']  = '</span>';
    }
    ob_start();
    printf('%s', $args['before']);
    ?>
    <?php \Elementor\Icons_Manager::render_icon( $icon, array_merge(
        [ 
            'aria-hidden' => 'true', 
            'class'       => trim(implode(' ', ['pxl-icon', $args['class'], $args['wrap_class']])),
            'style'       => $args['style']  
        ],
        $args['atts']
    ), $args['tag']); ?>
    <?php
    printf('%s', $args['after']);

    if($args['echo']){
        echo ob_get_clean();
    } else {
        return ob_get_clean();
    }
}

/**
 * Animation List
*/

function konstruc_widget_animate() {
    $konstruc_animate = array(
        '' => 'None',
        'wow bounce' => 'bounce',
        'wow flash' => 'flash',
        'wow pulse' => 'pulse',
        'wow rubberBand' => 'rubberBand',
        'wow shake' => 'shake',
        'wow swing' => 'swing',
        'wow tada' => 'tada',
        'wow wobble' => 'wobble',
        'wow bounceIn' => 'bounceIn',
        'wow bounceInDown' => 'bounceInDown',
        'wow bounceInLeft' => 'bounceInLeft',
        'wow bounceInRight' => 'bounceInRight',
        'wow bounceInUp' => 'bounceInUp',
        'wow bounceOut' => 'bounceOut',
        'wow bounceOutDown' => 'bounceOutDown',
        'wow bounceOutLeft' => 'bounceOutLeft',
        'wow bounceOutRight' => 'bounceOutRight',
        'wow bounceOutUp' => 'bounceOutUp',
        'wow fadeIn' => 'fadeIn',
        'wow fadeInDown' => 'fadeInDown',
        'wow fadeInDownBig' => 'fadeInDownBig',
        'wow fadeInLeft' => 'fadeInLeft',
        'wow fadeInLeftBig' => 'fadeInLeftBig',
        'wow fadeInRight' => 'fadeInRight',
        'wow fadeInRightBig' => 'fadeInRightBig',
        'wow fadeInUp' => 'fadeInUp',
        'wow fadeInUpBig' => 'fadeInUpBig',
        'wow fadeOut' => 'fadeOut',
        'wow fadeOutDown' => 'fadeOutDown',
        'wow fadeOutDownBig' => 'fadeOutDownBig',
        'wow fadeOutLeft' => 'fadeOutLeft',
        'wow fadeOutLeftBig' => 'fadeOutLeftBig',
        'wow fadeOutRight' => 'fadeOutRight',
        'wow fadeOutRightBig' => 'fadeOutRightBig',
        'wow fadeOutUp' => 'fadeOutUp',
        'wow fadeOutUpBig' => 'fadeOutUpBig',
        'wow flip' => 'flip',
        'wow flipCase' => 'flipCase',
        'wow flipInX' => 'flipInX',
        'wow flipInY' => 'flipInY',
        'wow flipOutX' => 'flipOutX',
        'wow flipOutY' => 'flipOutY',
        'wow lightSpeedIn' => 'lightSpeedIn',
        'wow lightSpeedOut' => 'lightSpeedOut',
        'wow rotateIn' => 'rotateIn',
        'wow rotateInDownLeft' => 'rotateInDownLeft',
        'wow rotateInDownRight' => 'rotateInDownRight',
        'wow rotateInUpLeft' => 'rotateInUpLeft',
        'wow rotateInUpRight' => 'rotateInUpRight',
        'wow rotateOut' => 'rotateOut',
        'wow rotateOutDownLeft' => 'rotateOutDownLeft',
        'wow rotateOutDownRight' => 'rotateOutDownRight',
        'wow rotateOutUpLeft' => 'rotateOutUpLeft',
        'wow rotateOutUpRight' => 'rotateOutUpRight',
        'wow hinge' => 'hinge',
        'wow rollIn' => 'rollIn',
        'wow rollOut' => 'rollOut',
        'wow zoomInSmall' => 'zoomInSmall',
        'wow zoomIn' => 'zoomInBig',
        'wow zoomOut' => 'zoomOut',
        'wow skewIn' => 'skewInLeft',
        'wow skewInRight' => 'skewInRight',
        'wow skewInBottom' => 'skewInBottom',
        'wow RotatingY' => 'RotatingY',
        'wow PXLfadeInUp' => 'PXLfadeInUp',
        'fadeInPopup' => 'fadeInPopup',
        'scrolling-effect fade'  => 'Scroll Fade',
        'scrolling-effect fromRight'  => 'Scroll From Right',
        'scrolling-effect fromLeft'  => 'Scroll From Left',
        'scrolling-effect fromBottom'  => 'Scroll From Bottom',
        'scrolling-effect fromTop'  => 'Scroll From Top',
        'scrolling-effect zoomIn'  => 'Scroll zoom In',
        'scrolling-effect zoomFromLeft'  => 'Scroll zoom From Left',
        'scrolling-effect zoomFromRight'  => 'Scroll zoom From Right',
    );
    return $konstruc_animate;
}

function konstruc_widget_animate_v2() {
    $konstruc_animate_v2 = array(
        '' => 'None',
        'wow bounce' => 'bounce',
        'wow flash' => 'flash',
        'wow pulse' => 'pulse',
        'wow rubberBand' => 'rubberBand',
        'wow shake' => 'shake',
        'wow swing' => 'swing',
        'wow tada' => 'tada',
        'wow wobble' => 'wobble',
        'wow bounceIn' => 'bounceIn',
        'wow bounceInDown' => 'bounceInDown',
        'wow bounceInLeft' => 'bounceInLeft',
        'wow bounceInRight' => 'bounceInRight',
        'wow bounceInUp' => 'bounceInUp',
        'wow bounceOut' => 'bounceOut',
        'wow bounceOutDown' => 'bounceOutDown',
        'wow bounceOutLeft' => 'bounceOutLeft',
        'wow bounceOutRight' => 'bounceOutRight',
        'wow bounceOutUp' => 'bounceOutUp',
        'wow fadeIn' => 'fadeIn',
        'wow fadeInDown' => 'fadeInDown',
        'wow fadeInDownBig' => 'fadeInDownBig',
        'wow fadeInLeft' => 'fadeInLeft',
        'wow fadeInLeftBig' => 'fadeInLeftBig',
        'wow fadeInRight' => 'fadeInRight',
        'wow fadeInRightBig' => 'fadeInRightBig',
        'wow fadeInUp' => 'fadeInUp',
        'wow fadeInUpBig' => 'fadeInUpBig',
        'wow fadeOut' => 'fadeOut',
        'wow fadeOutDown' => 'fadeOutDown',
        'wow fadeOutDownBig' => 'fadeOutDownBig',
        'wow fadeOutLeft' => 'fadeOutLeft',
        'wow fadeOutLeftBig' => 'fadeOutLeftBig',
        'wow fadeOutRight' => 'fadeOutRight',
        'wow fadeOutRightBig' => 'fadeOutRightBig',
        'wow fadeOutUp' => 'fadeOutUp',
        'wow fadeOutUpBig' => 'fadeOutUpBig',
        'wow flip' => 'flip',
        'wow flipCase' => 'flipCase',
        'wow flipInX' => 'flipInX',
        'wow flipInY' => 'flipInY',
        'wow flipOutX' => 'flipOutX',
        'wow flipOutY' => 'flipOutY',
        'wow lightSpeedIn' => 'lightSpeedIn',
        'wow lightSpeedOut' => 'lightSpeedOut',
        'wow rotateIn' => 'rotateIn',
        'wow rotateInDownLeft' => 'rotateInDownLeft',
        'wow rotateInDownRight' => 'rotateInDownRight',
        'wow rotateInUpLeft' => 'rotateInUpLeft',
        'wow rotateInUpRight' => 'rotateInUpRight',
        'wow rotateOut' => 'rotateOut',
        'wow rotateOutDownLeft' => 'rotateOutDownLeft',
        'wow rotateOutDownRight' => 'rotateOutDownRight',
        'wow rotateOutUpLeft' => 'rotateOutUpLeft',
        'wow rotateOutUpRight' => 'rotateOutUpRight',
        'wow hinge' => 'hinge',
        'wow rollIn' => 'rollIn',
        'wow rollOut' => 'rollOut',
        'wow zoomInSmall' => 'zoomInSmall',
        'wow zoomIn' => 'zoomInBig',
        'wow zoomOut' => 'zoomOut',
        'wow skewIn' => 'skewInLeft',
        'wow skewInRight' => 'skewInRight',
        'wow RotatingY' => 'RotatingY',
        'wow PXLfadeInUp' => 'PXLfadeInUp',
        'wow TextOutlineAnimation' => 'Text Outline Animation',
        'pxl-split-text split-in-fade' => 'Slip Text In Fade',
        'pxl-split-text split-in-right' => 'Slip Text In Right',
        'pxl-split-text split-in-left'  => 'Slip Text In Left',
        'pxl-split-text split-in-up'    => 'Slip Text In Up',
        'pxl-split-text split-in-down'  => 'Slip Text In Down',
        'pxl-split-text split-in-rotate'  => 'Slip Text In Rotate',
        'pxl-split-text split-in-scale'  => 'Slip Text In Scale',
        'scrolling-effect fade'  => 'Scroll Fade',
        'scrolling-effect fromRight'  => 'Scroll From Right',
        'scrolling-effect fromLeft'  => 'Scroll From Left',
        'scrolling-effect fromBottom'  => 'Scroll From Bottom',
        'scrolling-effect fromTop'  => 'Scroll From Top',
        'scrolling-effect zoomIn'  => 'Scroll zoom In',
        'scrolling-effect zoomFromLeft'  => 'Scroll zoom From Left',
        'scrolling-effect zoomFromRight'  => 'Scroll zoom From Right',

    );
    return $konstruc_animate_v2;
}

/* 
'pxl-typography-effect-1'  => 'Typography Effect 1',
'pxl-typography-effect-2'  => 'Typography Effect 2',
'pxl-typography-effect-3'  => 'Typography Effect 3',
'pxl-typography-effect-4'  => 'Typography Effect 4',
'pxl-typography-effect-5'  => 'Typography Effect 5',
'pxl-typography-effect-6'  => 'Typography Effect 6',
'pxl-typography-effect-7'  => 'Typography Effect 7',
'pxl-typography-effect-8'  => 'Typography Effect 8',
'pxl-typography-effect-9'  => 'Typography Effect 9',
'pxl-typography-effect-10'  => 'Typography Effect 10',
'pxl-typography-effect-11'  => 'Typography Effect 11',
'pxl-typography-effect-12'  => 'Typography Effect 12',
'pxl-typography-effect-13'  => 'Typography Effect 13',
'pxl-typography-effect-14'  => 'Typography Effect 14',
'pxl-typography-effect-15'  => 'Typography Effect 15',
 */


/**
 * Pagram Animation
*/
if(!function_exists('konstruc_widget_animation_settings')){
    function konstruc_widget_animation_settings($args = []){
        $args = wp_parse_args($args, [
            'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => []
        ]);
        return array(
            'name'      => 'section_animation',
            'label'     => esc_html__('Animation', 'konstruc'),
            'tab'       => $args['tab'],
            'condition' => $args['condition'],
            'controls'  => array_merge(
                array(
                    array(
                        'name' => 'pxl_animate',
                        'label' => esc_html__('Bravis Animate', 'konstruc' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => konstruc_widget_animate(),
                        'default' => '',
                    ),
                    array(
                        'name' => 'pxl_animate_delay',
                        'label' => esc_html__('Animate Delay', 'konstruc' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '0',
                        'description' => 'Enter number. Default 0ms',
                    ),
                )
            )
        );
    }
}

if(!function_exists('konstruc_widget_color_type')){
    function konstruc_widget_color_type($args = []){
        $gradient_prefix_class = 'pxl-';
        $gradient_return_value = 'gradient';
        $args = wp_parse_args($args, [
            'label' => '',
            'prefix' => '',
            'selectors_class' => '',
            'condition' => []
        ]);
        $options = array(
            array(
                'name' => $args['prefix'] .'_color_type',
                'label' => esc_html__('Color Type', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'normal' => 'Normal',
                    'gradient' => 'Gradient',
                ],
                'default' => 'normal',
            ),

            array(
                'name' => $args['prefix'] .'_normal_color',
                'label' => esc_html__('Normal Color', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$args['selectors_class'] => 'color: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'].'_color_type' => ['normal'],
                ],
            ),

            array(
                'name'        => $args['prefix'].'_gradient_color',
                'label' => $args['label'] .' '.esc_html__('Gradient Color', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'prefix_class' => $gradient_prefix_class,
                'return_value' => $gradient_return_value,
                'condition' => [
                    $args['prefix'].'_color_type' => ['gradient'],
                ],
            ),
            array(
                'name'        => $args['prefix'].'pxl_start_popover',
                'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'Start Popover', 'konstruc' ),
                'type'        => 'pxl_start_popover',
                'condition'   => $args['condition'],
            ),
            array(
                'name' => $args['prefix'].'_gradient_color_from',
                'label' => esc_html__('From', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$args['selectors_class'] => '--gradient-color-from: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] .'_gradient_color!' => '',
                ],
            ),
            array(
                'name' => $args['prefix'].'_gradient_color_to',
                'label' => esc_html__('To', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$args['selectors_class'] => '--gradient-color-to: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] .'_gradient_color!' => '',
                ],
            ),
            array(
                'name'        => $args['prefix'].'pxl_end_popover',
                'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'End Popover', 'konstruc' ),
                'type'        => 'pxl_end_popover',
                'condition'   => $args['condition'],
            ),
        );
        return $options;
    }
}

if(!function_exists('konstruc_widget_gradient_color')){
    function konstruc_widget_gradient_color($args = []){
        $gradient_prefix_class = 'pxl-';
        $gradient_return_value = 'gradient';
        $args = wp_parse_args($args, [
            'label' => '',
            'prefix' => '',
            'selectors_class' => '',
            'condition' => []
        ]);
        $options = array(
            array(
                'name'        => $args['prefix'] .'_gradient_color',
                'label' => $args['label'] .' '.esc_html__('Gradient Color', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'prefix_class' => $gradient_prefix_class,
                'return_value' => $gradient_return_value,
                'condition'   => $args['condition'],
            ),
            array(
                'name'        => $args['prefix'] .'pxl_start_popover',
                'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'Start Popover', 'konstruc' ),
                'type'        => 'pxl_start_popover',
                'condition'   => $args['condition'],
            ),
            array(
                'name' => $args['prefix'] .'_gradient_color_from',
                'label' => esc_html__('From', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$args['selectors_class'] => '--gradient-color-from: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] .'_gradient_color!' => '',
                ],
            ),
            array(
                'name' => $args['prefix'] .'_gradient_color_to',
                'label' => esc_html__('To', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$args['selectors_class'] => '--gradient-color-to: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] .'_gradient_color!' => '',
                ],
            ),
            array(
                'name'        => $args['prefix'] .'pxl_end_popover',
                'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'End Popover', 'konstruc' ),
                'type'        => 'pxl_end_popover',
                'condition'   => $args['condition'],
            ),
        );
        return $options;
    }
}

if(!function_exists('konstruc_widget_gradient_color_rotate')){
    function konstruc_widget_gradient_color_rotate($args = []){
        $gradient_prefix_class = 'pxl-';
        $gradient_return_value = 'gradient';
        $args = wp_parse_args($args, [
            'label' => '',
            'prefix' => '',
            'selectors_class' => '',
            'condition' => []
        ]);
        $options = array(
            array(
                'name'        => $args['prefix'] .'_gradient_color',
                'label' => $args['label'] .' '.esc_html__('Gradient Color', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'prefix_class' => $gradient_prefix_class,
                'return_value' => $gradient_return_value,
                'condition'   => $args['condition'],
            ),
            array(
                'name'        => $args['prefix'] .'pxl_start_popover',
                'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'Start Popover', 'konstruc' ),
                'type'        => 'pxl_start_popover',
                'condition'   => $args['condition'],
            ),
            array(
                'name' => $args['prefix'] .'_gradient_color_from',
                'label' => esc_html__('From', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$args['selectors_class'] => '--gradient-color-from: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] .'_gradient_color!' => '',
                ],
            ),
            array(
                'name' => $args['prefix'] .'_gradient_color_to',
                'label' => esc_html__('To', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$args['selectors_class'] => '--gradient-color-to: {{VALUE}};',
                ],
                'condition' => [
                    $args['prefix'] .'_gradient_color!' => '',
                ],
            ),
            array(
                'name' => $args['prefix'] .'_gradient_angle',
                'label' => esc_html__('Angle', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 10,
                    ],
                ],
            ),
            array(
                'name'        => $args['prefix'] .'pxl_end_popover',
                'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'End Popover', 'konstruc' ),
                'type'        => 'pxl_end_popover',
                'condition'   => $args['condition'],
            ),
        );
        return $options;
    }
}
function konstruc_get_img_link_url( $settings ) {
    if ( 'none' === $settings['link_to'] ) {
        return false;
    }

    if ( 'custom' === $settings['link_to'] ) {
        if ( empty( $settings['link']['url'] ) ) {
            return false;
        }

        return $settings['link'];
    }

    return [
        'url' => $settings['image']['url'],
    ];
}
if (!function_exists('pxl_get_post_taxonomy')) {
    function pxl_get_post_taxonomy($taxonomy_name)
    {
        $taxonomy = $taxonomy_name;

        $term_list = array();

        $terms = get_terms(
            array(
                'taxonomy' => $taxonomy,
                'hide_empty' => true,
            )
        );

        foreach ($terms as $term) {
            $term_list[$term->slug] = $term->name;
        }

        return $term_list;
    }
}



/* Render link to elementor option */
if(!function_exists('konstruc_render_link_attributes')){
    function konstruc_render_link_attributes($link) {
        $ouput = '';
        if (!empty($link['url'])) {
            $ouput = 'href="' . esc_url($link['url']) . '"';
            if ($link['is_external']) {
                $ouput .= ' target="_blank"';
            }
            if ($link['nofollow']) {
                $ouput .= ' rel="nofollow"';
            }
            if (!empty($link['custom_attributes'])) {
                $custom_attributes = explode(',', $link["custom_attributes"]);
                foreach ($custom_attributes as $attr) {
                    list($key, $value) = explode('|', $attr);
                    $ouput .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
                }
            }
        }
        return pxl_print_html($ouput);
    }
}
/* End Render Link */


/* Render Icon */
function konstruc_render_icon($icon, $is_wrap = true, $tag = 'span', $class = "pxl-item--icon") {
    $is_wrap = filter_var($is_wrap, FILTER_VALIDATE_BOOLEAN);
    $tag = (string)$tag;
    $class = (string)$class;
    $openingTag = '<' . $tag . ' class="' . $class . '">';
    $closingTag = '</' . $tag . '>';

    if (empty($icon['value'])) {
        return '';
    }
    if ($is_wrap) {
        return pxl_print_html($openingTag) . \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true', 'class' => ''], 'i') . pxl_print_html($closingTag);
    } 
    return \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true', 'class' => ''], 'i');
}
/* End Render Icon */


/* Render Image */
function konstruc_get_thumbnail($image_id, $image_size = 'full' , $url = false, $class = '') {
    $url = filter_var($url, FILTER_VALIDATE_BOOLEAN);
    $image_size = empty($image_size) ? 'full' : (string)$image_size;
    $thumbnail = '';
    $thumbnail_url = '';
    if (!empty($image_id) && is_numeric($image_id) && wp_attachment_is_image($image_id)) {
        $image = pxl_get_image_by_size( array(
            'attach_id'  => $image_id,
            'thumb_size' => $image_size,
            'class' => (string)$class,
        ));
        $thumbnail    = $image['thumbnail'];
        $thumbnail_url = $image['url'];
    }
    if($url) {
        return $thumbnail_url;
    }
    return $thumbnail;
}
/* End Render Image */

/* Render Link */
function konstruc_get_link($link){
    $attrs = '';
    if(!empty($link['url'])) {
        $attrs = 'href="'.$link['url'].'"';
        if ($link['is_external']) {
            $attrs .= ' '.'target="_blank"';
        }
        if ($link['nofollow'] ) {
            $attrs .= ' '.'rel="nofollow"';
        }
        if($link['custom_attributes']) {
            $custom_attributes = explode(',', $link["custom_attributes"]);
            foreach($custom_attributes as $attr) {
                list($key, $value) = explode('|', $attr);
                $attrs .= ' '.$key.'="'.$value.'"';
            }
        }
    }
    return $attrs;
}
/* End Render Link */

/* Custom Grid */
if(!function_exists('konstruc_grid_settings')) {
    function konstruc_grid_settings($pagination = true, $condition = []) {
        $pagination = filter_var($pagination, FILTER_VALIDATE_BOOLEAN);
        $options = [
            array(
                'name' => 'grid_options',
                'label' => esc_html__('GRID', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ),
            array(
                'name' => 'col_xs',
                'label' => esc_html__('Columns: Screen < 576px', 'konstruc' ),
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
                'label' => esc_html__('Columns: Screen ≥ 576px', 'konstruc' ),
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
                'label' => esc_html__('Columns: Screen ≥ 768px', 'konstruc' ),
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
                'label' => esc_html__('Columns: Screen ≥ 992px', 'konstruc' ),
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
                'name' => 'col_xl',
                'label' => esc_html__('Columns: Screen ≥ 1200px', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '6' => '6',
                ],
            ),
            array(
                'name' => 'col_xxl',
                'label' => esc_html__('Columns: Screen ≥ 1400px', 'konstruc' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
            ),
        ];

        if ($pagination) {
            $pagination_options = [
                array(
                    'name' => 'divider1',
                    'type' => \Elementor\Controls_Manager::DIVIDER,
                ),
                array(
                    'name' => 'pagination_grid_options',
                    'label' => esc_html__('PAGINATION', 'konstruc' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'after',
                ),
                array(
                    'name' => 'pagination_type',
                    'label' => esc_html__('Pagination Type', 'konstruc' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'false',
                    'options' => [
                        'pagination' => esc_html__('Pagination', 'konstruc' ),
                        'loadmore' => esc_html__('Loadmore', 'konstruc' ),
                        'false' => esc_html__('Disable', 'konstruc' ),
                    ],
                ),
            ];    
            $options = array_merge($options, $pagination_options);
        }

        return [
            'name' => 'tab_grid',
            'label' => esc_html__('Grid', 'konstruc' ),
            'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
            'controls' => $options,
            'condition' => $condition,
        ];
    }
}
/* End Custom Grid */


function pxl_get_product_grid_term_options($args=[]){
    $product_categories = get_categories(array( 'taxonomy' => 'product_cat' ));
    $options = array();
    foreach($product_categories as $category){
        $options[$category->slug] = $category->name;
    }
    return $options;
}

function wpb_reading_time_shortcode() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    $minutes = ceil( $word_count / 200 );
    return $minutes . ' min Read';
}
pxl_register_shortcode( 'reading_time', 'wpb_reading_time_shortcode' );