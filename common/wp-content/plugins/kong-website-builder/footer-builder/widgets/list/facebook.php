<?php
$manager = KongFooterBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Facebook",
    "tag" => "facebook",
    "keywords" => ["facebook"],
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
                    "bind_to" => "@attrs.page",
                    "attrs" => array(
                        "label" => "Link of page",
                        "type" => "text"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.tab",
                    "attrs" => array(
                        "label" => "Tab",
                        "type" => "selection",
                        "config" => array(
                            "none" => "Select a Tab",
                            "timeline" => "Timeline",
                            "events" => "Events",
                            "messages" => "Messages"
                        )
                    ),
                    "default_value" => "none"
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
                        "type" => "number",
                        "config" => array(
                            "min" => 180,
                            "max" => 500,
                            "step" => 1
                        )
                    ),
                    "default_value" => 340
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.height",
                    "attrs" => array(
                        "label" => "Height",
                        "type" => "number",
                        "config" => array(
                            "min" => 70,
                            "max" => 800,
                            "step" => 1
                        )
                    ),
                    "default_value" => 500
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hide_cover",
                    "attrs" => array(
                        "label" => "Hide Cover",
                        "type" => "switch"
                    ),
                    "default_value" => false
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.show_face",
                    "attrs" => array(
                        "label" => "Show Face",
                        "type" => "switch"
                    ),
                    "default_value" => true
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.small_header",
                    "attrs" => array(
                        "label" => "Small Header",
                        "type" => "switch"
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hidden & Class",
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
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.class",
                    "attrs" => array(
                        "label" => "Custom Class",
                        "type" => "class"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
);

ob_start();
?>
<div class="kong-dnd__emptyItem kong-dnd__emptyItem--v" style="height:80px;" ng-if="!$ctrl.edited.attrs.page">
    <span class="kong-dnd__emptyItem__label">FACEBOOK</span>
</div>

<kong-facebook page="$ctrl.edited.attrs.page" tab="$ctrl.edited.attrs.tab"
                width="$ctrl.edited.attrs.width" height="$ctrl.edited.attrs.height"
                hide-cover="$ctrl.edited.attrs.hide_cover" show-face="$ctrl.edited.attrs.show_face"
                small-header="$ctrl.edited.attrs.small_header"></kong-facebook>
<?php
$widget['visual_view'] = ob_get_clean();
$manager->add($widget);

add_shortcode('lfb_facebook', 'lfb_facebook_callback');
function lfb_facebook_callback($attrs) {
    $attrs = shortcode_atts(array(
        'page' => '',
        'tab' => '',
        'width' => 340,
        'height' => 500,
        'hide_cover' => 'false',
        'show_face' => 'true',
        'small_header' => 'false'
    ), $attrs);

    $html = '';

    if ($attrs['page']) :
        $params = 'href=' . urlencode($attrs['page']) . '&adapt_container_width=true&width=' . $attrs['width'] . '&height=' . $attrs['height'];

        if ($attrs['tab']) {
            $params .= '&tabs=' . $attrs['tab'];
        }

        if (kong_to_boolean($attrs['small_header'])) {
            $params .= '&small_header=true';
        } else {
            $params .= '&small_header=false';
        }

        if (kong_to_boolean($attrs['hide_cover'])) {
            $params .= '&hide_cover=true';
        } else {
            $params .= '&hide_cover=false';
        }

        if (kong_to_boolean($attrs['show_face'])) {
            $params .= '&show_facepile=true';
        } else {
            $params .= '&show_facepile=false';
        }

        ob_start(); ?>
        <iframe src="https://www.facebook.com/plugins/page.php?<?php echo $params; ?>&appId" width="<?php echo $attrs['width']; ?>" height="<?php echo $attrs['height']; ?>" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        <?php
        $html = ob_get_clean();
    endif;

    return $html;
}