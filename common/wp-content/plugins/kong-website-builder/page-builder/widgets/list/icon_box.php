<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Icon Box",
    "tag" => "icon_box",
    "keywords" => ["icon box"],
    "native" => true,
    "filter" => "other",
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
                    "bind_to" => "@attrs.icon",
                    "attrs" => array(
                        "label" => "Icon",
                        "type" => "icon"
                    ),
                    "default_value" => array(
                        "source" => "fa",
                        "icon" => "star"
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_position",
                    "attrs" => array(
                        "label" => "Icon Position",
                        "type" => "res-text-buttons",
                        "config" => array(
                            "options" => array(
                                "left" => "Left",
                                "right" => "Right",
                                "top" => "Top"
                            )
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "left"
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 12,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 18,
                    "styles" => array(
                        "@id .kong-iconBox__icon" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.holder_size",
                    "attrs" => array(
                        "label" => "Holder Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 12,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 40,
                    "styles" => array(
                        "@id .kong-iconBox__icon__holder" => array(
                            "width" => "{{@model}}px",
                            "height" => "{{@model}}px"
                        ),
                        "@id .kong-iconBox__icon" => array(
                            "minWidth" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-iconBox__icon__holder" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id .kong-iconBox__icon__holder" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Heading",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading",
                    "attrs" => array(
                        "label" => "Heading",
                        "type" => "text"
                    ),
                    "default_value" => $manager::$text["heading"]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_size",
                    "attrs" => array(
                        "label" => "Heading Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => 13,
                    "styles" => array(
                        "@id .kong-iconBox__title" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "10px 0px 15px 0px",
                    "styles" => array(
                        "@id .kong-iconBox__title" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_font_weight",
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
                        "@id .kong-iconBox__title" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_letter_spacing",
                    "attrs" => array(
                        "label" => "Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -2,
                            "max" => 3,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.05,
                    "styles" => array(
                        "@id .kong-iconBox__title" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_text_transform",
                    "attrs" => array(
                        "type" => "text-transform",
                        "label" => "Text Transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id .kong-iconBox__title" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_color",
                    "attrs" => array(
                        "label" => "Heading Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-iconBox__title" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Description",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@content",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "rich-editor"
                    ),
                    "default_value" => $manager::$text["paragraph"]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_size",
                    "attrs" => array(
                        "label" => "Content Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => 14,
                    "styles" => array(
                        "@id .kong-iconBox__desc" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_color",
                    "attrs" => array(
                        "label" => "Content Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id .kong-iconBox__desc" => array(
                            "color" => "{{@model}}"
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
<div class="kong-iconBox {{::$ctrl.getID()}}" id="{{$ctrl.edited.attrs.id}}" ng-class="[$ctrl.service.formResClass($ctrl.edited.attrs.icon_position, 'kong-iconBox'),$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <div class="kong-iconBox__icon">
        <div class="kong-iconBox__icon__holder" kong-animate="$ctrl.edited.attrs.animation">
            <i ng-class="$ctrl.edited.attrs.icon.source + ' ' + $ctrl.edited.attrs.icon.source + '-' + $ctrl.edited.attrs.icon.icon"></i>
        </div>
    </div>
    <div class="kong-iconBox__content">
        <h5 class="kong-iconBox__title" kong-editable model="$ctrl.edited" config="{target:'attrs.heading', editorType:'1'}" ng-bind-html="$ctrl.edited.attrs.heading"></h5>
        <p class="kong-iconBox__desc" kong-editable model="$ctrl.edited" config="{target:'content', editorType:'1'}" ng-bind-html="$ctrl.edited.content"></p>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_icon_box', 'kong_icon_box_callback');
function kong_icon_box_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'icon_position' => json_encode(array(
            'desktop' => 'left'
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
        'icon' => json_encode(array(
            'source' => 'lnr',
            'icon' => 'home'
        )),
        'heading' => KongPageBuilderClient::KONG_DUMB_HEADING
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    $attrs['icon_position'] = json_decode($attrs['icon_position'], true);
    $attrs['icon'] = json_decode($attrs['icon'], true);

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $animation = kong_form_animation_data($attrs['animation']);

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $icon_position = kong_form_res_class($attrs['icon_position'], 'kong-iconBox');
    if($icon_position){
        $classes[] = $icon_position;
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    $icon_class = $attrs['icon']['source'].' '.$attrs['icon']['source'].'-' . $attrs['icon']['icon'];

    ob_start(); ?>
    <div class="kong-iconBox <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <div class="kong-iconBox__icon">
            <div class="kong-iconBox__icon__holder"<?php echo $animation; ?>>
                <i class="<?php echo $icon_class; ?>"></i>
            </div>
        </div>
        <div class="kong-iconBox__content">
            <h5 class="kong-iconBox__title"><?php echo html_entity_decode($attrs['heading']); ?></h5>
            <p class="kong-iconBox__desc"><?php echo do_shortcode($content); ?></p>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
