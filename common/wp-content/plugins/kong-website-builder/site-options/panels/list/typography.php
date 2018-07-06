<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("typography", array(
    "icon" => "font",
    "name" => "Typography"
),2);

$manager::addChildPanel("body_typography", "typography", array(
    "name" => "Body",
    "side" => "frontend",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "body_font_size",
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
                        "body,select,input,textarea" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "body_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "body,select" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "body_letter_spacing",
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
                        "body,select,input,textarea" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "body_line_height",
                    "attrs" => array(
                        "label" => "Line Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0.5,
                            "max" => 10,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => 1.3,
                    "styles" => array(
                        "body" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "body_font",
                    "attrs" => array(
                        "label" => "Font Source",
                        "type" => "general-font"
                    ),
                    "default_value" => array(
                        "source" => "google",
                        "google" => array(
                            "family" => "Poppins",
                            "variants" => ["regular","italic","600","700"],
                            "subsets" => ["latin"]
                        ),
                        "uploaded" => "",
                        "typekit" => ""
                    ),
                    "directives" => [
                        array(
                            "tag" => "preview-general-font-embed",
                            "attrs" => array(
                                "selector" => "body"
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "body_font_weight",
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
                        "body,select,input,textarea" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "body_medium_bold",
                    "attrs" => array(
                        "label" => "Medium Bold Text",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 500,
                    "styles" => array(
                        ".kong--mBold,[type='submit'],dt,th" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "body_bold",
                    "attrs" => array(
                        "label" => "Bold Text",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 600,
                    "styles" => array(
                        ".kong--bold,strong,b" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "body_extra_bold",
                    "attrs" => array(
                        "label" => "Black Bold Text",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 700,
                    "styles" => array(
                        ".kong--eBold" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("general_heading", "typography", array(
    "name" => "General Heading",
    "side" => "frontend",
    "direct_links" => array(
        ".kong-h" => array(
            "position" => array(
                "top" => "0px",
                "left" => "0px"
            )
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "heading_font",
                    "attrs" => array(
                        "label" => "Font",
                        "type" => "general-font",
                        "config" => array(
                            "has_inherit" => true
                        )
                    ),
                    "default_value" => array(
                        "source" => "inherit",
                        "google" => array(
                            "family" => "Poppins",
                            "variants" => ["regular","italic","600","700"],
                            "subsets" => ["latin"]
                        ),
                        "uploaded" => "",
                        "typekit" => ""
                    ),
                    "directives" => [
                        array(
                            "tag" => "preview-general-font-embed",
                            "attrs" => array(
                                "selector" => "h1,h2,h3,h4,h5,h6,.kong-h"
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "heading_line_height",
                    "attrs" => array(
                        "label" => "Line Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0.5,
                            "max" => 3,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => 1.3,
                    "styles" => array(
                        "h1,h2,h3,h4,h5,h6,.kong-h" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "heading_letter_spacing",
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
                        "h1,h2,h3,h4,h5,h6,.kong-h" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "heading_font_weight",
                    "attrs" => array(
                        "label" => "Font Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 600,
                    "styles" => array(
                        "h1,h2,h3,h4,h5,h6,.kong-h" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("paragraph", "typography", array(
    "name" => "Paragraph",
    "side" => "frontend",
    "direct_links" => array(
        ".kong-entry p" => array(
            "position" => array(
                "left" => "0px",
                "top" => "0px"
            )
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "p_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 14
                    ),
                    "responsive_styles" => array(
                        "p" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "p_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "p" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "p_margin",
                    "attrs" => array(
                        "label" => "Margin Bottom",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 0px 15px 0px"
                    ),
                    "responsive_styles" => array(
                        "p" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "p_line_height",
                    "attrs" => array(
                        "label" => "Line Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0.5,
                            "max" => 3,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => 1.5,
                    "styles" => array(
                        "p" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "p_letter_spacing",
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
                        "p" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "p_font_weight",
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
                        "p" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "p_font",
                    "attrs" => array(
                        "label" => "Font",
                        "type" => "font-source"
                    ),
                    "default_value" => array(
                        "source" => "inherit",
                        "google" => array(
                            "family" => "Poppins",
                            "variant" => "regular",
                            "subset" => "latin"
                        ),
                        "uploaded" => 0
                    ),
                    "directives" => [
                        array(
                            "tag" => "preview-typography-font-embed",
                            "attrs" => array(
                                "selector" => "p"
                            )
                        )
                    ]
                )
            ]
        )
    ]
));

$manager::addChildPanel("serif_font", "typography", array(
    "name" => "Serif Font",
    "side" => "frontend",
    "direct_links" => array(
        ".kong-serif" => array(
            "position" => array(
                "top" => "0px",
                "left" => "0px"
            ),
            "highlight" => "serif font"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "serif_font",
                    "attrs" => array(
                        "label" => "Font",
                        "type" => "general-font",
                        "config" => array(
                            "has_inherit" => true
                        )
                    ),
                    "default_value" => array(
                        "source" => "google",
                        "google" => array(
                            "family" => "PT Serif",
                            "variants" => ["italic"],
                            "subsets" => ["latin"]
                        ),
                        "uploaded" => "",
                        "typekit" => ""
                    ),
                    "directives" => [
                        array(
                            "tag" => "preview-general-font-embed",
                            "attrs" => array(
                                "selector" => ".kong-serif, .kong-pSerif p, .kong-iSerif i:not([class]), .kong-hSerif h1, .kong-hSerif h2, .kong-hSerif h3, .kong-hSerif h4, .kong-hSerif h5, .kong-hSerif h6"
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "serif_font_weight",
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
                        ".kong-serif" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "serif_letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.1,
                            "max" => 0.5,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => -0.01,
                    "styles" => array(
                        ".kong-serif" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                )
            ]
        )
    ]
));

$headings = [
    array(
        "type" => "1",
        "font_size" => 40,
        "letter_spacing" => 0,
        "font_weight" => 700,
        "text_transform" => "",
        "margin" => "35px 0px 20px 0px"
    ),
    array(
        "type" => "2",
        "font_size" => 32,
        "letter_spacing" => 0,
        "font_weight" => 700,
        "text_transform" => "",
        "margin" => "35px 0px 20px 0px"
    ),
    array(
        "type" => "3",
        "font_size" => 24,
        "letter_spacing" => 0,
        "font_weight" => 700,
        "text_transform" => "",
        "margin" => "30px 0px 20px 0px"
    ),
    array(
        "type" => "4",
        "font_size" => 16,
        "letter_spacing" => 0.05,
        "font_weight" => 700,
        "text_transform" => "uppercase",
        "margin" => "30px 0px 20px 0px"
    ),
    array(
        "type" => "5",
        "font_size" => 13,
        "letter_spacing" => 0.05,
        "font_weight" => 700,
        "text_transform" => "uppercase",
        "margin" => "25px 0px 15px 0px"
    ),
    array(
        "type" => "6",
        "font_size" => 12,
        "font_weight" => 700,
        "letter_spacing" => 0.1,
        "text_transform" => "uppercase",
        "margin" => "25px 0px 12px 0px"
    )
];

foreach($headings as $heading){
    $type = $heading["type"];
    $selector = '.kong-entry h'.$type.':not([class]),.kong-h'.$type;
    $manager::addChildPanel("heading{$type}", "typography", array(
        "name" => "Entry Heading ".$type,
        "side" => "frontend",
        "direct_links" => array(
            $selector => array(
                "position" => array(
                    "left" => "0px",
                    "top" => "0px"
                )
            )
        ),
        "models" => [
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Style",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "h{$type}_font_size",
                        "attrs" => array(
                            "label" => "Font Size",
                            "type" => "res-slider",
                            "config" => array(
                                "min" => 10,
                                "max" => 100,
                                "step" => 1
                            )
                        ),
                        "default_value" => array(
                            "desktop" => $heading['font_size']
                        ),
                        "responsive_styles" => array(
                            $selector => array(
                                "fontSize" => "{{@model}}px"
                            )
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "h{$type}_color",
                        "attrs" => array(
                            "label" => "Color",
                            "type" => "colorpicker"
                        ),
                        "default_value" => $manager::$colors["heading"],
                        "styles" => array(
                            $selector => array(
                                "color" => "{{@model}}"
                            )
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "h{$type}_margin",
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
                            "desktop" => $heading['margin']
                        ),
                        "responsive_styles" => array(
                            $selector => array(
                                "margin" => "{{@model}}"
                            )
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "h{$type}_line_height",
                        "attrs" => array(
                            "label" => "Line Height",
                            "type" => "slider",
                            "config" => array(
                                "min" => 0.5,
                                "max" => 3,
                                "step" => 0.1
                            )
                        ),
                        "default_value" => 1.3,
                        "styles" => array(
                            $selector => array(
                                "lineHeight" => "{{@model}}em"
                            )
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "h{$type}_letter_spacing",
                        "attrs" => array(
                            "label" => "Letter Spacing",
                            "type" => "slider",
                            "config" => array(
                                "min" => -0.1,
                                "max" => 0.5,
                                "step" => 0.01
                            )
                        ),
                        "default_value" => $heading['letter_spacing'],
                        "styles" => array(
                            $selector => array(
                                "letterSpacing" => "{{@model}}em"
                            )
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "h{$type}_font_weight",
                        "attrs" => array(
                            "label" => "Font Weight",
                            "type" => "slider",
                            "config" => array(
                                "min" => 100,
                                "max" => 900,
                                "step" => 100
                            )
                        ),
                        "default_value" => $heading['font_weight'],
                        "styles" => array(
                            $selector => array(
                                "fontWeight" => "{{@model}}"
                            )
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "h{$type}_text_transform",
                        "attrs" => array(
                            "label" => "Text Transform",
                            "type" => "text-transform"
                        ),
                        "default_value" => $heading['text_transform'],
                        "styles" => array(
                            $selector => array(
                                "textTransform" => "{{@model}}"
                            )
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "h{$type}_font",
                        "attrs" => array(
                            "label" => "Font",
                            "type" => "font-source"
                        ),
                        "default_value" => array(
                            "source" => "inherit",
                            "google" => array(
                                "family" => "Poppins",
                                "variant" => "regular",
                                "subset" => "latin"
                            ),
                            "uploaded" => 0
                        ),
                        "directives" => [
                            array(
                                "tag" => "preview-typography-font-embed",
                                "attrs" => array(
                                    "selector" => $selector
                                )
                            )
                        ]
                    )
                ]
            )
        ]
    ));
}


$manager::addChildPanel("uploaded_fonts", "typography", array(
    "name" => "Uploaded Fonts",
    "core" => true,
    "side" => "backend",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Font List",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "uploaded_fonts",
                    "attrs" => array(
                        "label" => "Uploaded Fonts",
                        "type" => "uploaded-fonts",
                        "desc" => "This Panel contains options for uploading and managing your own fonts in the case you do not want to use fonts from Google. <strong>Turn on the switch button on the right side</strong> of uploaded fonts to embed them in your site."
                    ),
                    "directives" => [
                        array(
                            "tag" => 'uploaded-fonts-embed'
                        )
                    ]
                )
            ]
        )
    ]
));

$manager::addChildPanel("typekit", "typography", array(
    "name" => "TYPEKIT",
    "side" => "backend",
    "core" => true,
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "TYPEKIT",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "typekit_fonts",
                    "attrs" => array(
                        "label" => "Kit Manager",
                        "type" => "typekit",
                        "desc" => "This Panel contains options for integrating TYPEKIT Fonts into the site. For the detailed guidance, please go through <a href='http://docs.kolumn.io/kong/v1/guide/theme-options/typekit.html' target='_blank'>the Instruction</a>."
                    )
                )
            ]
        )
    ]
));
?>