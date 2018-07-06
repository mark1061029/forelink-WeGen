<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Slideshow",
    "tag" => "slideshow",
    "keywords" => ["slideshow","image"],
    "native" => true,
    "filter" => "image",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Slides",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model",
                    "attrs" => array(
                        "label" => "Items",
                        "type" => "image-group"
                    ),
                    "default_value" => []
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Height, Spacing & Overlay",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-unit",
                        "config" => array(
                            "units" => ["px","vh"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100vh",
                        "tablet" => "70vh",
                        "mobile" => "500px"
                    ),
                    "responsive_styles" => array(
                        "@id,@id .owl-item" => array(
                            "minHeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Content Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "units" => ["px","%","vw"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "70vw",
                        "tablet" => "70vw",
                        "mobile" => "90%"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-slideshow__content" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_margin_top",
                    "attrs" => array(
                        "label" => "Content Margin Top",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => -20,
                            "max" => 20,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 0
                    ),
                    "responsive_styles" => array(
                        "@id .kong-slideshow__content" => array(
                            "marginTop" => "{{@model}}%"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.overlay",
                    "attrs" => array(
                        "label" => "Overlay",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id .kong-slideshow__item:before" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Slide Settings",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.effect",
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.allow_drag",
                    "attrs" => array(
                        "label" => "Allow Drag",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.autoplay",
                    "attrs" => array(
                        "label" => "Auto Play",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "if" => "@attrs.autoplay",
                    "bind_to" => "@attrs.duration",
                    "attrs" => array(
                        "label" => "Duration",
                        "type" => "Slider",
                        "config" => array(
                            "min" => 3000,
                            "max" => 20000,
                            "step" => 500
                        )
                    ),
                    "default_value" => 10000
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Navigation",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.navigation",
                    "attrs" => array(
                        "label" => "Navigation",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "if" => "@attrs.navigation",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.nav_size",
                            "attrs" => array(
                                "label" => "Size",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 10,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 48,
                                "mobile" => 40
                            ),
                            "responsive_styles" => array(
                                "@id .owl-prev,@id .owl-next" => array(
                                    "fontSize" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.nav_position",
                            "attrs" => array(
                                "label" => "Position",
                                "type" => "slider",
                                "config" => array(
                                    "min" => -50,
                                    "max" => 50,
                                    "step" => 0.5
                                )
                            ),
                            "default_value" => 2.5,
                            "styles" => array(
                                "@id .owl-prev" => array(
                                    "left" => "{{@model}}%"
                                ),
                                "@id .owl-next" => array(
                                    "right" => "{{@model}}%"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.nav_icon",
                            "attrs" => array(
                                "label" => "Icon",
                                "type" => "selection",
                                "config" => array(
                                    "0" => "Thin Chevron",
                                    "1" => "Thick Chevron",
                                    "2" => "Chevron Circle",
                                    "3" => "Arrow"
                                )
                            ),
                            "default_value" => "1"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.nav_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors['border'],
                            "styles" => array(
                                "@id .owl-prev,@id .owl-next" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        )
                    ]
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
                    "bind_to" => "@attrs.pagination",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "if" => "@attrs.pagination",
                    "content" => [
                        array(
                            "if" => "@attrs.pagination",
                            "content" => [
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.pag_size",
                                    "attrs" => array(
                                        "label" => "Size",
                                        "type" => "slider",
                                        "config" => array(
                                            "min" => 4,
                                            "max" => 20,
                                            "step" => 1
                                        )
                                    ),
                                    "default_value" => 10,
                                    "styles" => array(
                                        "@id .owl-dot span" => array(
                                            "width" => "{{@model}}px"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.pag_margin",
                                    "attrs" => array(
                                        "label" => "Margin",
                                        "type" => "slider",
                                        "config" => array(
                                            "min" => 0,
                                            "max" => 20,
                                            "step" => 1
                                        )
                                    ),
                                    "default_value" => 3,
                                    "styles" => array(
                                        "@id .owl-dot" => array(
                                            "margin" => "0 {{@model}}px"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.pag_color",
                                    "attrs" => array(
                                        "label" => "Color",
                                        "type" => "colorpicker"
                                    ),
                                    "default_value" => $manager::$colors['primary_context'],
                                    "styles" => array(
                                        "@id .owl-dot span" => array(
                                            "backgroundColor" => "{{@model}}"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.pag_active_color",
                                    "attrs" => array(
                                        "label" => "Active Color",
                                        "type" => "colorpicker"
                                    ),
                                    "default_value" => $manager::$colors["primary"],
                                    "styles" => array(
                                        "@id .owl-dot.active span" => array(
                                            "backgroundColor" => "{{@model}}"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.pag_scale",
                                    "attrs" => array(
                                        "label" => "Scale",
                                        "type" => "slider",
                                        "config" => array(
                                            "min" => 0.3,
                                            "max" => 1,
                                            "step" => 0.05
                                        )
                                    ),
                                    "default_value" => 1,
                                    "styles" => array(
                                        "@id .owl-dot span" => array(
                                            "transform" => "scale({{@model}})"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.pag_active_scale",
                                    "attrs" => array(
                                        "label" => "Active Scale",
                                        "type" => "slider",
                                        "config" => array(
                                            "min" => 0.5,
                                            "max" => 1,
                                            "step" => 0.05
                                        )
                                    ),
                                    "default_value" => 1,
                                    "styles" => array(
                                        "@id .owl-dot.active span" => array(
                                            "transform" => "scale({{@model}})"
                                        )
                                    )
                                )
                            ]
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Heading",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 48,
                        "tablet" => 40,
                        "mobile" => 32
                    ),
                    "responsive_styles" => array(
                        "@id .kong-slideshow__heading" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-slideshow__heading" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_weight",
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
                        "@id .kong-slideshow__heading" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_letter_spacing",
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
                        "@id .kong-slideshow__heading" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id .kong-slideshow__heading" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Description",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_size",
                    "attrs" => array(
                        "label" => "Size",
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
                        "@id .kong-slideshow__desc" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "rgba(255,255,255,0.7)",
                    "styles" => array(
                        "@id .kong-slideshow__desc" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_margin",
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
                        "desktop" => "25px 0px 50px 0px",
                        "mobile" => "20px 0px 30px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-slideshow__desc" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_max_width",
                    "attrs" => array(
                        "label" => "Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1200,
                                "step" => 1
                            ),
                            "units" => ["px","%","vw"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "500px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-slideshow__desc" => array(
                            "maxWidth" => "{{@model}}"
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
                    "bind_to" => "@attrs.btn_font_size",
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
                        "desktop" => 12,
                        "mobile" => 10
                    ),
                    "responsive_styles" => array(
                        "@id .kong-slideshow__btn" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.2,
                            "max" => 1,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.1,
                    "styles" => array(
                        "@id .kong-slideshow__btn" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_font_weight",
                    "attrs" => array(
                        "type" => "slider",
                        "label" => "Weight",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 600,
                    "styles" => array(
                        "@id .kong-slideshow__btn" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_text_transform",
                    "attrs" => array(
                        "type" => "text-transform",
                        "label" => "Text Transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id .kong-slideshow__btn" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 100,
                    "styles" => array(
                        "@id .kong-slideshow__btn" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 3,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "9px 24px 9px 24px",
                        "mobile" => "8px 20px 8px 20px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-slideshow__btn" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_left_bg",
                    "attrs" => array(
                        "label" => "Button 1 Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-slideshow__btn--left" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_left_color",
                    "attrs" => array(
                        "label" => "Button 1 Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id .kong-slideshow__btn--left" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_right_bg",
                    "attrs" => array(
                        "label" => "Button 2 Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-slideshow__btn--right" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_right_color",
                    "attrs" => array(
                        "label" => "Button 2 Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#101010",
                    "styles" => array(
                        "@id .kong-slideshow__btn--right" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_box_shadow",
                    "attrs" => array(
                        "label" => "Box Shadow",
                        "type" => "box-shadow"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id .kong-slideshow__btn" => array(
                            "boxShadow" => "{{@model}}"
                        )
                    )
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
    ],
    "child" => array(
        "name" => "Slide",
        "tag" => "slide",
        "native" => true,
        "content" => [
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Content",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.image",
                        "attrs" => array(
                            "label" => "Image",
                            "type" => "upload-image"
                        ),
                        "default_value" => array(
                            "url" => ""
                        ),
                        "styles" => array(
                            "@id" => array(
                                "backgroundImage" => "url({{@model.url}})"
                            )
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.heading",
                        "attrs" => array(
                            "label" => "Heading",
                            "type" => "text"
                        ),
                        "default_value" => $manager::$text["heading"]
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.desc",
                        "attrs" => array(
                            "label" => "Desc",
                            "type" => "textarea"
                        ),
                        "default_value" => $manager::$text["paragraph"]
                    )
                ]
            ),
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Button 1",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.btn_left_text",
                        "attrs" => array(
                            "label" => "Text",
                            "type" => "text"
                        ),
                        "default_value" => "Button Text"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.btn_left_link",
                        "attrs" => array(
                            "label" => "Link",
                            "type" => "link"
                        ),
                        "default_value" => array(
                            "url" => "#",
                            "new_tab" => false
                        )
                    )
                ]
            ),
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Button 2",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.btn_right_text",
                        "attrs" => array(
                            "label" => "Text",
                            "type" => "text"
                        ),
                        "default_value" => "Button Text"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.btn_right_link",
                        "attrs" => array(
                            "label" => "Link",
                            "type" => "link"
                        ),
                        "default_value" => array(
                            "url" => "#",
                            "new_tab" => false
                        )
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem" style="height:200px" ng-if="$ctrl.edited.content.length == 0">
    <span class="kong-dnd__emptyItem__label">Slideshow</span>
</div>

<div class="kong-slideshow {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]"
     id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-carousel owl-carousel" kong-slideshow list="$ctrl.edited.content"
         duration="$ctrl.edited.attrs.duration"
         autoplay="$ctrl.edited.attrs.autoplay"
         effect="$ctrl.edited.attrs.effect"
         allow-drag="$ctrl.edited.attrs.allow_drag"
         pagination="$ctrl.edited.attrs.pagination"
         nav-icon="$ctrl.edited.attrs.nav_icon"
         navigation="$ctrl.edited.attrs.navigation">
        <div class="kong-slideshow__item" ng-repeat="item in $ctrl.edited.content track by $index" ng-style="{'background-image' : 'url(' + item.attrs.image.url + ')'}">
            <div class="kong-slideshow__content">
                <h4 class="kong-slideshow__heading" ng-bind-html="item.attrs.heading"></h4>
                <p class="kong-slideshow__desc" ng-bind-html="item.attrs.desc"></p>
                <div class="kong-slideshow__btnContainer">
                    <a class="kong-slideshow__btn kong-slideshow__btn--left" ng-show="item.attrs.btn_left_text" ng-bind-html="item.attrs.btn_left_text"></a>
                    <a class="kong-slideshow__btn kong-slideshow__btn--right" ng-show="item.attrs.btn_right_text" ng-bind-html="item.attrs.btn_right_text"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_slideshow', 'kong_slideshow_callback');
function kong_slideshow_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'duration' => 7000,
        'autoplay' => 'false',
        'effect' => 'slide',
        'allow_drag' => 'true',
        'pagination' => 'false',
        'navigation' => 'false',
        'nav_icon' => '0'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-slideshow <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <div class="kong-carousel owl-carousel"
             data-duration="<?php echo $attrs['duration']; ?>"
             data-autoplay="<?php echo $attrs['autoplay']; ?>"
             data-effect="<?php echo $attrs['effect']; ?>"
             data-allow-drag="<?php echo $attrs['allow_drag']; ?>"
             data-pagination="<?php echo $attrs['pagination']; ?>"
             data-navigation="<?php echo $attrs['navigation']; ?>"
             data-nav-icon="<?php echo $attrs['nav_icon']; ?>">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_slide', 'kong_slide_callback');
function kong_slide_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'heading' => KongPageBuilderClient::KONG_DUMB_HEADING,
        'desc' => KongPageBuilderClient::KONG_DUMB_PARAGRAPH,
        'btn_left_text' => '',
        'image' => json_encode(array('url' => '')),
        'btn_left_link' => json_encode(array(
            'url' => '#',
            'new_tab' => 'false'
        )),
        'btn_right_text' => '',
        'btn_right_link' => json_encode(array(
            'url' => '#',
            'new_tab' => 'false'
        ))
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    ob_start(); ?>
    <div class="kong-slideshow__item <?php echo $attrs['class_id']; ?>">
        <div class="kong-slideshow__content">
            <h4 class="kong-slideshow__heading"><?php echo $attrs['heading']; ?></h4>
            <p class="kong-slideshow__desc"><?php echo $attrs['desc']; ?></p>
            <div class="kong-slideshow__btnContainer">
                <?php
                if($attrs['btn_left_text']){
                    $attrs['btn_left_link'] = json_decode($attrs['btn_left_link'], true);

                    if (!empty($attrs['btn_left_link']['url'])) {
                        $target = kong_to_boolean($attrs['btn_left_link']['new_tab']) ? ' target="_blank"' : '';
                        $link_before = '<a href="' . $attrs['btn_left_link']['url'] . '" class="kong-slideshow__btn kong-slideshow__btn--left"' . $target . '>';
                        $link_after = '</a>';
                    } else {
                        $link_before = '<span class="kong-slideshow__btn kong-slideshow__btn--left">';
                        $link_after = '</span>';
                    }

                    echo $link_before . html_entity_decode($attrs['btn_left_text']) . $link_after;
                }
                if($attrs['btn_right_text']){
                    $attrs['btn_right_link'] = json_decode($attrs['btn_right_link'], true);

                    if (!empty($attrs['btn_right_link']['url'])) {
                        $target = kong_to_boolean($attrs['btn_right_link']['new_tab']) ? ' target="_blank"' : '';
                        $link_before = '<a href="' . $attrs['btn_right_link']['url'] . '" class="kong-slideshow__btn kong-slideshow__btn--right"' . $target . '>';
                        $link_after = '</a>';
                    } else {
                        $link_before = '<span class="kong-slideshow__btn kong-slideshow__btn--right">';
                        $link_after = '</span>';
                    }

                    echo $link_before . html_entity_decode($attrs['btn_right_text']) . $link_after;
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}