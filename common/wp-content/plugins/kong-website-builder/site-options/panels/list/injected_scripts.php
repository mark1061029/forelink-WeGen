<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("injected_scripts", array(
    "icon" => "code",
    "name" => "Injected Scripts",
    "side" => "backend"
));

$manager::addChildPanel("custom_css", "injected_scripts", array(
    "name" => "Custom CSS",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Custom CSS",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "attrs" => array(
                        "type" => "desc",
                        "fullwidth" => "true",
                        "config" => array(
                            "message" => "This area is designed to inject custom CSS code into your site. However, consider to switch to the Theme Stylist for live editing."
                        )
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "custom_css",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "code-editor",
                        "config" => array(
                            "options" => array(
                                "mode" => "css"
                            )
                        )
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
));

$manager::addChildPanel("custom_js", "injected_scripts", array(
    "name" => "Custom JavaScript",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Custom JavaScript",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "attrs" => array(
                        "type" => "desc",
                        "fullwidth" => "true",
                        "config" => array(
                            "message" => "This area is designed to inject custom JavaScript code into your site. Please notice that the injected code by default is surrounded by a try catch statement to ensure it does not break other scripts."
                        )
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "custom_js",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "code-editor",
                        "config" => array(
                            "options" => array(
                                "mode" => "javascript"
                            )
                        )
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
));

$manager::addChildPanel("google_analytics", "injected_scripts", array(
    "name" => "Google Analytics",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Injected Google Analytic Code",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "attrs" => array(
                        "type" => "desc",
                        "fullwidth" => "true",
                        "config" => array(
                            "message" => "This area is designed to inject custom analytic JavaScript code from Google for measuring how users interact with your website."
                        )
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "google_analytics",
                    "attrs" => array(
                        "fullwidth" => true,
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
        )
    ]
));

$manager::addChildPanel("enqueue_script", "injected_scripts", array(
    "name" => "Enqueue Scripts",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Enqueue Script and Stylesheet",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "attrs" => array(
                        "type" => "desc",
                        "fullwidth" => "true",
                        "config" => array(
                            "message" => "This area is designed to inject additional CSS or JavaScript files into your site through WordPress Standard APIs, please check out <a href=https://developer.wordpress.org/themes/basics/including-css-javascript target=_blank>this link</a> for more detail."
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "enqueue_scripts",
                    "attrs" => array(
                        "label" => "JavaScript Files",
                        "type" => "enqueue-scripts",
                        "desc" => "This field provides the feature to include additional javascript file into your Site via WordPress <a href=https://developer.wordpress.org/reference/functions/wp_enqueue_script/ target=_blank>wp_enqueue_script API</a>. Please remember to enable the switch button on the right side of each item if you want to inject it into your site."
                    ),
                    "default_value" => array(
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "enqueue_styles",
                    "attrs" => array(
                        "label" => "CSS Files",
                        "type" => "enqueue-styles",
                        "desc" => "This field provides the feature to include additional CSS file into your Site via WordPress <a href=https://developer.wordpress.org/reference/functions/wp_enqueue_style/ target=_blank>wp_enqueue_style API</a>. Please remember to enable the switch button on the right side of each item if you want to inject it into your site."
                    ),
                    "default_value" => array(
                    )
                )
            ]
        )
    ]
));

?>