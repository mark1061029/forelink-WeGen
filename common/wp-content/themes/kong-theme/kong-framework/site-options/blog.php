<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("blog", array(
    "icon" => "pencil",
    "name" => "Blog",
    "side" => "frontend"
),6);

$manager::addChildPanel("blog_hero_slider", "blog", array(
    "name" => "Hero Slider",
    "direct_links" => array(
        ".kong-heroSlider" => [
            array(
                "position" => array(
                    "top" => "30px",
                    "right" => "30px"
                )
            )
        ],
        ".kong-heroSlider__title" => [
            array(
                "position" => array(
                    "top" => "2px",
                    "right" => "48%"
                ),
                "highlight" => "title"
            )
        ],
        ".kong-heroSlider .owl-dots" => [
            array(
                "position" => array(
                    "top" => "-10px",
                    "right" => "-3px"
                ),
                "highlight" => "pagination"
            )
        ],
        ".kong-heroSlider__content" => [
            array(
                "position" => array(
                    "top" => 0,
                    "right" => 0
                ),
                "highlight" => "general style"
            )
        ],
        ".kong-heroSlider__link" => [
            array(
                "position" => array(
                    "top" => "-2px",
                    "right" => "-2px"
                ),
                "highlight" => "button"
            )
        ],
        ".kong-heroSlider__author" => [
            array(
                "position" => array(
                    "bottom" => 0,
                    "right" => "45%"
                ),
                "highlight" => "author"
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
                    "bind_to" => "blog_hero_slide_enable",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Enable this button to display a slideshow which will feature a list of posts based on your settings"
                    ),
                    "default_value" => true
                )
            ]
        ),
        array(
            "if" => "@options.blog_hero_slide_enable",
            "content" => [
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Settings",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_display",
                            "reload" => true,
                            "attrs" => array(
                                "label" => "Display on",
                                "type" => "selection",
                                "config" => array(
                                    "blog" => "Blog",
                                    "archive" => "Archive",
                                    "both" => "Both"
                                )
                            ),
                            "default_value" => "both"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_num_post",
                            "reload" => true,
                            "attrs" => array(
                                "label" => "Number of Posts",
                                "type" => "number",
                                "config" => array(
                                    "min" => 2,
                                    "max" => 8,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 4
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_autoplay",
                            "reload" => true,
                            "attrs" => array(
                                "label" => "Auto Play",
                                "type" => "switch"
                            ),
                            "default_value" => true
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_effect",
                            "reload" => true,
                            "attrs" => array(
                                "label" => "Effect",
                                "type" => "text-buttons",
                                "config" => array(
                                    "options" => array(
                                        "slide" => "Slide",
                                        "fade" => "Fade"
                                    )
                                )
                            ),
                            "default_value" => "slide"
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "General Style",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_height",
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
                                        "vh"
                                    ]
                                )
                            ),
                            "default_value" => array(
                                "desktop" => "100vh",
                                "mobile" => "600px"
                            ),
                            "responsive_styles" => array(
                                ".kong-heroSlider,.kong-heroSlider .owl-item" => array(
                                    "height" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_overlay",
                            "attrs" => array(
                                "label" => "Overlay",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["overlay_bg"],
                            "styles" => array(
                                ".kong-heroSlider__overlay,.kong-heroSlider" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_content_margin",
                            "attrs" => array(
                                "label" => "Content Margin",
                                "type" => "res-area",
                                "config" => array(
                                    "min" => -100,
                                    "max" => 120,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => "0px 0px 0px 0px"
                            ),
                            "responsive_styles" => array(
                                ".kong-heroSlider__content" => array(
                                    "margin" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Pagination",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_pagination_color",
                            "attrs" => array(
                                "label" => "Link",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                ".kong-heroSlider .owl-dot" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_pagination_active_color",
                            "attrs" => array(
                                "label" => "Link",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                ".kong-heroSlider .owl-dot.active" => array(
                                    "backgroundColor" => "{{@model}}"
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
                            "bind_to" => "blog_hero_slide_title_size",
                            "attrs" => array(
                                "label" => "Title Size",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 10,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 60,
                                "mobile" => 40
                            ),
                            "responsive_styles" => array(
                                ".kong-heroSlider__title" => array(
                                    "fontSize" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_title_color",
                            "attrs" => array(
                                "label" => "Overlay",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["overlay_primary"],
                            "styles" => array(
                                ".kong-heroSlider__title" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_title_letter_spacing",
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
                                ".kong-heroSlider__title" => array(
                                    "letterSpacing" => "{{@model}}em"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_title_weight",
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
                                ".kong-heroSlider__title" => array(
                                    "fontWeight" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_title_transform",
                            "attrs" => array(
                                "label" => "Text Transform",
                                "type" => "text-transform"
                            ),
                            "default_value" => "",
                            "styles" => array(
                                ".kong-heroSlider__title" => array(
                                    "textTransform" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Button",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_btn_bg",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "transparent",
                            "styles" => array(
                                ".kong-heroSlider__link" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_btn_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                ".kong-heroSlider__link" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_btn_border_color",
                            "attrs" => array(
                                "label" => "Border",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                ".kong-heroSlider__link" => array(
                                    "borderColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_btn_bg_hover",
                            "attrs" => array(
                                "label" => "Background Hover",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                ".kong-heroSlider__link:hover" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_btn_color_hover",
                            "attrs" => array(
                                "label" => "Color Hover",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                ".kong-heroSlider__link:hover" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_btn_border_color_hover",
                            "attrs" => array(
                                "label" => "Border Hover",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                ".kong-heroSlider__link:hover" => array(
                                    "borderColor" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Excerpt",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_desc",
                            "attrs" => array(
                                "label" => "Link",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["overlay_text"],
                            "styles" => array(
                                ".kong-heroSlider__desc" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_desc_margin",
                            "attrs" => array(
                                "label" => "Margin",
                                "type" => "res-area2",
                                "config" => array(
                                    "min" => -100,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => "30px 0px 50px 0px"
                            ),
                            "responsive_styles" => array(
                                ".kong-heroSlider__desc" => array(
                                    "margin" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Author",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_hero_slide_author",
                            "attrs" => array(
                                "label" => "Link",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["overlay_primary"],
                            "styles" => array(
                                ".kong-heroSlider__author a" => array(
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

$manager::addChildPanel("blog_header", "blog", array(
    "name" => "Header",
    "direct_links" => array(
        ".kong-blogHeader__label" => array(
            "position" => array(
                "left" => "50%",
                "top" => "2px"
            ),
            "highlight" => "label"
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
                    "bind_to" => "blog_header_enable",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Activate this button to display a label featuring tag or category name of archive pages"
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "if" => "@options.blog_header_enable",
            "content" => [
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Label",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_header_label_margin",
                            "attrs" => array(
                                "label" => "Margin",
                                "type" => "res-area2",
                                "config" => array(
                                    "min" => -20,
                                    "max" => 150,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => "70px 0px 0px 0px"
                            ),
                            "responsive_styles" => array(
                                ".kong-blogHeader__label" => array(
                                    "margin" => "{{@model}}"
                                )
                            )
                        )
                    ]
                )
            ]
        )
    ]
));

$manager::addChildPanel("blog_layout", "blog", array(
    "name" => "Layout",
    "direct_links" => array(
        ".kong-blog" => array(
            "position" => array(
                "left" => "-5px",
                "top" => "-5px"
            )
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Display Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_style",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Type",
                        "type" => "selection",
                        "config" => array(
                            "classic-grid" => "Classic Grid",
                            "metro" => "Metro"
                        )
                    ),
                    "default_value" => "classic-grid"
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
                    "bind_to" => "blog_page_max_width",
                    "attrs" => array(
                        "label" => "Wrap Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 2000,
                                "step" => 1
                            )
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "1400px"
                    ),
                    "responsive_styles" => array(
                        ".kong-blog__wrap" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_page_padding",
                    "attrs" => array(
                        "label" => "Wrap Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "60px 30px 100px 30px",
                        "mobile" => "60px 20px 100px 20px"
                    ),
                    "responsive_styles" => array(
                        ".kong-blog__wrap" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("blog_classic_grid", "blog", array(
    "name" => "Classic Grid Style",
    "direct_links" => array(
        ".kong-bcgi__wrap" => array(
            "position" => array(
                "right" => "0px",
                "top" => "0px"
            ),
            "highlight" => "box"
        ),
        ".kong-bcgi__title" => array(
            "position" => array(
                "left" => "0px",
                "top" => "2px"
            ),
            "highlight" => "title"
        ),
        ".kong-bcgi__image" => array(
            "position" => array(
                "right" => "10px",
                "top" => "10px"
            ),
            "highlight" => "image"
        ),
        ".kong-bcgi__excerpt" => array(
            "position" => array(
                "top" => "0px",
                "right" => "0px"
            ),
            "highlight" => "excerpt"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Box",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_column",
                    "attrs" => array(
                        "label" => "Number of Columns",
                        "type" => "text-buttons",
                        "config" => array(
                            "options" => array(
                                "2" => "2",
                                "3" => "3",
                                "4" => "4",
                                "5" => "5",
                                "6" => "6"
                            ),
                            "class" => "column",
                            "watch" => "attr",
                            "selector" => ".kong-blog.kong-blogClassicGrid",
                            "attr" => "data-column"
                        )
                    ),
                    "default_value" => "4"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_distance",
                    "attrs" => array(
                        "label" => "Item Distance",
                        "type" => "slider",
                        "config" => array(
                            "min" => 3,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => 15,
                    "styles" => array(
                        ".kong-bcgi" => array(
                            "padding" => "0 {{@model}}px"
                        ),
                        ".kong-blogClassicGrid__wrap" => array(
                            "margin" => "0 -{{@model}}px"
                        ),
                        ".kong-blogClassicGrid" => array(
                            "margin" => "0 -{{@model}}px",
                            "padding" => "0 {{@model}}px"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Image",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_image",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 20,
                            "max" => 150,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 56
                    ),
                    "responsive_styles" => array(
                        ".kong-bcgi__img" => array(
                            "paddingBottom" => "{{@model}}%"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_image_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        ".kong-bcgi__img" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Spacing",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_spacing",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 150,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "15px 0px 20px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-bcgi__content" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Category & Author",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_cat_color",
                    "attrs" => array(
                        "label" => "Category",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        ".kong-bcgi__cats a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_author_color",
                    "attrs" => array(
                        "label" => "Author",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        ".kong-bcgi__author" => array(
                            "color" => "{{@model}}"
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
                    "bind_to" => "blog_classic_grid_title_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 22
                    ),
                    "responsive_styles" => array(
                        ".kong-bcgi__title" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_title_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        ".kong-bcgi__title a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_title_margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => -100,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "5px 0px 10px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-bcgi__title" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_title_weight",
                    "attrs" => array(
                        "label" => "Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 600,
                    "styles" => array(
                        ".kong-bcgi__title a" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_title_letter_spacing",
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
                        ".kong-bcgi__title a" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_title_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        ".kong-bcgi__title a" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Excerpt",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_classic_grid_excerpt_enable",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => true,
                    "reload" => true
                ),
                array(
                    "if" => "@options.blog_classic_grid_excerpt_enable",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_classic_grid_excerpt_size",
                            "attrs" => array(
                                "label" => "Font Size",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 10,
                                    "max" => 60,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 14
                            ),
                            "responsive_styles" => array(
                                ".kong-bcgi__excerpt" => array(
                                    "fontSize" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_classic_grid_excerpt_line_height",
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
                                ".kong-bcgi__excerpt" => array(
                                    "lineHeight" => "{{@model}}em"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_classic_grid_excerpt_margin",
                            "attrs" => array(
                                "label" => "Margin",
                                "type" => "res-area2",
                                "config" => array(
                                    "min" => -100,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => "0px 0px 20px 0px"
                            ),
                            "responsive_styles" => array(
                                ".kong-bcgi__excerpt" => array(
                                    "margin" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "blog_classic_grid_excerpt_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["text"],
                            "styles" => array(
                                ".kong-bcgi__excerpt" => array(
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

$manager::addChildPanel("blog_metro", "blog", array(
    "name" => "Metro Style",
    "direct_links" => array(
        ".kong-bmi__title" => array(
            "position" => array(
                "right" => "0px",
                "top" => "0px"
            ),
            "highlight" => "title"
        ),
        ".kong-bmi__wrap" => array(
            "position" => array(
                "right" => "5px",
                "top" => "5px"
            ),
            "highlight" => "Box"
        ),
        ".kong-bmi__footer" => array(
            "position" => array(
                "left" => "5px",
                "top" => "5px"
            ),
            "highlight" => "Color"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "List",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_size_list",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Size List",
                        "type" => "selection",
                        "config" => array(
                            "s14" => "Square 1/4",
                            "s13" => "Square 1/3",
                            "s14,s14,s12,s14,s14,s12,s14,s14,s14,s14" => "Mixed Square 1/2 1/4",
                            "custom" => "Custom"
                        )
                    ),
                    "default_value" => "s14"
                ),
                array(
                    "if" => "@options.blog_metro_size_list == 'custom'",
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_size_list_custom",
                    "attrs" => array(
                        "full" => true,
                        "type" => "textarea"
                    ),
                    "default_value" => "s13,s13,s13,s13,h23",
                    "reload" => true
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_scroll_effect",
                    "attrs" => array(
                        "label" => "Scroll Effect",
                        "type" => "selection",
                        "config" => array(
                            "none" => "None",
                            "kong-sa--moveTop" => "Move Top",
                            "kong-sa--moveTopLightRotate" => "Move Top Light Rotate",
                            "kong-sa--moveTopLeft" => "Move Top Left",
                            "kong-sa--moveTopRight" => "Move Top Right",
                            "kong-sa--moveLeft" => "Move Left",
                            "kong-sa--moveRight" => "Move Right",
                            "kong-sa--fadeIn" => "Fade In",
                            "kong-sa--scaleOut" => "Scale Out"
                        )
                    ),
                    "default_value" => "kong-sa--scaleOut"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_body_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#000000",
                    "styles" => array(
                        ".kong-blogMetro" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Box",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_arrange_content",
                    "attrs" => array(
                        "label" => "Arrange Content",
                        "type" => "class-text-buttons",
                        "config" => array(
                            "selector" => ".kong-blogMetro",
                            "options" => array(
                                "kong-blogMetro--flexStart" => "Start",
                                "kong-blogMetro--spaceBetween" => "Space",
                                "kong-blogMetro--flexEnd" => "End"
                            )
                        )
                    ),
                    "default_value" => "kong-blogMetro--flexEnd"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_item_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#232323",
                    "styles" => array(
                        ".kong-bmi__wrap" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 50,
                            "max" => 100,
                            "step" => 2
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 100
                    ),
                    "responsive_styles" => array(
                        ".kong-blogMetro [class*='kong-metro--s'] > *" => array(
                            "paddingBottom" => "{{@model}}%"
                        ),
                        ".kong-blogMetro [class*='kong-metro--v'] > *" => array(
                            "paddingBottom" => "{{@model*2}}%"
                        ),
                        ".kong-blogMetro [class*='kong-metro--h'] > *" => array(
                            "paddingBottom" => "{{@model/2}}%"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "20px 20px 20px 20px"
                    ),
                    "responsive_styles" => array(
                        ".kong-bmi__content" => array(
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
                    "bind_to" => "blog_metro_title_size",
                    "attrs" => array(
                        "label" => "Title Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 24,
                        "mobile" => 18
                    ),
                    "responsive_styles" => array(
                        ".kong-bmi__title" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_title_color",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["overlay_primary"],
                    "styles" => array(
                        ".kong-bmi__title" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_title_margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => -20,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "15px 0px 15px 0px"
                    ),
                    "responsive_styles" => array(
                        ".kong-bmi__title" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_title_letter_spacing",
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
                        ".kong-bmi__title" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_title_weight",
                    "attrs" => array(
                        "label" => "Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 600,
                    "styles" => array(
                        ".kong-bmi__title" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_title_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        ".kong-bmi__title" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Color",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_author_color",
                    "attrs" => array(
                        "label" => "Author",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["overlay_primary"],
                    "styles" => array(
                        ".kong-bmi__author" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_date_color",
                    "attrs" => array(
                        "label" => "Date",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["overlay_desc"],
                    "styles" => array(
                        ".kong-bmi__date" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_metro_footer_color",
                    "attrs" => array(
                        "label" => "Category",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["overlay_text"],
                    "styles" => array(
                        ".kong-bmi__footer" => array(
                            "color" => "{{@model}}"
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
                    "bind_to" => "blog_metro_overlay",
                    "attrs" => array(
                        "label" => "Gradient",
                        "type" => "gradient",
                        "config" => array(
                            "third_color" => true,
                            "radial" => false
                        )
                    ),
                    "default_value" => array(
                        "color_1" => "rgba(0,0,0,0.5)",
                        "color_2" => "rgba(0,0,0,0.5)",
                        "color_3" => "rgba(0,0,0,0.5)",
                        "angle" => 180,
                        "value" => "linear-gradient(180deg, rgba(0,0,0,0.5), rgba(0,0,0,0.5), rgba(0,0,0,0.5))"
                    ),
                    "styles" => array(
                        ".kong-bmi__overlay" => array(
                            "background" => "{{@model.value}}"
                        )
                    )
                )
            ]
        )
    ]
));


$manager::addChildPanel("blog_paging", "blog", array(
    "name" => "Paging",
    "direct_links" => array(
        ".kong-blogPagination" => array(
            "position" => array(
                "left" => "0px",
                "top" => "0px"
            ),
            "highlight" => "Pagination Style"
        ),
        ".kong-blog-loadmore" => array(
            "position" => array(
                "left" => "0px",
                "top" => "0px"
            ),
            "highlight" => "Load More Button Style"
        )
    ),
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Paging Method",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_paging_style",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Method",
                        "type" => "text-buttons",
                        "config" => array(
                            "options" => array(
                                "pagination" => "Pagination",
                                "infinite" => "Scrolling",
                                "button" => "Button"
                            )
                        )
                    ),
                    "default_value" => "infinite"
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "if" => "@options.blog_paging_style == 'button'",
            "attrs" => array(
                "label" => "Load More Button Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_loadmore_text",
                    "attrs" => array(
                        "label" => "Text",
                        "type" => "text"
                    ),
                    "default_value" => "Load More Posts"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_loadmore_loading_text",
                    "attrs" => array(
                        "label" => "Loading Text",
                        "type" => "text"
                    ),
                    "default_value" => "Loading..."
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "blog_loadmore_load_all_text",
                    "attrs" => array(
                        "label" => "No More Text",
                        "type" => "text"
                    ),
                    "default_value" => "No more posts to load"
                )
            ]
        )
    ]
));

?>