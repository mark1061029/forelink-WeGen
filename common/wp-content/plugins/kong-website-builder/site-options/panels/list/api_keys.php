<?php
$manager = KongOptionsManager::getInstance();

$manager::addPanel("third_party", array(
    "side" => "backend",
    "icon" => "key",
    "name" => "Third Party Keys"
));

$manager::addChildPanel("instagram_setting", "third_party", array(
    "name" => "Instagram",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Instagram",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "attrs" => array(
                        "type" => "desc",
                        "fullwidth" => "true",
                        "config" => array(
                            "message" => "Register and fulfill Instagram API keys into the below fields. All Instagram Widgets from the theme scope used to add Instagram photos to your site will be based on these keys. You can follow <a href=http://docs.kolumn.io/kong/v1/guide/theme-options/third-party-keys.html#Instagram target=_blank>the document</a> to get the detailed instruction to register the keys."
                        )
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "instagram_access_token",
                    "attrs" => array(
                        "label" => "Access Token",
                        "type" => "text",
                        "desc" => "This token is required by authenticated request."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "instagram_username",
                    "attrs" => array(
                        "label" => "Username",
                        "type" => "text",
                        "desc" => "Specify your Instagram username."
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
));

$manager::addChildPanel("twitter_setting", "third_party", array(
    "name" => "Twitter",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Twitter",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "attrs" => array(
                        "type" => "desc",
                        "fullwidth" => "true",
                        "config" => array(
                            "message" => "Register and fulfill Twitter API keys into the below fields. All Twitter Widgets from the theme scope used to display your Twitter feed into this site will be based on these keys. You can follow <a href=http://docs.kolumn.io/kong/v1/guide/theme-options/third-party-keys.html#Twitter target=_blank>the document</a> to get the detailed instruction to register the keys."
                        )
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "twitter_username",
                    "attrs" => array(
                        "label" => "Username",
                        "type" => "text",
                        "desc" => "Specify your Twitters username."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "twitter_consumer_key",
                    "attrs" => array(
                        "label" => "Consumer Key",
                        "type" => "text",
                        "desc" => "Specify your consumer key (API key)."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "twitter_consumer_secret",
                    "attrs" => array(
                        "label" => "Consumer Secret",
                        "type" => "text",
                        "desc" => "Specify your consumer secret (API secret)."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "twitter_access_token",
                    "attrs" => array(
                        "label" => "Access Token",
                        "type" => "text",
                        "desc" => "This token is used to make API requests on your own accounts behalf."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "twitter_access_token_secret",
                    "attrs" => array(
                        "label" => "Access Token Secret",
                        "type" => "text",
                        "desc" => "Specify your access token secret."
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
));

$manager::addChildPanel("flickr_setting", "third_party", array(
    "name" => "Flickr",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Flickr",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "attrs" => array(
                        "type" => "desc",
                        "fullwidth" => "true",
                        "config" => array(
                            "message" => "Register and fulfill Flickr API keys into the below fields. All Flickr Widgets from the theme scope used to add Flickr photos to your site will be based on these keys. You can follow <a href=http://docs.kolumn.io/kong/v1/guide/theme-options/third-party-keys.html#Flickr target=_blank>the document</a> to get the detailed instruction to register the keys."
                        )
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "flickr_api_key",
                    "attrs" => array(
                        "label" => "API Key",
                        "type" => "text",
                        "desc" => "This key is used to track API usage (commercial or non-commercial)."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "flickr_user_id",
                    "attrs" => array(
                        "label" => "User ID",
                        "type" => "text",
                        "desc" => "Specify your Flickrs User ID"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
));

$manager::addChildPanel("google_map_setting", "third_party", array(
    "name" => "Google Map",
    "models" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Google Map",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "attrs" => array(
                        "type" => "desc",
                        "fullwidth" => "true",
                        "config" => array(
                            "message" => "Register and fulfill Google Map API key into the below fields. All Map Widgets from the theme scope used to display Google maps on your site will be based on the key. You can follow <a href=http://docs.kolumn.io/kong/v1/guide/theme-options/third-party-keys.html#map target=_blank>the document</a> to get the detailed instruction to register the key."
                        )
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "google_map_api_key",
                    "attrs" => array(
                        "label" => "API Key",
                        "type" => "text",
                        "desc" => "This API key allows you to monitor your applications API usage in the Google API Console"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
));
?>