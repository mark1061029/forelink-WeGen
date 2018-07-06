<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Section",
    "tag" => "section",
    "native" => true,
    "core" => true,
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Layout",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.spacing",
                    "attrs" => array(
                        "type" => "res-spacing",
                        "fullwidth" => true,
                        "config" => array(
                            "margin" => ["1","0","1","0"],
                            "border" => ["1","1","1","1"],
                            "padding" => ["1","1","1","1"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => array(
                            "padding" => "0px 0px 0px 0px",
                            "margin" => "0px 0px 0px 0px",
                            "border" => "0px 0px 0px 0px"
                        )
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "padding" => "{{@model.padding}}",
                            "margin" => "{{@model.margin}}",
                            "borderWidth" => "{{@model.border}}"
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
                        "@id" => array(
                            "borderStyle" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.border_color",
                    "show" => "@attrs.border_style != 'none'",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors['border'],
                    "styles" => array(
                        "@id" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.fullwidth",
                    "attrs" => array(
                        "label" => "Fullwidth",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.min_height",
                    "attrs" => array(
                        "label" => "Min Height",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => ["px","%","vh"]
                        ),
                        "desc" => "Specify the minimum height of this section. This value is based on the percentage of your screen device."
                    ),
                    "default_value" => array(
                        "desktop" => "0vh"
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "minHeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_align",
                    "attrs" => array(
                        "label" => "Content Alignment",
                        "type" => "h-align"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.text_align",
                    "attrs" => array(
                        "label" => "Text Align",
                        "type" => "res-text-align"
                    ),
                    "default_value" => array(
                        "desktop" => ""
                    ),
                    "responsive_styles" => array(
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
                "label" => "Background",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.bg_color",
                    "attrs" => array(
                        "label" => "Background Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "",
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
                        "label" => "Style",
                        "type" => "background-style",
                        "config" => array(
                            "none" => true,
                            "color" => false,
                            "image" => true,
                            "gradient" => true,
                            "video" => true
                        )
                    ),
                    "default_value" => "none"
                ),
                array(
                    "if" => "@attrs.bg_style == 'image'",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.bg_image",
                            "attrs" => array(
                                "label" => "Background Image",
                                "type" => "upload-image"
                            ),
                            "default_value" => array(
                                "url" => ""
                            ),
                            "styles" => array(
                                "@id > .kong-section__bg .kong-section__bg__image" => array(
                                    "backgroundImage" => "url({{@model.url}})"
                                )
                            )
                        ),
                        array(
                            "if" => "@attrs.bg_image.url",
                            "content" => [
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.bg_props",
                                    "attrs" => array(
                                        "type" => "background-props",
                                        "fullwidth" => true
                                    ),
                                    "default_value" => array(
                                        "repeat" => "no-repeat",
                                        "position" => "50% 50%",
                                        "size" => "cover",
                                        "attachment" => ""
                                    ),
                                    "styles" => array(
                                        "@id > .kong-section__bg .kong-section__bg__image" => array(
                                            "backgroundRepeat" => "{{@model.repeat}}",
                                            "backgroundPosition" => "{{@model.position}}",
                                            "backgroundSize" => "{{@model.size}}",
                                            "backgroundAttachment" => "{{@model.attachment}}"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.bg_effect",
                                    "attrs" => array(
                                        "label" => "Background Animation",
                                        "type" => "text-buttons",
                                        "config" => array(
                                            "options" => array(
                                                "none" => "None",
                                                "parallax" => "Parallax",
                                                "x" => "x",
                                                "y" => "y"
                                            )
                                        )
                                    ),
                                    "default_value" => "none"
                                )
                            ]
                        )
                    ]
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
                            "radial" => true
                        )
                    ),
                    "default_value" => array(
                        "color_1" => "#f6fbfc",
                        "color_2" => "#f5f7fc",
                        "color_3" => "#e2e6f4",
                        "angle" => 180,
                        "radial" => false,
                        "radial_x" => "center",
                        "radial_y" => "bottom",
                        "value" => "linear-gradient(180deg, #f6fbfc, #f5f7fc, #e2e6f4)"
                    ),
                    "styles" => array(
                        "@id.kong-section--bgStyle-gradient" => array(
                            "background" => "{{@model.value}}"
                        )
                    )
                ),
                array(
                    "if" => "@attrs.bg_style == 'video'",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.yt_video_id",
                            "attrs" => array(
                                "label" => "Youtube Video ID",
                                "type" => "text"
                            ),
                            "default_value" => "dA8Smj5tZOQ"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.start_time",
                            "attrs" => array(
                                "label" => "From Second",
                                "type" => "number",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 1000,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 0
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.end_time",
                            "attrs" => array(
                                "label" => "To Second",
                                "type" => "number",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 1000,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 30
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.yt_capture_image",
                            "attrs" => array(
                                "label" => "Capture Image",
                                "type" => "upload-image"
                            ),
                            "default_value" => array(
                                "url" => ""
                            ),
                            "styles" => array(
                                "@id .kong-youtubeBackground__capture" => array(
                                    "backgroundImage" => "url({{@model.url}})"
                                )
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Overlay",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.overlay",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.overlay",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.overlay_bg",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "gradient",
                                "config" => array(
                                    "third_color" => false,
                                    "radial" => false
                                )
                            ),
                            "default_value" => array(
                                "color_1" => "rgba(0,0,0,0.4)",
                                "color_2" => "rgba(0,0,0,0.4)",
                                "angle" => 90,
                                "value" => "linear-gradient(90deg, rgba(0,0,0,0.4), rgba(0,0,0,0.4))"
                            ),
                            "styles" => array(
                                "@id .kong-section__overlay" => array(
                                    "background" => "{{@model.value}}"
                                )
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Half Background",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.half_bg",
                    "attrs" => array(
                        "label" => "Half Background",
                        "type" => "res-class",
                        "config" => array(
                            "prefix" => "kong-section",
                            "suffix" => "halfBg",
                            "devices" => ["desktop","tablet"]
                        ),
                        "desc" => "Select the device where a background panel will show on a half of this section."
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.half_bg_color",
                    "if" => "@attrs.half_bg",
                    "attrs" => array(
                        "label" => "Background Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#000000",
                    "styles" => array(
                        "@id[class*='-halfBg']:before" => array(
    "backgroundColor" => "{{@model}}"
)
					)
				)
			]
		),
		array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Top Separator",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.top_separator",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Horizontally display a divider on top of this section."
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.top_separator",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.top_sp_style",
                            "attrs" => array(
                                "label" => "Style",
                                "type" => "selection",
                                "config" => array(
                                    "half-circle" => "Half Circle",
                                    "triangle-1" => "Triangle 1",
                                    "triangle-2" => "Triangle 2",
                                    "triangle-3" => "Triangle 3",
                                    "triangle-4" => "Triangle 4",
                                    "triangle-5" => "Triangle 5",
                                    "stamp" => "Stamp",
                                    "cloud-1" => "Clouds 1",
                                    "cloud-2" => "Clouds 2",
                                    "arrow" => "Arrow",
                                    "oval-1" => "Oval 1",
                                    "oval-2" => "Oval 2",
                                    "wave-1" => "Wave 1",
                                    "wave-2" => "Wave 2",
                                    "wave-3" => "Wave 3",
                                    "wave-4" => "Wave 4"
                                )
                            ),
                            "default_value" => "half-circle"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.top_sp_width",
                            "attrs" => array(
                                "label" => "Width",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 100,
                                    "max" => 600,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 100
                            ),
                            "responsive_styles" => array(
                                "@id > .kong-section__sp--top > svg" => array(
                                    "width" => "{{@model}}%"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.top_sp_height",
                            "attrs" => array(
                                "label" => "Height",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 10,
                                    "max" => 500,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 100
                            ),
                            "responsive_styles" => array(
                                "@id > .kong-section__sp--top > svg" => array(
                                    "height" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.top_sp_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#000000",
                            "styles" => array(
                                "@id > .kong-section__sp--top svg *" => array(
                                    "fill" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.top_sp_flip",
                            "attrs" => array(
                                "label" => "Flip",
                                "type" => "image-buttons",
                                "config" => array(
                                    "kong-section__sp--flipX" => "flip-x.svg",
                                    "kong-section__sp--flipY" => "flip-y.svg",
                                    "kong-section__sp--flipXY" => "flip-xy.svg"
                                )
                            ),
                            "default_value" => "kong-section__sp--flipY"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.top_sp_front",
                            "attrs" => array(
                                "label" => "Front",
                                "type" => "switch"
                            ),
                            "default_value" => false
                        )
                    ]
                )
            ]
        ),
		array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Bottom Separator",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btm_separator",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch",
                        "desc" => "Horizontally display a divider on bottom of this section."
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.btm_separator",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.btm_sp_style",
                            "attrs" => array(
                                "label" => "Style",
                                "type" => "selection",
                                "config" => array(
                                    "half-circle" => "Half Circle",
                                    "triangle-1" => "Triangle 1",
                                    "triangle-2" => "Triangle 2",
                                    "triangle-3" => "Triangle 3",
                                    "triangle-4" => "Triangle 4",
                                    "triangle-5" => "Triangle 5",
                                    "stamp" => "Stamp",
                                    "cloud-1" => "Clouds 1",
                                    "cloud-2" => "Clouds 2",
                                    "arrow" => "Arrow",
                                    "oval-1" => "Oval 1",
                                    "oval-2" => "Oval 2",
                                    "wave-1" => "Wave 1",
                                    "wave-2" => "Wave 2",
                                    "wave-3" => "Wave 3",
                                    "wave-4" => "Wave 4"
                                )
                            ),
                            "default_value" => "half-circle"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.btm_sp_width",
                            "attrs" => array(
                                "label" => "Width",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 100,
                                    "max" => 600,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 100
                            ),
                            "responsive_styles" => array(
                                "@id > .kong-section__sp--btm > svg" => array(
                                    "width" => "{{@model}}%"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.btm_sp_height",
                            "attrs" => array(
                                "label" => "Height",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 10,
                                    "max" => 500,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 100
                            ),
                            "responsive_styles" => array(
                                "@id > .kong-section__sp--btm > svg" => array(
                                    "height" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.btm_sp_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#000000",
                            "styles" => array(
                                "@id > .kong-section__sp--btm svg *" => array(
                                    "fill" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.btm_sp_flip",
                            "attrs" => array(
                                "label" => "Flip",
                                "type" => "image-buttons",
                                "config" => array(
                                    "kong-section__sp--flipX" => "flip-x.svg",
                                    "kong-section__sp--flipY" => "flip-y.svg",
                                    "kong-section__sp--flipXY" => "flip-xy.svg"
                                )
                            ),
                            "default_value" => ""
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.btm_sp_front",
                            "attrs" => array(
                                "label" => "Front",
                                "type" => "switch"
                            ),
                            "default_value" => false
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
<div class="kong-section {{::$ctrl.getID()}}"
     ng-class="[$ctrl.section.attrs.half_bg, $ctrl.section.attrs.class, $ctrl.section.attrs.hidden,'kong-section--bgStyle-'+$ctrl.section.attrs.bg_style, 'kong-section--align-'+$ctrl.section.attrs.content_align]" id="{{$ctrl.section.attrs.id}}">

    <div class="kong-section__bg" ng-class="'kong-section__bg--'+$ctrl.section.attrs.bg_effect"><div kong-parallax="$ctrl.section.attrs.bg_effect" class="kong-section__bg__image"></div></div>

    <div ng-if="$ctrl.section.attrs.bg_style == 'video'" class="kong-youtubeBackground" youtube-background section-id="::$ctrl.getID()" video-id="$ctrl.section.attrs.yt_video_id" start-time="$ctrl.section.attrs.start_time" end-time="$ctrl.section.attrs.end_time" capture-image="$ctrl.section.attrs.yt_capture_image">
        <div class="kong-youtubeBackground__capture"></div>
    </div>

    <div class="kong-section__overlay" ng-show="$ctrl.edited.attrs.overlay"></div>

    <div class="kong-section__sp kong-section__sp--top"
         ng-if="$ctrl.section.attrs.top_separator"
         kong-section-separator="$ctrl.section.attrs.top_sp_style"
         ng-class="[{'kong-section__sp--front':$ctrl.section.attrs.top_sp_front},$ctrl.section.attrs.top_sp_flip]"></div>

    <div class="kong-section__sp kong-section__sp--btm"
         ng-if="$ctrl.section.attrs.btm_separator"
         kong-section-separator="$ctrl.section.attrs.btm_sp_style"
         ng-class="[{'kong-section__sp--front':$ctrl.section.attrs.btm_sp_front},$ctrl.section.attrs.btm_sp_flip]"></div>

    <div class="kong-dnd__dropMe kong-dnd__dropMe--lv1">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="kong-dnd__visual kong-dnd__visual--lv1 lvh__{{::$ctrl.getID()}}" kong-detect-hover-node="$ctrl.section">
        <div class="kong-dnd__visual__label" kong-keep-visual-label>
            <div class="kong-dnd__visual__label__name">
                <span ng-bind="::$ctrl.section.name"></span>
            </div>
        </div>
        <kong-action current="$ctrl.section"></kong-action>
    </div>

    <div class="kong-container" ng-class="{'kong-container--fullwidth': $ctrl.section.attrs.fullwidth}">
        <kong-row-list section="$ctrl.section"></kong-row-list>
    </div>
</div>

<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);


add_shortcode('kong_section', 'kong_section_callback');
function kong_section_callback($attrs, $content = '') {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'half_bg' => '',
        'hidden' => '',
        'fullwidth' => 'false',
        'overlay' => 'false',
        'bg_style' => 'none',
        'bg_effect' => '',
        'content_align' => '',
        'yt_video_id' => 'dA8Smj5tZOQ',
        'start_time' => 0,
        'end_time' => 30,
        'top_separator' => 'false',
        'top_sp_style' => 0,
        'top_sp_flip' => '',
        'top_sp_front' => 'false',
        'btm_separator' => 'false',
        'btm_sp_style' => 0,
        'btm_sp_flip' => '',
        'btm_sp_front' => 'false'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if ($attrs['half_bg']) {
        $classes[] = $attrs['half_bg'];
    }

    if ($attrs['bg_style'] != 'none' && $attrs['bg_style'] != 'color') {
        $classes[] = 'kong-section--bgStyle-' . $attrs['bg_style'];
    }

    if($attrs['content_align'] && $attrs['content_align'] != 'top'){
        $classes[] = 'kong-section--align-' . $attrs['content_align'];
    }

    $classes[] = $attrs['class_id'];

    $fullwidth = kong_to_boolean($attrs['fullwidth']) ? ' kong-container--fullwidth': '';
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-section <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>

        <?php
        if ($attrs['bg_style'] == 'image') :
            $bg_class = '';
            if ($attrs['bg_effect'] != 'none') {
                $bg_class = ' kong-section__bg--' . $attrs['bg_effect'];
            }
            ?>
            <div class="kong-section__bg<?php echo $bg_class; ?>">
                <div class="kong-section__bg__image"></div>
            </div>
            <?php
        endif;
        ?>

        <?php if ($attrs['bg_style'] == 'video') : ?>
            <div class="kong-youtubeBackground" data-section-id="<?php echo $attrs['class_id']; ?>"
                 data-video-id="<?php echo $attrs['yt_video_id']; ?>"
                 data-start-time="<?php echo $attrs['start_time']; ?>"
                 data-end-time="<?php echo $attrs['end_time']; ?>">
                <div class="kong-youtubeBackground__capture"></div>
            </div>
        <?php endif; ?>

        <?php if (kong_to_boolean($attrs['overlay'])) : ?>
            <div class="kong-section__overlay"></div>
        <?php endif; ?>

        <?php if (kong_to_boolean($attrs['top_separator'])) : ?>
            <?php
            $classes = 'kong-section__sp kong-section__sp--top';

            if (kong_to_boolean($attrs['top_sp_front'])) {
                $classes .= ' kong-section__sp--front';
            }

            if($attrs['top_sp_flip']){
                $classes .= ' '.$attrs['top_sp_flip'];
            }
            ?>
            <div class="<?php echo $classes; ?>">
                <?php echo kong_get_section_separator($attrs['top_sp_style']); ?>
            </div>
        <?php endif; ?>

        <?php if (kong_to_boolean($attrs['btm_separator'])) : ?>
            <?php
            $classes = 'kong-section__sp kong-section__sp--btm';

            if (kong_to_boolean($attrs['btm_sp_front'])) {
                $classes .= ' kong-section__sp--front';
            }

            if($attrs['btm_sp_flip']){
                $classes .= ' '.$attrs['btm_sp_flip'];
            }
            ?>
            <div class="<?php echo $classes; ?>">
                <?php echo kong_get_section_separator($attrs['btm_sp_style']); ?>
            </div>
        <?php endif; ?>

        <div class="kong-container<?php echo $fullwidth; ?>"><?php echo do_shortcode($content); ?></div>
    </div>
    <?php
    return ob_get_clean();
}