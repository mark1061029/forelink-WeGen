<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
	"name" => "Entry Heading",
	"tag" => "heading",
	"keywords" => ["entry heading","typography"],
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
					"bind_to" => "@content",
					"attrs" => array(
						"fullwidth" => true,
						"type" => "rich-editor"
					),
					"default_value" => ""
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.level",
					"attrs" => array(
						"label" => "Level",
						"type" => "tag",
						"config" => ["h1","h2","h3","h4","h5","h6"]
					),
					"default_value" => "h3"
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
    <span class="kong-dnd__emptyItem__label">Entry Heading</span>
</div>

<kong-tag-wrap ng-class="[$ctrl.edited.attrs.hidden]" prefix="true" id="{{$ctrl.edited.attrs.id}}" tag-class="$ctrl.edited.attrs.class" model="$ctrl.edited" tag-name="$ctrl.edited.attrs.level" selector="{{::$ctrl.getID()}}"></kong-tag-wrap>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_heading', 'kong_heading_callback');
function kong_heading_callback($attrs, $content = null) {
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

	$attrs['animation'] = json_decode($attrs['animation'], true);
	$animation = kong_form_animation_data($attrs['animation']);

	if ($attrs['class']) {
		$classes[] = $attrs['class'];
	}

	if ($attrs['hidden']) {
		$classes[] = $attrs['hidden'];
	}

	$classes[] = 'kong-' . $attrs['level'];
	$classes[] = $attrs['class_id'];
	$id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

	ob_start(); ?>
	<<?php echo $attrs['level']; ?> class="<?php echo implode(' ', $classes); ?>"<?php echo $id.$animation; ?>>
	<?php echo do_shortcode($content); ?>
	</<?php echo $attrs['level']; ?>>
	<?php
	return ob_get_clean();
}