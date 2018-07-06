<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("maintenance_page", array(
    "icon" => "steam",
    "name" => "Maintenance Mode",
    "side" => "backend",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Maintenance Page",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "maintenance_enable",
                    "attrs" => array(
                        "type" => "switch",
                        "desc" => "Enable the maintenance mode to let visitors know your website is down for maintenance, or add a coming soon page in the case you are building your new website. User with admin rights still gets full access to the website including the front end"
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@options.maintenance_enable",
                    "tag" => "editor-field",
                    "bind_to" => "maintenance_page_id",
                    "attrs" => array(
                        "type" => "selection-loader",
                        "config" => array(
                            "url" => "kong-website-builder/v1/pages",
                            "rest_url" => true,
                            "name" => "page"
                        ),
                        "label" => "Page Selection",
                        "desc" => "Select a page to be the maintenance page. Visitors will be redirected to that page when visiting the site."
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
));

?>