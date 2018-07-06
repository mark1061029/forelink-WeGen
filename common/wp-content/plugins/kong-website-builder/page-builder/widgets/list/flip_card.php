<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Flip Card",
    "tag" => "flip_card",
    "keywords" => ["flip card","box"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Text",
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
                    "default_value" => "John Doe"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.job",
                    "attrs" => array(
                        "label" => "Job",
                        "type" => "text"
                    ),
                    "default_value" => "Freelancer"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.reason",
                    "attrs" => array(
                        "label" => "Reason",
                        "type" => "text"
                    ),
                    "default_value" => "Greatest Product"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.comment",
                    "attrs" => array(
                        "label" => "Comment",
                        "type" => "textarea"
                    ),
                    "default_value" => $manager::$text["paragraph"]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "General Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 1000,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 420
                    ),
                    "responsive_styles" => array(
                        "@id [class$='__container']" => array(
                            "height" => "{{@model}}px"
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
                        "@id .kong-flipCard__front,@id .kong-flipCard__back" => array(
                            "boxShadow" => "{{@model}}"
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
                    "default_value" => 7,
                    "styles" => array(
                        "@id .kong-flipCard__front,@id .kong-flipCard__back" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker",
                        "config" => array(
                            "color" => "hex"
                        )
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id .kong-flipCard__back" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Front",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.front_image",
                    "attrs" => array(
                        "label" => "Image",
                        "type" => "upload-image"
                    ),
                    "default_value" => array(
                        "url" => ""
                    ),
                    "styles" => array(
                        "@id .kong-flipCard__front" => array(
                            "backgroundImage" => "url({{@model.url}})"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.front_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "25px 20px 25px 20px",
                    "styles" => array(
                        "@id .kong-flipCard__front__container" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.front_overlay",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "gradient",
                        "config" => array(
                            "third_color" => false,
                            "radial" => false
                        )
                    ),
                    "default_value" => array(
                        "color_1" => "rgba(0,0,0,0.4)",
                        "color_2" => "rgba(0,0,0,0.4)",
                        "angle" => 180,
                        "value" => "linear-gradient(180deg, rgba(0,0,0,0.5), rgba(0,0,0,0.5))"
                    ),
                    "styles" => array(
                        "@id .kong-flipCard__front:before" => array(
                            "background" => "{{@model.value}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.front_name_size",
                    "attrs" => array(
                        "label" => "Name Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 14,
                    "styles" => array(
                        "@id .kong-flipCard__front__name" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.front_name_weight",
                    "attrs" => array(
                        "label" => "Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 600,
                    "styles" => array(
                        "@id .kong-flipCard__front__name" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.front_name_letter_spacing",
                    "attrs" => array(
                        "label" => "Name Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.2,
                            "max" => 1,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.1,
                    "styles" => array(
                        "@id .kong-flipCard__front__name" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.front_name_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id .kong-flipCard__front__name" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.front_name_color",
                    "attrs" => array(
                        "label" => "Heading Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-flipCard__front__name" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.front_reason_size",
                    "attrs" => array(
                        "label" => "Reason Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 13,
                    "styles" => array(
                        "@id .kong-flipCard__front__reason" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.front_reason_color",
                    "attrs" => array(
                        "label" => "Reason Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#c2c2c2",
                    "styles" => array(
                        "@id .kong-flipCard__front__reason" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Back",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.lock",
                    "attrs" => array(
                        "label" => "Lock Back",
                        "type" => "switch",
                        "desc" => "Enable this button to keep the card always flip"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-flipCard__back" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "30px 30px 30px 30px",
                    "styles" => array(
                        "@id .kong-flipCard__back__container" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_comment_size",
                    "attrs" => array(
                        "label" => "Comment Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => 24,
                    "styles" => array(
                        "@id .kong-flipCard__back__comment" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_comment_weight",
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
                        "@id .kong-flipCard__back__comment" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.comment_color",
                    "attrs" => array(
                        "label" => "Comment Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-flipCard__back__comment" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.comment_line_height",
                    "attrs" => array(
                        "label" => "Line Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 1,
                            "max" => 3,
                            "step" => 0.05
                        )
                    ),
                    "default_value" => 1.45,
                    "styles" => array(
                        "@id .kong-flipCard__back__comment" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.comment_font_source",
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
                                "selector" => "@id .kong-flipCard__back__comment"
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_name_size",
                    "attrs" => array(
                        "label" => "Name Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 14,
                    "styles" => array(
                        "@id .kong-flipCard__back__name" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_name_weight",
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
                        "@id .kong-flipCard__back__name" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_name_letter_spacing",
                    "attrs" => array(
                        "label" => "Name Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.2,
                            "max" => 1,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.05,
                    "styles" => array(
                        "@id .kong-flipCard__back__name" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_name_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id .kong-flipCard__back__name" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_name_color",
                    "attrs" => array(
                        "label" => "Name",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-flipCard__back__name" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_job_size",
                    "attrs" => array(
                        "label" => "Job Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 13,
                    "styles" => array(
                        "@id .kong-flipCard__back__job" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_job_color",
                    "attrs" => array(
                        "label" => "Job Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        "@id  .kong-flipCard__back__job" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.back_image",
                    "attrs" => array(
                        "label" => "Image",
                        "type" => "upload-image"
                    ),
                    "default_value" => array(
                        "url" => ""
                    ),
                    "styles" => array(
                        "@id .kong-flipCard__back__avatar" => array(
                            "backgroundImage" => "url({{@model.url}})"
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
<div class="kong-flipCard {{::$ctrl.getID()}}" ng-class="[{'kong-flipCard--lock': $ctrl.edited.attrs.lock},$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-flipCard__front">
        <div class="kong-flipCard__front__container">
            <div class="kong-flipCard__front__footer">
                <h6 class="kong-flipCard__front__name" ng-bind="$ctrl.edited.attrs.name"></h6>
                <div class="kong-flipCard__front__reason" ng-bind="$ctrl.edited.attrs.reason"></div>
            </div>
        </div>
    </div>
    <div class="kong-flipCard__back">
        <div class="kong-flipCard__back__container">
            <p class="kong-flipCard__back__comment" ng-bind="$ctrl.edited.attrs.comment"></p>

            <div class="kong-flipCard__back__footer">
                <div class="kong-flipCard__back__avatar"></div>
                <div class="kong-flipCard__back__info">
                    <h6 class="kong-flipCard__back__name" ng-bind="$ctrl.edited.attrs.name"></h6>
                    <div class="kong-flipCard__back__job" ng-bind="$ctrl.edited.attrs.job"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_flip_card', 'kong_flip_card_callback');
function kong_flip_card_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'lock' => 'false',
        'hidden' => '',
        'name' => 'John Doe',
        'comment' => '',
        'job' => 'freelancer',
        'reason' => 'Greatest product'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if(kong_to_boolean($attrs['lock'])){
        $classes[] = 'kong-flipCard--lock';
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';


    ob_start();?>
    <div class="kong-flipCard <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <div class="kong-flipCard__front">
            <div class="kong-flipCard__front__container">
                <div class="kong-flipCard__front__footer">
                    <h6 class="kong-flipCard__front__name"><?php echo $attrs['name']; ?></h6>
                    <div class="kong-flipCard__front__reason"><?php echo $attrs['reason']; ?></div>
                </div>
            </div>
        </div>
        <div class="kong-flipCard__back">
            <div class="kong-flipCard__back__container">
                <p class="kong-flipCard__back__comment"><?php echo $attrs['comment']; ?></p>

                <div class="kong-flipCard__back__footer">
                    <div class="kong-flipCard__back__avatar"></div>
                    <div class="kong-flipCard__back__info">
                        <h6 class="kong-flipCard__back__name"><?php echo $attrs['name']; ?></h6>
                        <div class="kong-flipCard__back__job"><?php echo $attrs['job']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}