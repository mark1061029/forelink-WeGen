<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Column",
    "tag" => "column",
    "native" => true,
    "core" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Layout",
                "collapsed" => false
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
                        "desktop" => "1-3",
                        "mobile" => "1-1"
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => -1000,
                            "max" => 1000,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 0px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Container Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1200,
                                "step" => 1
                            ),
                            "units" => ["px","%","vw"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-column__container" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.v_align",
                    "attrs" => array(
                        "label" => "Vertical Alignment",
                        "type" => "res-v-align",
                        "desc" => "In the case the max width of the container is lesser than the width of this column. This setting can be used to vertically align the container."
                    ),
                    "default_value" => array(
                        "desktop" => ""
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.min_height",
                    "attrs" => array(
                        "label" => "Min Height",
                        "type" => "res-text"
                    ),
                    "default_value" => array(
                        "desktop" => "0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-column__container" => array(
                            "minHeight" => "{{@model}}"
                        )
                    )
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_align",
                    "attrs" => array(
                        "label" => "Content Alignment",
                        "type" => "h-align"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_align",
                    "attrs" => array(
                        "label" => "Text Align",
                        "type" => "res-text-align"
                    ),
                    "default_value" => array(
                        "desktop" => ""
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "textAlign" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Background",
                "collapsed" => false
            ),
            "content" => [
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_image",
                    "when" => "@model.url",
                    "attrs" => array(
                        "label" => "Background Image",
                        "type" => "upload-image-v2"
                    ),
                    "default_value" => array(
                        "url" => "",
                        "position" => "50% 50%"
                    ),
                    "styles" => array(
                        "@id" => array(
                            "backgroundImage" => "url({{@model.url}})",
                            "backgroundPosition" => "{{@model.position}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.overlay",
                    "attrs" => array(
                        "label" => "Overlay",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "if" => "@attrs.overlay",
                    "bind_to" => "@attrs.overlay_bg",
                    "attrs" => array(
                        "label" => "Overlay Color",
                        "type" => "gradient",
                        "config" => array(
                            "radial" => true
                        )
                    ),
                    "default_value" => array(
                        "color_1" => "rgba(0,0,0,0.4)",
                        "color_2" => "rgba(0,0,0,0.4)",
                        "angle" => 90,
                        "radial" => false,
                        "radial_x" => "center",
                        "radial_y" => "bottom",
                        "value" => "linear-gradient(90deg, rgba(0,0,0,0.4), rgba(0,0,0,0.4))"
                    ),
                    "styles" => array(
                        "@id.kong-column--overlay:before,@id .kong-column--overlay:before" => array(
                            "background" => "{{@model.value}}"
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
                                "@id .kong-column__container--styled" => array(
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
                                "@id .kong-column__container--styled" => array(
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
                                "@id .kong-column__container--styled" => array(
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
                                "@id .kong-column__container--styled" => array(
                                    "borderRadius" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.c_border_color",
                            "attrs" => array(
                                "label" => "Border",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors['border'],
                            "styles" => array(
                                "@id .kong-column__container--styled" => array(
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
                                "@id .kong-column__container--styled" => array(
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
                "label" => "Separator",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.separator",
                    "attrs" => array(
                        "label" => "Devices",
                        "type" => "res-class",
                        "config" => array(
                            "prefix" => "kong-column",
                            "suffix" => "separator",
                            "devices" => ["desktop","tablet","mobile"]
                        ),
                        "desc" => "Select the device screen to display a right separator on this column."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.separator_color",
                    "if" => "@attrs.separator",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id[class*='-separator']:after,@id [class*='-separator']:after" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Animation",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.animation",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "animation"
                    ),
                    "default_value" => array(
                        "enable" => false,
                        "distance" => "0px",
                        "rotate" => array(
                            "x" => 0,
                            "y" => 0,
                            "z" => 0
                        ),
                        "origin" => "bottom",
                        "easing" => "ease",
                        "delay" => 0,
                        "duration" => 1000,
                        "opacity" => 0,
                        "scale" => 1,
                        "viewFactor" => 0.2,
                        "reset" => false
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Parallax",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.parallax",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "parallax"
                    ),
                    "default_value" => array(
                        "enable" => false,
                        "x" => 0,
                        "y" => 0,
                        "z" => 0,
                        "scale" => 1,
                        "rotateX" => 0,
                        "rotateY" => 0,
                        "rotateZ" => 0
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "ID & Class",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.class",
                    "attrs" => array(
                        "label" => "Class",
                        "type" => "class"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.id",
                    "attrs" => array(
                        "label" => "ID",
                        "type" => "id"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
);

ob_start();
?>
<div class="kong-dnd__column">
    <div class="kong-dnd__column__container"
         ng-class="[{'kong-column--overlay':$ctrl.edited.attrs.overlay},'kong-column--align-'+$ctrl.edited.attrs.content_align, $ctrl.service.formResClass($ctrl.edited.attrs.v_align, 'kong-column--vAlign'), $ctrl.edited.attrs.no_gutter, $ctrl.edited.attrs.separator,$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">

        <div class="kong-column__container" ng-class="[{'kong-column__container--styled': $ctrl.edited.attrs.container_style}]">
            <kong-item-list column="$ctrl.column"></kong-item-list>

            <div class="kong-dnd__dropMe kong-dnd__dropMe--lv3">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="kong-dnd__visual kong-dnd__visual--lv3 lvh__{{::$ctrl.getID()}}"
                 ng-mousedown="$ctrl.service.hide = 'kong-dnd__area--showList--lv3'" kong-detect-hover-node="$ctrl.column">
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

                <kong-action current="$ctrl.column"></kong-action>
            </div>
        </div>
    </div>
</div>

<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lfb_column', 'lfb_column_callback');
function lfb_column_callback($attrs, $content = '') {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'overlay' => 'false',
        'container_style' => 'false',
        'v_align' => json_encode(array(
            'desktop' => ''
        )),
        'animation' => json_encode(array(
            'enable' => 'false',
            'delay' => 0,
            'duration' => 1000,
            'opacity' => 0,
            'rotate' => array('x' => 0, 'y' => 0, 'z' => 0),
            'origin' => 'bottom',
            'distance' => '20px',
            'scale' => 1,
            'easing' => 'ease',
            'reset' => 'false'
        )),
        'parallax' => json_encode(array(
            'enable' => 'false',
            'x' => 0,
            'y' => 0,
            'z' => 0,
            'scale' => 1,
            'rotateX' => 0,
            'rotateY' => 0,
            'rotateZ' => 0
        )),
        'id' => '',
        'width' => json_encode(array(
            'desktop' => '1-1'
        )),
        'hidden' => '',
        'no_gutter' => '',
        'content_align' => '',
        'separator' => ''
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    $attrs['parallax'] = json_decode($attrs['parallax'], true);
    $parallax = kong_form_parallax_data($attrs['parallax']);

    $attrs['v_align'] = json_decode($attrs['v_align'], true);

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $animation = kong_form_animation_data($attrs['animation']);


    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']){
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['no_gutter']){
        $classes[] = $attrs['no_gutter'];
    }

    if ($attrs['separator']){
        $classes[] = $attrs['separator'];
    }

    if (kong_to_boolean($attrs['overlay'])){
        $classes[] = 'kong-column--overlay';
    }

    $container_classes = [];

    if($attrs['content_align']){
        $classes[] = 'kong-column--align-'.$attrs['content_align'];
    }

    $v_align = kong_form_res_class($attrs['v_align'], 'kong-column--vAlign');
    if($v_align){
        $classes[] = $v_align;
    }

    if(kong_to_boolean($attrs['container_style'])){
        $container_classes[] = 'kong-column__container--styled';
    }

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

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="'.$attrs['id'].'"' : '';

    ob_start(); ?>
    <div class="kong-column <?php echo implode(' ', $classes); ?>"<?php echo $id; ?><?php echo $animation.$parallax; ?>>
        <div class="kong-column__container <?php echo implode(' ', $container_classes); ?>">
            <div class="kong-column__wrap">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}