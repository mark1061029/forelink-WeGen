<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Twitter",
    "tag" => "v_twitter",
    "keywords" => ["twitter","tweet"],
    "native" => true,
    "v_nav" => true,
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
                        "label" => "Number of Tweets",
                        "type" => "number",
                        "config" => array(
                            "min" => 1,
                            "max" => 10,
                            "step" => 1
                        )
                    ),
                    "default_value" => 5
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 16,
                    "styles" => array(
                        "@id" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.distance",
                    "attrs" => array(
                        "label" => "Distance",
                        "type" => "slider",
                        "config" => array(
                            "min" => 5,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 10,
                    "styles" => array(
                        "@id .kong-widget__media-item" => array(
                            "padding" => "{{@model}}px 0"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_style",
                    "attrs" => array(
                        "label" => "Border Style",
                        "type" => "border-style"
                    ),
                    "default_value" => "dashed",
                    "styles" => array(
                        "@id .kong-widget__media-item" => array(
                            "borderBottomStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id .kong-widget__media-item" => array(
                            "borderBottomColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.avatar_size",
                    "attrs" => array(
                        "label" => "Avatar Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 24,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => 36,
                    "styles" => array(
                        "@id .kong-widget__media__avatar" => array(
                            "width" => "{{@model}}px",
                            "height" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_color",
                    "attrs" => array(
                        "label" => "Name Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-widget__twitter__user" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_color",
                    "attrs" => array(
                        "label" => "Text Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id .kong-widget__twitter__content" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_link_color",
                    "attrs" => array(
                        "label" => "Link Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-widget__twitter__content a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.time_color",
                    "attrs" => array(
                        "label" => "Time Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        "@id .kong-widget__twitter__time" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hidden & Class",
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.class",
                    "attrs" => array(
                        "label" => "Class",
                        "type" => "text"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
);

ob_start();
?>
<div class="kong-aside__twitter {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]"
     kong-twitter number-items="$ctrl.edited.attrs.num"></div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_v_twitter', 'lhb_v_twitter_callback');
function lhb_v_twitter_callback($attrs) {
    $attrs = shortcode_atts(array(
        'num' => 5,
        'hidden' => '',
        'class' => '',
        'class_id' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = [];

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    $classes[] = $attrs['class_id'];

    $html = '<div class="kong-twitter" data-num="' . $attrs['num'] . '">';
    $html .= '<ul class="kong-aside__twitter ' . implode(' ', $classes) . '"><div class="kong-contentLoader"><span></span><span></span><span></span></div></ul>';
    $html .= '</div>';

    return $html;
}