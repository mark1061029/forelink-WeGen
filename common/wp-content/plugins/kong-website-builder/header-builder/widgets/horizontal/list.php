<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "List",
    "tag" => "h_list",
    "keywords" => ["list","icon","menu"],
    "native" => true,
    "h_nav" => true,
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
                        "label" => "Items",
                        "type" => "item-group"
                    ),
                    "default_value" => []
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style & Spacing",
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
                    "default_value" => "solid",
                    "styles" => array(
                        "@id li" => array(
                            "borderStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 20,
                    "styles" => array(
                        "@id li" => array(
                            "height" => "{{@model}}px",
                            "lineHeight" => "{{@model}}px"
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
                            "min" => 5,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 10,
                    "styles" => array(
                        "@id li" => array(
                            "padding" => "0 {{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => 14,
                    "styles" => array(
                        "@id li" => array(
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
                        "@id li" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hide_left",
                    "attrs" => array(
                        "label" => "Hide Left",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hide_right",
                    "attrs" => array(
                        "label" => "Hide Right",
                        "type" => "switch"
                    ),
                    "default_value" => true
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
                        "label" => "Icon",
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
                    "bind_to" => "@attrs.border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        "@id li" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color",
                    "attrs" => array(
                        "label" => "Text",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id a, @id a span" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hover_color",
                    "attrs" => array(
                        "label" => "Link Hover",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id a:hover span" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hidden & Class",
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.class",
                    "attrs" => array(
                        "label" => "Class",
                        "type" => "text"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ],
    "child" => array(
        "name" => "List Item",
        "tag" => "h_list_item",
        "native" => true,
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
                    "label" => "Content",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.name",
                        "attrs" => array(
                            "label" => "Label",
                            "type" => "text"
                        ),
                        "default_value" => "(+99) 999 999 999"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.link",
                        "attrs" => array(
                            "label" => "Link",
                            "type" => "link"
                        ),
                        "default_value" => array(
                            "url" => "#",
                            "new_tab" => false
                        )
                    )
                ]
            ),
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Custom Class",
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
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem kong-dnd__emptyItem--h" style="width:140px;" ng-if="!$ctrl.content.length">
    <span class="kong-dnd__emptyItem__label">List</span>
</div>

<ul class="kong-header__list {{::$ctrl.getID()}}"
    ng-class="[{'kong-header__list--hideLeft':$ctrl.edited.attrs.hide_left, 'kong-header__list--hideRight':$ctrl.edited.attrs.hide_right}, $ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <li class="kong-header__list__item" ng-repeat="item in $ctrl.model.content">
        <i ng-class="item.attrs.icon.source + ' ' + item.attrs.icon.source + '-' + item.attrs.icon.icon"></i>
        <a ng-class="item.attrs.class">
            <span ng-bind-html="item.attrs.name"></span>
        </a>
    </li>
</ul>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_h_list', 'lhb_h_list_callback');
function lhb_h_list_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'hide_left' => 'false',
        'hide_right' => 'false',
        'hidden' => '',
        'class' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if (kong_to_boolean($attrs['hide_left'])) {
        $classes[] = 'kong-header__list--hideLeft';
    }

    if (kong_to_boolean($attrs['hide_right'])) {
        $classes[] = 'kong-header__list--hideRight';
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    $classes[] = $attrs['class_id'];

    $html = '<ul class="kong-header__list ' . implode(' ', $classes) .'">' . do_shortcode($content) . '</ul>';

    return $html;
}

add_shortcode('lhb_h_list_item', 'lhb_h_list_item_callback');
function lhb_h_list_item_callback($attrs) {
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
    $html = '<li class="kong-header__list__item '.$attrs['class_id'].'">';

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

    $html .= $before_link. html_entity_decode($attrs['name']) . $after_link;
    $html .= '</li>';

    return $html;
}
