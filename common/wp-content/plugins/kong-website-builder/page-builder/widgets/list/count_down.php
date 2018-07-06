<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Count Down",
    "tag" => "count_down",
    "keywords" => ["time","count down"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Time",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.time",
                    "attrs" => array(
                        "label" => "Time",
                        "type" => "text",
                        "desc" => "Enter the 6 numbers with the format month/day/year hour:minute:second<br/>Eg: <strong>12/12/2018 00:00:00</strong>"
                    ),
                    "default_value" => "05/12/2018 00:00:00"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc",
                    "attrs" => array(
                        "label" => "Desc",
                        "type" => "textarea",
                        "desc" => "Enter text for days, hours, minutes and seconds. Separated each word by a comma."
                    ),
                    "default_value" => "Days,Hours,Mins,Secs"
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
                    "bind_to" => "@attrs.width",
                    "attrs" => array(
                        "label" => "Width",
                        "type" => "res-unit"
                    ),
                    "default_value" => array(
                        "desktop" => "150px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-countDown__col" => array(
                            "width" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.inline",
                    "attrs" => array(
                        "label" => "Display Inline",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.align",
                    "attrs" => array(
                        "label" => "Text Align",
                        "type" => "text-align"
                    ),
                    "default_value" => "center",
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
                "label" => "Number",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_width",
                    "attrs" => array(
                        "label" => "Width",
                        "type" => "res-unit"
                    ),
                    "default_value" => array(
                        "desktop" => "120px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-countDown__num" => array(
                            "width" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-unit"
                    ),
                    "default_value" => array(
                        "desktop" => "110px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-countDown__num" => array(
                            "height" => "{{@model}}",
                            "lineHeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_bg",
                    "attrs" => array(
                        "label" => "Gradient",
                        "type" => "gradient",
                        "config" => array(
                            "third_color" => false,
                            "radial" => true
                        )
                    ),
                    "default_value" => array(
                        "color_1" => "rgba(54,54,54,1)",
                        "color_2" => "rgba(0,0,0,1)",
                        "angle" => 220,
                        "radial" => false,
                        "radial_x" => "center",
                        "radial_y" => "bottom",
                        "value" => "radial-gradient(circle at bottom center, rgba(54,54,54,1), rgba(0,0,0,1))"
                    ),
                    "styles" => array(
                        "@id .kong-countDown__num" => array(
                            "background" => "{{@model.value}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 58
                    ),
                    "responsive_styles" => array(
                        "@id .kong-countDown__num" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_weight",
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
                        "@id .kong-countDown__num" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_letter_spacing",
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
                        "@id .kong-countDown__num" => array(
                            "letterSpacing" => "{{@model}}em",
                            "textIndent" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-countDown__num" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_font_source",
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
                        "uploaded" => ""
                    ),
                    "directives" => [
                        array(
                            "tag" => "embed-font-source",
                            "attrs" => array(
                                "selector" => "@id .kong-countDown__num"
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "0px 0px 0px 0px",
                    "styles" => array(
                        "@id .kong-countDown__num" => array(
                            "borderWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_border_color",
                    "if" => "@attrs.num_border_width != '0px 0px 0px 0px'",
                    "attrs" => array(
                        "label" => "Border Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#e8e8e8",
                    "styles" => array(
                        "@id .kong-countDown__num" => array(
                            "borderColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num_border_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 150,
                            "step" => 1
                        )
                    ),
                    "default_value" => 8,
                    "styles" => array(
                        "@id .kong-countDown__num" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Desc Text",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 120,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 13
                    ),
                    "responsive_styles" => array(
                        "@id .kong-countDown__desc" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_margin",
                    "attrs" => array(
                        "label" => "Margin",
                        "type" => "res-area",
                        "config" => array(
                            "min" => -100,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "15px 0px 15px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-countDown__desc" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_weight",
                    "attrs" => array(
                        "label" => "Weight",
                        "type" => "slider",
                        "config" => array(
                            "min" => 100,
                            "max" => 900,
                            "step" => 100
                        )
                    ),
                    "default_value" => 600,
                    "styles" => array(
                        "@id .kong-countDown__desc" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.2,
                            "max" => 1,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.05,
                    "styles" => array(
                        "@id .kong-countDown__desc" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id .kong-countDown__desc" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_align",
                    "attrs" => array(
                        "label" => "Text Align",
                        "type" => "text-align"
                    ),
                    "default_value" => "center",
                    "styles" => array(
                        "@id .kong-countDown__desc" => array(
                            "textAlign" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-countDown__desc" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_font_source",
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
                        "uploaded" => ""
                    ),
                    "directives" => [
                        array(
                            "tag" => "embed-font-source",
                            "attrs" => array(
                                "selector" => "@id .kong-countDown__desc"
                            )
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
<div class="kong-dnd__emptyItem" style="height:60px;" ng-if="!$ctrl.edited.attrs.time">
    <span class="kong-dnd__emptyItem__label">COUNT DOWN</span>
</div>

<div frontend-compile model="$ctrl.edited" callback="bindCountDown" attrs="['desc', 'time']" destroy-callback="onCountDownDestroy" class="kong-countDown {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class, {'kong-countDown--inline':$ctrl.edited.attrs.inline}]"
     id="{{$ctrl.edited.attrs.id}}">
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_count_down', 'kong_count_down_callback');
function kong_count_down_callback($attrs, $content) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'desc' => 'Days,Hours,Mins,Secs',
        'time' => '05/12/2018 00:00:00',
        'inline' => 'false'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if(kong_to_boolean($attrs['inline'])){
        $classes[] = 'kong-countDown--inline';
    }

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    $settings = array();

    if($attrs['desc']){
        $settings['desc'] = $attrs['desc'];
    }

    if($attrs['time']){
        $settings['time'] = $attrs['time'];
    }

    $countDownDate = strtotime($attrs['time']);
    $distance = $countDownDate - time();

    $sample = array('Days', 'Hours', 'Mins', 'Second');

    if(!empty($attrs['desc'])){
        $tokens = explode(',', str_replace(' ', '', $attrs['desc']));
        for ($i = 0; $i < 4; $i++){
            if(empty($tokens[$i])){
                $tokens[$i] = $sample[$i];
            }
        }
    }else{
        $tokens = $sample;
    }

    if ($distance < 0) {
        $days = '00';
        $hours = '00';
        $minutes = '00';
        $seconds = '00';

    }else{
        $days = floor($distance / (60 * 60 * 24));
        $days = $days > 9 ? $days : '0' . $days;
        $hours = floor(($distance % (60 * 60 * 24)) / (60 * 60));
        $hours = $hours > 9 ? $hours : '0' . $hours;
        $minutes = floor(($distance % (60 * 60)) / 60);
        $minutes = $minutes > 9 ? $minutes : '0' . $minutes;
        $seconds = floor($distance % 60);
        $seconds = $seconds > 9 ? $seconds : '0' . $seconds;
    }

    ob_start(); ?>
    <div class="kong-countDown <?php echo implode(' ', $classes); ?>" data-settings="<?php echo esc_attr(json_encode($settings)); ?>"<?php echo $id; ?>>
        <div class="kong-countDown__col">
            <span class="kong-countDown__num"><?php echo $days; ?></span>
            <span class="kong-countDown__desc"><?php echo $tokens[0]; ?></span>
        </div>
        <div class="kong-countDown__col">
            <span class="kong-countDown__num"><?php echo $hours; ?></span>
            <span class="kong-countDown__desc"><?php echo $tokens[1]; ?></span>
        </div>
        <div class="kong-countDown__col">
            <span class="kong-countDown__num"><?php echo $minutes; ?></span>
            <span class="kong-countDown__desc"><?php echo $tokens[2]; ?></span>
        </div>
        <div class="kong-countDown__col">
            <span class="kong-countDown__num"><?php echo $seconds; ?></span>
            <span class="kong-countDown__desc"><?php echo $tokens[3]; ?></span>
        </div>
    </div>
    <?php
    return ob_get_clean();
}