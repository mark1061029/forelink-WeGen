<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Team",
    "tag" => "team",
    "keywords" => ["team","member","list"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Members",
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
                        "desktop" => "25%",
                        "tablet" => "50%",
                        "mobile" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-team__member" => array(
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
                    "default_value" => 15,
                    "styles" => array(
                        "@id .kong-team__wrap" => array(
                            "margin" => "0 -{{@model}}px"
                        ),
                        "@id .kong-team__member" => array(
                            "padding" => "0 {{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.content_max_width",
                    "attrs" => array(
                        "label" => "Container Max Width",
                        "type" => "unit"
                    ),
                    "default_value" => "220px",
                    "styles" => array(
                        "@id .kong-team__member__container" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.margin_bottom",
                    "attrs" => array(
                        "label" => "Item Margin bottom",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 140,
                            "step" => 1
                        )
                    ),
                    "default_value" => 35,
                    "styles" => array(
                        "@id .kong-team__member" => array(
                            "marginBottom" => "{{@model}}px"
                        )
                    )
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
                    "bind_to" => "@attrs.avatar_size",
                    "attrs" => array(
                        "label" => "Avatar Size",
                        "type" => "unit"
                    ),
                    "default_value" => "100%",
                    "styles" => array(
                        "@id .kong-team__member__avatarWrap" => array(
                            "width" => "{{@model}}"
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
                            "min" => 5,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => 0,
                    "styles" => array(
                        "@id .kong-team__member__avatar" => array(
                            "borderRadius" => "{{@model}}%"
                        )
                    )
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
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => 24,
                    "styles" => array(
                        "@id .kong-team__member__name" => array(
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
                    "default_value" => 700,
                    "styles" => array(
                        "@id .kong-team__member__name" => array(
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
                        "@id .kong-team__member__name" => array(
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
                        "@id .kong-team__member__name" => array(
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
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-team__member__name" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_margin",
                    "attrs" => array(
                        "label" => "Name Margin",
                        "type" => "area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "20px 0px 3px 0px",
                    "styles" => array(
                        "@id .kong-team__member__name" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.position_size",
                    "attrs" => array(
                        "label" => "Position",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => 13,
                    "styles" => array(
                        "@id .kong-team__member__position" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.position_color",
                    "attrs" => array(
                        "label" => "Position",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        "@id .kong-team__member__position" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_size",
                    "attrs" => array(
                        "label" => "Desc",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => 14,
                    "styles" => array(
                        "@id .kong-team__member__desc" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_color",
                    "attrs" => array(
                        "label" => "Desc",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id .kong-team__member__desc" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_margin",
                    "attrs" => array(
                        "label" => "Desc Margin",
                        "type" => "area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => "15px 0px 20px 0px",
                    "styles" => array(
                        "@id .kong-team__member__desc" => array(
                            "margin" => "{{@model}}"
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
                    "bind_to" => "@attrs.icon_size",
                    "attrs" => array(
                        "label" => "Icon Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => 20,
                    "styles" => array(
                        "@id .kong-team__member__icon" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.icon_margin",
                    "attrs" => array(
                        "label" => "Icon Margin",
                        "type" => "slider",
                        "config" => array(
                            "min" => 0,
                            "max" => 15,
                            "step" => 1
                        )
                    ),
                    "default_value" => 5,
                    "styles" => array(
                        "@id .kong-team__member__icon" => array(
                            "margin" => "0 {{@model}}px"
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
                                "label" => "Icon Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["desc"],
                            "styles" => array(
                                "@id:not(.kong-team--brandColor) .kong-team__member__icon" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.icon_hover_color",
                            "attrs" => array(
                                "label" => "Icon Hover Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                "@id:not(.kong-team--brandColor) .kong-team__member__icon:hover" => array(
                                    "color" => "{{@model}}"
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
        "name" => "Team Member",
        "tag" => "team_member",
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
                            "@id .kong-team__member__avatar" => array(
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
                        "bind_to" => "@attrs.desc",
                        "attrs" => array(
                            "label" => "Description",
                            "type" => "textarea"
                        ),
                        "default_value" => $manager::$text["paragraph"]
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
    <span class="kong-dnd__emptyItem__label">Team</span>
</div>

<div class="kong-team {{::$ctrl.getID()}}" ng-class="[{'kong-team--brandColor':$ctrl.edited.attrs.brand_color}, $ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-team__wrap">
        <div class="kong-team__member" ng-repeat="item in $ctrl.edited.content track by $index">
            <div class="kong-team__member__wrap">
                <div class="kong-team__member__avatarWrap">
                    <a class="kong-team__member__avatar" ng-style="{'background-image':'url('+item.attrs.image.url+')'}"></a>
                </div>
                <div class="kong-team__member__container">
                    <h6 class="kong-team__member__name"  kong-editable model="item" config="{target:'attrs.name', editorType:'1'}" ng-bind-html="item.attrs.name"></h6>
                    <div class="kong-team__member__position"><span kong-editable model="item" config="{target:'attrs.position', editorType:'1'}" ng-bind-html="item.attrs.position"></span></div>
                    <p class="kong-team__member__desc"  kong-editable model="item" config="{target:'attrs.desc', editorType:'1'}" ng-bind-html="item.attrs.desc"></p>
                    <div class="kong-team__member__icons">
                        <a ng-repeat="(icon, link) in item.attrs.social_contacts" class="kong-team__member__icon">
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

add_shortcode('kong_team', 'kong_team_callback');
function kong_team_callback($attrs, $content = null) {
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
        'brand_color' => 'true'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['animation'] = json_decode($attrs['animation'], true);
    $attrs['animation']['selector'] = '.kong-team__member__avatarWrap';
    $animation = kong_form_animation_data($attrs['animation']);
    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if (kong_to_boolean($attrs['brand_color'])) {
        $classes[] = 'kong-team--brandColor';
    }

    $classes[] = $attrs['class_id'];

    ob_start(); ?>
    <div class="kong-team <?php echo implode(' ', $classes); ?>" id="<?php echo $attrs['id']; ?>"<?php echo $animation; ?>>
        <div class="kong-team__wrap"><?php echo do_shortcode($content); ?></div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_team_member', 'kong_team_member_callback');
function kong_team_member_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'name' => 'John Doe',
        'position' => 'Position',
        'desc' => KongPageBuilderClient::KONG_DUMB_PARAGRAPH,
        'social_contacts' => json_encode(array()),
        'link' => json_encode(array(
            'url' => '#',
            'new_tab' => 'false'
        ))
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['social_contacts'] = json_decode($attrs['social_contacts'], true);
    $attrs['link'] = json_decode($attrs['link'], true);

    if (!empty($attrs['link']['url'])) {
        $target = kong_to_boolean($attrs['link']['new_tab']) ? ' target="_blank"' : '';
        $link_before = '<a href="' . $attrs['link']['url'] . '" class="kong-team__member__avatar"' . $target . '>';
        $link_after = '</a>';
    } else {
        $link_before = '<span class="kong-team__member__avatar">';
        $link_after = '</span>';
    }

    ob_start(); ?>
    <div class="kong-team__member <?php echo $attrs['class_id']; ?>">
        <div class="kong-team__member__wrap">
            <div class="kong-team__member__avatarWrap">
                <?php echo $link_before . $link_after; ?>
            </div>
            <div class="kong-team__member__container">
                <h6 class="kong-team__member__name"><?php echo html_entity_decode($attrs['name']); ?></h6>
                <div class="kong-team__member__position"><span><?php echo html_entity_decode($attrs['position']); ?></span></div>
                <?php if($attrs['desc']): ?>
                    <p class="kong-team__member__desc"><?php echo html_entity_decode($attrs['desc']); ?></p>
                <?php endif;
                if (!empty($attrs['social_contacts'])) :
                    echo '<div class="kong-team__member__icons">';
                    foreach ($attrs['social_contacts'] as $icon => $link) :
                        if (!empty($link)) {
                            $link_before = '<a href="' . $link . '" class="kong-team__member__icon" target="_blank">';
                            $link_after = '</a>';
                        } else {
                            $link_before = '<span class="kong-team__member__icon">';
                            $link_after = '</span>';
                        }
                        ?>
                        <?php echo $link_before; ?>
                        <i class="fa fa-<?php echo $icon; ?>"></i>
                        <?php echo $link_after;
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
