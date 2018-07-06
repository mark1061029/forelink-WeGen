<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "tag" => "h_column",
    "name" => "Column",
    "native" => true,
    "core" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "collapsed" => false,
                "label" => "Spacing & Alignment"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.width",
                    "attrs" => array(
                        "type" => "column-width",
                        "fullwidth" => true
                    ),
                    "default_value" => array(
                        "desktop" => "1-3"
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.min_height",
                    "attrs" => array(
                        "label" => "Min Height",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 1,
                            "max" => 500,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 1
                    ),
                    "responsive_styles" => array(
                        "@id, @id .kong-header__col__container" => array(
                            "minHeight" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hoz_align",
                    "attrs" => array(
                        "label" => "Horizontal Align",
                        "type" => "h-align"
                    ),
                    "default_value" => "middle"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.ver_align",
                    "attrs" => array(
                        "label" => "Vertical Alignment",
                        "type" => "image-buttons",
                        "config" => array(
                            "left" => "left.svg",
                            "center" => "center.svg",
                            "right" => "right.svg",
                            "spaceBetween" => "space-between.svg",
                            "spaceAround" => "space-around.svg"
                        )
                    ),
                    "default_value" => "left"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.no_gutter",
                    "attrs" => array(
                        "label" => "No Gutter",
                        "type" => "res-class",
                        "config" => array(
                            "prefix" => "kong-column",
                            "suffix" => "noGutter",
                            "devices" => ["desktop","tablet","mobile"]
                        ),
                        "desc" => "Select the device screen to set no blank space for the column edges."
                    ),
                    "default_value" => ""
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
                            "bind_to" => "@attrs.padding",
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
                                "desktop" => "20px 20px 20px 20px"
                            ),
                            "responsive_styles" => array(
                                "@id .kong-header__col__container--styled" => array(
                                    "padding" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.c_bg_color",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#ffffff",
                            "styles" => array(
                                "@id .kong-header__col__container--styled" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.c_border_width",
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
                                "@id .kong-header__col__container--styled" => array(
                                    "borderWidth" => "{{@model}}"
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
                            "default_value" => 3,
                            "styles" => array(
                                "@id .kong-header__col__container--styled" => array(
                                    "borderRadius" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "if" => "@attrs.c_border_width != '0px 0px 0px 0px'",
                            "bind_to" => "@attrs.c_border_color",
                            "attrs" => array(
                                "label" => "Border",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors['border'],
                            "styles" => array(
                                "@id .kong-header__col__container--styled" => array(
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
                                "@id .kong-header__col__container--styled" => array(
                                    "boxShadow" => "{{@model}}"
                                )
                            )
                        )
                    ]
                )
            ]
        )
    ]
);

ob_start();
?>
    <div class="kong-dnd__column">
        <div class="kong-dnd__column__container" ng-class="[$ctrl.edited.attrs.no_gutter, 'kong-header__col--vAlign-' + $ctrl.edited.attrs.ver_align, 'kong-header__col--hAlign-' + $ctrl.edited.attrs.hoz_align,$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]">
            <horizontal-item-list column="$ctrl.column"></horizontal-item-list>

            <div class="kong-dnd__dropMe kong-dnd__dropMe--lv3">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="kong-dnd__visual kong-dnd__visual--lv3 lvh__{{::$ctrl.getID()}}" kong-detect-hover-node-horizontal="$ctrl.column">
                <div class="kong-dnd__visual__label" kong-keep-visual-label>
                    <div class="kong-dnd__visual__label__name" node-tree model='$ctrl.column'>
                                <span ng-click="$ctrl.service.setEdited($ctrl.column, true)">
                                    Column
                                    <span class="kong-dnd__colWidth--desktop" ng-bind="::($ctrl.column.attrs.width.desktop | slash)"></span>
                                    <span class="kong-dnd__colWidth--tablet" ng-bind="::($ctrl.column.attrs.width.tablet | slash)"></span>
                                    <span class="kong-dnd__colWidth--mobile" ng-bind="::($ctrl.column.attrs.width.mobile | slash)"></span>
                                </span>
                    </div>
                    <div class="kong-dnd__visual__label__changeColWidth">
                        <strong ng-click="$ctrl.plusWidth()" class="lmr lmr-plus"></strong>
                        <strong ng-click="$ctrl.minusWidth()" class="lmr lmr-minus"></strong>
                    </div>
                </div>

                <div class="kong-dnd__visual__editor" ng-click="$ctrl.service.setEdited($ctrl.column)"></div>
            </div>
        </div>
    </div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_h_column', 'lhb_h_column_callback');
function lhb_h_column_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        "class_id" => '',
        'no_gutter' => '',
        'container_style' => 'false',
        'hoz_align' => 'middle',
        'ver_align' => 'left',
        'min_height' => 0,
        'width' => json_encode(array(
            'desktop' => '1-1'
        )),
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = [];

    if($attrs['width']){
        $width_obj = json_decode($attrs['width'], true);
        $classes[] = 'kong-col-'.$width_obj['desktop'];

        if(isset($width_obj['tablet']) && $width_obj['desktop'] != $width_obj['tablet']){
            $classes[] = 'kong-col-tb-'.$width_obj['tablet'];
        }

        if(isset($width_obj['mobile']) &&
            ((isset($width_obj['tablet']) && $width_obj['tablet'] != $width_obj['mobile']) || (!isset($width_obj['tablet']) && $width_obj['desktop'] != $width_obj['mobile']))){
            $classes[] = 'kong-col-mb-'.$width_obj['mobile'];
        }
    }

    if($attrs['ver_align']){
        $classes[] = 'kong-header__col--vAlign-'.$attrs['ver_align'];
    }

    if($attrs['no_gutter']){
        $classes[] = $attrs['no_gutter'];
    }

    if($attrs['hoz_align']){
        $classes[] = 'kong-header__col--hAlign-'.$attrs['hoz_align'];
    }

    $classes[] = $attrs['class_id'];

    $html = '<div class="kong-column '.implode(' ', $classes).'">';
    $html .= '<div class="kong-header__col__container'.(kong_to_boolean($attrs['container_style']) ? ' kong-header__col__container--styled' : '').'">';
    $html .=  do_shortcode($content);
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}