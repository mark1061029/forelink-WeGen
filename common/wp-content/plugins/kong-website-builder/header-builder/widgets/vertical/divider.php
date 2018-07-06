<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Divider",
    "tag" => "v_divider",
    "keywords" => ["divider","gap","separator"],
    "native" => true,
    "v_nav" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Content"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.width",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Width",
                        "config" => array(
                            "min" => 1,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 100,
                    "styles" => array(
                        "@id .kong-aside__divider__line" => array(
                            "width" => "{{@model}}%"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.padding",
                    "attrs" => array(
                        "type" => "area2",
                        "label" => "Padding",
                        "config" => array(
                            "min" => 5,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => "20px 0px 20px 0px",
                    "styles" => array(
                        "@id" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_style",
                    "attrs" => array(
                        "type" => "border-style",
                        "label" => "Border"
                    ),
                    "default_value" => "solid",
                    "styles" => array(
                        "@id .kong-aside__divider__line" => array(
                            "borderStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "if" => "@attrs.border_style != 'none'",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.thickness",
                            "attrs" => array(
                                "type" => "slider",
                                "label" => "Thickness",
                                "config" => array(
                                    "min" => 1,
                                    "max" => 10,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 1,
                            "styles" => array(
                                "@id .kong-aside__divider__line" => array(
                                    "borderTopWidth" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.border_color",
                            "attrs" => array(
                                "type" => "colorpicker",
                                "label" => "Color"
                            ),
                            "default_value" => $manager::$colors["border"],
                            "styles" => array(
                                "@id .kong-aside__divider__line" => array(
                                    "borderColor" => "{{@model}}"
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
                "label" => "Hidden & Class"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hidden",
                    "attrs" => array(
                        "type" => "device-hidden",
                        "label" => "Devices"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.class",
                    "attrs" => array(
                        "type" => "text",
                        "label" => "Class"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
);

ob_start();
?>
<div class="kong-aside__divider {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <div class="kong-aside__divider__line"></div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_v_divider', 'lhb_v_divider_callback');
function lhb_v_divider_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'hidden' => '',
        'class' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    $classes[] = $attrs['class_id'];

    $html = '<div class="kong-aside__divider ' . implode(' ', $classes) . '"><div class="kong-aside__divider__line"></div></div>';

    return $html;
}
