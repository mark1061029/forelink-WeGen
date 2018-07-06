<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Row",
    "tag" => "row",
    "native" => true,
    "core" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Layout",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.spacing",
                    "attrs" => array(
                        "type" => "res-spacing",
                        "fullwidth" => true,
                        "config" => array(
                            "margin" => ["1","0","1","0"],
                            "border" => ["1","1","1","1"],
                            "padding" => ["1","1","1","1"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => array(
                            "padding" => "0px 0px 0px 0px",
                            "margin" => "0px 0px 0px 0px",
                            "border" => "0px 0px 0px 0px"
                        )
                    ),
                    "responsive_styles" => array(
                        "@id > .kong-row__container" => array(
                            "padding" => "{{@model.padding}}",
                            "margin" => "{{@model.margin}}",
                            "borderWidth" => "{{@model.border}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "min" => 0,
                            "max" => 1000,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id > .kong-row__container" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.flex",
                    "attrs" => array(
                        "label" => "Flexbox",
                        "type" => "res-class",
                        "config" => array(
                            "prefix" => "kong-row",
                            "suffix" => "flex",
                            "devices" => ["desktop","tablet"]
                        ),
                        "desc" => "Select the device screen to set flexbox layout for the row. As the results, the heights of its columns will stretch equally."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.column_align",
                    "if" => "@attrs.flex",
                    "attrs" => array(
                        "label" => "Column Align",
                        "type" => "h-align",
                        "desc" => "Horizontally align the inside columns but the height of each column will shrink to wrap its content."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.col_reverse",
                    "attrs" => array(
                        "label" => "Reverse Column",
                        "type" => "res-class",
                        "config" => array(
                            "prefix" => "kong-row",
                            "suffix" => "colReverse",
                            "devices" => ["tablet","mobile"]
                        ),
                        "desc" => "Select the device screen where the order of columns is reversed. However, it will force columns to display vertically."
                    ),
                    "default_value" => ""
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Container Style",
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
                    "default_value" => "none",
                    "styles" => array(
                        "@id > .kong-row__container" => array(
                            "borderStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id > .kong-row__container" => array(
                            "borderColor" => "{{@model}}"
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
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id > .kong-row__container" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "attrs" => array(
                        "label" => "Background Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id > .kong-row__container" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.box_shadow",
                    "attrs" => array(
                        "label" => "Box Shadow",
                        "type" => "box-shadow"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id > .kong-row__container" => array(
                            "boxShadow" => "{{@model}}"
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
                        "type" => "animation"
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
                        "reset" => false
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
<div  class="kong-row {{::$ctrl.getID()}}" ng-class="[$ctrl.row.attrs.class, $ctrl.row.attrs.hidden, $ctrl.row.attrs.flex, $ctrl.row.attrs.col_reverse, 'kong-row--colAlign-'+$ctrl.row.attrs.column_align]" id="{{$ctrl.row.attrs.id}}">
    <div class="kong-dnd__dropMe kong-dnd__dropMe--lv2">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="kong-dnd__visual kong-dnd__visual--lv2 lvh__{{::$ctrl.getID()}}"
         kong-detect-hover-node="$ctrl.row"
         ng-mousedown="$ctrl.service.hide = 'kong-dnd__area--showList--lv2'">
        <div class="kong-dnd__visual__label" kong-keep-visual-label>
            <div class="kong-dnd__visual__label__name" node-tree model='$ctrl.row'>
                <span ng-bind="::$ctrl.row.name" ng-click="$ctrl.service.setEdited($ctrl.row, true)"></span>
            </div>
        </div>
        <kong-action current="$ctrl.row"></kong-action>
    </div>

    <div class="kong-row__container">
        <kong-column-list row="$ctrl.row"></kong-column-list>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('kong_row', 'kong_row_callback');
function kong_row_callback($attrs, $content = '') {
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
            'reset' => 'false'
        )),
        'col_reverse' => '',
        'flex' => '',
        'column_align' => ''
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $animation = kong_form_animation_data($attrs['animation']);

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']){
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['flex']){
        $classes[] = $attrs['flex'];

        if($attrs['column_align']){
            $classes[] = 'kong-row--colAlign-'.$attrs['column_align'];
        }
    }

    if($attrs['col_reverse']){
        $classes[] = $attrs['col_reverse'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-row <?php echo implode(' ', $classes); ?>"<?php echo $id.$animation; ?>>
        <div class="kong-row__container kong-row__columnList"><?php echo do_shortcode($content); ?></div>
    </div>
    <?php
    return ob_get_clean();
}