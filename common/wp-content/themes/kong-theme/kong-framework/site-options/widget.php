<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("widgets", array(
    "icon" => "font",
    "name" => "Widget",
    "side" => "frontend"
));

$manager::addChildPanel("widget_general_style", "widgets", array(
    "name" => "General Style",
    "direct_links" => array(
        ".kong-widget ul li" => array(
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
                "label" => "General",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_margin_bottom",
                    "attrs" => array(
                        "label" => "Margin Bottom",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 45
                    ),
                    "responsive_styles" => array(
                        ".kong-widget" => array(
                            "marginBottom" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "kong_fw_widget_cat_a_color",
                    "attrs" => array(
                        "label" => "Cat Link",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        ".kong-widget:not(.widget_kong_fw_block_widget) a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "kong_fw_widget_title_a_color",
                    "attrs" => array(
                        "label" => "Title Link",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        ".kong-widget:not(.widget_kong_fw_block_widget) .kong-widget__media__link" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "kong_fw_widget_a_hover",
                    "attrs" => array(
                        "label" => "Link Hover",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        ".kong-widget:not(.widget_kong_fw_block_widget) a:hover,.kong-widget__twitter__content a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Sidebar Right",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "right_widget_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 0px 0px 25px"
                    ),
                    "responsive_styles" => array(
                        ".kong-page--sidebarRight .kong-widget,.kong-page--sidebarRightRight .kong-widget,.kong-page--sidebarLeftRight .kong-page__sidebar--second .kong-widget" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "right_widget_border",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 0px 0px 1px"
                    ),
                    "responsive_styles" => array(
                        ".kong-page--sidebarRight .kong-widget,.kong-page--sidebarRightRight .kong-widget,.kong-page--sidebarLeftRight .kong-page__sidebar--second .kong-widget" => array(
                            "borderWidth" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Sidebar Left",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "left_widget_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 25px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-page--sidebarLeft .kong-widget,.kong-page--sidebarLeftLeft .kong-widget,.kong-page--sidebarLeftRight .kong-page__sidebar--first .kong-widget" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "left_widget_border",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 1px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-page--sidebarLeft .kong-widget,.kong-page--sidebarLeftLeft .kong-widget,.kong-page--sidebarLeftRight .kong-page__sidebar--first .kong-widget" => array(
                            "borderWidth" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("widget_title", "widgets", array(
    "name" => "Widget Title",
    "direct_links" => array(
        ".kong-widget__title" => array(
            "position" => array(
                "left" => "0px",
                "top" => "-10px"
            )
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Widget Title",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_title_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 70,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 12
                    ),
                    "responsive_styles" => array(
                        ".kong-widget__title" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_title_line_height",
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
                        ".kong-widget__title" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_title_letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.1,
                            "max" => 0.5,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.1,
                    "styles" => array(
                        ".kong-widget__title" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_title_font_weight",
                    "attrs" => array(
                        "label" => "Font Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 700,
                    "styles" => array(
                        ".kong-widget__title" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_title_text_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        ".kong-widget__title" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_title_margin_bottom",
                    "attrs" => array(
                        "label" => "Title Margin Bottom",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 5
                    ),
                    "responsive_styles" => array(
                        ".kong-widget__title" => array(
                            "marginBottom" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_title_separator",
                    "attrs" => array(
                        "label" => "Separator Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        ".kong-widget__title:after" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("list_widget_style", "widgets", array(
    "name" => "Tag Cloud",
    "direct_links" => array(
        ".tagcloud a" => array(
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
                "label" => "Color",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_tag_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        ".kong-widget .tagcloud a" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_tag_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        ".kong-widget .tagcloud a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_tag_border",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ededed",
                    "styles" => array(
                        ".kong-widget .tagcloud a" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hover Color",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_tag_bg_hover",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#f7f7f7",
                    "styles" => array(
                        ".kong-widget .tagcloud a:hover" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_tag_color_hover",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        ".kong-widget .tagcloud a:hover" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_tag_border_hover",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#f0f0f0",
                    "styles" => array(
                        ".kong-widget .tagcloud a:hover" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("widget_media_stream", "widgets", array(
    "name" => "Photo Stream",
    "direct_links" => array(
        ".kong-widget__mediaStream" => array(
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
                "label" => "Size & Spacing",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_media_stream_column",
                    "attrs" => array(
                        "label" => "Number of Columns",
                        "type" => "res-text-buttons",
                        "config" => array(
                            "options" => array(
                                "3" => "3",
                                "4" => "4",
                                "5" => "5",
                                "6" => "6",
                                "7" => "7",
                                "8" => "8"
                            ),
                            "class" => "column"
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "4",
                        "tablet" => "8",
                        "mobile" => "4"
                    ),
                    "responsive_styles" => array(
                        ".kong-widget__mediaStream__item" => array(
                            "width" => "calc((100% - 1px)/{{@model}})"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_media_stream_margin",
                    "attrs" => array(
                        "label" => "Spacing",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 5
                    ),
                    "responsive_styles" => array(
                        ".kong-widget__mediaStream__item" => array(
                            "padding" => "0 {{@model}}px {{@model}}px 0"
                        )
                    )
                )
            ]
        )
    ]
));

?>