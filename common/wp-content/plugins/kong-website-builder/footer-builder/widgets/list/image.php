<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Image",
    "tag" => "image",
    "keywords" => ["image"],
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
                    "bind_to" => "@attrs.image",
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
                        "url" => "",
                        "new_tab" => false
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.alt",
                    "attrs" => array(
                        "label" => "Alt Text",
                        "type" => "text"
                    ),
                    "default_value" => ""
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Size & Alignment",
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area",
                        "config" => array(
                            "min" => -1000,
                            "max" => 1000,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 0px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id img" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.align",
                    "attrs" => array(
                        "label" => "Alignment",
                        "type" => "v-align"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id" => array(
                            "textAlign" => "{{@model}}"
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
                    "bind_to" => "@attrs.border_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 2000,
                            "step" => 1
                        )
                    ),
                    "default_value" => "0px 0px 0px 0px",
                    "styles" => array(
                        "@id img" => array(
                            "borderRadius" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id img" => array(
                            "borderWidth" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "show" => "@attrs.border_width > 0",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id img" => array(
                            "borderColor" => "{{@model}}"
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
                    "default_value" => "none",
                    "styles" => array(
                        "@id img" => array(
                            "boxShadow" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.float_right",
                    "attrs" => array(
                        "label" => "Float Right",
                        "type" => "res-class",
                        "config" => array(
                            "prefix" => "kong-image",
                            "suffix" => "floatRight",
                            "devices" => ["desktop","tablet","mobile"]
                        )
                    ),
                    "default_value" => ""
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
                        "type" => "class",
                        "config" => ["Hover.css","Hover Effect","Tilt Hover Effect"]
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
<div class="kong-dnd__emptyItem" style="height:100px;" ng-if="!$ctrl.edited.attrs.image.url">
    <span class="kong-dnd__emptyItem__label">Image</span>
</div>

<div class="kong-image__container {{::$ctrl.getID()}}" ng-class="$ctrl.edited.attrs.float_right">
    <img class="kong-image" id="{{$ctrl.edited.attrs.id}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]"
         ng-src="{{$ctrl.edited.attrs.image.url}}"/>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('lfb_image', 'lfb_image_callback');
function lfb_image_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'image' => json_encode(array(
            'url' => ''
        )),
        'float_right' => '',
        'alt' => '',
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
        'responsive' => json_encode(array(
            'enable' => 'false',
            'desktop' => '100vw',
            'tablet' => '100vw',
            'mobile' => '100vw'
        )),
        'link' => json_encode(array(
            'url' => '#',
            'new_tab' => 'true'
        ))
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['link'] = json_decode($attrs['link'], true);
    $classes = array();

    if ($attrs['float_right']) {
        $classes[] = $attrs['float_right'];
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    if (!empty($attrs['link']['url'])) {
        $target = kong_to_boolean($attrs['link']['new_tab']) ? ' target="_blank"' : '';
        $link_before = '<a href="' . $attrs['link']['url'] . '"' . $target . '>';
        $link_after = '</a>';
    } else {
        $link_before = '';
        $link_after = '';
    }

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $animation = kong_form_animation_data($attrs['animation']);

    $alt = '';
    if($attrs['alt']){
        $alt = ' alt="'.$attrs['alt'].'"';
    }

    $attrs['responsive'] = json_decode($attrs['responsive'], true);
    $srcset = '';
    $sizes = '';

    $attrs['image'] = json_decode($attrs['image'], true);
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
    <div class="kong-image__container <?php echo implode(' ', $classes) ?>">
        <?php echo $link_before; ?>
        <img class="kong-image"<?php echo $id; ?> src="<?php echo $attrs['image']['url'] ?>"<?php echo $animation . $alt . $srcset . $sizes; ?>/>
        <?php echo $link_after; ?>
    </div>
    <?php
    return ob_get_clean();
}