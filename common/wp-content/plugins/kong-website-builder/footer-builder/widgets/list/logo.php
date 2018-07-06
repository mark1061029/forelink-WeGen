<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Logo",
    "tag" => "logo",
    "keywords" => ["logo"],
    "native" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Logo",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.img",
                    "attrs" => array(
                        "label" => "Image",
                        "type" => "upload-image",
                        "config" => array(
                            "contain" => true
                        )
                    ),
                    "default_value" => array(
                        "url" => ""
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.new_tab",
                    "attrs" => array(
                        "label" => "New Tab",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.custom_link",
                    "attrs" => array(
                        "label" => "Custom Link",
                        "type" => "switch",
                        "desc" => "Use your own link instead of the default home page URL."
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.link",
                    "if" => "@attrs.custom_link",
                    "attrs" => array(
                        "label" => "Link",
                        "type" => "text"
                    ),
                    "default_value" => "#"
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Size",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "min" => 0,
                            "max" => 1000,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id img" => array(
                            "width" => "{{@model}}"
                        ),
                        "@id" => array(
                            "minWidth" => "{{@model}}"
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
                        "label" => "Custom Class",
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
<div class="kong-dnd__emptyItem kong-dnd__emptyItem--h" style="height:80px;" ng-if="!$ctrl.edited.attrs.img.url">
    <span class="kong-dnd__emptyItem__label">Logo</span>
</div>

<a class="kong-logo {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]">
    <img class="kong-logo__image" ng-src="{{$ctrl.edited.attrs.img.url}}"/>
</a>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lfb_logo', 'lfb_logo_callback');
function lfb_logo_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'link' => '#',
        'custom_link' => 'false',
        'new_tab' => 'false',
        'img' => json_encode(array(
            'url' => ''
        )),
        'hidden' => '',
        'class' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if (kong_to_boolean($attrs['custom_link'])) {
        $link = $attrs['link'];
    } else {
        $link = get_home_url();
    }

    $classes[] = $attrs['class_id'];

    if ($link) {
        $target = kong_to_boolean($attrs['new_tab']) ? ' target="_blank"' : '';
        $before_link = '<a href="' . $link . '" class="kong-logo ' . implode(' ', $classes) . '"' . $target . '>';
        $after_link = '</a>';
    } else {
        $before_link = '<span class="kong-logo ' . implode(' ', $classes) . '">';
        $after_link = '</span>';
    }

    $attrs['img'] = json_decode($attrs['img'], true);

    $html = $before_link .'<img class="kong-logo__image" src="'.$attrs['img']['url'].'"/>'. $after_link;

    return $html;
}