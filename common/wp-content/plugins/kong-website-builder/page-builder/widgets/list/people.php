<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
	"name" => "People",
	"tag" => "people",
	"keywords" => ["people","avatar"],
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
					"bind_to" => "@attrs.avatar",
					"attrs" => array(
						"label" => "Avatar",
						"type" => "upload-image"
					),
					"default_value" => array(
						"url" => ""
					),
					"styles" => array(
						"@id .kong-people__avatar__image" => array(
							"backgroundImage" => "url({{@model.url}})"
						)
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
						"url" => "#",
						"new_tab" => true
					)
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.name",
					"attrs" => array(
						"label" => "Name",
						"type" => "text"
					),
					"default_value" => "John Doe"
				)
			]
		),
		array(
			"tag" => "editor-container",
			"attrs" => array(
				"label" => "Alignment",
				"collapsed" => false
			),
			"content" => [
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.align",
					"attrs" => array(
						"label" => "Align",
						"type" => "res-selection",
						"config" => array(
							"default" => "Default",
							"center" => "Center",
							"spaceBetween" => "Space Between"
						)
					),
					"default_value" => array(
						"desktop" => "default"
					)
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.reverse",
					"attrs" => array(
						"label" => "Reversed",
						"type" => "res-class",
						"config" => array(
							"prefix" => "kong-people",
							"devices" => ["desktop","tablet","mobile"],
							"suffix" => "reversed"
						),
						"desc" => "Select the devices to swap positions between icon & content."
					),
					"default_value" => ""
				)
			]
		),
		array(
			"tag" => "editor-container",
			"attrs" => array(
				"label" => "Size & Style",
				"collapsed" => false
			),
			"content" => [
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.avatar_size",
					"attrs" => array(
						"label" => "Avatar",
						"type" => "slider",
						"config" => array(
							"min" => 30,
							"max" => 100,
							"step" => 1
						)
					),
					"default_value" => 60,
					"styles" => array(
						"@id .kong-people__avatar__image" => array(
							"width" => "{{@model}}px"
						)
					)
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.name_size",
					"attrs" => array(
						"label" => "Name",
						"type" => "slider",
						"config" => array(
							"min" => 10,
							"max" => 30,
							"step" => 1
						)
					),
					"default_value" => 13,
					"styles" => array(
						"@id .kong-people__name" => array(
							"fontSize" => "{{@model}}px"
						)
					)
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.name_letter_spacing",
					"attrs" => array(
						"label" => "Letter Spacing",
						"type" => "slider",
						"config" => array(
							"min" => -0.1,
							"max" => 0.5,
							"step" => 0.01
						)
					),
					"default_value" => 0.05,
					"styles" => array(
						"@id .kong-people__name" => array(
							"letterSpacing" => "{{@model}}em"
						)
					)
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.name_weight",
					"attrs" => array(
						"label" => "Name Font Weight",
						"type" => "slider",
						"config" => array(
							"min" => 100,
							"max" => 900,
							"step" => 100
						)
					),
					"default_value" => 700,
					"styles" => array(
						"@id .kong-people__name" => array(
							"fontWeight" => "{{@model}}"
						)
					)
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.name_text_transform",
					"attrs" => array(
						"label" => "Text Transform",
						"type" => "text-transform"
					),
					"default_value" => "uppercase",
					"styles" => array(
						"@id .kong-people__name" => array(
							"textTransform" => "{{@model}}"
						)
					)
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.name_color",
					"attrs" => array(
						"label" => "Name",
						"type" => "colorpicker"
					),
					"default_value" => $manager::$colors["heading"],
					"styles" => array(
						"@id .kong-people__name" => array(
							"color" => "{{@model}}"
						)
					)
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.job_size",
					"attrs" => array(
						"label" => "Job",
						"type" => "slider",
						"config" => array(
							"min" => 10,
							"max" => 30,
							"step" => 1
						)
					),
					"default_value" => 13,
					"styles" => array(
						"@id .kong-people__job" => array(
							"fontSize" => "{{@model}}px"
						)
					)
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.job",
					"attrs" => array(
						"label" => "Job",
						"type" => "text"
					),
					"default_value" => "Web Designer"
				),
				array(
					"tag" => "editor-field",
					"bind_to" => "@attrs.job_color",
					"attrs" => array(
						"label" => "Job",
						"type" => "colorpicker"
					),
					"default_value" => $manager::$colors["desc"],
					"styles" => array(
						"@id .kong-people__job" => array(
							"color" => "{{@model}}"
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
<div class="kong-dnd__emptyItem" style="height:60px;" ng-if="!$ctrl.edited.attrs.avatar.url">
    <span class="kong-dnd__emptyItem__label">People</span>
</div>

<div class="kong-people {{::$ctrl.getID()}}" id="{{$ctrl.edited.attrs.id}}" ng-class="[$ctrl.edited.attrs.reverse,$ctrl.service.formResClass($ctrl.edited.attrs.align, 'kong-people'), $ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]">
    <div class="kong-people__avatar">
        <a class="kong-people__avatar__image"></a>
    </div>
    <div class="kong-people__info">
        <h6 class="kong-people__name" kong-editable model="$ctrl.edited" config="{target:'attrs.name', editorType:'1'}" ng-bind-html="$ctrl.edited.attrs.name"></h6>
        <div class="kong-people__job" kong-editable model="$ctrl.edited" config="{target:'attrs.job', editorType:'1'}" ng-bind-html="$ctrl.edited.attrs.job"></div>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_people', 'kong_people_callback');
function kong_people_callback($attrs) {
	$attrs = shortcode_atts(array(
		'class_id' => '',
		'class' => '',
		'id' => '',
		'hidden' => '',
		'reverse' => '',
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
		'align' => json_encode(array(
			'desktop' => 'default'
		)),
		'name' => 'John Doe',
		'job' => 'Web Designer',
		'link' => json_encode(array(
			'url' => '#',
			'new_tab' => 'false'
		))
	), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

	$attrs['link'] = json_decode($attrs['link'], true);
	$classes = array();

	if ($attrs['class']) {
		$classes[] = $attrs['class'];
	}

	if ($attrs['hidden']) {
		$classes[] = $attrs['hidden'];
	}

	if ($attrs['reverse']) {
		$classes[] = $attrs['reverse'];
	}

	$attrs['align'] = json_decode($attrs['align'], true);
	$align = kong_form_res_class($attrs['align'], 'kong-people');
	if($align){
		$classes[] = $align;
	}

	$attrs['animation'] = json_decode($attrs['animation'], true);
	$animation = kong_form_animation_data($attrs['animation']);

	$classes[] = $attrs['class_id'];
	$id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

	if (!empty($attrs['link']['url'])) {
		$target = kong_to_boolean($attrs['link']['new_tab']) ? ' target="_blank"' : '';
		$link_before = '<a href="' . $attrs['link']['url'] . '" class="kong-people__avatar__image"' . $target . '>';
		$link_after = '</a>';
	} else {
		$link_before = '<span class="kong-people__avatar__image">';
		$link_after = '</span>';
	}

	ob_start(); ?>
	<div class="kong-people <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>">
		<div class="kong-people__avatar"<?php echo $animation;?>>
			<?php echo $link_before . $link_after; ?>
		</div>
		<div class="kong-people__info">
			<h6 class="kong-people__name"><?php echo html_entity_decode($attrs['name']); ?></h6>
			<?php if($attrs['job']): ?>
			<div class="kong-people__job"><?php echo html_entity_decode($attrs['job']); ?></div>
			<?php endif; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}