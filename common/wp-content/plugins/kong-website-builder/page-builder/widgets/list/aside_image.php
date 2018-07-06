<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Aside Image",
    "tag" => "aside_image",
    "keywords" => ["aside image","picture","flex","nested"],
    "native" => true,
    "filter" => "image",
    "nested" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Media",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.image",
                    "attrs" => array(
                        "label" => "Image",
                        "type" => "upload-image"
                    ),
                    "default_value" => array(
                        "url" => ""
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.image_width",
                    "attrs" => array(
                        "label" => "Image Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => ["px","%"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "60px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-asideImage__media" => array(
                            "flex" => "0 0 {{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.image_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-asideImage__image" => array(
                            "borderRadius" => "{{@model}}%"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Layout & Spacing",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.reversed",
                    "attrs" => array(
                        "label" => "Reversed",
                        "type" => "Switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.h_align",
                    "attrs" => array(
                        "label" => "Horizontal",
                        "type" => "h-align"
                    ),
                    "default_value" => "top"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "5px 0px 10px 20px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-asideImage__content" => array(
                            "padding" => "{{@model}}"
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
                        "type" => "text"
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
<div class="kong-dnd__emptyItem" style="height:150px;" ng-if="!$ctrl.edited.attrs.image.url">
    <span class="kong-dnd__emptyItem__label">Aside Image</span>
</div>

<div class="kong-asideImage {{::$ctrl.getID()}}" ng-class="[{'kong-asideImage--reversed':$ctrl.edited.attrs.reversed},'kong-asideImage--hAlign-'+$ctrl.edited.attrs.h_align, 'kong-asideImage--vAlign-' + $ctrl.edited.attrs.v_align, $ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-asideImage__media">
        <img class="kong-asideImage__image" ng-src="{{$ctrl.edited.attrs.image.url}}"/>
    </div>
    <div class="kong-asideImage__content">
        <div class="kong-dnd__dropMe kong-dnd__dropMe--lv3">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="kong-dnd__visualBlock"></div>
        <kong-nested-item-list model="$ctrl.edited"></kong-nested-item-list>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_aside_image', 'kong_aside_image_callback');
function kong_aside_image_callback($attrs, $content = null) {
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
        'reversed' => 'false',
        'h_align' => 'top',
        'image' => json_encode(array(
            'url' => ''
        ))
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if (kong_to_boolean($attrs['reversed'])) {
        $classes[] = 'kong-asideImage--reversed';
    }

    if ($attrs['h_align']) {
        $classes[] = 'kong-asideImage--hAlign-'.$attrs['h_align'];
    }

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $animation = kong_form_animation_data($attrs['animation']);

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-asideImage <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <div class="kong-asideImage__media"<?php echo $animation ?>>
            <?php $attrs['image'] = json_decode($attrs['image'], true); ?>
            <img class="kong-asideImage__image" src="<?php echo $attrs['image']['url']; ?>"/>
        </div>
        <div class="kong-asideImage__content">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
