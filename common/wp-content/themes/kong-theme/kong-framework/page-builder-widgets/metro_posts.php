<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Metro Posts",
    "tag" => "kong_fw_metro_posts",
    "keywords" => ["posts","metro"],
    "native" => false,
    "icon_url" => KONG_FW_ROOT."/page-builder-widgets/img/metro-posts.png",
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Content",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num",
                    "attrs" => array(
                        "label" => "Number of Posts",
                        "type" => "number",
                        "config" => array(
                            "min" => 3,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 5
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.start",
                    "attrs" => array(
                        "label" => "Start",
                        "type" => "number",
                        "config" => array(
                            "min" => 1,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 1
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.categories",
                    "attrs" => array(
                        "label" => "Categories",
                        "type" => "multi-select",
                        "config" => array(
                            "message" => "Select Categories",
                            "list" => $category_obj
                        )
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.order",
                    "attrs" => array(
                        "label" => "Order",
                        "type" => "text-buttons",
                        "config" => array(
                            "options" => array(
                                "DESC" => "Descending",
                                "ASC" => "Ascending"
                            )
                        )
                    ),
                    "default_value" => "DESC"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.custom_style",
                    "attrs" => array(
                        "label" => "Custom Style",
                        "type" => "switch"
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "if" => "@attrs.custom_style",
            "content" => [
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "List",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.size_list",
                            "reload" => true,
                            "attrs" => array(
                                "label" => "Size List",
                                "type" => "selection",
                                "config" => array(
                                    "s14" => "Square 1/4",
                                    "s13" => "Square 1/3",
                                    "s14,s14,s12,s14,s14,s12,s14,s14,s14,s14" => "Mixed Square 1/2 1/4",
                                    "custom" => "Custom"
                                )
                            ),
                            "default_value" => "s14"
                        ),
                        array(
                            "if" => "@attrs.size_list == 'custom'",
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.size_list_custom",
                            "attrs" => array(
                                "fullwidth" => true,
                                "type" => "textarea"
                            ),
                            "default_value" => "s13,s13,s13,s13,h23"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.scroll_effect",
                            "attrs" => array(
                                "label" => "Scroll Effect",
                                "type" => "selection",
                                "config" => array(
                                    "none" => "None",
                                    "kong-sa--moveTop" => "Move Top",
                                    "kong-sa--moveTopLightRotate" => "Move Top Light Rotate",
                                    "kong-sa--moveTopLeft" => "Move Top Left",
                                    "kong-sa--moveTopRight" => "Move Top Right",
                                    "kong-sa--moveLeft" => "Move Left",
                                    "kong-sa--moveRight" => "Move Right",
                                    "kong-sa--fadeIn" => "Fade In",
                                    "kong-sa--scaleOut" => "Scale Out"
                                )
                            ),
                            "default_value" => "kong-sa--scaleOut"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.body_bg",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#000000",
                            "styles" => array(
                                "@id .kong-blogMetro" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Box",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.arrange_content",
                            "attrs" => array(
                                "label" => "Arrange Content",
                                "type" => "text-buttons",
                                "config" => array(
                                    "options" => array(
                                        "kong-blogMetro--flexStart" => "Start",
                                        "kong-blogMetro--spaceBetween" => "Space",
                                        "kong-blogMetro--flexEnd" => "End"
                                    )
                                )
                            ),
                            "default_value" => "kong-blogMetro--flexEnd"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.item_bg",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#232323",
                            "styles" => array(
                                "@id .kong-bmi__wrap" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.height",
                            "attrs" => array(
                                "label" => "Height",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 50,
                                    "max" => 100,
                                    "step" => 2
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 100
                            ),
                            "responsive_styles" => array(
                                "@id .kong-blogMetro [class*='kong-metro--s'] > *" => array(
                                    "paddingBottom" => "{{@model}}%"
                                ),
                                "@id .kong-blogMetro [class*='kong-metro--v'] > *" => array(
                                    "paddingBottom" => "{{@model*2}}%"
                                ),
                                "@id .kong-blogMetro [class*='kong-metro--h'] > *" => array(
                                    "paddingBottom" => "{{@model/2}}%"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.padding",
                            "attrs" => array(
                                "label" => "Padding",
                                "type" => "res-area",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => "20px 20px 20px 20px"
                            ),
                            "responsive_styles" => array(
                                "@id .kong-bmi__content" => array(
                                    "padding" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Title",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_size",
                            "attrs" => array(
                                "label" => "Title Font Size",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 10,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 32,
                                "mobile" => 20
                            ),
                            "responsive_styles" => array(
                                "@id .kong-bmi__title" => array(
                                    "fontSize" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#ffffff",
                            "styles" => array(
                                "@id .kong-bmi__title" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_margin",
                            "attrs" => array(
                                "label" => "Margin",
                                "type" => "res-area2",
                                "config" => array(
                                    "min" => -20,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => "15px 0px 15px 0px"
                            ),
                            "responsive_styles" => array(
                                "@id .kong-bmi__title" => array(
                                    "margin" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_letter_spacing",
                            "attrs" => array(
                                "label" => "Letter Spacing",
                                "type" => "slider",
                                "config" => array(
                                    "min" => -0.1,
                                    "max" => 0.5,
                                    "step" => 0.01
                                )
                            ),
                            "default_value" => 0,
                            "styles" => array(
                                "@id .kong-bmi__title" => array(
                                    "letterSpacing" => "{{@model}}em"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_weight",
                            "attrs" => array(
                                "label" => "Weight",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 100,
                                    "max" => 900,
                                    "step" => 100
                                )
                            ),
                            "default_value" => 700,
                            "styles" => array(
                                "@id .kong-bmi__title" => array(
                                    "fontWeight" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_transform",
                            "attrs" => array(
                                "label" => "Text Transform",
                                "type" => "text-transform"
                            ),
                            "default_value" => "uppercase",
                            "styles" => array(
                                "@id .kong-bmi__title" => array(
                                    "textTransform" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Color",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.author_color",
                            "attrs" => array(
                                "label" => "Author",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#ffffff",
                            "styles" => array(
                                "@id .kong-bmi__author" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.date_color",
                            "attrs" => array(
                                "label" => "Date",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#eeeeee",
                            "styles" => array(
                                "@id .kong-bmi__date" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.footer_color",
                            "attrs" => array(
                                "label" => "Category",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#ffffff",
                            "styles" => array(
                                "@id .kong-bmi__footer" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Overlay",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.overlay",
                            "attrs" => array(
                                "label" => "Gradient",
                                "type" => "gradient",
                                "config" => array(
                                    "third_color" => true,
                                    "radial" => false
                                )
                            ),
                            "default_value" => array(
                                "color_1" => "rgba(0,0,0,0.5)",
                                "color_2" => "rgba(0,0,0,0.5)",
                                "color_3" => "rgba(0,0,0,0.5)",
                                "angle" => 180,
                                "value" => "linear-gradient(180deg, rgba(0,0,0,0.5), rgba(0,0,0,0.5), rgba(0,0,0,0.5))"
                            ),
                            "styles" => array(
                                "@id .kong-bmi__overlay" => array(
                                    "background" => "{{@model.value}}"
                                )
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Paging",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.paging",
                    "attrs" => array(
                        "label" => "Paging",
                        "type" => "text-buttons",
                        "config" => array(
                            "options" => array(
                                "none" => "None",
                                "button" => "Button",
                                "infinite" => "Infinite"
                            )
                        )
                    ),
                    "default_value" => "none"
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hidden on",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hidden",
                    "attrs" => array(
                        "label" => "Devices",
                        "type" => "device-hidden"
                    ),
                    "default_value" => ""
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "ID & Class",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.class",
                    "attrs" => array(
                        "label" => "Class",
                        "type" => "class"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.id",
                    "attrs" => array(
                        "label" => "ID",
                        "type" => "id"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
);

ob_start();
?>
<div class="kong-metro-posts {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
    <kong-shortcode tag="kong_fw_metro_posts_content" model="$ctrl.edited"
                     addition="pb='true'"
                     attrs="['num', 'start', 'categories', 'order', 'scroll_effect','arrange_content', 'paging', 'custom_style', 'size_list', 'size_list_custom']"
                     callback="[{'function':'kongBindBlogLoadMore','selector':'.kong-blogMetro__loadMoreBtn'},{'function':'kongBindBlogInfiniteScroller','selector':'.kong-blogMetro__infiniteScroller'},{'function':'kongLazyImage','selector':'.kong-blogMetro'}]"></div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_fw_metro_posts', 'kong_fw_metro_posts_callback');
function kong_fw_metro_posts_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'num' => 6,
        'order' => 'DESC',
        'categories' => '',
        'paging' => 'none',
        'custom_style' => 'false',
        'scroll_effect' => 'kong-sa--scaleOut',
        'arrange_content' => 'kong-blogMetro--spaceBetween',
        'size_list' => 's14',
        'size_list_custom' => 's13,s13,s13,s13,h23',
        'start' => 1
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-metro-posts <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <?php echo do_shortcode('[kong_fw_metro_posts_content num="' . $attrs['num'] . '" start="' . $attrs['start'] . '" order="' . $attrs['order'] . '" categories="' . $attrs['categories'] . '" paging="' . $attrs['paging'] . '" scroll_effect="' . $attrs['scroll_effect'] . '" custom_style="' . $attrs['custom_style'] . '" arrange_content="' . $attrs['arrange_content'] . '" size_list="' . $attrs['size_list'] . '" size_list_custom="' . $attrs['size_list_custom'] . '"]'); ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_fw_metro_posts_content', 'kong_fw_metro_posts_content_callback');
function kong_fw_metro_posts_content_callback($attrs) {
    $attrs = shortcode_atts(array(
        'num' => 6,
        'order' => 'DESC',
        'categories' => '',
        'paging' => 'none',
        'custom_style' => 'false',
        'scroll_effect' => 'kong-sa--scaleOut',
        'arrange_content' => 'kong-blogMetro--spaceBetween',
        'size_list' => 's14',
        'size_list_custom' => 's13,s13,s13,s13,h23',
        'start' => 1,
        'pb' => 'false'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $categories = array();
    $offset = $attrs['start'] - 1;

    $args = array(
        'numberposts' => $attrs['num'] + 1,
        'order' => $attrs['order'],
        'offset' => $offset
    );

    if (!empty($attrs['categories'])) {
        $attrs['categories'] = explode(',', $attrs['categories']);

        foreach ($attrs['categories'] as $category_id) {
            $categories[] = (int)$category_id;
        }

        $args['category__in'] = $categories;
    }

    $posts = get_posts($args);

    global $post;
    $has_paging = false;

    if (count($posts) > $attrs['num']) {
        $has_paging = true;
        array_pop($posts);
    }

    $options = kong_fw_get_options();

    if (kong_fw_theme_to_boolean($attrs['custom_style'])) {
        $scroll_effect = $attrs['scroll_effect'];
        $arrange_content = $attrs['arrange_content'];
        $sizes = kong_fw_get_metro_sizes($attrs['size_list'], $attrs['size_list_custom']);
    } else {
        $scroll_effect = $options['blog_metro_scroll_effect'];
        $arrange_content = $options['blog_metro_arrange_content'];
        $size_list = isset($options['blog_metro_size_list']) ? $options['blog_metro_size_list'] : '';
        $size_list_custom = isset($options['blog_metro_size_list_custom']) ? $options['blog_metro_size_list_custom'] : '';
        $sizes = kong_fw_get_metro_sizes($size_list, $size_list_custom);
    }

    $sizes_temp = $sizes;
    $data_animate_scroll = '';

    if(!empty($scroll_effect) && $scroll_effect != 'none'){
        $data_animate_scroll = ' data-animate-scroll="'.$scroll_effect.'"';
    }

    $class_arrange_content = !empty($arrange_content) ? ' '.$arrange_content : ' kong-blogMetro--spaceBetween';

    $min = array();

    foreach ($sizes as $size) {
        $numerator = substr($size, 1, 1);
        $denominator = substr($size, 2, 1);

        if (empty($min) || $numerator / $denominator < $min['numerator'] / $min['denominator']) {
            $min = array(
                'numerator' => $numerator,
                'denominator' => $denominator
            );
        }
    }

    ob_start(); ?>
    <div class="kong-blog kong-blogMetro<?php echo $class_arrange_content; ?>"<?php echo $data_animate_scroll;?>>
        <div class="kong-blogMetro__sizer kong-metro--s<?php echo $min['numerator'] . $min['denominator'] ?>"></div>
        <?php
        if (!empty($posts)) :
            foreach ($posts as $post) :
                setup_postdata($post);

                if (!count($sizes_temp)) {
                    $sizes_temp = $sizes;
                }

                $metro_class = 'kong-metro--' . array_shift($sizes_temp);
                kong_fw_metro_post_item_render(array('scroll_effect' => $scroll_effect), array($metro_class));
            endforeach;

            wp_reset_postdata();
        endif;
        ?>
    </div>

    <?php if (kong_fw_theme_to_boolean($attrs['pb'])) : ?>
        <img src="<?php echo KONG_FW_ROOT . '/img/article.png'; ?>" style="display: none;" onload="jQuery(this).prev().kongBindMetroMasonry()" />
    <?php endif; ?>

    <?php
    if ($attrs['paging'] != 'none' && $has_paging) {
        $data = array();

        if (!empty($categories)) {
            $data['type'] = 'category';
            $data['data'] = $categories;
        } else {
            $data['type'] = 'posts';
        }

        switch($attrs['paging']):
            case 'button':
                $config = array(
                    'settings' => array(
                        'limit' => $attrs['num'],
                        'offset' => $offset + $attrs['num'],
                        'orderby' => 'date',
                        'order' => $attrs['order'],
                        'data' => $data,
                        'type' => 'metro',
                        'append_to' => '.kong-blogMetro',
                        'text' => !empty($options['blog_loadmore_text']) ? $options['blog_loadmore_text'] : '',
                        'loading_text' => !empty($options['blog_loadmore_loading_text']) ? $options['blog_loadmore_loading_text'] : '',
                        'load_all_text' => !empty($options['blog_loadmore_load_all_text']) ? $options['blog_loadmore_load_all_text'] : '',
                        'masonry' => true
                    ),
                    'custom_settings' => array(
                        'sizes' => $sizes,
                        'sizes_temp' => $sizes_temp
                    ),
                    'custom_class' => 'kong-blogMetro__loadMoreBtn'
                );

                if($data_animate_scroll){
                    $config['custom_settings']['scroll_effect'] = $scroll_effect;
                }

                kong_fw_load_more_button_render($config);

                break;
            case 'infinite':
                $config = array(
                    'settings' => array(
                        'limit' => $attrs['num'],
                        'offset' => $offset + $attrs['num'],
                        'orderby' => 'date',
                        'order' => $attrs['order'],
                        'data' => $data,
                        'append_to' => '.kong-blogMetro',
                        'type' => 'metro',
                        'masonry' => true
                    ),
                    'custom_settings' => array(
                        'sizes' => $sizes,
                        'sizes_temp' => $sizes_temp
                    ),
                    'custom_class' => 'kong-blogMetro__infiniteScroller'
                );

                if($data_animate_scroll){
                    $config['custom_settings']['scroll_effect'] = $scroll_effect;
                }

                kong_fw_infinite_scroller_render($config);

                break;
            default:
                break;
        endswitch;
    }

    return ob_get_clean();
}