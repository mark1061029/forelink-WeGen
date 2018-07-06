<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Working Hours",
    "tag" => "working_hours",
    "keywords" => ["working hours"],
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
                            "refer" => "day"
                        )
                    ),
                    "default_value" => []
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
                        "type" => "icon-box",
                        "config" => array(
                            "icons" => ["fa fa-clock-o","lnr lnr-clock"],
                            "requireValue" => false
                        )
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-workingHours__icon" => array(
                            "color" => "{{@model}}"
                        )
                    )
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
                    "bind_to" => "@attrs.hour_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
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
                    "bind_to" => "@attrs.padding",
                    "attrs" => array(
                        "label" => "Distance",
                        "type" => "slider",
                        "config" => array(
                            "min" => 2,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => 7,
                    "styles" => array(
                        "@id .kong-workingHours__item" => array(
                            "padding" => "{{@model}}px 0"
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
                        "@id .kong-workingHours__item" => array(
                            "borderTopStyle" => "{{@model}}"
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
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id .kong-workingHours__item" => array(
                            "borderTopColor" => "{{@model}}"
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
                    "bind_to" => "@attrs.day_color",
                    "attrs" => array(
                        "label" => "Day Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-workingHours__day" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.day_weight",
                    "attrs" => array(
                        "label" => "Day Font Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 400,
                    "styles" => array(
                        "@id .kong-workingHours__day" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.time_color",
                    "attrs" => array(
                        "label" => "Time Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-workingHours__time" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.time_weight",
                    "attrs" => array(
                        "label" => "Day Time Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 400,
                    "styles" => array(
                        "@id .kong-workingHours__time" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.line_style",
                    "attrs" => array(
                        "label" => "Line Style",
                        "type" => "border-style"
                    ),
                    "default_value" => "dotted",
                    "styles" => array(
                        "@id .kong-workingHours__line" => array(
                            "borderTopStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.line_color",
                    "if" => "@attrs.line_style != 'none'",
                    "attrs" => array(
                        "label" => "Line Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id .kong-workingHours__line" => array(
                            "borderTopColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.align",
                    "attrs" => array(
                        "label" => "Alignment",
                        "type" => "text-buttons",
                        "config" => array(
                            "options" => array(
                                "bottom" => "Bottom",
                                "center" => "Center"
                            )
                        )
                    ),
                    "default_value" => "bottom"
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
                "label" => "Class",
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
                )
            ]
        )
    ],
    "child" => array(
        "name" => "Working Hour",
        "tag" => "working_hours_item",
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
                        "bind_to" => "@attrs.day",
                        "attrs" => array(
                            "label" => "Name",
                            "type" => "text"
                        ),
                        "default_value" => "Mon - Fri"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.time",
                        "attrs" => array(
                            "label" => "Time",
                            "type" => "text"
                        ),
                        "default_value" => "09:00am - 05:00pm"
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem" style="height:100px" ng-if="$ctrl.edited.content.length == 0">
    <span class="kong-dnd__emptyItem__label">Working Hours</span>
</div>

<ul class="kong-workingHours {{::$ctrl.getID()}}" ng-class="['kong-workingHours--align-'+$ctrl.edited.attrs.align, $ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <li class="kong-workingHours__item" ng-repeat="item in $ctrl.edited.content track by $index">
        <span class="kong-workingHours__day"><i ng-show="$ctrl.edited.attrs.icon" class="kong-workingHours__icon" ng-class="$ctrl.edited.attrs.icon"></i> <span  model="item" kong-editable config="{target:'attrs.day', editorType:'1'}" ng-bind-html="item.attrs.day"></span></span>
        <span class="kong-workingHours__line"></span>
        <span class="kong-workingHours__time" model="item" kong-editable config="{target:'attrs.time', editorType:'1'}"  ng-bind-html="item.attrs.time"></span>
    </li>
</ul>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lfb_working_hours', 'lfb_working_hours_callback');
function lfb_working_hours_callback($attrs, $content) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'hidden' => '',
        'icon' => '',
        'align' => 'bottom',
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $data = '';
    if($attrs['icon']){
        $data = ' data-icon="'.$attrs['icon'].'"';
    }

    $classes[] = 'kong-workingHours--align-'.$attrs['align'];
    $classes[] = $attrs['class_id'];

    ob_start(); ?>
    <ul class="kong-workingHours <?php echo implode(' ', $classes); ?>"<?php echo $data;?>>
        <?php echo do_shortcode($content);?>
    </ul>
    <?php
    return ob_get_clean();
}

add_shortcode('lfb_working_hours_item', 'lfb_working_hours_item_callback');
function lfb_working_hours_item_callback($attrs, $content) {
    $attrs = shortcode_atts(array(
        'day' => '',
        'time' => ''
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    ob_start(); ?>
    <li class="kong-workingHours__item">
        <span class="kong-workingHours__day"><span><?php echo html_entity_decode($attrs['day']); ?></span></span>
        <span class="kong-workingHours__line"></span>
        <span class="kong-workingHours__time"><?php echo html_entity_decode($attrs['time']); ?></span>
    </li>
    <?php
    return ob_get_clean();
}
