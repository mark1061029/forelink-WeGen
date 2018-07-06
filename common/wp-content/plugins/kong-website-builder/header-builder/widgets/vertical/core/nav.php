<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "tag" => "v_nav",
    "name" => "Vertical Nav",
    "native" => true,
    "core" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hidden On",
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
                "collapsed" => false,
                "label" => "Content"
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.layout",
                    "attrs" => array(
                        "label" => "Section Organization",
                        "type" => "image-buttons",
                        "config" => array(
                            "start" => "top.svg",
                            "center" => "middle.svg",
                            "end" => "bottom.svg",
                            "space-between" => "h-space-between.svg",
                            "spaceAround" => "h-space-around.svg"
                        )
                    ),
                    "default_value" => "start"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.z_index",
                    "attrs" => array(
                        "label" => "z-index",
                        "type" => "number",
                        "config" => array(
                            "min" => 0,
                            "max" => 10000,
                            "step" => 1
                        )
                    ),
                    "default_value" => "1000",
                    "styles" => array(
                        "@id" => array(
                            "zIndex" => "{{@model}}"
                        ),
                        "@id + .kong-aside__backdrop" => array(
                            "zIndex" => "{{@model - 1}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Layout",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.width",
                    "attrs" => array(
                        "label" => "Width",
                        "type" => "slider",
                        "config" => array(
                            "min" => 20,
                            "max" => 700,
                            "step" => 1
                        )
                    ),
                    "default_value" => 300,
                    "styles" => array(
                        "@id" => array(
                            "width" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@edited.empty",
                    "attrs" => array(
                        "label" => "",
                        "fullwidth" => true,
                        "type" => "body-padding"
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.right",
                    "attrs" => array(
                        "label" => "Right",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => "20px 20px 20px 20px",
                    "styles" => array(
                        "@id" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.scroll",
                    "attrs" => array(
                        "label" => "Allow Scroll",
                        "type" => "switch",
                        "desc" => "Allow the sidebar to scroll when content height greater than the sidebar height. However, this feature will not work with Megamenu widget."
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Controlled by Button",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.controlled_by_burger",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "If this feature is enable, The sidebar will be controlled to show and hide by a Sidebar Menu Widget from a Horizontal Nav."
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.controlled_by_burger",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.backdrop_color",
                            "attrs" => array(
                                "label" => "Backdrop",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "rgba(0,0,0,0.3)",
                            "styles" => array(
                                "@id + .kong-aside__backdrop" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.effect",
                            "attrs" => array(
                                "label" => "Effect",
                                "type" => "text-buttons",
                                "config" => array(
                                    "options" => array(
                                        "slide" => "Slide",
                                        "push" => "Push"
                                    )
                                )
                            ),
                            "default_value" => "slide"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.id",
                            "attrs" => array(
                                "label" => "ID",
                                "type" => "text",
                                "desc" => "Give a Unique ID for the sidebar so the Sidebar Menu Widget can identify it."
                            ),
                            "default_value" => ""
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Style",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id" => array(
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
                        "@id" => array(
                            "boxShadow" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "attrs" => array(
                        "label" => "Background Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_style",
                    "attrs" => array(
                        "label" => "Background Style",
                        "type" => "background-style",
                        "config" => array(
                            "none" => true,
                            "color" => false,
                            "image" => true,
                            "gradient" => true,
                            "video" => false
                        )
                    ),
                    "default_value" => "color"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_image",
                    "if" => "@attrs.bg_style == 'image'",
                    "attrs" => array(
                        "label" => "Image URL",
                        "type" => "upload-image"
                    ),
                    "default_value" => array(
                        "url" => ""
                    ),
                    "styles" => array(
                        "@id.kong-aside--background-image" => array(
                            "backgroundImage" => "url({{@model.url}})"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_props",
                    "if" => "@attrs.bg_image && @attrs.bg_style == 'image'",
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
                        "@id.kong-aside--background-image" => array(
                            "backgroundRepeat" => "{{@model.repeat}}",
                            "backgroundPosition" => "{{@model.position}}",
                            "backgroundSize" => "{{@model.size}}",
                            "backgroundAttachment" => "{{@model.attachment}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_gradient",
                    "if" => "@attrs.bg_style == 'gradient'",
                    "attrs" => array(
                        "label" => "Gradient",
                        "type" => "gradient",
                        "config" => array(
                            "third_color" => true,
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
                        "@id.kong-aside--background-gradient" => array(
                            "background" => "{{@model.value}}"
                        )
                    )
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
<div class="kong-aside kong-hb-menu {{::$ctrl.service.getID($ctrl.nav)}}"
     sidebar-hide="$ctrl.nav"
     id="{{$ctrl.nav.attrs.id}}"
     data-effect="{{$ctrl.nav.attrs.effect}}"
     ng-class="[$ctrl.nav.attrs.hidden, $ctrl.nav.attrs.class,
                        'kong-aside--background-' + $ctrl.nav.attrs.bg_style,
                        'kong-aside--flex-' + $ctrl.nav.attrs.layout,
                        {'kong-aside--controlled-by-burger' : $ctrl.nav.attrs.controlled_by_burger,
                        'kong-aside--right':$ctrl.nav.attrs.right,
                        'kong-aside--scroll': $ctrl.nav.attrs.scroll,
                        'kong-dnd__editedNav' : $ctrl.nav.kept}]">
    <div class="kong-dnd__visual kong-dnd__visual--nav kong-dnd__visual--bold lvh__{{::$ctrl.service.getID($ctrl.nav)}}" ng-click="$ctrl.edit()" kong-detect-hover-node-vertical="$ctrl.nav"></div>

    <div class="kong-dnd__emptyItem kong-dnd__emptyItem--vNav" ng-if="!$ctrl.nav.content.length">
        <span class="kong-dnd__emptyItem__label">Vertical Nav</span>
    </div>

    <vertical-section-list nav="$ctrl.nav"></vertical-section-list>
</div>

<div class="kong-aside__backdrop"></div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('lhb_v_nav', 'lhb_vertical_nav_callback');
function lhb_vertical_nav_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'right'=> 'false',
        'controlled_by_burger' => 'false',
        'hidden' => '',
        'class' => '',
        'layout' => 'start',
        'bg_style' => 'none',
        'scroll' => 'false',
        'effect' => 'slide',
        'fill_body_height' => 'false',
        'class_id' => '',
        'id' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $html = '';
    $classes = array();
    $datas = '';
    $el_id = '';
    $fixed_html = '';

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if($attrs['class']){
        $classes[] = $attrs['class'];
    }

    if (kong_to_boolean($attrs['controlled_by_burger'])) {
        $classes[] = 'kong-aside--controlled-by-burger';
        $datas = 'data-effect="'.$attrs['effect'].'"';
        $classes[] = '__hide';

        if($attrs['id']){
            $el_id = 'id="'.$attrs['id'].'"';
        }

        $fixed_html .= '<div class="kong-aside__backdrop"></div>';
    }

    if($attrs['bg_style'] != 'none'){
        $classes[] = 'kong-aside--background-'.$attrs['bg_style'];
    }

    if (kong_to_boolean($attrs['right'])) {
        $classes[] = 'kong-aside--right';
    }

    if(kong_to_boolean($attrs['scroll'])){
        $classes[] = 'kong-aside--scroll';
    }

    $classes[] = $attrs['class_id'];
    ob_start(); ?>
    <div class="kong-aside <?php echo implode(' ', $classes); ?>"<?php echo $datas; ?> <?php echo $el_id; ?>>
        <div class="kong-aside__container kong-aside__container--flex-<?php echo $attrs['layout']; ?>"><?php echo do_shortcode($content); ?></div>
    </div>
    <?php echo $fixed_html; ?>
    <?php
    $html .= ob_get_clean();

    return $html;
}