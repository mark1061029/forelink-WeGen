<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Search Box",
    "tag" => "h_search_box",
    "keywords" => ["search box"],
    "native" => true,
    "h_nav" => true,
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
                        "label" => "Expand To",
                        "type" => "slider",
                        "config" => array(
                            "min" => 40,
                            "max" => 1000,
                            "step" => 2
                        )
                    ),
                    "default_value" => 250
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
                    "default_value" => 14,
                    "styles" => array(
                        "@id .kong-header__searchBox__input" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_size",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Icon Size",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => 16,
                    "styles" => array(
                        "@id .kong-header__searchBox__submit" => array(
                            "fontSize" => "{{@model}}px"
                        ),
                        "@id" => array(
                            "width" => "{{@model}}px"
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
                    "default_value" => "9px 10px 9px 45px",
                    "styles" => array(
                        "@id .kong-header__searchBox__input" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_left",
                    "attrs" => array(
                        "label" => "Icon Active Left",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 16,
                    "styles" => array(
                        "@id.kong-header__searchBox--active .kong-header__searchBox__submit" => array(
                            "left" => "{{@model}}px"
                        )
                    )
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.open",
                    "attrs" => array(
                        "type" => "switch",
                        "label" => "Open",
                        "desc" => "Set the search box be opened"
                    ),
                    "default_value" => false
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
                        "@id .kong-header__searchBox__input" => array(
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
                    "default_value" => 100,
                    "styles" => array(
                        "@id .kong-header__searchBox__input" => array(
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
                        "@id .kong-header__searchBox__input,@id .kong-header__searchBox__submit" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.active_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Active Color"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id.kong-header__searchBox--active .kong-header__searchBox__input,@id.kong-header__searchBox--active .kong-header__searchBox__submit" => array(
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
                        "@id .kong-header__searchBox__input" => array(
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
                        "@id .kong-header__searchBox__input" => array(
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
                        "@id .kong-header__searchBox__input:focus" => array(
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
                        "@id .kong-header__searchBox__input:focus" => array(
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
                        "@id .kong-header__searchBox__input:focus" => array(
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
<div class="kong-header__searchBox {{::$ctrl.getID()}}"
     data-width="{{$ctrl.edited.attrs.width}}"
     ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <input class="kong-header__searchBox__input" type="text" placeholder="{{$ctrl.edited.attrs.placeholder}}"/>
    <label class="kong-header__searchBox__submit" kong-toggle-search-box>
        <i ng-class="$ctrl.edited.attrs.icon_thin ? 'lnr lnr-magnifier' : 'fa fa-search'"></i>
    </label>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lhb_h_search_box', 'lhb_h_search_box_callback');
function lhb_h_search_box_callback($attrs) {
    $attrs = shortcode_atts(array(
        'placeholder' => 'Search for something',
        'icon_right' => 'false',
        'icon_thin' => 'false',
        'open' => 'false',
        'width' => '200',
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

    $width = '';
    if(kong_to_boolean($attrs['open'])) {
        $classes[] = 'kong-header__searchBox--active';
        $width = ' style="width:'.$attrs['width'].'px"';
    }

    $classes[] = $attrs['class_id'];

    if (kong_to_boolean($attrs['icon_thin'])) {
        $icon = 'lnr lnr-magnifier';
    } else {
        $icon = 'fa fa-search';
    }

    $s = isset($_GET['s']) ? $_GET['s'] : '';

    $html = '<div class="kong-header__searchBox ' . implode(' ', $classes) . '" data-width="'.$attrs['width'].'"'.$width.'>';
    $html .= '<form role="search" method="get" action="' . get_home_url() . '">';
    $html .= '<input class="kong-header__searchBox__input" type="text" name="s" placeholder="' . $attrs['placeholder'] . '" value="' . $s . '"'.$width.' />';
    $html .= '<label class="kong-header__searchBox__submit"><i class="' . $icon . '"></i></label>';
    $html .= '</form>';
    $html .= '</div>';

    return $html;
}

