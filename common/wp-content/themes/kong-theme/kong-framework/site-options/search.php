<?php

$manager = KongOptionsManager::getInstance();

$manager::addPanel("search_page",array(
    "side" => "frontend",
    "name" => "Search Page",
    "direct_links" => array(
        ".kong-search__header" => array(
            "position" => array(
                "bottom" => "30px",
                "right" => "40px"
            ),
            "highlight" => "header"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Header",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "search_header_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 300,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "150px 0px 150px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-search__header" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "search_header_bg",
                    "attrs" => array(
                        "label" => "Image",
                        "type" => "upload-image",
                        "config" => array(
                            "contain" => false,
                            "full" => true
                        )
                    ),
                    "default_value" => array(
                        "url" => ""
                    ),
                    "styles" => array(
                        ".kong-search__bg__image" => array(
                            "backgroundImage" => "url({{@model.url}})"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "bg_props",
                    "if" => "@options.search_header_bg.url",
                    "attrs" => array(
                        "type" => "background-props",
                        "fullwidth" => "true"
                    ),
                    "default_value" => array(
                        "repeat" => "no-repeat",
                        "position" => "50% 50%",
                        "size" => "cover",
                        "attachment" => "scroll"
                    ),
                    "styles" => array(
                        ".kong-search__bg *" => array(
                            "backgroundRepeat" => "{{@model.repeat}}",
                            "backgroundPosition" => "{{@model.position}}",
                            "backgroundSize" => "{{@model.size}}",
                            "backgroundAttachment" => "{{@model.attachment}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "search_header_overlay",
                    "attrs" => array(
                        "label" => "Gradient",
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
                        ".kong-search__overlay" => array(
                            "background" => "{{@model.value}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Layout",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "search_max_width",
                    "attrs" => array(
                        "label" => "Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1600,
                                "step" => 1
                            ),
                            "units" => ["px","%","vw"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "700px"
                    ),
                    "responsive_styles" => array(
                        ".kong-search__container" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "search_thumb_color",
                    "attrs" => array(
                        "label" => "Thumb Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body_diff"],
                    "styles" => array(
                        ".kong-search__thumb" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));