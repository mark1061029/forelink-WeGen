<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Flickr",
    "tag" => "v_flickr",
    "keywords" => ["flickr"],
    "native" => true,
    "v_nav" => true,
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
                    "bind_to" => "@attrs.num",
                    "attrs" => array(
                        "label" => "Number of Pictures",
                        "type" => "number",
                        "config" => array(
                            "min" => 4,
                            "max" => 32,
                            "step" => 1
                        )
                    ),
                    "default_value" => 12
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 36,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 40,
                    "styles" => array(
                        "@id .kong-aside__mediaStream__item" => array(
                            "width" => "{{@model}}px",
                            "height" => "{{@model}}px"
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
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id img" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.spacing",
                    "attrs" => array(
                        "label" => "Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 15,
                            "step" => 1
                        )
                    ),
                    "default_value" => 1,
                    "styles" => array(
                        "@id .kong-aside__mediaStream" => array(
                            "margin" => "0 -{{@model}}px"
                        ),
                        "@id .kong-aside__mediaStream__item" => array(
                            "padding" => "0 {{@model}}px"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hidden & Class",
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.class",
                    "attrs" => array(
                        "label" => "Class",
                        "type" => "text"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
);

ob_start();
?>
<div class="{{::$ctrl.getID()}}" kong-flickr number-items="$ctrl.edited.attrs.num"></div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_v_flickr', 'lhb_v_flickr_callback');
function lhb_v_flickr_callback($attrs) {
    $attrs = shortcode_atts(array(
        'num' => 12,
        'hidden' => '',
        'class' => '',
        'class_id' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = [];

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    $classes[] = $attrs['class_id'];

    ob_start();
    ?>

    <div class="kong-aside__mediaStream kong-flickr <?php echo implode(' ', $classes); ?>"
         data-template='<div class="kong-aside__mediaStream__item"><a href="{{href}}" title="{{title}}" target="_blank"><img src="{{src}}" alt="{{alt}}" /></a></div>'
         data-num="<?php echo $attrs['num']; ?>">
        <div class="kong-contentLoader"><span></span><span></span><span></span></div>
    </div>

    <?php
    return ob_get_clean();
}