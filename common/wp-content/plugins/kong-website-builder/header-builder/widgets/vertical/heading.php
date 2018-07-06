<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Heading",
    "tag" => "v_heading",
    "keywords" => ["heading","text"],
    "native" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Content"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@content",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "rich-editor"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.size",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Size",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => 20,
                    "styles" => array(
                        "@id" => array(
                            "fontSize" => "{{@model}}px"
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
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id" => array(
                            "color" => "{{@model}}!important"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "20px 0px 20px 0px",
                    "styles" => array(
                        "@id" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_weight",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Font Weight",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 700,
                    "styles" => array(
                        "@id" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.line_height",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Line Height",
                        "config" => array(
                            "min" => 1,
                            "max" => 2,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => 1.2,
                    "styles" => array(
                        "@id" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.letter_spacing",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Letter Spacing",
                        "config" => array(
                            "min" => -0.2,
                            "max" => 1,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.05,
                    "styles" => array(
                        "@id" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_transform",
                    "attrs" => array(
                        "type" => "text-transform",
                        "label" => "Text Transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font",
                    "attrs" => array(
                        "type" => "font-source",
                        "label" => "Font"
                    ),
                    "default_value" => array(
                        "source" => "inherit",
                        "google" => array(
                            "family" => "Open Sans",
                            "variant" => "regular",
                            "subset" => "latin"
                        ),
                        "uploaded" => "",
                        "typekit" => ""
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
    ]
);

ob_start();
?>
<div class="kong-dnd__emptyItem kong-dnd__emptyItem--v" style="height:80px;" ng-if="!$ctrl.edited.content">
    <span class="kong-dnd__emptyItem__label">Heading</span>
</div>

<h4 class="kong-aside__heading {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" ng-bind-html="$ctrl.edited.content | trustashtml"></h4>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_v_heading', 'lhb_v_heading_callback');
function lhb_v_heading_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class' => '',
        'hidden' => '',
        'class_id' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if($attrs['class']){
        $classes[] = $attrs['class'];
    }

    if($attrs['hidden']){
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];

    $html = '<h4 class="kong-aside__heading '.implode(' ', $classes).'">'.$content.'</h4>';

    return $html;
}