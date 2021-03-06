<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Image",
    "tag" => "h_image",
    "keywords" => ["image"],
    "native" => true,
    "h_nav" => true,
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
                    "bind_to" => "@attrs.img",
                    "attrs" => array(
                        "label" => "Logo",
                        "type" => "upload-image"
                    ),
                    "default_value" => array(
                        "url" => ""
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Link",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.link",
                    "attrs" => array(
                        "label" => "Link",
                        "type" => "link"
                    ),
                    "default_value" => array(
                        "url" => "#",
                        "new_tab" => false
                    )
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
                    "bind_to" => "@attrs.width",
                    "attrs" => array(
                        "label" => "Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 10,
                                "max" => 1000,
                                "step" => 1
                            )
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "200px"
                    ),
                    "responsive_styles" => array(
                        "@id img" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 10,
                                "max" => 1000,
                                "step" => 1
                            )
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100px"
                    ),
                    "responsive_styles" => array(
                        "@id img" => array(
                            "maxHeight" => "{{@model}}"
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
                            "borderRadius" => "{{@model}}%"
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
<div class="kong-dnd__emptyItem kong-dnd__emptyItem--h" style="width:140px;" ng-if="!$ctrl.edited.attrs.img.url">
    <span class="kong-dnd__emptyItem__label">Image</span>
</div>

<a class="kong-header__image {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]">
    <img ng-src="{{$ctrl.edited.attrs.img.url}}"/>
</a>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_h_image', 'lhb_h_image_callback');
function lhb_h_image_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'link' => json_encode(array(
            'url' => '#',
            'new_tab' => 'false'
        )),
        'img' => json_encode(array(
            'url' => ''
        )),
        'hidden' => '',
        'class' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();
    $target = '';

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    $classes[] = $attrs['class_id'];
    $link = json_decode($attrs['link'], true);
    $attrs['img'] = json_decode($attrs['img'], true);

    if ($link['url']){
        if (kong_to_boolean($link['new_tab'])) {
            $target = ' target="_blank"';
        }
        $html = '<a href="' . $link['url'] . '" class="kong-header__image ' . implode(' ', $classes) .'"' . $target . '>';
        $html .= '<img src="'.$attrs['img']['url'].'"/>';
        $html .= '</a>';
    } else {
        $html = '<div class="kong-header__image ' . implode(' ', $classes) .'">';
        $html .= '<img src="'.$attrs['img']['url'].'"/>';
        $html .= '</div>';
    }

    return $html;
}