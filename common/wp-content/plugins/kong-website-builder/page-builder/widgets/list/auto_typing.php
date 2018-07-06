<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Auto Typing",
    "tag" => "auto_typing",
    "keywords" => ["auto typing","text"],
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
                    "bind_to" => "@attrs.before",
                    "attrs" => array(
                        "label" => "Before Text",
                        "type" => "text"
                    ),
                    "default_value" => "We design"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.auto_text",
                    "attrs" => array(
                        "label" => "Text",
                        "type" => "textarea",
                        "desc" => "Separate your words by a comma."
                    ),
                    "default_value" => "Beautiful,Elegant,Awesome"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.loop",
                    "attrs" => array(
                        "label" => "Loop",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.cursor",
                    "attrs" => array(
                        "label" => "Cursor",
                        "type" => "text"
                    ),
                    "default_value" => "|"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.speed",
                    "attrs" => array(
                        "label" => "speed",
                        "type" => "slider",
                        "config" => array(
                            "min" => 20,
                            "max" => 200,
                            "step" => 10
                        )
                    ),
                    "default_value" => 50
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.blink",
                    "attrs" => array(
                        "label" => "Cursor Blink",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.after",
                    "attrs" => array(
                        "label" => "After Text",
                        "type" => "text"
                    ),
                    "default_value" => "Websites"
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
                            "min" => 12,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => array(
                        "desktop" => 32
                    ),
                    "responsive_styles" => array(
                        "@id" => array(
                            "fontSize" => "{{@model}}px!important"
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
                        "label" => "Before & After Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["text"],
                    "styles" => array(
                        "@id .kong-autoTyping__before,@id .kong-autoTyping__after" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.auto_color",
                    "attrs" => array(
                        "label" => "Auto Color",
                        "type" => "colorpicker"
                    ),
                    "default_value" => $manager::$colors["heading"],
                    "styles" => array(
                        "@id .kong-autoTyping__text" => array(
                            "color" => "{{@model}}"
                        )
                    )
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.font_source",
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
                                "selector" => "@id .kong-autoTyping__text"
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
<div class="kong-dnd__emptyItem" style="height:50px;" ng-if="!$ctrl.edited.attrs.auto_text">
    <span class="kong-dnd__emptyItem__label">Auto Typing</span>
</div>

<h6 class="kong-autoTyping {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class, {'kong-autoTyping--blink' : $ctrl.edited.attrs.blink}]" id="{{$ctrl.edited.attrs.id}}">
    <span class="kong-autoTyping__before" kong-editable model="$ctrl.edited" config="{target:'attrs.before', editorType:'1'}" ng-bind-html="$ctrl.edited.attrs.before"></span>
                <span class="kong-autoTyping__text"
                      model="$ctrl.edited"
                      frontend-compile
                      callback="bindAutoTyping"
                      attrs="['speed', 'auto_text', 'loop', 'cursor']"></span>
    <span class="kong-autoTyping__after" kong-editable model="$ctrl.edited" config="{target:'attrs.after', editorType:'1'}" ng-bind-html="$ctrl.edited.attrs.after"></span>
</h6>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_auto_typing', 'kong_auto_typing_callback');
function kong_auto_typing_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'blink' => 'true',
        'before' => 'We Design',
        'auto_text' => 'Beautiful,Elegant,Awesome',
        'loop' => 'true',
        'cursor' => '|',
        'speed' => 50,
        'after' => 'Websites'
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    if (kong_to_boolean($attrs['blink'])) {
        $classes[] = 'kong-autoTyping--blink';
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <h6 class="kong-autoTyping <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <span class="kong-autoTyping__before"><?php echo html_entity_decode($attrs['before']); ?></span>
		<span class="kong-autoTyping__text">
			<span data-auto-text="<?php echo $attrs['auto_text']; ?>"
                  data-loop="<?php echo $attrs['loop']; ?>"
                  data-cursor="<?php echo esc_attr($attrs['cursor']); ?>" data-speed="<?php echo $attrs['speed']; ?>"></span>
		</span>
        <span class="kong-autoTyping__after"><?php echo html_entity_decode($attrs['after']); ?></span>
    </h6>
    <?php
    return ob_get_clean();
}

