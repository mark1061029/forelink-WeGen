<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Separator",
    "tag" => "h_separator",
    "keywords" => ["separator","space","divider","gap"],
    "native" => true,
    "h_nav" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Spacing",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.left_margin",
                    "attrs" => array(
                        "label" => "Left",
                        "type" => "slider",
                        "config" => array(
                            "min" => 3,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => 10,
                    "styles" => array(
                        "@id" => array(
                            "marginLeft" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.right_margin",
                    "attrs" => array(
                        "label" => "Right",
                        "type" => "slider",
                        "config" => array(
                            "min" => 3,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => 10,
                    "styles" => array(
                        "@id" => array(
                            "marginRight" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 6,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 18,
                    "styles" => array(
                        "@id" => array(
                            "height" => "{{@model}}px"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Border",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_style",
                    "attrs" => array(
                        "label" => "Style",
                        "type" => "border-style"
                    ),
                    "default_value" => "solid",
                    "styles" => array(
                        "@id" => array(
                            "borderLeftStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "if" => "@attrs.border_style != 'none'",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.border_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["border"],
                            "styles" => array(
                                "@id" => array(
                                    "borderLeftColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.border_width",
                            "attrs" => array(
                                "label" => "Width",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 1,
                                    "max" => 7,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 1,
                            "styles" => array(
                                "@id" => array(
                                    "borderLeftWidth" => "{{@model}}px"
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
                        "label" => "Custom Class",
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
    <div class="kong-header__separator {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]"></div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_h_separator', 'lhb_h_separator_callback');
function lhb_h_separator_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'hidden' => '',
        'class' => '',
        'class_id' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];

    $html = '<div class="kong-header__separator ' . implode(' ', $classes).'"></div>';

    return $html;
}