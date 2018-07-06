<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Social Icons",
    "tag" => "v_social_icons",
    "keywords" => ["social icon","facebook","twitter","sharing"],
    "filter" => "other",
    "v_nav" => true,
    "native" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Icons",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model",
                    "attrs" => array(
                        "label" => "Icons",
                        "type" => "item-group",
                        "config" => array(
                            "refer" => "icon"
                        )
                    ),
                    "default_value" => []
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.coloring",
                    "attrs" => array(
                        "label" => "Color Style",
                        "type" => "text-buttons",
                        "config" => array(
                            "options" => array(
                                "custom" => "Custom",
                                "brand" => "Brand"
                            )
                        )
                    ),
                    "default_value" => "custom"
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
                            "min" => 10,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 40
                    ),
                    "responsive_styles" => array(
                        "@id .kong-socialIcons__item" => array(
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
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 10,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 2
                    ),
                    "responsive_styles" => array(
                        "@id .kong-socialIcons__item" => array(
                            "borderWidth" => "{{@model}}px"
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
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 20
                    ),
                    "responsive_styles" => array(
                        "@id .kong-socialIcons__item" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.distance",
                    "attrs" => array(
                        "label" => "Distance",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 4
                    ),
                    "responsive_styles" => array(
                        "@id .kong-socialIcons__item" => array(
                            "margin" => "0 {{@model}}px"
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
                        "@id .kong-socialIcons__item" => array(
                            "borderRadius" => "{{@model}}%"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "if" => "@attrs.coloring == 'custom'",
            "attrs" => array(
                "label" => "Coloring",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#999999",
                    "styles" => array(
                        "@id .kong-socialIcons__item" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hover_color",
                    "attrs" => array(
                        "label" => "Hover Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#000000",
                    "styles" => array(
                        "@id .kong-socialIcons__item:hover" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        "@id .kong-socialIcons__item" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hover_bg",
                    "attrs" => array(
                        "label" => "Hover Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        "@id .kong-socialIcons__item:hover" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "if" => "@attrs.border_width",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.border_color",
                            "attrs" => array(
                                "label" => "Border",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#999999",
                            "styles" => array(
                                "@id .kong-socialIcons__item" => array(
                                    "borderColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.hover_border_color",
                            "attrs" => array(
                                "label" => "Hover Border",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#000000",
                            "styles" => array(
                                "@id .kong-socialIcons__item:hover" => array(
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
        "name" => "Social Icon",
        "tag" => "v_social_icon",
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
                        "bind_to" => "@attrs.link",
                        "attrs" => array(
                            "label" => "Link",
                            "type" => "link"
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
                            "type" => "social-icons"
                        ),
                        "default_value" => "twitter"
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
    <div class="kong-dnd__emptyItem kong-dnd__emptyItem--v" style="height:60px;" ng-if="!$ctrl.edited.content.length">
        <span class="kong-dnd__emptyItem__label">Social Icons</span>
    </div>

    <div class="kong-socialIcons {{::$ctrl.getID()}}" ng-class="[{'kong-brandColor': $ctrl.edited.attrs.coloring == 'brand'} ,$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
        <a class="kong-socialIcons__item" ng-repeat="item in $ctrl.edited.content track by $index" data-icon="{{item.attrs.icon}}">
            <i class="fa" ng-class="'fa-' + item.attrs.icon"></i>
        </a>
    </div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lhb_v_social_icons', 'lhb_v_social_icons_callback');
function lhb_v_social_icons_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'coloring' => 'custom',
        'id' => '',
        'hidden' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if($attrs['coloring'] == 'brand'){
        $classes[] = 'kong-brandColor';
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-socialIcons <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('lhb_v_social_icon', 'lhb_v_social_icon_callback');
function lhb_v_social_icon_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'icon' => 'fa-twitter',
        'link' => json_encode(array(
            'url' => '#',
            'new_tab' => 'false'
        ))
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['link'] = json_decode($attrs['link'], true);

    if (!empty($attrs['link']['url'])) {
        $target = kong_to_boolean($attrs['link']['new_tab']) ? ' target="_blank"' : '';
        $link_before = '<a href="' . $attrs['link']['url'] . '" class="kong-socialIcons__item ' . $attrs['class_id'] . '"' . $target . ' data-icon="'.$attrs['icon'].'">';
        $link_after = '</a>';
    } else {
        $link_before = '<span class="kong-socialIcons__item ' . $attrs['class_id'] . '">';
        $link_after = '</span>';
    }

    ob_start();
    echo $link_before; ?>
    <i class="fa fa-<?php echo $attrs['icon'] ?>"></i>
    <?php
    echo $link_after;
    return ob_get_clean();
}