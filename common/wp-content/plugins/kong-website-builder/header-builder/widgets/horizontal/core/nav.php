<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "tag" => "h_nav",
    "name" => "Horizontal Nav",
    "native" => true,
    "core" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "collapsed" => false,
                "label" => "Hidden on"
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
                "collapsed" => false,
                "label" => "Content"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.zIndex",
                    "attrs" => array(
                        "label" => "Z-Index",
                        "type" => "number",
                        "config" => array(
                            "min" => 0,
                            "max" => 999999,
                            "step" => 1
                        )
                    ),
                    "default_value" => 9,
                    "styles" => array(
                        "@id" => array(
                            "zIndex" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.scroll_class",
                    "attrs" => array(
                        "label" => "Scroll Class",
                        "type" => "text",
                        "desc" => "Enter a CSS Class into this field. When you start to scroll down the page, the class will be added to this Header."
                    ),
                    "default_value" => ""
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "collapsed" => false,
                "label" => "Style"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_style",
                    "attrs" => array(
                        "label" => "Style",
                        "type" => "background-style",
                        "config" => array(
                            "none" => true,
                            "color" => true,
                            "image" => true,
                            "gradient" => true,
                            "video" => false
                        )
                    ),
                    "default_value" => "color"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "if" => "@attrs.bg_style == 'color'",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["body"],
                    "styles" => array(
                        "@id" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.gradient",
                    "if" => "@attrs.bg_style == 'gradient'",
                    "attrs" => array(
                        "type" => "gradient",
                        "label" => "Gradient",
                        "config" => array(
                            "radial" => false
                        )
                    ),
                    "default_value" => array(
                        "color_1" => "#f6fbfc",
                        "color_2" => "#f5f7fc",
                        "color_3" => "#e2e6f4",
                        "angle" => 180,
                        "value" => "linear-gradient(180deg, #f6fbfc, #f5f7fc, #e2e6f4)"
                    ),
                    "styles" => array(
                        "@id.kong-header--background-gradient" => array(
                            "background" => "{{@model.value}}"
                        )
                    )
                ),
                array(
                    "if" => "@attrs.bg_style == 'image'",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.bg_image",
                            "attrs" => array(
                                "label" => "Image URL",
                                "type" => "upload-image"
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
                            "bind_to" => "@attrs.bg_props",
                            "attrs" => array(
                                "fullwidth" => true,
                                "type" => "background-props"
                            ),
                            "default_value" => array(
                                "repeat" => "no-repeat",
                                "position" => "50% 50%",
                                "size" => "cover",
                                "attachment" => "scroll"
                            ),
                            "styles" => array(
                                "@id" => array(
                                    "backgroundRepeat" => "{{@model.repeat}}",
                                    "backgroundPosition" => "{{@model.position}}",
                                    "backgroundSize" => "{{@model.size}}",
                                    "backgroundAttachment" => "{{@model.attachment}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.box_shadow",
                    "attrs" => array(
                        "label" => "Box Shadow",
                        "type" => "box-shadow"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id" => array(
                            "boxShadow" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "if" => "!@attrs.fixed",
            "attrs" => array(
                "collapsed" => false,
                "label" => "Absolute"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.absolute",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "if" => "!@attrs.absolute",
            "attrs" => array(
                "collapsed" => false,
                "label" => "Fixed"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.fixed",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.fixed",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.fixed_bottom",
                            "attrs" => array(
                                "label" => "Bottom",
                                "type" => "switch",
                                "desc" => "Display the Header at the Bottom"
                            ),
                            "default_value" => false
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.scroll_delay",
                            "attrs" => array(
                                "label" => "Delay",
                                "type" => "switch",
                                "desc" => "Only show the header after scrolling."
                            ),
                            "default_value" => false
                        ),
                        array(
                            "tag" => "editor-field",
                            "show" => "@attrs.scroll_delay",
                            "bind_to" => "@attrs.show_at",
                            "attrs" => array(
                                "label" => "When",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 15,
                                    "max" => 200,
                                    "step" => 1
                                ),
                                "desc" => "Define the moment for the header to appear."
                            ),
                            "default_value" => 15
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "collapsed" => false,
                "label" => "Custom Class"
            ),
            "content" => [
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
<div class="kong-header kong-hb-menu {{::$ctrl.getID()}}"
     data-scroll-class="{{$ctrl.nav.attrs.scroll_class}}"
     header-scroll-handler="$ctrl.nav.attrs"
     ng-class="[$ctrl.nav.attrs.hidden,
                            'kong-header--background-' + $ctrl.nav.attrs.bg_style,
                            {'kong-header--fixed':$ctrl.nav.attrs.fixed,
                            'kong-header--fixedBottom': $ctrl.nav.attrs.fixed && $ctrl.nav.attrs.fixed_bottom,
                            'kong-header--absolute':$ctrl.nav.attrs.absolute,
                            'kong-header--fixed--delay':$ctrl.nav.attrs.scroll_delay,
                            'kong-dnd__editedNav' : $ctrl.nav.kept,
                            'kong-header--parallax':$ctrl.nav.attrs.parallax}]"
     data-show="{{$ctrl.nav.attrs.show_at}}">

    <div class="kong-dnd__visual kong-dnd__visual--bold kong-dnd__visual--nav lvh__{{::$ctrl.service.getID($ctrl.nav)}}" ng-click="$ctrl.edit()" kong-detect-hover-node-horizontal="$ctrl.nav"></div>

    <div class="kong-dnd__emptyItem kong-dnd__emptyItem--hNav" ng-if="!$ctrl.nav.content.length">
        <span class="kong-dnd__emptyItem__label">Horizontal Nav</span>
    </div>

    <horizontal-section-list nav="$ctrl.nav"></horizontal-section-list>
</div>
<div class="kong-header__fixed-block" ng-class="$ctrl.nav.attrs.hidden" ng-show="$ctrl.nav.attrs.fixed"></div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lhb_h_nav', 'lhb_horizontal_nav_callback');
function lhb_horizontal_nav_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'fixed' => 'false',
        'fixed_bottom' => 'false',
        'scroll_delay' => 'false',
        'show_at' => 100,
        'scroll_class' => '',
        'fixed_height' => 0,
        'hidden' => '',
        'class' => '',
        'absolute' => 'false',
        'bg_effect'=> 'none',
        'bg_style'=> 'none',
        'parallax'=> 'false'
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $html = '';
    $fixed_html = '';
    $classes = array(
        $attrs['class_id'],
        'kong-header--background-' . $attrs['bg_style']
    );

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if (kong_to_boolean($attrs['fixed'])) {
        $classes[] = 'kong-header--fixed';
        $fixed_hidden = $attrs['hidden'] ? ' '.$attrs['hidden'] : '';
        $fixed_html = '<div class="kong-header__fixed-block'.$fixed_hidden.'"></div>';

        if (kong_to_boolean($attrs['fixed_bottom'])) {
            $classes[] = 'kong-header--fixedBottom';
        }

        if (kong_to_boolean($attrs['scroll_delay'])) {
            $classes[] = 'kong-header--fixed--delay';
        }
    }

    if (kong_to_boolean($attrs['absolute'])) {
        $classes[] = 'kong-header--absolute';
    }

    $datas = '';
    $datas .= ' data-scroll-class="' . $attrs['scroll_class'] . '"';
    $datas .= ' data-show="' . $attrs['show_at'] . '"';

    ob_start(); ?>
    <div class="kong-header <?php echo implode(' ', $classes); ?>"<?php echo $datas; ?>>
        <?php echo do_shortcode($content); ?>
        <?php echo $fixed_html; ?>
    </div>
    <?php
    $html .= ob_get_clean();

    return $html;
}