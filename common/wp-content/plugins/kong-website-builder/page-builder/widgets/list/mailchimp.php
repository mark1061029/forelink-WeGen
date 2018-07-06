<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Mailchimp",
    "tag" => "mailchimp",
    "keywords" => ["mailchimp","subscribe"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Embeded HTML",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@content",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "code-editor",
                        "config" => array(
                            "mode" => "html"
                        ),
                        "desc" => "Paste the embedded HTML from your Mailchimp list. Then remove the default style tag and css link to ensure the style to display properly."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.style",
                    "attrs" => array(
                        "label" => "Type",
                        "type" => "selection",
                        "config" => array(
                            "classic" => "Classic",
                            "slim" => "Super Slim",
                            "hoz" => "Horizontal"
                        )
                    ),
                    "default_value" => "classic"
                ),
                array(
                    "tag" => "editor-field",
                    "show" => "@attrs.style == 'hoz'",
                    "bind_to" => "@attrs.slim_on_mobile",
                    "attrs" => array(
                        "label" => "Slim on Mobile",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => ["px","%","vw"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id > div > form" => array(
                            "width" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "if" => "@attrs.style == 'classic'",
            "attrs" => array(
                "label" => "Basic Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.require_color",
                    "attrs" => array(
                        "label" => "Require Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .asterisk" => array(
                            "color" => "{{@model}}"
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
                        "@id label" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.error_color",
                    "attrs" => array(
                        "label" => "Error Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#E04006",
                    "styles" => array(
                        "@id #mc_embed_signup input.mce_inline_error" => array(
                            "borderColor" => "{{@model}}"
                        ),
                        "@id #mc_embed_signup .mce_inline_error" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Input",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_width",
                    "attrs" => array(
                        "label" => "Min Width",
                        "type" => "res-unit"
                    ),
                    "default_value" => array(
                        "desktop" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id input:not([type='submit'])" => array(
                            "minWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "10px 15px 10px 15px"
                    ),
                    "responsive_styles" => array(
                        "@id input:not([type='submit'])" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "5px 0px 15px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id input:not([type='submit'])" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 14
                    ),
                    "responsive_styles" => array(
                        "@id,@id input:not([type='submit'])" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "1px 1px 1px 1px",
                    "styles" => array(
                        "@id input:not([type='submit'])" => array(
                            "borderWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 3,
                    "styles" => array(
                        "@id input:not([type='submit'])" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id input:not([type='submit'])" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body"],
                    "styles" => array(
                        "@id input:not([type='submit'])" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id input:not([type='submit'])" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_focus_color",
                    "attrs" => array(
                        "label" => "Focus Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id input:not([type='submit']):focus" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_focus_bg",
                    "attrs" => array(
                        "label" => "Focus Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body_diff"],
                    "styles" => array(
                        "@id input:not([type='submit']):focus" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.input_focus_border_color",
                    "attrs" => array(
                        "label" => "Focus Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id input:not([type='submit']):focus" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Submit Button",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.submit_width",
                    "attrs" => array(
                        "label" => "Min Width",
                        "type" => "res-unit"
                    ),
                    "default_value" => array(
                        "desktop" => "0px"
                    ),
                    "responsive_styles" => array(
                        "@id input[type='submit']" => array(
                            "minWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_align",
                    "attrs" => array(
                        "label" => "Align",
                        "type" => "res-align"
                    ),
                    "default_value" => array(
                        "desktop" => ""
                    ),
                    "responsive_styles" => array(
                        "@id .clear" => array(
                            "textAlign" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_margin",
                    "attrs" => array(
                        "label" => "Margin Top",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 15,
                    "styles" => array(
                        "@id .clear" => array(
                            "marginTop" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "10px 15px 10px 15px"
                    ),
                    "responsive_styles" => array(
                        "@id input[type='submit']" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 14
                    ),
                    "responsive_styles" => array(
                        "@id input[type='submit']" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_weight",
                    "attrs" => array(
                        "label" => "Font Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 400,
                    "styles" => array(
                        "@id input[type='submit']" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.1,
                            "max" => 0.5,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id input[type='submit']" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id input[type='submit']" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "0px 0px 0px 0px",
                    "styles" => array(
                        "@id input[type='submit']" => array(
                            "borderWidth" => "{{@model}}"
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
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 3,
                    "styles" => array(
                        "@id input[type='submit']" => array(
                            "borderRadius" => "{{@model}}px"
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
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id input[type='submit']" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id input[type='submit']" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "show" => "@attrs.border_width != '0px 0px 0px 0px'",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id input[type='submit']" => array(
                            "borderColor" => "{{@model}}"
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
                        "@id input[type='submit']" => array(
                            "boxShadow" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hover_color",
                    "attrs" => array(
                        "label" => "Hover Text",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id input[type='submit']:hover,@id input[type='submit']:focus" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hover_bg_color",
                    "attrs" => array(
                        "label" => "Hover Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id input[type='submit']:hover,@id input[type='submit']:focus" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hover_border_color",
                    "show" => "@attrs.border_width != '0px 0px 0px 0px'",
                    "attrs" => array(
                        "label" => "Hover Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id input[type='submit']:hover,@id input[type='submit']:focus" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Custom CSS",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.css",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "code-editor",
                        "config" => array(
                            "mode" => "css"
                        )
                    ),
                    "default_value" => ""
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
<div class="kong-dnd__emptyItem" style="height:60px;" ng-if="!$ctrl.model.content">
    <span class="kong-dnd__emptyItem__label">Mailchimp</span>
</div>

<div class="kong-mailchimp {{::$ctrl.getID()}}" ng-class="['kong-mailchimp--' + $ctrl.edited.attrs.style, {'kong-mailchimp--slimOnMobile': ($ctrl.edited.attrs.style == 'hoz' && $ctrl.edited.attrs.slim_on_mobile)} ,$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]" id="{{$ctrl.edited.attrs.id}}" ng-bind-html="$ctrl.model.content | trustashtml"></div>
<style type="text/css" ng-bind="$ctrl.edited.attrs.css"></style>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_mailchimp', 'kong_mailchimp_callback');
function kong_mailchimp_callback($attrs, $content) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'style' => 'classic',
        'css' => '',
        'slim_on_mobile' => 'false',
        'hidden' => ''
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }
    $classes[] = 'kong-mailchimp--'.$attrs['style'];
    if($attrs['style'] == 'hoz' && kong_to_boolean($attrs['slim_on_mobile'])){
        $classes[] = 'kong-mailchimp--slimOnMobile';
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <?php if($attrs['css']):?>
        <style type="text/css"><?php echo html_entity_decode($attrs['css']); ?></style>
    <?php endif; ?>
    <div class="kong-mailchimp <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <?php echo $content; ?>
    </div>
    <?php
    return ob_get_clean();
}