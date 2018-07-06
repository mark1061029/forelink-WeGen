<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Flickr",
    "tag" => "flickr",
    "keywords" => ["flickr"],
    "native" => true,
    "filter" => "image",
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
                    "bind_to" => "@attrs.column",
                    "attrs" => array(
                        "label" => "Column",
                        "type" => "res-selection",
                        "config" => array(
                            "50%" => "2 Columns",
                            "33.33%" => "3 Columns",
                            "25%" => "4 Columns",
                            "20%" => "5 Columns",
                            "16.666%" => "6 Columns",
                            "14.285%" => "7 Columns",
                            "12.5%" => "8 Columns",
                            "11.11%" => "9 Columns",
                            "10%" => "10 Columns"
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "20%"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-gallery__item" => array(
                            "width" => "{{@model}}"
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
                        "@id .kong-gallery" => array(
                            "margin" => "{{@model}}px"
                        ),
                        "@id.kong-gallery--noGutter .kong-gallery" => array(
                            "margin" => "0 -{{@model}}px"
                        ),
                        "@id .kong-gallery__item" => array(
                            "padding" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.gutter",
                    "attrs" => array(
                        "label" => "Gutter",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.overlay",
                    "attrs" => array(
                        "label" => "Overlay",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "rgba(0,0,0,0.4)",
                    "styles" => array(
                        "@id .kong-gallery__item__wrap:before" => array(
                            "backgroundColor" => "{{@model}}"
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
                "label" => "Class",
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
                )
            ]
        )
    ]
);

ob_start();
?>
<div class="{{::$ctrl.getID()}}" ng-class="[{'kong-gallery--noGutter' : !$ctrl.edited.attrs.gutter},$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]"
     kong-flickr number-items="$ctrl.edited.attrs.num"></div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lfb_flickr', 'lfb_flickr_callback');
function lfb_flickr_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'hidden' => '',
        'gutter' => 'false',
        'num' => 12
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if (!kong_to_boolean($attrs['gutter'])) {
        $classes[] = 'kong-gallery--noGutter';
    }

    $classes[] = $attrs['class_id'];

    ob_start(); ?>
    <div class="<?php echo implode(' ', $classes); ?>">
        <div class="kong-flickr kong-gallery"
             data-template='<div class="kong-gallery__item"><a class="kong-gallery__item__wrap" href="{{href}}" title="{{title}}" target="_blank"><img src="{{src}}" alt="{{alt}}"/></a></div>'
             data-num="<?php echo $attrs['num'] ?>">
            <div class="kong-contentLoader"><span></span><span></span><span></span></div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}