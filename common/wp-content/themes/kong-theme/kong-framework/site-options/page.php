<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("page", array(
    "icon" => "th-list",
    "name" => "Page",
    "side" => "frontend"
),5);

$manager::addChildPanel("page_layout", "page", array(
    "name" => "Spacing",
    "direct_links" => array(
        ".kong-page__sidebar > div" => array(
            "position" => array(
                "right" => "0px",
                "top" => "0px"
            ),
            "highlight" => "sidebar"
        ),
        ".kong-page__content > div" => [
            array(
                "position" => array(
                    "right" => "0px",
                    "top" => "0px"
                ),
                "highlight" => "content"
            ),
            array(
                "position" => array(
                    "right" => "0px",
                    "bottom" => "-10px"
                ),
                "highlight" => "content & sidebar"
            )
        ]
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Content & Sidebar",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_padding_bottom",
                    "attrs" => array(
                        "label" => "Padding Bottom",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => [
                                "px",
                                "%",
                                "em"
                            ]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100px"
                    ),
                    "responsive_styles" => array(
                        ".kong-page__content,.kong-page__sidebar" => array(
                            "paddingBottom" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_has_border",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "toggle-class",
                        "config" => array(
                            "class" => "kong-page--hasBorder",
                            "selector" => ".kong-page--hasSidebar"
                        )
                    ),
                    "default_value" => false
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
                    "bind_to" => "page_content_padding_top",
                    "attrs" => array(
                        "label" => "Padding Top",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => [
                                "px",
                                "%",
                                "em"
                            ]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "70px"
                    ),
                    "responsive_styles" => array(
                        ".kong-page__content" => array(
                            "paddingTop" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_content_padding",
                    "attrs" => array(
                        "label" => "Edge Padding",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => 40,
                    "styles" => array(
                        ".kong-page__content--paddingRight" => array(
                            "paddingRight" => "{{@model}}px"
                        ),
                        ".kong-page__content--paddingLeft" => array(
                            "paddingLeft" => "{{@model}}px"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Sidebar",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_sidebar_padding_top",
                    "attrs" => array(
                        "label" => "Padding Top",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => [
                                "px",
                                "%",
                                "em"
                            ]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "70px",
                        "tablet" => "0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-page__sidebar" => array(
                            "paddingTop" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_sidebar_width",
                    "attrs" => array(
                        "label" => "Single Sidebar Width",
                        "type" => "unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => [
                                "px",
                                "%",
                                "em"
                            ]
                        )
                    ),
                    "default_value" => "25%",
                    "styles" => array(
                        ".kong-page--singleSidebar .kong-page__sidebar" => array(
                            "width" => "{{@model}}"
                        ),
                        ".kong-page--singleSidebar .kong-page__content" => array(
                            "width" => "calc(100% - {{@model}})"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_sidebar_padding",
                    "attrs" => array(
                        "label" => "Edge Padding",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        ".kong-page__sidebar--paddingRight" => array(
                            "paddingRight" => "{{@model}}px"
                        ),
                        ".kong-page__sidebar--paddingLeft" => array(
                            "paddingLeft" => "{{@model}}px"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("page_hero_section", "page", array(
    "name" => "Hero Section",
    "direct_links" => array(
        ".kong-page__hero" => array(
            "position" => array(
                "right" => "10px",
                "top" => "10px"
            ),
            "highlight" => "size & padding"
        ),
        ".kong-page__hero__title" => array(
            "position" => array(
                "right" => "0px",
                "top" => "0px"
            ),
            "highlight" => "title"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Size & Padding",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_hero_height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => [
                                "px",
                                "em",
                                "vh"
                            ]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "440px",
                        "mobile" => "300px"
                    ),
                    "responsive_styles" => array(
                        ".kong-page__hero" => array(
                            "height" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_hero_padding_top",
                    "attrs" => array(
                        "label" => "Padding Top",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            )
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-page__hero" => array(
                            "paddingTop" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_hero_align",
                    "attrs" => array(
                        "label" => "Alignment",
                        "type" => "res-align"
                    ),
                    "default_value" => array(
                        "desktop" => "center"
                    ),
                    "responsive_styles" => array(
                        ".kong-page__hero__content" => array(
                            "textAlign" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Parallax & Overlay",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_hero_parallax",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Parallax",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_hero_overlay",
                    "attrs" => array(
                        "label" => "Gradient",
                        "type" => "gradient",
                        "config" => array(
                            "radial" => true
                        )
                    ),
                    "default_value" => array(
                        "color_1" => "rgba(0,0,0,0.5)",
                        "color_2" => "rgba(0,0,0,0.5)",
                        "color_3" => "",
                        "angle" => 180,
                        "value" => "linear-gradient(180deg, rgba(0,0,0,0.5), rgba(0,0,0,0.5), rgba(0,0,0,0.5))"
                    ),
                    "styles" => array(
                        ".kong-hero__overlay" => array(
                            "background" => "{{@model.value}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Title",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_hero_title_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 90,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 60,
                        "mobile" => 32
                    ),
                    "responsive_styles" => array(
                        ".kong-page__hero__title" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_hero_title_color",
                    "attrs" => array(
                        "label" => "Overlay",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        ".kong-page__hero__title" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_hero_title_letter_spacing",
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
                        ".kong-page__hero__title" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_hero_title_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        ".kong-page__hero__title" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "page_hero_title_font_weight",
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
                        ".kong-page__hero__title" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("page_breadcrumb", "page", array(
    "name" => "Breadcrumb",
    "direct_links" => array(
        ".kong-breadcrumb" => array(
            "position" => array(
                "left" => "10px",
                "top" => "10px"
            ),
            "highlight" => "style & spacing"
        ),
        ".kong-breadcrumb__title" => array(
            "position" => array(
                "top" => "0px",
                "right" => "0px"
            ),
            "highlight" => "title"
        ),
        ".kong-breadcrumb__link li:last-child" => array(
            "position" => array(
                "bottom" => "0px",
                "right" => "0px"
            ),
            "highlight" => "breadcrumbs"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style & Spacing",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_bg",
                    "attrs" => array(
                        "label" => "Background Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body"],
                    "styles" => array(
                        ".kong-breadcrumb" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_border_color",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        ".kong-breadcrumb" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_padding_top",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "15px 0px 15px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-breadcrumb" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Title",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_title_font_size",
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
                        "desktop" => 16
                    ),
                    "responsive_styles" => array(
                        ".kong-breadcrumb__title" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_title_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        ".kong-breadcrumb__title" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_title_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        ".kong-breadcrumb__title" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.1,
                            "max" => 0.5,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.05,
                    "styles" => array(
                        ".kong-breadcrumb__title" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_font_weight",
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
                        ".kong-breadcrumb__title" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Breadcrumbs",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_link_color",
                    "attrs" => array(
                        "label" => "Link",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        ".kong-breadcrumb__link a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_link_hover_color",
                    "attrs" => array(
                        "label" => "Link Hover",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        ".kong-breadcrumb__link a:hover" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bc_current_color",
                    "attrs" => array(
                        "label" => "Current",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        ".kong-breadcrumb__link" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

?>