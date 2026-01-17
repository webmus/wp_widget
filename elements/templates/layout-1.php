<?php
$col_xs = $widget->get_setting('col_xs', '1');
$col_sm = $widget->get_setting('col_sm', '1');
$col_md = $widget->get_setting('col_md', '1');
$col_lg = $widget->get_setting('col_lg', '1');
$col_xl = $widget->get_setting('col_xl', '1');
$col_xxl = $widget->get_setting('col_xxl', '1');
if($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
}
$slides_to_scroll = $widget->get_setting('slides_to_scroll');
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false);
$autoplay_speed = $widget->get_setting('autoplay_speed', 5000);
$infinite = $widget->get_setting('infinite', false);  
$arrows = $widget->get_setting('arrows', false);  
$speed = $widget->get_setting('speed', 500);
$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'fade', 
    'slides_to_show'                => (int)$col_xl, 
    'slides_to_show_xxl'            => (int)$col_xxl, 
    'slides_to_show_lg'             => (int)$col_lg, 
    'slides_to_show_md'             => (int)$col_md, 
    'slides_to_show_sm'             => (int)$col_sm, 
    'slides_to_show_xs'             => (int)$col_xs, 
    'slides_to_scroll'              => (int)$slides_to_scroll,
    'arrow'                         => (bool)$arrows,
    'pagination'                    => (bool)$pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => (bool)$autoplay,
    'pause_on_hover'                => (bool)$pause_on_hover,
    'pause_on_interaction'          => true,
    'delay'                         => (int)$autoplay_speed,
    'loop'                          => (bool)$infinite,
    'speed'                         => (int)$speed
];
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
if(isset($settings['slide_home']) && !empty($settings['slide_home']) && count($settings['slide_home'])): ?>
    <div class="pxl-swiper-slider pxl-slide--home pxl-slide--home2">
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                   <?php foreach ($settings['slide_home'] as $key => $value):
                    $description = isset($value['description']) ? $value['description'] : '';
                    $heading = isset($value['heading']) ? $value['heading'] : '';
                    $text_button = isset($value['text_button']) ? $value['text_button'] : '';
                    $text_button_2 = isset($value['text_button_2']) ? $value['text_button_2'] : '';
                    $button_link = isset($value['button_link']) ? $value['button_link'] : '';
                    $button_link_2 = isset($value['button_link2']) ? $value['button_link2'] : '';
                    $media_type = isset($value['media_type']) ? $value['media_type'] : 'image';
                    $video_url = isset($value['video_url']) ? $value['video_url'] : '';
                    $video_url_value = '';
                    if (is_array($video_url)) {
                        $video_url_value = isset($video_url['url']) ? $video_url['url'] : '';
                    } else {
                        $video_url_value = $video_url;
                    }
                    $video_embed = '';
                    if ($media_type === 'video' && !empty($video_url_value)) {
                        $video_embed = wp_oembed_get($video_url_value);
                    }


                    ?>
                    <div class="pxl-swiper-slide elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>">
                        <?php if ($media_type === 'video' && !empty($video_embed)) : ?>
                            <div class="pxl-item--video">
                                <?php echo $video_embed; ?>
                            </div>
                        <?php else : ?>
                            <div class="pxl-item--overlay"></div>
                        <?php endif; ?>
                        <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">

                            <div class="pxl-item--content">



                                <?php if (!empty($heading)) : ?>
                                    <h1 class="pxl--heading">
                                        <?php echo pxl_print_html($heading); ?>
                                    </h1>
                                <?php endif; ?>

                                <?php if (!empty($description)) : ?>
                                    <div class="pxl--description">
                                        <?php echo pxl_print_html($description); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($text_button)) : ?>
                                    <div class="pxl-box--button">
                                        <a class="btn pxl-text--button pxl-btn--1 <?php echo pxl_print_html($settings['btn_text_effect']); ?>" <?php konstruc_render_link_attributes($button_link); ?>>
                                            <span class="pxl--btn-text" data-text="<?php echo esc_attr($text_button); ?>">
                                                <?php if($settings['btn_text_effect'] == 'btn-text-nina' || $settings['btn_text_effect'] == 'btn-text-nanuk') {
                                                    $chars = preg_split('//u', $text_button, -1, PREG_SPLIT_NO_EMPTY);

                                                    foreach ($chars as $value) {
                                                        if($value == ' ') {
                                                            echo '<span class="spacer">&nbsp;</span>';
                                                        } else {
                                                            echo '<span>' . htmlspecialchars($value) . '</span>';
                                                        }
                                                    }
                                                } else {
                                                    echo pxl_print_html($text_button);
                                                }
                                                ?>
                                            </span>
                                            <span class="pxl--btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                                    <path d="M8.33622 2.84025L1.17647 10L0 8.82354L7.15975 1.66378H0.849212V0H10V9.15081H8.33622V2.84025Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </a>
                                        <a <?php konstruc_render_link_attributes($button_link_2); ?> class="btn pxl-text--button pxl-btn--2 <?php echo pxl_print_html($settings['btn_text_effect']); ?>" >
                                            <span class="pxl--btn-text" data-text="<?php echo esc_attr($text_button_2); ?>">
                                                <?php if($settings['btn_text_effect'] == 'btn-text-nina' || $settings['btn_text_effect'] == 'btn-text-nanuk') {
                                                    $chars = preg_split('//u', $text_button_2, -1, PREG_SPLIT_NO_EMPTY);

                                                    foreach ($chars as $value) {
                                                        if($value == ' ') {
                                                            echo '<span class="spacer">&nbsp;</span>';
                                                        } else {
                                                            echo '<span>' . htmlspecialchars($value) . '</span>';
                                                        }
                                                    }
                                                } else {
                                                    echo pxl_print_html($text_button_2);
                                                }
                                                ?>
                                            </span>
                                            <span class="pxl--btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                                    <path d="M8.33622 2.84025L1.17647 10L0 8.82354L7.15975 1.66378H0.849212V0H10V9.15081H8.33622V2.84025Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>


                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        
        <?php if($arrows !== false): ?>
            <div class="pxl-swiper-arrow-wrap style-1">
                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="caseicon-long-arrow-right-three" style="transform: scalex(-1);"></i></div>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="caseicon-long-arrow-right-three"></i></div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
