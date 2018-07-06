<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Icon",
    "tag" => "icon",
    "keywords" => ["icon"],
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
                        "icon" => "star",
                        "source" => "fa"
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.link",
                    "attrs" => array(
                        "label" => "Link",
                        "type" => "link"
                    ),
                    "default_value" => array(
                        "url" => "",
                        "new_tab" => false
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
                    "bind_to" => "@attrs.font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 12,
                            "max" => 120,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 30
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 60
                    ),
                    "responsive_styles" => array(
                        "@id .kong-icon__holder" => array(
                            "width" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_color",
                    "attrs" => array(
                        "label" => "Icon Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id i" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-icon__holder" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Border",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_style",
                    "attrs" => array(
                        "label" => "Border Style",
                        "type" => "border-style"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id .kong-icon__holder" => array(
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
                                "label" => "Border Width",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 1,
                                    "max" => 10,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 1,
                            "styles" => array(
                                "@id .kong-icon__holder" => array(
                                    "borderWidth" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.border_color",
                            "attrs" => array(
                                "label" => "Border Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors['border'],
                            "styles" => array(
                                "@id .kong-icon__holder" => array(
                                    "borderColor" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => 50,
                    "styles" => array(
                        "@id .kong-icon__holder" => array(
                            "borderRadius" => "{{@model}}%"
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
<div class="kong-dnd__emptyItem" style="height:50px;" ng-if="!$ctrl.edited.attrs.icon.icon">
    <span class="kong-dnd__emptyItem__label">Icon</span>
</div>

<div class="kong-icon {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
    <figure class="kong-icon__holder">
        <i ng-class="$ctrl.edited.attrs.icon.source + ' ' + $ctrl.edited.attrs.icon.source + '-' + $ctrl.edited.attrs.icon.icon"></i>
    </figure>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_icon', 'kong_icon_callback');
function kong_icon_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
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
            'icon' => 'home',
            'source' => 'lnr'
        )),
        'link' => json_encode(array(
            'url' => '',
            'new_tab' => 'false'
        ))
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['icon'] = json_decode($attrs['icon'], true);
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
    $icon_class = $attrs['icon']['source'].' '.$attrs['icon']['source'].'-'. $attrs['icon']['icon'];

    $attrs['link'] = json_decode($attrs['link'], true);
    if (!empty($attrs['link']['url'])) {
        $target = kong_to_boolean($attrs['link']['new_tab']) ? ' target="_blank"' : '';
        $before = '<a href="' . $attrs['link']['url'] . '" class="kong-icon__holder" ' . $target.$animation . '>';
        $after = '</a>';
    } else {
        $before = '<figure class="kong-icon__holder".'.$animation.'.>';
        $after = '</figure>';
    }

    ob_start(); ?>
    <div class="kong-icon <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <?php echo $before; ?>
        <i class="<?php echo $icon_class; ?>"></i>
        <?php echo $after; ?>
    </div>
    <?php
    return ob_get_clean();
}
