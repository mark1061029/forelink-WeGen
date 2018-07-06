<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "List",
    "tag" => "v_list",
    "keywords" => ["list","icon","menu"],
    "native" => true,
    "v_nav" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Configuration",
                "collapse" => true
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model",
                    "attrs" => array(
                        "type" => "item-group",
                        "label" => "Item"
                    ),
                    "default_value" => []
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
                    "bind_to" => "@attrs.spacing",
                    "attrs" => array(
                        "type" => "area",
                        "label" => "Spacing",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "10px 0px 10px 0px",
                    "styles" => array(
                        "@id li" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_size",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Font Size",
                        "config" => array(
                            "min" => 8,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => 16,
                    "styles" => array(
                        "@id" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_weight",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Weight",
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
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style",
                "collapse" => true
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Icon Background"
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
                    "bind_to" => "@attrs.color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Color"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id a,@id span" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hover_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Hover"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id a:hover" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_style",
                    "attrs" => array(
                        "type" => "border-style",
                        "label" => "Border Style"
                    ),
                    "default_value" => "solid",
                    "styles" => array(
                        "@id li" => array(
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
                                "type" => "slider",
                                "label" => "Border Width",
                                "config" => array(
                                    "min" => 1,
                                    "max" => 5,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 1,
                            "styles" => array(
                                "@id li" => array(
                                    "borderBottomWidth" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.border_color",
                            "attrs" => array(
                                "type" => "colorpicker",
                                "label" => "Border Color"
                            ),
                            "default_value" => $manager::$colors["border"],
                            "styles" => array(
                                "@id li" => array(
                                    "borderColor" => "{{@model}}"
                                )
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hidden & Class"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hidden",
                    "attrs" => array(
                        "type" => "device-hidden",
                        "label" => "Devices"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.class",
                    "attrs" => array(
                        "type" => "text",
                        "label" => "Class"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ],
    "child" => array(
        "name" => "List Item",
        "tag" => "v_list_item",
        "content" => [
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Configuration",
                    "collapse" => true
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.name",
                        "attrs" => array(
                            "type" => "text",
                            "label" => "Label"
                        ),
                        "default_value" => "(+99) 999 999 999"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.link",
                        "attrs" => array(
                            "type" => "link",
                            "label" => "Link"
                        ),
                        "default_value" => array(
                            "url" => "#",
                            "new_tab" => false
                        )
                    ),
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
                            "icon" => "",
                            "source" => "fa"
                        )
                    )
                ]
            ),
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Class",
                    "collapse" => true
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.class",
                        "attrs" => array(
                            "type" => "text",
                            "label" => "Class"
                        ),
                        "default_value" => ""
                    )
                ]
            )
        ],
        "native" => true
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem kong-dnd__emptyItem--v" style="height:80px;" ng-if="!$ctrl.content.length">
    <span class="kong-dnd__emptyItem__label">List</span>
</div>

<ul class="kong-aside__list {{::$ctrl.getID()}}"
    ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <li ng-repeat="item in $ctrl.model.content">
        <i ng-class="item.attrs.icon.source + ' ' + item.attrs.icon.source + '-' + item.attrs.icon.icon" ng-show="item.attrs.icon.icon"></i>
        <a ng-class="item.attrs.class"><span ng-bind-html="item.attrs.name"></span></a>
    </li>
</ul>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_v_list', 'lhb_v_list_callback');
function lhb_v_list_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'hidden' => '',
        'class' => '',
        'class_id' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    $classes[] = $attrs['class_id'];

    $html = '<ul class="kong-aside__list ' . implode(' ', $classes) . '">' . do_shortcode($content) . '</ul>';

    return $html;
}

add_shortcode('lhb_v_list_item', 'lhb_v_list_item_callback');
function lhb_v_list_item_callback($attrs) {
    $attrs = shortcode_atts(array(
        'name' => '(+99) 999 999 999',
        'link' => json_encode(array(
            'url' => '#',
            'new_tab' => 'false'
        )),
        'icon' => json_encode(array(
            'source' => 'fa',
            'icon' => 'circle-thin'
        )),
        'class' => '',
        'class_id' => '',
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['icon'] = json_decode($attrs['icon'], true);
    $html = '<li class="'.$attrs['class_id'].'">';

    if($attrs['icon']['icon']){
        $icon_class = $attrs['icon']['source'].' '.$attrs['icon']['source'].'-'.$attrs['icon']['icon'];
        $html .= '<i class="'.$icon_class.'"></i>';
    }

    $attrs['link'] = json_decode($attrs['link'], true);

    if ($attrs['link']['url']) {
        $target = kong_to_boolean($attrs['link']['new_tab']) ? ' target="_blank"' : '';
        $before_link = '<a href="' . $attrs['link']['url'] . '" class="' . $attrs['class'] . '"' . $target . '>';
        $after_link = '</a>';
    } else {
        $before_link = '<span class="' . $attrs['class'] . '">';
        $after_link = '</span>';
    }

    $html .= $before_link . html_entity_decode($attrs['name']) . $after_link;
    $html .= '</li>';

    return $html;
}