<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Team 2",
    "tag" => "team2",
    "keywords" => ["team","member","list"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Configuration",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model",
                    "attrs" => array(
                        "label" => "Members",
                        "type" => "image-group"
                    ),
                    "default_value" => []
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Avatar",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "slider",
                        "config" => array(
                            "min" => 60,
                            "max" => 150,
                            "step" => 1
                        )
                    ),
                    "default_value" => 100,
                    "styles" => array(
                        "@id .kong-team2__member__wrap" => array(
                            "paddingBottom" => "{{@model}}%"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.avatar_border_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 50,
                            "step" => 0.5
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-team2__member__wrap" => array(
                            "borderRadius" => "{{@model}}%"
                        ),
                        "@id .kong-team2__member__wrap .kong-team2__member__overlay" => array(
                            "borderRadius" => "{{@model}}%"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.overlay",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "gradient",
                        "config" => array(
                            "third_color" => false,
                            "radial" => false
                        )
                    ),
                    "default_value" => array(
                        "color_1" => "transparent",
                        "color_2" => "rgba(0,0,0,0.4)",
                        "angle" => 180,
                        "value" => "linear-gradient(180deg, transparent, rgba(0,0,0,0.4))"
                    ),
                    "styles" => array(
                        "@id .kong-team2__member__overlay" => array(
                            "background" => "{{@model.value}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Column & Spacing",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.column",
                    "attrs" => array(
                        "label" => "Column",
                        "type" => "res-selection",
                        "config" => array(
                            "100%" => "1 Column",
                            "50%" => "2 Columns",
                            "33.33%" => "3 Columns",
                            "25%" => "4 Columns",
                            "20%" => "5 Columns",
                            "16.666%" => "6 Columns",
                            "14.285%" => "7 Columns",
                            "12.5%" => "8 Columns",
                            "11.11%" => "9 Columns",
                            "10%" => "10 Columns"
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "20%",
                        "tablet" => "33.33%",
                        "mobile" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-team2__member" => array(
                            "width" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.spacing",
                    "attrs" => array(
                        "label" => "Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-team2__wrap" => array(
                            "margin" => "0 -{{@model}}px"
                        ),
                        "@id .kong-team2__member" => array(
                            "padding" => "0 {{@model}}px",
                            "margin" => "{{@model}}px 0"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "20px 20px 20px 20px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-team2__member__container" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.align",
                    "attrs" => array(
                        "label" => "Alignment",
                        "type" => "text-buttons",
                        "config" => array(
                            "options" => array(
                                "top" => "Top",
                                "center" => "Center",
                                "bottom" => "Bottom"
                            )
                        )
                    ),
                    "default_value" => "bottom"
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Typography & Color",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_size",
                    "attrs" => array(
                        "label" => "Name",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 18
                    ),
                    "responsive_styles" => array(
                        "@id .kong-team2__member__name" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_weight",
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
                        "@id .kong-team2__member__name" => array(
                            "fontWeight" => "{{@model}}"
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
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-team2__member__name" => array(
                            "letterSpacing" => "{{@model}}em"
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
                    "default_value" => "",
                    "styles" => array(
                        "@id .kong-team2__member__name" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_color",
                    "attrs" => array(
                        "label" => "Name Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-team2__member__name" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.position_margin",
                    "attrs" => array(
                        "label" => "Position Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "2px 0px 10px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-team2__member__position" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.position_size",
                    "attrs" => array(
                        "label" => "Position",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 13
                    ),
                    "responsive_styles" => array(
                        "@id .kong-team2__member__position" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.position_color",
                    "attrs" => array(
                        "label" => "Position Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#dddddd",
                    "styles" => array(
                        "@id .kong-team2__member__position" => array(
                            "color" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Social Icons",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_container_size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 28
                    ),
                    "responsive_styles" => array(
                        "@id .kong-team2__member__icon" => array(
                            "width" => "{{@model}}px",
                            "height" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_size",
                    "attrs" => array(
                        "label" => "Icon Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 16
                    ),
                    "responsive_styles" => array(
                        "@id .kong-team2__member__icon" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_margin",
                    "attrs" => array(
                        "label" => "Icon Margin",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 2
                    ),
                    "responsive_styles" => array(
                        "@id .kong-team2__member__icon" => array(
                            "margin" => "0 {{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_border_width",
                    "attrs" => array(
                        "label" => "Border Width",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 2,
                    "styles" => array(
                        "@id .kong-team2__member__icon" => array(
                            "borderWidth" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 100,
                    "styles" => array(
                        "@id .kong-team2__member__icon" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.brand_color",
                    "attrs" => array(
                        "label" => "Brand Color",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "if" => "!@attrs.brand_color",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.icon_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#dddddd",
                            "styles" => array(
                                "@id .kong-team2__member__icon" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.icon_hover_color",
                            "attrs" => array(
                                "label" => "Color Hover",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#ffffff",
                            "styles" => array(
                                "@id .kong-team2__member__icon:hover" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.icon_bg_color",
                            "attrs" => array(
                                "label" => "Background",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "transparent",
                            "styles" => array(
                                "@id .kong-team2__member__icon" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.icon_bg_hover_color",
                            "attrs" => array(
                                "label" => "Background Hover",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "transparent",
                            "styles" => array(
                                "@id .kong-team2__member__icon:hover" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.icon_border_color",
                            "attrs" => array(
                                "label" => "Border",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#dddddd",
                            "styles" => array(
                                "@id .kong-team2__member__icon" => array(
                                    "borderColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.icon_border_hover_color",
                            "attrs" => array(
                                "label" => "Border Hover",
                                "type" => "colorpicker"
                            ),
                            "default_value" => "#ffffff",
                            "styles" => array(
                                "@id .kong-team2__member__icon:hover" => array(
                                    "borderColor" => "{{@model}}"
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
    ],
    "child" => array(
        "name" => "Team 2 Member",
        "tag" => "team2_member",
        "native" => true,
        "content" => [
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Team Member",
                    "collapsed" => false
                ),
                "content" => [
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.image",
                        "attrs" => array(
                            "label" => "Avatar",
                            "type" => "upload-image"
                        ),
                        "default_value" => array(
                            "url" => ""
                        ),
                        "styles" => array(
                            "@id .kong-team2__member__wrap" => array(
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
                            "new_tab" => false
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
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.position",
                        "attrs" => array(
                            "label" => "Position",
                            "type" => "text"
                        ),
                        "default_value" => "Position"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.social_contacts",
                        "attrs" => array(
                            "label" => "Social Contacts",
                            "type" => "multi-social-icons"
                        ),
                        "default_value" => array(
                            "twitter" => "#",
                            "facebook" => "#"
                        )
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem" style="height:150px" ng-if="$ctrl.content.length === 0">
    <span class="kong-dnd__emptyItem__label">Team 2</span>
</div>

<div class="kong-team2 {{::$ctrl.getID()}}"
     ng-class="['kong-team2--' + $ctrl.edited.attrs.align ,$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden,{'kong-brandColor' : $ctrl.edited.attrs.brand_color}]" id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-team2__wrap">
        <div class="kong-team2__member" ng-repeat="item in $ctrl.edited.content track by $index">
            <div class="kong-team2__member__wrap" ng-style="{'background-image':'url('+item.attrs.image.url+')'}">
                <div class="kong-team2__member__overlay"></div>
                <div class="kong-team2__member__container">
                    <h6 class="kong-team2__member__name" ng-bind-html="item.attrs.name" kong-editable model="item" config="{target:'attrs.name', editorType:'1'}"></h6>
                    <div class="kong-team2__member__position"><span ng-bind-html="item.attrs.position" kong-editable model="item" config="{target:'attrs.position', editorType:'1'}"></span></div>
                    <div class="kong-team2__member__icons">
                        <a ng-repeat="(icon, link) in item.attrs.social_contacts" data-icon="{{icon}}" class="kong-team2__member__icon">
                            <i class="fa" ng-class="::('fa-' + icon)"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_team2', 'kong_team2_callback');
function kong_team2_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
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
            'reset' => 'false',
            'interval' => 50
        )),
        'align' => 'bottom',
        'brand_color' => 'false'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $attrs['animation']['selector'] = '.kong-team2__member';
    $animation = kong_form_animation_data($attrs['animation']);
    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if (kong_to_boolean($attrs['brand_color'])) {
        $classes[] = 'kong-brandColor';
    }

    $classes[] = 'kong-team2--'.$attrs['align'];

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-team2 <?php echo implode(' ', $classes); ?>"<?php echo $id; ?><?php echo $animation; ?>>
        <div class="kong-team2__wrap"><?php echo do_shortcode($content); ?></div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_team2_member', 'kong_team2_member_callback');
function kong_team2_member_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'name' => 'John Doe',
        'position' => 'Position',
        'social_contacts' => json_encode(array(
            'twitter' => '#',
            'facebook' => '#'
        )),
        'link' => json_encode(array(
            'url' => '#',
            'new_tab' => 'false'
        ))
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['social_contacts'] = json_decode($attrs['social_contacts'], true);
    $attrs['link'] = json_decode($attrs['link'], true);
    $target = kong_to_boolean($attrs['link']['new_tab']) ? ' target="_blank"' : '';
    $link_overlay = '';
    if($attrs['link']['url']){
        $link_overlay = '<a href="'.$attrs['link']['url'].'"'.$target.' class="kong-team2__member__link"></a>';
    }

    ob_start() ?>
    <div class="kong-team2__member <?php echo $attrs['class_id'] ?>">
        <div class="kong-team2__member__wrap">
            <div class="kong-team2__member__overlay"></div>
            <div class="kong-team2__member__container">
                <h6 class="kong-team2__member__name"><?php echo html_entity_decode($attrs['name']); ?></h6>
                <div class="kong-team2__member__position"><span><?php echo html_entity_decode($attrs['position']); ?></span></div>
                <?php echo $link_overlay; ?>
                <?php
                if (!empty($attrs['social_contacts'])) :
                    echo '<div class="kong-team2__member__icons">';
                    foreach ($attrs['social_contacts'] as $icon => $link) :
                        if (!empty($link)) {
                            $link_before = '<a href="' . $link . '" class="kong-team2__member__icon" target="_blank" data-icon="'.$icon.'">';
                            $link_after = '</a>';
                        } else {
                            $link_before = '<span class="kong-team2__member__icon" data-icon="'.$icon.'">';
                            $link_after = '</span>';
                        }
                        ?>
                        <?php echo $link_before; ?>
                        <i class="fa fa-<?php echo $icon; ?>"></i>
                        <?php echo $link_after; ?>
                        <?php
                    endforeach;
                    echo '</div>';
                endif;
                ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}