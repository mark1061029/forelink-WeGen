<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Skillbars",
    "tag" => "skillbars",
    "keywords" => ["skillbar"],
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
                        "label" => "Bars",
                        "type" => "item-group"
                    ),
                    "default_value" => []
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Name",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => 12,
                    "styles" => array(
                        "@id .kong-skillBar__name" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_weight",
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
                        "@id .kong-skillBar__name" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.1,
                            "max" => 0.5,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.1,
                    "styles" => array(
                        "@id .kong-skillBar__name" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_text_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id .kong-skillBar__name" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_color",
                    "attrs" => array(
                        "label" => "Name Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-skillBar__name" => array(
                            "color" => "{{@model}}"
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
                    "bind_to" => "@attrs.rounded_corners",
                    "attrs" => array(
                        "label" => "Rounded Corners",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-skillBar__percent" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.space_color",
                    "attrs" => array(
                        "label" => "Space Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id .kong-skillBar__line" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.thickness",
                    "attrs" => array(
                        "label" => "Thickness",
                        "type" => "slider",
                        "config" => array(
                            "min" => 1,
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => 3,
                    "styles" => array(
                        "@id .kong-skillBar__line" => array(
                            "height" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.distance",
                    "attrs" => array(
                        "label" => "Distance",
                        "type" => "slider",
                        "config" => array(
                            "min" => 5,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => 18,
                    "styles" => array(
                        "@id .kong-skillBar" => array(
                            "marginBottom" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.percent_bg",
                    "attrs" => array(
                        "label" => "Percent Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#101010",
                    "styles" => array(
                        "@id .kong-skillBar__line span" => array(
                            "backgroundColor" => "{{@model}}"
                        ),
                        "@id .kong-skillBar__line span:before" => array(
                            "borderTopColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.percent_color",
                    "attrs" => array(
                        "label" => "Percent Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-skillBar__line span" => array(
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
                        "label" => "Animation",
                        "type" => "switch",
                        "desc" => "Enable this button to let the bars go slide when you scroll to."
                    ),
                    "default_value" => false
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
        "name" => "Bar",
        "tag" => "skillbar",
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
                        "bind_to" => "@attrs.name",
                        "attrs" => array(
                            "label" => "Name",
                            "type" => "Text"
                        ),
                        "default_value" => "Skill Name"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.percent",
                        "attrs" => array(
                            "label" => "Percent",
                            "type" => "slider",
                            "config" => array(
                                "min" => 0,
                                "max" => 100,
                                "step" => 1
                            )
                        ),
                        "default_value" => 75,
                        "styles" => array(
                            "@id .kong-skillBar__percent" => array(
                                "width" => "{{@model}}%"
                            )
                        ),
                        "generate" => "both"
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem" style="height:80px" ng-if="$ctrl.content.length === 0">
    <span class="kong-dnd__emptyItem__label">Skillbars</span>
</div>

<ul class="kong-skillBars {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden, {'kong-skillBars--rounded':$ctrl.edited.attrs.rounded_corners}]" id="{{$ctrl.edited.attrs.id}}">
    <li class="kong-skillBar" ng-repeat="item in $ctrl.edited.content track by $index" ng-style="{'color' : item.attrs.color}">
        <span class="kong-skillBar__name" kong-editable model="item" config="{target:'attrs.name', editorType:'1'}" ng-bind-html="item.attrs.name"></span>
        <div class="kong-skillBar__line">
            <div class="kong-skillBar__percent" ng-style="{'width':item.attrs.percent + '%'}">
                <span ng-bind="item.attrs.percent + '%'"></span>
            </div>
        </div>
    </li>
</ul>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_skillbars', 'kong_skillbars_callback');
function kong_skillbars_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'animation' => 'false',
        'hidden' => '',
        'rounded_corners' => 'false'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if (kong_to_boolean($attrs['rounded_corners'])) {
        $classes[] = 'kong-skillBars--rounded';
    }

    if (kong_to_boolean($attrs['animation'])) {
        $classes[] = 'kong-skillBars--animated';
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <ul class="kong-skillBars <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <?php echo do_shortcode($content); ?>
    </ul>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_skillbar', 'kong_skillbar_callback');
function kong_skillbar_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'name' => 'Skill Name',
        'percent' => 75,
        'bg' => KongPageBuilderClient::KONG_COLOR_PRIMARY
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    ob_start(); ?>
    <li class="kong-skillBar <?php echo $attrs['class_id']; ?>">
        <span class="kong-skillBar__name"><?php echo html_entity_decode($attrs['name']); ?></span>
        <div class="kong-skillBar__line">
            <div class="kong-skillBar__percent">
                <span><?php echo $attrs['percent']; ?>%</span>
            </div>
        </div>
    </li>
    <?php
    return ob_get_clean();
}