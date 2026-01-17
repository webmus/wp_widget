<?php 
use Elementor\Embed;
if(!function_exists('konstruc_get_post_grid')){
    function konstruc_get_post_grid($posts = [], $settings = []){ 
        if (empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)) {
            return false;
        }
        switch ($settings['layout']) {
            case 'post-1':
            konstruc_get_post_grid_layout1($posts, $settings);
            break;

            case 'post-2':
            konstruc_get_post_grid_layout2($posts, $settings);
            break;

            case 'portfolio-1':
            konstruc_get_portfolio_grid_layout1($posts, $settings);
            break;

            case 'portfolio-2':
            konstruc_get_portfolio_grid_layout2($posts, $settings);
            break;

            case 'service-1':
            konstruc_get_service_grid_layout1($posts, $settings);
            break;

            default:
            return false;
            break;
        }
    }
}

// Start Post Grid
//--------------------------------------------------
function konstruc_get_post_grid_layout1($posts = [], $settings = []){ 
    extract($settings);
    
    $images_size = !empty($img_size) ? $img_size : '495x475';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";
                
                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = ''; ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                    $img_id = get_post_thumbnail_id($post->ID);
                    $img          = pxl_get_image_by_size( array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size
                    ) );
                    $thumbnail    = $img['thumbnail']; 
                    ?>
                    <div class="pxl-post--featured hover-imge-effect2">
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                            <?php echo wp_kses_post($thumbnail); ?>
                        </a>
                    </div>
                    <div class="pxl-post--meta">
                        <?php if($show_date == 'true'): ?>
                            <div class="post-date">
                                <?php echo get_the_date('d F Y', $post->ID)  ?>
                            </div>
                        <?php endif; ?>
                        <h3 class="pxl-post--title title-hover-line"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html__(get_the_title($post->ID)); ?></a></h3>
                    </div>
                    
                <?php endif; ?>
            </div>
        </div>
        <?php
    endforeach;
endif;
}

function konstruc_get_post_grid_layout2($posts = [], $settings = []) {
    extract($settings);
    $img_size = !empty($img_size) ? $img_size : '306x207';
    $img_size_featured = !empty($img_size_featured) ? $img_size_featured : '543x530';

    if (!is_array($posts)) return;

    echo '<div class="pxl-grid--featured pxl-grid-item col-md-5 col-12">';
    foreach ($posts as $key => $post) {
        if ($key !== 0) continue;
        $filter_class = !empty($tax) ? pxl_get_term_of_post_to_class($post->ID, array_unique($tax)) : '';
        $thumbnail = has_post_thumbnail($post->ID) ? pxl_get_image_by_size(['attach_id' => get_post_thumbnail_id($post->ID), 'thumb_size' => $img_size_featured])['thumbnail'] : '';
        ?>
        <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
            <div class="pxl-post--featured">
                <?php if ($thumbnail): ?><a href="<?php echo get_permalink($post->ID); ?>"><?php echo pxl_print_html($thumbnail); ?></a><?php endif; ?>
                <?php if ($show_date === 'true'): ?>
                    <div class="pxl-post--date">
                        <div class="pxl--day"><?php echo get_the_date('d', $post->ID); ?></div>
                        <div class="pxl--month"><?php echo get_the_date('M', $post->ID); ?></div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="pxl-post--meta">
                <div class="pxl-info--post">
                    <?php if ($show_author == 'true'): ?>
                        <span class="post-author pxl-d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                              <g clip-path="url(#clip0_514_7605)">
                                <path d="M18.7782 3.22182C16.7006 1.14421 13.9382 0 11 0C8.06184 0 5.29942 1.14421 3.22182 3.22182C1.14421 5.29942 0 8.06184 0 11C0 13.9382 1.14421 16.7006 3.22182 18.7782C5.29942 20.8558 8.06184 22 11 22C13.9382 22 16.7006 20.8558 18.7782 18.7782C20.8558 16.7006 22 13.9382 22 11C22 8.06184 20.8558 5.29942 18.7782 3.22182ZM4.77406 18.4464C5.13728 15.321 7.82434 12.9081 11 12.9081C12.6741 12.9081 14.2483 13.5603 15.4325 14.7443C16.4329 15.7449 17.0638 17.0512 17.2261 18.4462C15.5392 19.8589 13.3673 20.7109 11 20.7109C8.63269 20.7109 6.46092 19.8591 4.77406 18.4464ZM11 11.5804C9.15788 11.5804 7.65901 10.0815 7.65901 8.23943C7.65901 6.39714 9.15788 4.89844 11 4.89844C12.8421 4.89844 14.341 6.39714 14.341 8.23943C14.341 10.0815 12.8421 11.5804 11 11.5804ZM18.3356 17.3565C18.0071 16.0322 17.3221 14.8111 16.3439 13.8329C15.5517 13.0407 14.6144 12.4463 13.5922 12.0739C14.821 11.2405 15.6301 9.83263 15.6301 8.23943C15.6301 5.68648 13.5529 3.60938 11 3.60938C8.44705 3.60938 6.36995 5.68648 6.36995 8.23943C6.36995 9.83347 7.17964 11.2419 8.40945 12.0751C7.46901 12.4178 6.59872 12.9477 5.84996 13.6453C4.76567 14.655 4.01271 15.9426 3.66359 17.3555C2.18503 15.651 1.28906 13.4282 1.28906 11C1.28906 5.64536 5.64536 1.28906 11 1.28906C16.3546 1.28906 20.7109 5.64536 20.7109 11C20.7109 13.4287 19.8146 15.652 18.3356 17.3565Z" fill="currentColor"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_514_7605">
                                  <rect width="22" height="22" fill="white"/>
                              </clipPath>
                          </defs>
                      </svg>
                      <span><?php echo esc_html__('By', 'konstruc'); ?>&nbsp;<?php the_author_posts_link(); ?></span>
                  </span>
              <?php endif; ?>
              <span class="post-comments  pxl-d-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <path d="M18.4662 1.48242H3.51232C1.94883 1.48242 0.676758 2.75424 0.676758 4.31798V13.4694C0.676758 15.0297 1.94329 16.2995 3.50225 16.305V20.4578L9.47033 16.305H18.4662C20.0297 16.305 21.3018 15.0329 21.3018 13.4694V4.31798C21.3018 2.75424 20.0297 1.48242 18.4662 1.48242ZM20.0933 13.4694C20.0933 14.3665 19.3634 15.0965 18.4662 15.0965H9.09116L4.71074 18.1447V15.0965H3.51232C2.61514 15.0965 1.88525 14.3665 1.88525 13.4694V4.31798C1.88525 3.42067 2.61514 2.69092 3.51232 2.69092H18.4662C19.3634 2.69092 20.0933 3.42067 20.0933 4.31798V13.4694Z" fill="currentColor"/>
                    <path d="M6.19727 5.75293H15.7819V6.96143H6.19727V5.75293Z" fill="currentColor"/>
                    <path d="M6.19727 8.33105H15.7819V9.53955H6.19727V8.33105Z" fill="currentColor"/>
                    <path d="M6.19727 10.9092H15.7819V12.1177H6.19727V10.9092Z" fill="currentColor"/>
                </svg>
                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                    <span><?php comments_number(esc_html__('No Comment', 'konstruc'), esc_html__(' 1 Comment', 'konstruc'), esc_html__('%  Comments', 'konstruc'),$post->ID); ?></span>
                </a>
            </span>
        </div>
        <h3 class="pxl-post--title"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
    </div>
</div>
<?php
}
echo '</div>';


echo '<div class="pxl-grid--normal col-md-7 col-12 row">';
foreach ($posts as $key => $post) {
    if ($key < 1) continue;
    $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
    $filter_class = !empty($tax) ? pxl_get_term_of_post_to_class($post->ID, array_unique($tax)) : '';
    $thumbnail = has_post_thumbnail($post->ID) ? pxl_get_image_by_size(['attach_id' => get_post_thumbnail_id($post->ID), 'thumb_size' => $img_size])['thumbnail'] : '';
    $description_post = get_post_meta($post->ID, 'description_post', true);
    ?>
    <div class="<?php echo esc_attr("$item_class $filter_class"); ?>">
        <div class="pxl-post--featured">
            <?php if ($thumbnail): ?><a href="<?php echo get_permalink($post->ID); ?>"><?php echo pxl_print_html($thumbnail); ?></a><?php endif; ?>
            <?php if ($show_date === 'true'): ?>
                <div class="pxl-post--date">
                    <div class="pxl--day"><?php echo get_the_date('d', $post->ID); ?></div>
                    <div class="pxl--month"><?php echo get_the_date('M', $post->ID); ?></div>
                </div>
            <?php endif; ?>
        </div>
        <div class="pxl-post--meta">
            <div class="pxl-info--post">
                <?php if ($show_author == 'true'): ?>
                    <span class="post-author pxl-d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                          <g clip-path="url(#clip0_514_7605)">
                            <path d="M18.7782 3.22182C16.7006 1.14421 13.9382 0 11 0C8.06184 0 5.29942 1.14421 3.22182 3.22182C1.14421 5.29942 0 8.06184 0 11C0 13.9382 1.14421 16.7006 3.22182 18.7782C5.29942 20.8558 8.06184 22 11 22C13.9382 22 16.7006 20.8558 18.7782 18.7782C20.8558 16.7006 22 13.9382 22 11C22 8.06184 20.8558 5.29942 18.7782 3.22182ZM4.77406 18.4464C5.13728 15.321 7.82434 12.9081 11 12.9081C12.6741 12.9081 14.2483 13.5603 15.4325 14.7443C16.4329 15.7449 17.0638 17.0512 17.2261 18.4462C15.5392 19.8589 13.3673 20.7109 11 20.7109C8.63269 20.7109 6.46092 19.8591 4.77406 18.4464ZM11 11.5804C9.15788 11.5804 7.65901 10.0815 7.65901 8.23943C7.65901 6.39714 9.15788 4.89844 11 4.89844C12.8421 4.89844 14.341 6.39714 14.341 8.23943C14.341 10.0815 12.8421 11.5804 11 11.5804ZM18.3356 17.3565C18.0071 16.0322 17.3221 14.8111 16.3439 13.8329C15.5517 13.0407 14.6144 12.4463 13.5922 12.0739C14.821 11.2405 15.6301 9.83263 15.6301 8.23943C15.6301 5.68648 13.5529 3.60938 11 3.60938C8.44705 3.60938 6.36995 5.68648 6.36995 8.23943C6.36995 9.83347 7.17964 11.2419 8.40945 12.0751C7.46901 12.4178 6.59872 12.9477 5.84996 13.6453C4.76567 14.655 4.01271 15.9426 3.66359 17.3555C2.18503 15.651 1.28906 13.4282 1.28906 11C1.28906 5.64536 5.64536 1.28906 11 1.28906C16.3546 1.28906 20.7109 5.64536 20.7109 11C20.7109 13.4287 19.8146 15.652 18.3356 17.3565Z" fill="currentColor"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_514_7605">
                              <rect width="22" height="22" fill="white"/>
                          </clipPath>
                      </defs>
                  </svg>
                  <span><?php echo esc_html__('By', 'konstruc'); ?>&nbsp;<?php the_author_posts_link(); ?></span>
              </span>
          <?php endif; ?>
          <span class="post-comments  pxl-d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                <path d="M18.4662 1.48242H3.51232C1.94883 1.48242 0.676758 2.75424 0.676758 4.31798V13.4694C0.676758 15.0297 1.94329 16.2995 3.50225 16.305V20.4578L9.47033 16.305H18.4662C20.0297 16.305 21.3018 15.0329 21.3018 13.4694V4.31798C21.3018 2.75424 20.0297 1.48242 18.4662 1.48242ZM20.0933 13.4694C20.0933 14.3665 19.3634 15.0965 18.4662 15.0965H9.09116L4.71074 18.1447V15.0965H3.51232C2.61514 15.0965 1.88525 14.3665 1.88525 13.4694V4.31798C1.88525 3.42067 2.61514 2.69092 3.51232 2.69092H18.4662C19.3634 2.69092 20.0933 3.42067 20.0933 4.31798V13.4694Z" fill="currentColor"/>
                <path d="M6.19727 5.75293H15.7819V6.96143H6.19727V5.75293Z" fill="currentColor"/>
                <path d="M6.19727 8.33105H15.7819V9.53955H6.19727V8.33105Z" fill="currentColor"/>
                <path d="M6.19727 10.9092H15.7819V12.1177H6.19727V10.9092Z" fill="currentColor"/>
            </svg>
            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
            </a>
        </span>
    </div>
    <h3 class="pxl-post--title"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
    <?php if ($show_excerpt === 'true'): ?>
        <div class="pxl-post--content"><?php echo wp_trim_words($description_post, $num_words); ?></div>
    <?php endif; ?>
</div>
</div>
<?php
}
echo '</div>';


}


// End Post Grid
//--------------------------------------------------

// Start Portfolio Grid
//--------------------------------------------------
function konstruc_get_portfolio_grid_layout1($posts = [], $settings = []){ 
    extract($settings);

    $images_size = !empty($img_size) ? $img_size : '648x631';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $img_id = get_post_thumbnail_id($post->ID);
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                if($img_id) {
                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
                }  ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">

                    <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                        <div class="pxl-post--featured <?php echo esc_attr($img_effect); ?>">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>    
                        </div>
                        <div class="pxl-post--holder <?php echo esc_attr($layout_style); ?>">
                           <?php if($show_category == 'true'): ?>
                            <div class="pxl-post--category">
                                <?php the_terms( $post->ID, 'portfolio-category','', '' ); ?>
                            </div>
                        <?php endif; ?>
                        <h5 class="pxl-post--title">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                <?php echo esc_attr(get_the_title($post->ID)); ?>
                            </a>
                            <?php if($show_button == 'true') : ?>
                                <a class="btn-readmore" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M11.6707 3.97635L1.64706 14L0 12.353L10.0237 2.3293H1.1889V0H14V12.8111H11.6707V3.97635Z" fill="currentColor"/>
                                    </svg>
                                </a> 
                            <?php endif; ?>

                        </h5>
                        
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach;
endif;
}

function konstruc_get_portfolio_grid_layout2($posts = [], $settings = []){ 
    extract($settings);

    $images_size = !empty($img_size) ? $img_size : '600x378';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $img_id = get_post_thumbnail_id($post->ID);
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                if($img_id) {
                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $images_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $images_size);
                }  ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">

                    <div class="pxl-post--inner  <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                        <div class="pxl-post--featured">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>    
                        </div>
                        <div class="pxl-post--holder">
                            <div class="pxl-item--content">
                                <?php if($show_category == 'true'): ?>
                                    <div class="pxl-post--category">
                                        <?php the_terms( $post->ID, 'portfolio-category','', '' ); ?>
                                    </div>
                                <?php endif; ?>
                                <h5 class="pxl-post--title">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">   
                                        <?php echo esc_attr(get_the_title($post->ID)); ?>
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach;
    endif;
}

// End Portfolio Grid

/*--------------------------------------------------------------------------------------*/


/* Start Service Grid */
function konstruc_get_service_grid_layout1($posts = [], $settings = []){ 
    extract($settings);
    $images_size = !empty($img_size) ? $img_size : '828x328';
    if (is_array($posts)):
        $count_pos = 1;
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                    $col_xl_m = '66-pxl';
                } else {
                    $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                }
                if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                    $col_lg_m = '66-pxl';
                } else {
                    $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                }
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';
            $img_id = get_post_thumbnail_id($post->ID);
            $service_excerpt = get_post_meta($post->ID, 'service_excerpt', true);
            $service_external_link = get_post_meta($post->ID, 'service_external_link', true);
            $service_icon_type = get_post_meta($post->ID, 'service_icon_type', true);
            $service_icon_font = get_post_meta($post->ID, 'service_icon_font', true);
            $service_icon_img = get_post_meta($post->ID, 'service_icon_img', true); 
            $multi_text_country = get_post_meta($post->ID, 'multi_text_country', true);
            $icon_multi_text = get_post_meta($post->ID, 'icon_multi_text', true);

            ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                 <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                 $img_id = get_post_thumbnail_id($post->ID);
                 $img          = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $images_size
                ) );
                 $thumbnail    = $img['thumbnail']; 
                 ?>

                 <div class="pxl-post--featured">
                    <?php if($service_icon_type == 'icon' && !empty($service_icon_font)) : ?>
                        <div class="pxl-post--icon">
                            <i class="<?php echo esc_attr($service_icon_font); ?>"></i>
                        </div>
                    <?php endif; ?>
                    <?php if($service_icon_type == 'image' && !empty($service_icon_img)) : 
                        $icon_img = pxl_get_image_by_size( array(
                            'attach_id'  => $service_icon_img['id'],
                            'thumb_size' => 'full',
                        ));
                        $icon_thumbnail = $icon_img['thumbnail'];
                        ?>
                        <div class="pxl-post--icon">
                            <?php echo wp_kses_post($icon_thumbnail); ?>
                        </div>
                    <?php endif; ?>

                    <span class="count-pos">
                        <?php
                        if ($count_pos < 10) {
                            echo esc_html__('0'. $count_pos++,'konstruc');
                        }else{
                            echo esc_html__($count_pos++);  
                        }?>
                    </span>
                </div>

                <h3 class="pxl-post--title">
                    <a href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>"><?php echo pxl_print_html(get_the_title($post->ID)); ?></a>
                </h3>
                
                <div class="pxl-image--featured">
                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                        <?php echo wp_kses_post($thumbnail); ?>
                    </a>
                </div>

                <div class="pxl-holder-content">


                    <?php if($show_excerpt == 'true'): ?>
                        <div class="pxl-post--content">
                            <?php if($show_excerpt == 'true'): ?>
                                <?php
                                echo wp_trim_words( $post->post_excerpt, 20, null );
                                ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($multi_text_country)): ?>
                      <ul class="multi-text">
                        <?php foreach ($multi_text_country as $text): 
                            ?>
                            <li class="box-multi">
                                <i class="<?php echo esc_attr($icon_multi_text); ?>"></i>
                                <p><?php echo pxl_print_html($text); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php if($show_button == 'true') : ?>
                    <div class="pxl-post--readmore">
                        <a class="btn-readmore" href="<?php if(!empty($service_external_link)) { echo esc_url($service_external_link); } else { echo esc_url(get_permalink( $post->ID )); } ?>">
                            <span><?php if(!empty($button_text)) {
                                echo esc_attr($button_text);
                            } else {
                                echo esc_html__('Read More', 'konstruc');
                            } ?></span>
                            <div class="pxl-icon--plus"></div>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        <?php endif; ?>

    </div>
</div>
<?php endforeach;
endif;
}

// End Service Grid


/*--------------------------------------------------------------------------------------*/


add_action( 'wp_ajax_konstruc_load_more_post_grid', 'konstruc_load_more_post_grid' );
add_action( 'wp_ajax_nopriv_konstruc_load_more_post_grid', 'konstruc_load_more_post_grid' );
function konstruc_load_more_post_grid(){
    try{
        if(!isset($_POST['settings'])){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'konstruc'));
        }

        $settings = isset($_POST['settings']) ? $_POST['settings'] : null;

        $source = isset($settings['source']) ? $settings['source'] : '';
        $term_slug = isset($settings['term_slug']) ? $settings['term_slug'] : '';
        if( !empty($term_slug) && $term_slug !='*'){
            $term_slug = str_replace('.', '', $term_slug);
            $source = [$term_slug.'|'.$settings['tax'][0]]; 
        }
        if( isset($_POST['handler_click']) && sanitize_text_field(wp_unslash( $_POST[ 'handler_click' ] )) == 'filter'){
            set_query_var('paged', 1);
            $settings['paged'] = 1;
        }elseif( isset($_POST['handler_click']) && sanitize_text_field(wp_unslash( $_POST[ 'handler_click' ] )) == 'select_orderby'){
            set_query_var('paged', 1);
            $settings['paged'] = 1;
        }else{
            set_query_var('paged', (int)$settings['paged']);
        }

        extract(pxl_get_posts_of_grid($settings['post_type'], [
            'source'      => $source,
            'orderby'     => isset($settings['orderby'])?$settings['orderby']:'date',
            'order'       => isset($settings['order']) ? ($settings['orderby'] == 'title' ? 'asc' : sanitize_text_field($settings['order']) ) : 'desc',
            'limit'       => isset($settings['limit'])?$settings['limit']:'6',
            'post_ids'    => isset($settings['post_ids'])?$settings['post_ids']: [],
            'post_not_in' => isset($settings['post_not_in'])?$settings['post_not_in']: [],
        ],
        $settings['tax']
    ));

        ob_start();
        if( isset($settings['wg_type']) && $settings['wg_type'] == 'post-list'){
            konstruc_get_post_list($posts, $settings);
        }else{
            konstruc_get_post_grid($posts, $settings);
        }
        $html = ob_get_clean();

        $pagin_html = '';
        if( isset($settings['pagination_type']) && $settings['pagination_type'] == 'pagination' ){ 
            ob_start();
            konstruc()->page->get_pagination( $query,  true );
            $pagin_html = ob_get_clean();
        }

        $result_count = '';
        if( isset($settings['show_toolbar']) && $settings['show_toolbar'] == 'show' ){ 
            ob_start();
            if( (int)$settings['paged'] == 0){
                $limit_start = 1;
                $limit_end = ( (int)$settings['limit'] >= $total ) ? $total : (int)$settings['limit'];
            }else{
                $limit_start = (((int)$settings['paged'] - 1 ) * (int)$settings['limit']) + 1;
                $limit_end = (int)$settings['paged'] * (int)$settings['limit'];
                $limit_end = ( $limit_end >= $total ) ? $total : $limit_end;
            }
            if( isset($settings['pagination_type']) && $settings['pagination_type'] == 'loadmore' ){ 
                printf(
                    '<span class="result-count">%1$s %2$s %3$s %4$s %5$s</span>',
                    esc_html__('Showing','konstruc'),
                    '1-'.$limit_end,
                    esc_html__('of','konstruc'),
                    $total,
                    esc_html__('results','konstruc')
                );
            }else{
                printf(
                    '<span class="result-count">%1$s %2$s %3$s %4$s %5$s</span>',
                    esc_html__('Showing','konstruc'),
                    $limit_start.'-'.$limit_end,
                    esc_html__('of','konstruc'),
                    $total,
                    esc_html__('results','konstruc')
                );
            }

            $result_count = ob_get_clean();
        }

        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'konstruc'),
                'data' => array(
                    'html' => $html,
                    'pagin_html' => $pagin_html,
                    'paged' => $settings['paged'],
                    'posts' => $posts,
                    'max' => $max,
                    'result_count' => $result_count,
                ),
            )
        );
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}


