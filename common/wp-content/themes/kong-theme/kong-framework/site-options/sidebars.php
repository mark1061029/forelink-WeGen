<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("sidebars", array(
    "side" => "backend",
    "icon" => "th-list",
    "name" => "Sidebars",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Sidebar List",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "sidebars",
                    "attrs" => array(
                        "type" => "field-generator",
                        "config" => array(
                            "placeholder" => "Sidebar Name",
                            "maxlength" => 30
                        ),
                        "desc" => "This panel contains the Interface to create and manage sidebars. There is no limit for number of sidebars, which can be used in different Posts, Pages. You can add widgets to the sidebars via <a href=".get_site_url()."/wp-admin/widgets.php target=_blank>this page</a>"
                    )
                )
            ]
        )
    ]
));

?>