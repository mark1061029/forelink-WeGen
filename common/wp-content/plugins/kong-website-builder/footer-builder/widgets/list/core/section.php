<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Section",
    "tag" => "section",
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
                        "@id" => array(
                            "padding" => "{{@model.padding}}",
                            "margin" => "{{@model.margin}}",
                            "borderWidth" => "{{@model.border}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_style",
                    "attrs" => array(
                        "label" => "Border Style",
                        "type" => "border-style"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id" => array(
                            "borderStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "show" => "@attrs.border_style != 'none'",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.fullwidth",
                    "attrs" => array(
                        "label" => "Fullwidth",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.min_height",
                    "attrs" => array(
                        "label" => "Min Height",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => ["px","%","vh"]
                        ),
                        "desc" => "Specify the minimum height of this section. This value is based on the percentage of your screen device."
                    ),
                    "default_value" => array(
                        "desktop" => "0vh"
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "minHeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_align",
                    "attrs" => array(
                        "label" => "Content Alignment",
                        "type" => "h-align"
                    ),
                    "default_value" => "top"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_align",
                    "attrs" => array(
                        "label" => "Text Align",
                        "type" => "res-text-align"
                    ),
                    "default_value" => array(
                        "desktop" => ""
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "textAlign" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Background",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "attrs" => array(
                        "label" => "Background Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_style",
                    "attrs" => array(
                        "label" => "Style",
                        "type" => "background-style",
                        "config" => array(
                            "none" => true,
                            "color" => false,
                            "image" => true,
                            "gradient" => true,
                            "video" => false
                        )
                    ),
                    "default_value" => "none"
                ),
                array(
                    "if" => "@attrs.bg_style == 'image'",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.bg_image",
                            "attrs" => array(
                                "label" => "Background Image",
                                "type" => "upload-image"
                            ),
                            "default_value" => array(
                                "url" => ""
                            ),
                            "styles" => array(
                                "@id.kong-section--bgStyle-image" => array(
                                    "backgroundImage" => "url({{@model.url}})"
                                )
                            )
                        ),
                        array(
                            "if" => "@attrs.bg_image.url",
                            "content" => [
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.bg_props",
                                    "attrs" => array(
                                        "type" => "background-props",
                                        "fullwidth" => true
                                    ),
                                    "default_value" => array(
                                        "repeat" => "no-repeat",
                                        "position" => "50% 50%",
                                        "size" => "cover",
                                        "attachment" => ""
                                    ),
                                    "styles" => array(
                                        "@id.kong-section--bgStyle-image" => array(
                                            "backgroundRepeat" => "{{@model.repeat}}",
                                            "backgroundPosition" => "{{@model.position}}",
                                            "backgroundSize" => "{{@model.size}}",
                                            "backgroundAttachment" => "{{@model.attachment}}"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.bg_effect",
                                    "attrs" => array(
                                        "label" => "Background Animation",
                                        "type" => "text-buttons",
                                        "config" => array(
                                            "options" => array(
                                                "none" => "None",
                                                "x" => "Animate X",
                                                "y" => "Animate Y"
                                            )
                                        )
                                    ),
                                    "default_value" => "none"
                                )
                            ]
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_gradient",
                    "if" => "@attrs.bg_style == 'gradient'",
                    "attrs" => array(
                        "label" => "Gradient",
                        "type" => "gradient",
                        "config" => array(
                            "third_color" => true,
                            "radial" => true
                        )
                    ),
                    "default_value" => array(
                        "color_1" => "#f6fbfc",
                        "color_2" => "#f5f7fc",
                        "color_3" => "#e2e6f4",
                        "angle" => 180,
                        "radial" => false,
                        "radial_x" => "center",
                        "radial_y" => "bottom",
                        "value" => "linear-gradient(180deg, #f6fbfc, #f5f7fc, #e2e6f4)"
                    ),
                    "styles" => array(
                        "@id.kong-section--bgStyle-gradient" => array(
                            "background" => "{{@model.value}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Overlay",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.overlay",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.overlay",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.overlay_bg",
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
                                "angle" => 90,
                                "value" => "linear-gradient(90deg, rgba(0,0,0,0.4), rgba(0,0,0,0.4))"
                            ),
                            "styles" => array(
                                "@id .kong-section__overlay" => array(
                                    "background" => "{{@model.value}}"
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
                "label" => "Half Background",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.half_bg",
                    "attrs" => array(
                        "label" => "Half Background",
                        "type" => "res-class",
                        "config" => array(
                            "prefix" => "kong-section",
                            "suffix" => "halfBg",
                            "devices" => ["desktop","tablet"]
                        ),
                        "desc" => "Select the device where a background panel will show on a half of this section."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.half_bg_color",
                    "if" => "@attrs.half_bg",
                    "attrs" => array(
                        "label" => "Background Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#000000",
                    "styles" => array(
                        "@id[class*='-halfBg']:before" => array(
                            "backgroundColor" => "{{@model}}"
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
                "label" => "Class",
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
                )
            ]
        )
    ]
);

ob_start();
?>
<div class="kong-section {{::$ctrl.getID()}}"
     ng-class="[$ctrl.section.attrs.half_bg, $ctrl.section.attrs.class, $ctrl.section.attrs.hidden,'kong-section--bgStyle-'+$ctrl.section.attrs.bg_style,'kong-section--bgEffect-'+$ctrl.section.attrs.bg_effect, 'kong-section--align-'+$ctrl.section.attrs.content_align]">

    <div class="kong-section__overlay" ng-show="$ctrl.edited.attrs.overlay"></div>

    <div class="kong-dnd__dropMe kong-dnd__dropMe--lv1">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="kong-dnd__visual kong-dnd__visual--lv1 lvh__{{::$ctrl.getID()}}" kong-detect-hover-node="$ctrl.section">
        <div class="kong-dnd__visual__label" kong-keep-visual-label>
            <div class="kong-dnd__visual__label__name">
                <span ng-bind="::$ctrl.section.name"></span>
            </div>
        </div>
        <kong-action current="$ctrl.section"></kong-action>
    </div>

    <div class="kong-container" ng-class="{'kong-container--fullwidth': $ctrl.section.attrs.fullwidth}">
        <kong-row-list section="$ctrl.section"></kong-row-list>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lfb_section', 'lfb_section_callback');
function lfb_section_callback($attrs, $content = '') {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'half_bg' => '',
        'hidden' => '',
        'fullwidth' => 'false',
        'overlay' => 'false',
        'bg_style' => 'none',
        'bg_effect' => '',
        'content_align' => ''
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['half_bg']) {
        $classes[] = $attrs['half_bg'];
    }


    if ($attrs['bg_style'] != 'none' && $attrs['bg_style'] != 'color') {
        $classes[] = 'kong-section--bgStyle-' . $attrs['bg_style'];
    }

    if ($attrs['bg_effect'] != 'none') {
        $classes[] = 'kong-section--bgEffect-' . $attrs['bg_effect'];
    }

    if($attrs['content_align'] && $attrs['content_align'] != 'top'){
        $classes[] = 'kong-section--align-' . $attrs['content_align'];
    }

    $classes[] = $attrs['class_id'];

    $fullwidth = kong_to_boolean($attrs['fullwidth']) ? ' kong-container--fullwidth': '';

    ob_start(); ?>
    <div class="kong-section kong-footer__section <?php echo implode(' ', $classes); ?>">
        <?php if (kong_to_boolean($attrs['overlay'])) : ?>
            <div class="kong-section__overlay"></div>
        <?php endif; ?>

        <div class="kong-container<?php echo $fullwidth; ?>"><?php echo do_shortcode($content); ?></div>
    </div>
    <?php
    return ob_get_clean();
}