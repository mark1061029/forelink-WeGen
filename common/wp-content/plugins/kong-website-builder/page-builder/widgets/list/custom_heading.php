<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
	"name" => "Heading",
	"tag" => "custom_heading",
	"keywords" => ["custom heading","typography"],
	"native" => true,
	"filter" => "text",
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
					"bind_to" => "@attrs.level",
					"attrs" => array(
						"label" => "Level",
						"type" => "tag",
						"config" => ["h1","h2","h3","h4","h5","h6"]
					),
					"default_value" => "h3"
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@content",
					"attrs" => array(
						"fullwidth" => true,
						"type" => "rich-editor"
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
						"label" => "Font Size",
						"type" => "res-slider",
						"config" => array(
							"min" => 8,
							"max" => 100,
							"step" => 1
						)
					),
					"default_value" => array(
						"desktop" => 24
					),
					"responsive_styles" => array(
						"@id" => array(
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
						"desktop" => "0px 0px 20px 0px"
					),
					"responsive_styles" => array(
						"@id" => array(
							"margin" => "{{@model}}"
						)
					)
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
					"default_value" => 700,
					"styles" => array(
						"@id" => array(
							"fontWeight" => "{{@model}}"
						)
					)
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.transform",
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
							"min" => -0.2,
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
					"bind_to" => "@attrs.color",
					"attrs" => array(
						"label" => "Color",
						"type" => "colorpicker"
					),
					"default_value" => $manager::$colors["heading"],
					"styles" => array(
						"@id" => array(
							"color" => "{{@model}}"
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
    <span class="kong-dnd__emptyItem__label">Heading</span>
</div>

<kong-tag-wrap ng-class="[$ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}" model="$ctrl.edited" tag-text="$ctrl.edited.content" tag-name="$ctrl.edited.attrs.level" selector="{{::$ctrl.getID()}}"></kong-tag-wrap>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);



add_shortcode('kong_custom_heading', 'kong_custom_heading_callback');
function kong_custom_heading_callback($attrs, $content = null) {
	$attrs = shortcode_atts(array(
		'class_id' => '',
		'class' => '',
		'id' => '',
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
		'hidden' => '',
		'level' => 'h3'
	), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

	$classes = array();

	if ($attrs['class']) {
		$classes[] = $attrs['class'];
	}

	if ($attrs['hidden']) {
		$classes[] = $attrs['hidden'];
	}

	$attrs['animation'] = json_decode($attrs['animation'], true);
	$animation = kong_form_animation_data($attrs['animation']);

	$classes[] = $attrs['class_id'];
	$id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

	ob_start(); ?>
	<<?php echo $attrs['level']; ?> class="<?php echo implode(' ', $classes); ?>"<?php echo $id.$animation; ?>><?php echo $content; ?></<?php echo $attrs['level']; ?>>
	<?php
	return ob_get_clean();
}
