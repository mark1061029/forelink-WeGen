<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("builder_tools", array(
    "icon" => "columns",
    "name" => "Builder Tools",
    "side" => "frontend",
    "core" => true
), 0);

$manager::addChildPanel("width_and_space", "builder_tools", array(
    "name" => "Width & Space",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Container Width",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "container_max_width",
                    "attrs" => array(
                        "label" => "Container Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 2000,
                                "step" => 2
                            )
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "1200px",
                        "tablet" => "92%"
                    ),
                    "responsive_styles" => array(
                        ".kong-container, .kong-container__wrap" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "container_width_queries",
                    "attrs" => array(
                        "label" => "Max-width Queries",
                        "type" => "media-query-unit",
                        "desc" => "By default, there is only a setting to establish container max width for desktop, tablet and mobile screens. In the case you want to set up the width for different screen sizes, you can use this option"
                    ),
                    "default_value" => [
                        array(
                            "screen_width" => '1200',
                            "value" => "95%"
                        )
                    ],
                    "directives" => [
                        array(
                            "tag" => "preview-screen-queries",
                            "attrs" => array(
                                "selector" => ".kong-container, .kong-container__wrap",
                                "property" => "max-width"
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Column Space",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "column_padding",
                    "attrs" => array(
                        "label" => "Column Space",
                        "type" => "slider",
                        "config" => array(
                            "min" => 5,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => 15,
                    "styles" => array(
                        ".kong-container,.kong-container__column,.kong-column,.kong-page__column" => array(
                            "paddingLeft" => "{{@model}}px",
                            "paddingRight" => "{{@model}}px"
                        ),
                        ".kong-row" => array(
                            "marginRight" => "-{{@model}}px",
                            "marginLeft" => "-{{@model}}px"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("widgets_default_colors", "builder_tools",  array(
    "name" => "Widget Default Colors",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Default Colors",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_primary_color",
                    "attrs" => array(
                        "label" => "Primary",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_primary_context_color",
                    "attrs" => array(
                        "label" => "Primary Context",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_heading_color",
                    "attrs" => array(
                        "label" => "Heading",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_desc_color",
                    "attrs" => array(
                        "label" => "Description",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_text_color",
                    "attrs" => array(
                        "label" => "Text",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "widget_border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"]
                )
            ]
        )
    ])
);

$manager::addChildPanel("widget_configuration", "builder_tools", array(
    "name" => "Widget Configuration",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Background Parallax",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "parallax_bg_delta",
                    "attrs" => array(
                        "label" => "Delta",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0.5,
                            "max" => 5,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => 3,
                    "styles" => array(
                        ".kong-section__bg--parallax .kong-section__bg__image" => array(
                            "top" => "-{{@model*200/3}}px",
                            "height"=> "calc(100% + {{@model*400/3}}px)"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Popup Color",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "popup_backdrop_color",
                    "attrs" => array(
                        "label" => "Backdrop",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#000000",
                    "styles" => array(
                        ".kong-videoPopup,.pswp__bg" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "popup_color",
                    "attrs" => array(
                        "label" => "Icon & Text",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        ".kong-videoPopup__loading" => array(
                            "borderLeftColor" => "{{@model}}",
                            "borderTopColor" => "{{@model}}"
                        ),
                        ".kong-videoPopup__close:before,.kong-videoPopup__close:after,.pswp__button--close:after,.pswp__button--close:before" => array(
                            "backgroundColor" => "{{@model}}"
                        ),
                        ".pswp__button--arrow--left,.pswp__button--arrow--right,.pswp__counter" => array(
                            "color" => "{{@model}}"
                        ),
                    )
                )
            ]
        )
    ]
));

?>