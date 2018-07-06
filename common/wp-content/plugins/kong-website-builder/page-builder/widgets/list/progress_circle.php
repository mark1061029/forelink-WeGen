<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Progress Circle",
    "tag" => "progress_circle",
    "keywords" => ["progress","slide","circle"],
    "native" => true,
    "filter" => "other",
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
                    "bind_to" => "@attrs.size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 400,
                            "step" => 10
                        )
                    ),
                    "default_value" => 150
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.percent",
                    "attrs" => array(
                        "label" => "Percent",
                        "type" => "slider",
                        "config" => array(
                            "min" => 1,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 75
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
                    "default_value" => 7
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color_1",
                    "attrs" => array(
                        "label" => "Color 1",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color_2",
                    "attrs" => array(
                        "label" => "Color 2",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.animation",
                    "attrs" => array(
                        "label" => "Animation",
                        "type" => "switch",
                        "desc" => "Trigger animation when scrolling to the element"
                    ),
                    "default_value" => true
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
                    "bind_to" => "@attrs.percent_color",
                    "attrs" => array(
                        "label" => "Percent Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-progressCircle__percent" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.percent_size",
                    "attrs" => array(
                        "label" => "Percent Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 12,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 36,
                    "styles" => array(
                        "@id .kong-progressCircle__percent" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.percent_font_weight",
                    "attrs" => array(
                        "label" => "Percent Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 700,
                    "styles" => array(
                        "@id .kong-progressCircle__percent" => array(
                            "fontWeight" => "{{@model}}"
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
    ]
);

ob_start();
?>
<div class="kong-progressCircle {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]" id="{{$ctrl.edited.attrs.id}}">
    <div class=kong-progressCircle__container>
        <span class="kong-progressCircle__percent" ng-bind="$ctrl.edited.attrs.percent + '%'"></span>
        <div frontend-compile model="$ctrl.edited" callback="bindProgressCircle" attrs="['color_1', 'color_2', 'thickness', 'percent', 'size']"></div>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_progress_circle', 'kong_progress_circle_callback');
function kong_progress_circle_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'animation' => 'true',
        'percent' => 75,
        'color_1' => KongPageBuilderClient::KONG_COLOR_PRIMARY,
        'color_2' => KongPageBuilderClient::KONG_COLOR_PRIMARY,
        'size' => 150,
        'thickness' => 10
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    $data_settings = array(
        'percent' => $attrs['percent'],
        'color1' => $attrs['color_1'],
        'color2' => $attrs['color_2'],
        'animation' => kong_to_boolean($attrs['animation']),
        'size' => $attrs['size'],
        'thickness' => $attrs['thickness']
    );

    ob_start();?>
    <div class="kong-progressCircle <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <div class=kong-progressCircle__container>
            <span class="kong-progressCircle__percent"><?php echo html_entity_decode($attrs['percent']); ?>%</span>
            <div class="kong-progressCircle__graph" data-settings="<?php echo esc_attr(json_encode($data_settings)); ?>"></div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}