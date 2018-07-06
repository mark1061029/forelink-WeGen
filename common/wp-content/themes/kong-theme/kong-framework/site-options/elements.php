<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("elements", array(
    "icon" => "paint-brush",
    "name" => "Elements",
    "side" => "frontend"
),4);

$manager::addChildPanel("form_style", "elements", array(
    "name" => "Form",
    "direct_links" => array(
        ".comment-form-comment, form" => array(
            "position" => array(
                "top" => 0,
                "right" => 0
            ),
            "highlight" => "Field"
        ),
        "[type='submit']:not(.submit)" => array(
            "position" => array(
                "bottom" => 0,
                "left" => 0
            ),
            "highlight" => "submit button"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Field",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "form_bg_color",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body"],
                    "styles" => array(
                        "[type='text'],[type='search'],[type='password'],[type='email'],[type='number'],textarea" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "form_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "[type='text'],[type='search'],[type='password'],[type='email'],[type='number'],textarea" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "form_border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "[type='text'],[type='search'],[type='password'],[type='email'],[type='number'],textarea" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Focused Field",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "form_focus_bg_color",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body"],
                    "styles" => array(
                        "[type='text']:focus,[type='search']:focus,[type='password']:focus,[type='email']:focus,[type='number']:focus,textarea:focus" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "form_focus_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "[type='text']:focus,[type='search']:focus,[type='password']:focus,[type='email']:focus,[type='number']:focus,textarea:focus" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "form_focus_border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "[type='text']:focus,[type='search']:focus,[type='password']:focus,[type='email']:focus,[type='number']:focus,textarea:focus" => array(
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
                    "bind_to" => "submit_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "input[type='submit']" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "submit_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "input[type='submit']" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "submit_border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        "input[type='submit']" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ])
);

$manager::addChildPanel("blockquote_style", "elements", array(
    "name" => "Blockquote & Cite",
    "direct_links" => array(
        "blockquote:not([class])" => array(
            "position" => array(
                "top" => 0,
                "left" => 0
            ),
            "highlight" => "blockquote"
        ),
        "cite:not([class])" => array(
            "position" => array(
                "top" => 0,
                "left" => 0
            ),
            "highlight" => "cite"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Blockquote",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bq_content_color",
                    "attrs" => array(
                        "label" => "Content",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "blockquote:not([class]),.kong-entry blockquote p" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bq_border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "blockquote:not([class])" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bq_margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "20px 0px 20px 0px"
                    ),
                    "responsive_styles" => array(
                        "blockquote:not([class])" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bq_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "0px 0px 0px 25px",
                    "styles" => array(
                        "blockquote:not([class])" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bq_font_size",
                    "attrs" => array(
                        "label" => "Content Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 12,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 20
                    ),
                    "responsive_styles" => array(
                        "blockquote:not([class]),.kong-entry blockquote:not([class]) p" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bq_line_height",
                    "attrs" => array(
                        "label" => "Line Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0.5,
                            "max" => 3,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => 1.4,
                    "styles" => array(
                        "blockquote:not([class]),.kong-entry blockquote:not([class]) p" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bq_font_source",
                    "attrs" => array(
                        "label" => "Font Source",
                        "type" => "font-source",
                        "config" => array(
                            "Inherit from Parent" => "inherit",
                            "Google Fonts" => "google",
                            "Uploaded Fonts" => "uploaded"
                        )
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
                            "tag" => "preview-typography-font-embed",
                            "attrs" => array(
                                "selector" => "blockquote:not([class]),.kong-entry blockquote:not([class]) p"
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Cite",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "cite_font_size",
                    "attrs" => array(
                        "label" => "Cite Font Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 60,
                            "max" => 120,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 100
                    ),
                    "styles" => array(
                        "cite" => array(
                            "fontSize" => "{{@model}}%"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "cite_margin",
                    "attrs" => array(
                        "label" => "Cite Margin",
                        "type" => "area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "15px 0px 3px 0",
                    "styles" => array(
                        "cite" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bq_cite_color",
                    "attrs" => array(
                        "label" => "Cite",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        "cite" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("code_style", "elements", array(
    "name" => "Code & Pre",
    "direct_links" => array(
        "code" => array(
            "position" => array(
                "top" => 0,
                "left" => 0
            ),
            "highlight" => "code"
        ),
        "tt" => array(
            "position" => array(
                "top" => 0,
                "left" => 0
            ),
            "highlight" => "code"
        ),
        "pre" => array(
            "position" => array(
                "top" => 0,
                "left" => 0
            ),
            "highlight" => "pre"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Common",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "code_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 60,
                            "max" => 120,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 100
                    ),
                    "styles" => array(
                        "pre,code,tt,kbd" => array(
                            "fontSize" => "{{@model}}%"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "code_border_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => 3,
                    "styles" => array(
                        "pre,code,tt,kbd" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Pre",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pre_margin",
                    "attrs" => array(
                        "label" => "Pre Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "20px 0px 20px 0px"
                    ),
                    "responsive_styles" => array(
                        "pre" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pre_padding",
                    "attrs" => array(
                        "label" => "Pre Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "15px 15px 15px 15px"
                    ),
                    "responsive_styles" => array(
                        "pre" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pre_bg_color",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["pre_bg"],
                    "styles" => array(
                        "pre,kbd" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pre_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["pre_color"],
                    "styles" => array(
                        "pre,kbd" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pre_border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["pre_border"],
                    "styles" => array(
                        "pre,kbd" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Code",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "code_bg_color",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["code_bg"],
                    "styles" => array(
                        "code,tt" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "code_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["code_color"],
                    "styles" => array(
                        "code,tt" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

?>