<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Thumbnail Tabs",
    "tag" => "thumbnail_tabs",
    "keywords" => ["thumbnail tab"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "General",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model",
                    "attrs" => array(
                        "label" => "IDs",
                        "type" => "id-searcher"
                    ),
                    "default_value" => []
                ),
                array(
                    "if" => "@content.length",
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.active",
                    "attrs" => array(
                        "label" => "Active Tab",
                        "type" => "active-tab"
                    ),
                    "default_value" => ""
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Size & Spacing",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 20,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 60
                    ),
                    "responsive_styles" => array(
                        "@id .kong-thumbTab" => array(
                            "width" => "{{@model}}px",
                            "height" => "{{@model}}px"
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
                            "max" => 10,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-thumbTab__bg" => array(
                            "borderWidth" => "{{@model}}px"
                        )
                    )
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
                        "@id .kong-thumbTab__bg" => array(
                            "borderRadius" => "{{@model}}%"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.margin_right",
                    "attrs" => array(
                        "label" => "Margin Right",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => -1,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 7
                    ),
                    "responsive_styles" => array(
                        "@id .kong-thumbTab" => array(
                            "marginRight" => "{{@model}}px"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Color",
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
                    "default_value" => "#dddddd",
                    "styles" => array(
                        "@id .kong-thumbTab__bg" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "show" => "@attrs.border_width > 0",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id .kong-thumbTab__bg" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Active Tab",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.active_border_color",
                    "show" => "@attrs.border_width > 0",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-tab--active" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.opacity",
                    "attrs" => array(
                        "label" => "Opacity",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 1,
                            "step" => 0.05
                        )
                    ),
                    "default_value" => 0.5,
                    "styles" => array(
                        "@id .kong-tab:not(.kong-tab--active)" => array(
                            "opacity" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.scale",
                    "attrs" => array(
                        "label" => "Scale",
                        "type" => "slider",
                        "config" => array(
                            "min" => 40,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 90,
                    "styles" => array(
                        "@id .kong-tab:not(.kong-tab--active)" => array(
                            "transform" => "scale({{@model/100}})"
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
                        "type" => "animation",
                        "config" => array(
                            "group" => true
                        )
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
                        "reset" => false,
                        "interval" => 50
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
    ],
    "child" => array(
        "name" => "Thumbnail Tab",
        "tag" => "thumbnail_tab",
        "native" => true,
        "content" => [
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Image",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.image",
                        "attrs" => array(
                            "label" => "Thumbnail",
                            "type" => "upload-image"
                        ),
                        "default_value" => array(
                            "url" => ""
                        ),
                        "styles" => array(
                            "@id .kong-thumbTab__bg" => array(
                                "backgroundImage" => "url({{@model.url}})"
                            )
                        )
                    )
                ]
            ),
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Content",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.name",
                        "attrs" => array(
                            "label" => "Name",
                            "type" => "text"
                        ),
                        "default_value" => "Tab Name"
                    ),
                    array(
                        "hidden" => true,
                        "bind_to" => "@attrs.point_to",
                        "default_value" => ""
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem" style="height:60px" ng-if="$ctrl.content.length === 0">
    <span class="kong-dnd__emptyItem__label">Thumbnail Tabs</span>
</div>

<div class="kong-thumbTabs kong-tabs {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]"
     id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-thumbTab kong-tab" kong-tab-select ng-repeat="item in $ctrl.content track by $index"
         ng-class="{'kong-tab--active': $ctrl.edited.attrs.active == item.attrs.point_to}"
         data-tab-name="{{item.attrs.point_to}}">
        <div class="kong-thumbTab__bg" ng-style="{'background-image':'url(' + item.attrs.image.url + ')'}"></div>
        <style type="text/css" ng-if="($ctrl.edited.attrs.active != item.attrs.point_to)">
            #{{item.attrs.point_to}} {display: none;}
        </style>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_thumbnail_tabs', 'kong_thumbnail_tabs_callback');
function kong_thumbnail_tabs_callback($attrs, $content = null) {
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
            'reset' => 'false',
            'interval' => 50
        )),
        'active' => ''
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();
    $attrs['animation'] = json_decode($attrs['animation'], true);
    $attrs['animation']['selector'] = '.kong-thumbTab__bg';
    $animation = kong_form_animation_data($attrs['animation']);

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    if ($attrs['animation']['type'] != 'none') {
        $classes[] = 'kong-animate-group';
        $animation = ' data-type="' . $attrs['animation']['type'] . '" data-delay="' . $attrs['animation']['delay'] . '" data-selector=".kong-thumbTab__bg"';
    }

    ob_start(); ?>
    <?php if($attrs['active']): ?>
        <style type="text/css">#<?php echo $attrs['active']; ?>{display:block}</style>
    <?php endif; ?>
    <div class="kong-thumbTabs kong-tabs <?php echo implode(' ', $classes); ?>"<?php echo $id; ?> data-active="<?php echo $attrs['active']; ?>"<?php echo $animation; ?>>
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_thumbnail_tab', 'kong_thumbnail_tab_callback');
function kong_thumbnail_tab_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'point_to' => '',
        'name' => 'Tab Name'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    ob_start(); ?>
    <style type="text/css">#<?php echo $attrs['point_to']?>{display:none;}</style>
    <div class="kong-thumbTab kong-tab <?php echo $attrs['class_id'] ?>" data-tab-name="<?php echo $attrs['point_to']; ?>">
        <div class="kong-thumbTab__bg"></div>
    </div>
    <?php
    return ob_get_clean();
}