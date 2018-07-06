<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Search Button",
    "tag" => "h_search_button",
    "keywords" => ["search","button"],
    "native" => true,
    "h_nav" => true,
    "enable" => false,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Icon",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => 16,
                    "styles" => array(
                        "@id .kong-header__search__btn" => array(
                            "fontSize" => "{{@model}}px"
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
                            "min" => 20,
                            "max" => 200,
                            "step" => 2
                        )
                    ),
                    "default_value" => 40,
                    "styles" => array(
                        "@id" => array(
                            "height" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_thin",
                    "attrs" => array(
                        "label" => "Thin",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Popup",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model.enable",
                    "attrs" => array(
                        "label" => "Open Popup",
                        "type" => "switch",
                        "desc" => "Activate this Switch to show the popup for editing style."
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@model.enable",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.placeholder",
                            "attrs" => array(
                                "label" => "Placeholder",
                                "type" => "text"
                            ),
                            "default_value" => "Type to Search..."
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.position_right",
                            "attrs" => array(
                                "label" => "Right",
                                "type" => "switch"
                            ),
                            "default_value" => true
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.arrow",
                            "attrs" => array(
                                "label" => "Arrow",
                                "type" => "switch"
                            ),
                            "default_value" => true
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["heading"],
                            "styles" => array(
                                "@id .kong-header__search__input" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.bg_color",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["body"],
                            "styles" => array(
                                "@id .kong-header__search__popup,@id .kong-header__search__input" => array(
                                    "backgroundColor" => "{{@model}}"
                                ),
                                "@id .kong-header__search__popup:after" => array(
                                    "borderBottomColor" => "{{@model}}"
                                )
                            )
                        ),
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
                                "@id .kong-header__search__popup" => array(
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
                            "default_value" => 3,
                            "styles" => array(
                                "@id .kong-header__search__popup" => array(
                                    "borderRadius" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.border_color",
                            "attrs" => array(
                                "label" => "Border",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["border"],
                            "styles" => array(
                                "@id .kong-header__search__popup" => array(
                                    "borderColor" => "{{@model}}"
                                ),
                                "@id .kong-header__search__popup:before" => array(
                                    "borderBottomColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.font_size",
                            "attrs" => array(
                                "label" => "Font Size",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 10,
                                    "max" => 40,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 14,
                            "styles" => array(
                                "@id .kong-header__search__input" => array(
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
                            "default_value" => "5px 5px 5px 5px",
                            "styles" => array(
                                "@id .kong-header__search__popup" => array(
                                    "padding" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.box_shadow",
                            "attrs" => array(
                                "label" => "Box Shadow",
                                "type" => "box-shadow"
                            ),
                            "default_value" => "none",
                            "styles" => array(
                                "@id .kong-header__search__popup" => array(
                                    "boxShadow" => "{{@model}}"
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
<div class="kong-header__search {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
                <span class="kong-header__search__btn">
                    <i ng-class="$ctrl.edited.attrs.icon_thin ? 'lnr lnr-magnifier' : 'fa fa-search'"></i>
                </span>
    <div class="kong-header__search__popup"
         ng-class="{'kong-header__search__popup--hasArrow' : $ctrl.edited.attrs.arrow,'kong-header__search__popup--enabled':$ctrl.edited.enable,
                                    'kong-header__search__popup--right':$ctrl.edited.attrs.position_right}">
        <div class="kong-header__search__wrap">
            <input class="kong-header__search__input" type="text" placeholder="{{$ctrl.edited.attrs.placeholder}}"/>
        </div>
    </div>
    <div class="kong-header__search__backdrop"></div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_h_search_button', 'lhb_h_search_button_callback');
function lhb_h_search_button_callback($attrs) {
    $attrs = shortcode_atts(array(
        'placeholder' => 'Search for something',
        'position_right' => 'false',
        'arrow' => 'true',
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

    $classes[] = $attrs['class_id'];

    if (kong_to_boolean($attrs['icon_thin'])) {
        $icon = 'lnr lnr-magnifier';
    } else {
        $icon = 'fa fa-search';
    }

    $popup_classes = [];
    if(kong_to_boolean($attrs['arrow'])){
        $popup_classes[] = 'kong-header__search__popup--hasArrow';
    }
    if(kong_to_boolean($attrs['position_right'])){
        $popup_classes[] =  'kong-header__search__popup--right';
    }


    $s = isset($_GET['s']) ? $_GET['s'] : '';

    $html = '<div class="kong-header__search ' . implode(' ', $classes) . '">';
    $html .= '<span class="kong-header__search__btn"><i class="'.$icon.'"></i></span>';
    $html .= '<div class="kong-header__search__popup '. implode(' ', $popup_classes) .'">';
    $html .= '<div class="kong-header__search__wrap">';
    $html .= '<form role="search" method="get" action="' . get_home_url() . '">';
    $html .= '<input class="kong-header__search__input" type="text" name="s" placeholder="' . $attrs['placeholder'] . '" value="' . $s . '" />';
    $html .= '</form>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="kong-header__search__backdrop"></div>';
    $html .= '</div>';

    return $html;
}