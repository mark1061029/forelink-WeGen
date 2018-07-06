<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "List",
    "tag" => "list",
    "keywords" => ["icon","list"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Items",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model",
                    "attrs" => array(
                        "label" => "Item",
                        "type" => "item-group",
                        "config" => array(
                            "refer" => "text"
                        )
                    ),
                    "default_value" => []
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Flex",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.justify",
                    "attrs" => array(
                        "label" => "Justify",
                        "type" => "image-buttons",
                        "config" => array(
                            "flexStart" => "/left.svg",
                            "center" => "/center.svg",
                            "flexEnd" => "/right.svg",
                            "spaceBetween" => "/space-between.svg"
                        )
                    ),
                    "default_value" => "flexStart"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.reverse",
                    "attrs" => array(
                        "label" => "Reverse",
                        "type" => "switch"
                    ),
                    "default_value" => false
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
                    "bind_to" => "@attrs.icon_size",
                    "attrs" => array(
                        "label" => "Icon Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => 8,
                    "styles" => array(
                        "@id i" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 16
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.line_height",
                    "attrs" => array(
                        "label" => "Line Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 1,
                            "max" => 3,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => 1,
                    "styles" => array(
                        "@id" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.weight",
                    "attrs" => array(
                        "label" => "Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 400,
                    "styles" => array(
                        "@id" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.spacing",
                    "attrs" => array(
                        "label" => "Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => 11,
                    "styles" => array(
                        "@id .kong-list__item" => array(
                            "padding" => "{{@model}}px 0"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_margin",
                    "attrs" => array(
                        "label" => "Icon Margin",
                        "type" => "slider",
                        "config" => array(
                            "min" => 3,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 8,
                    "styles" => array(
                        "@id i" => array(
                            "margin" => "0 {{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_top",
                    "attrs" => array(
                        "label" => "Icon Top",
                        "type" => "slider",
                        "config" => array(
                            "min" => -20,
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => 5,
                    "styles" => array(
                        "@id i" => array(
                            "top" => "{{@model}}px"
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
                    "bind_to" => "@attrs.icon_color",
                    "attrs" => array(
                        "label" => "Icon Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id i" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_color",
                    "attrs" => array(
                        "label" => "Text Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        "@id .kong-list__item" => array(
                            "color" => "{{@model}}"
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
                    "default_value" => "dotted",
                    "styles" => array(
                        "@id .kong-list__item" => array(
                            "borderStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "if" => "@attrs.border_style != 'none'",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id .kong-list__item" => array(
                            "borderColor" => "{{@model}}"
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
        "name" => "List Item",
        "tag" => "list_item",
        "native" => true,
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
                        "bind_to" => "@attrs.text",
                        "attrs" => array(
                            "fullwidth" => true,
                            "type" => "rich-editor"
                        ),
                        "default_value" => "List Item Text Here"
                    )
                ]
            ),
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
                            "type" => "icon",
                            "config" => array(
                                "requireValue" => false
                            )
                        ),
                        "default_value" => array(
                            "icon" => "circle-thin",
                            "source" => "fa"
                        )
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem" style="height:100px" ng-if="$ctrl.edited.content.length == 0">
    <span class="kong-dnd__emptyItem__label">List</span>
</div>

<ul class="kong-list {{::$ctrl.getID()}}" selector=".kong-list__item"
    ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden, 'kong-list--' + $ctrl.edited.attrs.justify, {'kong-list--reverse':$ctrl.edited.attrs.reverse}]" id="{{$ctrl.edited.attrs.id}}">
    <li class="kong-list__item" ng-repeat="item in $ctrl.edited.content track by $index">
        <i ng-class="item.attrs.icon.source + ' ' + item.attrs.icon.source + '-' + item.attrs.icon.icon"></i>
        <span kong-editable model="item" config="{target:'attrs.text', editorType:'3'}" ng-bind-html="item.attrs.text | trustashtml"></span>
    </li>
</ul>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('lfb_list', 'lfb_list_callback');
function lfb_list_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'justify' => 'flexStart',
        'reverse' => 'false',
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
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $attrs['animation']['selector'] = '.kong-list__item';
    $animation = kong_form_animation_data($attrs['animation']);

    $classes = array();

    if(kong_to_boolean($attrs['reverse'])){
        $classes[] = 'kong-list--reverse';
    }

    $classes[] = 'kong-list--'.$attrs['justify'];

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';


    ob_start(); ?>
    <ul class="kong-list <?php echo implode(' ', $classes); ?>"<?php echo $id; ?><?php echo $animation; ?>>
        <?php echo do_shortcode($content); ?>
    </ul>
    <?php
    return ob_get_clean();
}

add_shortcode('lfb_list_item', 'lfb_list_item_callback');
function lfb_list_item_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'text' => '',
        'icon' => json_encode(array(
            'source' => 'fa',
            'icon' => 'circle-thin'
        ))
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['icon'] = json_decode($attrs['icon'], true);
    $icon_class = $attrs['icon']['source'].' '.$attrs['icon']['source'].'-'.$attrs['icon']['icon'];

    ob_start(); ?>
    <li class="kong-list__item <?php echo $attrs['class_id']; ?>">
        <i class="<?php echo $icon_class; ?>"></i>
        <span><?php echo html_entity_decode($attrs['text']); ?></span>
    </li>
    <?php
    return ob_get_clean();
}