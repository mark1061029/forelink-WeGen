<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Accordions",
    "tag" => "accordions",
    "keywords" => ["accordion"],
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
                        "label" => "Accordion List",
                        "type" => "item-group"
                    ),
                    "default_value" => []
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
                    "bind_to" => "@attrs.label_padding",
                    "attrs" => array(
                        "label" => "Label Padding",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "15px 0px 15px 0px",
                    "styles" => array(
                        "@id .kong-accordion__label" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_padding",
                    "attrs" => array(
                        "label" => "Content Padding",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "20px 0px 20px 0px",
                    "styles" => array(
                        "@id .kong-accordion__content__wrap" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.margin_bottom",
                    "attrs" => array(
                        "label" => "Margin Bottom",
                        "type" => "slider",
                        "config" => array(
                            "min" => -5,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-accordion" => array(
                            "marginBottom" => "{{@model}}px"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Label",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.label_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 18,
                    "styles" => array(
                        "@id .kong-accordion__label__name" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.label_color",
                    "attrs" => array(
                        "label" => "Label Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-accordion__label" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.label_hover_color",
                    "attrs" => array(
                        "label" => "Label Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-accordion__label:hover,@id .kong-accordion__label:hover .kong-accordion__btn" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.label_font_weight",
                    "attrs" => array(
                        "label" => "Font Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 500,
                    "styles" => array(
                        "@id .kong-accordion__label__name" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.label_letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.5,
                            "max" => 0.5,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-accordion__label__name" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.label_text_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id .kong-accordion__label__name" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Arrow",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.arrow",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "if" => "@attrs.arrow",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.arrow_btn",
                            "attrs" => array(
                                "label" => "Arrow Size",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 8,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 20,
                            "styles" => array(
                                "@id .kong-accordion__btn" => array(
                                    "fontSize" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.arrow_top",
                            "attrs" => array(
                                "label" => "Top",
                                "type" => "slider",
                                "config" => array(
                                    "min" => -20,
                                    "max" => 20,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 0,
                            "styles" => array(
                                "@id .kong-accordion__btn" => array(
                                    "top" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.arrow_left",
                            "attrs" => array(
                                "label" => "Left",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 40,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 10,
                            "styles" => array(
                                "@id .kong-accordion__btn" => array(
                                    "marginLeft" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.arrow_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["desc"],
                            "styles" => array(
                                "@id .kong-accordion__btn" => array(
                                    "color" => "{{@model}}"
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
                "label" => "Content",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 14,
                    "styles" => array(
                        "@id .kong-accordion__content" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_color",
                    "attrs" => array(
                        "label" => "Label Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id .kong-accordion__content" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_line_height",
                    "attrs" => array(
                        "label" => "Line Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 1,
                            "max" => 3,
                            "step" => 0.05
                        )
                    ),
                    "default_value" => 1.5,
                    "styles" => array(
                        "@id .kong-accordion__content" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Border",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id .kong-accordion__label" => array(
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
        "name" => "Accordion",
        "tag" => "accordion",
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
                        "default_value" => "Accordion"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@content",
                        "attrs" => array(
                            "type" => "rich-editor",
                            "fullwidth" => true
                        ),
                        "default_value" => $manager::$text["paragraph"]
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.opened",
                        "attrs" => array(
                            "label" => "Opened",
                            "type" => "switch"
                        ),
                        "default_value" => false
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem" style="height:100px" ng-if="$ctrl.edited.content.length === 0">
    <span class="kong-dnd__emptyItem__label">Accordions</span>
</div>

<div class="kong-accordions {{::$ctrl.getID()}}" id="{{$ctrl.edited.attrs.id}}"
     ng-class="[{'kong-accordions--noArrow':!$ctrl.edited.attrs.arrow},$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <div class="kong-accordion" ng-repeat="item in $ctrl.content track by $index">
        <div class="kong-accordion__label" frontend-compile callback="bindAccordion" ng-class="{'kong-accordion__label--active': item.attrs.opened}">
            <h6 class="kong-accordion__label__name" kong-editable model="item" config="{target:'attrs.name', editorType:'1'}" ng-bind-html="item.attrs.name"></h6>
            <span class="kong-accordion__btn"><i class="fa fa-angle-right"></i></span>
        </div>

        <div class="kong-accordion__content">
            <div class="kong-accordion__content__wrap" kong-editable model="item" config="{target:'content', editorType:'4'}" ng-bind-html="item.content | trustashtml"></div>
        </div>
    </div>
</div>

<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_accordions', 'kong_accordions_callback');
function kong_accordions_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'id' => '',
        'class' => '',
        'hidden' => '',
        'arrow' => 'false',
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
        'no_border' => 'false'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if (!kong_to_boolean($attrs['arrow'])) {
        $classes[] = 'kong-accordions--noArrow';
    }

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $attrs['animation']['selector'] = '.kong-accordion';
    $animation = kong_form_animation_data($attrs['animation']);

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-accordions <?php echo implode(' ', $classes); ?>"<?php echo $animation.$id; ?>>
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_accordion', 'kong_accordion_callback');
function kong_accordion_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'opened' => 'false',
        'name' => 'Accordion'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if (kong_to_boolean($attrs['opened'])) {
        $classes[] = 'kong-accordion__label--active';
    }

    ob_start(); ?>
    <div class="kong-accordion <?php echo $attrs['class_id']; ?>">
        <div class="kong-accordion__label <?php echo implode(' ', $classes); ?>">
            <h6 class="kong-accordion__label__name"><?php echo html_entity_decode($attrs['name']); ?></h6>
            <span class="kong-accordion__btn"><i class="fa fa-angle-right"></i></span>
        </div>

        <div class="kong-accordion__content">
            <div class="kong-accordion__content__wrap"><?php echo do_shortcode($content); ?></div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}