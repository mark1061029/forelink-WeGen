<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Play Button",
    "tag" => "play_button",
    "keywords" => ["youtube","video","vimeo","iframe","play button"],
    "native" => true,
    "filter" => "media",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Content",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.iframe",
                    "attrs" => array(
                        "label" => "Link",
                        "type" => "iframe",
                        "desc" => "Copy embeded Iframe link from Youtube, Vimeo, etc and paste it into this field."
                    ),
                    "default_value" => ""
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Icon & Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.size",
                    "attrs" => array(
                        "label" => "Button Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 20,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 80
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "width" => "{{@model}}px",
                            "height" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_size",
                    "attrs" => array(
                        "label" => "Icon Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 24
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 12,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id" => array(
                            "borderWidth" => "{{@model}}px"
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
                    "bind_to" => "@attrs.bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id" => array(
                            "backgroundColor" => "{{@model}}"
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
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "if" => "@attrs.border_width",
                    "attrs" => array(
                        "label" => "Border",
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_shadow",
                    "attrs" => array(
                        "label" => "Box Shadow",
                        "type" => "box-shadow"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id" => array(
                            "textShadow" => "{{@model}}"
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
                        "type" => "class",
                        "config" => ["Hover.css","Hover Effect"]
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
<div class="kong-dnd__emptyItem" style="height:100px;" ng-if="!$ctrl.edited.attrs.iframe">
    <span class="kong-dnd__emptyItem__label">Play Button</span>
</div>

<button class="kong-playButton kong-videoPopup__launch {{::$ctrl.getID()}}" frontend-compile callback="bindVideoPopup" ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]" id="{{$ctrl.edited.attrs.id}}" data-iframe="{{$ctrl.edited.attrs.iframe}}">
    <i class="kong-playButton__icon fa fa-play"></i>
</button>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_play_button', 'kong_play_button_callback');
function kong_play_button_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
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
        'id' => '',
        'hidden' => '',
        'iframe' => ''
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $animation = kong_form_animation_data($attrs['animation']);

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <button class="kong-playButton kong-videoPopup__launch <?php echo implode(' ', $classes) ?>"<?php echo $id.$animation; ?> data-iframe="<?php echo $attrs['iframe']; ?>">
        <i class="kong-playButton__icon fa fa-play"></i>
    </button>
    <?php
    return ob_get_clean();
}