<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Inline Box",
    "tag" => "v_inline_box",
    "keywords" => ["inline box","flex","nested"],
    "native" => true,
    "filter" => "other",
    "v_nav" => true,
    "nested" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Alignment",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.item_margin",
                    "attrs" => array(
                        "label" => "Item Margin",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 5,
                    "styles" => array(
                        "@id .kong-aside__inlineList > *" => array(
                            "margin" => "0px {{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.container_margin",
                    "attrs" => array(
                        "label" => "Container Margin",
                        "type" => "area2",
                        "config" => array(
                            "min" => -300,
                            "max" => 300,
                            "step" => 1
                        )
                    ),
                    "default_value" => "0px 0px 0px 0px",
                    "styles" => array(
                        "@id" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.h_align",
                    "attrs" => array(
                        "label" => "Horizontal Alignment",
                        "type" => "h-align"
                    ),
                    "default_value" => "middle"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.v_align",
                    "attrs" => array(
                        "label" => "Vertical Alignment",
                        "type" => "image-buttons",
                        "config" => array(
                            "left" => "left.svg",
                            "center" => "center.svg",
                            "right" => "right.svg",
                            "spaceBetween" => "space-between.svg",
                            "spaceAround" => "space-around.svg"
                        )
                    ),
                    "default_value" => "center"
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
                        "type" => "device-hidden",
                        "label" => "Devices"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.class",
                    "attrs" => array(
                        "type" => "text",
                        "label" => "Class"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
);

ob_start();
?>
<div class="kong-aside__inlineBox {{::$ctrl.getID()}}" ng-class="['kong-aside__inlineBox--vAlign-' + $ctrl.edited.attrs.v_align, 'kong-aside__inlineBox--hAlign-' + $ctrl.edited.attrs.h_align, $ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <div class="kong-dnd__dropMe kong-dnd__dropMe--lv1 kong-dnd__dropMe--nested">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <kong-vertical-nested-item-list model="$ctrl.edited"></kong-vertical-nested-item-list>
</div>

<div class="kong-dnd__visualBlock"></div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_v_inline_box', 'lhb_v_inline_box_callback');
function lhb_v_inline_box_callback($attrs, $content) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'hidden' => '',
        'v_align' => 'center',
        'h_align' => 'middle',
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }


    $classes[] = 'kong-aside__inlineBox--vAlign-'.$attrs['v_align'];
    $classes[] = 'kong-aside__inlineBox--hAlign-'.$attrs['h_align'];
    $classes[] = $attrs['class_id'];

    ob_start(); ?>
    <div class="kong-aside__inlineBox <?php echo implode(' ', $classes) ?>">
        <div class="kong-aside__inlineList"><?php echo do_shortcode($content); ?></div>
    </div>
    <?php
    return ob_get_clean();
}
