<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "App Store",
    "tag" => "app_store_badge",
    "keywords" => ["app store","market","button"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Badges",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon",
                    "attrs" => array(
                        "label" => "Icon",
                        "type" => "selection",
                        "config" => array(
                            "apple" => "Apple App Store",
                            "google" => "Google Play Store",
                            "amazon" => "Amazon Store",
                            "window" => "Window Store",
                            "image" => "Upload Image"
                        )
                    ),
                    "default_value" => "apple"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.image",
                    "if" => "@attrs.icon == 'image'",
                    "attrs" => array(
                        "label" => "Image",
                        "type" => "upload-image"
                    ),
                    "default_value" => array(
                        "url" => ""
                    )
                ),
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.width",
                    "attrs" => array(
                        "label" => "Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 300,
                                "step" => 1
                            ),
                            "units" => ["px","%"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "150px"
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "minWidth" => "{{@model}}",
                            "width" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Animation",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.animation",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "animation"
                    ),
                    "default_value" => array(
                        "enable" => false,
                        "distance" => "0px",
                        "rotate" => array(
                            "x" => 0,
                            "y" => 0,
                            "z" => 0
                        ),
                        "origin" => "bottom",
                        "easing" => "ease",
                        "delay" => 0,
                        "duration" => 1000,
                        "opacity" => 0,
                        "scale" => 1,
                        "viewFactor" => 0.2,
                        "reset" => false
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
                        "type" => "class",
                        "config" => ["Hover.css","Hover Effect"]
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
<div class="kong-dnd__emptyItem" style="height:50px;" ng-if="!$ctrl.edited.attrs.image.url && $ctrl.edited.attrs.icon == 'image'">
    <span class="kong-dnd__emptyItem__label">App Store</span>
</div>

<a class="kong-appStoreBadge {{::$ctrl.getID()}}" href="#" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
    <img ng-if="$ctrl.edited.attrs.icon == 'image'" ng-src="{{$ctrl.edited.attrs.image.url}}"/>
    <img ng-if="$ctrl.edited.attrs.icon != 'image'" ng-src="<?php echo $manager::$dirs['client_img']; ?>/badge/{{$ctrl.edited.attrs.icon}}.png"/>
</a>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_app_store_badge', 'kong_app_store_badge_callback');
function kong_app_store_badge_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'icon' => 'apple',
        'image' => json_encode(array(
            'url' => ''
        )),
        'animation' => json_encode(array(
            'enable' => 'false',
            'delay' => 0,
            'duration' => 1000,
            'opacity' => 0,
            'rotate' => array('x' => 0, 'y' => 0, 'z' => 0),
            'origin' => 'bottom',
            'distance' => '20px',
            'scale' => 1,
            'easing' => 'ease',
            'reset' => 'false'
        )),
        'link' => json_encode(array(
            'url' => '#',
            'new_tab' => 'false'
        ))
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $animation = kong_form_animation_data($attrs['animation']);

    $classes[] = $attrs['class_id'];

    $attrs['link'] = json_decode($attrs['link'], true);
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    if (!empty($attrs['link']['url'])) {
        $target = kong_to_boolean($attrs['link']['new_tab']) ? ' target="_blank"' : '';
        $link_before = '<a href="' . $attrs['link']['url'] . '" class="kong-appStoreBadge ' . implode(' ', $classes) . '"' . $id . $animation . $target . '>';
        $link_after = '</a>';
    } else {
        $link_before = '<span class="kong-appStoreBadge ' . implode(' ', $classes) . '"' . $id . $animation . '>';
        $link_after = '</span>';
    }

    ob_start();

    echo $link_before;

    if ($attrs['icon'] == 'image') {
        $attrs['image'] = json_decode($attrs['image'], true);
        echo '<img src="' . $attrs['image']['url'] . '"/>';
    } else {
        echo '<img src="' . KONG_CORE_ROOT . '/client/img/badge/' . $attrs['icon'] . '.png"/>';
    }

    echo $link_after;

    return ob_get_clean();
}
