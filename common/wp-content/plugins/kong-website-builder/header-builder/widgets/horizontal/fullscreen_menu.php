<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Fullscreen Menu",
    "tag" => "h_fullscreen_menu",
    "native" => true,
    "h_nav" => true,
    "keywords" => ["fullscreen menu","burger"],
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
                    "bind_to" => "@model.enable",
                    "show" => "@attrs.menu_id",
                    "attrs" => array(
                        "label" => "Enable Editor",
                        "type" => "switch",
                        "desc" => "Enable the button to start editing the menu styles & typography."
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "show" => "@attrs.menu_id != '0' && @model.enable",
            "content" => [
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Typography",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.menu_font_size",
                            "attrs" => array(
                                "label" => "Font Size",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 12,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 32
                            ),
                            "responsive_styles" => array(
                                "@id-menu" => array(
                                    "fontSize" => "{{@model}}px"
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
                                "@id-menu" => array(
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
                                    "min" => -0.2,
                                    "max" => 1,
                                    "step" => 0.01
                                )
                            ),
                            "default_value" => 0.1,
                            "styles" => array(
                                "@id-menu" => array(
                                    "letterSpacing" => "{{@model}}em"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.line_height",
                            "attrs" => array(
                                "label" => "Line Height",
                                "type" => "Slider",
                                "config" => array(
                                    "min" => 1,
                                    "max" => 5,
                                    "step" => 0.1
                                )
                            ),
                            "default_value" => 2.2,
                            "styles" => array(
                                "@id-menu" => array(
                                    "lineHeight" => "{{@model}}em"
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
                                "@id-menu" => array(
                                    "textTransform" => "{{@model}}"
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
                                        "selector" => "@id-menu"
                                    )
                                )
                            ]
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
                            "bind_to" => "@attrs.menu_bg_color",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "rgba(0,0,0,0.5)",
                            "styles" => array(
                                "@id-menu" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.menu_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#ffffff",
                            "styles" => array(
                                "@id-menu a" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.menu_bg_hover",
                            "attrs" => array(
                                "label" => "Background Hover",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                "@id-menu a:hover" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.menu_color_hover",
                            "attrs" => array(
                                "label" => "Hover Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                "@id-menu a:hover" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Close Button",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.close_size",
                            "attrs" => array(
                                "label" => "Size",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 12,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 32
                            ),
                            "responsive_styles" => array(
                                "@id-menu .kong-header__fullscreenMenu__close" => array(
                                    "width" => "{{@model}}px",
                                    "height" => "{{@model}}px"
                                ),
                                "@id-menu .kong-header__fullscreenMenu__close:before" => array(
                                    "height" => "{{@model}}px"
                                ),
                                "@id-menu .kong-header__fullscreenMenu__close:after" => array(
                                    "width" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.close_thickness",
                            "attrs" => array(
                                "label" => "Thickness",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 1,
                                    "max" => 20,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 4
                            ),
                            "responsive_styles" => array(
                                "@id-menu .kong-header__fullscreenMenu__close:before" => array(
                                    "width" => "{{@model}}px"
                                ),
                                "@id-menu .kong-header__fullscreenMenu__close:after" => array(
                                    "height" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.close_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#ffffff",
                            "styles" => array(
                                "@id-menu .kong-header__fullscreenMenu__close:before,@id-menu .kong-header__fullscreenMenu__close:after" => array(
                                    "background" => "{{@model}}"
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
                        "@id" => array(
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
                        "@id" => array(
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
                        "@id" => array(
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
                        "@id span" => array(
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
                        "@id .kong-header__burgerBtn__icon" => array(
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
                        "@id .kong-header__burgerBtn__icon" => array(
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
                    "default_value" => "",
                    "styles" => array(
                        "@id" => array(
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
                        "@id span" => array(
                            "backgroundColor" => "{{@model}}"
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
<div class="kong-header__burgerBtn {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden,
                    {'kong-header__burgerBtn--active':$ctrl.edited.enable, 'kong-header__burgerBtn--rounded-corners':$ctrl.edited.attrs.btn_rounded_corners,
                            'kong-header__burgerBtn--allow-cross':$ctrl.edited.attrs.cross_icon}]">
    <div class="kong-header__burgerBtn__icon">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<fullscreen-menu menu="$ctrl.edited.attrs.menu_id" active="$ctrl.edited.enable" data-class="{{::$ctrl.getID()}}-menu"></fullscreen-menu>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lhb_h_fullscreen_menu', 'lhb_h_fullscreen_menu_callback');
function lhb_h_fullscreen_menu_callback($attrs) {
    $attrs = shortcode_atts(array(
        'cross_icon' => 'true',
        'btn_rounded_corners' => 'false',
        'menu_id' => '0',
        'hidden' => '',
        'class' => '',
        'class_id' => '',
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if (kong_to_boolean($attrs['btn_rounded_corners'])) {
        $classes[] = 'kong-header__burgerBtn--rounded-corners';
    }

    if (kong_to_boolean($attrs['cross_icon'])) {
        $classes[] = 'kong-header__burgerBtn--allow-cross';
    }

    $classes[] = $attrs['class_id'];

    $menu =kong_get_menu_content($attrs['menu_id'], '', 1);

    $html = '<div class="kong-header__burgerBtn kong-header__burgerBtn_fsMenu ' . implode(' ', $classes) . '" id="'.$attrs['class_id'].'">';
    $html .= '<div class="kong-header__burgerBtn__icon">';
    $html .= '<span></span><span></span><span></span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div style="display: none!important">';
    $html .= str_replace('"', '\'', $menu);
    $html .= '</div>';

    return $html;
}