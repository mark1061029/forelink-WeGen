<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("loader", array(
    "name" => "Loader",
    "side" => "frontend"
));

$manager::addChildPanel("load_more_button", "loader", array(
    "name" => "Load More Button",
    "direct_links" => array(
        ".kong-loadMoreBtn__wrap" => array(
            "position" => array(
                "left" => "20px",
                "top" => "3px"
            ),
            "highlight" => "box"
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
                    "bind_to" => "loadmore_margin",
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
                        "desktop" => "60px 0px 0px 0px",
                        "tablet" => "50px 0px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-loadMoreBtn__wrap" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "loadmore_color",
                    "attrs" => array(
                        "label" => "Text",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        ".kong-loadMoreBtn" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "loadmore_primary_color",
                    "attrs" => array(
                        "label" => "Text Hover",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        ".kong-loadMoreBtn--loading,.kong-loadMoreBtn:hover" => array(
                            "color" => "{{@model}}"
                        ),
                        ".kong-loadMoreBtn__icon" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "loadmore_border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "2px 2px 2px 2px",
                    "styles" => array(
                        ".kong-loadMoreBtn" => array(
                            "borderWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "if" => "@options.loadmore_border_width != '0px 0px 0px 0px'",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "loadmore_border_color",
                            "attrs" => array(
                                "label" => "Border",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["body_diff"],
                            "styles" => array(
                                ".kong-loadMoreBtn" => array(
                                    "borderColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "loadmore_border_color_active",
                            "attrs" => array(
                                "label" => "Border Active",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                ".kong-loadMoreBtn--loading,.kong-loadMoreBtn:hover" => array(
                                    "borderColor" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "loadmore_bg_color",
                    "attrs" => array(
                        "label" => "Background Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body_diff"],
                    "styles" => array(
                        ".kong-loadMoreBtn" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "loadmore_bg_color_active",
                    "attrs" => array(
                        "label" => "Background Color Active",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        ".kong-loadMoreBtn--loading,.kong-loadMoreBtn:hover" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "loadmore_position",
                    "attrs" => array(
                        "label" => "Position",
                        "type" => "res-icon-buttons",
                        "config" => array(
                            "options" => array(
                                "left" => "lmr lmr-align-left",
                                "center" => "lmr lmr-align-center-vertical",
                                "right" => "lmr lmr-align-right"
                            )
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "center"
                    ),
                    "responsive_styles" => array(
                        ".kong-loadMoreBtn__wrap" => array(
                            "textAlign" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("infinite_scroll", "loader", array(
    "name" => "Infinite Scroll",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Icon",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "if_scroll_icon_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        ".kong-infinitePreloader__icon" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "All Loaded Text",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "if_scroll_text_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        ".kong-infinitePreloader__text" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "if_scroll_text_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#000000",
                    "styles" => array(
                        ".kong-infinitePreloader__text" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("content_loader", "loader", array(
    "name" => "Media Loader",
    "side" => "frontend",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Settings",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "loader_method",
                    "attrs" => array(
                        "label" => "Loader Method",
                        "type" => "selection",
                        "config" => array(
                            "load" => "Load Immediately",
                            "scroll-to-load" => "Scroll to Load",
                            "scroll-to-reveal" => "Scroll to Reveal"
                        )
                    ),
                    "default_value" => "scroll-to-load"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "loader_color",
                    "attrs" => array(
                        "label" => "Loader Color",
                        "type" => "colorpicker",
                        "desc" => "Specify the background color of visual preloaders"
                    ),
                    "default_value" => "rgba(125,125,125,0.1)",
                    "styles" => array(
                        ".kong-contentLoader span:after,.kong-lazyImage:before,.kong-mediaLoader:before" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("loading_screen", "loader", array(
    "name" => "Loading Screen",
    "side" => "frontend",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Activation",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "loading_screen_enable",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Enable the switch to custom a loading background, which will be shown until the site is fully loaded"
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "if" => "@options.loading_screen_enable",
            "content" => [
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Style",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "loading_bg_color",
                            "attrs" => array(
                                "label" => "Background Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["body"],
                            "styles" => array(
                                ".kong-sitePreloader" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "loading_time_delay",
                            "attrs" => array(
                                "label" => "Delay (second)",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 10,
                                    "step" => 0.1
                                ),
                                "desc" => "Set the time delay between the fully-loaded moment and hiding the loading effect"
                            ),
                            "default_value" => 2
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "loading_icon_type",
                            "attrs" => array(
                                "label" => "Icon Type",
                                "type" => "text-buttons",
                                "config" => array(
                                    "options" => array(
                                        "img" => "Image",
                                        "html" => "HTML"
                                    )
                                ),
                                "desc" => "Select the type of loading icons, either an uploaded image or HTML content"
                            ),
                            "default_value" => "img"
                        ),
                        array(
                            "if" => "@options.loading_icon_type == 'img'",
                            "content" => [
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "loading_img",
                                    "attrs" => array(
                                        "label" => "Image",
                                        "type" => "upload-image",
                                        "config" => array(
                                            "contain" => true
                                        ),
                                        "desc" => "Upload an image to be used as the loading icon, a GIF image is the preference"
                                    ),
                                    "default_value" => array(
                                        "url" => ""
                                    ),
                                    "styles" => array(
                                        ".kong-sitePreloader__icon--img" => array(
                                            "backgroundImage" => "url({{@model.url}})"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "loading_img_size",
                                    "show" => "@options.loading_icon_type == 'img'",
                                    "attrs" => array(
                                        "label" => "Image Size",
                                        "type" => "unit",
                                        "config" => array(
                                            "setting" => array(
                                                "min" => 0,
                                                "max" => 1000,
                                                "step" => 2
                                            ),
                                            "units" => [
                                                "px",
                                                "%",
                                                "em"
                                            ]
                                        )
                                    ),
                                    "default_value" => "50px",
                                    "styles" => array(
                                        ".kong-sitePreloader__icon--img" => array(
                                            "width" => "{{@model}}",
                                            "height" => "{{@model}}"
                                        )
                                    )
                                )
                            ]
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "loading_html",
                            "show" => "@options.loading_icon_type == 'html'",
                            "attrs" => array(
                                "fullwidth" => "true",
                                "type" => "code-editor",
                                "config" => array(
                                    "options" => array(
                                        "mode" => "html"
                                    )
                                )
                            ),
                            "default_value" => ""
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Loading Class",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "loading_class",
                            "attrs" => array(
                                "label" => "CSS Class",
                                "type" => "text",
                                "desc" => "This CSS class will be added to body tag while the page loading its content. After the page fully loaded, this class will be removed. This is useful when you want to achieve custom effects for your site in the preloaded state."
                            ),
                            "default_value" => ""
                        )
                    ]
                )
            ]
        )
    ]
));

$manager::addChildPanel("pagination", "loader", array(
    "name" => "Pagination",
    "direct_links" => array(
        ".kong-blogPagination" => array(
            "position" => array(
                "left" => "0px",
                "top" => "0px"
            ),
            "highlight" => "Pagination Style"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Pagination Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pagination_margin_top",
                    "attrs" => array(
                        "label" => "Margin Top",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 30
                    ),
                    "responsive_styles" => array(
                        ".kong-blogPagination" => array(
                            "marginTop" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pagination_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body"],
                    "styles" => array(
                        ".kong-blogPagination__btn" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pagination_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        ".kong-blogPagination__btn, .kong-blogPagination__prev, .kong-blogPagination__next" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pagination_color_hover",
                    "attrs" => array(
                        "label" => "Hover Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        ".kong-blogPagination a:hover" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pagination_border_color",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        ".kong-blogPagination__btn" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pagination_border_color2",
                    "attrs" => array(
                        "label" => "Disabled Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        ".kong-blogPagination__link--current" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pagination_disabled_color",
                    "attrs" => array(
                        "label" => "Disabled Link",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        ".kong-blogPagination,.kong-blogPagination__link--disabled,.kong-blogPagination__link--current" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pagination_disabled_bg",
                    "attrs" => array(
                        "label" => "Disabled Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body_diff"],
                    "styles" => array(
                        ".kong-blogPagination__link--current" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "pagination_position",
                    "attrs" => array(
                        "label" => "Position",
                        "type" => "res-icon-buttons",
                        "config" => array(
                            "options" => array(
                                "left" => "lmr lmr-align-left",
                                "center" => "lmr lmr-align-center-vertical",
                                "right" => "lmr lmr-align-right"
                            )
                        )
                    ),
                    "default_value" => array(
                        "desktop" => ""
                    ),
                    "responsive_styles" => array(
                        ".kong-blogPagination" => array(
                            "textAlign" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

?>