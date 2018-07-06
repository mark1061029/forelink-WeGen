<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Footer",
    "tag" => "footer",
    "native" => true,
    "core" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "if" => "!@attrs.fixed",
            "attrs" => array(
                "label" => "Parallax",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.parallax",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.parallax",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.box_shadow",
                            "attrs" => array(
                                "label" => "Box Shadow",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "rgba(0,0,0,0.75)",
                            "styles" => array(
                                ".kong-site__footer__prev" => array(
                                    "boxShadow" => "0px 0px 50px 10px {{@model}}"
                                )
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "if" => "!@attrs.parallax",
            "attrs" => array(
                "label" => "Fixed",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.fixed",
                    "attrs" => array(
                        "label" => "Fixed",
                        "type" => "res-class",
                        "config" => array(
                            "prefix" => "kong-footer",
                            "suffix" => "fixed",
                            "devices" => ["desktop","tablet","mobile"]
                        ),
                        "desc" => "Select the device screen to set fixed position for the footer."
                    ),
                    "default_value" => ""
                ),
                array(
                    "if" => "@attrs.fixed",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.z_index",
                            "attrs" => array(
                                "label" => "Z-Index",
                                "type" => "number",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 9999,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 1,
                            "styles" => array(
                                "@id[class*='-fixed']" => array(
                                    "zIndex" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.fixed_box_shadow",
                            "attrs" => array(
                                "label" => "Box Shadow",
                                "type" => "box-shadow"
                            ),
                            "default_value" => "none",
                            "styles" => array(
                                "@id[class*='-fixed']" => array(
                                    "boxShadow" => "{{@model}}"
                                )
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Background",
                "collapsed" => false
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
                    "default_value" => "none"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "if" => "@attrs.bg_style == 'color'",
                    "attrs" => array(
                        "label" => "Background Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id" => array(
                            "backgroundColor" => "{{@model}}"
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
                                "label" => "Background Image",
                                "type" => "upload-image",
                                "config" => array(
                                    "full" => true
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
                            "if" => "@attrs.bg_image",
                            "content" => [
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.bg_props",
                                    "attrs" => array(
                                        "type" => "background-props",
                                        "fullwidth" => true
                                    ),
                                    "default_value" => array(
                                        "repeat" => "no-repeat",
                                        "position" => "50% 50%",
                                        "size" => "cover"
                                    ),
                                    "styles" => array(
                                        "@id" => array(
                                            "backgroundRepeat" => "{{@model.repeat}}",
                                            "backgroundPosition" => "{{@model.position}}",
                                            "backgroundSize" => "{{@model.size}}"
                                        )
                                    )
                                )
                            ]
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Overlay",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.overlay",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.overlay",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.overlay_bg",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "gradient",
                                "config" => array(
                                    "third_color" => false,
                                    "radial" => false
                                )
                            ),
                            "default_value" => array(
                                "color_1" => "rgba(0,0,0,1)",
                                "color_2" => "transparent",
                                "angle" => 90,
                                "value" => "linear-gradient(90deg, rgba(0,0,0,1), transparent)"
                            ),
                            "styles" => array(
                                "@id .kong-footer__overlay" => array(
                                    "background" => "{{@model.value}}"
                                )
                            )
                        )
                    ]
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
<div class="kong-footer {{::$ctrl.getID()}}"
     kong-footer-parallax model="$ctrl.edited.attrs.parallax"
     ng-class="[{'kong-footer--parallax': $ctrl.edited.attrs.parallax && !$ctrl.edited.attrs.fixed},$ctrl.edited.attrs.fixed,'kong-footer--bgStyle-' + $ctrl.edited.attrs.bg_style, $ctrl.edited.attrs.class]" id="{{$ctrl.section.attrs.id}}">
    <div class="kong-footer__overlay" ng-show="$ctrl.edited.attrs.overlay"></div>
    <div class="kong-footer__container">
        <kong-section-list></kong-section-list>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lfb_footer', 'lfb_footer_callback');
function lfb_footer_callback($attrs, $content = '') {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'bg_style' => 'none',
        'overlay' => 'false',
        'parallax' => 'false',
        'fixed' => '',
        'bg_image' => json_encode(array('url' => ''))
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if (kong_to_boolean($attrs['parallax']) && !$attrs['fixed']) {
        $classes[] = 'kong-footer--parallax';
    }

    if (!kong_to_boolean($attrs['parallax']) && $attrs['fixed']) {
        $classes[] = $attrs['fixed'];
    }

    $classes[] = 'kong-footer--bgStyle-' . $attrs['bg_style'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    $classes[] = $attrs['class_id'];

    ob_start(); ?>
    <div class="kong-footer <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <?php if (kong_to_boolean($attrs['overlay'])) : ?>
            <div class="kong-footer__overlay"></div>
        <?php endif; ?>
        <div class="kong-footer__container">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}