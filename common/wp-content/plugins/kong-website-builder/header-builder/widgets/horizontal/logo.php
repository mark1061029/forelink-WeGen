<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Logo",
    "tag" => "h_logo",
    "keywords" => ["logo"],
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
                        "type" => "upload-image",
                        "config" => array(
                            "contain" => true
                        )
                    ),
                    "default_value" => array(
                        "url" => ""
                    ),
                    "styles" => array(
                        "@id" => array(
                            "backgroundImage" => "url({{@model.url}})"
                        )
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
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 500,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 50
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "height" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.width",
                    "attrs" => array(
                        "label" => "Width",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 500,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 100
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "width" => "{{@model}}px"
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
    <span class="kong-dnd__emptyItem__label">Logo</span>
</div>

<a class="kong-header__logo {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]"></a>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_h_logo', 'lhb_h_logo_callback');
function lhb_h_logo_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'link' => '#',
        'custom_link' => 'false',
        'new_tab' => 'false',
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
        $before_link = '<a href="' . $link . '" class="kong-header__logo ' . implode(' ', $classes) . '"' . $target . '>';
        $after_link = '</a>';
    } else {
        $before_link = '<span class="kong-header__logo ' . implode(' ', $classes) . '">';
        $after_link = '</span>';
    }

    $html = $before_link . $after_link;

    return $html;
}