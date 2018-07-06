<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Search Box",
    "tag" => "v_search_box",
    "keywords" => ["search box"],
    "native" => true,
    "v_nav" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Size & Icon",
                "collapse" => true
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.width",
                    "attrs" => array(
                        "label" => "Width",
                        "type" => "unit"
                    ),
                    "default_value" => "100%",
                    "styles" => array(
                        "@id .kong-aside__searchBox__container" => array(
                            "width" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_size",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Font Size",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => 16,
                    "styles" => array(
                        "@id .kong-aside__searchBox__input" => array(
                            "fontSize" => "{{@model}}px"
                        ),
                        "@id .kong-aside__searchBox__submit" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "8px 10px 8px 40px",
                    "styles" => array(
                        "@id .kong-aside__searchBox__input" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_margin",
                    "attrs" => array(
                        "label" => "Icon Margin",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 15,
                    "styles" => array(
                        "@id .kong-aside__searchBox__submit" => array(
                            "margin" => "0 {{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_right",
                    "attrs" => array(
                        "type" => "switch",
                        "label" => "Icon Right"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_thin",
                    "attrs" => array(
                        "type" => "switch",
                        "label" => "Icon Thin"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.placeholder",
                    "attrs" => array(
                        "type" => "text",
                        "label" => "Placeholder"
                    ),
                    "default_value" => "Search for something"
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
                    "bind_to" => "@attrs.border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "1px 1px 1px 1px",
                    "styles" => array(
                        "@id .kong-aside__searchBox__input" => array(
                            "borderWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-aside__searchBox__input" => array(
                            "borderRadius" => "{{@model}}px"
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
                    "bind_to" => "@attrs.color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Color"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-aside__searchBox__input,@id .kong-aside__searchBox__submit" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Background"
                    ),
                    "default_value" => $manager::$colors["body"],
                    "styles" => array(
                        "@id .kong-aside__searchBox__input" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "if" => "@attrs.border_width != '0px 0px 0px 0px'",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Border"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id .kong-aside__searchBox__input" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.focus_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Focus Color"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-aside__searchBox__input:focus" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.focus_bg_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Focus Background"
                    ),
                    "default_value" => $manager::$colors["body"],
                    "styles" => array(
                        "@id .kong-aside__searchBox__input:focus" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.focus_border_color",
                    "if" => "@attrs.border_width != '0px 0px 0px 0px'",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Focus Border"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id .kong-aside__searchBox__input:focus" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
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
<div class="kong-aside__searchBox {{::$ctrl.getID()}}"
     ng-class="[{'kong-aside__searchBox--iconRight' : $ctrl.edited.attrs.icon_right}, $ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <div class="kong-aside__searchBox__container">
        <input class="kong-aside__searchBox__input" type="text" placeholder="{{$ctrl.edited.attrs.placeholder}}"/>
        <label class="kong-aside__searchBox__submit"><i ng-class="$ctrl.edited.attrs.icon_thin ? 'lnr lnr-magnifier' : 'fa fa-search'"></i></label>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_v_search_box', 'lhb_v_search_box_callback');
function lhb_v_search_box_callback($attrs) {
    $attrs = shortcode_atts(array(
        'placeholder' => 'Search for something',
        'icon_right' => 'false',
        'icon_thin' => 'false',
        'hidden' => '',
        'class' => '',
        'class_id' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if (kong_to_boolean($attrs['icon_right'])) {
        $classes[] = 'kong-aside__searchBox--iconRight';
    }

    $classes[] = $attrs['class_id'];

    if (kong_to_boolean($attrs['icon_thin'])) {
        $icon = 'lnr lnr-magnifier';
    } else {
        $icon = 'fa fa-search';
    }

    $s = isset($_GET['s']) ? $_GET['s'] : '';

    $html = '<div class="kong-aside__searchBox ' . implode(' ', $classes) . '">';
    $html .= '<div class="kong-aside__searchBox__container">';
    $html .= '<form role="search" method="get" action="' . get_home_url() . '">';
    $html .= '<input class="kong-aside__searchBox__input" type="text" name="s" placeholder="' . $attrs['placeholder'] . '" value="' . $s . '" />';
    $html .= '<label class="kong-aside__searchBox__submit"><i class="' . $icon . '"></i></label>';
    $html .= '</form>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}
