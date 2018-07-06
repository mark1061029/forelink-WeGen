<?php
$manager = KongHeaderBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "HTML & CSS",
    "tag" => "h_html",
    "keywords" => ["html","css"],
    "native" => true,
    "h_nav" => true,
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "HTML",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@content",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "code-editor",
                        "config" => array(
                            "mode" => "html"
                        )
                    ),
                    "default_value" => ""
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "CSS",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.css",
                    "attrs" => array(
                        "fullwidth" => true,
                        "type" => "code-editor",
                        "config" => array(
                            "mode" => "css"
                        )
                    ),
                    "default_value" => ""
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
<div class="kong-dnd__emptyItem kong-dnd__emptyItem--h" style="width:100px;" ng-if="!$ctrl.model.content">
    <span class="kong-dnd__emptyItem__label">HTML</span>
</div>

<div class="kong-html {{::$ctrl.getID()}}" ng-class="[$ctrl.edited.attrs.hidden, $ctrl.edited.attrs.class]" id="{{$ctrl.edited.attrs.id}}" ng-bind-html="$ctrl.model.content | trustashtml"></div>
<style type="text/css" ng-bind="$ctrl.edited.attrs.css"></style>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lhb_h_html', 'lhb_h_html_callback');
function lhb_h_html_callback($attrs, $content = null) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'hidden' => '',
        'id' => '',
        'css' => ''
    ), $attrs, KongHeaderBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start();
    if ($attrs['css']) : ?>
        <style type="text/css"><?php echo html_entity_decode($attrs['css']); ?></style>
        <?php
    endif;
    ?>
    <div class="kong-html <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}
