<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Button Tabs",
    "tag" => "tabs",
    "keywords" => ["button tabs"],
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
                "label" => "Text",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_size",
                    "attrs" => array(
                        "label" => "Name",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 40,
                            "step" => 1
                        ),
                        "desc" => "<strong>Note:</strong> drag the value to zero to hide name then it is possible to make the tabs look like a pagination."
                    ),
                    "default_value" => array(
                        "desktop" => 14
                    ),
                    "responsive_styles" => array(
                        "@id .kong-btnTabs__item__name" => array(
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
                    "default_value" => 300,
                    "styles" => array(
                        "@id .kong-btnTabs__item__name" => array(
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
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-btnTabs__item__name" => array(
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
                    "default_value" => "",
                    "styles" => array(
                        "@id .kong-btnTabs__item__name" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_source",
                    "attrs" => array(
                        "label" => "Font Source",
                        "type" => "font-source"
                    ),
                    "default_value" => array(
                        "source" => "inherit",
                        "google" => array(
                            "family" => "Open Sans",
                            "variant" => "regular",
                            "subset" => "latin"
                        ),
                        "uploaded" => ""
                    ),
                    "directives" => [
                        array(
                            "tag" => "embed-font-source",
                            "attrs" => array(
                                "selector" => "@id"
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Spacing",
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
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "10px 20px 10px 20px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-tab" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 0px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-tab" => array(
                            "borderWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_bold",
                    "attrs" => array(
                        "label" => "Bold Border Position",
                        "type" => "selection",
                        "config" => array(
                            "top" => "Top",
                            "bottom" => "Bottom"
                        )
                    ),
                    "default_value" => "bottom"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.min_width",
                    "attrs" => array(
                        "label" => "Min Width",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 300,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 0
                    ),
                    "responsive_styles" => array(
                        "@id .kong-tab" => array(
                            "minWidth" => "{{@model}}px"
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
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 100,
                    "styles" => array(
                        "@id .kong-tab" => array(
                            "borderRadius" => "{{@model}}px"
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
                        "@id .kong-tab" => array(
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
                        "@id .kong-tab" => array(
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
                    "default_value" => "#999999",
                    "styles" => array(
                        "@id .kong-btnTabs__item__name" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        "@id .kong-tab" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_bottom_color",
                    "attrs" => array(
                        "label" => "Bold Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id.kong-btnTabs--bottom .kong-tab" => array(
                            "borderBottomColor" => "{{@model}}"
                        ),
                        "@id.kong-btnTabs--top .kong-tab" => array(
                            "borderTopColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Active Color",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.active_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-tab.kong-tab--active" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.active_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id .kong-tab--active .kong-btnTabs__item__name" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.active_border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        "@id .kong-tab.kong-tab--active" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.active_border_bold_color",
                    "attrs" => array(
                        "label" => "Bold Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        "@id.kong-btnTabs--bottom .kong-tab.kong-tab--active" => array(
                            "borderBottomColor" => "{{@model}}"
                        ),
                        "@id.kong-btnTabs--top .kong-tab.kong-tab--active" => array(
                            "borderTopColor" => "{{@model}}"
                        )
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
        "name" => "Tab",
        "tag" => "tab",
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
    <span class="kong-dnd__emptyItem__label">Button Tabs</span>
</div>

<div class="kong-btnTabs kong-tabs {{::$ctrl.getID()}}"
     ng-class="['kong-btnTabs--'+$ctrl.edited.attrs.border_bold, $ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]"
     id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-btnTabs__viewport">
        <div class="kong-btnTabs__item kong-tab" kong-tab-select ng-repeat="item in $ctrl.content track by $index" ng-class="{'kong-tab--active': $ctrl.edited.attrs.active == item.attrs.point_to}" data-tab-name="{{item.attrs.point_to}}">
            <span class="kong-btnTabs__item__name" kong-editable model="item" config="{target:'attrs.name', editorType:'1'}" ng-bind-html="item.attrs.name"></span>
            <style type="text/css" ng-if="($ctrl.attr.active != item.attrs.point_to)">
                #{{item.attrs.point_to}} {display: none;}
            </style>
        </div>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_tabs', 'kong_tabs_callback');
function kong_tabs_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'active' => '',
        'border_bold' => 'bottom'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = 'kong-btnTabs--' . $attrs['border_bold'];

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <?php if($attrs['active']): ?>
        <style type="text/css">#<?php echo $attrs['active']; ?>{display:block}</style>
    <?php endif; ?>
    <div class="kong-btnTabs kong-tabs <?php echo implode(' ', $classes); ?>"<?php echo $id; ?> data-active="<?php echo $attrs['active']; ?>">
        <div class="kong-tabs__viewport">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_tab', 'kong_tab_callback');
function kong_tab_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'point_to' => '',
        'name' => 'Tab Name'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    ob_start(); ?>
    <style type="text/css">#<?php echo $attrs['point_to']?>{display:none;}</style>
    <div class="kong-btnTabs__item kong-tab <?php echo $attrs['class_id'] ?>" data-tab-name="<?php echo $attrs['point_to']; ?>">
        <span class="kong-btnTabs__item__name"><?php echo html_entity_decode($attrs['name']); ?></span>
    </div>
    <?php
    return ob_get_clean();
}
