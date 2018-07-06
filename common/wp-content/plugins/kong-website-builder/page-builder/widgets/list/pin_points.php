<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Pin Points",
    "tag" => "pin_points",
    "keywords" => ["pinpoint"],
    "native" => true,
    "filter" => "image",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Image",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.image",
                    "attrs" => array(
                        "label" => "Feature Img",
                        "type" => "upload-image"
                    ),
                    "default_value" => array(
                        "url" => ""
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.width",
                    "attrs" => array(
                        "label" => "Width",
                        "type" => "res-unit",
                        "config" => array(
                            "units" => ["px","%","vw"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-pinpoints__wrap" => array(
                            "width" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => '0px 0px 0px 0px',
                    "styles" => array(
                        "@id .kong-pinpoints__image" => array(
                            "borderWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "show" => "@attrs.border_width != '0px 0px 0px 0px'",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id .kong-pinpoints__image" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.img_border_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "0px 0px 0px 0px",
                    "styles" => array(
                        "@id .kong-pinpoints__image" => array(
                            "borderRadius" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.img_box_shadow",
                    "attrs" => array(
                        "label" => "Box Shadow",
                        "type" => "box-shadow"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id .kong-pinpoints__image" => array(
                            "boxShadow" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Points",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model",
                    "attrs" => array(
                        "label" => "Item",
                        "type" => "item-group",
                        "config" => array(
                            "refer" => "heading"
                        )
                    ),
                    "default_value" => []
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Popup Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.popup_width",
                    "attrs" => array(
                        "label" => "Popup Width",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 200,
                            "max" => 600,
                            "step" => 10
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 300
                    ),
                    "responsive_styles" => array(
                        "@id .kong-pinpoints__popover" => array(
                            "width" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.popup_padding",
                    "attrs" => array(
                        "label" => "Popup Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "15px 20px 15px 20px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-pinpoints__popover__wrap" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.pin_color",
                    "attrs" => array(
                        "label" => "Pin Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-pinpoints__pin" => array(
                            "backgroundColor" => "{{@model}}"
                        ),
                        "@id .kong-pinpoints__pin .kong-pinpoints__pin__shadow" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-pinpoints__popover__wrap" => array(
                            "backgroundColor" => "{{@model}}"
                        ),
                        "@id .kong-pinpoints__popover__arrow" => array(
                            "borderTopColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.box_shadow",
                    "attrs" => array(
                        "label" => "Box Shadow",
                        "type" => "box-shadow"
                    ),
                    "default_value" => "0px 0px 10px rgba(0,0,0,0.1)",
                    "styles" => array(
                        "@id .kong-pinpoints__popover__wrap" => array(
                            "boxShadow" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.popup_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => 5,
                    "styles" => array(
                        "@id .kong-pinpoints__popover__wrap" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Heading",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.head_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 13
                    ),
                    "responsive_styles" => array(
                        "@id .kong-pinpoints__popover__heading" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.head_margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area-2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 0px 15px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-pinpoints__popover__heading" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-pinpoints__popover__heading" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.heading_weight",
                    "attrs" => array(
                        "label" => "Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 700,
                    "styles" => array(
                        "@id .kong-pinpoints__popover__heading" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.head_letter_spacing",
                    "attrs" => array(
                        "label" => "Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -2,
                            "max" => 3,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.05,
                    "styles" => array(
                        "@id .kong-pinpoints__popover__heading" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.head_transform",
                    "attrs" => array(
                        "type" => "text-transform",
                        "label" => "Text Transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id .kong-pinpoints__popover__heading" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Desc",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 14
                    ),
                    "responsive_styles" => array(
                        "@id .kong-pinpoints__popover__desc" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.line_height",
                    "attrs" => array(
                        "label" => "Line Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0.7,
                            "max" => 3,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => 1.5,
                    "styles" => array(
                        "@id .kong-pinpoints__popover__desc" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id .kong-pinpoints__popover__desc" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Responsive",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.responsive",
                    "attrs" => array(
                        "label" => "Responsive",
                        "type" => "res-image"
                    ),
                    "default_value" => array(
                        "enable" => false,
                        "desktop" => "100vw",
                        "tablet" => "100vw",
                        "mobile" => "100vw"
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
    ],
    "child" => array(
        "name" => "Pin Point",
        "tag" => "pin_point",
        "native" => true,
        "content" => [
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Position",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.position_x",
                        "attrs" => array(
                            "label" => "X",
                            "type" => "slider",
                            "config" => array(
                                "min" => 0,
                                "max" => 100,
                                "step" => 1
                            )
                        ),
                        "default_value" => 20,
                        "styles" => array(
                            "@id" => array(
                                "left" => "{{@model}}%"
                            )
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.position_y",
                        "attrs" => array(
                            "label" => "Y",
                            "type" => "slider",
                            "config" => array(
                                "min" => 0,
                                "max" => 100,
                                "step" => 1
                            )
                        ),
                        "default_value" => 20,
                        "styles" => array(
                            "@id" => array(
                                "top" => "{{@model}}%"
                            )
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.pulse",
                        "attrs" => array(
                            "label" => "Pulse Effect",
                            "type" => "switch"
                        ),
                        "default_value" => true
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.opened",
                        "attrs" => array(
                            "label" => "Opened",
                            "type" => "switch"
                        ),
                        "default_value" => false
                    )
                ]
            ),
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Content",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.heading",
                        "attrs" => array(
                            "type" => "text",
                            "label" => "Heading"
                        ),
                        "default_value" => "Heading Title"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.desc",
                        "attrs" => array(
                            "fullwidth" => true,
                            "type" => "rich-editor"
                        ),
                        "default_value" => $manager::$text["paragraph"]
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem" style="height:100px" ng-if="!$ctrl.edited.attrs.image.url">
    <span class="kong-dnd__emptyItem__label">Pinpoints</span>
</div>

<div class="kong-pinpoints {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]" id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-pinpoints__wrap">
        <img class="kong-pinpoints__image" ng-src="{{$ctrl.edited.attrs.image.url}}"/>

        <div class="kong-pinpoints__item"
             ng-class="{'kong-pinpoints__item--opened' : pin.attrs.opened}"
             ng-style="{'left':pin.attrs.position_x + '%', 'top': pin.attrs.position_y + '%'}"
             ng-repeat="pin in $ctrl.edited.content">
            <div class="kong-pinpoints__pin" ng-class="{'kong-pinpoints__pin--pulse' : pin.attrs.pulse}">
                <span class="kong-pinpoints__pin__shadow"></span>
            </div>

            <div class="kong-pinpoints__popover">
                <div class="kong-pinpoints__popover__wrap">
                    <h6 class="kong-pinpoints__popover__heading" ng-bind-html="pin.attrs.heading"></h6>
                    <p class="kong-pinpoints__popover__desc" ng-bind-html="pin.attrs.desc"></p>
                </div>
                <span class="kong-pinpoints__popover__arrow"></span>
            </div>
        </div>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_pin_points', 'kong_pin_points_callback');
function kong_pin_points_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'image' => json_encode(array(
            'url' => '',
        )),
        'responsive' => json_encode(array(
            'enable' => 'false',
            'desktop' => '100vw',
            'tablet' => '100vw',
            'mobile' => '100vw'
        )),
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

    $attrs['image'] = json_decode($attrs['image'], true);
    $attrs['responsive'] = json_decode($attrs['responsive'], true);
    $srcset = '';
    $sizes = '';
    if (!empty($attrs['responsive']['enable'])) {
        $image_id = kong_get_attachment_id_from_url($attrs['image']['url']);

        if ($image_id) {
            $srcset = kong_get_attachment_srcset($image_id);
            $srcset = $srcset ? ' srcset="' . $srcset . '"' : '';
            $sizes = kong_get_image_sizes($attrs['responsive']);
            $sizes = $sizes ? ' sizes="' . $sizes . '"' : '';
        }
    }

    ob_start(); ?>
    <div class="kong-pinpoints <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <div class="kong-pinpoints__wrap">
            <?php if($attrs['image']['url']): ?>
                <img class="kong-pinpoints__image" src="<?php echo $attrs['image']['url'] ?>"<?php echo $srcset . $sizes; ?>/>
            <?php endif; ?>
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_pin_point', 'kong_pin_point_callback');
function kong_pin_point_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'pulse' => 'true',
        'opened' => 'false',
        'heading' => 'Heading Title',
        'desc' => KongPageBuilderClient::KONG_DUMB_PARAGRAPH
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $class = kong_to_boolean($attrs['pulse']) ? ' kong-pinpoints__pin--pulse' : '';
    $classes = [];
    if(kong_to_boolean($attrs['opened'])){
        $classes[] = 'kong-pinpoints__item--opened';
    }
    $classes[] = $attrs['class_id'];

    ob_start(); ?>
    <div class="kong-pinpoints__item <?php echo implode(' ', $classes); ?>">
        <div class="kong-pinpoints__pin<?php echo $class; ?>">
            <span class="kong-pinpoints__pin__shadow"></span>
        </div>

        <div class="kong-pinpoints__popover">
            <div class="kong-pinpoints__popover__wrap">
                <h6 class="kong-pinpoints__popover__heading"><?php echo html_entity_decode($attrs['heading']); ?></h6>
                <p class="kong-pinpoints__popover__desc"><?php echo html_entity_decode($attrs['desc']); ?></p>
            </div>
            <span class="kong-pinpoints__popover__arrow"></span>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
