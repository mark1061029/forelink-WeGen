<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Stars",
    "tag" => "stars",
    "keywords" => ["star","rating"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Setting",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.star",
                    "attrs" => array(
                        "label" => "Range",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0.5,
                            "max" => 5,
                            "step" => 0.5
                        )
                    ),
                    "default_value" => 3
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" =>  $manager::$colors["primary"],
                    "styles" => array(
                        "@id" => array(
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
                            "min" => 8,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 20
                    ),
                    "responsive_styles" => array(
                        "@id i" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.margin",
                    "attrs" => array(
                        "label" => "Distance",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 20,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 2
                    ),
                    "responsive_styles" => array(
                        "@id i" => array(
                            "margin" => "0 {{@model}}px"
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
                        "type" => "animation",
                        "config" => array(
                            "group" => true
                        )
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
                        "reset" => false,
                        "interval" => 50
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
<div class="kong-stars {{::$ctrl.getID()}}" id="{{$ctrl.edited.attrs.id}}"
     ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" frontend-compile delay="100" model="$ctrl.edited" callback="bindStarCreator" attrs="['star']">
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_stars', 'kong_stars_callback');
function kong_stars_callback($attrs, $content) {
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
            'reset' => 'false',
            'interval' => 50
        )),
        'hidden' => '',
        'star' => 3
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $attrs['animation']['selector'] = '.fa';
    $animation = kong_form_animation_data($attrs['animation']);

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    $starTag = '';
    $number = $attrs['star'];
    $fullStar = floor($number);
    $halfStar = $number - $fullStar;

    for($i=0; $i<$fullStar; $i++) {
        $starTag .= '<i class="fa fa-star"></i>';
    }

    if($halfStar > 0) {
        $starTag .= '<i class="fa fa-star-half-o"></i>';
    }

    ob_start(); ?>
    <div class="kong-stars <?php echo implode(' ', $classes); ?>"<?php echo $id.$animation; ?>>
        <?php echo $starTag; ?>
    </div>
    <?php
    return ob_get_clean();
}