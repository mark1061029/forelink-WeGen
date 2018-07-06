<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Divider",
    "tag" => "divider",
    "keywords" => ["divider","separator"],
    "native" => true,
    "filter" => "other",
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
                    "bind_to" => "@attrs.margin",
                    "attrs" => array(
                        "label" => "Distance",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "20px 0px 20px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => ["px","%","vw"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-divider__line" => array(
                            "width" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.style",
                    "attrs" => array(
                        "label" => "Style",
                        "type" => "selection",
                        "config" => array(
                            "singleThin" => "Single Thin",
                            "singleThinDashed" => "Single Thin Dashed",
                            "singleThick" => "Single Thick",
                            "doubleThin" => "Double Thin",
                            "doubleThinDashed" => "Double Thin Dashed",
                            "doubleThick" => "Double Thick",
                            "gradient" => "Gradient"
                        )
                    ),
                    "default_value" => "singleThin"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.line_color",
                    "if" => "@attrs.style != 'gradient'",
                    "attrs" => array(
                        "label" => "Line Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id .kong-divider__line" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.line_color",
                    "if" => "@attrs.style == 'gradient'",
                    "attrs" => array(
                        "label" => "Line Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id .kong-divider__line--gradient.kong-divider__line--center" => array(
                            "background" => "linear-gradient(to left, rgba(0,0,0,0), {{@model}}, rgba(0,0,0,0))"
                        ),
                        "@id .kong-divider__line--gradient.kong-divider__line--left" => array(
                            "background" => "linear-gradient(to left, rgba(0,0,0,0), {{@model}})"
                        ),
                        "@id .kong-divider__line--gradient.kong-divider__line--right" => array(
                            "background" => "linear-gradient(to right, rgba(0,0,0,0), {{@model}})"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Include",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.include",
                    "attrs" => array(
                        "label" => "Include",
                        "type" => "selection",
                        "config" => array(
                            "none" => "None",
                            "icon" => "Icon",
                            "text" => "Text",
                            "goTopBtn" => "Go Top Button"
                        )
                    ),
                    "default_value" => "none"
                ),
                array(
                    "if" => "@attrs.include != 'none'",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.icon",
                            "if" => "@attrs.include == 'icon'",
                            "attrs" => array(
                                "label" => "Icon",
                                "type" => "icon"
                            ),
                            "default_value" => array(
                                "icon" => "star",
                                "source" => "fa"
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.span_size",
                            "show" => "@attrs.include != 'goTopBtn'",
                            "attrs" => array(
                                "label" => "Size",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 8,
                                    "max" => 20,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 14,
                            "styles" => array(
                                "@id span" => array(
                                    "fontSize" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "if" => "@attrs.include == 'text'",
                            "content" => [
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.text",
                                    "attrs" => array(
                                        "label" => "Text",
                                        "type" => "text"
                                    ),
                                    "default_value" => "HEADING"
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.weight",
                                    "attrs" => array(
                                        "label" => "Weight",
                                        "type" => "slider",
                                        "config" => array(
                                            "min" => 100,
                                            "max" => 900,
                                            "step" => 100
                                        )
                                    ),
                                    "default_value" => 400,
                                    "styles" => array(
                                        "@id span" => array(
                                            "fontWeight" => "{{@model}}"
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
                                            "min" => -0.1,
                                            "max" => 0.5,
                                            "step" => 0.01
                                        )
                                    ),
                                    "default_value" => 0,
                                    "styles" => array(
                                        "@id span" => array(
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
                                    "default_value" => "uppercase",
                                    "styles" => array(
                                        "@id span" => array(
                                            "textTransform" => "{{@model}}"
                                        )
                                    )
                                )
                            ]
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.span_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["desc"],
                            "styles" => array(
                                "@id span" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.span_bg",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["body"],
                            "styles" => array(
                                "@id span" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.align",
                            "attrs" => array(
                                "label" => "Align",
                                "type" => "align"
                            ),
                            "default_value" => "left"
                        )
                    ]
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
<div class="kong-divider {{::$ctrl.getID()}}" id="{{$ctrl.edited.attrs.id}}" ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <div class="kong-divider__line" ng-class="['kong-divider__line--'+$ctrl.edited.attrs.style,'kong-divider__line--'+$ctrl.edited.attrs.align]">
        <span class="kong-divider__text" ng-show="$ctrl.edited.attrs.include == 'text'" kong-editable model="$ctrl.edited" config="{target:'attrs.text', editorType:'1'}" ng-bind-html="$ctrl.edited.attrs.text"></span>
        <span class="kong-divider__goTopBtn" kong-bind-go-top ng-show="$ctrl.edited.attrs.include == 'goTopBtn'">
            <small><i class="fa fa-angle-up"></i></small>
        </span>
        <span class="kong-divider__icon" ng-show="$ctrl.edited.attrs.include == 'icon'">
            <i ng-class="$ctrl.edited.attrs.icon.source + ' ' + $ctrl.edited.attrs.icon.source + '-' + $ctrl.edited.attrs.icon.icon"></i>
        </span>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);



add_shortcode('lfb_divider', 'lfb_divider_callback');
function lfb_divider_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'style' => 'singleThin',
        'align' => 'left',
        'include' => 'none',
        'text' => '',
        'icon' => json_encode(array(
            'icon' => 'star',
            'source' => 'fa'
        ))
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['icon'] = json_decode($attrs['icon'], true);
    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-divider <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <div class="kong-divider__line kong-divider__line--<?php echo $attrs['style'] ?> kong-divider__line--<?php echo $attrs['align']; ?>">
            <?php if ($attrs['include'] == 'text') : ?>
                <span class="kong-divider__text"><?php echo html_entity_decode($attrs['text']); ?></span>
            <?php endif; ?>
            <?php if ($attrs['include'] == 'goTopBtn') : ?>
                <span class="kong-divider__goTopBtn">
				<small><i class="fa fa-angle-up"></i></small>
			</span>
            <?php endif; ?>
            <?php if ($attrs['include'] == 'icon') : ?>
                <span class="kong-divider__icon">
				<i class="<?php echo $attrs['icon']['source'].' '.$attrs['icon']['source'].'-'.$attrs['icon']['icon']; ?>"></i>
			</span>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}