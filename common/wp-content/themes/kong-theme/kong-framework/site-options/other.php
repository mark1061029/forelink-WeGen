<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("other", array(
    "icon" => "plus",
    "name" => "Other",
    "side" => "frontend"
), 999);

$manager::addChildPanel("animated_link", "other", array(
    "name" => "Animated Link",
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
                    "bind_to" => "animated_link_enable",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "If this feature is enabled, then when users click on a certain link or button, the page will animate to fade out and scroll top before redirecting"
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "if" => "@options.animated_link_enable",
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Settings",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "animated_link_selector",
                    "attrs" => array(
                        "label" => "Additional Selectors",
                        "type" => "textarea",
                        "desc" => "By default, the script will automatically look up the links belonging to your site domain. Apart from that, enter the class or id of elements you want to trigger the effect. The selectors area separated by a comma"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "animated_link_delay",
                    "attrs" => array(
                        "label" => "Delay",
                        "type" => "number",
                        "config" => array(
                            "min" => 1000,
                            "max" => 3000,
                            "step" => 50,
                            "unit" => "miliSeconds"
                        ),
                        "desc" => "Specify the time for the fadeout effect"
                    ),
                    "default_value" => 1500
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "animated_link_scroll_top",
                    "attrs" => array(
                        "label" => "Scroll Top",
                        "type" => "switch",
                        "desc" => "Enable the button to animate the page to scroll to top before the fading out effect"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "animated_link_scroll_delay",
                    "if" => "@options.animated_link_scroll_top",
                    "attrs" => array(
                        "label" => "Scroll Delay",
                        "type" => "number",
                        "config" => array(
                            "min" => 500,
                            "max" => 3000,
                            "step" => 50,
                            "unit" => "miliSeconds"
                        ),
                        "desc" => "Specify the time for animating scroll to top of the page"
                    ),
                    "default_value" => 1000
                )
            ]
        )
    ]
));

$manager::addChildPanel("error_message", "other", array(
    "name" => "Error Message",
    "side" => "frontend",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Information",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "desc",
                        "config" => array(
                            "message" => "This panel provides options to change color and background of error messages. The kind of messages will be displayed if a part of site content is unable to load."
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Coloring",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "error_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#fadede",
                    "styles" => array(
                        ".kong-errorMessage" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "error_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ff3232",
                    "styles" => array(
                        ".kong-errorMessage, .kong-errorMessage a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "Border",
                    "attrs" => array(
                        "label" => "Border",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ff6d6d",
                    "styles" => array(
                        ".kong-errorMessage" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        )
    ]
));

$manager::addChildPanel("go_top_button", "other", array(
    "name" => "Go Top Button",
    "side" => "frontend",
    "direct_links" => array(
        ".kong-siteGoTopBtn" => array(
            "position" => array(
                "top" => "-10px",
                "left" => "0"
            )
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
                    "bind_to" => "go_top_button_enable",
                    "reload" => true,
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Enable the button to help users to reach the top of the page faster."
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "if" => "@options.go_top_button_enable",
            "content" => [
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "General Setting",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "go_top_time",
                            "attrs" => array(
                                "label" => "Go Top Time",
                                "type" => "number-watch-attr",
                                "config" => array(
                                    "setting" => array(
                                        "min" => 0,
                                        "max" => 3000,
                                        "step" => 50
                                    ),
                                    "unit" => "miliseconds",
                                    "selector" => ".kong-siteGoTopBtn",
                                    "attr" => "data-time"
                                )
                            ),
                            "default_value" => 1000
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "go_top_show_when",
                            "attrs" => array(
                                "label" => "Show When",
                                "type" => "number",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 100,
                                    "step" => 1,
                                    "unit" => "percent"
                                ),
                                "desc" => "Specify the percentage of page height from the top when scrolling down to show the button"
                            ),
                            "default_value" => 10
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "go_top_zindex",
                            "attrs" => array(
                                "label" => "z-index",
                                "type" => "number",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 99999,
                                    "step" => 10,
                                    "unit" => ""
                                )
                            ),
                            "default_value" => 999,
                            "styles" => array(
                                ".kong-siteGoTopBtn" => array(
                                    "zIndex" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Icon",
                        "collapsed" => false
                    ),
                    "content" => [

                        array(
                            "tag" => "editor-field",
                            "bind_to" => "go_top_bg_color",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                ".kong-siteGoTopBtn" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "go_top_color",
                            "attrs" => array(
                                "label" => "Icon Color",
                                "type" => "colorpicker",
                                "desc" => "Enable the button in order to help users to reach the top of the page faster"
                            ),
                            "default_value" => $manager::$colors["primary_context"],
                            "styles" => array(
                                ".kong-siteGoTopBtn" => array(
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

?>