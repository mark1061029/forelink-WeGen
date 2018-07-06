<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Dropdown",
    "tag" => "h_dropdown_menu",
    "native" => true,
    "h_nav" => true,
    "keywords" => ["dropdown menu"],
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Menu",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.menu_id",
                    "attrs" => array(
                        "type" => "selection-loader",
                        "label" => "Menu",
                        "config" => array(
                            "url" => "kong-website-builder/v1/menus",
                            "rest_url" => true,
                            "name" => "menu",
                            "add_new_url" => admin_url('nav-menus.php')
                        )
                    ),
                    "default_value" => 0
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.one_page",
                    "attrs" => array(
                        "label" => "One Page",
                        "type" => "switch"
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Typography",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_weight",
                    "attrs" => array(
                        "label" => "Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 600,
                    "styles" => array(
                        "@id" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.5,
                            "max" => 1,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.05,
                    "styles" => array(
                        "@id a" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font",
                    "attrs" => array(
                        "type" => "font-source",
                        "label" => "Font"
                    ),
                    "default_value" => array(
                        "source" => "inherit",
                        "google" => array(
                            "family" => "Open Sans",
                            "variant" => "regular",
                            "subset" => "latin"
                        ),
                        "uploaded" => "",
                        "typekit" => ""
                    ),
                    "directives" => [
                        array(
                            "tag" => "embed-font-source",
                            "attrs" => array(
                                "selector" => "@id"
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Level One",
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
                    "default_value" => 12,
                    "styles" => array(
                        "@id" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => 18,
                    "styles" => array(
                        "@id .menu > li" => array(
                            "padding" => "{{@model}}px 0"
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
                            "min" => 0,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => 30,
                    "styles" => array(
                        "@id .menu > li" => array(
                            "marginRight" => "{{@model}}px"
                        )
                    )
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
                        "@id a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.active_color",
                    "attrs" => array(
                        "label" => "Active Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id li.kong-menu-current-menu-item > a, @id li:hover > a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Level Two",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 11,
                    "styles" => array(
                        "@id .menu ul" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "10px 15px 10px 15px",
                    "styles" => array(
                        "@id .menu ul" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_item_padding",
                    "attrs" => array(
                        "label" => "Item Padding",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 15,
                            "step" => 1
                        )
                    ),
                    "default_value" => 5,
                    "styles" => array(
                        "@id .menu ul li" => array(
                            "padding" => "{{@model}}px 0 "
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => "5px 5px 5px 5px",
                    "styles" => array(
                        "@id .menu ul" => array(
                            "borderRadius" => "{{@model}}"
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
                        "@id .menu ul" => array(
                            "boxShadow" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body"],
                    "styles" => array(
                        "@id .menu ul" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_border",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id .menu ul,@id .menu ul li" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .menu ul a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_color_hover",
                    "attrs" => array(
                        "label" => "Active Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .menu ul a:hover, @id .menu .kong-menu-current-menu-item > a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Arrow",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.arrow",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.arrow",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.arrow_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["heading"],
                            "styles" => array(
                                "@id .fa" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.arrow_margin",
                            "attrs" => array(
                                "label" => "Margin",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 30,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 0,
                            "styles" => array(
                                "@id .fa" => array(
                                    "marginLeft" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.arrow_top",
                            "attrs" => array(
                                "label" => "Top",
                                "type" => "slider",
                                "config" => array(
                                    "min" => -30,
                                    "max" => 30,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 0,
                            "styles" => array(
                                "@id .fa" => array(
                                    "top" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.size",
                            "attrs" => array(
                                "label" => "Size",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 8,
                                    "max" => 30,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 14,
                            "styles" => array(
                                "@id .fa" => array(
                                    "fontSize" => "{{@model}}px"
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
<div class="kong-dnd__emptyItem kong-dnd__emptyItem--h" style="width:140px;" ng-if="!$ctrl.edited.attrs.menu_id">
    <span class="kong-dnd__emptyItem__label">Dropdown Menu</span>
</div>

<div class="kong-header__dropdownMenu {{::$ctrl.getID()}}"
     ng-class="[{'kong-header__dropdownMenu--arrow' : $ctrl.edited.attrs.arrow},$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]" kong-onePageMenu model="$ctrl.edited.attrs.one_page">
    <lb-menu-vs node_id="{{::$ctrl.getID()}}" ng-model="$ctrl.edited.attrs.menu_id" depth="2" ng-one-page="$ctrl.edited.attrs.one_page"></lb-menu-vs>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lhb_h_dropdown_menu', 'lhb_h_dropdown_menu_callback');
function lhb_h_dropdown_menu_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'menu_id' => 0,
        'hidden' => '',
        'arrow' => 'false',
        'class' => '',
        'one_page' => 'false'
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if (kong_to_boolean($attrs['arrow'])) {
        $classes[] = 'kong-header__dropdownMenu--arrow';
    }

    if (kong_to_boolean($attrs['one_page'])) {
        $classes[] = 'kong-onePageMenu';
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    $classes[] = $attrs['class_id'];

    $html = '<div class="kong-header__dropdownMenu ' . implode(' ', $classes) . '">';
    $html .= kong_get_menu_content($attrs['menu_id'], 1);
    $html .= '</div>';

    return $html;
}