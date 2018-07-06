<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Text",
    "tag" => "advance_text",
    "keywords" => ["google font","advance text"],
    "native" => true,
    "filter" => "text",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Wrap By",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.tag",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "tag",
                        "config" => ["h1","h2","h3","h4","h5","h6","p","div"]
                    ),
                    "default_value" => "div"
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
                    "bind_to" => "@content",
                    "attrs" => array(
                        "type" => "rich-editor",
                        "fullwidth" => true
                    ),
                    "default_value" => ""
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
                    "bind_to" => "@attrs.font_size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 6,
                            "max" => 160,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 13
                    ),
                    "responsive_styles" => array(
                        "@id .kong-advanceText__content" => array(
                            "fontSize" => "{{@model}}px"
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
                            "min" => -300,
                            "max" => 300,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 0px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-advanceText__content" => array(
                            "margin" => "{{@model}}"
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
                            "max" => 3,
                            "step" => 0.05
                        )
                    ),
                    "default_value" => 1.5,
                    "styles" => array(
                        "@id .kong-advanceText__content" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_weight",
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
                        "@id .kong-advanceText__content" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.letter_spacing",
                    "attrs" => array(
                        "label" => "Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -2,
                            "max" => 3,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-advanceText__content" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id .kong-advanceText__content" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_transform",
                    "attrs" => array(
                        "type" => "text-transform",
                        "label" => "Text Transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id .kong-advanceText__content" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.align",
                    "attrs" => array(
                        "label" => "Text Align",
                        "type" => "text-align"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id" => array(
                            "textAlign" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font",
                    "attrs" => array(
                        "label" => "Family",
                        "type" => "font-source"
                    ),
                    "default_value" => array(
                        "source" => "inherit",
                        "google" => array(
                            "family" => "Open Sans",
                            "variant" => "regular",
                            "subset" => "latin"
                        ),
                        "uploaded" => ""
                    ),
                    "directives" => [
                        array(
                            "tag" => "embed-font-source",
                            "attrs" => array(
                                "selector" => "@id .kong-advanceText__content"
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.box_shadow",
                    "attrs" => array(
                        "label" => "Text Shadow",
                        "type" => "box-shadow"
                    ),
                    "default_value" => "none",
                    "styles" => array(
                        "@id .kong-advanceText__content" => array(
                            "textShadow" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Container Max Width",
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
                        "@id .kong-advanceText__content" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
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
                        "config" => ["Support","Typography","Hover Effect","Tilt Hover Effect"]
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
<div class="kong-dnd__emptyItem" style="height:60px;" ng-if="!$ctrl.edited.content">
    <span class="kong-dnd__emptyItem__label">Advanced Text</span>
</div>

<div class="kong-advanceText {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.hidden]">
    <kong-tag-wrap id="{{$ctrl.edited.attrs.id}}" tag-class="$ctrl.edited.attrs.class" model="$ctrl.edited" tag-name="$ctrl.edited.attrs.tag" selector="kong-advanceText__content"></kong-tag-wrap>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('lfb_advance_text', 'lfb_advance_text_callback');
function lfb_advance_text_callback($attrs, $content = '') {
	$attrs = shortcode_atts(array(
		'class_id' => '',
		'id' => '',
		'class' => '',
		'hidden' => '',
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
		'tag' => 'h3'
	), $attrs, KongFooterBuilderClient::KONG_SHORTCODE_ATTS_FILTER);


	$classes = array();
	if ($attrs['hidden']) {
		$classes[] = $attrs['hidden'];
	}

    $attrs['animation'] = json_decode($attrs['animation'], true);
	$animation = kong_form_animation_data($attrs['animation']);

	$classes[] = $attrs['class_id'];
	$id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';
	if($attrs['class']){
		$attrs['class'] = ' '.$attrs['class'];
	}

	ob_start(); ?>
	<div class="kong-advanceText <?php echo implode(' ', $classes); ?>"<?php echo $animation; ?>>
		<<?php echo $attrs['tag']; ?> class="kong-advanceText__content<?php echo $attrs['class']; ?>"<?php echo $id; ?>><?php echo do_shortcode($content); ?></<?php echo $attrs['tag'] ?>>
	</div>
	<?php
	return ob_get_clean();
}