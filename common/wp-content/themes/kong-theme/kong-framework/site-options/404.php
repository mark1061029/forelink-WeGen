<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("error_page", array(
        "icon" => "frown-o",
        "name" => "404 Page",
        "side" => "backend",
        "models" => [
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Error Page",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "error_page_id",
                        "attrs" => array(
                            "type" => "selection-loader",
                            "config" => array(
                                "url" => "kong-website-builder/v1/pages",
                                "rest_url" => true,
                                "name" => "page"
                            ),
                            "desc" => "Select the page when users will be redirected to after they visit a broken or dead link."
                        ),
                        "default_value" => ""
                    )
                ]
            )
        ]
    )
);

?>