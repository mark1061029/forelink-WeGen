<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Go Top Button",
    "tag" => "go_top_button",
    "keywords" => ["go top button"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Setting",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.delay",
                    "attrs" => array(
                        "label" => "Delay (ms)",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 2000,
                            "step" => 50
                        )
                    ),
                    "default_value" => 600
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Icon & Size",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon",
                    "attrs" => array(
                        "label" => "Icon",
                        "type" => "icon-box",
                        "config" => array(
                            "icons" => ["fa fa-angle-up","fa fa-chevron-up","fa fa-caret-up","fa fa-long-arrow-up"],
                            "requireValue" => true
                        )
                    ),
                    "default_value" => "fa fa-chevron-up"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-goTop__btn" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-goTop__btn" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 20,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 40
                    ),
                    "responsive_styles" => array(
                        "@id .kong-goTop__btn" => array(
                            "width" => "{{@model}}px",
                            "height" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_size",
                    "attrs" => array(
                        "label" => "Icon Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 24
                    ),
                    "responsive_styles" => array(
                        "@id .kong-goTop__btn" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.shadow",
                    "attrs" => array(
                        "label" => "Shadow",
                        "type" => "box-shadow"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id .kong-goTop__btn" => array(
                            "boxShadow" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Border",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_style",
                    "attrs" => array(
                        "label" => "Style",
                        "type" => "border_style"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id .kong-goTop__btn" => array(
                            "borderStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "if" => "@attrs.border_style != 'none'",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.border_width",
                            "attrs" => array(
                                "label" => "Width",
                                "type" => "area",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => "1px 1px 1px 1px",
                            "styles" => array(
                                "@id .kong-goTop__btn" => array(
                                    "borderWidth" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.border_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "get_border_color",
                            "styles" => array(
                                "@id .kong-goTop__btn" => array(
                                    "borderColor" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 50,
                            "step" => 0.5
                        )
                    ),
                    "default_value" => 50,
                    "styles" => array(
                        "@id .kong-goTop__btn" => array(
                            "borderRadius" => "{{@model}}%"
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
<div class="kong-goTop {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <button class="kong-goTop__btn" data-delay="{{$ctrl.edited.attrs.delay}}" bind-go-top-button>
        <i ng-class="$ctrl.edited.attrs.icon"></i>
    </button>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lfb_go_top_button', 'lfb_go_top_button_callback');
function lfb_go_top_button_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'hidden' => '',
        'delay' => '650',
        'icon' => 'lnr lnr-chevron-down'
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
    <div class="kong-goTop <?php echo implode(' ', $classes); ?>">
        <button class="kong-goTop__btn" data-delay="<?php echo $attrs['delay']; ?>" href="#<?php echo $attrs['section_id']; ?>"><i class="<?php echo $attrs['icon']; ?>"></i></button>
    </div>
    <?php
    return ob_get_clean();
}