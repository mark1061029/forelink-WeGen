<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Sidebar Menu",
    "tag" => "h_sidebar_menu",
    "keywords" => ["burger button","sidebar menu"],
    "enable" => false,
    "native" => true,
    "h_nav" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Control Sidebar",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.sidebar_id",
                    "attrs" => array(
                        "label" => "Sidebar ID",
                        "type" => "sidebar-searcher"
                    ),
                    "default_value" => ""
                ),
                array(
                    "if" => "@attrs.sidebar_id",
                    "tag" => "editor-field",
                    "bind_to" => "@model.enable",
                    "attrs" => array(
                        "label" => "Activate Menu",
                        "type" => "switch",
                        "desc" => "Activate the sidebar by enabling the button"
                    ),
                    "default_value" => ""
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
<div class="kong-header__burgerBtn {{::$ctrl.getID()}}"
     control-sidebar="$ctrl.edited.enable"
     data-sidebar-id="{{$ctrl.edited.attrs.sidebar_id}}"
     ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden,
                {'kong-header__burgerBtn--active':$ctrl.edited.enable, 'kong-header__burgerBtn--rounded-corners':$ctrl.edited.attrs.btn_rounded_corners,
                        'kong-header__burgerBtn--allow-cross':$ctrl.edited.attrs.cross_icon}]">
    <div class="kong-header__burgerBtn__icon">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lhb_h_sidebar_menu', 'lhb_h_sidebar_menu_callback');
function lhb_h_sidebar_menu_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'btn_rounded_corners' => 'false',
        'sidebar_id' => '',
        'cross_icon' => 'false',
        'class' => '',
        'hidden' => ''
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

    $datas = $attrs['sidebar_id'] ? 'data-sidebar-id="' . $attrs['sidebar_id'] . '"' : '';

    $html = '<div class="kong-header__burgerBtn kong-header__burgerBtn--sidebarController ' . implode(' ', $classes) . '" '.$datas.'>';
    $html .= '<div class="kong-header__burgerBtn__icon">';
    $html .= '<span></span><span></span><span></span>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}