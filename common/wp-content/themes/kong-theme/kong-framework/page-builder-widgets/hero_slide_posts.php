<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Slideshow Posts",
    "tag" => "kong_fw_posts_slideshow",
    "keywords" => ["posts","slide","hero"],
    "native" => false,
    "icon_url" => KONG_FW_ROOT."/page-builder-widgets/img/hero-slide-posts.png",
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Settings",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_post",
                    "attrs" => array(
                        "label" => "Number of Posts",
                        "type" => "number",
                        "config" => array(
                            "min" => 2,
                            "max" => 8,
                            "step" => 1
                        )
                    ),
                    "default_value" => 4
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
                    "bind_to" => "@attrs.autoplay",
                    "attrs" => array(
                        "label" => "Auto Play",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.effect",
                    "attrs" => array(
                        "label" => "Effect",
                        "type" => "text-buttons",
                        "config" => array(
                            "options" => array(
                                "slide" => "Slide",
                                "fade" => "Fade"
                            )
                        )
                    ),
                    "default_value" => "slide"
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "General Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => ["px","vh"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100vh"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-heroSlider, @id .kong-heroSlider .owl-item" => array(
                            "height" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.overlay",
                    "attrs" => array(
                        "label" => "Overlay",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "rgba(0,0,0,0.5)",
                    "styles" => array(
                        "@id .kong-heroSlider__overlay, @id .kong-heroSlider" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_margin",
                    "attrs" => array(
                        "label" => "Content Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => -100,
                            "max" => 120,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "30px 0px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-heroSlider__content" => array(
                            "margin" => "{{@model}}"
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
                        "label" => "Title Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 60,
                        "mobile" => 42
                    ),
                    "responsive_styles" => array(
                        "@id .kong-heroSlider__title" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.title_color",
                    "attrs" => array(
                        "label" => "Overlay",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-heroSlider__title" => array(
                            "color" => "{{@model}}"
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
                    "default_value" => 0.12,
                    "styles" => array(
                        "@id .kong-heroSlider__title" => array(
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
                    "default_value" => 400,
                    "styles" => array(
                        "@id .kong-heroSlider__title" => array(
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
                        "@id .kong-heroSlider__title" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Pagination",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.pag",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id .kong-heroSlider .owl-dot" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.pag_active",
                    "attrs" => array(
                        "label" => "Active",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-heroSlider .owl-dot.active" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Button",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        "@id .kong-heroSlider__link" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id .kong-heroSlider__link" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id .kong-heroSlider__link" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_bg_hover",
                    "attrs" => array(
                        "label" => "Background Hover",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-heroSlider__link:hover" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_color_hover",
                    "attrs" => array(
                        "label" => "Color Hover",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id .kong-heroSlider__link:hover" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_border_color_hover",
                    "attrs" => array(
                        "label" => "Border Hover",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-heroSlider__link:hover" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Excerpt",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc",
                    "attrs" => array(
                        "label" => "Link",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#dddddd",
                    "styles" => array(
                        "@id .kong-heroSlider__desc" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => -100,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "30px 0px 50px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-heroSlider__desc" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Author",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.author_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#dddddd",
                    "styles" => array(
                        "@id .kong-heroSlider__author" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.author_link_color",
                    "attrs" => array(
                        "label" => "Link",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-heroSlider__author a" => array(
                            "color" => "{{@model}}"
                        )
                    )
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
<div class="kong-hero-slide {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]"
     id="{{$ctrl.edited.attrs.id}}">
    <kong-shortcode tag="kong_fw_posts_slideshow_content" model="$ctrl.edited"
                     attrs="['num_post', 'start', 'categories', 'autoplay', 'pagination', 'nav', 'effect']"
                     callback="[{'function':'kongHeroSliderCarousel','selector':'.kong-heroSlider'},{'function':'kongLazyImage','selector':'.kong-heroSlider'}]"></div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_fw_posts_slideshow', 'kong_fw_posts_slideshow_callback');
function kong_fw_posts_slideshow_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'num_post' => 4,
        'categories' => '',
        'autoplay' => 'true',
        'pagination' => 'true',
        'nav' => 'true',
        'effect' => 'slide',
        'start' => 1
    ), $attrs);

    $classes = array();
    $classes[] = $attrs['class_id'];

    if (!empty($attrs['class'])) {
        $classes[] = $attrs['class'];
    }

    if (!empty($attrs['hidden'])) {
        $classes[] = $attrs['hidden'];
    }

    $id = !empty($attrs['id']) ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-hero-slide <?php echo implode(' ', $classes); ?>"<?php echo $id ?>>
        <?php echo do_shortcode('[kong_fw_posts_slideshow_content num_post="' . $attrs['num_post'] . '" start="' . $attrs['start'] . '" categories="' . $attrs['categories'] . '" autoplay="' . $attrs['autoplay'] . '" pagination="' . $attrs['pagination'] . '" nav="' . $attrs['nav'] . '" effect="' . $attrs['effect'] . '"]') ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_fw_posts_slideshow_content', 'kong_fw_posts_slideshow_content_callback');
function kong_fw_posts_slideshow_content_callback($attrs) {
    $attrs = shortcode_atts(array(
        'num_post' => 4,
        'categories' => '',
        'autoplay' => 'true',
        'pagination' => 'true',
        'nav' => 'true',
        'effect' => 'slide',
        'start' => 1
    ), $attrs);

    $args = array(
        'posts_per_page' => $attrs['num_post'],
        'post_status' => 'publish',
        'offset' => $attrs['start'] - 1
    );

    if (!empty($attrs['categories'])) {
        $args['category__in'] = explode(',', $attrs['categories']);
    }

    $post_params = str_replace(']', '_kong_fw_bracket_close_', str_replace('[', '_kong_fw_bracket_open_', json_encode($args)));

    return do_shortcode('[kong_fw_posts_slide_content slide_autoplay="' . $attrs['autoplay'] . '" slide_pagination="' . $attrs['pagination'] . '" slide_nav="' . $attrs['nav'] . '" slide_effect="' . $attrs['effect'] . '" post_params=\'' . $post_params . '\']');
}

add_shortcode('kong_fw_posts_slide_content', 'kong_fw_hero_slide_content_callback');
function kong_fw_hero_slide_content_callback($attrs) {
    $attrs = shortcode_atts(array(
        'slide_effect' => 'slide',
        'slide_autoplay' => 'true',
        'slide_pagination' => 'true',
        'slide_nav' => 'true',
        'post_params' => json_encode(array(
            'posts_per_page' => 3,
            'post_status' => 'publish'
        ))
    ), $attrs, 'kong_fw_pb');

    $slide_settings = array();
    $slide_settings['effect'] = $attrs['slide_effect'];
    $slide_settings['autoplay'] = kong_fw_theme_to_boolean($attrs['slide_autoplay']);
    $slide_settings['pagination'] = kong_fw_theme_to_boolean($attrs['slide_pagination']);
    $slide_settings['nav'] = kong_fw_theme_to_boolean($attrs['slide_nav']);

    $post_params = json_decode($attrs['post_params']);

    return kong_fw_slideshow_post_render($slide_settings, $post_params);
}