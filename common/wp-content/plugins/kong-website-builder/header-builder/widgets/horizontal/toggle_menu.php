<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Toggle Menu",
    "tag" => "h_toggle_menu",
    "keywords" => ["toggle menu","dropdown"],
    "enable" => false,
    "h_nav" => true,
    "native" => true,
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
                ),
                array(
                    "if" => "@attrs.menu_id != '0'",
                    "tag" => "editor-field",
                    "bind_to" => "@model.enable",
                    "attrs" => array(
                        "type" => "switch",
                        "label" => "Enable Editor",
                        "desc" => "Enable the button to start editing the menu styles & typography."
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "if" => "@model.enable",
            "content" => [
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Font & Border",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.font_size",
                            "attrs" => array(
                                "type" => "slider",
                                "label" => "Font Size",
                                "config" => array(
                                    "min" => 10,
                                    "max" => 30,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 20,
                            "styles" => array(
                                "@id a, @id .kong-menu-column-title" => array(
                                    "fontSize" => "{{@model}}px"
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
                            "default_value" => 0.15,
                            "styles" => array(
                                "@id" => array(
                                    "letterSpacing" => "{{@model}}em"
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
                            "default_value" => 600,
                            "styles" => array(
                                "@id" => array(
                                    "fontWeight" => "{{@model}}"
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
                            "bind_to" => "@attrs.alignment",
                            "attrs" => array(
                                "type" => "align",
                                "label" => "Alignment"
                            ),
                            "default_value" => "center",
                            "styles" => array(
                                "@id a, @id .kong-menu-column-title" => array(
                                    "textAlign" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.font_source",
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
                                        "selector" => "@id, @id .kong-menu-column-title"
                                    )
                                )
                            ]
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Item",
                        "collapsed" => false
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
                            "default_value" => 50,
                            "styles" => array(
                                "@id a, @id .kong-menu-column-title" => array(
                                    "height" => "{{@model}}px",
                                    "lineHeight" => "{{@model}}px"
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
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                "@id a, @id .kong-menu-column-title" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.color",
                            "attrs" => array(
                                "type" => "colorpicker",
                                "label" => "Color"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                "@id a, @id .kong-menu-column-title" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.hover_bg_color",
                            "attrs" => array(
                                "type" => "colorpicker",
                                "label" => "Background Hover"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                "@id a:hover, @id .kong-menu-column-title:hover" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.hover_color",
                            "attrs" => array(
                                "type" => "colorpicker",
                                "label" => "Hover Color"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                "@id a:hover, @id .kong-menu-column-title:hover" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.active_bg_color",
                            "attrs" => array(
                                "type" => "colorpicker",
                                "label" => "Active Background"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                "@id li.kong-menu-current-menu-item > a,@id li.kong-menu-current-menu-item > .kong-menu-column-title" => array(
                                    "backgroundColor" => "{{@model}}"
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
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                "@id li.kong-menu-current-menu-item > a,@id li.kong-menu-current-menu-item > .kong-menu-column-title" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.menu_border_style",
                            "attrs" => array(
                                "type" => "border-style",
                                "label" => "Border Style"
                            ),
                            "default_value" => "none",
                            "styles" => array(
                                "@id  li, @id .kongmenu-item-has-children, @id .kong-menu-column-title" => array(
                                    "borderTopStyle" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "if" => "@attrs.menu_border_style != 'none'",
                            "content" => [
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.menu_border_width",
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
                                        "@id  li, @id .kongmenu-item-has-children, @id .kong-menu-column-title" => array(
                                            "borderTopWidth" => "{{@model}}px"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.menu_border_color",
                                    "attrs" => array(
                                        "type" => "colorpicker",
                                        "label" => "Border Color"
                                    ),
                                    "default_value" => "",
                                    "styles" => array(
                                        "@id  li, @id .kongmenu-item-has-children, @id .kong-menu-column-title" => array(
                                            "borderTopColor" => "{{@model}}"
                                        )
                                    )
                                )
                            ]
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Burger Icon",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 20,
                            "max" => 80,
                            "step" => 1
                        )
                    ),
                    "default_value" => 26,
                    "styles" => array(
                        "@id__btn" => array(
                            "width" => "{{@model}}px",
                            "height" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.cross_icon",
                    "attrs" => array(
                        "label" => "Cross Icon",
                        "type" => "switch",
                        "desc" => "Transform the Burger icon into Cross when the button is triggered."
                    ),
                    "default_value" => true
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 5,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id__btn" => array(
                            "borderWidth" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_border_color",
                    "if" => "@attrs.btn_border_width > 0",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id__btn" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_rounded_corners",
                    "attrs" => array(
                        "label" => "Rounded Corners",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_line_thickness",
                    "attrs" => array(
                        "label" => "Thickness",
                        "type" => "slider",
                        "config" => array(
                            "min" => 1,
                            "max" => 5,
                            "step" => 1
                        )
                    ),
                    "default_value" => 3,
                    "styles" => array(
                        "@id__btn span" => array(
                            "height" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_icon_width",
                    "attrs" => array(
                        "label" => "Width",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 80,
                            "step" => 1
                        )
                    ),
                    "default_value" => 22,
                    "styles" => array(
                        "@id__btn .kong-header__burgerBtn__icon" => array(
                            "width" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_icon_height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 80,
                            "step" => 1
                        )
                    ),
                    "default_value" => 16,
                    "styles" => array(
                        "@id__btn .kong-header__burgerBtn__icon" => array(
                            "height" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_bg_color",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        "@id__btn" => array(
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
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id__btn span" => array(
                            "backgroundColor" => "{{@model}}"
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
<div class="kong-dnd__emptyItem kong-dnd__emptyItem--h" style="width:140px;" ng-if="!$ctrl.edited.attrs.menu_id">
    <span class="kong-dnd__emptyItem__label">Toggle Menu</span>
</div>

<div class="kong-header__burgerBtn {{::$ctrl.getID()}}__btn"
     ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden,
                {'kong-header__burgerBtn--active':$ctrl.edited.enable, 'kong-header__burgerBtn--rounded-corners':$ctrl.edited.attrs.btn_rounded_corners,
                        'kong-header__burgerBtn--allow-cross':$ctrl.edited.attrs.cross_icon}]">
    <div class="kong-header__burgerBtn__icon">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<lb-toggle-menu-vs
    ng-model="$ctrl.edited.attrs.menu_id"
    enable="$ctrl.edited.enable"
    item-id="$ctrl.getID()"
    item-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]"
    ng-one-page="$ctrl.edited.attrs.one_page">
</lb-toggle-menu-vs>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lhb_h_toggle_menu', 'lhb_h_toggle_menu_callback');
function lhb_h_toggle_menu_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'menu_id' => "0",
        'hidden' => '',
        'class' => '',
        'btn_rounded_corners' => 'false',
        'cross_icon' => 'false',
        'one_page' => 'false'
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();
    $menu_classes = array();

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
        $menu_classes[] = $attrs['hidden'];
    }

    if (kong_to_boolean($attrs['btn_rounded_corners'])) {
        $classes[] = 'kong-header__burgerBtn--rounded-corners';
    }

    if (kong_to_boolean($attrs['cross_icon'])) {
        $classes[] = 'kong-header__burgerBtn--allow-cross';
    }

    $classes[] = $attrs['class_id'].'__btn';

    if ($attrs['class']) {
        $menu_classes[] = $attrs['class'];
    }

    if (kong_to_boolean($attrs['one_page'])) {
        $menu_classes[] = 'kong-onePageMenu';
    }

    $menu_classes[] = $attrs['class_id'];

    $menu_content =kong_get_menu_content($attrs['menu_id'], 'toggle');

    $html = '<div class="kong-header__burgerBtn ' . implode(' ', $classes) . '" id="'.$attrs['class_id'].'">';
    $html .= '<div class="kong-header__burgerBtn__icon">';
    $html .= '<span></span><span></span><span></span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="kong-header__toggleMenu ' . implode(' ', $menu_classes) . '" style="display: none!important">';
    $html .= str_replace('"', '\'', $menu_content);
    $html .= '</div>';

    return $html;
}