<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Story",
    "tag" => "story",
    "keywords" => ["story","image"],
    "native" => true,
    "filter" => "image",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Image",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.image",
                    "attrs" => array(
                        "label" => "Image",
                        "type" => "upload-image"
                    ),
                    "default_value" => array(
                        "url" => ""
                    ),
                    "styles" => array(
                        "@id" => array(
                            "backgroundImage" => "url({{@model.url}})"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => ["px","vw","vh"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "335px"
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "height" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.radius",
                    "attrs" => array(
                        "label" => "Border Radius",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 0,
                            "max" => 200,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "0px 0px 0px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "borderRadius" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hover",
                    "attrs" => array(
                        "label" => "Hover",
                        "type" => "selection",
                        "config" => array(
                            "none" => "No Effect",
                            "fadeIn" => "Fade In",
                            "fadeInTextTrans" => "Fade In & Text Transition",
                            "slideLeft" => "Slide from Left",
                            "slideRight" => "Slide from Right",
                            "slideUp" => "Slide from Bottom",
                            "scaleUp" => "Scale Up"
                        )
                    ),
                    "default_value" => "none"
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Content Align & Spacing",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.h_align",
                    "attrs" => array(
                        "label" => "Horizontal",
                        "type" => "h-align"
                    ),
                    "default_value" => "bottom"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.v_align",
                    "attrs" => array(
                        "label" => "Vertical",
                        "type" => "v-align"
                    ),
                    "default_value" => "left"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.max_width",
                    "attrs" => array(
                        "label" => "Max Width",
                        "type" => "res-unit",
                        "config" => array(
                            "setting" => array(
                                "min" => 0,
                                "max" => 1000,
                                "step" => 1
                            ),
                            "units" => ["px","%","em"]
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "300px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-story__content" => array(
                            "maxWidth" => "{{@model}}"
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
                        "desktop" => "30px 20px 30px 20px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-story__content" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Title",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.title",
                    "attrs" => array(
                        "label" => "Text",
                        "type" => "text"
                    ),
                    "default_value" => $manager::$text["heading"]
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.title_color",
                    "attrs" => array(
                        "label" => "Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#ffffff",
                    "styles" => array(
                        "@id .kong-story__title" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.title_size",
                    "attrs" => array(
                        "label" => "Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 10,
                            "max" => 60,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 24
                    ),
                    "responsive_styles" => array(
                        "@id .kong-story__title" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.title_weight",
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
                        "@id .kong-story__title" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.title_letter_spacing",
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
                        "@id .kong-story__title" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.title_text_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "",
                    "styles" => array(
                        "@id .kong-story__title" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Text",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc",
                    "attrs" => array(
                        "label" => "Desc",
                        "type" => "textarea"
                    ),
                    "default_value" => "There are many variations of passages of Lorem Ipsum available."
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_size",
                    "attrs" => array(
                        "label" => "Desc Size",
                        "type" => "res-slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 40,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 14
                    ),
                    "responsive_styles" => array(
                        "@id .kong-story__desc" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_line_height",
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
                        "@id .kong-story__desc" => array(
                            "lineHeight" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_color",
                    "attrs" => array(
                        "label" => "Desc Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => "#c4c4c4",
                    "styles" => array(
                        "@id .kong-story__desc" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.desc_margin",
                    "attrs" => array(
                        "label" => "Distance",
                        "type" => "res-area2",
                        "config" => array(
                            "min" => 0,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "18px 0px 20px 0px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-story__desc" => array(
                            "margin" => "{{@model}}"
                        )
                    )
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Button",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_text",
                    "attrs" => array(
                        "label" => "Text",
                        "type" => "text"
                    ),
                    "default_value" => "Read Story"
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
                    "bind_to" => "@attrs.btn_font_size",
                    "attrs" => array(
                        "label" => "Font Size",
                        "type" => "res_slider",
                        "config" => array(
                            "min" => 8,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 11
                    ),
                    "responsive_styles" => array(
                        "@id .kong-story__btn" => array(
                            "fontSize" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.button_letter_spacing",
                    "attrs" => array(
                        "label" => "Letter Spacing",
                        "type" => "slider",
                        "config" => array(
                            "min" => -0.1,
                            "max" => 0.5,
                            "step" => 0.01
                        )
                    ),
                    "default_value" => 0.1,
                    "styles" => array(
                        "@id .kong-story__btn" => array(
                            "letterSpacing" => "{{@model}}em"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.button_text_transform",
                    "attrs" => array(
                        "label" => "Text Transform",
                        "type" => "text-transform"
                    ),
                    "default_value" => "uppercase",
                    "styles" => array(
                        "@id .kong-story__btn" => array(
                            "textTransform" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.button_weight",
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
                        "@id .kong-story__btn" => array(
                            "fontWeight" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_radius",
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
                        "@id .kong-story__btn" => array(
                            "borderRadius" => "{{@model}}px"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_padding",
                    "attrs" => array(
                        "label" => "Padding",
                        "type" => "res-area",
                        "config" => array(
                            "min" => 3,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => "9px 15px 9px 15px"
                    ),
                    "responsive_styles" => array(
                        "@id .kong-story__btn" => array(
                            "padding" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_bg",
                    "attrs" => array(
                        "label" => "Background",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary"],
                    "styles" => array(
                        "@id .kong-story__btn" => array(
                            "backgroundColor" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_color",
                    "attrs" => array(
                        "label" => "color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["primary_context"],
                    "styles" => array(
                        "@id .kong-story__btn" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.btn_box_shadow",
                    "attrs" => array(
                        "label" => "Box Shadow",
                        "type" => "box-shadow"
                    ),
                    "default_value" => "0px 2px 0px rgba(0,0,0,0.1)",
                    "styles" => array(
                        "@id .kong-story__btn" => array(
                            "boxShadow" => "{{@model}}"
                        )
                    )
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
                        "angle" => 180,
                        "value" => "linear-gradient(180deg, rgba(0,0,0,0.4), rgba(0,0,0,0.4))"
                    ),
                    "styles" => array(
                        "@id .kong-story__overlay" => array(
                            "background" => "{{@model.value}}"
                        )
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
<div class="kong-dnd__emptyItem" style="height:100px;" ng-if="!$ctrl.edited.attrs.image.url">
    <span class="kong-dnd__emptyItem__label">Story</span>
</div>

<div class="kong-story {{::$ctrl.getID()}}" ng-class="['kong-story--hover-'+$ctrl.edited.attrs.hover,'kong-story--hAlign-'+$ctrl.edited.attrs.h_align,'kong-story--vAlign-'+$ctrl.edited.attrs.v_align,$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]" id="{{$ctrl.edited.attrs.id}}">
    <a class="kong-story__overlay">
        <div class="kong-story__content">
            <h6 class="kong-story__title" kong-editable model="$ctrl.edited" config="{target:'attrs.title', editorType:'1'}" ng-bind-html="$ctrl.edited.attrs.title"></h6>
            <p class="kong-story__desc" kong-editable model="$ctrl.edited" config="{target:'attrs.desc', editorType:'1'}" ng-bind-html="$ctrl.edited.attrs.desc"></p>
            <span class="kong-story__btn" ng-show="$ctrl.edited.attrs.btn_text"><span kong-editable model="$ctrl.edited" config="{target:'attrs.btn_text', editorType:'1'}" ng-bind-html="$ctrl.edited.attrs.btn_text"></span></span>
        </div>
    </a>
</div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);

add_shortcode('kong_story', 'kong_story_callback');
function kong_story_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'h_align' => 'bottom',
        'v_align' => 'left',
        'title' => KongPageBuilderClient::KONG_DUMB_HEADING,
        'desc' => 'There are many variations of passages of Lorem Ipsum available.',
        'btn_text' => 'Read Story',
        'hover' => 'none',
        'link' => json_encode(array(
            'url' => '#',
            'new_tab' => 'true'
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

    if($attrs['hover'] != 'none'){
        $classes[] = 'kong-story--hover-'.$attrs['hover'];
    }

    $classes[] = 'kong-story--hAlign-'.$attrs['h_align'];
    $classes[] = 'kong-story--vAlign-'.$attrs['v_align'];
    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-story <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <a class="kong-story__overlay" href="<?php echo $attrs['link']['url']?>" <?php if(kong_to_boolean($attrs['link']['new_tab'])) echo 'target="_blank"';?>>
            <div class="kong-story__content">
                <h6 class="kong-story__title"><?php echo html_entity_decode($attrs['title']); ?></h6>
                <p class="kong-story__desc"><?php echo html_entity_decode($attrs['desc']); ?></p>
                <?php
                if (!empty($attrs['link']['url']) && $attrs['btn_text']) {
                    echo '<span class="kong-story__btn">'. html_entity_decode($attrs['btn_text']) . '</span>';
                }
                ?>
            </div>
        </a>
    </div>
    <?php
    return ob_get_clean();
}
