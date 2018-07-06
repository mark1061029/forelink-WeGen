<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Testimonial",
    "tag" => "testimonial",
    "keywords" => ["testimonial","customer","quote","carousel"],
    "native" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Items",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@model",
                    "attrs" => array(
                        "label" => "Customers",
                        "type" => "item-group"
                    ),
                    "default_value" => []
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Slide Setting",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.autoplay",
                    "attrs" => array(
                        "label" => "Autoplay",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.duration",
                    "attrs" => array(
                        "label" => "Duration (ms)",
                        "type" => "slider",
                        "config" => array(
                            "min" => 5000,
                            "max" => 20000,
                            "step" => 500
                        )
                    ),
                    "default_value" => 10000
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Navigation",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.navigation",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "if" => "@attrs.navigation",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.nav_size",
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
                                "desktop" => 48,
                                "mobile" => 40
                            ),
                            "responsive_styles" => array(
                                "@id .owl-prev,@id .owl-next" => array(
                                    "fontSize" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.nav_position",
                            "attrs" => array(
                                "label" => "Position",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => -200,
                                    "max" => 200,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 0
                            ),
                            "responsive_styles" => array(
                                "@id .owl-prev" => array(
                                    "left" => "{{@model}}px"
                                ),
                                "@id .owl-next" => array(
                                    "right" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.nav_icon",
                            "attrs" => array(
                                "label" => "Icon",
                                "type" => "selection",
                                "config" => array(
                                    "0" => "Thin Chevron",
                                    "1" => "Thick Chevron",
                                    "2" => "Chevron Circle",
                                    "3" => "Arrow"
                                )
                            ),
                            "default_value" => "1"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.nav_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["heading"],
                            "styles" => array(
                                "@id .owl-prev,@id .owl-next" => array(
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
                "label" => "Pagination",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.pagination",
                    "attrs" => array(
                        "label" => "Enable",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "if" => "@attrs.pagination",
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.pag_size",
                            "attrs" => array(
                                "label" => "Size",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 4,
                                    "max" => 20,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 8,
                            "styles" => array(
                                "@id .owl-dot span" => array(
                                    "width" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.pag_margin",
                            "attrs" => array(
                                "label" => "Margin",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 100,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 4,
                            "styles" => array(
                                "@id .owl-dot" => array(
                                    "margin" => "0 {{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.pag_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors['border'],
                            "styles" => array(
                                "@id .owl-dot span" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.pag_active_color",
                            "attrs" => array(
                                "label" => "Active Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                "@id .owl-dot.active span" => array(
                                    "backgroundColor" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.pag_scale",
                            "attrs" => array(
                                "label" => "Scale",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 0.3,
                                    "max" => 1,
                                    "step" => 0.05
                                )
                            ),
                            "default_value" => 1,
                            "styles" => array(
                                "@id .owl-dot span" => array(
                                    "transform" => "scale({{@model}})"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.pag_active_scale",
                            "attrs" => array(
                                "label" => "Active Scale",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 0.5,
                                    "max" => 1,
                                    "step" => 0.05
                                )
                            ),
                            "default_value" => 1,
                            "styles" => array(
                                "@id .owl-dot.active span" => array(
                                    "transform" => "scale({{@model}})"
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
                "label" => "Distance & Spacing",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Max Width",
                        "type" => "res-unit"
                    ),
                    "default_value" => array(
                        "desktop" => "700px",
                        "tablet" => "80%",
                        "mobile" => "100%"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-testimonial__comment" => array(
                            "maxWidth" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_margin",
                    "attrs" => array(
                        "label" => "Name Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 1000,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "10px 0px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-testimonial__name" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.comment_margin",
                    "attrs" => array(
                        "label" => "Comment Margin",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 5,
                            "max" => 50,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "20px 0px 50px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-testimonial__comment" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Avatar & Typography",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.avatar_size",
                    "attrs" => array(
                        "label" => "Avatar Size",
                        "type" => "slider",
                        "config" => array(
                            "min" => 40,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 60,
                    "styles" => array(
                        "@id .kong-testimonial__avatar__wrap" => array(
                            "width" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.avatar_bg",
                    "attrs" => array(
                        "label" => "Avatar Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "transparent",
                    "styles" => array(
                        "@id .kong-testimonial__avatar__wrap" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.name_font_size",
                    "attrs" => array(
                        "label" => "Name",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 13
                    ),
                    "responsive_styles" => array(
                        "@id .kong-testimonial__name" => array(
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
                        "@id .kong-testimonial__name" => array(
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
                    "default_value" => 0.05,
                    "styles" => array(
                        "@id .kong-testimonial__name" => array(
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
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id .kong-testimonial__name" => array(
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
                        "@id .kong-testimonial__name" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.job_font_size",
                    "attrs" => array(
                        "label" => "Job",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 13
                    ),
                    "responsive_styles" => array(
                        "@id .kong-testimonial__job" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.job_color",
                    "attrs" => array(
                        "label" => "Job Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["desc"],
                    "styles" => array(
                        "@id .kong-testimonial__job" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.comment_font_size",
                    "attrs" => array(
                        "label" => "Comment",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 24
                    ),
                    "responsive_styles" => array(
                        "@id .kong-testimonial__comment" => array(
                            "fontSize" => "{{@model}}px"
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
                    "default_value" => 400,
                    "styles" => array(
                        "@id .kong-testimonial__comment" => array(
                            "fontWeight" => "{{@model}}"
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
                    "default_value" => 1.5,
                    "styles" => array(
                        "@id .kong-testimonial__comment" => array(
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
                        "@id .kong-testimonial__comment" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.comment_color",
                    "attrs" => array(
                        "label" => "Comment Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-testimonial__comment" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.comment_font_source",
                    "attrs" => array(
                        "label" => "Comment Font Source",
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
                                "selector" => "@id .kong-testimonial__comment"
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
    ],
    "child" => array(
        "name" => "Testimonial Item",
        "tag" => "testimonial_item",
        "native" => true,
        "content" => [
            array(
                "tag" => "editor-container",
                "attrs" => array(
                    "label" => "Customer",
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
                        )
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.name",
                        "attrs" => array(
                            "label" => "Name",
                            "type" => "text"
                        ),
                        "default_value" => "Raul Freeman"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@attrs.job",
                        "attrs" => array(
                            "label" => "Job",
                            "type" => "text"
                        ),
                        "default_value" => "Freelancer"
                    ),
                    array(
                        "tag" => "editor-field",
                        "bind_to" => "@content",
                        "attrs" => array(
                            "label" => "Say",
                            "type" => "textarea"
                        ),
                        "default_value" => $manager::$text["paragraph"]
                    )
                ]
            )
        ]
    )
);

ob_start();
?>
<div class="kong-dnd__emptyItem" style="height:150px" ng-if="$ctrl.edited.content.length == 0">
    <span class="kong-dnd__emptyItem__label">Testimonial</span>
</div>

<div class="kong-testimonial {{::$ctrl.getID()}}"
     selector=".kong-testimonial__avatar__wrap"
     ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
    <div class="kong-carousel owl-carousel" kong-testimonial
         list="$ctrl.edited.content"
         duration="$ctrl.edited.attrs.duration"
         autoplay="$ctrl.edited.attrs.autoplay"
         nav-icon="$ctrl.edited.attrs.nav_icon"
         pagination="$ctrl.edited.attrs.pagination"
         navigation="$ctrl.edited.attrs.navigation">
        <div class="kong-testimonial__item" ng-repeat="item in $ctrl.edited.content track by $index">
            <div class="kong-testimonial__avatar__wrap" ng-show="item.attrs.image.url">
                <span class="kong-testimonial__avatar" ng-style="{'background-image':'url(' + item.attrs.image.url + ')'}"></span>
            </div>
            <h6 class="kong-testimonial__name" ng-bind="item.attrs.name"></h6>
            <div class="kong-testimonial__job"><span ng-bind="item.attrs.job"></span></div>
            <p class="kong-testimonial__comment" ng-bind-html="item.content"></p>
        </div>
    </div>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_testimonial', 'kong_testimonial_callback');
function kong_testimonial_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'duration' => 5000,
        'autoplay' => 'true',
        'pagination' => 'false',
        'navigation' => 'false',
        'nav_icon' => '0'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

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
    <div class="kong-testimonial <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <div class="kong-carousel owl-carousel"
             data-duration="<?php echo $attrs['duration']; ?>"
             data-autoplay="<?php echo $attrs['autoplay']; ?>"
             data-pagination="<?php echo $attrs['pagination'] ?>"
             data-navigation="<?php echo $attrs['navigation']; ?>"
             data-nav-icon="<?php echo $attrs['nav_icon']; ?>">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_testimonial_item', 'kong_testimonial_item_callback');
function kong_testimonial_item_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'image' => json_encode(array(
            'url' => ''
        )),
        'name' => 'John Doe',
        'job' => 'Freelancer'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $attrs['image'] = json_decode($attrs['image'], true);

    if ($attrs['image']['url']) {
        $background = ' style="background-image: url(' . $attrs['image']['url'] . ')"';
    } else {
        $background = '';
    }

    ob_start(); ?>
    <div class="kong-testimonial__item <?php echo $attrs['class_id']; ?>">
        <?php if($background): ?>
            <div class="kong-testimonial__avatar__wrap">
                <span class="kong-testimonial__avatar"<?php echo $background; ?>></span>
            </div>
        <?php endif; ?>
        <h6 class="kong-testimonial__name"><?php echo html_entity_decode($attrs['name']); ?></h6>
        <div class="kong-testimonial__job"><span><?php echo html_entity_decode($attrs['job']); ?></span></div>
        <p class="kong-testimonial__comment"><?php echo do_shortcode($content); ?></p>
    </div>
    <?php
    return ob_get_clean();
}
