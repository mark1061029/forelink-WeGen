<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("single_post", array(
    "icon" => "list-alt",
    "name" => "Single Post",
    "side" => "frontend"
),7);

$manager::addChildPanel("single_post_hero", "single_post", array(
    "name" => "Hero Section",
    "direct_links" => array(
        ".kong-singlePost__info" => array(
            "position" => array(
                "top" => 0,
                "left" => 0
            ),
            "highlight" => "short information"
        ),
        ".kong-singlePost__media" => array(
            "position" => array(
                "top" => 0,
                "left" => 0
            ),
            "highlight" => "media"
        ),
        ".kong-singlePost__title" => array(
            "position" => array(
                "top" => "2px",
                "left" => "2px"
            ),
            "wrap" => true,
            "highlight" => "title"
        ),
        ".kong-singlePost__hero__title" => array(
            "position" => array(
                "top" => "5px",
                "left" => "5px"
            ),
            "wrap" => true,
            "highlight" => "hero title"
        ),
        ".kong-singlePost__hero" => array(
            "position" => array(
                "top" => "20px",
                "right" => "20px"
            ),
            "highlight" => "hero layout"
        ),
        ".kong-singlePost__hero__content__wrap" => array(
            "position" => array(
                "top" => "0px",
                "left" => "50%"
            ),
            "highlight" => "hero layout"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hero Layout",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_min_height",
                    "attrs" => array(
                        "label" => "Min Height",
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
                        "desktop" => "600px",
                        "tablet" => "500px"
                    ),
                    "responsive_styles" => array(
                        ".kong-singlePost__hero" => array(
                            "minHeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 1000,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "70px 0px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-singlePost__hero__content__wrap" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_align",
                    "attrs" => array(
                        "label" => "Alignment",
                        "type" => "res-align"
                    ),
                    "default_value" => array(
                        "desktop" => "center"
                    ),
                    "responsive_styles" => array(
                        ".kong-singlePost__hero" => array(
                            "textAlign" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Parallax",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_parallax",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Enable the parallax effect to gradually move feature image and fade out text when scrolling down"
                    ),
                    "default_value" => true
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hero Title",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_title_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 120,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 60,
                        "mobile" => 32
                    ),
                    "responsive_styles" => array(
                        ".kong-singlePost__hero__title" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_title_margin",
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
                        "desktop" => "20px 0px 25px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-singlePost__hero__title" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_title_letter_spacing",
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
                        ".kong-singlePost__hero__title" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_title_weight",
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
                        ".kong-singlePost__hero__title" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_title_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        ".kong-singlePost__hero__title" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hero Color",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_overlay",
                    "attrs" => array(
                        "label" => "Overlay",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["overlay_bg"],
                    "styles" => array(
                        ".kong-singlePost__hero__overlay" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_title_color",
                    "attrs" => array(
                        "label" => "Title",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["overlay_primary"],
                    "styles" => array(
                        ".kong-singlePost__hero__title" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["overlay_desc"],
                    "styles" => array(
                        ".kong-singlePost__hero" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_cat_color",
                    "attrs" => array(
                        "label" => "Category",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["overlay_text"],
                    "styles" => array(
                        ".kong-singlePost__hero__cats a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_hero_author_color",
                    "attrs" => array(
                        "label" => "Author",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["overlay_primary"],
                    "styles" => array(
                        ".kong-singlePost__hero__author a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("single_post_layout", "single_post", array(
    "name" => "Layout",
    "direct_links" => array(
        ".kong-singlePost__footer" => array(
            "position" => array(
                "right" => "10px",
                "top" => "10px"
            ),
            "highlight" => "footer"
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
                    "bind_to" => "single_post_has_container",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Wrap the post content inside a container if you do not wish to build content by page builder."
                    ),
                    "default_value" => true
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_max_width",
                    "if" => "@options.single_post_has_container",
                    "attrs" => array(
                        "label" => "Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 2000,
                                "step" => 1
                            ),
                            "units" => [
                                "px",
                                "%",
                                "vw"
                            ]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "700px"
                    ),
                    "responsive_styles" => array(
                        ".kong-singlePost .kong-container,.kong-postComment.kong-container" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Footer",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_footer__margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 1000,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "50px 0px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-singlePost__footer" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("single_post_tags", "single_post", array(
    "name" => "Tags",
    "direct_links" => array(
        ".kong-singlePost__tags" => array(
            "position" => array(
                "top" => "2px",
                "left" => "2px"
            ),
            "highlight" => "color"
        )
    ),
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
                    "bind_to" => "single_post_tags_enable",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Enable this button to display a list of tags at the end of each article."
                    ),
                    "default_value" => true
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "if" => "@options.single_post_tags_enable",
            "attrs" => array(
                "label" => "Color",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_tag_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        ".kong-singlePost__tag" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_tag_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        ".kong-singlePost__tag" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_tag_border",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ededed",
                    "styles" => array(
                        ".kong-singlePost__tag" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_tag_bg_hover",
                    "attrs" => array(
                        "label" => "Background Hover",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#f7f7f7",
                    "styles" => array(
                        ".kong-singlePost__tag:hover" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_tag_color_hover",
                    "attrs" => array(
                        "label" => "Color Hover",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        ".kong-singlePost__tag:hover" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "single_post_tag_border_hover",
                    "attrs" => array(
                        "label" => "Border Hover",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#f0f0f0",
                    "styles" => array(
                        ".kong-singlePost__tag:hover" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("single_post_share", "single_post", array(
    "name" => "Sharing",
    "direct_links" => array(
        ".kong-singlePost__share a" => [
            array(
                "position" => array(
                    "top" => 0,
                    "right" => 0
                ),
                "highlight" => "style"
            )
        ]
    ),
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
                    "bind_to" => "single_post_share_enable",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Enable this button to display social sharing links at the end of each post."
                    ),
                    "default_value" => true
                )
            ]
        ),
        array(
            "if" => "@options.single_post_share_enable",
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
                            "bind_to" => "single_share_margin",
                            "attrs" => array(
                                "label" => "Distance",
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
                                ".kong-singlePost__share " => array(
                                    "margin" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_share_size",
                            "attrs" => array(
                                "label" => "Size",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 8,
                                    "max" => 50,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 26
                            ),
                            "responsive_styles" => array(
                                ".kong-singlePost__share svg" => array(
                                    "width" => "{{@model}}px",
                                    "height" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_share_spacing",
                            "attrs" => array(
                                "label" => "Spacing",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 2,
                                    "max" => 20,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 7
                            ),
                            "responsive_styles" => array(
                                ".kong-singlePost__share a" => array(
                                    "marginLeft" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_share_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["border_secondary"],
                            "styles" => array(
                                ".kong-singlePost__share svg" => array(
                                    "fill" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Icon List",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_twitter_enable",
                            "reload" => true,
                            "attrs" => array(
                                "label" => "Twitter",
                                "type" => "switch"
                            ),
                            "default_value" => true
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_facebook_enable",
                            "reload" => true,
                            "attrs" => array(
                                "label" => "Facebook",
                                "type" => "switch"
                            ),
                            "default_value" => true
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_linkedin_enable",
                            "reload" => true,
                            "attrs" => array(
                                "label" => "Linkedin",
                                "type" => "switch"
                            ),
                            "default_value" => true
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_pinterest_enable",
                            "reload" => true,
                            "attrs" => array(
                                "label" => "Pinterest",
                                "type" => "switch"
                            ),
                            "default_value" => true
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_email_enable",
                            "reload" => true,
                            "attrs" => array(
                                "label" => "Email",
                                "type" => "switch"
                            ),
                            "default_value" => true
                        )
                    ]
                )
            ]
        )
    ]
));

$manager::addChildPanel("single_post_nav", "single_post", array(
    "name" => "Navigation",
    "direct_links" => array(
        ".kong-postNav" => array(
            "position" => array(
                "top" => "0",
                "right" => "0"
            ),
            "highlight" => "spacing"
        )
    ),
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
                    "reload" => true,
                    "bind_to" => "single_post_nav_enable",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Enable this button to display a navigation to the next or previous post."
                    ),
                    "default_value" => true
                )
            ]
        ),
        array(
            "if" => "@options.single_post_nav_enable",
            "content" => [
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Spacing",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_post_nav_padding",
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
                                "desktop" => "50px 0px 70px 0px"
                            ),
                            "responsive_styles" => array(
                                ".kong-postNav" => array(
                                    "padding" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_post_nav_margin",
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
                                "desktop" => "40px 0px 0px 0px"
                            ),
                            "responsive_styles" => array(
                                ".kong-postNav" => array(
                                    "margin" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "single_post_nav_border",
                            "attrs" => array(
                                "label" => "Border",
                                "type" => "area2",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => "1px 0px 0px 0px",
                            "styles" => array(
                                ".kong-postNav" => array(
                                    "borderWidth" => "{{@model}}"
                                )
                            )
                        )
                    ]
                )
            ]
        )
    ]
));

$manager::addChildPanel("single_post_comment", "single_post", array(
    "name" => "Comment",
    "direct_links" => array(
        ".kong-postComment" => array(
            "position" => array(
                "top" => 0,
                "right" => 0
            ),
            "highlight" => "spacing"
        )
    ),
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
                    "reload" => true,
                    "bind_to" => "single_post_comment_enable",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Enable this button to display comment for your blog."
                    ),
                    "default_value" => true
                )
            ]
        ),
        array(
            "if" => "@options.single_post_comment_enable",
            "content" => [
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Spacing",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "post_comment_padding",
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
                                "desktop" => "70px 0px 0px 0px"
                            ),
                            "responsive_styles" => array(
                                ".kong-postComment__wrap" => array(
                                    "padding" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "post_comment_border",
                            "attrs" => array(
                                "label" => "Border",
                                "type" => "area2",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => "1px 0px 0px 0px",
                            "styles" => array(
                                ".kong-postComment__wrap" => array(
                                    "borderWidth" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Submit",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "comment_submit_bg",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                ".form-submit .submit" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "comment_submit_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                ".form-submit .submit" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "comment_submit_bg_hover",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                ".form-submit .submit:hover" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "comment_submit_color_hover",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                ".form-submit .submit:hover" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        )
                    ]
                )
            ]
        )
    ]
));

$manager::addChildPanel("single_post_password", "single_post", array(
    "name" => "Password Type",
    "direct_links" => array(
        ".post-password-form" => array(
            "position" => array(
                "top" => "10px",
                "right" => "10px"
            ),
            "highlight" => "style"
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
                    "bind_to" => "protected_primary_color",
                    "attrs" => array(
                        "label" => "Primary Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        ".post-password-form,.post-password-form input[type='password'],.post-password-form input[type='password']:focus,.post-password-form input[type='submit']" => array(
                            "borderColor" => "{{@model}}"
                        ),
                        ".post-password-form input[type='submit']" => array(
                            "backgroundColor" => "{{@model}}"
                        ),
                        ".post-password-form p:first-child" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "protected_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["code_bg"],
                    "styles" => array(
                        ".post-password-form" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

?>