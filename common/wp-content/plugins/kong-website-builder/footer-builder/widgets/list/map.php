<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Map",
    "tag" => "map",
    "keywords" => ["google map"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Map Data",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.lat",
                    "attrs" => array(
                        "label" => "Latitude",
                        "type" => "text"
                    ),
                    "default_value" => "59.327"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.lng",
                    "attrs" => array(
                        "label" => "Longitude",
                        "type" => "text"
                    ),
                    "default_value" => "18.067"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => ["px","%","vh"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "56%"
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "paddingBottom" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 1000,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.style",
                    "attrs" => array(
                        "label" => "Style",
                        "type" => "textarea",
                        "desc" => "Get styles from <a target='_blank' href='https://snazzymaps.com'>snazzymaps.com</a>"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.zoom",
                    "attrs" => array(
                        "label" => "Zoom",
                        "type" => "slider",
                        "config" => array(
                            "min" => 3,
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => 8
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Markers",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model",
                    "attrs" => array(
                        "label" => "Makers",
                        "type" => "item-group"
                    ),
                    "default_value" => []
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
        "name" => "Marker",
        "tag" => "marker",
        "native" => true,
        "content" => [
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Identity",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.name",
                        "attrs" => array(
                            "label" => "Name",
                            "type" => "text"
                        ),
                        "default_value" => ""
                    )
                ]
            ),
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Marker",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.center",
                        "attrs" => array(
                            "label" => "Center",
                            "type" => "switch"
                        ),
                        "default_value" => true
                    ),
                    array(
                        "if" => "!@attrs.center",
                        "content" => [
                            array(
                                "tag" => "editor-field",
                                "bind_to" => "@attrs.lat",
                                "attrs" => array(
                                    "label" => "Latitude",
                                    "type" => "text"
                                ),
                                "default_value" => "59.327"
                            ),
                            array(
                                "tag" => "editor-field",
                                "bind_to" => "@attrs.lng",
                                "attrs" => array(
                                    "label" => "Longitude",
                                    "type" => "text"
                                ),
                                "default_value" => "18.067"
                            )
                        ]
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.icon",
                        "attrs" => array(
                            "label" => "Icon",
                            "type" => "upload-image"
                        ),
                        "default_value" => array(
                            "url" => ""
                        )
                    ),
                    array(
                        "if" => "@attrs.icon",
                        "content" => [
                            array(
                                "tag" => "editor-field",
                                "bind_to" => "@attrs.width",
                                "attrs" => array(
                                    "label" => "Width",
                                    "type" => "slider",
                                    "config" => array(
                                        "min" => 20,
                                        "max" => 300,
                                        "step" => 1
                                    )
                                ),
                                "default_value" => 50
                            ),
                            array(
                                "tag" => "editor-field",
                                "bind_to" => "@attrs.height",
                                "attrs" => array(
                                    "label" => "Height",
                                    "type" => "slider",
                                    "config" => array(
                                        "min" => 20,
                                        "max" => 300,
                                        "step" => 1
                                    )
                                ),
                                "default_value" => 50
                            )
                        ]
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.animation",
                        "attrs" => array(
                            "label" => "Animation",
                            "type" => "switch"
                        ),
                        "default_value" => false
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-gmap {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-gmap__container" kong-google-map map-zoom="$ctrl.edited.attrs.zoom"
         map-style="$ctrl.edited.attrs.style"
         map-lat="$ctrl.edited.attrs.lat"
         map-lng="$ctrl.edited.attrs.lng"
         map-markers="$ctrl.content"></div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('lfb_map', 'lfb_map_callback');
function lfb_map_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'zoom' => 8,
        'style' => '',
        'lat' => '59.327',
        'lng' => '18.067'
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];

    ob_start(); ?>
    <div class="kong-gmap <?php echo implode(' ', $classes); ?>" id="<?php echo $attrs['id'] ?>">
        <div class="kong-gmap__container"
             data-zoom="<?php echo $attrs['zoom']; ?>"
             data-style="<?php echo esc_attr($attrs['style']); ?>"
             data-lat="<?php echo $attrs['lat']; ?>"
             data-lng="<?php echo $attrs['lng']; ?>"
             data-id="<?php echo $attrs['class_id']; ?>">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}


add_shortcode('lfb_marker', 'lfb_marker_callback');
function lfb_marker_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'center' => 'true',
        'lat' => '59.327',
        'lng' => '18.067',
        'icon' => json_encode(array('url' => '')),
        'width' => 50,
        'height' => 50,
        'animation' => 'false'
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['icon'] = json_decode($attrs['icon'], true);

    ob_start(); ?>
    <div class="kong-marker <?php echo $attrs['class_id']; ?>"
         data-center="<?php echo $attrs['center']; ?>"
         data-lat="<?php echo $attrs['lat']; ?>"
         data-lng="<?php echo $attrs['lng']; ?>"
         data-icon="<?php echo $attrs['icon']['url']; ?>"
         data-width="<?php echo $attrs['width']; ?>"
         data-height="<?php echo $attrs['height']; ?>"
         data-animation="<?php echo $attrs['animation']; ?>"></div>
    <?php
    return ob_get_clean();
}
