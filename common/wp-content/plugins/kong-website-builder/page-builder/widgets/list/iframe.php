<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Iframe",
    "tag" => "iframe",
    "keywords" => ["youtube","video","video","iframe"],
    "native" => true,
    "filter" => "media",
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
                    "bind_to" => "@attrs.iframe",
                    "attrs" => array(
                        "label" => "Link",
                        "type" => "iframe",
                        "desc" => "Copy embeded Iframe link from Youtube, Vimeo, etc and paste it into this field."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "selection",
                        "config" => array(
                            "16by9" => "16:9",
                            "4by3" => "4:3",
                            "custom" => "Custom"
                        )
                    ),
                    "default_value" => "16by9"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.padding",
                    "show" => "@attrs.size == 'custom'",
                    "attrs" => array(
                        "label" => "Custom Height",
                        "type" => "unit",
                        "config" => array(
                            "units" => ["px","%","vh"]
                        )
                    ),
                    "default_value" => "56%",
                    "styles" => array(
                        "@id .kong-embed__container--custom" => array(
                            "paddingBottom" => "{{@model}}"
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
    ]
);

ob_start();
?>
<div class="kong-dnd__emptyItem" style="height:100px;" ng-if="!$ctrl.edited.attrs.iframe">
    <span class="kong-dnd__emptyItem__label">IFRAME</span>
</div>

<div class="kong-embed {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]" id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-embed__container" ng-class="'kong-embed__container--'+$ctrl.edited.attrs.size">
        <iframe ng-src="{{$ctrl.edited.attrs.iframe | trustAsResourceUrl}}"></iframe>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_iframe', 'kong_iframe_callback');
function kong_iframe_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'size' => '16by9',
        'iframe' => ''
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
    <div class="kong-embed <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <div class="kong-embed__container kong-embed__container--<?php echo $attrs['size']; ?>">
            <iframe src="<?php echo $attrs['iframe']; ?>"></iframe>
        </div>
    </div>
    <?php
    return ob_get_clean();
}