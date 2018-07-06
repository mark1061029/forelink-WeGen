<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Box",
    "tag" => "box",
    "keywords" => ["nested","box"],
    "native" => true,
    "filter" => "other",
    "nested" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Setting",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 300,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "20px 20px 20px 20px"
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Width",
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
                        "@id" => array(
                            "width" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area",
                        "config" => array(
                            "min" => -500,
                            "max" => 500,
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
                "label" => "Style",
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
                    "when" => "@model.url",
                    "bind_to" => "@attrs.bg_image",
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
                    "bind_to" => "@attrs.overlay_bg",
                    "attrs" => array(
                        "label" => "Overlay Color",
                        "type" => "gradient",
                        "config" => array(
                            "radial" => true
                        )
                    ),
                    "default_value" => array(
                        "color_1" => "",
                        "color_2" => "",
                        "angle" => 90,
                        "radial" => false,
                        "radial_x" => "center",
                        "radial_y" => "bottom",
                        "value" => ""
                    ),
                    "styles" => array(
                        "@id .kong-box__overlay" => array(
                            "background" => "{{@model.value}}"
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
                    "default_value" => "0px 0px 0px 0px",
                    "styles" => array(
                        "@id" => array(
                            "borderWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "if" => "@attrs.border_width != '0px 0px 0px 0px'",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "0px 0px 0px 0px",
                    "styles" => array(
                        "@id" => array(
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
                        "@id" => array(
                            "boxShadow" => "{{@model}}"
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
                "label" => "Hidden on",
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
<div class="kong-box__wrap">
    <div class="kong-box {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
        <div class="kong-box__overlay"></div>
        <div class="kong-dnd__dropMe kong-dnd__dropMe--lv3">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <kong-nested-item-list model="$ctrl.edited"></kong-nested-item-list>
        <div class="kong-dnd__visualBlock"></div>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_box', 'kong_box_callback');
function kong_box_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
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
        'hidden' => ''
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $animation = kong_form_animation_data($attrs['animation']);

    $attrs['parallax'] = json_decode($attrs['parallax'], true);
    $parallax = kong_form_parallax_data($attrs['parallax']);

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-box__wrap">
        <div class="kong-box <?php echo implode(' ', $classes); ?>"<?php echo $id.$animation.$parallax; ?>>
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
