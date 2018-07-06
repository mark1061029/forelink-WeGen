<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Menu",
    "tag" => "menu",
    "keywords" => ["menu"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Menu",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.menu_id",
                    "attrs" => array(
                        "label" => "Menu",
                        "type" => "selection-loader",
                        "config" => array(
                            "url" => "kong-website-builder/v1/menus",
                            "rest_url" => true,
                            "name" => "menu",
                            "add_new_url" => admin_url('nav-menus.php')
                        )
                    ),
                    "default_value" => 0
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Display",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.align",
                    "attrs" => array(
                        "label" => "Vertical Align",
                        "type" => "res-class",
                        "config" => array(
                            "prefix" => "kong-menu",
                            "suffix" => "vertical",
                            "devices" => ["desktop","tablet","mobile"]
                        ),
                        "desc" => "Select the device screen items displayed vertically."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.no_edge",
                    "attrs" => array(
                        "label" => "No Edge",
                        "type" => "res-class",
                        "config" => array(
                            "prefix" => "kong-menu",
                            "suffix" => "noEdge",
                            "devices" => ["desktop","tablet","mobile"]
                        ),
                        "desc" => "Select the device screen to not ignore the left & right edge padding."
                    ),
                    "default_value" => ""
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Typography",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 14
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_weight",
                    "attrs" => array(
                        "label" => "Font Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 400,
                    "styles" => array(
                        "@id" => array(
                            "fontWeight" => "{{@model}}"
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
                            "min" => 1,
                            "max" => 2,
                            "step" => 0.1
                        )
                    ),
                    "default_value" => 1.3,
                    "styles" => array(
                        "@id" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.5,
                            "max" => 1,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_source",
                    "attrs" => array(
                        "label" => "Font Source",
                        "type" => "font-source"
                    ),
                    "default_value" => array(
                        "source" => "inherit",
                        "google" => array(
                            "family" => "Open Sans",
                            "variant" => "regular",
                            "subset" => "latin"
                        ),
                        "uploaded" => "",
                        "typekit" => ""
                    ),
                    "directives" => [
                        array(
                            "tag" => "embed-font-source",
                            "attrs" => array(
                                "selector" => "@id"
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Spacing & Border",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.spacing",
                    "attrs" => array(
                        "label" => "Spacing",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "5px 0px 5px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id li" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_style",
                    "attrs" => array(
                        "label" => "Border Style",
                        "type" => "border-style"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id li" => array(
                            "borderStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "if" => "@attrs.border_style != 'none'",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["border"],
                    "styles" => array(
                        "@id li" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Color",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color_active",
                    "attrs" => array(
                        "label" => "Active Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id li.kong-menu-current-menu-item a" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color_hover",
                    "attrs" => array(
                        "label" => "Hover Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id a:hover" => array(
                            "color" => "{{@model}}"
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
<div class="kong-dnd__emptyItem" style="height:100px" ng-if="$ctrl.edited.attrs.menu_id == 0">
    <span class="kong-dnd__emptyItem__label">Menu</span>
</div>

<div class="kong-menu {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.no_edge, $ctrl.edited.attrs.align, $ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]">
    <lb-menu-vs node_id="{{::$ctrl.getID()}}" ng-model="$ctrl.edited.attrs.menu_id" depth="1"></lb-menu-vs>
</div>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lfb_menu', 'lfb_menu_callback');
function lfb_menu_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'hidden' => '',
        'align' => '',
        'no_edge' => '',
        'menu_id' => '0'
    ), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if($attrs['align']){
        $classes[] = $attrs['align'];
    }

    if($attrs['no_edge']){
        $classes[] = $attrs['no_edge'];
    }

    $classes[] = $attrs['class_id'];

    ob_start(); ?>
    <div class="kong-menu <?php echo implode(' ', $classes); ?>">
        <?php echo kong_get_menu_content($attrs['menu_id'], '', 1); ?>
    </div>
    <?php
    return ob_get_clean();
}