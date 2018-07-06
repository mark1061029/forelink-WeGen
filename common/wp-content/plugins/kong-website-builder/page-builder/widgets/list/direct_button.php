<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Direct Button",
    "tag" => "direct_button",
    "keywords" => ["direct button"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Target",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.section_id",
                    "attrs" => array(
                        "label" => "Section Id",
                        "type" => "text",
                        "desc" => "Enter the ID of section that will be scrolled to after click on this button."
                    ),
                    "default_value" => ""
                ),
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
                        ),
                        "desc" => "Time to travel at the point when click the button to the assigned section."
                    ),
                    "default_value" => 600
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Icon",
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
                            "icons" => ["lnr lnr-chevron-down","lnr lnr-arrow-down","lnr lnr-arrow-down-circle","lnr lnr-chevron-down-circle","fa fa-chevron-down","fa fa-chevron-circle-down","fa fa-arrow-circle-o-down","fa fa-caret-down","fa fa-caret-square-o-down"],
                            "requireValue" => true
                        )
                    ),
                    "default_value" => "fa fa-chevron-down"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        "@id .kong-directBtn__btn" => array(
                            "color" => "{{@model}}"
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
                            "min" => 10,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 24
                    ),
                    "responsive_styles" => array(
                        "@id .kong-directBtn__btn" => array(
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
                    "default_value" => 16,
                    "styles" => array(
                        "@id .kong-directBtn__btn" => array(
                            "textShadow" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.animate",
                    "attrs" => array(
                        "label" => "Animate",
                        "type" => "switch"
                    ),
                    "default_value" => false
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
    ]
);

ob_start();
?>
<div class="kong-directBtn {{::$ctrl.getID()}}" ng-class="[{'kong-directBtn--animate': $ctrl.edited.attrs.animate},$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
    <a class="kong-directBtn__btn" href="#{{$ctrl.edited.attrs.section_id}}" data-delay="{{$ctrl.edited.attrs.delay}}" frontend-compile callback="bindDirectButton">
        <i ng-class="$ctrl.edited.attrs.icon"></i>
    </a>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_direct_button', 'kong_direct_button_callback');
function kong_direct_button_callback($attrs, $content) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'section_id' => '',
        'hidden' => '',
        'animate' => 'false',
        'delay' => '650',
        'icon' => 'lnr lnr-chevron-down'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if (kong_to_boolean($attrs['animate'])) {
        $classes[] = 'kong-directBtn--animate';
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-directBtn <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <a class="kong-directBtn__btn" data-delay="<?php echo $attrs['delay']; ?>" href="#<?php echo $attrs['section_id']; ?>"><i class="<?php echo $attrs['icon']; ?>"></i></a>
    </div>
    <?php
    return ob_get_clean();
}