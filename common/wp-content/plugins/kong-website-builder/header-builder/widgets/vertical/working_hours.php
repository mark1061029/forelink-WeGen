<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Working Hours",
    "tag" => "v_working_hours",
    "keywords" => ["Working Hours"],
    "native" => true,
    "v_nav" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Items"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model",
                    "attrs" => array(
                        "type" => "item-group",
                        "label" => "Items"
                    ),
                    "default_value" => []
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style"
            ),
            "content" => [
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
                    "default_value" => 18,
                    "styles" => array(
                        "@id li" => array(
                            "marginBottom" => "{{@model}}px"
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
                        "@id" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Icon Color"
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
                    "bind_to" => "@attrs.font_size",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Font Size",
                        "config" => array(
                            "min" => 8,
                            "max" => 20,
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
                    "bind_to" => "@attrs.dot_color",
                    "attrs" => array(
                        "type" => "colorpicker",
                        "label" => "Dot Color"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id .kong-aside__workingHours__dots" => array(
                            "backgroundImage" => "radial-gradient(circle closest-side,{{@model}} 99%,transparent 100%)"
                        )
                    )
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
        "name" => "Working Hour",
        "tag" => "v_working_hour",
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
                        "bind_to" => "@attrs.days",
                        "attrs" => array(
                            "type" => "text",
                            "label" => "Days"
                        ),
                        "default_value" => "Monday - Friday"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.time",
                        "attrs" => array(
                            "type" => "text",
                            "label" => "Time"
                        ),
                        "default_value" => "9AM - 5PM"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.icon_thin",
                        "attrs" => array(
                            "type" => "switch",
                            "label" => "Icon Thin"
                        ),
                        "default_value" => false
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
    <span class="kong-dnd__emptyItem__label">Working Hours</span>
</div>

<ul class="kong-aside__workingHours {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <li ng-repeat="wh in $ctrl.content">
        <span class="kong-aside__workingHours__day"><i ng-class="wh.attrs.icon_thin ? 'lnr lnr-clock' : 'fa fa-clock-o'"></i> {{wh.attrs.days}}</span>
        <span class="kong-aside__workingHours__dots"></span>
        <span class="kong-aside__workingHours__hours" ng-bind="wh.attrs.time"></span>
    </li>
</ul>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_v_working_hours', 'lhb_v_working_hours_callback');
function lhb_v_working_hours_callback($attrs, $content = null) {
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

    $html = '<div class="kong-aside__workingHours ' . implode(' ', $classes) . '">';
    $html .= '<ul>' . do_shortcode($content) . '</ul>';
    $html .= '</div>';

    return $html;
}

add_shortcode('lhb_v_working_hour', 'lhb_v_working_hour_callback');
function lhb_v_working_hour_callback($attrs) {
    $attrs = shortcode_atts(array(
        'days' => 'Monday - Friday',
        'time' => '9AM - 5PM',
        'icon_thin' => 'false'
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $html = '<li>';
    $html .= '<span class="kong-aside__workingHours__day"><i class="' . ((kong_to_boolean($attrs['icon_thin'])) ? 'lnr lnr-clock' : 'fa fa-clock-o') . '"></i> ' . $attrs['days'] . '</span>';
    $html .= '<span class="kong-aside__workingHours__dots"></span>';
    $html .= '<span class="kong-aside__workingHours__hours">' . $attrs['time'] . '</span>';
    $html .= '</li>';

    return $html;
}