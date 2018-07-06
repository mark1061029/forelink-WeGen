<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Toggle Menu",
    "tag" => "v_toggle_menu",
    "keywords" => ["toggle menu"],
    "native" => true,
    "v_nav" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Global",
                "collapse" => true
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.lv1_text_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id .menu" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
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
                    "default_value" => 700,
                    "styles" => array(
                        "@id,@id .kong-menu-column-title" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.letter_spacing",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Letter Spacing",
                        "config" => array(
                            "min" => -0.2,
                            "max" => 1,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.05,
                    "styles" => array(
                        "@id" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.align",
                    "attrs" => array(
                        "label" => "Alignment",
                        "type" => "align"
                    ),
                    "default_value" => "left",
                    "styles" => array(
                        "@id" => array(
                            "textAlign" => "{{@model}}"
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.item_padding",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Item Padding",
                        "config" => array(
                            "min" => 0,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id a, @id .kong-menu-column-title span" => array(
                            "margin" => "0 {{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_style",
                    "attrs" => array(
                        "type" => "border-style",
                        "label" => "Item Border Style",
                        "config" => array(
                            "min" => 0,
                            "max" => 10,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => "dashed",
                    "styles" => array(
                        "@id li, @id .kongmenu-item-has-children, @id .kong-menu-column-title" => array(
                            "borderStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "if" => "@attrs.border_style != 'none'",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.border_width",
                            "attrs" => array(
                                "type" => "slider",
                                "label" => "Width",
                                "config" => array(
                                    "min" => 1,
                                    "max" => 5,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 1,
                            "styles" => array(
                                "@id li, @id .kongmenu-item-has-children, @id .kong-menu-column-title" => array(
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
                                "@id li, @id .kongmenu-item-has-children, @id .kong-menu-column-title" => array(
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
                "label" => "Menu LV1",
                "collapse" => true
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Height",
                        "config" => array(
                            "min" => 20,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => 36,
                    "styles" => array(
                        "@id .menu > li > a" => array(
                            "height" => "{{@model}}px",
                            "lineHeight" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.lv1_font_size",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Font Size",
                        "config" => array(
                            "min" => 10,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 18,
                    "styles" => array(
                        "@id .menu > li > a" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.lv1_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Color"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .menu > li > a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.lv1_active_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Active Color"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .menu > li.kong-menu-current-menu-item > a,@id .menu > li:hover > a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Sub Menu",
                "collapse" => true
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_height",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Height",
                        "config" => array(
                            "min" => 20,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => 40,
                    "styles" => array(
                        "@id .menu .kong-menu-submenu a, @id .menu .kong-menu-column-title" => array(
                            "height" => "{{@model}}px",
                            "lineHeight" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_font_size",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Font Size",
                        "config" => array(
                            "min" => 10,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 14,
                    "styles" => array(
                        "@id .menu .kong-menu-submenu a, @id .menu .kong-menu-column-title" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Color"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id .menu .kong-menu-submenu a, @id .menu .kong-menu-column-title" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sub_active_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Active Color"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .menu .kong-menu-column-title:hover, @id .menu .kong-menu-submenu a:hover, @id .menu .kong-menu-submenu li.kong-menu-current-menu-item a" => array(
                            "color" => "{{@model}}"
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
<div class="kong-dnd__emptyItem kong-dnd__emptyItem--v" style="height:80px;" ng-if="!$ctrl.edited.attrs.menu_id">
    <span class="kong-dnd__emptyItem__label">Toggle Menu</span>
</div>

<div class="kong-aside__toggleMenu {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.hidden,
                       $ctrl.edited.attrs.class]">
    <lb-menu-vs node_id="{{::$ctrl.getID()}}" ng-model="$ctrl.edited.attrs.menu_id" menu-type="toggle" ng-one-page="$ctrl.edited.attrs.one_page" ng-event-callback="toggleMenu"></lb-menu-vs>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_v_toggle_menu', 'lhb_v_toggle_menu_callback');
function lhb_v_toggle_menu_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'menu_id' => "0",
        'hidden' => '',
        'class' => '',
        'one_page' => 'false'
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if (kong_to_boolean($attrs['one_page'])) {
        $classes[] = 'kong-onePageMenu';
    }

    $classes[] = $attrs['class_id'];

    $html = '<div class="kong-aside__toggleMenu ' . implode(' ', $classes) . '">';
    $html .=kong_get_menu_content($attrs['menu_id'], 'toggle');
    $html .= '</div>';

    return $html;
}