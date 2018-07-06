<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "tag" => "h_section",
    "name" => "Section",
    "native" => true,
    "core" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "collapsed" => false,
                "label" => "Style & Spacing"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.spacing",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "res-spacing",
                        "config" => array(
                            "margin" => ["1","0","1","0"],
                            "border" => ["1","1","1","1"],
                            "padding" => ["1","1","1","1"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => array(
                            "margin" => "0px 0px 0px 0px",
                            "padding" => "0px 0px 0px 0px",
                            "border" => "0px 0px 0px 0px"
                        )
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "margin" => "{{@model.margin}}",
                            "padding" => "{{@model.padding}}",
                            "borderWidth" => "{{@model.border}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_style",
                    "attrs" => array(
                        "label" => "Border Style",
                        "type" => "border-style"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id" => array(
                            "borderStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "if" => "@attrs.border_style != 'none'",
                    "bind_to" => "@attrs.border_color",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Max width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 2000,
                                "step" => 1
                            ),
                            "units" => ["px","%","vw"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-header__container" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.fullwidth",
                    "attrs" => array(
                        "label" => "Fullwidth",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "attrs" => array(
                        "label" => "Background Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Container Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.container_style",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.container_style",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.c_padding",
                            "attrs" => array(
                                "label" => "Padding",
                                "type" => "res-area",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 200,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => "10px 10px 10px 10px"
                            ),
                            "responsive_styles" => array(
                                "@id .kong-header__container--styled" => array(
                                    "padding" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.c_bg",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#ffffff",
                            "styles" => array(
                                "@id .kong-header__container--styled" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.c_border_width",
                            "attrs" => array(
                                "label" => "Border",
                                "type" => "area",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 200,
                                    "step" => 1
                                )
                            ),
                            "default_value" => "1px 1px 1px 1px",
                            "styles" => array(
                                "@id .kong-header__container--styled" => array(
                                    "borderWidth" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.c_border_color",
                            "attrs" => array(
                                "label" => "Border Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["border"],
                            "styles" => array(
                                "@id .kong-header__container--styled" => array(
                                    "borderColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.c_box_shadow",
                            "attrs" => array(
                                "label" => "Box Shadow",
                                "type" => "box-shadow"
                            ),
                            "default_value" => "none",
                            "styles" => array(
                                "@id .kong-header__container--styled" => array(
                                    "boxShadow" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.c_border_radius",
                            "attrs" => array(
                                "label" => "Border Radius",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 20,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 0,
                            "styles" => array(
                                "@id .kong-header__container--styled" => array(
                                    "borderRadius" => "{{@model}}px"
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
                "collapsed" => false,
                "label" => "Hidden & Class"
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
<div class="kong-header__section {{::$ctrl.getID()}}"
     ng-class="[$ctrl.section.attrs.class, $ctrl.section.attrs.hidden]">
    <div class="kong-container" ng-class="{'kong-container--fullwidth' : $ctrl.section.attrs.fullwidth}">
        <div class="kong-row">
            <div class="kong-header__container" ng-class="{'kong-header__container--styled' : $ctrl.section.attrs.container_style}">
                <horizontal-column-list section="$ctrl.section" on-update="$ctrl.update(col,p,v)"></horizontal-column-list>
            </div>
        </div>
    </div>
    <button ng-show="$ctrl.section.attrs.close_btn" class="kong-header__section__closeBtn"><i ng-class="$ctrl.section.attrs.close_icon"></i></button>
    <div class="kong-dnd__visual kong-dnd__visual--lv2 lvh__{{::$ctrl.getID()}}"
         ng-click="$ctrl.service.setEdited($ctrl.section)"
         ng-class="{'show':$ctrl.section.hover}"
         kong-detect-hover-node-horizontal="$ctrl.section">
        <span class="kong-dnd__visual__name">Section</span>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lhb_h_section', 'lhb_h_section_callback');
function lhb_h_section_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        "class_id" => '',
        "class" => '',
        "fullwidth" => 'false',
        "container_style" => 'false',
        "hidden" => ""
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = [];
    $classes[] = $attrs['class_id'];
    $classes[] = $attrs['class'];

    if($attrs['hidden']){
        $classes[] = $attrs['hidden'];
    }

    $html = '<div class="kong-header__section ' . implode(' ', $classes) . '">';
    $html .= '<div class="kong-container'.(kong_to_boolean($attrs['fullwidth']) ? ' kong-container--fullwidth' : '').'">';
    $html .= '<div class="kong-row">';
    $html .= '<div class="kong-header__container'.(kong_to_boolean($attrs['container_style']) ? ' kong-header__container--styled': '').'">';
    $html .=  do_shortcode($content);
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}